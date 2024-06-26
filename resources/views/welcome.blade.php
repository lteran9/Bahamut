<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
   <meta charset="utf-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1" />
   <title>Bahamut</title>

   <!-- Styles -->
   <style>
      @font-face {
         font-family: 'NunitoVariableFont';
         src: url('/fonts/NunitoVariableFont.ttf');
      }

      html,
      body {
         background-color: #fff;
         color: #636b6f;
         font-family: 'NunitoVariableFont', sans-serif;
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
   <div class="flex-center position-ref full-height">
      <div class="content">

         <div class="title m-b-md">
            Bahamut <small class="sub-title">powered by Coinbase</small>
         </div>

         <div class="links">
            <a href="{{ route('exchange') }}">Exchange</a>
            <a href="#!">History</a>
            <a href="{{ route('portfolios') }}">Portfolios</a>
            <a href="#!">Settings</a>
            <a href="https://github.com/lteran9/Bahamut">GitHub</a>
         </div>

      </div>
   </div>

</body>

</html>
