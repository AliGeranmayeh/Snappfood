@extends('layouts.admin-nav')

@section('content')
    <div class="container">
        <div class="page rounded-3 bg-white p-3" style="width: 70%;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
            <div  style="display: flex;justify-content: center;">
                <img class="rounded-circle" style="box-shadow: rgba(3, 102, 214, 0.3) 0px 0px 0px 3px;" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQRX8dynXybfS6wigDf4NaxHGniwpxaLSZrVlqoo9ktj_JFaY4j8AnWkmgd51XSoOC_52o&usqp=CAU" alt="user-profile">

            </div>

            <div class="my-5">
                <p style="display: flex;justify-content: center;" class="rounded-pill border border-success border-2 mx-5 " ><strong>Name:</strong> &nbsp;{{ $user->name}}</p>
                <p style="display: flex;justify-content: center;" class="rounded-pill border border-success border-2 mx-5 "><strong>Email:</strong>&nbsp;  {{$user->email}}</p>
                <p style="display: flex;justify-content: center;" class="rounded-pill border border-success border-2 mx-5 "><strong>Phone Number:</strong>&nbsp;  0{{$user->phone_number}}</p>
            </div>
        </div>
    </div>
@endsection
