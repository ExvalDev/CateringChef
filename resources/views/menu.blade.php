@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/style_menu.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container-fluid row m-0 p-0 vh-100">
  {{------------------------------------ Menu table ------------------------------------}}
  <div class="col-9 m-0 pt-3 px-2 tableHeight">
    <div class="d-flex">
      <h1 class="mr-auto">Speiseplan</h1>
      {{-- choose Week --}}
      <div id="weekControl">
        <form action="">
          <div class="input-group">
            <button type="submit" id="previousWeek" class="form-control"><i class="fas fa-chevron-left"></i></button>
            <span class="input-group-append input-group-text rounded-0 bg-white"><h4>KW3</h4></span>
            <button type="submit" id="nextWeek" class="form-control"><i class="fas fa-chevron-right"></i></button>
          </div>
        </form>
      </div>
      {{-- choose Year --}}
      <div id="yearControl" class="ml-2">
        <form action="">
            <select class="form-control" name="selectedYear" id="">
              <option>2019</option>
              <option selected>2020</option>
              <option>2021</option>
            </select>
        </form>
      </div>
  </div>
  {{-- Table area --}}
  <div class="bg-white shadow-sm  mh-100 d-flex flex-column">
    <table id="menuTable" class="w-100">
      {{-- Weekdays --}}
      <thead class="text-center" id="menuTableHead">
        <th><h2>Montag</h2></th>
        <th><h2>Dienstag</h2></th>
        <th><h2>Mittwoch</h2></th>
        <th><h2>Donnerstag</h2></th>
        <th><h2>Freitag</h2></th>
      </thead>
      <tbody >
        <tr class="text-center">
          <td class="py-2 courseName"><h4>Hauptgericht</h4></td>
        </tr>
        {{-- Main course --}}
        <tr id="courseMain">
          <td><div class="emptyCourse rounded-lg mb-2 ml-2 mr-1"></div></td>
          <td><div class="emptyCourse rounded-lg mb-2 mx-1"></div></td>
          <td><div class="emptyCourse rounded-lg mb-2 mx-1"></div></td>
          <td><div class="emptyCourse rounded-lg mb-2 mx-1"></div></td>
          <td><div class="emptyCourse rounded-lg mb-2 ml-1 mr-2"></div></td>
        </tr>

        <tr class="text-center">
          <td class="py-2 courseName"><h4>Dessert</h4></td>
        </tr>
        {{-- Dessert Course --}}
        <tr id="courseDessert">
          <td><div class="emptyCourse rounded-lg mb-2 ml-2 mr-1"></div></td>
          <td><div class="emptyCourse rounded-lg mb-2 mx-1"></div></td>
          <td><div class="emptyCourse rounded-lg mb-2 mx-1"></div></td>
          <td><div class="emptyCourse rounded-lg mb-2 mx-1"></div></td>
          <td><div class="emptyCourse rounded-lg mb-2 ml-1 mr-2"></div></td>
        </tr>
      </tbody>
    </table>
    {{-- Actions  --}}
    <div class="p-2">
      <div class="btn btn-dark m-0 add-one" id="deleteMealInMenu">Löschen  <i class="fas fa-trash text-white"></i></div>
      <button class="btn btn-light m-0 float-right"> Als PDF exportieren  <i class="far fa-file-pdf"></i></button>
      <button class="btn btn-light m-0 float-right mr-2"> Einkaufliste exportieren  <i class="fas fa-shopping-cart"></i></button>
      
    </div>
  </div>
  </div>
  {{------------------------------------- Meals view -------------------------------------}}
  <div class="col-3 m-0 py-3 px-2 tableHeight">
      <h1>Speisen</h1>
      <div class="bg-white shadow-sm h-100 mh-100 d-flex flex-column">
        <div>
            <div class="px-2 pt-2 m-0">
                <input class="form-control bg-light border-0 shadow-none" id="SearchMeal" type="text" placeholder="Suche..">
            </div>   
            {{-- <hr class="p-0 my-2"/> --}}
            <div class="d-flex m-2 p-0">
                <button type="button" class="btn py-1 px-2 btn-light shadow-none">Sortieren <i class="fas fa-sort"></i></button>
                <button type="button" class="btn py-1 px-2 ml-2 btn-light shadow-none">Filter <i class="fas fa-filter"></i></button>
            </div>
            {{-- <hr class="p-0 mt-2 mb-0"/> --}}
        </div>
        <div  data-simplebar class="h-100 mh-100 p-2 overflow-auto">
            <ul class="list-group" id="ListMeal">
                @foreach ($meals as $meal)
                    <li class="list-group-item bg-light rounded my-1 px-2 py-3 border-0 d-flex">
                        <span class="h-100 mh-100 align-self-center text-dark font-weight-bold" > {{ $meal->name }}</span>   
                        <div class="btn-group ml-auto align-self-center ">
                            {{-- Button SHOW Meal Modal --}}
                            <button type="button" id={{ $meal->id }} class="btn p-0 my-0 mx-2 shadow-none showMealButton"><i class="fas fa-info"></i></button>
                        </div>
                    </li>
                @endforeach
            </ul> 
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
@endsection
