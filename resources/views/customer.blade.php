@extends('layouts.app')
@push('styles')
    <link href="{{ asset('css/style_customers.css') }}" rel="stylesheet">

@endpush
@section('content')
<div class="container-fluid row m-0 p-0 vh-100">
    {{------------------------------------ Customers Table ------------------------------------}}
    <div class="col-8 m-0 py-3 px-2 tableHeight">
        <div class="row">
            <h1 class="col-3"> Kunden</h1>
            <h1 class="col-4"> &nbsp; </h1>
            <div class=" col-5 pr-3">
                <input class="form-control bg-white border-0 shadow-none" id="SearchCustomer" type="text" placeholder="Suche..">
            </div>
        </div>
        <div class="bg-white shadow-sm h-100 mh-100 d-flex flex-column">
            {{-- Header --}}
            <div class="d-flex flex-column"> 
                <table class=" mt-2 w-100">
                    <thead>
                        <tr class="row mx-2">
                            <th scope="col" class="col-3 pl-2 my-auto"><h3>Name</h3></th>
                            <th scope="col" class="col-3 pl-2 my-auto"><h3>Erwachsene</h3></th>
                            <th scope="col" class="col-3 pl-2 my-auto"><h3>Kinder</h3></th>
                            <th scope="col" class="col-3 pl-2 pr-0">
                                <button type="button" class="btn py-1 px-2 btn-primary shadow-none float-right" data-toggle="modal" data-target="#addcustomer"><i class="fas fa-plus"></i></button>
                            </th>
                        </tr>
                    </thead>
                </table>
                <hr class="w-100 my-2"/>
            </div>
            {{-- Content area --}}
            <div data-simplebar class="h-100 mh-100 p-2 overflow-auto">
                <table class="table table-borderless">
                    <tbody id="TableCustomer">
                        @foreach ($customers as $customer)
                            <tr class="row mx-0 mb-2 bg-light rounded">
                                <td class="col-3 searchItem"><h4>{{ $customer->name }}</h4></td>
                                <td class="col-3"><h4>{{ $customer->adults }}</h4></td>
                                <td class="col-3"><h4>{{ $customer->childrens }}</h4></td>
                                <td class="col-3">
                                    <div class="btn-group float-right">
                                        {{-- Button SHOW Customer Modal --}}
                                        <button type="button" id={{ $customer->id }} class="btn p-0 my-0 mx-2 shadow-none showCustomerButton"><i class="fas fa-info"></i></button>
                                        {{-- Button EDIT Customer MODAL --}}
                                        <button type="button" id={{ $customer->id }} class="btn p-0 my-0 mx-2 shadow-none editCustomerButton"><i class="fas fa-pen"></i></button>
                                        {{-- Button DELETE Customer  --}}
                                        <button type="button" id={{ $customer->id }} class="btn p-0 my-0 mx-2 shadow-none deleteCustomerButton"><i class="fas fa-trash"></i></button>
                                    </div>
                                </td>  
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div> 
        </div>
    </div>
    {{------------------------------------- Customers Right Area -------------------------------------}}
    <div class="col-4 m-0 pb-4 pt-3 px-2 tableHeight">
        <h1> &nbsp; </h1>
        {{------------------------------------- Customers Map -------------------------------------}}
        <div class="bg-white shadow-sm h-50 mh-50  mb-2 d-flex flex-column" id="mapContainer">
            

        </div>
        {{------------------------------------ Customers Stats ------------------------------------}}
        <div class="bg-white shadow-sm h-50 mh-50 d-flex flex-column">
            <h2 class="pt-2 px-2">Auswertung</h2>
            <hr class="w-100 my-2"/>
            <table class="table table-borderless">
                <tbody>
                    <tr class="row mx-0">
                        <td class="col-6 text-right"><h4>Anzahl Kunden: </h4></td>
                        <td class="col-6"><h4>{{$cntCustomers}}</h4></td>
                    </tr>
                    <tr class="row mx-0">
                        <td class="col-6 text-right"><h4>Anzahl Erwachsener: </h4></td>
                        <td class="col-6"><h4>{{$sumAdults}}</h4></td>
                    </tr>
                    <tr class="row mx-0">
                        <td class="col-6 text-right"><h4>Anzahl Kinder: </h4></td>
                        <td class="col-6"><h4>{{$sumChildrens}}</h4></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- MODAL -> ADD Customer --}}
<div id="addcustomer" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-plus"></i> Kunde</h3>
                <a class="close" data-dismiss="modal">×</a>
            </div>
            <form action="{{ action('CustomerController@store') }}" method="POST">
                <div class="modal-body">
                    @csrf
                    {{-- Name Input --}}
                    <div class="form-row">
                        <div class="form-group col-12">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Name" autofocus required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    {{-- Street and Housenumber --}}
                    <div class="form-row">
                        <div class="input-group col-12">
                            <input type="text" class="col-8 form-control @error('street') is-invalid @enderror" name="street" value="{{ old('street') }}" placeholder="Straße" required>
                            @error('street')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <input type="number" class="col-4 form-control rounded-right @error('house_number') is-invalid @enderror" name="house_number" value="{{ old('house_number') }}" placeholder="Nr." required>
                            @error('house_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror     
                        </div>
                    </div>

                    {{-- PLZ and City --}}
                    <div class="form-row mt-3">
                        <div class="input-group col-12">
                            <input type="number" class="col-5 form-control @error('postcode') is-invalid @enderror" name="postcode" value="{{ old('postcode') }}" placeholder="PLZ" required>
                            @error('postcode')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <input type="text" class="col-7 form-control rounded-right @error('place') is-invalid @enderror" name="place" value="{{ old('place') }}" placeholder="Ort" required>
                            @error('place')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    {{-- Adults and Childs --}}
                    <div class="form-row mt-3">
                        <div class="input-group col-12">  
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend2"><i class="fas fa-male"></i></span>
                            </div>
                            <input type="number" class="form-control @error('adults') is-invalid @enderror" name="adults" value="{{ old('adults') }}" placeholder="Erwachsene" required>
                            @error('adults')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror                            
                        
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend2"><i class="fas fa-child"></i></span>
                            </div>
                            <input type="number" class="form-control  @error('childrens') is-invalid @enderror" name="childrens" value="{{ old('childrens') }}" placeholder="Kinder" required>
                            @error('childrens')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror                             
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="btn-group">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Schließen</button> 
                        <button type="submit" class="btn btn-primary">
                            {{ __('Speichern') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>  

{{-- MODAL -> SHOW Customer --}}
<div id="showCustomerModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1>Details</h1>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="showCustomer">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Schließen</button>
            </div>
        </div>
    </div>
</div>

{{-- MODAL -> EDIT Customer --}}
<div id="editCustomerModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Kunde</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="/customer" method="POST" id="editCustomerForm">
                @method('PUT')
                @csrf
                <div class="modal-body" id="editCustomer"></div>
                <div class="modal-footer">
                    <div class="btn-group">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Schließen</button>
                        <button type="submit" class="btn btn-primary">
                            {{ __("Speichern") }}
                        </button>
                    </div> 
                </div>
            </form>
        </div>
    </div>
</div>

{{-- MODAL -> DELETE Customer --}}
<div id="deleteCustomerModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Kunde löschen</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="/customer" method="POST" id="deleteCustomerForm">
                @csrf
                @method('DELETE')
                <div class="modal-body" id="editCustomer">
                   <span>Wollen Sie wirklich diesen Kunden löschen ?</span> 
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Löschen</button>              
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
