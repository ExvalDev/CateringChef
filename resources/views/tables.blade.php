@extends('layouts.app')
@push('styles')
    <link href="{{ asset('css/style_tables.css') }}" rel="stylesheet">
@endpush
@section('content')
<div class="container-fluid row m-0 p-0 vh-100">
    {{-- Zutaten --}}
    <div class="col-md-4 m-0 py-3 px-2 tableHeight">
        <h1>Zutaten</h1>
        <div class="bg-white shadow-sm  h-100 mh-100 d-flex flex-column">
            <div class="">
                <div class="px-2 pt-2 m-0">
                    <input class="form-control bg-light border-0 shadow-none" id="SearchIngredient" type="text" placeholder="Search..">
                </div>   
                <hr class="p-0 my-2"/>
                <div class="d-flex flex-row-reverse m-2 p-0">
                    <button type="button" class="btn p-0 btn-primary shadow-none" data-toggle="modal" data-target="#addingredient"><h2 class="mdi mdi-plus m-0"></h2></button>
                </div>
                <hr class="p-0 my-2"/>
            </div>
            <div data-simplebar class="h-100 mh-100 p-2 overflow-auto">
                <ul class="list-group" id="ListIngredient">
                    @foreach ($ingredients as $ingredient)
                        <li class="list-group-item bg-light rounded my-1 p-2 border-0 d-flex">
                            <span class="h-100 mh-100 align-self-center text-dark font-weight-bold" > {{ $ingredient->name }}</span>   
                            <div class="btn-group ml-auto align-self-center ">
                                {{-- Button EDIT Ingredient MODAL --}}
                                <button type="button" class="btn px-0 shadow-none" data-toggle="modal" data-target="#editingredientmodal"><h2 class="mdi mdi-pencil-outline m-0"></button>
                                {{-- Button DELETE Ingredient  --}}
                                <form action="{{ url('ingredient' , $ingredient->id ) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn px-0 shadow-none"><h2 class="mdi mdi-delete-outline m-0"></i></button> 
                                </form>
                                {{-- Button SHOW Ingredient Modal --}}
                                <form action="{{ url('ingredient' , $ingredient->id ) }}" method="POST">
                                    @csrf
                                    @method('GET')
                                    <button class="btn px-0 shadow-none"><h2 class="mdi mdi-information-variant m-0"></button> 
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul> 
            </div>
        </div>
    </div>

    <div class="col-md-4 m-md-0 m-0 mt-4 py-3 px-2 tableHeight">
        <h1>Komponenten</h1>
        <div class="bg-white shadow-sm h-100 mh-100 d-flex flex-column">
            <div>
                
            </div>
            <div class="h-100 mh-100 p-2 overflow-auto">
                {{-- Inser List Components here --}} 
            </div>
        </div>
    </div>

    <div class="col-md-4 m-md-0 m-0 mt-4 py-3 px-2 tableHeight">
        <h1>Speisen</h1>
        <div class="bg-white shadow-sm h-100 mh-100 d-flex flex-column">
            <div>
                
            </div>
            <div class="h-100 mh-100 p-2 overflow-auto">
                {{-- Inser List Meal here --}}
            </div>
        </div>
    </div>

    

    {{-- MODAL -> ADD Ingredient --}}
    <div id="addingredient" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3><i class="fas fa-plus"></i> Zutat</h3>
                    <a class="close" data-dismiss="modal">×</a>
                </div>
                <form action="{{ action('IngredientController@store') }}" method="POST">
                    <div class="modal-body">
                            @csrf
                            <div class="form-group">            
                                <div class="col">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Name" autocomplete="name" autofocus required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col">
                                    <div class="form-check allergene p-0">
                                        @foreach($allergenes as $allergene)
                                            <input class="form-check-input" id="{{ $allergene->name }}" type="checkbox" name="allergene[]" value="{{ $allergene->id }}">
                                            <label class="form-check-label" for="{{ $allergene->name }}">{{ $allergene->name }}</label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col">
                                    <input list="suppliers" class="form-control @error('supplier_id') is-invalid @enderror" name="supplier_id" value="{{ old('supplier_id') }}" placeholder="Lieferant" autocomplete="supplier_id" autofocus>
                                    <datalist id="suppliers">
                                        @foreach($suppliers as $supplier)
                                            <option value="{{ $supplier->id}}">{{ $supplier->name }}</option>
                                        @endforeach
                                    </datalist>
                                    @error('supplier_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col">
                                    <input type="text" class="form-control @error('unit') is-invalid @enderror" name="unit" value="{{ old('unit') }}" placeholder="Einheit" autocomplete="unit" autofocus required>                    
                                    @error('unit')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <div class="btn-group">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
                            <button type="submit" class="btn btn-primary">
                                {{ __('Speichern') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>  
    
    {{-- MODAL -> SHOW Ingredient --}}
    
</div>
@endsection
