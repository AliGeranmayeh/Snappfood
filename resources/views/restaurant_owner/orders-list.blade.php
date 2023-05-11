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
        <select class="form-select d-inline" aria-label="Default select example" style="width: 90%;margin:auto" name="order_status_filter">
            <option value ='0' selected >Order Status Filter</option>
            <option value="checking"  >cheking</option>
            <option value="preparing">preparing</option>
            <option value="sending">sending</option>
            <option value="delivered">delivered</option>
        </select>
        <button style="width: 7%;margin:auto" class="btn btn-outline-light mx-3" type="submit" name="filter" >Filter</button>

    </form>
    @if (count($orders) == 0)
        <h2 class="text-center text-white">No Order is available...</h2>
    @endif
    <div class="container grid">
        @foreach ($orders as $order)
            <article class="rounded " style="background-color: white">
                <div class="text ">
                    <h5 style="margin:10% 0"><b>status: {{ $order->order_status }}</b></h5>
                    <div>
                        <p>Price: {{ $order->cart->total_price }}</p>
                        <p >foods:
                            @foreach ($order->cart->foods as $food)
                                <span class="mx-2">{{ $food->food_name }}</span>
                            @endforeach
                        </p>
                        <form class="my-2" method="post" style="width: 100%;">
                            @csrf
                            <select class="form-select d-inline" aria-label="Default select example" style="width: 60%" name="order_statuse">
                                <option value="checking" @php if($order->order_status=='0'){echo "selected";} @endphp >cheking</option>
                                <option value="preparing" @php if($order->order_status=='cheking'){echo "selected";} @endphp >preparing</option>
                                <option value="sending" @php if($order->order_status=='sending'){echo "selected";} @endphp>sending</option>
                                <option value="delivered" @php if($order->order_status=='delivered'){echo "selected";} @endphp>delivered</option>
                            </select>
                            <button class="btn btn-outline-secondary mx-2" type="submit" name="change_status" value="{{$order->id}}">Change</button>
                        </form>
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
