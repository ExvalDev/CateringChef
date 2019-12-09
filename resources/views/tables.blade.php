@extends('layouts.app')

@section('content')
    <div class="container p-0 float-left">
        <h1 class="float-left m-0">Zutat</h1>
        <button type="button" class="btn float-right" data-toggle="modal" data-target="#addingredient"><i class="fas fa-plus"></i> Zutat</button>
    </div>
    <div class="container bg-white p-0 float-left">
        <div class="container p-2">
            <input class="form-control" id="SearchZutat" type="text" placeholder="Search..">
            <hr class="m-2" style="border:solid #CCDB75 1px;">
        </div>
        <ul class="list-group p-2 overflow-auto" id="ListZutat">
            @foreach ($ingredients as $ingredient)
                <li class="list-group-item bg-light rounded my-1 border-0">
                    {{-- Button for more Information --}}
                    {{ $ingredient->name }}
                    <div class="btn-group">
                        <form action="{{ url('ingredient' , $ingredient->id ) }}" method="POST">
                            @csrf
                            @method('SHOW')
                            <button class="btn px-2 py-0 shadow-none"><i class="fas fa-info-circle"></i></button> 
                        </form>
                    </div>
                    <div class="btn-group float-right">
                        {{-- Button open add Ingredient Modal --}}
                        <button type="button" class="btn px-2 py-0 shadow-none" data-toggle="modal" data-target="#editingredientmodal"><i class="fas fa-edit"></i></button>
                        {{-- Button delete Ingredient  --}}
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


    {{-- MODAL -> Add Ingredient --}}
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
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Name" autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col">
                                    <input type="text" class="form-control @error('supplier') is-invalid @enderror" name="supplier" value="{{ old('supplier') }}" placeholder="Lieferant" autocomplete="supplier" autofocus>
                                    @error('supplier')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col">
                                    <input type="text" class="form-control @error('unit') is-invalid @enderror" name="unit" value="{{ old('unit') }}" placeholder="Einheit" autocomplete="unit" autofocus>                    
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
@endsection
