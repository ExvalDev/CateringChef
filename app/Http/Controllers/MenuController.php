<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Menu;
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
    public function index()
    {
        
        $menus = DB::table('menus')->get();
        $meals = DB::table('meals')->orderBy('name','asc')->get();
        $allergenes = DB::table('allergenes')->orderBy('id','asc')->get();
        $allergeneToMeal = DB::select('SELECT DISTINCT M.id as mealId, A.id AS allergeneId
                                        FROM meals AS M, components_meals AS CM, components_ingredients AS CI, allergenes_ingredients AS AI, allergenes AS A
                                        WHERE M.id = CM.meal_id
                                        AND CM.component_id = CI.component_id
                                        AND CI.ingredient_id = AI.ingredient_id
                                        AND AI.allergene_id = A.id;');
        /* $allergeneToMeal = DB::table('meals')
                                ->distinct()
                                ->join('components_meals',          'meals.id',                             '=','components_meals.meal_id')
                                ->join('components_ingredients',    'components_meals.component_id',        '=','components_ingredients.component_id')
                                ->join('allergenes_ingredients',    'components_ingredients.ingredient_id', '=','allergenes_ingredients.ingredient_id')
                                ->join('allergenes',                'allergenes_ingredients.allergene_id',  '=','allergenes.id')
                                ->select('meals.id as mealId', 'allergenes.id as allergeneId'); */
            
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
       /*  Log::info($viewMeals); */
    
        return view('/menu', [  'menus' => $menus,
                                'meals' => $viewMeals,
                                'allergenes' => $allergenes
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
}
