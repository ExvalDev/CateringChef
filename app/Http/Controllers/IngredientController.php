<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            'supplier_name' => '',
            'db_unit_id' => 'required'
        ]);
        $ingredient = new Ingredient;

        $ingredient->name = $request->input('name');
        $supplier_name = $request->input('supplier_name');
        $supplier_id =  DB::table('suppliers')->select('id')->where('name', $supplier_name)->get();
        $ingredient->supplier_id = $supplier_id[0]->id;
        $ingredient->db_unit_id = $request->input('db_unit_id');

        $ingredient->save();

        $allergenes = $request->allergene;
        foreach ($allergenes as $allergene)
	    {
            $ingredient->allergene()->attach($allergene);
        }
    
        $notification = array(
            'message' => 'Zutat wurde hinzugefügt!',
            'alert-type' => 'success'
        );

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
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return 'Test';
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
            'editname' => 'required',
            'editsupplier_name' => '',
            'editdb_unit_id' => 'required'
        ]);
        
        //Add new Ingredient
        $ingredient = new Ingredient;

        $ingredient->name = $request->input('editname');
        $supplier_name = $request->input('editsupplier_name');
        $supplier_id =  DB::table('suppliers')->select('id')->where('name', $supplier_name)->get();
        $ingredient->supplier_id = $supplier_id[0]->id;
        $ingredient->db_unit_id = $request->input('editdb_unit_id');

        $ingredient->save();

        $allergenes = $request->editallergene;
        foreach ($allergenes as $allergene)
	    {
            $ingredient->allergene()->attach($allergene);
        }
    
        //Delete old Ingredient
        DB::table('allergenes_ingredients')->where('ingredient_id', $id)->delete();
        DB::table('components_ingredients')->where('ingredient_id', $id)->delete();
        DB::table('ingredients')->where('id', $id)->delete();

        $notification = array(
            'message' => 'Zutat wurde geändert!',
            'alert-type' => 'success'
        );

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
        $notification = array(
            'message' => 'Zutat wurde gelöscht!',
            'alert-type' => 'success'
        );

        DB::table('allergenes_ingredients')->where('ingredient_id', $id)->delete();
        DB::table('components_ingredients')->where('ingredient_id', $id)->delete();
        DB::table('ingredients')->where('id', $id)->delete();
        return redirect('/tables')->with($notification);;

        
    }
}
