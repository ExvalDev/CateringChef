@extends('layouts.app')
@section('content') 
<div class="container-fluid row m-0 p-0 vh-100">
    <div class="col-4 m-0 py-3 pr-2 pl-3 h-100" style="display: flex;
    flex-direction:column;">
        <h1 class="">Zutaten</h1>
        <div class="bg-white" style="flex: 1">
            <h2>test</h2>
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
                                    <div class="form-check form-check">
                                        @foreach($allergenes as $allergene)
                                        <input class="form-check-input" type="checkbox" name="{{ $allergene->name}}" value="{{ $allergene->id }}">
                                        <label class="form-check-label" for="inlineCheckbox">{{ $allergene->name }}</label><br>
                                        @endforeach
                                    </div>
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
</div>
@endsection
