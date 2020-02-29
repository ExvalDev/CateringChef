<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Supplier;
use Redirect,Response;
use Mapper;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Mapper::map(48.345118, 7.873039);
        $suppliers = DB::select('select * from suppliers');
        foreach ($suppliers as $supplier){
            $loc = null;
            try{
            $adr = ''.$supplier->postcode . ' +'. $supplier->place . ', ' . $supplier->street . ' +' . $supplier->house_number; 
            $loc =  Mapper::location($adr);
            }catch (\Exception $e) {
                $notification = array(
                    'message' => 'Es konnten nicht alle Lieferanten angezeigt werden! Bitte Adressen überprüfen.',
                    'alert-type' => 'error'
                );
            }
            if ($loc != null) {
                Mapper::marker( $loc->getLatitude(), $loc->getLongitude());
            }
        }
        
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
        $data = Supplier::findOrFail($id);
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
        $data = Supplier::findOrFail($id);
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
