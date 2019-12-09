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

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Kreon:400,700|Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.materialdesignicons.com/4.5.95/css/materialdesignicons.min.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">    
        <div class="vertical-nav bg-white">       
            <nav class="nav flex-column">
                    <a href="{{ url('/') }}" class="nav-brand mx-auto p-2 mdi mdi-home h2"></a>
                    <a href="{{ url('/menu') }}" class="nav-link mx-auto mdi mdi-calendar-month h2"></a>
                    <a href="{{ url('/tables') }}" class="nav-link mx-auto mdi mdi-silverware h2"></a>
                    <a href="" class="nav-link mx-auto mdi mdi-food h2"></a>
                    <a href="" class="nav-link mx-auto mdi mdi-account-box h2"></a>
                    <a class="nav-link mx-auto mdi mdi-logout h2" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                        {{ __('') }}
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
    </div>
</body>
</html>
