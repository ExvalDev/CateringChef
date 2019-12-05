@extends('layouts.app')

@section('content')
    @foreach ($ingredients as $ingredient)
        <p>{{ $ingredient->name }}</p>
    @endforeach
    <a href="/tables/create">Zutat hinzufügen</a>
@endsection