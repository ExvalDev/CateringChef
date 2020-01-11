<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Component;
use App\Ingredient;
use Validator;

class ComponentController extends Controller
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
            'db_unit' => 'required'
        ]);

        $component = new Component;

        $ingredient->name = $request->input('name');
        $ingredient->recipe = $request->input('recipe');
        $ingredient->db_unit_id = $request->input('db_unit');

        $ingredient->save();

        $notification = array(
            'message' => 'Zutat wurde hinzugefügt!',
            'alert-type' => 'success'
        );
        
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
        $notification = array(
            'message' => 'Komponente wurde gelöscht!',
            'alert-type' => 'success'
        );

        DB::table('components_ingredients')->where('component_id', $id)->delete();
        DB::table('components')->where('id', $id)->delete();
        return redirect('/tables')->with($notification);;
    }
}
