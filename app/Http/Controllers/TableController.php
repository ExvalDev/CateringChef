<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Ingredient;

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
        $ingredients = DB::select('select * from ingredients order by name asc');
        $allergenes = DB::select('select * from allergenes');
        $suppliers = DB::select('select * from suppliers');
        return view('/tables', ['ingredients' => $ingredients, 'allergenes' => $allergenes, 'suppliers' => $suppliers]);
    }
}
