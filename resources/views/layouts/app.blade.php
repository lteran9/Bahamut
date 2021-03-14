<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{csrf_token()}}" />
    <title>Bahamut</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" />
    <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet" />

    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .sub-title {
            font-size: 15%;
            display: block;
            margin-top: -15px;
        }

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        @media only screen and (max-width: 496px) {
            .links>a {
                font-size: 16px;
                padding: 0;
                display: block;
                margin-bottom: 15px;
            }
        }
    </style>
</head>

<body>
    @if (Route::currentRouteNamed('home*') == false)
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">Bahamut</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <ul class="navbar-nav" style="width: 100%">
                    <li class="nav-item">
                        <a class="nav-link{{Route::currentRouteNamed('exchange*') ? ' active' : ''}}" aria-current="page" href="{{ route('exchange') }}">Exchange</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link{{Route::currentRouteNamed('products*') ? ' active' : ''}}" href="{{ route('products') }}">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#!" tabindex="-1" aria-disabled="true">History</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link{{Route::currentRouteNamed('portfolios*') ? ' active' : ''}}" href="{{ route('portfolios') }}">Portfolios</a>
                    </li>
                    <li class="nav-item ml-auto dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            TeranTech - LAT
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                            <li><a class="dropdown-item" href="#">TeranTech - LFT</a></li>
                            <li><a class="dropdown-item" href="#">TeranTech - LIT</a></li>
                            <li><a class="dropdown-item" href="#">TeranTech - JLT</a></li>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    @endif

    @yield('content')

</body>

<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="{{asset('js/feather-icons.min.js')}}"></script>
<script src="{{asset('js/moment.min.js')}}"></script>
<script src="{{asset('js/canvasjs.min.js')}}"></script>

<script src="{{asset('js/html/elements/ajax-form.js')}}"></script>
<script src="{{asset('js/app.js')}}"></script>

@yield('js')

<script>
    if (feather) {
        feather.replace();
    }

    if (app) {
        app.init();
    }
</script>

</html>
