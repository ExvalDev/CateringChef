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
            $component = new Component;

            $component->name = $request->input('name');
            $component->amount = $request->input('amount');
            $component->recipe = $request->input('recipe');
            $component->db_unit_id = $request->input('db_unit_id');

            $component->save();

            if(!empty($ingredients) && !empty($amounts))
            {
                foreach($ingredients as $cnt => $ingredient) 
                {
                    $amount = $amounts[$cnt+1];
                    $component->ingredient()->attach($ingredient, array('amount' => $amount));
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
