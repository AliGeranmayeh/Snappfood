<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('SnappFood') }}</title>
    @yield('header')
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])


    <link href="styles/admin/navbar.css" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            list-style: none;
            box-sizing: border-box;
        }

        html,
        body {
            height: 100%;
            background: #e0f2f1;
        }

        .sidebar {
            overflow: auto;
            position: fixed;
            float: left;
            width: 15%;
            height: 100vh;
            background: #00897b;
        }


        .sidebar header {
            font-size: 20px;
            color: white;
            text-align: center;
            line-height: 70px;
            background: #00695c;
        }

        .sidebar ul a {
            text-decoration: none;
            display: block;
            height: 100%;
            width: 100%;
            line-height: 60px;
            color: white;
            padding-left: 10px;
            transition: 0.4s;

        }

        ul li:hover a {
            padding-left: 20px;
        }

        .sidebar ul {
            padding: 0;
        }

        main {
            float: right;
            width: 85%;
            height: 100%;
            background: #e0f2f1;
            color: black;
        }
    </style>
</head>

<body>
    <div id="app">

        <nav class="sidebar">
            <header>
                <a class="navbar-brand" href="{{ url('/admin') }}">
                    <img src="https://svgsilh.com/svg/2085075.svg" alt="logo" style="width:50px;height:50px">
                    <span class="mx-2">Snapp Food</span>
                </a>
            </header>
            <ul>
                <li><a href="{{ route('users') }}"> <img src="https://www.svgrepo.com/download/3278/users.svg"
                            alt="users-logo" style="width:20px;height:20px"> <span class="mx-1">Users</span></a></li>
                <li><a href="#"> <img
                            src="https://icons.veryicon.com/png/o/miscellaneous/imperial-reservation/food-fair-western-food.png"
                            alt="restaurants-logo" style="width:20px;height:20px"> <span
                            class="mx-1">Restaurants</span></a></li>
                <li><a href="{{route('restaurant-category')}}"> <img src="https://svgsilh.com/svg/303194.svg" alt="restaurant-categories-logo"
                            style="width:20px;height:20px"> <span class="mx-1">Restaurant Categories</span></a></li>
                <li><a href="{{route('food-category')}}"> <img
                            src="https://cdn.iconscout.com/icon/premium/png-256-thumb/favorite-food-3144240-2616918.png"
                            alt="food-categorie-logo" style="width:20px;height:20px"> <span class="mx-1">Food
                            Categories</span></a></li>
                <li><a href="{{route('get-discount')}}"> <img src="https://cdn-icons-png.flaticon.com/512/600/600260.png"
                            alt="discounts-logo" style="width:20px;height:20px"> <span
                            class="mx-1">Discounts</span></a></li>
                <li><a href="{{route('get-adminside-comments')}}"> <img src="https://cdn.onlinewebfonts.com/svg/img_395479.png" alt="comments-logo"
                            style="width:20px;height:20px"> <span class="mx-1">Comments</span></a></li>
                <li><a href="{{route('get-banners')}}"> <img src="https://static.thenounproject.com/png/4914083-200.png"
                            alt="banner-logo" style="width:20px;height:20px;"> <span class="mx-1">Banners</span></a>
                </li>
                <li><a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <img src="https://static.thenounproject.com/png/1043494-200.png" alt="banner-logo"
                            style="width:20px;height:20px;"> <span class="mx-1">Logout</span></a></li>
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
