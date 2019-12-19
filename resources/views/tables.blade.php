@extends('layouts.app')
@push('styles')
    <link href="{{ asset('css/style_tables.css') }}" rel="stylesheet">
@endpush
@section('content') 
<div class="container-fluid row m-0 p-0 vh-100">
    <div class="col-4 m-0 py-3 pr-2 pl-3 h-100" style="display: flex;
    flex-direction:column;">
        <h1 class="">Zutaten</h1>
        <button type="button" class="btn float-right" data-toggle="modal" data-target="#addingredient"><i class="fas fa-plus"></i> Zutat</button>
        <div class="bg-white" style="flex: 1">
            <div class="container p-2">
                <input class="form-control" id="SearchIngredient" type="text" placeholder="Search..">
                <hr class="m-2" style="border:solid #CCDB75 1px;">
            </div>
            <ul class="list-group p-2 overflow-auto" id="ListIngredient">
                @foreach ($ingredients as $ingredient)
                    <li class="list-group-item bg-light rounded my-1 border-0">
                        {{ $ingredient->name }}
                        {{-- Button SHOW Ingredient Modal --}}
                        <div class="btn-group">
                            <form action="{{ url('ingredient' , $ingredient->id ) }}" method="POST">
                                @csrf
                                @method('GET')
                                <button class="btn px-2 py-0 shadow-none"><i class="fas fa-trash-alt"></i></button> 
                            </form>
                        </div>
                        <div class="btn-group float-right">
                            {{-- Button EDIT Ingredient MODAL --}}
                            <button type="button" class="btn px-2 py-0 shadow-none" data-toggle="modal" data-target="#editingredientmodal"><i class="fas fa-edit"></i></button>
                            {{-- Button DELETE Ingredient  --}}
                            <form action="{{ url('ingredient' , $ingredient->id ) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn px-2 py-0 shadow-none"><i class="fas fa-trash-alt"></i></button> 
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="col-4  m-0 py-3 px-2" style="display: flex;
    flex-direction:column;">
        <h1>Komponenten</h1>
        <div class="bg-white" style="flex: 1">
            <h3>test</h3>
        </div>
    </div>
    <div class="col-4  m-0 py-3 px-2" style="display: flex;
    flex-direction:column;">
        <h1>Speisen</h1>
        <div class="bg-white" style="flex: 1">
            <h3>test</h3>
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
                                            <option data-value="{{ $supplier->id}}" value="{{ $supplier->name }}">
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
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <div class="form-group mb-0">
                            <div class="col offset-md-4">
                                <button type="submit" class="btn">
                                    {{ __('Speichern') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>  
    
    {{-- MODAL -> SHOW Ingredient --}}
    
</div>
@endsection
