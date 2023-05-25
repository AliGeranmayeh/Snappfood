@extends('layouts.main-nav')
@section('css-link')
    <style>
        .text{
            padding: 1%;
            width:100%;
        }
        article{
            width: 65%;
            margin: auto
        }
    </style>
@endsection

@section('content')
    
    @if (count($comments) == 0)
        <h2 class="text-center text-white">No not  confirmed comments is available...</h2>
    @endif
    <div class="container grid my-5">
        @foreach ($comments as $comment)
            <article class="rounded " style="background-color: white">
                <div  class="text">
                    <h5 ><b>User: {{$comment['user']}}</b></h5>
                    <div>
                    <p style="padding:0 3%">{{$comment['comment']}}</p>
                     <form action="" method="post" class="d-flex justify-content-center">
                            @csrf
                            <button name="delete" type="button" class="btn btn-danger m-1  w-25"><a href="check_comments/delete/{{$comment['id']}}">Delete</a></button>
                            <button name="confirm" type="button" class="btn btn-success m-1 w-25"><a href="check_comments/confirm/{{$comment['id']}}">Confirm</a></button>
                     </form>
                    </div>
                </div>
            </article>
        @endforeach
    </div>
    </div>
@endsection