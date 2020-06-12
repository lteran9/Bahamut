<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="csrf-token" content="{{csrf_token()}}">
   <title>Bahamut</title>

   <!-- Fonts -->
   <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
   <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet">

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

   @yield('content')

</body>

<script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{asset('js/feather-icons.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/html/elements/ajax-form.js')}}"></script>
<script type="text/javascript" src="{{asset('js/app.js')}}"></script>

@yield('js')

<script type="text/javascript">
   if (feather) {
      feather.replace();
   }

   if (app) {
      app.init();
   }
</script>

</html>