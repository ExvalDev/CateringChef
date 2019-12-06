@extends('layouts.app')

@section('content')
    <div class="container p-0 float-left">
        <h1 class="float-left m-0">Zutat</h1>
        <button id="addzutat" type="button" class="btn float-right" data-toggle="modal" data-target="#addzutatmodal"><i class="fas fa-plus"></i> Zutat</button>
    </div>
    <div class="container bg-white p-0 float-left">
        <div class="container p-2">
            <input class="form-control" id="SearchZutat" type="text" placeholder="Search..">
            <hr class="m-2" style="border:solid #CCDB75 1px;">
        </div>
        <ul class="list-group p-2 overflow-auto" id="ListZutat">
            @foreach ($ingredients as $ingredient)
                <li class="list-group-item bg-light rounded my-1 border-0">
                        {{ $ingredient->name }}
                </li>
            @endforeach
        </ul>
    </div>

    <a href="/tables/create">Zutat hinzufügen</a>
@endsection