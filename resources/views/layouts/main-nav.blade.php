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


    <link href="{{Asset('styles/admin/navbar.css')}}" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            list-style: none;
            box-sizing: border-box;
        }

        html,
        body,
        main {
            height: 100%;
            background: #d0e3ff;
        }

        .sidebar {
            overflow: auto;
            position: fixed;
            float: left;
            width: 15%;
            height: 100vh;
            background: #00478f;
        }


        .sidebar header {
            font-size: 20px;
            color: white;
            text-align: center;
            line-height: 70px;
            background: linear-gradient(to top, #00478f, #003f7e, #003366);
            ;
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
            padding: 3%
            float: right;
            width: 85%;
            height: 100%;
            background: #d0e3ff;
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
                @can('complete-restaurant-profile')
                    <li><a href="{{ route('home') }}"> <img
                                src="https://icons-for-free.com/iconfiles/png/512/default+home+house+main+page+icon-1320186211000235547.png"
                                alt="home-logo" style="width:20px;height:20px"> <span class="mx-1">Home</span></a></li>
                    <li><a href="{{ route('show-order-page') }}"> <img
                                src="https://static.thenounproject.com/png/832921-200.png" alt="orders-logo"
                                style="width:20px;height:20px"> <span class="mx-1">Orders</span></a></li>
                    <li><a href="{{ route('get-add-food-page') }}"> <img
                                src="https://icons.veryicon.com/png/o/miscellaneous/imperial-reservation/food-fair-western-food.png"
                                alt="foods-logo" style="width:20px;height:20px"> <span class="mx-1">New Food</span></a>
                    </li>

                    <li><a href="{{ route('get-owner-discount') }}"> <img
                                src="https://cdn-icons-png.flaticon.com/512/600/600260.png" alt="discounts-logo"
                                style="width:20px;height:20px"> <span class="mx-1">Discounts</span></a></li>
                @endcan
                <li><a href="{{ route('restaurant-profile') }}"> <img
                            src="https://icons.veryicon.com/png/o/internet--web/prejudice/user-128.png"
                            alt="profile-logo" style="width:21px;height:21px;"> <span class="mx-1">Restaurant
                            Profile</span></a>
                </li>
                @can('complete-restaurant-profile')
                    <li><a href="{{ route('get-not-confirmed-comments') }}"> <img
                                src="https://static.thenounproject.com/png/2864219-200.png" alt="pending-comments-logo"
                                style="width:25px;height:25px"> <span class="mx-1">Pending Comments</span></a></li>
                    <li><a href="{{ route('get-confirmed-comments') }}"> <img
                                src="https://cdn.onlinewebfonts.com/svg/img_395479.png" alt="comments-logo"
                                style="width:18px;height:18px"> <span class="mx-1">Comments</span></a></li>
                @endcan
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
        <main class="p-3">
            @yield('content')
        </main>
    </div>
</body>

</html>
