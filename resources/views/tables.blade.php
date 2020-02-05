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
            <h1>Zutaten</h1>
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
            <h1>Komponenten</h1>
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
            <h1>Speisen</h1>
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
                        <h3><i class="fas fa-plus"></i> Zutat</h3>
                        <a class="close" data-dismiss="modal">×</a>
                    </div>
                    <form action="{{ action('IngredientController@store') }}" method="POST">
                        <div class="modal-body">
                            @csrf
                            <div class="form-group">            
                                <div class="col">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Name" autofocus required>
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
                                    <input list="suppliers" class="form-control @error('supplier_name') is-invalid @enderror" name="supplier_name" value="{{ old('supplier_name') }}" placeholder="Lieferant" autocomplete="on">
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
                                        <option disabled selected hidden>Einheit</option>
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
        
        {{-- MODAL -> SHOW Ingredient --}}
        <div id="showIngredientModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1>Details</h1>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body" id="showIngredient">
                        <h3 id="showNameIngredient"></h3>
                        <hr>
                        <h4>Lieferant</h4>
                        <span id="showSupplierIngredient"></span><br>
                        <hr>
                        <h4>Einheit</h4>
                        <span id="showUnitIngredient"></span><br>
                        <hr>
                        <h4>Allergene</h4>
                        <span id="showAllergenesIngredient"></span><br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Schließen</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- MODAL -> EDIT Ingredient --}}
        <div id="editIngredientModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3><i class="fas fa-pen"></i> Zutat</h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="/ingredient" method="POST" id="editIngredientForm">
                        @method('PUT')
                        @csrf
                        <div class="modal-body" id="editIngredient"></div>
                        <div class="form-group">            
                            <div class="col">
                                <input id="editNameIngredient" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="" placeholder="Name" autofocus required>
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
                                <input id="editSupplierIngredient" list="suppliers" class="form-control @error('supplier_name') is-invalid @enderror" name="supplier_name" value="" placeholder="Lieferant" autocomplete="on">
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
                                    <option disabled selected hidden>Einheit</option>
                                    @foreach($db_units as $db_unit)
                                        <option id="editUnit{{ $db_unit->id }}" value='{{ $db_unit->id }}'>{{ $db_unit->name }}</option>
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
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Schließen</button>
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
                        <h3>Zutat löschen</h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="/ingredient" method="POST" id="deleteIngredientForm">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body" id="editIngredient">
                           <span>Wollen Sie wirklich die Zutat löschen ?</span> 
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
                        <h3><i class="fas fa-plus"></i> Komponente</h3>
                        <a class="close" data-dismiss="modal">×</a>
                    </div>
                    <div class="modal-body">
                        <form action="{{ action('ComponentController@store') }}" method="POST" id="addComponentForm" class="mt-2">
                        @csrf
                            <div class="container p-0">
                                <ul id="progressbar">
                                    <li class="active">Allgemein</li>
                                    <li>Zutaten</li>
                                    <li>Rezept</li>
                                </ul>
                                {{-- Page I --}}
                                <fieldset>
                                    <h2>Allgemein</h2>
                                    {{-- name Input --}}
                                    <div class="form-row">
                                        <div class="form-group col-12">            
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Name">
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
                                            <input type="number" min="0" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') }}" placeholder="Menge">
                                            @error('amount')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                            <select class="form-control @error('db_unit_id') is-invalid @enderror" name="db_unit_id" value="{{ old('db_unit_id') }}">
                                                <option disabled selected hidden> Einheit</option>
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
                                    <input type="button" name="next" class="next btn btn-primary float-right mt-3" value="Weiter">
                                </fieldset>

                                {{-- Page II --}}
                                <fieldset>
                                    <div class="d-flex">
                                        <h2>Zutaten</h2> 
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
                                                        <option disabled selected hidden> Zutat wählen</option>
                                                        @foreach ($ingredients as $ingredient)
                                                            <option value="{{$ingredient->id}}" data-cc-unit="{{$ingredient->unit}}">{{$ingredient->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    {{-- input Amount --}}
                                                    <input type="number" min="0" class="form-control col-3" name="amounts[]" placeholder="Menge">
                                                    {{-- Unit for selected Ingredient --}}
                                                    <span class="form-control unitIngredientAdd col-3" id="unitIngredientAdd">Einheit</span>
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

                                    <input type="button" name="previous" class="previous btn btn-secondary" value="Zurück" />
                                    <input type="button" name="next" class="next btn btn-primary float-right" value="Weiter" />
                                    
                                </fieldset>
                                {{-- Page III --}}
                                <fieldset>
                                    <h2>Rezept</h2>
                                    <textarea name="recipe" cols="50" rows="5" class="mb-2 form-control" form="addComponentForm"></textarea>
                                    <input type="button" name="previous" class="previous btn btn-secondary" value="Zurück" />
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
                        <h1>Details</h1>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body" id="showComponent">
                        <h3 id="showNameComponent"></h3>
                        <hr>
                        <h4>Menge</h4>
                        <span id="showAmountComponent"></span> <span id="showUnitComponent"></span>
                        <hr>
                        <h4>Zutaten</h4>
                        <div id="showIngredientsComponent"></div>
                        <hr>
                        <h4>Rezept</h4>
                        <span id="showRecipeComponent"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Schließen</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- MODAL -> EDIT Component --}}
        <div id="editComponentModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3><i class="fas fa-pen"></i> Komponente</h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="/component" method="POST" id="editComponentForm">
                        @method('PUT')
                        @csrf
                        <div class="modal-body" id="editComponent"></div>
                    </form>
                </div>
            </div>
        </div>

        {{-- MODAL -> DELETE Component --}}
        <div id="deleteComponentModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3>Komponente löschen</h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="/component" method="POST" id="deleteComponentForm">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body" id="editComponent">
                           <span>Wollen Sie die Komponente wirklich löschen ?</span> 
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
                        <h3><i class="fas fa-plus"></i> Speise</h3>
                        <a class="close" data-dismiss="modal">×</a>
                    </div>
                        <div class="modal-body">
                            <form action="{{ action('MealController@store') }}" method="POST" id="addMealForm" class="mt-2">
                            @csrf
                                <div class="container p-0">
                                    <ul id="progressbar">
                                        <li class="active">Allgemein</li>
                                        <li>Komponente</li>
                                        <li>Rezept</li>
                                    </ul>
                                    {{-- Page I --}}
                                    <fieldset class="fieldsetAddMeal">
                                        <h2>Allgemein</h2>
                                        {{-- name Input --}}
                                        <div class="form-row">
                                            <div class="form-group col-12">            
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Name">
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- next Page --}}
                                        <input type="button" name="next" class="next btn btn-primary float-right mt-3" value="Weiter">
                                    </fieldset>

                                    {{-- Page II --}}
                                    <fieldset class="fieldsetAddMeal">
                                        <div class="d-flex">
                                            <h2>Komponente</h2> 
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
                                                            <option disabled selected hidden> Komponente wählen</option>
                                                            @foreach ($components as $component)
                                                                <option value="{{$component->id}}" data-cc-unit="{{$component->unit}}">{{$component->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        {{-- input Amount --}}
                                                        <input type="number" min="0" class="form-control col-3" name="amounts[]" placeholder="Menge">
                                                        {{-- Unit for selected Ingredient --}}
                                                        <span class="form-control unitComponentAdd col-3" id="unitComponentAdd">Einheit</span>
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

                                        <input type="button" name="previous" class="previous btn btn-secondary" value="Zurück" />
                                        <input type="button" name="next" class="next btn btn-primary float-right" value="Weiter" />
                                        
                                    </fieldset>
                                    {{-- Page III --}}
                                    <fieldset class="fieldsetAddMeal">
                                        <h2>Rezept</h2>
                                        <textarea name="recipe" cols="50" rows="5" class="mb-2 form-control" form="addMealForm"></textarea>
                                        <input type="button" name="previous" class="previous btn btn-secondary" value="Zurück" />
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
                        <h1>Details</h1>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body" id="showMeal">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Schließen</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- MODAL -> EDIT Meal --}}
        <div id="editMealModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3><i class="fas fa-pen"></i> Speise</h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="/meal" method="POST" id="editMealForm">
                        @method('PUT')
                        @csrf
                        <div class="modal-body" id="editMeal"></div>
                    </form>
                </div>
            </div>
        </div>

        {{-- MODAL -> DELETE Meal --}}
        <div id="deleteMealModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3>Speise löschen</h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="/meal" method="POST" id="deleteMealForm">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body" id="editMeal">
                           <span>Wollen Sie die Speise wirklich löschen ?</span> 
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
