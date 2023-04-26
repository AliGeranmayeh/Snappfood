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
            padding: 0 20px 20px;
        }
    </style>
@endsection

@section('content')
    <div class="container grid">
        @foreach ($users as $user)
            @if ($user->name != 'admin')
                <article class="rounded">
                    <img class="rounded-top"
                        src="https://media.npr.org/assets/img/2014/08/07/monkey-selfie_custom-7117031c832fc3607ee5b26b9d5b03d10a1deaca-s1100-c50.jpg"
                        alt="user-photo">
                    <div class="text">
                        <h3 style="margin:10% 0"><b>{{ $user->name }}</b></h3>
                        <div>
                            <p>Email: {{ $user->email }}</p>
                            <p>Phone Number: 0{{ $user->phone_number }}</p>
                        </div>
                        <a href="user/{{$user->id}}" class="btn btn-primary">More</a>
                    </div>
                </article>
            @endif
        @endforeach
    </div>
    </div>
@endsection
