<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Auth') }}</title>
    
    @yield('css-link')
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark shadow-sm " style="width: 100%; position: fixed; background: linear-gradient(to right, #5ba4cf ,#055a8c, #055a8c,  #242444) !important; z-index: 9; margin-bottom: 2%">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}" style="margin: auto">
                    <img src="https://svgsilh.com/svg/2085075.svg" alt="logo" style="width:50px;height:50px">
                    <span class="mx-2">Snapp Food</span>
                </a>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
