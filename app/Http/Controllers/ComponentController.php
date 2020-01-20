<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            'amount' => 'required',
            'recipe' => '',
            'db_unit_id' => 'required',
        ]);

        $component = new Component;

        $component->name = $request->input('name');
        $component->amount = $request->input('amount');
        $component->recipe = $request->input('recipe');
        $component->db_unit_id = $request->input('db_unit_id');

        $component->save();

        $ingredients = [];
        $amounts = [];
        if(isset($_POST["arrayIngredient"]))
        {
            $ingredients = $_POST['arrayIngredient'];
            $amounts = $_POST['arrayAmount'];

        }
        array_push($ingredients, $_POST['fieldAddIngredient']);
        array_push($amounts, $_POST['fieldAddAmount']);

        foreach($ingredients as $cnt => $ingredient) 
        {
            $amount = $amounts[$cnt];
            $component->ingredient()->attach($ingredient, array('amount' => $amount));
        }

        $notification = array(
            'message' => 'Komponente wurde hinzugefügt!',
            'alert-type' => 'success'
        );

        return redirect('/tables')->with($notification); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Component  $component
     * @return \Illuminate\Http\Response
     */
    public function show(Component $component)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Component  $component
     * @return \Illuminate\Http\Response
     */
    public function edit(Component $component)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Component  $component
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Component $component)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Component  $component
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
