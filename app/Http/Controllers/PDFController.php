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

class PDFController extends Controller
{
    public function createView1($start_date, $end_date)
    {
        DB::statement('CREATE VIEW view1 AS SELECT component_id, amount FROM components_meals where meal_id IN(SELECT meal_id FROM meals_menus WHERE menu_id IN(SELECT id FROM menus WHERE date >= "' . $start_date . '" AND date <= "' . $end_date . '"));');
    }

    public function createView2()
    {
        DB::statement('CREATE VIEW view2 AS SELECT ((v1.amount/co.amount) * ci.amount) AS fixamount, ci.ingredient_id FROM components_ingredients ci, components co, view1 v1 WHERE ci.component_id = v1.component_id AND co.id = v1.component_id;');
    }

    public function createView3()
    {
        DB::statement('CREATE VIEW view3 AS SELECT v2.fixamount, i.name, i.supplier_id,i.db_unit_id FROM view2 v2, ingredients i WHERE v2.ingredient_id = i.id;');
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
        try
        {
            $suppliers = [];
            $start_date = $request->startdate;
            $end_date = $request->enddate;
            list ($year, $month, $day) = explode('-',$start_date);
            $start_date_show = $day . "." . $month. "." . $year;
            list ($year, $month, $day) = explode('-',$end_date);
            $end_date_show = $day . "." . $month. "." . $year;
            $adults = array_sum($request->adults);
            $childrens =  array_sum($request->childrens);
            $datum = date("d.m.Y");

            $this->createView1($start_date, $end_date);
            $this->createView2();
            $this->createView3();  

            $strsql = DB::select('SELECT SUM(v3.fixamount) AS MENGE,v3.name AS ZUTAT,s.name AS LIEFERANT,db_units.name AS EINHEIT FROM view3 v3, suppliers s,db_units WHERE v3.supplier_id = s.id AND v3.db_unit_id = db_units.id GROUP BY v3.name, s.name, db_units.name ORDER BY LIEFERANT;');

            $pdfAuthor = "CateringChef.de";
            $pdfImage = '<img src="img/LogoOpen.png" style="width:255px; height:auto;">';
            $pdfName = "Einkaufsliste_".$datum.".pdf";
            $EKL_footer = "Erstellt von: CateringChef.de";

            //////////////////////////// Inhalt des PDFs als HTML-Code \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

            // Erstellung des HTML-Codes. Dieser HTML-Code definiert das Aussehen eures PDFs.
    
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
                                <font size="18">Erwachsene: '.$adults.'</font>
                            </div>
                            <div>
                                <font size="18">Kinder: '.$childrens.'</font>
                            </div>
                            <div>
                            <font size="14">Zeitraum: '.$start_date_show.' bis '.$end_date_show.'</font>
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
            $footer = 'Notizen: <br><div style="width:100%"; border = "1"><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br></div><br><br><br>';
            DB::statement("DROP VIEW view1,view2,view3;");
            $footer .= nl2br($EKL_footer);



            //////////////////////////// Erzeugung eines PDF Dokuments \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

            // Erstellung des PDF Dokuments
            //PDF::new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

            // Dokumenteninformationen
            PDF::SetAuthor($pdfAuthor);
            PDF::SetTitle('Einkaufsliste '.$datum);
            PDF::SetSubject('Einkaufsliste '.$datum);

            // Auswahl der MArgins
            PDF::SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            PDF::SetHeaderMargin(PDF_MARGIN_HEADER);
            PDF::SetFooterMargin(PDF_MARGIN_FOOTER);

            // Automatisches Autobreak der Seiten
            PDF::SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);

            // Image Scale
            PDF::setImageScale(PDF_IMAGE_SCALE_RATIO);

            // Schriftart
            // PDF::SetFont('kreon', '', 10);

            // Neue Seite
            PDF::AddPage();

            // Fügt den HTML Code in das PDF Dokument ein
            PDF::writeHTML($header, true, false, true, false, '');
            PDF::writeHTML($body, true, false, true, false, '');
            // Automatisches Autobreak der Seiten
            PDF::SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
            PDF::AddPage();
            PDF::setPage(PDF::getPage()); 
            PDF::TextField('address', 180, 84, array('multiline' => true), array(),15,40);
            PDF::writeHTML($footer, true, false, true, false, '');
            //Ausgabe der PDF

            //Variante 1: PDF direkt an den Benutzer senden:
            PDF::Output($pdfName, 'I');

            //Variante 2: PDF im Verzeichnis abspeichern:
            //PDF::Output(dirname(__FILE__).'/'.$pdfName, 'F');
            //echo 'PDF herunterladen: <a href="'.$pdfName.'">'.$pdfName.'</a>';
        }
        catch(\Illuminate\Database\QueryException $ex)
        {
            $notification = array(
                'message' => 'Einkaufsliste konnte nicht generiert werden!',
                'alert-type' => 'error'
            );
        }
        return redirect('/menu')->with($notification);;
    }
}
