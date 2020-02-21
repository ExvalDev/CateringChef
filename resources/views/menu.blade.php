@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/style_menu.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.css">
@endpush

@push('topScripts')
  <script src="{{ asset('js/menu.js') }}"></script>
@endpush

@section('content')
<div class="container-fluid row m-0 p-0 vh-100">
  {{------------------------------------ Menu table ------------------------------------}}
  <div class="col-9 m-0 pt-3 px-2 tableHeight">
    <div class="d-flex">
      <h1 class="mr-auto">Speiseplan</h1>
      {{-- choose Week --}}
      <div id="weekControl">
          <div class="input-group">
          <a href="/menu/changeWeek/{{$KW}}/last" id="previousWeek" class="form-control"><i class="fas fa-chevron-left"></i></a>
          <span class="input-group-append input-group-text rounded-0 bg-white"><h4>KW{{$KW}}</h4></span>
          <a href="/menu/changeWeek/{{$KW}}/next" id="nextWeek" class="form-control"><i class="fas fa-chevron-right"></i></a>
          </div>
      </div>
      {{-- choose Year --}}
      <div id="yearControl" class="ml-2">
        <form action="/menu/changeYear">
            <select class="form-control" name="selectedYear" id="" onchange="this.form.submit()">
              <option>{{$year-1}}</option>
              <option selected>{{$year}}</option>
              <option>{{$year+1}}</option>
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
        @php
          $startDay = new DateTime($startDate);
          $endDay = new DateTime($endDate);
          $endDay->modify('+1 day');
          $daterange = new DatePeriod($startDay, new DateInterval('P1D'), $endDay);

          echo '<tr id="courseMain" class="px-2 mx-2">';
          foreach ($daterange as $date) {
            $noMeal = true; 
            foreach ($mainCourse as $course) {
              if ($course->date == ($date->format('Y-m-d'))) {
                
                /* echo (count($course->meals)); */
                $noMeal = false;
                switch (count($course->meals)) {
                  case 0:
                    echo ' <td ondrop="copy(event)" ondragover="allowDrop(event)" data-courseCount="0" data-date="'.$date->format('Y-m-d').'" data-course="main"><div class="emptyCourse rounded-lg mb-2 mx-1"></div></td>';
                    break;

                  case 1:
                    $meal = json_decode($course->meals[0]);
                    echo '<td ondrop="copy(event)" ondragover="allowDrop(event)" data-courseCount="1" data-date="'.$date->format('Y-m-d').'" data-course="main"><div id="menuMeal_'.$meal->relationId.'" class="course text-align-center bg-light p-2 rounded-lg mb-2 mx-1" draggable="true" ondragstart="drag(event)">';
                    echo  ($meal->name);
                    echo '<br>';
                    echo  ($meal->allergenes);
                    echo '</div>'; 
                    echo '<div class="oneMoreCourse rounded-lg mb-2 mx-1"></div></td>';
                    break;

                  case 2:
                    $meal0 = json_decode($course->meals[0]);
                    $meal1 = json_decode($course->meals[1]);
                    echo '<td ondrop="copy(event)" ondragover="allowDrop(event)" data-courseCount="2" data-date="'.$date->format('Y-m-d').'" data-course="main"><div id="menuMeal_'.$meal0->relationId.'" class="course text-align-center bg-light p-2 rounded-lg mb-2 mx-1" draggable="true" ondragstart="drag(event)">';
                    echo  ($meal0->name);
                    echo '<br>';
                    echo  ($meal0->allergenes);
                    echo '</div>';
                    echo '<div id="menuMeal_'.$meal1->relationId.'" class="course text-align-center bg-light p-2 rounded-lg mb-2 mx-1" draggable="true" ondragstart="drag(event)">';
                    echo  ($meal1->name);
                    echo '<br>';
                    echo  ($meal1->allergenes);
                    echo '</div></td>';
                    break; 
                }  
              }
            }
            if ($noMeal == true) {
              echo ' <td ondrop="copy(event)" ondragover="allowDrop(event)" data-courseCount="0" data-date="'.$date->format('Y-m-d').'" data-course="main"><div class="emptyCourse rounded-lg mb-2 mx-1"></div></td>';
            }
          }
          echo'</tr>';

          /* Dessert Course */
          echo '<tr class="text-center">
                  <td class="py-2 courseName"><h4>Dessert</h4></td>
                </tr>
                <tr id="courseDessert">';

          foreach ($daterange as $date) {
            $noMeal = true; 
            foreach ($dessertCourse as $course) {
              if ($course->date == ($date->format('Y-m-d'))) {
                $noMeal = false;
                switch (count($course->meals)) {
                  case 0:
                  echo ' <td ondrop="copy(event)" ondragover="allowDrop(event)" data-courseCount="0" data-date="'.$date->format('Y-m-d').'" data-course="dessert"><div class="emptyCourse rounded-lg mb-2 mx-1"></div></td>';
                    break;

                  case 1:
                    $meal = json_decode($course->meals[0]);
                    echo '<td ondrop="copy(event)" ondragover="allowDrop(event)" data-courseCount="1" data-date="'.$date->format('Y-m-d').'" data-course="dessert"><div id="menuMeal_'.$meal->relationId.'" class="course text-align-center bg-light p-2 rounded-lg mb-2 mx-1" draggable="true" ondragstart="drag(event)">';
                    echo  ($meal->name);
                    echo '<br>';
                    echo  ($meal->allergenes);
                    echo '</div>'; 
                    echo '<div class="oneMoreCourse rounded-lg mb-2 mx-1"></div></td>';
                    break;

                  case 2:
                    $meal0 = json_decode($course->meals[0]);
                    $meal1 = json_decode($course->meals[1]);
                    echo '<td ondrop="copy(event)" ondragover="allowDrop(event)" data-courseCount="2" data-date="'.$date->format('Y-m-d').'" data-course="dessert"><div id="menuMeal_'.$meal0->relationId.'" class="course text-align-center bg-light p-2 rounded-lg mb-2 mx-1" draggable="true" ondragstart="drag(event)">';
                    echo  ($meal0->name);
                    echo '<br>';
                    echo  ($meal0->allergenes);
                    echo '</div>';
                    echo '<div id="menuMeal_'.$meal1->relationId.'" class="course text-align-center bg-light p-2 rounded-lg mb-2 mx-1" draggable="true" ondragstart="drag(event)">';
                    echo  ($meal1->name);
                    echo '<br>';
                    echo  ($meal1->allergenes);
                    echo '</div></td>';
                    break; 
                }  
              }
            }
            if ($noMeal == true) {
              echo ' <td ondrop="copy(event)" ondragover="allowDrop(event)" data-courseCount="0" data-date="'.$date->format('Y-m-d').'" data-course="dessert"><div class="emptyCourse rounded-lg mb-2 mx-1"></div></td>';
            }
          }
          echo '</tr>';

        @endphp
      </tbody>
    </table>
      {{-- Actions  --}}
      <div class="p-2">
        <div class="btn btn-dark m-0 add-one" id="deleteMealInMenu" ondrop="deleteMenu(event)" ondragover="allowDrop(event)">Löschen  <i class="fas fa-trash text-white"></i></div>
        {{-- <button class="btn btn-light m-0 float-right ml-2"> Als PDF exportieren  <i class="far fa-file-pdf"></i></button> --}}
        <button class="btn btn-light m-0 float-right" data-toggle="modal" data-target="#shoppingListModal"> Einkaufliste exportieren  <i class="fas fa-shopping-cart"></i></button>
        
      </div>
    </div>
    <div class="bg-white mt-2 shadow-sm d-flex flex-column">
      @foreach ($allergenes as $allergene)
        {{$allergene->id}} -> {{$allergene->name}} 
      @endforeach
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
              {{-- Meals --}}
                @foreach ($meals as $meal)
            <li class="mealItem list-group-item bg-light rounded my-1 px-2 py-3 border-0 d-flex" id="meal:{{$meal->id}}" data-id="{{$meal->id}}" data-name="{{ $meal->name }}" data-allergenes="{{$meal->allergenes}}" data-main-course="{{$meal->main}}" data-dessert-course="{{$meal->dessert}}" draggable='true' ondragstart='drag(event)'>
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
              <h4 id="showCourseMeal"></h4>
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

{{-- MODAL ->  Shopping List --}}
<div id="shoppingListModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <h1>Einkaufsliste erstellen</h1>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form action="/menu/einkaufsliste" method="POST">
      @csrf
        <div class="modal-body">
          <h3>Kunden auswählen</h3>
          @foreach ($customers aS $customer)
            <div class="border py-2 mb-1 rounded-lg">
              <label class="col-12"><h4>{{$customer->name}}</h4></label>
              <div class="input-group col-12">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroupPrepend2"><i class="fas fa-male"></i></span>
                </div>
                <input id="adults{{$customer->id}}" type="number" class="form-control col-6" placeholder="Erwachsene" name="adults[]" value="{{$customer->adults}}" data-standard="{{$customer->adults}}">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroupPrepend2"><i class="fas fa-child"></i></span>
                </div>
                <input id="childrens{{$customer->id}}" type="number" class="form-control col-6" placeholder="Kinder" name="childrens[]" value="{{$customer->childrens}}" data-standard="{{$customer->childrens}}">
                <div class="input-group-append d-flex col-1 px-0">
                  <button class="btn btn-outline-danger flex-fill" onclick="setCustomer({{$customer->id}})" type="button"><i class="fas fa-times"></i></button>
                </div>
                <div class="input-group-append d-flex col-1 px-0">
                  <button class="btn btn-outline-warning flex-fill" onclick="setStandardCustomer({{$customer->id}})" type="button"> <i class="fas fa-sync-alt"></i> </button>
                </div>
              </div>
            </div>
          @endforeach
          <hr>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">Start</span>
            </div>
            <input class="form-control" type='date' name='startdate' placeholder="Start" required>
            <div class="input-group-prepend">
              <span class="input-group-text">Ende</span>
            </div>
            <input class="form-control" type='date' name='enddate' placeholder="Ende" required>
          </div>
        </div>
        <div class="modal-footer">
          <div class="btn-group">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('message.close')</button>
            <button type="submit" class="btn btn-primary">Erstellen</button>
          </div> 
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
