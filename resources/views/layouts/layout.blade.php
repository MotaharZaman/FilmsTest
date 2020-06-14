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

    <link href="{{asset('/css/style.default.css')}}" rel="stylesheet">
    @yield('stylesheet')
</head>

<body>
<nav class="top-navbar navbar-expand-lg d-block d-md-none navbar-custom-sm navbar-light static-top">
    <div class="container">
        <div class="row float-right pr-0">
            <div class="row">
            <ul class="d-inline-flex pl-0 pb-2 pt-sm-0">
                <li class="pl-4"><a class="color-theme" href="{{route('showFilms')}}">Home</a></li>
                <li class="pl-4"><a class="color-theme" href="{{route('create')}}">Add Film</a></li>
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
        </div>
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

@yield('JavaScript')

</body>

</html>
