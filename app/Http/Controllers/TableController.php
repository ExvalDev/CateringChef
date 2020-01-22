<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TableController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ingredients = DB::select('select I.*, U.name AS unit from ingredients I, db_units U WHERE I.db_unit_id = U.id order by name asc');
        $components = DB::select('select * from components order by name asc');
        $meals = DB::select('select * from meals order by name asc');
        $allergenes = DB::select('select * from allergenes');
        $suppliers = DB::select('select * from suppliers');
        $db_units =DB::select('select * from db_units');

        return view('/tables', ['ingredients' => $ingredients, 
                                'components' => $components,
                                'meals' => $meals,
                                'allergenes' => $allergenes, 
                                'suppliers' => $suppliers,
                                'db_units' => $db_units,
                                ]);
    }
}
