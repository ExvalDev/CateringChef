<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Redirect,Response;
use App\Meal;

class MealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $validatedData = $this->validate($request, [
            'name' => 'required',
            'recipe' => '',
        ]);

        try
        {
            $components = [];
            $amounts = [];
            if(isset($_POST["components"]) && isset($_POST["amounts"]))
            {
                $components = $_POST['components'];
                $amounts = $_POST['amounts'];
            }
            if(!empty($components) && !empty($amounts))
            {
                $meal = new Meal;

                $meal->name = $request->input('name');
                if($request->input('mainCourse' == true) && $request->input('dessertCourse' == true))
                {
                    $meal->main = $request->input('mainCourse');
                    $meal->dessert = $request->input('dessertCourse');
                }
                elseif($request->input('mainCourse' == true) && $request->input('dessertCourse' == null))
                {
                    $meal->main = $request->input('mainCourse');
                    $meal->dessert = false;
                }
                elseif($request->input('mainCourse' == null) && $request->input('dessertCourse' == true))
                {
                    $meal->main = false;
                    $meal->dessert = $request->input('dessertCourse');
                }
                $meal->recipe = $request->input('recipe');

                $meal->save();

                foreach($components as $cnt => $component) 
                {
                    $amount = $amounts[$cnt+1];
                    $meal->component()->attach($component, ['amount' => $amount]);
                }

                $notification = array(
                    'message' => 'Speise wurde hinzugefügt!',
                    'alert-type' => 'success'
                );
            }
            else
            {
                $notification = array(
                    'message' => 'Keine Komponenten angegeben!',
                    'alert-type' => 'error'
                );
            }
        }
        catch(\Illuminate\Database\QueryException $ex)
        {
            $notification = array(
                'message' => 'Speise wurde nicht hinzugefügt!',
                'alert-type' => 'error'
            );
            return $ex;
        }
        //return redirect('/tables')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Meal::findOrFail($id);
        $components = Meal::find($id)->component;
        foreach($components as $component)
        {
            $unit = DB::table('components')->where('components.id', $component->id)->join('db_units', 'components.db_unit_id', '=', 'db_units.id')->select('db_units.name')->get();
            $component['db_unit'] = $unit[0]->name;
        }
        $data['components'] = $components;
        return Response::json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Meal::findOrFail($id);
        $components = Meal::find($id)->component;
        foreach($components as $component)
        {
            $unit = DB::table('components')->where('components.id', $component->id)->join('db_units', 'components.db_unit_id', '=', 'db_units.id')->select('db_units.name')->get();
            $component['db_unit'] = $unit[0]->name;
        }
        $data['components'] = $components;
        return Response::json($data);
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
        $validatedData = $this->validate($request, [
            'name' => 'required',
            'recipe' => '',
        ]);
        
        try
        {
            $components = [];
            $amounts = [];
            if(isset($_POST["editComponents"]) && isset($_POST["editAmounts"]))
            {
                $components = $_POST['editComponents'];
                $amounts = $_POST['editAmounts'];
            }

            if(!empty($components) && !empty($amounts))
            {
                $meal = Meal::find($id);

                $meal->name = $request->input('name');
                $meal->recipe = $request->input('recipe');

                $meal->save();

                //Delete Relation to Components
                DB::table('components_meals')->where('meal_id', $id)->delete();

                $first = 0;
                foreach($components as $cnt => $component) 
                {
                    $amount = $amounts[$cnt];
                    $meal->component()->attach($component, ['amount' => $amount]);
                }

                $notification = array(
                    'message' => 'Speise wurde geändert!',
                    'alert-type' => 'success'
                );
            }
            else
            {
                $notification = array(
                    'message' => 'Keine Komponenten angegeben!',
                    'alert-type' => 'error'
                );
            }
        }
        catch(\Illuminate\Database\QueryException $ex)
        {
            $notification = array(
                'message' => 'Speise wurde nicht geändert!',
                'alert-type' => 'error'
            );
        }
        return redirect('/tables')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try
        {
            DB::table('components_meals')->where('meal_id', $id)->delete();
            DB::table('meals_menus')->where('meal_id', $id)->delete();
            DB::table('meals')->where('id', $id)->delete();

            $notification = array(
                'message' => 'Speise wurde gelöscht!',
                'alert-type' => 'success'
            );
        }
        catch(\Illuminate\Database\QueryException $ex)
        {
            $notification = array(
                'message' => 'Speise kann nicht gelöscht werden!',
                'alert-type' => 'error'
            );
        }
        return redirect('/tables')->with($notification);;
    }
}
