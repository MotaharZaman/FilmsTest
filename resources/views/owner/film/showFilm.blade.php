@extends('layouts.layout')
@section('title','Films')
@section('content')

    <div class="row">
        <main class="posts-listing col-lg-9 pl-3">
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
                                            <a class="nounderline"
                                               href="{{ route('filmDetails', ['id'=>$post['id']]) }}">
                                                <header class="post-header pt-3">
                                                    <h2 class="h6 font-weight-normal text-muted">{{$post['description']}}</h2>
                                                </header>
                                            </a>
                                            <footer class="post-footer d-flex align-items-center pb-3">
                                        <span class="author d-flex align-items-center flex-wrap">
                                            <?php $time = "2015-06-22 20:00:03" ?>
                                            <div class="title pr-2"><span
                                                    class="text-muted">{{$post['user']['name']}}</span></div>
                                        </span>
                                                <a class="nounderline"
                                                   href="{{ route('filmDetails', ['id'=>$post['id']]) }}">
                                                    <div class="date pr-2"><i
                                                            class="icon-clock pr-1"></i> {{\Carbon\Carbon::parse($post['createdAt'])->diffForHumans()}}
                                                    </div>
                                                    <div class="comments"><i
                                                            class="far fa-comment pr-1"></i>{{$post['commentCount']}}
                                                    </div>
                                                </a>
                                            </footer>

                                        @endforeach

                                        <br> <br> <br>
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
    <div id="data-container"></div>
    <div id="pagination-container"></div>

@stop

@section('JavaScript')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/paginationjs/2.1.4/pagination.min.js"></script>
    <script>
        //image removing option at image upload time....
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
                            $("<span class=\"pip file1\">" +
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
    </script>
@stop

