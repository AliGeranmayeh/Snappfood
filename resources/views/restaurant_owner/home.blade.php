@extends('layouts.main-nav')


@section('css-link')
    <style>
        .grid-1 {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 2fr));
            grid-gap: 20px;
            align-items: stretch;
        }

        .grid>article {
            border: 1px solid #ccc;
            box-shadow: 2px 2px 6px 0px rgba(0, 0, 0, 0.3);
        }

        p {
            font-size: 25px
        }

        .grid>article img {
            max-width: 100%;
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
        <button class="btn btn-outline-primary" type="submit" name="search">Search</button>
    </form>
    @if (count($foods) == 0)
        <h2 class="text-center">No food is available...</h2>
    @endif
    <div class="container grid">
        <div class="row row-cols-4 gap-3">
            @foreach ($foods as $food)
                @if ($food->discount_id == $food_party_id)
                    <article class="rounded  mb-2 bg-secondary text-white  p-0">
                    @else
                        <article class="rounded p-0" style="background-color: white">
                @endif

                <img class="rounded-top" src="{{ asset($food->image) }}" alt="user-photo"
                    style="width:100%">
                <div class="p-3">
                    <h3 style="margin:10% 0"><b>Food: {{ $food->name }}</b></h3>
                    <div>
                        @if ($food->materials)
                            <p style="font-size: 18px">Materials: {{ $food->materials }}</p>
                        @endif
                        @if ($food->discount_id)
                            <p style="font-size: 18px">Price: <span
                                    style="text-decoration: line-through;text-decoration-color:#fa4454;text-decoration-thickness: 2px;">
                                    {{ $food->price }}</span> <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                    height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
                                </svg> with
                                {{ $food->discount * 100 }}% off
                                <span style="color: #fa4454">{{ $food->price - $food->price * $food->discount }}</span> T
                            </p>
                        @else
                            <p style="font-size: 18px">Price: {{ $food->price }} T</p>
                        @endif

                        <form action="" method="post" style="display: flex;justify-content:center">
                            @csrf
                            <button name="delete" class="btn btn-danger w-50" type="submit" style="font-size: 16px"
                                value="{{ $food->id }}">Delete</button>
                            <a href="{{ route('get-edit-food', ['id' => $food->id]) }}"
                                class="btn btn-warning mx-2 w-50 text-white" style="font-size: 16px">Edit</a>
                        </form>
                    </div>

                </div>
                </article>
            @endforeach
        </div>
    </div>
@endsection
