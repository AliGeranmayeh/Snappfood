@extends('layouts.admin-nav')

@section('content')

@if (count($comments) == 0 )
        <h2 class="text-center my-5">No comment is available...</h2>
    @endif
<div class="container my-5">
    @foreach ($comments as $comment)
        <article class="rounded my-3 p-3" style="background-color: white;width:50%;margin:auto">
            <div class="text">
                <h5><b>User: {{ $comment['user']->name }}</b></h5>
                <div>
                    <p style="padding:0 3%">{{ $comment['comment'] }}</p>
                    @if ( $comment['reply'] != null)
                    <h5 style="color: rgb(48, 173, 69); padding:0 5%"><b>answer: {{ $comment['reply']->comment}}</b></h5>
                    @else
                    <div class="d-flex justify-content-center">
                        <a href="{{route('confirm-delete-comment',[$comment['id']])}}" name="confirm" class="btn btn-success m-1  w-25" value ='1'>
                            Confirm Delete 
                        </a>
                        <a href="{{route('decline-delete-comment',[$comment['id']])}}" name="decline" class="btn btn-danger m-1  w-25" value ='1'>
                            Decline Delete 
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </article>
    @endforeach
</div>
@endsection