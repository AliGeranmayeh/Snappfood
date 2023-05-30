@extends('layouts.main-nav')


@section('css-link')
    <style>


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
        <select class="form-select d-inline mx-2" aria-label="Default select example" style="width: 14%;margin:auto" name="order_time_filter">
            <option value ='0' selected >Date Filter</option>
            <option value="week"  >Last Week</option>
            <option value="month">Last Month</option>
        </select>
        <select class="form-select d-inline" aria-label="Default select example" style="width: 70%;margin:auto" name="order_status_filter">
            <option value ='0' selected >Order Status Filter</option>
            <option value="checking"  >cheking</option>
            <option value="preparing">preparing</option>
            <option value="sending">sending</option>
            <option value="delivered">delivered</option>
        </select>
        <button style="width: 7%;margin:auto" class="btn btn-outline-primary mx-3" type="submit" name="filter" >Filter</button>
    </form>
    <div style="margin: auto;width:20%" class="my-5">
        <span  class="rounded my-3 text-center p-1 mx-1" style="background-color: white;margin:auto; width:10%">Total Income: {{$total_income}} T</span>
    <span  class="rounded my-3 text-center p-1 mx-1" style="background-color: white;margin:auto; width:10%">Orders Count: {{count($orders)}} </span>
    </div>
    
    @if (count($orders) == 0)
        <h2 class="text-center">No Order is available...</h2>
    @endif
    <div class="container grid row row-cols-4 gap-3">
        @foreach ($orders as $order)
            <article class="rounded " style="background-color: white ">
                <div class="text ">
                    <h5 style="margin:10% 0;font-size: 20px"><b>Status: {{ $order->order_status }}</b></h5>
                    <div>
                        <p style="font-size: 18px">Price: {{ $order->cart->total_price }} T</p>
                        <p style="font-size: 18px">food<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16" >
                            <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                          </svg>Count:
                            @foreach ($order->cart->foods as $food)
                                <span class="mx-2">{{ $food->food_name }} <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16" >
                                    <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                                  </svg> {{ $food->food_count }}</span>
                            @endforeach
                        </p>
                        @if ($order->order_status != 'delivered')
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
                        @endif
                    </div>
                </div>
            </article>
        @endforeach
    </div>
    </div>
@endsection
