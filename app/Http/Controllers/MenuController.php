<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Menu;
use DateTime;
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
        /* Log::info($viewMeals); */

        /* Get all Courses and add Meal to Menu */
        $mainCourse = DB::table('menus')
                        ->where('course','=','main')
                        ->whereBetween('date',[$startDay, $endDay])
                        ->get();
        $dessertCourse = DB::table('menus')
                        ->where('course','=','dessert')
                        ->whereBetween('date',[$startDay, $endDay])
                        ->get();
        $menuMealRelations = DB::table('meals_menus')->get();
        
        $viewMainCourse = array();
        foreach ($mainCourse as $course) {
            foreach($menuMealRelations as $relation){
                foreach ($viewMeals as $meal) {
                    if ($meal->id == $relation->meal_id && $course->id == $relation->menu_id) {
                        $course->meal = $meal;
                        $viewMainCourse[] = $course;
                    }
                }   
            } 
        }
        /* Log::info($viewMainCourse); */
                               
        return view('/menu', [  'mainCourse' => $viewMainCourse,
                                'dessertCourse' => $dessertCourse,
                                'meals' => $viewMeals,
                                'allergenes' => $allergenes,
                                'KW' => $thisWeek,
                                'startDate' => $startDay,
                                'endDate' => $endDay,
                                'year' => $thisYear
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
        //
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
        //
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
