@extends('layouts.app')
@section('content')
<div class="container-fluid row m-0 p-0 vh-100">
    {{------------------------------------ Supplier Table ------------------------------------}}
    <div class="col-8 m-0 py-3 px-2 tableHeight">
        <div class="row">
            <h1 class="col-3"> Lieferant</h1>
            <h1 class="col-4"> &nbsp; </h1>
            <div class=" col-5 pr-3">
                <input class="form-control bg-white border-0 shadow-none" id="SearchSupplier" type="text" placeholder="Suche..">
            </div>
        </div>
        <div class="bg-white shadow-sm h-100 mh-100 d-flex flex-column">
            {{-- Header --}}
            <div class="d-flex flex-column"> 
                <table class=" mt-2 w-100">
                    <thead>
                        <tr class="row mx-2">
                            <th scope="col" class="col-3 pl-2 my-auto"><h3>Name</h3></th>
                            <th scope="col" class="col-3 pl-2 my-auto"></th>
                            <th scope="col" class="col-3 pl-2 my-auto"></th>
                            <th scope="col" class="col-3 pl-2 pr-0">
                                <button type="button" class="btn py-0 px-2 btn-primary shadow-none float-right" data-toggle="modal" data-target="#addsupplier"><i class="fas fa-plus"></i></button>
                            </th>
                        </tr>
                    </thead>
                </table>
                <hr class="w-100 my-2"/>
            </div>
            {{-- Content area --}}
            <div data-simplebar class="h-100 mh-100 p-2 overflow-auto">
                <table class="table table-borderless">
                    <tbody id="TableSupplier">
                        @foreach ($suppliers as $supplier)
                            <tr class="row mx-0 mb-2 bg-light rounded">
                                <td class="col-3 searchItem"><h4>{{ $supplier->name }}</h4></td>
                                <td class="col-3"></td>
                                <td class="col-3"></td>
                                <td class="col-3">
                                    <div class="btn-group float-right">
                                        {{-- Button SHOW Supplier Modal --}}
                                        <button type="button" id={{ $supplier->id }} class="btn p-0 my-0 mx-2 shadow-none showSupplierButton"><i class="fas fa-info"></i></button>
                                        {{-- Button EDIT Supplier MODAL --}}
                                        <button type="button" id={{ $supplier->id }} class="btn p-0 my-0 mx-2 shadow-none editSupplierButton"><i class="fas fa-pen"></i></button>
                                        {{-- Button DELETE Supplier  --}}
                                        <button type="button" id={{ $supplier->id }} class="btn p-0 my-0 mx-2 shadow-none deleteSupplierButton"><i class="fas fa-trash"></i></button>
                                    </div>
                                </td>  
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div> 
        </div>
    </div>
    {{------------------------------------- Supplier Right Area -------------------------------------}}
    <div class="col-4 m-0 pb-4 pt-3 px-2 tableHeight">
        <h1> &nbsp; </h1>
        {{------------------------------------- Supplier Map -------------------------------------}}
        <div class="bg-white shadow-sm h-50 mh-50  mb-2 d-flex flex-column" id="mapContainer">
            

        </div>
        {{------------------------------------ Supplier Stats ------------------------------------}}
        <div class="bg-white shadow-sm h-50 mh-50 d-flex flex-column">
            <h2 class="pt-2 px-2">Auswertung</h2>
            <hr class="w-100 my-2"/>
            <table class="table table-borderless">
                <tbody>
                    <tr class="row mx-0">
                        <td class="col-6 text-right"><h4>Anzahl Lieferanten: </h4></td>
                        <td class="col-6"><h4>{{$countSuppliers}}</h4></td>
                    </tr>
                    <tr class="row mx-0">
                        <td class="col-6 text-right"></td>
                        <td class="col-6"></td>
                    </tr>
                    <tr class="row mx-0">
                        <td class="col-6 text-right"></td>
                        <td class="col-6"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- MODAL -> ADD Supplier --}}
<div id="addsupplier" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-plus"></i> Lieferant</h3>
                <a class="close" data-dismiss="modal">×</a>
            </div>
            <form action="{{ action('SupplierController@store') }}" method="POST">
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

{{-- MODAL -> SHOW Supplier --}}
<div id="showSupplierModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1>Details</h1>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="showSupplier">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Schließen</button>
            </div>
        </div>
    </div>
</div>

{{-- MODAL -> EDIT Supplier --}}
<div id="editSupplierModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Lieferant</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="/supplier" method="POST" id="editSupplierForm">
                @method('PUT')
                @csrf
                <div class="modal-body" id="editSupplier"></div>
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

{{-- MODAL -> DELETE Supplier --}}
<div id="deleteSupplierModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Lieferant löschen</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="/supplier" method="POST" id="deleteSupplierForm">
                @csrf
                @method('DELETE')
                <div class="modal-body" id="editSupplier">
                   <span>Wollen Sie wirklich diesen Lieferant löschen ?</span> 
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Löschen</button>              
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
