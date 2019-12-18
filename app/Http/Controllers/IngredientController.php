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
            'supplier' => '',
            'unit' => 'required'
        ]);

        $ingredient = new Ingredient;

        $ingredient->name = $request->input('name');
        $ingredient->supplier = $request->input('supplier');
        $ingredient->unit = $request->input('unit');

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
        $showingredient = Ingredient::find($id);
        return redirect('/tables');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
        $notification = array(
            'message' => 'Zutat wurde gelöscht!',
            'alert-type' => 'success'
        );

        DB::table('allergene_ingredient')->where('ingredient_id', $id)->delete();
        DB::table('ingredients')->where('id', $id)->delete();
        return redirect('/tables')->with($notification);;

        
    }
}
