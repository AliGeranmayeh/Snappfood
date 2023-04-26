<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="styles/admin/admin-panel.css">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
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
                <li><a href="#"> <img src="https://www.svgrepo.com/download/3278/users.svg" alt="users-logo" style="width:20px;height:20px"> <span class="mx-1">Users</span></a></li>
                <li><a href="#"> <img src="https://icons.veryicon.com/png/o/miscellaneous/imperial-reservation/food-fair-western-food.png" alt="restaurants-logo" style="width:20px;height:20px"> <span class="mx-1">Restaurants</span></a></li>
                <li><a href="#"> <img src="https://svgsilh.com/svg/303194.svg" alt="restaurant-categories-logo" style="width:20px;height:20px"> <span class="mx-1">Restaurant Categories</span></a></li>
                <li><a href="#"> <img src="https://cdn.iconscout.com/icon/premium/png-256-thumb/favorite-food-3144240-2616918.png" alt="food-categorie-logo" style="width:20px;height:20px"> <span class="mx-1">Food Categories</span></a></li>
                <li><a href="#"> <img src="https://cdn-icons-png.flaticon.com/512/600/600260.png" alt="discounts-logo" style="width:20px;height:20px"> <span class="mx-1">Discounts</span></a></li>
                <li><a href="#"> <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/29/Comment_alt_font_awesome.svg/512px-Comment_alt_font_awesome.svg.png" alt="comments-logo" style="width:20px;height:20px"> <span class="mx-1">Comments</span></a></li>
                <li><a href="#"> <img src="https://static.thenounproject.com/png/4914083-200.png" alt="banner-logo" style="width:20px;height:20px;"> <span class="mx-1">Banners</span></a></li>            </ul>
        </nav>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
