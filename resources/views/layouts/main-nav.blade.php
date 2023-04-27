<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SnappFood</title>

    <link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/main_navbar.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    @yield('css-link')
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

</head>

<body>
    <div id="app">
        <input type="checkbox" id="active" style="z-index: 1000">
        <label for="active" class="menu-btn" style="z-index: 1000"><span></span></label>
        <label for="active" class="close" style="z-index: 1000"></label>
        <nav class="wrapper" style="z-index: 100">
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="#">Add Food</a></li>
                <li><a href="{{route('get-owner-discount')}}">Add Discount</a></li>
                <li><a href="{{route('restaurant-profile')}}">Restaurant Profile</a></li>
                <li><a href="#">User Profile</a></li>
                <li><a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">Logout</a>
                </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </ul>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>
