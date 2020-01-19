@extends('layouts.app')
@push('styles')
    <link href="{{ asset('css/style_customers.css') }}" rel="stylesheet">

    <script src="https://js.api.here.com/v3/3.1/mapsjs-core.js"
    type="text/javascript" charset="utf-8"></script>
    <script src="https://js.api.here.com/v3/3.1/mapsjs-core-legacy.js"
    type="text/javascript" charset="utf-8"></script>
    <script src="https://js.api.here.com/v3/3.1/mapsjs-service.js"
    type="text/javascript" charset="utf-8"></script>
    <script src="https://js.api.here.com/v3/3.1/mapsjs-service-legacy.js"
    type="text/javascript" charset="utf-8"></script>
@endpush
@section('content')
<div class="container-fluid row m-0 p-0 vh-100">
    <div class="col-8 m-0 py-3 px-2 tableHeight">
        <div>
            <h1> Kunden </h1>
        </div>
        <div class="bg-white shadow-sm h-100 mh-100 d-flex flex-column">
            {{-- Header --}}
            <div class="d-flex flex-column"> 
                <table class=" mt-2 w-100">
                    <thead>
                        <tr class="row mx-2">
                            <th scope="col" class="col-3 pl-2"><h3>Name</h3></th>
                            <th scope="col" class="col-3 pl-2"><h3>Erwachsene</h3></th>
                            <th scope="col" class="col-3 pl-2"><h3>Kinder</h3></th>
                            <th scope="col" class="col-3 pl-2 pr-0">
                                <button type="button" class="btn p-0 btn-primary shadow-none float-right" data-toggle="modal" data-target="#addingredient"><h2 class="mdi mdi-plus m-0"></h2></button>
                            </th>
                        </tr>
                    </thead>
                </table>
                <hr class="w-100 my-2"/>
            </div>
            {{-- Content area --}}
            <div data-simplebar class="h-100 mh-100 p-2 overflow-auto">
                <table class="table table-borderless">
                    <tbody>
                        @for ($i = 0; $i < 10; $i++)
                            <tr class="row mx-0 mb-2 bg-light rounded">
                                <td class="col-3"><h4>Test Kunde {{$i}}</h4></td>
                                <td class="col-3"><h4>200</h4></td>
                                <td class="col-3"><h4>100</h4></td>
                                <td class="col-3">
                                    edit..
                                </td>  
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div> 
        </div>
    </div>
    <div class="col-4 m-0 pb-4 pt-3 px-2 tableHeight">
        <h1> &nbsp; </h1>
        <div class="bg-white shadow-sm h-50 mh-50  mb-2 d-flex flex-column" id="mapContainer">
            <script>
                var platform = new H.service.Platform({
                    'apikey': '{dzpjBMch4PbCH5w8XkgOrWMGPjRhTQ6v8QwsGeVdgyg}'
                });
                // Obtain the default map types from the platform object:
                var defaultLayers = platform.createDefaultLayers();

                // Instantiate (and display) a map object:
                var map = new H.Map(
                    document.getElementById('mapContainer'),
                    defaultLayers.vector.normal.map,
                    {
                    zoom: 10,
                    center: { lat: 52.5, lng: 13.4 },
                    engineType: H.map.render.RenderEngine.EngineType.P2D
                    });
            </script>
        </div>
        <div class="bg-white shadow-sm h-50 mh-50 d-flex flex-column">
        </div>
    </div>
</div>

@endsection
