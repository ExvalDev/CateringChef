<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TablesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
  
    public function show()
    {
        $ingredients = DB::select('select * from ingredients');

        return view('/tables', ['ingredients' => $ingredients]);
    }

    public function create()
    {
        return view('ingredients.create');
    }

    public function store()
    {
        $data = request()->validate([
            'name' => 'required',
            'supplier' => '',
            'unit' => ''
        ]);

        DB::table('ingredients')->insert(
            ['name' => $data['name'], 'supplier' => $data['supplier'], 'unit' => $data['unit']]
        );

        return redirect('/tables');

    }
}
