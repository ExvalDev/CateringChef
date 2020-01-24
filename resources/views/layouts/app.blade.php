<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/functions.js') }}" defer></script>

    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Toastr JS -->
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <link href="https://fonts.googleapis.com/css?family=Kreon:400,700|Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" integrity="sha256-+N4/V/SbAFiW1MPBCXnfnP9QSN3+Keu+NlB+0ev/YKQ=" crossorigin="anonymous" />
    <link rel="stylesheet" href="//cdn.materialdesignicons.com/4.5.95/css/materialdesignicons.min.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('styles')

    <!-- Toastr CSS -->
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">

    {{-- Scrollbar --}}
    <link rel="stylesheet" href="https://unpkg.com/simplebar@latest/dist/simplebar.css"/>
    <script src="https://unpkg.com/simplebar@latest/dist/simplebar.min.js"></script>
</head>
<body>
    @stack('scripts')
    {{-- Notification --}}
    <script src="{{ asset('js/toastr.js') }}"></script>
    <script>
        @if(Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}";
            switch(type){
                case 'info':
                    toastr.info("{{ Session::get('message') }}");
                    break;

                case 'warning':
                    toastr.warning("{{ Session::get('message') }}");
                    break;

                case 'success':
                    toastr.success("{{ Session::get('message') }}");
                    break;

                case 'error':
                    toastr.error("{{ Session::get('message') }}");
                    break;
            }
        @endif
    </script>
    <div id="app">    
        <div class="vertical-nav bg-white">       
            <nav class="nav flex-column h-100">
                    <a class="navbar-brand mx-auto" href="#"><img src="../img/CC-logo.png" class="mx-auto d-block" alt="CC" width="80%"></a>
                    <a href="{{ url('/menu') }}" class="navBtn nav-link mx-auto mt-2" data-toggle="tooltip" data-placement="right" title="Speiseplan"><i class="far fa-calendar-alt navIcon"></i></a>
                    <a href="{{ url('/tables') }}" class="navBtn nav-link mx-auto mt-2" data-toggle="tooltip" data-placement="right" title="Tabellen"> <i class="fas fa-utensils navIcon"></i></a>
                    <a href="{{ url('/recipes') }}" class="navBtn nav-link mx-auto mt-2" data-toggle="tooltip" data-placement="right" title="Rezepte"> <i class="fas fa-book navIcon"></i></a>
                    <a href="{{ url('/customer') }}" class="navBtn nav-link mx-auto mt-2" data-toggle="tooltip" data-placement="right" title="Kunden"><i class="far fa-address-card navIcon"></i></a>
                    <a href="{{ url('/supplier') }}" class="navBtn nav-link mx-auto mt-2" data-toggle="tooltip" data-placement="right" title="Lieferanten"><i class="fas fa-truck navIcon"></i></a>
                    <a class="nav-link mx-auto mt-2 navResponsiveTrigger" data-toggle="tooltip" data-placement="right" title="Navigation"><i class="fas fa-bars navIcon" data-toggle="collapse" data-target="#responsive-nav"></i></a>
                    <div class="mt-auto mb-2 w-100 text-center">
                        <a href="{{ url('/settings') }}" class="navBtn nav-link mx-auto" data-toggle="tooltip" data-placement="right" title="Einstellungen"><i class="fas fa-cog navIcon"></i></a>
                        <a href="{{ route('logout') }}" class="navBtn nav-link mx-auto mt-2 mb-3" data-toggle="tooltip" data-placement="right" title="Ausloggen"
                            onclick="
                                event.preventDefault();
                                document.getElementById('logout-form').submit();
                            ">
                            {{ __('') }} <i class="fas fa-sign-out-alt navIcon"></i>
                        </a>
                        <span class="navText">
                            @php
                                $dayNr = date('N');
                                switch ($dayNr) {
                                    case 1:
                                        echo 'Montag';
                                        break;
                                    case 2:
                                        echo 'Dienstag';
                                        break;
                                    case 3:
                                        echo 'Mittwoch';
                                        break;
                                    case 4:
                                        echo 'Donnerstag';
                                        break;
                                    case 5:
                                        echo 'Freitag';
                                        break;
                                    case 6:
                                        echo 'Samstag';
                                        break;
                                    case 7:
                                        echo 'Sonntag';
                                        break;  
                                }
                            @endphp
                            
                        </span>    
                        <span class="navText">
                            @php
                                echo (date('d.m.Y'))
                            @endphp
                        </span>  
                    </div>
                    
            </nav>    
        </div>
        <div id="responsive-nav" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <nav class="navbar">
                            <a href="{{ url('/menu') }}" class="navResonsiveBtn nav-link" data-toggle="tooltip" data-placement="right" title="Speiseplan"><i class="far fa-calendar-alt navIcon"></i></a>
                            <a href="{{ url('/tables') }}" class="navResonsiveBtn nav-link " data-toggle="tooltip" data-placement="right" title="Tabellen"> <i class="fas fa-utensils navIcon"></i></a>
                            <a href="{{ url('/recipes') }}" class="navResonsiveBtn nav-link " data-toggle="tooltip" data-placement="right" title="Rezepte"> <i class="fas fa-book navIcon"></i></a>
                            <a href="{{ url('/customer') }}" class="navResonsiveBtn nav-link " data-toggle="tooltip" data-placement="right" title="Kunden"><i class="far fa-address-card navIcon"></i></a>
                            <a href="{{ url('/supplier') }}" class="navResonsiveBtn nav-link " data-toggle="tooltip" data-placement="right" title="Lieferanten"><i class="fas fa-truck navIcon"></i></a>
                            <a href="{{ url('/settings') }}" class="navResonsiveBtn nav-link" data-toggle="tooltip" data-placement="right" title="Einstellungen"><i class="fas fa-cog navIcon"></i></a>
                            <a href="{{ route('logout') }}" class="navResonsiveBtn nav-link" data-toggle="tooltip" data-placement="right" title="Ausloggen"
                                onclick="
                                    event.preventDefault();
                                    document.getElementById('logout-form').submit();
                                ">
                                {{ __('') }} <i class="fas fa-sign-out-alt navIcon"></i>
                            </a>
                        </nav>
                    </div>   
                </div>
            </div>
        </div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        <div class="page-content">
            <main >
                @yield('content')
            </main>
        </div>
</body>
<script>
    $(function () {
      $('[data-toggle="tooltip"]').tooltip();
    })
    $(document).ready(function(){
        $('.navResponsiveTrigger').click(function(){
            $('#responsive-nav').modal("show");
        });
    });
</script>
</html>