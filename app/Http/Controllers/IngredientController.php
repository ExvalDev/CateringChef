<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Redirect,Response;
use App\Ingredient;
use App\Allergene;

class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allIngredients = Ingredient::all();
        foreach($allIngredients as $ingredient)
        {
            $unit = DB::table('ingredients')->where('ingredients.id', $ingredient->id)->join('db_units', 'ingredients.db_unit_id', '=', 'db_units.id')->select('db_units.name')->get();
            $ingredient['db_unit'] = $unit[0]->name;
        }
        return Response::json($allIngredients);
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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'supplier_name' => '',
            'db_unit_id' => 'required'
        ]);

        if ($validator->fails()) {

            $notification = array(
                'message' => 'Zutat wurde nicht hinzugefügt!',
                'alert-type' => 'error',
                'modal' => '#addIngredient',
            );

            return redirect('/tables')
            ->withErrors($validator)
            ->withInput()->with($notification);
        }

        try
        {
            $ingredient = new Ingredient;
            $ingredient->name = $request->input('name');
            $ingredient->supplier_id = $request->input('supplier');
            $ingredient->db_unit_id = $request->input('db_unit_id');
            $ingredient->save();

            $allergenes = $request->allergene;
            if (!empty($allergenes))
            {
                foreach ($allergenes as $allergene)
                {
                    $ingredient->allergene()->attach($allergene);
                }
            }
        
            $notification = array(
                'message' => 'Zutat wurde hinzugefügt!',
                'alert-type' => 'success'
            );
        }
        catch(\Illuminate\Database\QueryException $ex)
        {
            $notification = array(
                'message' => 'Zutat wurde nicht hinzugefügt!',
                'alert-type' => 'error',
            );
        } 
        return redirect('/tables')->with($notification); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Ingredient::findOrFail($id);
        $supplier = Ingredient::find($id)->supplier;
        $data['supplier'] = $supplier;
        $unit = DB::table('ingredients')->where('ingredients.id', $id)->join('db_units', 'ingredients.db_unit_id', '=', 'db_units.id')->select('db_units.name')->get();
        $data['db_unit'] = $unit[0]->name;
        $allergenes = Ingredient::find($id)->allergene;
        $data['allergenes'] = $allergenes;
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
        $data = Ingredient::findOrFail($id);
        $supplier = Ingredient::find($id)->supplier;
        $data['supplier'] = $supplier;
        $unit = DB::table('ingredients')->where('ingredients.id', $id)->join('db_units', 'ingredients.db_unit_id', '=', 'db_units.id')->select('db_units.name')->get();
        $data['db_unit'] = $unit[0]->name;
        $allergenes = Ingredient::find($id)->allergene;
        $data['allergenes'] = $allergenes;
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
        //Validation
        $validatedData = $this->validate($request, [
            'name' => 'required',
            'supplier_name' => '',
            'db_unit_id' => 'required'
        ]);
        
        try
        {
            $ingredient = Ingredient::find($id);

            $ingredient->name = $request->input('name');
            $ingredient->supplier_id = $request->input('supplier');
            $ingredient->db_unit_id = $request->input('db_unit_id');

            $ingredient->save();

            //Delete Relation to Allergenes
            DB::table('allergenes_ingredients')->where('ingredient_id', $id)->delete();

            $allergenes = $request->allergene;
            if (!empty($allergenes))
            {
                foreach ($allergenes as $allergene)
                {
                    $ingredient->allergene()->attach($allergene);
                }
            }
            
            $notification = array(
                'message' => 'Zutat wurde geändert!',
                'alert-type' => 'success'
            );
        }
        catch(\Illuminate\Database\QueryException $ex)
        {
            $notification = array(
                'message' => 'Zutat wurde nicht geändert!',
                'alert-type' => 'success'
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
            DB::table('allergenes_ingredients')->where('ingredient_id', $id)->delete();
            DB::table('ingredients')->where('id', $id)->delete();

            $notification = array(
                'message' => 'Zutat wurde gelöscht!',
                'alert-type' => 'success'
            );
        }
        catch(\Illuminate\Database\QueryException $ex)
        {
            $notification = array(
                'message' => 'Zutat kann nicht gelöscht werden! In Komponenten enthalten.',
                'alert-type' => 'error',
            );
        }
        return redirect('/tables')->with($notification);;
    }
}
