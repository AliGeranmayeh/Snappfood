@extends('layouts.admin-nav')


@section('content')
    <div class="container">
        <div class="row justify-content-md-center  " style="height: 33%">
            <div class="col col-lg-10 bg-white p-3 rounded"
                style="box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;">
                @if (count($users) == 0)
                    <h4 class="text-center ">No user exists...</h4>
                @else
                    <table class="table">
                        <tbody>
                            <tr>
                                <th class="text-center fs-4 m-0 " colspan="4">
                                    Users
                                </th>
                            </tr>
                            @foreach ($users as $key => $user)
                                <tr>
                                    <th scope="row">
                                        @php $row_number = $key; @endphp
                                        {{ ++$row_number }}
                                    </th>
                                    <td class="text-center">{{ $user->name }}</td>
                                    <td class="text-center"> {{ $user->email }}</td>
                                    <td class="text-center"> 0{{ $user->phone_number }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('users') }}" class="btn btn-primary w-25 ">More</a>
                    </div>
                @endif
            </div>
            <div class="row justify-content-md-center my-4" style="height: 34%">
                <div class="col col-lg-10 bg-white p-3 rounded"
                    style="box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;">
                    @if (count($restaurants) == 0)
                        <h4 class="text-center ">No restaurant exists...</h4>
                    @else
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th class="text-center fs-4 m-0 " colspan="4">
                                        Restaurants
                                    </th>
                                </tr>
                                @foreach ($restaurants as $key => $restaurant)
                                    <tr>
                                        <th scope="row">
                                            @php $row_number = $key; @endphp
                                            {{ ++$row_number }}
                                        </th>
                                        <td class="text-center">{{ $restaurant->name }}</td>
                                        <td class="text-center"> {{ $restaurant->phone }}</td>
                                        <td class="text-center"> {{ $restaurant->user->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('show-restaurant-page') }}" class="btn btn-primary w-25 ">More</a>
                        </div>
                    @endif
                </div>

            </div>
            <div class="row justify-content-md-center" style="height: 33%">
                <div class="col col-lg-3 bg-white mx-4 p-3 rounded"
                    style="box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;">
                    @if (count($discounts) == 0)
                        <h4 class="text-center " style="margin: 30% 0">No discount exists...</h4>
                    @else
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th class="text-center fs-4 m-0 " colspan="3">
                                        Discounts
                                    </th>
                                </tr>
                                @foreach ($discounts as $key => $discount)
                                    <tr>
                                        <th scope="row">
                                            @php $row_number = $key; @endphp
                                            {{ ++$row_number }}
                                        </th>
                                        <td class="text-center">{{ $discount->name }}</td>
                                        <td class="text-center"> {{ $discount->percentage }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('get-discount') }}" class="btn btn-primary w-50 ">More</a>
                        </div>
                    @endif
                </div>
                <div class="col col-lg-3 bg-white mx-4 p-3 rounded"
                    style="box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;">
                    @if (count($food_categories) == 0)
                        <h4 class="text-center" style="margin: 30% 0">No food category exists...</h4>
                    @else
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th class="text-center fs-4 m-0 " colspan="2">
                                        Food Categories
                                    </th>
                                </tr>
                                @foreach ($food_categories as $key => $food_category)
                                    <tr>
                                        <th scope="row">
                                            @php $row_number = $key; @endphp
                                            {{ ++$row_number }}
                                        </th>
                                        <td class="text-center">{{ $food_category->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('food-category') }}" class="btn btn-primary w-50 ">More</a>
                        </div>
                    @endif
                </div>
                <div class="col col-lg-3 bg-white mx-4 p-3 rounded"
                    style="box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;">
                    @if (count($restaurant_categories) == 0)
                        <h4 class="text-center " style="margin: 30% 0">No restaurant category exists...</h4>
                    @else
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th class="text-center fs-4 m-0 " colspan="4">
                                        Restaurant Categories
                                    </th>
                                </tr>
                                @foreach ($restaurant_categories as $key => $restaurant_category)
                                    <tr>
                                        <th scope="row">
                                            @php $row_number = $key; @endphp
                                            {{ ++$row_number }}
                                        </th>
                                        <td class="text-center">{{ $restaurant_category->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('restaurant-category') }}" class="btn btn-primary w-50 ">More</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endsection
