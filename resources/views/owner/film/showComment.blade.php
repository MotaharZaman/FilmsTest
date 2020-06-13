@extends('layouts.layout')
@section('title','Post and Comments')
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

                                    @foreach($posts as $post)
                                        <?php
                                        $count = 0;
                                        foreach ($post->getCommentList() as $comment)
                                            $count++;
                                        ?>

                                        <div class="content">
                                            <header class="post-header pt-3">
                                                <h2 class="h6 font-weight-light dark-font">{{$post->getPostBody()}}</h2>
                                                @if($post->getPostImageList() != NULL)
                                                    @foreach($post->getPostImageList() as $index=>$imageList)
                                                        <img class="myImg" height="100px" width="auto"
                                                             src="{{asset('/post/'.$post->getUser()->getId().'/'.$imageList->getImageName())}}">
                                                    @endforeach
                                                @endif
                                            </header>
                                            <footer class="post-footer d-flex align-items-center pt-2 pb-3"><span
                                                    class="author d-flex align-items-center flex-wrap">

                            <div class="title pr-2"><span
                                    class="text-muted">{{$post->getUser()->getName()}}</span></div></span>
                                                <div class="date pr-2"><i
                                                        class="icon-clock pr-1"></i>{{\Carbon\Carbon::parse($post->getUpdatedAt())->diffForHumans()}}
                                                </div>
                                                <div class="comments"><i class="far fa-comment pr-1"></i>{{$count}}
                                                </div>
                                            </footer>


                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="blog-post container pl-3">
                    <div class="post-comments col-lg-11 pl-0">

                        @if($post->getCommentList() != NULL)
                            @foreach($post->getCommentList() as $comment)
                                <div class="comment pt-3">
                                    <p>{{$comment->getCommentBody()}}</p>
                                    @if($comment->getCommentImage() != NULL)
                                        @foreach($comment->getCommentImage() as $commentImageList)
                                            <img class="myImg" height="100px" width="auto"
                                                 src="{{asset('/comment/'.$comment->getUser()->getId().'/'.$commentImageList->getImageName())}}">
                                        @endforeach
                                    @endif
                                    <footer class="post-footer d-flex align-items-center">
                                        <div class="row">
                                            <div class="title pb-3">
                                                <span class="pl-3"><strong>{{$comment->getUser()->getName()}}</strong></span><span
                                                    class="date pl-3">{{\Carbon\Carbon::parse($comment->getUpdatedAt())->diffForHumans()}}</span>
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
                                    <form method="post" action="{{route('comments.index')}}"
                                          enctype="multipart/form-data" class="commenting-form">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <textarea id="usercomment" placeholder="Type your comment"
                                                          class="form-control"
                                                          name="comment_body"
                                                          required>{{ old('comment_body') }}</textarea>
                                            </div>
                                            <div class="file btn btn-upload-custom row text-left col-8 col-md-6 col-lg-4 pl-3 pt-0">
                                                @foreach ($errors->get('images.*') as $message)
                                                    <strong style="color:red">{{ $message[0] }}</strong>
                                                @endforeach
                                                <br>
                                                <i class="fas fa-paperclip pr-3 pl-3"></i>Attach File
                                                <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                                                <input type="file" name="images[]" class="form-control" id="files"
                                                       multiple>
                                                <output id="list"></output>
                                            </div>

                                            <input type="hidden" name="post_id" value="{{$posts[0]->getId()}}"/>
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

            <aside class="col-lg-3 pt-4">
                <!-- Widget [Search Bar Widget]-->
                <div class="col-lg-12 left-border">
                    <div class="widget latest-posts">
                        <header>
                            <h3 class="h6 text-muted pb-3 mt-4">Get Help</h3>
                        </header>
                        <div class="blog-posts">
                            <?php
                            if($type === 'quickly-retail'){
                            ?>
                            <a href="<?php echo '/retail-instructions#five-tab';?>">
                                <div class="item d-flex align-items-center">
                                    <div class="title text-muted font-small"><strong>Setting Up the Catalog</strong>
                                    </div>
                                </div>
                            </a>
                            <a href="<?php echo '/retail-instructions#eight-tab';?>">
                                <div class="item d-flex align-items-center">
                                    <div class="title text-muted font-small"><strong>How to Take Orders</strong>
                                    </div>
                                </div>
                            </a>
                            <a href="<?php echo '/retail-instructions#ten-tab';?>">
                                <div class="item d-flex align-items-center">
                                    <div class="title text-muted font-small"><strong>Setting Up the Inventory</strong>

                                    </div>
                                </div>
                            </a>
                            <?php
                            }
                            else{
                            ?>
                            <a href="<?php echo '/restaurant-instructions#four-tab';?>">
                                <div class="item d-flex align-items-center">
                                    <div class="title text-muted font-small"><strong>Setting Up the Business
                                            Details</strong>
                                    </div>
                                </div>
                            </a>
                            <a href="<?php echo '/restaurant-instructions#seven-tab';?>">
                                <div class="item d-flex align-items-center">
                                    <div class="title text-muted font-small"><strong>Setting Up the Promotions</strong>
                                    </div>
                                </div>
                            </a>
                            <a href="<?php echo '/restaurant-instructions#six-tab';?>">
                                <div class="item d-flex align-items-center">
                                    <div class="title text-muted font-small"><strong>Setting Up the Inventory</strong>
                                    </div>
                                </div>
                            </a>
                            <?php
                            }
                            ?>
                        </div>
                    </div>

                    <div class="widget latest-posts pt-3">
                        <header>
                            <h3 class="h6 text-muted pb-3">Most Discussed</h3>
                        </header>
                        <div class="blog-posts">
                            <?php
                            if(isset($mostCmnt) && count($mostCmnt) > 0){
                            for($i = 0; $i < count($mostCmnt); $i++){
                            if ($mostCmnt[$i]->getForumType() == 0)
                                $name = "quickly-retail";
                            if ($mostCmnt[$i]->getForumType() == 1)
                                $name = "quickly-restaurant";
                            ?>
                            <a class="nounderline"
                               href="{{ route('showAll', ['id'=>$mostCmnt[$i]->getId(), 'type'=>$name]) }}">
                                <div class="item d-flex align-items-center">

                                    <div class="title text-muted font-small">
                                        <strong>{{$mostCmnt[$i] -> getPostBody()}}</strong>
                                    </div>
                                </div>
                            </a>
                            <?php
                            }
                            }
                            ?>
                        </div>
                    </div>

                    <div class="container pt-3">
                        <div class="row">
                            <div class="col-xl-12  pr-0 pl-0">
                                <h6 class="mb-4 text-muted font-weight-normal">Still Confused?</h6>
                            </div>
                            <a href="{{route('knock')}}">
                                <div class="col-md-12  pr-0 pl-0">
                                    <div class="">
                                        <button type="submit"
                                                class="btn btn-block btn-sm btn-primary border-radius-0 btn-knock-custom">
                                            Knock US!
                                        </button>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>
@stop

@section('JavaScript')
    <script>
        //preview and remove image when upload........
        $(document).ready(function () {
            if (window.File && window.FileList && window.FileReader) {
                $("#files").on("change", function (e) {
                    var files = e.target.files,
                        filesLength = files.length;
                    for (var i = 0; i < filesLength; i++) {
                        var f = files[i]
                        var fileReader = new FileReader();
                        fileReader.onload = (function (e) {
                            var file = e.target;
                            $("<span class=\"pip\">" +
                                "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                                "<br/><span class=\"remove\"><i class=\"far fa-trash-alt\"></i></span>" +
                                "</span>").insertAfter("#files");
                            $(".remove").click(function () {
                                $(this).parent(".pip").remove();
                            });
                        });
                        fileReader.readAsDataURL(f);
                    }
                });
            } else {
                alert("Your browser doesn't support to File API")
            }
        });


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
