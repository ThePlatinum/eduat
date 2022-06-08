<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>{{ config('app.name', 'EduAT') }}</title>

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Styles -->
  <link href="{{asset('bootstrap5.1.3/bootstrap.min.css')}}" rel="stylesheet">

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
      font-weight: lighter;
    }

    p{
      font-size: 0.8rem;
    }

    body {
      height: 100vh !important;
    }

    .authcard {
      /* background: rgb(58, 73, 180); */
      background: linear-gradient(45deg, rgba(00, 00, 00, 0) 75%, rgba(58, 73, 180, 1) 80%);
    }
  </style>
</head>

<body>
  <div class="d-flex flex-column justify-content-between h-100">
    <div style="padding-top: 5%;">
      @yield('content')
    </div>
    <div class="p-3">
      <hr>
      <div class="d-flex justify-content-between credit">
        EduAT
        <!-- <img src="" alt=""> -->
        <div class="social">
          <p>copywrite Platinum @2021</p>
        </div>
      </div>
    </div>
  </div>
</body>

</html>