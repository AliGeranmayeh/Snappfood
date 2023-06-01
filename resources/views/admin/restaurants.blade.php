@extends('layouts.admin-nav')
@section('header')
    <link href="styles/admin/navbar.css" rel="stylesheet">
    <style>
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 2fr));
            grid-gap: 20px;
            align-items: stretch;
        }

        .grid>article {
            border: 1px solid #ccc;
            box-shadow: 2px 2px 6px 0px rgba(0, 0, 0, 0.3);
        }

        .grid>article img {
            max-width: 100%;
        }

        .text {
            padding: 0 10px 10px;
        }
    </style>
@endsection

@section('content')
    @if (count($restaurants) == 0)
        <h2 class="text-center my-5">No Restaurant is available...</h2>
    @endif
    <div class="container grid">

        @foreach ($restaurants as $restaurant)
            <article class="rounded">
                <div class="text">
                    <h3 style="margin:10% 0"><b>{{ $restaurant->name }}</b></h3>
                    <div>
                        <p>Owner: {{ $restaurant->user->name }}</p>
                        <p>Phone Number: {{ $restaurant->phone }}</p>
                        <p>Account: {{ $restaurant->account }}</p>
                        <p>Address: {{ $restaurant->address }}</p>
                    </div>
                </div>
            </article>
        @endforeach
    </div>
    </div>
@endsection
