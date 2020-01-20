<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Customer;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = DB::select('select * from customers order by name asc');

        return view('/customer', ['customers' => $customers,]);
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
            'adults' => '',
            'childrens' => '',
        ]);

        $customer = new Customer;

        $customer->name = $request->input('name');
        $customer->street = $request->input('street');
        $customer->house_number = $request->input('house_number');
        $customer->postcode = $request->input('postcode');
        $customer->place = $request->input('place');
        $customer->adults = $request->input('adults');
        $customer->childrens = $request->input('childrens');


        $customer->save();

        $notification = array(
            'message' => 'Kunde wurde hinzugefügt!',
            'alert-type' => 'success'
        );

        return redirect('/customer')->with($notification); 
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
            'adults' => '',
            'childrens' => '',
        ]);

        $customer = Customer::find($id);

        $customer->name = $request->input('name');
        $customer->street = $request->input('street');
        $customer->house_number = $request->input('house_number');
        $customer->postcode = $request->input('postcode');
        $customer->place = $request->input('place');
        $customer->adults = $request->input('adults');
        $customer->childrens = $request->input('childrens');

        $customer->save();

        $notification = array(
            'message' => 'Kunde wurde geändert!',
            'alert-type' => 'success'
        );

        return redirect('/customer')->with($notification); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('customers')->where('id', $id)->delete();

        $notification = array(
            'message' => 'Kunde wurde gelöscht!',
            'alert-type' => 'success'
        );
        
        return redirect('/customer')->with($notification);;
    }
}
