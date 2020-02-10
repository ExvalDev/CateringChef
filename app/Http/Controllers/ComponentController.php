<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Redirect,Response;
use App\Component;


class ComponentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allComponents = Component::all();
        foreach($allComponents as $component)
        {
            $unit = DB::table('components')->where('components.id', $component->id)->join('db_units', 'components.db_unit_id', '=', 'db_units.id')->select('db_units.name')->get();
            $component['db_unit'] = $unit[0]->name;
        }
        return Response::json($allComponents);
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
            'amount' => 'required',
            'recipe' => '',
            'db_unit_id' => 'required'
        ]);
        try
        {
            $ingredients = [];
            $amounts = [];
            if(isset($_POST["ingredients"]) && isset($_POST["amounts"]))
            {
                $ingredients = $_POST['ingredients'];
                $amounts = $_POST['amounts'];
            }
            if(!empty($ingredients) && !empty($amounts))
            {
                $component = new Component;

                $component->name = $request->input('name');
                $component->amount = $request->input('amount');
                $component->recipe = $request->input('recipe');
                $component->db_unit_id = $request->input('db_unit_id');

                $component->save();

                foreach($ingredients as $cnt => $ingredient) 
                {
                    $amount = $amounts[$cnt+1];
                    $component->ingredient()->attach($ingredient, ['amount' => $amount]);
                }

                $notification = array(
                    'message' => 'Komponente wurde hinzugefügt!',
                    'alert-type' => 'success'
                );
            }
            else
            {
                $notification = array(
                    'message' => 'Keine Zutaten angegeben!',
                    'alert-type' => 'error'
                );
            }
        }
        catch(\Illuminate\Database\QueryException $ex)
        {
            $notification = array(
                'message' => 'Komponente wurde nicht hinzugefügt!',
                'alert-type' => 'error'
            );
        }
        return redirect('/tables')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Component  $component
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Component::findOrFail($id);
        $unit = DB::table('components')->where('components.id', $id)->join('db_units', 'components.db_unit_id', '=', 'db_units.id')->select('db_units.name')->get();
        $data['db_unit'] = $unit[0]->name;
        $ingredients = Component::find($id)->ingredient;
        foreach($ingredients as $ingredient)
        {
            $unit = DB::table('ingredients')->where('ingredients.id', $ingredient->id)->join('db_units', 'ingredients.db_unit_id', '=', 'db_units.id')->select('db_units.name')->get();
            $ingredient['db_unit'] = $unit[0]->name;
        }
        $data['ingredients'] = $ingredients;
        return Response::json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Component  $component
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Component::findOrFail($id);
        $unit = DB::table('components')->where('components.id', $id)->join('db_units', 'components.db_unit_id', '=', 'db_units.id')->select('db_units.name')->get();
        $data['db_unit'] = $unit[0]->name;
        $ingredients = Component::find($id)->ingredient;
        foreach($ingredients as $ingredient)
        {
            $unit = DB::table('ingredients')->where('ingredients.id', $ingredient->id)->join('db_units', 'ingredients.db_unit_id', '=', 'db_units.id')->select('db_units.name')->get();
            $ingredient['db_unit'] = $unit[0]->name;
        }
        $data['ingredients'] = $ingredients;
        return Response::json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Component  $component
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $this->validate($request, [
            'name' => 'required',
            'amount' => 'required',
            'recipe' => '',
            'db_unit_id' => 'required'
        ]);

        try
        {
            $ingredients = [];
            $amounts = [];
            if(isset($_POST["editIngredients"]) && isset($_POST["editAmounts"]))
            {
                $ingredients = $_POST['editIngredients'];
                $amounts = $_POST['editAmounts'];
            }
            if(!empty($ingredients) && !empty($amounts))
            {
                
                $component = Component::find($id);

                $component->name = $request->input('name');
                $component->amount = $request->input('amount');
                $component->recipe = $request->input('recipe');
                $component->db_unit_id = $request->input('db_unit_id');

                $component->save();
                
                //Delete Relation to Ingredients
                DB::table('components_ingredients')->where('component_id', $id)->delete();

                $first = 0;
                foreach($ingredients as $cnt => $ingredient) 
                {
                    $amount = $amounts[$cnt+1];
                    $component->ingredient()->attach($ingredient, ['amount' => $amount]);
                }

                $notification = array(
                    'message' => 'Komponente wurde geändert!',
                    'alert-type' => 'success'
                );
            }
            else
            {
                $notification = array(
                    'message' => 'Keine Zutaten angegeben!',
                    'alert-type' => 'error'
                );
            }
        }
        catch(\Illuminate\Database\QueryException $ex)
        {
            $notification = array(
                'message' => 'Komponente wurde nicht geändert!',
                'alert-type' => 'error'
            );
        }
        return redirect('/tables')->with($notification);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Component  $component
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try
        {
            DB::table('components_ingredients')->where('component_id', $id)->delete();
            DB::table('components')->where('id', $id)->delete();

            $notification = array(
                'message' => 'Komponente wurde gelöscht!',
                'alert-type' => 'success'
            );
        }
        catch(\Illuminate\Database\QueryException $ex)
        {
            $notification = array(
                'message' => 'Komponente wurde nicht gelöscht!',
                'alert-type' => 'error'
            );
        }
        return redirect('/tables')->with($notification);;
    }
}
