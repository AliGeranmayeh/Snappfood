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
@if (count($users) == 1)
            <h2 class="text-center my-5">No user is available...</h2>
        @endif
    <div class="container grid">
        @foreach ($users as $user)
            @if ($user->name != 'admin')
                <article class="rounded">
                    <div class="text">
                        <h3 style="margin:10% 0"><b>{{ $user->name }}</b></h3>
                        <div>
                            <p>Email: {{ $user->email }}</p>
                            <p>Phone Number: 0{{ $user->phone_number }}</p>
                        </div>
                    </div>
                </article>
                
            @endif
        @endforeach
    </div>
    </div>
@endsection
