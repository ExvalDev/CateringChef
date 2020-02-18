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
}
