@extends('layouts.admin-nav')

@section('content')
<div class="container my-5">
    @foreach ($confirmed_comments as $comment)
        <article class="rounded my-3" style="background-color: white">
            <div class="text">
                <h5><b>User: {{ $comment['user'] }}</b></h5>
                <div>
                    <p style="padding:0 3%">{{ $comment['comment'] }}</p>
                    @if ( $comment['reply'] != null)
                    <h5 style="color: rgb(48, 173, 69); padding:0 5%"><b>answer: {{ $comment['reply']->comment}}</b></h5>
                    @else
                    <div class="d-flex justify-content-center">
                        <a href="comments/confirm_delete/{{ $comment['id'] }}" name="delete" class="btn btn-success m-1  w-25">
                            Confirm Delete 
                        </a>
                        <a href="comments/decline_delete/{{ $comment['id'] }}" name="delete" class="btn btn-danger m-1  w-25">
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