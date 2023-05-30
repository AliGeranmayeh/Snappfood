@extends('layouts.main-nav')


@section('css-link')
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
    <form class="my-5" method="post" style="width: 70%;margin:auto">
        @csrf
        <select class="form-select d-inline" aria-label="Default select example" style="width: 20%" name="food_category_filter">
            <option value="0" selected>Food Category Filter</option>
            @foreach ($food_categories as $food_category)
                <option value="{{ $food_category->id }}">
                    {{ $food_category->name }}
                </option>
            @endforeach
        </select>
        <input class="form-control d-inline mx-2" type="search" placeholder="Search" name="search_field" style="width:70%">
        <button class="btn btn-outline-light" type="submit" name="search">Search</button>
    </form>
    @if (count($foods) == 0)
        <h2 class="text-center text-white">No food is available...</h2>
    @endif
    <div class="container grid">
        <div class="row row-cols-4 gap-3">
            @foreach ($foods as $food)
                @if ($food->discount_id == $food_party_id)
                    <article class="rounded p-3 mb-2 bg-secondary text-white">
                    @else
                        <article class="rounded " style="background-color: white">
                @endif

                <img class="rounded-top" src="{{ asset($food->image) }}" alt="user-photo"
                    style="box-shadow: rgba(0, 0, 0, 0.45) 0px 25px 20px -20px;width:100%">
                <div class="text ">
                    <h3 style="margin:10% 0"><b>{{ $food->name }}</b></h3>
                    <div>
                        @if ($food->materials)
                            <p>Materials: {{ $food->materials }}</p>
                        @endif
                        @if ($food->discount_id)
                            <p>Price: <span style="text-decoration: line-through;"> {{ $food->price }}</span> -> with
                                {{ $food->discount * 100 }}% off
                                <span>{{ $food->price - $food->price * $food->discount }}</span>
                            </p>
                        @else
                            <p>Price: {{ $food->price }}</p>
                        @endif
                        <form action="" method="post">
                            @csrf
                            <button name="delete" class="btn btn-danger" type="submit"
                                value="{{ $food->id }}">Delete</button>
                            <a href="edit_food/{{ $food->id }}" class="btn btn-warning mx-2">Edit</a>
                        </form>
                    </div>
                    {{-- <a href="user/{{$user->id}}" class="btn btn-primary">More</a> --}}

                </div>
                </article>
            @endforeach
        </div>
    </div>
@endsection
