@extends('layouts.app')
@push('styles')
    <link href="{{ asset('css/style_tables.css') }}" rel="stylesheet">
@endpush
@push('topScripts')
    <script src="{{ asset('js/tables.js') }}" defer></script>
@endpush
@section('content')
    {{------------------------------------ START ------------------------------------}}
    <div class="container-fluid row m-0 p-0 vh-100">
        {{------------------------------------ Ingredients ------------------------------------}}
        <div class="col-md-4 m-0 py-3 px-2 tableHeight">
            <h1>@lang('message.ingredients')</h1>
            <div class="bg-white shadow-sm  h-100 mh-100 d-flex flex-column">
                <div class="">
                    <div class="px-2 pt-2 m-0">
                        <input class="form-control bg-light border-0 shadow-none" id="SearchIngredient" type="text" placeholder="Suche..">
                    </div>   
                    <hr class="p-0 my-2"/>
                    <div class="d-flex flex-row-reverse m-2 p-0">
                        <button type="button" class="btn py-0 px-2 btn-primary shadow-none" data-toggle="modal" data-target="#addIngredient"><i class="fas fa-plus"></i></button>
                    </div>
                    <hr class="p-0 mt-2 mb-0"/>
                </div>
                <div data-simplebar class="h-100 mh-100 p-2 overflow-auto">
                    <ul class="list-group" id="ListIngredient">
                        @foreach ($ingredients as $ingredient)
                            <li class="list-group-item bg-light rounded my-1 px-2 py-3 border-0 d-flex">
                                <span class="h-100 mh-100 align-self-center text-dark font-weight-bold" > {{ $ingredient->name }}</span>   
                                <div class="btn-group ml-auto align-self-center">
                                    {{-- Button SHOW Ingredient Modal --}}
                                    <button type="button" id={{ $ingredient->id }} class="btn p-0 my-0 mx-2 shadow-none showIngredientButton"><i class="fas fa-info"></i></button>
                                    {{-- Button EDIT Ingredient MODAL --}}
                                    <button type="button" id={{ $ingredient->id }} class="btn p-0 my-0 mx-2 shadow-none editIngredientButton"><i class="fas fa-pen"></i></button>
                                    {{-- Button DELETE Ingredient  --}}
                                    <button type="button" id={{ $ingredient->id }} class="btn p-0 my-0 mx-2 shadow-none deleteIngredientButton"><i class="fas fa-trash"></i></button>
                                </div>
                            </li>
                        @endforeach
                    </ul> 
                </div>
            </div>
        </div>

        {{------------------------------------ Components ------------------------------------}}
        <div class="col-md-4 m-md-0 m-0 mt-4 py-3 px-2 tableHeight">
            <h1>@lang('message.components')</h1>
            <div class="bg-white shadow-sm h-100 mh-100 d-flex flex-column">
                <div>
                    <div class="px-2 pt-2 m-0">
                        <input class="form-control bg-light border-0 shadow-none" id="SearchComponent" type="text" placeholder="Suche..">
                    </div>   
                    <hr class="p-0 my-2"/>
                    <div class="d-flex flex-row-reverse m-2 p-0">
                        <button type="button" class="btn py-0 px-2 btn-primary shadow-none" data-toggle="modal" data-target="#addComponent"><i class="fas fa-plus"></i></button>
                    </div>
                    <hr class="p-0 mt-2 mb-0"/>
                </div>
                <div  data-simplebar class="h-100 mh-100 p-2 overflow-auto">
                    <ul class="list-group" id="ListComponent">
                        @foreach ($components as $component)
                            <li class="list-group-item bg-light rounded my-1 px-2 py-3 border-0 d-flex">
                                <span class="h-100 mh-100 align-self-center text-dark font-weight-bold" > {{ $component->name }}</span>   
                                <div class="btn-group ml-auto align-self-center ">
                                    {{-- Button SHOW Component Modal --}}
                                    <button type="button" id={{ $component->id }} class="btn p-0 my-0 mx-2 shadow-none showComponentButton"><i class="fas fa-info"></i></button>
                                    {{-- Button EDIT Component MODAL --}}
                                    <button type="button" id={{ $component->id }} class="btn p-0 my-0 mx-2 shadow-none infobutton editComponentButton"><i class="fas fa-pen"></i></button>
                                    {{-- Button DELETE Component  --}}
                                    <button type="button" id={{ $component->id }} class="btn p-0 my-0 mx-2 shadow-none deleteComponentButton"><i class="fas fa-trash"></i></button>
                                </div>
                            </li>
                        @endforeach
                    </ul>  
                </div>
            </div>
        </div>

        {{--------------------------------------- Meals --------------------------------------}}
        <div class="col-md-4 m-md-0 m-0 mt-4 py-3 px-2 tableHeight">
            <h1>@lang('message.meals')</h1>
            <div class="bg-white shadow-sm h-100 mh-100 d-flex flex-column">
                <div>
                    <div class="px-2 pt-2 m-0">
                        <input class="form-control bg-light border-0 shadow-none" id="SearchMeal" type="text" placeholder="Suche..">
                    </div>   
                    <hr class="p-0 my-2"/>
                    <div class="d-flex flex-row-reverse m-2 p-0">
                        <button type="button" class="btn py-0 px-2 btn-primary shadow-none" data-toggle="modal" data-target="#addMeal"><i class="fas fa-plus"></i></button>
                    </div>
                    <hr class="p-0 mt-2 mb-0"/>
                </div>
                <div  data-simplebar class="h-100 mh-100 p-2 overflow-auto">
                    <ul class="list-group" id="ListMeal">
                        @foreach ($meals as $meal)
                            <li class="list-group-item bg-light rounded my-1 px-2 py-3 border-0 d-flex">
                                <span class="h-100 mh-100 align-self-center text-dark font-weight-bold" > {{ $meal->name }}</span>   
                                <div class="btn-group ml-auto align-self-center ">
                                    {{-- Button SHOW Meal Modal --}}
                                    <button type="button" id={{ $meal->id }} class="btn p-0 my-0 mx-2 shadow-none showMealButton"><i class="fas fa-info"></i></button>
                                    {{-- Button EDIT Meal MODAL --}}
                                    <button type="button" id={{ $meal->id }} class="btn p-0 my-0 mx-2 shadow-none infobutton editMealButton"><i class="fas fa-pen"></i></button>
                                    {{-- Button DELETE Meal  --}}
                                    <button type="button" id={{ $meal->id }} class="btn p-0 my-0 mx-2 shadow-none deleteMealButton"><i class="fas fa-trash"></i></button>
                                </div>
                            </li>
                        @endforeach
                    </ul> 
                </div>
            </div>
        </div>

        {{----------------------------------- Ingredients MODAL ----------------------------------}}

        {{-- MODAL -> ADD Ingredient --}}
        <div id="addIngredient" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3><i class="fas fa-plus"></i> @lang('message.ingredient')</h3>
                        <a class="close" data-dismiss="modal">×</a>
                    </div>
                    <form action="{{ action('IngredientController@store') }}" method="POST">
                        <div class="modal-body">
                            @csrf
                            <div class="form-group">            
                                <div class="col">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="@lang('message.name')" autofocus required>
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
                                    <input list="suppliers" class="form-control @error('supplier_name') is-invalid @enderror" name="supplier_name" value="{{ old('supplier_name') }}" placeholder="@lang('message.supplier')" autocomplete="on">
                                    <datalist id="suppliers">
                                        @foreach($suppliers as $supplier)
                                            <option value="{{ $supplier->name}}">
                                        @endforeach
                                    </datalist>
                                    @error('supplier_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col">
                                    <select class="form-control @error('db_unit_id') is-invalid @enderror" name="db_unit_id" value="{{ old('db_unit_id') }}" required>
                                        <option disabled selected hidden>@lang('message.unit')</option>
                                        @foreach($db_units as $db_unit)
                                            <option value='{{ $db_unit->id }}'>{{ $db_unit->name }}</option>
                                        @endforeach
                                    </select>                    
                                    @error('db_unit_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="btn-group">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('message.close')</button> 
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
        <div id="showIngredientModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3><i class="fas fa-info"></i> @lang('message.show')</h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body" id="showIngredient">
                        <h3 id="showNameIngredient"></h3>
                        <hr>
                        <h4>@lang('message.supplier')</h4>
                        <span id="showSupplierIngredient"></span><br>
                        <hr>
                        <h4>@lang('message.unit')</h4>
                        <span id="showUnitIngredient"></span><br>
                        <hr>
                        <h4>@lang('message.allergenes')</h4>
                        <span id="showAllergenesIngredient"></span><br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('message.close')</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- MODAL -> EDIT Ingredient --}}
        <div id="editIngredientModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3><i class="fas fa-pen"></i> @lang('message.ingredient')</h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="/ingredient" method="POST" id="editIngredientForm">
                        @method('PUT')
                        @csrf
                        <div class="modal-body" id="editIngredient"></div>
                        <div class="form-group">            
                            <div class="col">
                                <input id="editNameIngredient" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="" placeholder="@lang('message.name')" autofocus required>
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
                                        <input class="form-check-input" id="edit{{ $allergene->name }}" type="checkbox" name="allergene[]" value="{{ $allergene->id }}">
                                        <label class="form-check-label" for="edit{{ $allergene->name }}">{{ $allergene->name }}</label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col">
                                <input id="editSupplierIngredient" list="suppliers" class="form-control @error('supplier_name') is-invalid @enderror" name="supplier_name" value="" placeholder="@lang('message.supplier')" autocomplete="on">
                                <datalist id="suppliers">
                                    @foreach($suppliers as $supplier)
                                        <option value="{{ $supplier->name}}">
                                    @endforeach
                                </datalist>
                                @error('supplier_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col">
                                <select id="editUnitIngredient" class="form-control @error('db_unit_id') is-invalid @enderror" name="db_unit_id" value="" required>
                                    <option disabled selected hidden>@lang('message.unit')</option>
                                    @foreach($db_units as $db_unit)
                                        <option id="editUnitIngredient{{ $db_unit->id }}" value='{{ $db_unit->id }}'>{{ $db_unit->name }}</option>
                                    @endforeach
                                </select>                    
                                @error('db_unit_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('message.close')</button>
                            <button type="submit" class="btn btn-primary">
                                {{ __("Speichern") }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- MODAL -> DELETE Ingredient --}}
        <div id="deleteIngredientModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3><i class="fas fa-trash"></i> @lang('message.ingredient') @lang('message.delete')</h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="/ingredient" method="POST" id="deleteIngredientForm">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body" id="editIngredient">
                           <span>Wollen Sie die Zutat </span><b><span id="deleteNameIngredient"></span></b><span> löschen ?</span> 
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">Löschen</button>              
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{----------------------------------- Components MODAL ----------------------------------}}

        {{-- MODAL -> ADD Component --}}
        <div id="addComponent" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3><i class="fas fa-plus"></i> @lang('message.component')</h3>
                        <a class="close" data-dismiss="modal">×</a>
                    </div>
                    <div class="modal-body">
                        <form action="{{ action('ComponentController@store') }}" method="POST" id="addComponentForm" class="mt-2">
                        @csrf
                            <div class="container p-0">
                                <ul id="progressbar">
                                    <li class="active">@lang('message.general')</li>
                                    <li>@lang('message.ingredients')</li>
                                    <li>@lang('message.recipe')</li>
                                </ul>
                                {{-- Page I --}}
                                <fieldset>
                                    <h2>@lang('message.general')</h2>
                                    {{-- name Input --}}
                                    <div class="form-row">
                                        <div class="form-group col-12">            
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="@lang('message.name')">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- Amount & Unit --}}
                                    <div class="form-row">            
                                        <div class="input-group col-12">
                                            <input type="number" min="0" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') }}" placeholder="@lang('message.amount')">
                                            @error('amount')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                            <select class="form-control @error('db_unit_id') is-invalid @enderror" name="db_unit_id" value="{{ old('db_unit_id') }}">
                                                <option disabled selected hidden> @lang('message.unit')</option>
                                                @foreach($db_units as $db_unit)
                                                    <option value='{{ $db_unit->id }}'>{{ $db_unit->name }}</option>
                                                @endforeach
                                            </select>                    
                                            @error('db_unit_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- next Page --}}
                                    <input type="button" name="next" class="next btn btn-primary float-right mt-3" value="@lang('pagination.next')">
                                </fieldset>

                                {{-- Page II --}}
                                <fieldset>
                                    <div class="d-flex">
                                        <h2>@lang('message.ingredients')</h2> 
                                    {{-- ADD Ingredient Button --}}
                                    <p class="btn py-0 px-2 btn-primary shadow-none ml-auto add-ingredient"><i class="fas fa-plus"></i></p>
                                    </div>
                                    
                                    <div class="form-container mb-3">
                                        <div class="dynamic-ingredient-area" id="dynamic-ingredient-area">
                                            {{-- START OF HIDDEN ELEMENT --}}
                                            <div class="form-row mt-2 dynamic-ingredient" style="display:none">
                                                {{-- Replace these fields --}}
                                                <div class="input-group col-12">
                                                    {{-- Choose Ingredient --}}
                                                    <select id="selectIngredientAdd" name="ingredients[]" class="form-control col-5 selectIngredientAdd" onchange="changeUnitAddIngredient()" required>
                                                        <option disabled selected hidden> @lang('message.choseIngredient')</option>
                                                        @foreach ($ingredients as $ingredient)
                                                            <option value="{{$ingredient->id}}" data-cc-unit="{{$ingredient->unit}}">{{$ingredient->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    {{-- input Amount --}}
                                                    <input type="number" min="0" class="form-control col-3" name="amounts[]" placeholder="Menge">
                                                    {{-- Unit for selected Ingredient --}}
                                                    <span class="form-control unitIngredientAdd col-3" id="unitIngredientAdd">@lang('message.unit')</span>
                                                    {{-- delete Row --}}
                                                    <div class="input-group-append d-flex col-1 px-0">
                                                        <button class="btn btn-outline-danger flex-fill delete-dynamic-ingredient" type="button"> x </button>
                                                    </div>
                                                </div>
                                                {{-- End of fields--}}
                                            </div>
                                            {{-- END OF HIDDEN ELEMENT --}}
                                            {{-- Dynamic element will be cloned here --}}
                                            {{-- You can call clone function once if you want it to show it a first element--}}
                                        </div>
                                    </div>

                                    <input type="button" name="previous" class="previous btn btn-secondary" value="@lang('pagination.previous')" />
                                    <input type="button" name="next" class="next btn btn-primary float-right" value="@lang('pagination.next')" />
                                    
                                </fieldset>
                                {{-- Page III --}}
                                <fieldset>
                                    <h2>@lang('message.recipe')</h2>
                                    <textarea name="recipe" cols="50" rows="5" class="mb-2 form-control" form="addComponentForm"></textarea>
                                    <input type="button" name="previous" class="previous btn btn-secondary" value="@lang('pagination.previous')" />
                                    <button type="submit" class="btn btn-primary float-right">
                                        {{ __('Speichern') }}
                                    </button>
                                </fieldset>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- MODAL -> SHOW Component --}}
        <div id="showComponentModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3><i class="fas fa-info"></i> @lang('message.show')</h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body" id="showComponent">
                        <h3 id="showNameComponent"></h3>
                        <hr>
                        <h4>@lang('message.amount')</h4>
                        <span id="showAmountComponent"></span> <span id="showUnitComponent"></span>
                        <hr>
                        <h4>@lang('message.ingredients')</h4>
                        <div id="showIngredientsComponent"></div>
                        <hr>
                        <h4>@lang('message.recipe')</h4>
                        <span id="showRecipeComponent"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('message.close')</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- MODAL -> EDIT Component --}}
        <div id="editComponentModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3><i class="fas fa-pen"></i> @lang('message.components')</h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="/component" method="POST" id="editComponentForm">
                        @method('PUT')
                        @csrf
                        <div class="modal-body">
                            <div class="container p-0">
                                <ul id="progressbar">
                                    <li class="active">@lang('message.general')</li>
                                    <li>@lang('message.ingredients')</li>
                                    <li>@lang('message.recipe')</li>
                                </ul>
                                {{-- Page I --}}
                                <fieldset class="fieldsetComponent">
                                    <h2>@lang('message.general')</h2>
                                    {{-- name Input --}}
                                    <div class="form-row">
                                        <div class="form-group col-12">            
                                            <input id="editNameComponent" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="" placeholder="@lang('message.name')">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- Amount & Unit --}}
                                    <div class="form-row">            
                                        <div class="input-group col-12">
                                            <input id="editAmountComponent" type="number" min="0" class="form-control @error('amount') is-invalid @enderror" name="amount" value="" placeholder="@lang('message.amount')">
                                            @error('amount')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                            <select id="editUnitComponent" class="form-control @error('db_unit_id') is-invalid @enderror" name="db_unit_id" value="">
                                                <option disabled hidden> @lang('message.unit')</option>
                                                @foreach($db_units as $db_unit)
                                                    <option id="editUnitComponent{{ $db_unit->id }}" value='{{ $db_unit->id }}'>{{ $db_unit->name }}</option>
                                                @endforeach
                                            </select>                    
                                            @error('db_unit_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- next Page --}}
                                    <input type="button" name="next" class="next btn btn-primary float-right mt-3" value="@lang('pagination.next')">
                                </fieldset>

                                {{-- Page II --}}
                                <fieldset class="fieldsetComponent">
                                    <div class="d-flex">
                                        <h2>@lang('message.ingredients')</h2> 
                                    {{-- ADD Ingredient Button --}}
                                    <p class="btn py-0 px-2 btn-primary shadow-none ml-auto edit-ingredient"><i class="fas fa-plus"></i></p>
                                    </div>
                                    
                                    <div class="form-container mb-3">
                                        <div class="dynamic-ingredient-edit-area" id="dynamic-ingredient-edit-area">
                                            {{-- START OF HIDDEN ELEMENT --}}
                                            <div class="form-row mt-2 dynamic-ingredient-edit" style="display:none">
                                                {{-- Replace these fields --}}
                                                <div class="input-group col-12">
                                                    {{-- Choose Ingredient --}}
                                                    <select id="selectIngredientEdit" name="editIngredients[]" class="form-control col-5 selectIngredientEdit" onchange="changeUnitEditIngredient()" required>
                                                        <option disabled selected hidden> @lang('message.choseIngredient')</option>
                                                        @foreach ($ingredients as $ingredient)
                                                            <option id="editIngredientComponent{{$ingredient->id}}" value="{{$ingredient->id}}" data-cc-unit="{{$ingredient->unit}}">{{$ingredient->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    {{-- input Amount --}}
                                                    <input type="number" min="0" class="form-control col-3" name="editAmounts[]" placeholder="Menge">
                                                    {{-- Unit for selected Ingredient --}}
                                                    <span class="form-control unitIngredientEdit col-3" id="unitIngredientEdit">@lang('message.unit')</span>
                                                    {{-- delete Row --}}
                                                    <div class="input-group-append d-flex col-1 px-0">
                                                        <button class="btn btn-outline-danger flex-fill delete-dynamic-ingredient-edit" type="button"> x </button>
                                                    </div>
                                                </div>
                                                {{-- End of fields--}}
                                            </div>
                                            {{-- END OF HIDDEN ELEMENT --}}
                                            <div id='editIngredientDynamicElement'></div>            
                                            {{-- Dynamic element will be cloned here --}}
                                            {{-- You can call clone function once if you want it to show it a first element--}}
                                        </div>
                                    </div>

                                    <input type="button" name="previous" class="previous btn btn-secondary" value="@lang('pagination.previous')" />
                                    <input type="button" name="next" class="next btn btn-primary float-right" value="@lang('pagination.next')" />
                                    
                                </fieldset class="fieldsetComponent">
                                {{-- Page III --}}
                                <fieldset>
                                    <h2>@lang('message.recipe')</h2>
                                    <textarea id="editRecipeComponent" name="recipe" cols="50" rows="5" class="mb-2 form-control" form="editComponentForm"></textarea>
                                    <input type="button" name="previous" class="previous btn btn-secondary" value="@lang('pagination.previous')" />
                                    <button type="submit" class="btn btn-primary float-right">
                                        {{ __('Speichern') }}
                                    </button>
                                </fieldset>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- MODAL -> DELETE Component --}}
        <div id="deleteComponentModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3><i class="fas fa-trash"></i> @lang('message.component') @lang('message.delete')</h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="/component" method="POST" id="deleteComponentForm">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body" id="editComponent">
                            <span>Wollen Sie die Komponente </span><b><span id="deleteNameComponent"></span></b><span> löschen ?</span> 
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">Löschen</button>              
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{----------------------------------- Meals MODAL ----------------------------------}}

        {{-- MODAL -> ADD Meal --}}
        <div id="addMeal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3><i class="fas fa-plus"></i> @lang('message.meal')</h3>
                        <a class="close" data-dismiss="modal">×</a>
                    </div>
                        <div class="modal-body">
                            <form action="{{ action('MealController@store') }}" method="POST" id="addMealForm" class="mt-2">
                            @csrf
                                <div class="container p-0">
                                    <ul id="progressbar">
                                        <li class="active">@lang('message.general')</li>
                                        <li>@lang('message.component')</li>
                                        <li>@lang('message.recipe')</li>
                                    </ul>
                                    {{-- Page I --}}
                                    <fieldset class="fieldsetAddMeal">
                                        <h2>@lang('message.general')</h2>
                                        {{-- name Input --}}
                                        <div class="form-row">
                                            <div class="form-group col-12">            
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="@lang('message.name')">
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-12">            
                                                <input class="form-check-input" id="mainCourse" type="checkbox" name="mainCourse" value="true">
                                                <label class="form-check-label" for="mainCourse">Hauptgericht</label>
                                                <input class="form-check-input" id="dessertCourse" type="checkbox" name="dessertCourse" value="true">
                                                <label class="form-check-label" for="dessertCourse">Dessert</label>
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- next Page --}}
                                        <input type="button" name="next" class="next btn btn-primary float-right mt-3" value="@lang('pagination.next')">
                                    </fieldset>

                                    {{-- Page II --}}
                                    <fieldset class="fieldsetAddMeal">
                                        <div class="d-flex">
                                            <h2>@lang('message.component')</h2> 
                                        {{-- ADD Component Button --}}
                                        <p class="btn py-0 px-2 btn-primary shadow-none ml-auto add-component"><i class="fas fa-plus"></i></p>
                                        </div>
                                        
                                        <div class="form-container mb-3">
                                            <div class="dynamic-component-area" id="dynamic-component-area">
                                                {{-- START OF HIDDEN ELEMENT --}}
                                                <div class="form-row mt-2 dynamic-component" style="display:none">
                                                    {{-- Replace these fields --}}
                                                    <div class="input-group col-12">
                                                        {{-- Choose Component --}}
                                                        <select id="selectComponentAdd" name="components[]" class="form-control col-5 selectComponentAdd" onchange="changeUnitAddComponent()" required>
                                                            <option disabled selected hidden> @lang('message.choseComponent')</option>
                                                            @foreach ($components as $component)
                                                                <option value="{{$component->id}}" data-cc-unit="{{$component->unit}}">{{$component->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        {{-- input Amount --}}
                                                        <input type="number" min="0" class="form-control col-3" name="amounts[]" placeholder="@lang('message.amount')">
                                                        {{-- Unit for selected Ingredient --}}
                                                        <span class="form-control unitComponentAdd col-3" id="unitComponentAdd">@lang('message.unit')</span>
                                                        {{-- delete Row --}}
                                                        <div class="input-group-append d-flex col-1 px-0">
                                                            <button class="btn btn-outline-danger flex-fill delete-dynamic-component" type="button"> x </button>
                                                        </div>
                                                    </div>
                                                    {{-- End of fields--}}
                                                </div>
                                                {{-- END OF HIDDEN ELEMENT --}}
                                                {{-- Dynamic element will be cloned here --}}
                                                {{-- You can call clone function once if you want it to show it a first element--}}
                                            </div>
                                        </div>

                                        <input type="button" name="previous" class="previous btn btn-secondary" value="@lang('pagination.previous')" />
                                        <input type="button" name="next" class="next btn btn-primary float-right" value="@lang('pagination.next')" />
                                        
                                    </fieldset>
                                    {{-- Page III --}}
                                    <fieldset class="fieldsetAddMeal">
                                        <h2>@lang('message.recipe')</h2>
                                        <textarea name="recipe" cols="50" rows="5" class="mb-2 form-control" form="addMealForm"></textarea>
                                        <input type="button" name="previous" class="previous btn btn-secondary" value="@lang('pagination.previous')" />
                                        <button type="submit" class="btn btn-primary float-right">
                                            {{ __('Speichern') }}
                                        </button>
                                    </fieldset>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- MODAL -> SHOW Meal --}}
        <div id="showMealModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3><i class="fas fa-info"></i> @lang('message.show')</h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body" id="showMeal">
                        <h3 id="showNameMeal"></h3>
                        <hr>
                        <h4>@lang('message.component')</h4>
                        <div id="showComponentsMeal"></div>
                        <hr>
                        <h4>@lang('message.recipe')</h4>
                        <span id="showRecipeMeal"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('message.close')</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- MODAL -> EDIT Meal --}}
        <div id="editMealModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3><i class="fas fa-pen"></i> @lang('message.meal')</h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="/meal" method="POST" id="editMealForm">
                        @method('PUT')
                        @csrf
                        <div class="modal-body" id="editMeal">
                            <div class="container p-0">
                                <ul id="progressbar">
                                    <li class="active">@lang('message.general')</li>
                                    <li>@lang('message.component')</li>
                                    <li>@lang('message.recipe')</li>
                                </ul>
                                {{-- Page I --}}
                                <fieldset class="fieldsetEditMeal">
                                    <h2>@lang('message.general')</h2>
                                    {{-- name Input --}}
                                    <div class="form-row">
                                        <div class="form-group col-12">            
                                            <input id="editNameMeal" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="" placeholder="@lang('message.name')">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- next Page --}}
                                    <input type="button" name="next" class="next btn btn-primary float-right mt-3" value="@lang('pagination.next')">
                                </fieldset>

                                {{-- Page II --}}
                                <fieldset class="fieldsetEditMeal">
                                    <div class="d-flex">
                                        <h2>@lang('message.component')</h2> 
                                    {{-- ADD Component Button --}}
                                    <p class="btn py-0 px-2 btn-primary shadow-none ml-auto edit-component"><i class="fas fa-plus"></i></p>
                                    </div>
                                    
                                    <div class="form-container mb-3">
                                        <div class="dynamic-component-edit-area" id="dynamic-component-edit-area">
                                            {{-- START OF HIDDEN ELEMENT --}}
                                            <div class="form-row mt-2 dynamic-component-edit" style="display:none">
                                                {{-- Replace these fields --}}
                                                <div class="input-group col-12">
                                                    {{-- Choose Component --}}
                                                    <select id="selectComponentEdit" name="editComponents[]" class="form-control col-5 selectComponentEdit" onchange="changeUnitEditComponent()" required>
                                                        <option disabled selected hidden> @lang('message.choseComponent')</option>
                                                        @foreach ($components as $component)
                                                            <option value="{{$component->id}}" data-cc-unit="{{$component->unit}}">{{$component->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    {{-- input Amount --}}
                                                    <input type="number" min="0" class="form-control col-3" name="amounts[]" placeholder="@lang('message.amount')">
                                                    {{-- Unit for selected Ingredient --}}
                                                    <span class="form-control unitComponentEdit col-3" id="unitComponentEdit">@lang('message.unit')</span>
                                                    {{-- delete Row --}}
                                                    <div class="input-group-append d-flex col-1 px-0">
                                                        <button class="btn btn-outline-danger flex-fill delete-dynamic-component-edit" type="button"> x </button>
                                                    </div>
                                                </div>
                                                {{-- End of fields--}}
                                            </div>
                                            {{-- END OF HIDDEN ELEMENT --}}
                                            <div id='editComponentDynamicElement'></div>
                                            {{-- Dynamic element will be cloned here --}}
                                            {{-- You can call clone function once if you want it to show it a first element--}}
                                        </div>
                                    </div>

                                    <input type="button" name="previous" class="previous btn btn-secondary" value="@lang('pagination.previous')" />
                                    <input type="button" name="next" class="next btn btn-primary float-right" value="@lang('pagination.next')" />
                                    
                                </fieldset>
                                {{-- Page III --}}
                                <fieldset class="fieldsetAddMeal">
                                    <h2>@lang('message.recipe')</h2>
                                    <textarea id="editRecipeMeal" name="recipe" cols="50" rows="5" class="mb-2 form-control" form="editMealForm"></textarea>
                                    <input type="button" name="previous" class="previous btn btn-secondary" value="@lang('pagination.previous')" />
                                    <button type="submit" class="btn btn-primary float-right">
                                        {{ __('Speichern') }}
                                    </button>
                                </fieldset>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- MODAL -> DELETE Meal --}}
        <div id="deleteMealModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3><i class="fas fa-trash"></i> @lang('message.meal') @lang('message.delete')</h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="/meal" method="POST" id="deleteMealForm">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body" id="editMeal">
                            <span>Wollen Sie die Speise </span><b><span id="deleteNameMeal"></span></b><span> löschen ?</span> 
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">Löschen</button>              
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{------------------------------------ END ------------------------------------}}
@endsection
