<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Customer;
use Redirect,Response;
use Mapper;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $customers = DB::select('select * from customers order by name asc');
        Mapper::map( 48.345118, 7.873039,['title'=>'Home Cateringfirma', 'icon' => '/img/home50.png']);
        foreach ($customers as $customer){
            $loc = null;
            try{
            $adr = ''.$customer->postcode . ' +'. $customer->place . ', ' . $customer->street . ' +' . $customer->house_number; 
            $loc =  Mapper::location($adr);
        }catch (\Exception $e) {
            $request->session()->flash('alert-type' ,'error');
            $request->session()->flash('message' , 'Es konnten nicht alle Kunden angezeigt werden! Bitte Adressen überprüfen.');
        }
        if ($loc != null) {
            Mapper::informationWindow($loc->getLatitude(), $loc->getLongitude(), $customer->name . '<br>'. $customer->street .' '. $customer->house_number . '<br>' . $customer->postcode . ' '. $customer->place, ['open' => false, 'title'=>$customer->name]);
        }
    }
        $adultsTotal = DB::select('select COUNT(name) AS cntCustomers, SUM(adults) AS sumAdults, SUM(childrens) AS sumChildrens from customers');
        $cntCustomers = 0;
        $sumAdults = 0;
        $sumChildrens = 0;

        foreach($adultsTotal as $adult){
            $cntCustomers += $adult->cntCustomers;
            $sumAdults += $adult->sumAdults;
            $sumChildrens += $adult->sumChildrens;
        }
        return view('/customer', [
            'customers' => $customers,
            'cntCustomers' => $cntCustomers,
            'sumAdults' => $sumAdults,
            'sumChildrens' => $sumChildrens
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
            'adults' => '',
            'childrens' => '',
        ]);
        try
        {
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
        }
        catch(\Illuminate\Database\QueryException $ex)
        {
            $notification = array(
                'message' => 'Kunde nicht hinzugefügt!',
                'alert-type' => 'error'
            ); 
        }
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
        $data = Customer::findOrFail($id);
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
        $data = Customer::findOrFail($id);
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
            'adults' => '',
            'childrens' => '',
        ]);

        try
        {
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
        }
        catch(\Illuminate\Database\QueryException $ex)
        {
            $notification = array(
                'message' => 'Kunde wurde nicht geändert!',
                'alert-type' => 'error'
            );
        }
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
        try
        {
            DB::table('customers')->where('id', $id)->delete();

            $notification = array(
                'message' => 'Kunde wurde gelöscht!',
                'alert-type' => 'success'
            );
        }
        catch(\Illuminate\Database\QueryException $ex)
        {
            $notification = array(
                'message' => 'Kunde wurde nicht gelöscht!',
                'alert-type' => 'error'
            );
        }
        return redirect('/customer')->with($notification);;
    }
}
