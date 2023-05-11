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

        .text {
            padding: 0 10px 10px;
        }
    </style>
@endsection

@section('content')
    <form class="my-5" method="post" style="width: 70%;margin:auto">
        @csrf
        <select class="form-select d-inline" aria-label="Default select example" style="width: 20%" name="food_category_filter">
            <option value="0" selected>Order Status Filter</option>
            {{-- @foreach ($food_categories as $food_category)
                <option value="{{ $food_category->id }}">
                    {{ $food_category->name }}
                </option>
            @endforeach --}}
        </select>
    </form>
    @if (count($orders) == 0)
        <h2 class="text-center text-white">No Order is available...</h2>
    @endif
    <div class="container grid">
        @foreach ($orders as $order)
            <article class="rounded " style="background-color: white">
                <div class="text ">
                    <h3 style="margin:10% 0"><b>{{ $order->cart_id }}</b></h3>
                    <div>
                        {{-- <p>Materials: {{ $food->materials }}</p> --}}
                        {{-- <form action="" method="post">
                            @csrf
                            <button name="delete" class="btn btn-danger" type="submit"
                                value="{{ $order->id }}">Delete</button>
                            <a href="edit_food/{{ $order->id }}" class="btn btn-warning mx-2">Edit</a>
                        </form> --}}
                    </div>
                    {{-- <a href="user/{{$user->id}}" class="btn btn-primary">More</a> --}}

                </div>
            </article>
        @endforeach
    </div>
    </div>
@endsection
