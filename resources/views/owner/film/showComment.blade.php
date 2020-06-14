@extends('layouts.layout')
@section('title','Film Details')
@section('content')

    <?php
        if (Auth::user()) {
            $id = Auth::user()->id;
        } else {
            $id = NULL;
        }
    ?>

    <style>
        .myImg {
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        .myImg:hover {
            opacity: 0.8;
        }

        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0, 0, 0); /* Fallback color */
            background-color: rgba(0, 0, 0, 0.9); /* Black w/ opacity */
        }

        /* Modal Content (Image) */
        .modal-content {
            margin: auto;
            display: block;
            width: 100%;
            max-width: 1000px;
        }

        /* Caption of Modal Image (Image Text) - Same Width as the Image */
        #caption {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
            text-align: center;
            color: #ccc;
            padding: 10px 0;
            height: 150px;
        }

        /* Add Animation - Zoom in the Modal */
        .modal-content, #caption {
            -webkit-animation-name: zoom;
            -webkit-animation-duration: 0.6s;
            animation-name: zoom;
            animation-duration: 0.6s;
        }

        @-webkit-keyframes zoom {
            from {
                -webkit-transform: scale(0)
            }
            to {
                -webkit-transform: scale(1)
            }
        }

        @keyframes zoom {
            from {
                transform: scale(0)
            }
            to {
                transform: scale(1)
            }
        }

        /* The Close Button */
        .close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
        }

        .close:hover,
        .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }

        /* 100% Image Width on Smaller Screens */
        @media only screen and (max-width: 700px) {
            .modal-content {
                width: 100%;
            }
        }
    </style>

    <!-- Modal for enlarge clicked image -->
    <div id="myModal" class="modal">
        <span class="close">&times;</span>
        <img class="modal-content" id="imgEnlrg">
        <div id="caption"></div>
    </div>

    <div class="container">
        <div class="row">
            <!-- Latest Posts -->
            <main class="posts-listing col-lg-9">
                <div class="container">
                    <div class="row">

                        <div class="row d-flex align-items-stretch pl-3">
                            <div class="text col-lg-12">
                                <div class="text-inner d-flex align-items-center">
                                    <div class="content">
                                        <header class="post-header pt-3">
                                            <h2 class="h6 font-weight-light dark-font">Name: {{$films[0]['name']}} </h2>
                                            <p>Description: {{$films[0]['description']}} </p>
                                            <p>Release: {{$films[0]['release']}} </p>
                                            <p>Rating: {{$films[0]['rating']}} </p>
                                            <p>Ticket: {{$films[0]['ticket']}} </p>
                                            <p>Price: {{$films[0]['price']}} </p>
                                            <p>Country: {{$films[0]['country']}} </p>
                                            <p>Date: {{$films[0]['createdAt']}} </p>
                                            @if($films[0]['photo'] != NULL)
                                                <img class="myImg" height="100px" width="auto" src="{{asset('/filmImage/'.$films[0]['photo'])}}">
                                            @endif
                                        </header>
                                        <footer class="post-footer d-flex align-items-center pt-2 pb-3">
                                            <span class="author d-flex align-items-center flex-wrap">
                                                <div class="title pr-2">
                                                    <span class="text-muted">{{$films[0]['user']['name']}}</span>
                                                </div>
                                            </span>
                                            <span>
                                                <div class="date pr-2">
                                                    <i class="icon-clock pr-1"></i>{{\Carbon\Carbon::parse($films[0]['createdAt'])->diffForHumans()}}
                                                </div>
                                            </span>
                                            <span>
                                                <div class="comments">
                                                    <i class="far fa-comment pr-1"></i>{{$films[0]['commentCount']}}
                                                </div>
                                            </span>
                                        </footer>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="blog-post container pl-3">
                    <div class="post-comments col-lg-11 pl-0">
                        @if($films[0]['commentList'] != NULL)
                            <h6>Comment Section</h6>
                            @foreach($films[0]['commentList'] as $comment)
                                <div class="comment post-comments pt-3">
                                    <header class="post-header pt-3">
                                        <p>{{$comment['body']}}</p>
                                    </header>
                                    <footer class="post-footer d-flex align-items-center">
                                        <div class="row">
                                            <div class="title pb-3">
                                                <span class="pl-3">
                                                    <strong>{{$comment['user']['name']}}</strong>
                                                </span>
                                                <span class="date pl-3">
                                                    {{\Carbon\Carbon::parse($comment['createdAt'])->diffForHumans()}}
                                                </span>
                                            </div>
                                        </div>
                                    </footer>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="container pt-5 mt-5 pl-3">
                    <div class="row pl-3">
                        <?php
                            if(Auth::user()){
                        ?>
                        <div class="row col-md-12 pl-0">
                            <div class="text col-lg-12 pt-3">
                                <div class="add-comment">
                                    <header>
                                        <h3 class="h6 text-muted mb-2 pb-4">Leave a reply</h3>
                                    </header>
                                    <div style="color:red">
                                        @if ($errors->has('comment_body'))
                                            <p style="color:red;">{{ $errors->first('comment_body') }}</p>
                                        @endif
                                    </div>
                                    <form method="post" action="{{route('storeComment')}}" enctype="multipart/form-data" class="commenting-form">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <textarea id="usercomment" placeholder="Type your comment" class="form-control"
                                                          name="comment_body" required>{{ old('comment_body') }}</textarea>
                                            </div>

                                            <input type="hidden" name="film_id" value="{{$films[0]['id']}}"/>
                                            <input type="hidden" name="user_id" value="{{$id}}"/>
                                            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>

                                            <div class="form-group pt-3 col-md-12">
                                                <button type="submit" class="btn custom-button" data-toggle="modal"
                                                        data-target="#exampleModalCenter">Reply
                                                </button>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>

            </main>
        </div>
    </div>
@stop

@section('JavaScript')
    <script>
        // Get the modal for enlarge clicked image
        var modal = document.getElementById("myModal");
        var i;

        var img = document.getElementsByClassName("myImg");
        var modalImg = document.getElementById("imgEnlrg");

        for (i = 0; i < img.length; i++) {
            img[i].onclick = function () {

                modal.style.display = "block";
                modalImg.src = this.src;
            }
        }
        var span = document.getElementsByClassName("close")[0];

        span.onclick = function () {
            modal.style.display = "none";
        }
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
@stop
