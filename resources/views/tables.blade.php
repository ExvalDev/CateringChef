@extends('layouts.app')
@push('styles')
    <link href="{{ asset('css/style_tables.css') }}" rel="stylesheet">
@endpush
@push('scripts')
    <script>
        //Show Unit
        function changeUnit()
        {
            var unit = $("#selectIngredient option:selected").attr('data-cc-unit');
            console.log(unit);
            // $('.unitIngredient').text(unit); 
        };
    </script>
@endpush
@section('content')
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
                        <button type="button" class="btn py-0 px-2 btn-primary shadow-none" data-toggle="modal" data-target="#addingredient"><i class="fas fa-plus"></i></button>
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
                        <button type="button" class="btn py-0 px-2 btn-primary shadow-none" data-toggle="modal" data-target="#addcomponent"><i class="fas fa-plus"></i></button>
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
                        <button type="button" class="btn py-0 px-2 btn-primary shadow-none" data-toggle="modal" data-target="#addmeal"><i class="fas fa-plus"></i></button>
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
                                    <button type="button" class="btn p-0 my-0 mx-2 shadow-none" data-toggle="modal" data-target="#editmealmodal"><i class="fas fa-pen"></i></button>
                                    {{-- Button DELETE Meal  --}}
                                    <button type="button" id={{ $meal->id }} class="btn p-0 my-0 mx-2 shadow-none deleteMealButton"><i class="fas fa-trash"></i></button>
                                </div>
                            </li>
                        @endforeach
                    </ul> 
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
                        <h3>Zutat</h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="/ingredient" method="POST" id="editIngredientForm">
                        @method('PUT')
                        @csrf
                        <div class="modal-body" id="editIngredient"></div>
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

        {{-- MODAL -> ADD Component --}}
        <div id="addcomponent" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3><i class="fas fa-plus"></i> Komponente</h3>
                        <a class="close" data-dismiss="modal">×</a>
                    </div>
                        <div class="modal-body">
                            <form action="{{ action('ComponentController@store') }}" method="POST" id="addComponentForm" class="mt-2">
                            @csrf
                                <div class="container">
                                    <div class="progress my-2">
                                        <div class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <fieldset>
                                        <h2>Name</h2>
                                        <div class="form-group">            
                                            <div class="col p-0">
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Name">
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>  
                                        </div>
                                        <div class="form-group row">            
                                            <div class="col p-0">
                                                <input type="number" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') }}" placeholder="Menge">
                                                @error('amount')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>  
                                            <div class="col p-0">
                                                <select class="form-control @error('db_unit_id') is-invalid @enderror" name="db_unit_id" value="{{ old('db_unit_id') }}">
                                                    <option disabled selected>Einheit</option>
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
                                        <input type="button" name="next" class="next btn btn-primary" value="Weiter">
                                    </fieldset>
                                    <fieldset>
                                        <h2>Zutaten</h2>
                                        {{-- START OF HIDDEN ELEMENT --}}
                                        <div class="form-group dynamic-element" style="display:block">
                                            <div class="row">
                                                {{-- Replace these fields --}}
                                                <div class="input-group">
                                                    <select id="selectIngredient" name="ingredients[]" class="form-control selectselect" onchange="changeUnit()" required>
                                                        <option value='0' disabled>Zutat</option>
                                                        @foreach ($ingredients as $ingredient)
                                                            <option value="{{$ingredient->id}}" data-cc-unit="{{$ingredient->unit}}">{{$ingredient->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <input type="number" class="form-control" name="amounts[]" placeholder="Menge">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text unitIngredient" id="unitIngredient">Unit</span>
                                                    </div>
                                                    <div class=""><p class="delete">x</p></div>
                                                </div>
                                                {{-- End of fields--}}
                                            </div>
                                        </div>
                                        {{-- END OF HIDDEN ELEMENT --}}
                                        <div class="form-container">
                                            <div class="dynamic-stuff">
                                                {{-- Dynamic element will be cloned here --}}
                                                {{-- You can call clone function once if you want it to show it a first element--}}
                                            </div>
                                            {{-- ADD Component Button --}}
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <p class="add-one">+ Hinzufügen</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="button" name="previous" class="previous btn btn-secondary" value="Zurück" />
                                        <input type="button" name="next" class="next btn btn-primary" value="Weiter" />
                                    </fieldset>
                                    <fieldset>
                                        <h2>Rezept</h2>
                                        <textarea name="recipe" cols="50" rows="5" class="mb-2" form="addComponentForm"></textarea>
                                        <input type="button" name="previous" class="previous btn btn-secondary" value="Zurück" />
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Speichern') }}
                                        </button>
                                    </fieldset>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <div class="btn-group">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Schließen</button> 
                            </div> 
                        </div>
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
                        <h3>Komponente</h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="/component" method="POST" id="editComponentForm">
                        @method('PUT')
                        @csrf
                        <div class="modal-body" id="editComponent"></div>
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
@endsection
