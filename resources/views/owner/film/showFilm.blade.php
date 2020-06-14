@extends('layouts.app')
@section('title','Films')
@section('content')
    <div class="container">
        <div class="row">
            <!-- Latest Posts -->
            <main class="posts-listing col-lg-9">
                <div class="container">
                    <div class="row">
                        <div class="row d-flex align-items-stretch">
                            <div class="text col-lg-12 pt-3 pr-4">
                                <div class="text-inner d-flex align-items-center">
                                    <div class="content">
                                        <?php

                                        if (isset($_GET["page"])) {
                                            $pn = $_GET["page"];
                                        } else {
                                            $pn = 1;
                                        };

                                        $start_from = ($pn - 1) * $limit;

                                        $total_pages = ceil($countFilms / $limit);
                                        $pagelink = array();
                                        $link = array();

                                        for ($i = 1; $i <= $total_pages; $i++) {
                                            $link[$i - 1] = "/films?page=" . $i;
                                            $pagelink[$i - 1] = "<div class='title pr-2' style='font-size: 20px'><a href='/films?page=" . $i . "'> " . $i . "</a></div>" . ' ';
                                        }
                                        ?>

                                        @if(count($films) > 0)
                                            @foreach($films as $post)
                                                <a id="{{$post['id']}}" name="{{$post['name']}}" class="nounderline" href="{{url('/films',['id'=>$post['id']])}}" >
                                                    <header class="post-header pt-3">
                                                        <h4 class="h6 font-weight-normal text-muted">{{$post['name']}}</h4>
                                                    </header>
                                                </a>
                                                <input id="filmId"  style="visibility: hidden">
                                                <footer class="post-footer d-flex align-items-center pb-3">
                                                    <span class="author d-flex align-items-center flex-wrap">
                                                        <div class="title pr-2">
                                                            <i class="fa fa-user" aria-hidden="true"></i> {{ $post['user']['name'] }}
                                                        </div>
                                                        <div class="date pr-2">
                                                            <i class="fa fa-clock-o" aria-hidden="true"></i> {{\Carbon\Carbon::parse($post['createdAt'])->diffForHumans()}}
                                                        </div>

                                                        <div class="comments pr-2">
                                                            <i class="fa fa-comments" aria-hidden="true"></i> {{$post['commentCount']}}
                                                        </div>
                                                        <div class="comments pr-2">
                                                            <i class="fa fa-star" aria-hidden="true"></i> {{$post['rating']}}
                                                        </div>
                                                    </span>
                                                </footer>
                                            @endforeach

                                            <div>
                                                @if(count($pagelink) > 1)
                                                    @for($i = 0; $i < count($pagelink); $i++)
                                                        <span><?php echo($pagelink[$i]) ?></span>
                                                    @endfor
                                                @endif
                                            </div>
                                        @else
                                            <header class="post-header">
                                                <h2 class="h4 font-weight-normal text-muted">There is no post in this
                                                    section..</h2>
                                            </header>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <div id="data-container"></div>
    <div id="pagination-container"></div>

@stop

@section('JavaScript')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/paginationjs/2.1.4/pagination.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script>
        function details(id, name) {

            $.ajax({
                type: "get",
                url: "/films/"+name,
                dataType:"json",
                data: {'id':id},
                success: function (response) {
                    console.log(response);
                }
            });
           // $.post("/films/"+name,{'id':id}).done(function (data) {console.log("/films/"+name);});
        }
    </script>
@stop

