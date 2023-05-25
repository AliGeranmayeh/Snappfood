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
    
    @if (count($delete_request_comments) == 0 && count($confirmed_comments) == 0)
        <h2 class="text-center text-white">No comment is available...</h2>
    @endif
    <div class="container grid my-5">
        @foreach ($delete_request_comments as $comment)
        <article class="rounded my-3 border border-3 border-danger" style="background-color: #ffdde2;">
            <div  class="text">
                <h5 ><b>User: {{$comment['user']}}</b></h5>
                <div>
                <p style="padding:0 3%">{{$comment['comment']}}</p>
                </div>
            </div>
        </article>
    @endforeach
    <div style="width:100%;margin:6%"></div>
        @foreach ($confirmed_comments as $comment)
            <article class="rounded my-3" style="background-color: white">
                <div  class="text">
                    <h5 ><b>User: {{$comment['user']}}</b></h5>
                    <div>
                    <p style="padding:0 3%">{{$comment['comment']}}</p>
                     <form action="" method="post" class="d-flex justify-content-center">
                            @csrf
                            <button name="delete" type="button" class="btn btn-danger m-1  w-25 "><a class="text-white" style="text-decoration: none" href="comments/delete_request/{{$comment['id']}}">Delete Request</a></button>
                     </form>
                    </div>
                </div>
            </article>
        @endforeach
    </div>
    </div>
@endsection