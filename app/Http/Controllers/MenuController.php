<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Menu;
use App\Customer;
use PDF;
use App\Meal;
use DateTime;
use Redirect,Response;

class MenuController extends Controller
{
    
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($week = null, $direction = null)
    {
        /* Calculate Week, Start and Enddate  */
        $basisWeek = new DateTime();
        if ($week != null) {
            session(['week' => $week]);
        }
        
        $thisWeek = session('week',date('W'));
        $thisYear = session('year',date('Y'));
        
        if ($direction == 'last') { 
            $thisWeek = $basisWeek->setISODate(intval($thisYear),intval($thisWeek))->modify('-1 week')->format('W');   
        }elseif ($direction == 'next'){
            $thisWeek = $basisWeek->setISODate(intval($thisYear),intval($thisWeek))->modify('+1 week')->format('W');      
        }
        session(['week' => $thisWeek]);
        
        $startDay =  $basisWeek->setISODate(intval($thisYear),intval($thisWeek))->modify('monday this week')->format('Y-m-d');
        $endDay =  $basisWeek->setISODate(intval($thisYear),intval($thisWeek))->modify('friday this week')->format('Y-m-d');
        
        /* Log::info('Week:'.$thisWeek);
        Log::info('Start:'.$startDay);
        Log::info('end:'.$endDay);
         */

        /* Get Data from Tables */
        $meals = DB::table('meals')->orderBy('name','asc')->get();
        $allergenes = DB::table('allergenes')->orderBy('id','asc')->get();
        $allergeneToMeal = DB::select('SELECT DISTINCT M.id as mealId, A.id AS allergeneId
                                        FROM meals AS M, components_meals AS CM, components_ingredients AS CI, allergenes_ingredients AS AI, allergenes AS A
                                        WHERE M.id = CM.meal_id
                                        AND CM.component_id = CI.component_id
                                        AND CI.ingredient_id = AI.ingredient_id
                                        AND AI.allergene_id = A.id;');
           
        /* Add Allergenes to Meal*/
        $viewMeals = array();
        foreach ($meals as $id => $meal) {
            $mealId = $meal->id;
            $mealAllergenes = array();
            foreach ($allergeneToMeal as $relation) {
                if ($relation->mealId == $mealId) {
                    $mealAllergenes[] = $relation->allergeneId;
                }
            }
            $mealAllergenes = implode(",", $mealAllergenes);
            $meal->allergenes = $mealAllergenes;
            $viewMeals[$mealId] = $meal; 
        }
        /* Log::info('Meals');
        Log::info($viewMeals); */

        $menuMealRelations = DB::table('meals_menus')->get();
        
        /* Main Course */
        $mainCourse = DB::table('menus')
        ->where('course','=','main')
        ->whereBetween('date',[$startDay, $endDay])
        ->get();

        $viewMainCourse = array();
        foreach ($mainCourse as $course) {
            $courseMeals = array();
            foreach($menuMealRelations as $relation){
                foreach ($viewMeals as $meal) {
                    if ($meal->id == $relation->meal_id && $course->id == $relation->menu_id) {
                        $meal->relationId = $relation->id;
                        $newMeal = json_encode($meal);
                        $courseMeals[] = $newMeal;
                    }
                }    
            }
            /* Log::info('Meals for course'. $course->id);
            Log::info($courseMeals); */
            $course->meals = $courseMeals;
            $viewMainCourse[] = $course; 
        }
        /* Log::info($viewMainCourse); */

        //Shopping List
        $customers = Customer::all();
        $allCustomerId = DB::table('customers')->select('id')->get();

        
        $dessertCourse = DB::table('menus')
                        ->where('course','=','dessert')
                        ->whereBetween('date',[$startDay, $endDay])
                        ->get();

        $viewDessertCourse = array();
        foreach ($dessertCourse as $course) {
            $courseMeals = array();
            foreach ($viewMeals as $meal) {
                foreach($menuMealRelations as $relation){
                    if (($course->id == $relation->menu_id) && ($meal->id == $relation->meal_id)) {
                        /* Log::info($meal->id .' = '. $relation->meal_id .'and'. $course->id .'='. $relation->menu_id); */
                        $meal->relationId = $relation->id;
                        $newMeal = json_encode($meal);
                        $courseMeals[] = $newMeal;
                        /* Log::info($courseMeals); */
                    }
                    
                }        
            }
            /* Log::info('Meals for course Dessert'. $course->id);
            Log::info($courseMeals); */
            $course->meals = $courseMeals;
            $viewDessertCourse[] = $course; 
        }
        Log::info($viewDessertCourse);

                               
        return view('/menu', [  'mainCourse' => $viewMainCourse,
                                'dessertCourse' => $viewDessertCourse,
                                'meals' => $viewMeals,
                                'allergenes' => $allergenes,
                                'KW' => $thisWeek,
                                'startDate' => $startDay,
                                'endDate' => $endDay,
                                'year' => $thisYear,
                                'customers' => $customers,
                                'allCustomerId' => $allCustomerId,
                            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Log::info($request->all());
        Log::info('Store');

        $date = $request->date;
        $course = $request->course;
        $mealId = $request->mealId;

        $menu = Menu::where('date', $date)->where('course', $course)->first();

        /* Log::info($menu); */
        /* new Menu */
        if (empty($menu)) {
            $newMenu = new Menu;
            $newMenu->date = $date;
            $newMenu->course = $course;
            $newMenu->save();
            $menu = $newMenu;
        }

        $meal = Meal::find($mealId);
        $menu->meal()->attach($meal);

        $mealsMenuId =  DB::table('meals_menus')->where('meal_id',$mealId)->where('menu_id', $menu->id)->first();
        return Response::json($mealsMenuId);
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('meals_menus')->where('id',$id)->delete();
        return redirect('/menu');
    }

    /**
     * Change the Year to the requested one
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */ 
    public function changeYear(Request $request){
        $newYear = $request->input('selectedYear');
        session(['year' => $newYear]);
        return redirect('/menu');
    }

    /**
     * Create the Shopping List.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function createShoppingList(Request $request)
    {
        $suppliers = [];
        $start_date = $request->startdate;
        $end_date = $request->enddate;
        $adults = array_sum($request->adults);
        $childrens =  array_sum($request->childrens);
        $datum = date("d.m.Y");

        $pdfAuthor = "Exval.de";
        $pdfImage = '<img src="img/CC-logo.png" style="width:255px; height:auto;">';
        $pdfName = "Einkaufsliste_".$datum.".pdf";
        $EKL_footer = "Erstellt von: CateringChef.de";


        //////////////////////////// Inhalt des PDFs als HTML-Code \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\


        // Erstellung des HTML-Codes. Dieser HTML-Code definiert das Aussehen eures PDFs.
        // tcpdf unterstützt recht viele HTML-Befehle. Die Nutzung von CSS ist allerdings
        // stark eingeschränkt

        $header = '
        <table cellpadding="5" style="width: 100%;"; border="0">
            <tr>
                <td></td>
                <td style="text-align: right">Erstellt: '.$datum.'</td>
            </tr>
            <tr>
                <td style="text-align: left;" cellpadding="5">
                    <div>
                        <font size="22">Einkaufsliste</font>
                    </div>
                    <div style="border: 1px solid black;">
                        <div>
                            <font size="16">Erwachsene: '.$adults.'</font>
                        </div>
                        <div>
                            <font size="16">Kinder: '.$childrens.'</font>
                        </div>
                    </div>
                </td>
                <td style="text-align: right;">'.$pdfImage.'</td>
            </tr>
        </table>
        <br><br>';

        $body = '

        <table cellpadding="5" cellspacing="0" style="width: 100%;" border="0">
        <tr style="text-align: left;">
            <th>
                <font size="16">Lieferant</font>
            </th>
            <th>
                <font size="16">Zutat</font>
            </th>
            <th>
                <font size="16">Menge</font>
            </th>
        <td style="text-align: left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="checked-checkbox.png" style="width:30px;height:30px;"></td>
        </tr>
        <hr>';
        
        DB::statement('CREATE VIEW view1 AS SELECT component_id, amount FROM components_meals where meal_id IN(SELECT meal_id FROM meals_menus WHERE menu_id IN(SELECT id FROM menus WHERE date >= "' . $start_date . '" AND date <= "' . $end_date . '"));');
        DB::statement("CREATE VIEW view2 AS SELECT ((v1.amount/co.amount) * ci.amount) AS fixamount,ci.ingredient_id FROM components_ingredients CI, components co, view1 v1 WHERE ci.component_id = v1.component_id AND co.id = v1.component_id;");
        DB::statement("CREATE VIEW view3 AS SELECT v2.fixamount, i.name, i.supplier_id,i.db_unit_id FROM view2 v2, ingredients i WHERE v2.ingredient_id = i.id;");
        $strsql = DB::select("SELECT SUM(v3.fixamount) AS MENGE,v3.name AS ZUTAT,s.name AS LIEFERANT,db_units.name AS EINHEIT FROM view3 v3, suppliers s,db_units WHERE v3.supplier_id = s.id AND v3.db_unit_id = db_units.id GROUP BY v3.name, s.name, db_units.name ORDER BY LIEFERANT;");
        foreach ($strsql as $supplier) {
            array_push($suppliers, $supplier->LIEFERANT);
        }
        $suppliersunique = array_unique($suppliers);
        foreach ($suppliersunique as $supplier) {
            $body .= '<br><hr><tr><td style="text-align: left;">'.$supplier.'</td></tr><hr>';
            foreach ($strsql as $content) {
                if ($content->LIEFERANT == $supplier) {
                    $zutat = $content->ZUTAT;
                    $menge = $content->MENGE;
                    $menge = ($menge * $adults) + ($menge * $childrens * 0.5);
                    $einheit = $content->EINHEIT;
                    if ($einheit != "Stück") {
                        if ($menge > 1000) {
                            $menge = $menge / 1000;
                            $menge = round($menge, 2);
                            if ($einheit == "g") {
                                $einheit = "kg";
                            }
                            if ($einheit == "ml") {
                                $einheit = "Liter";
                            }
                        } else {
                            $menge = round($menge);
                        }
                    } else {
                        $menge = round($menge);
                    }
                    $body .= '<tr><td></td>
                            <td style="text-align: left;">'.$zutat.'</td>
                            <td style="text-align: left;">'.$menge. ' '.$einheit.'</td>
                            <td style="text-align: left;"> <input type="checkbox" name="'.$zutat.'" value="1"></td>
                            </tr>';
                }
            }
        }
        $body .="</table><br><br><br><br>";
        $footer = 'Notizen: <br><div style="width:100%"; border = "1"><br><br><br><br><br><br><br><br><br><br><br><br><br></div><br><br><br>';
        DB::statement("DROP VIEW view1,view2,view3;");
        $footer .= nl2br($EKL_footer);



        //////////////////////////// Erzeugung eines PDF Dokuments \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

        // Erstellung des PDF Dokuments
        //PDF::new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // Dokumenteninformationen
        PDF::SetAuthor($pdfAuthor);
        PDF::SetTitle('Einkaufsliste '.$datum);
        PDF::SetSubject('Einkaufsliste '.$datum);


        // Header und Footer Informationen
        PDF::setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        PDF::setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // Auswahl des Font
        PDF::SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // Auswahl der MArgins
        PDF::SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        PDF::SetHeaderMargin(PDF_MARGIN_HEADER);
        PDF::SetFooterMargin(PDF_MARGIN_FOOTER);

        // Automatisches Autobreak der Seiten
        PDF::SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);

        // Image Scale
        PDF::setImageScale(PDF_IMAGE_SCALE_RATIO);

        // Schriftart
        //PDF::SetFont('Kreon', '', 10);

        // Neue Seite
        PDF::AddPage();

        // Fügt den HTML Code in das PDF Dokument ein
        PDF::writeHTML($header, true, false, true, false, '');
        PDF::writeHTML($body, true, false, true, false, '');
        // Automatisches Autobreak der Seiten
        PDF::SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        PDF::writeHTML($footer, true, false, true, false, '');
        //Ausgabe der PDF

        //Variante 1: PDF direkt an den Benutzer senden:
        PDF::Output($pdfName, 'I');

        //Variante 2: PDF im Verzeichnis abspeichern:
        // $pdf->Output(dirname(__FILE__).'/'.$pdfName, 'F');
        // echo 'PDF herunterladen: <a href="'.$pdfName.'">'.$pdfName.'</a>';
    }

}
