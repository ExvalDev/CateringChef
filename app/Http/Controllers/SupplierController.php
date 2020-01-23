<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Supplier;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = DB::select('select * from suppliers');
        $totalSuppliers = DB::select('select count(*) AS count from suppliers');
        $countSuppliers = 0;
        foreach ($totalSuppliers as $supplier)
        {
            $countSuppliers += $supplier->count;
        }

        return view('/supplier', [
            'suppliers' => $suppliers,
            'countSuppliers' => $countSuppliers,
            ]);
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
            'street' => 'required',
            'house_number' => 'required',
            'postcode' => 'required',
            'place' => 'required',
        ]);
        try
        {
            $supplier = new Supplier;

            $supplier->name = $request->input('name');
            $supplier->street = $request->input('street');
            $supplier->house_number = $request->input('house_number');
            $supplier->postcode = $request->input('postcode');
            $supplier->place = $request->input('place');

            $supplier->save();

            $notification = array(
                'message' => 'Lieferant wurde hinzugefügt!',
                'alert-type' => 'success'
            );
        }
        catch(\Illuminate\Database\QueryException $ex)
        {
            $notification = array(
                'message' => 'Lieferant nicht hinzugefügt!',
                'alert-type' => 'error'
            ); 
        }
        return redirect('/supplier')->with($notification);
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
        $validatedData = $this->validate($request, [
            'name' => 'required',
            'street' => 'required',
            'house_number' => 'required',
            'postcode' => 'required',
            'place' => 'required',
        ]);

        try
        {
            $supplier = Supplier::find($id);

            $supplier->name = $request->input('name');
            $supplier->street = $request->input('street');
            $supplier->house_number = $request->input('house_number');
            $supplier->postcode = $request->input('postcode');
            $supplier->place = $request->input('place');

            $supplier->save();

            $notification = array(
                'message' => 'Lieferant wurde geändert!',
                'alert-type' => 'success'
            );
        }
        catch(\Illuminate\Database\QueryException $ex)
        {
            $notification = array(
                'message' => 'Lieferant wurde nicht geändert!',
                'alert-type' => 'error'
            );
        }
        return redirect('/supplier')->with($notification); 
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
            DB::table('suppliers')->where('id', $id)->delete();

            $notification = array(
                'message' => 'Lieferant wurde gelöscht!',
                'alert-type' => 'success'
            );
        }
        catch(\Illuminate\Database\QueryException $ex)
        {
            $notification = array(
                'message' => 'Lieferant wurde nicht gelöscht!',
                'alert-type' => 'error'
            );
        }
        return redirect('/supplier')->with($notification);;
    }
}
