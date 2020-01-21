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
            <nav class="nav flex-column">
                    <a href="{{ url('/') }}" class="nav-brand mx-auto mt-3"><i class="fas fa-home navIcon"></i></a>
                    <a href="{{ url('/menu') }}" class="nav-link mx-auto mt-3"><i class="far fa-calendar-alt navIcon"></i></a>
                    <a href="{{ url('/tables') }}" class="nav-link mx-auto mt-3"> <i class="fas fa-utensils navIcon"></i></a>
                    <a href="{{ url('/customer') }}" class="nav-link mx-auto mt-3"><i class="far fa-address-card navIcon"></i></a>
                    <a class="nav-link mx-auto mt-3" href="{{ route('logout') }}" 
                        onclick="
                            event.preventDefault();
                            document.getElementById('logout-form').submit();
                        ">
                        {{ __('') }} <i class="fas fa-sign-out-alt navIcon"></i>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
            </nav>    
        </div>
        <div class="page-content">
            <main >
                @yield('content')
            </main>
        </div>
</body>
</html>