<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>

    <!-- Bootstrap core CSS -->
    <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="/vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet"
          type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/paginationjs/2.1.4/pagination.css" rel="stylesheet"
          type="text/css">

    <link href="{{asset('/css/style.default.css')}}" rel="stylesheet">
    <link href="/css/landing-page.css" rel="stylesheet">
    <link href="/css/fontawesome.css" rel="stylesheet">
    <link href="/css/image.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="/images/fab_icon_support.png">
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    @yield('stylesheet')
</head>

<body>
<nav class="top-navbar navbar-expand-lg d-block d-md-none navbar-custom-sm navbar-light static-top">

    <div class="col-sm-8 pt-2 pb-2 pr-0">
        <ul class="d-inline-flex pl-0 pb-2 pt-sm-0">
            <li class="">
                <!-- Authentication Links -->
            @guest
                <li class="pl-2"><a class="color-theme" href="#">Login</a></li>
                <li class="pl-2"><a class="color-theme" href="#">Register</a></li>
            @else
                <div class="btn-group pl-3">
                        <div class="pl-0 pb-3 pt-2 user-btn">
                            <span class="login-btn nounderline pl-2" data-toggle="dropdown" role="button"
                                  aria-expanded="false" aria-haspopup="true" v-pre style="display:inline;">
                                        {{ Auth::user()->name }}
                                    </span>
                        </div>
                        <div class="pt-2">
                            <a class="logout-btn nounderline" href="#"
                               onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                Sign out
                            </a>
                            <form id="logout-form" action="#" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                </div>
            @endguest
        </ul>
    </div>
</nav>


<div class="container contain">
    @yield('content')
</div>


<!-- Footer -->
<footer class="footer bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 h-100 text-center text-lg-left my-auto">
                <p class="text-muted small mb-4 mb-lg-0">&copy;Films2020. All Rights Reserved.</p>
            </div>
        </div>
    </div>
</footer>

<!-- Bootstrap core JavaScript -->
{{--<script src="/vendor/jquery/jquery.min.js"></script>
<script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>--}}

@yield('JavaScript')

</body>

</html>
