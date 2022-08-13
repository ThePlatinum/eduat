<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name', 'EduAT') }}</title>
  <link href="{{ asset('images/logo.png') }}" rel="icon" type="image/x-icon">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Styles -->
  <link rel="stylesheet" href="{{ asset('bootstrap-5.1.3/bootstrap.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('fontawesome-6.1.1-slim/css/all.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('jquery-dt/datatables.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/components.css') }}" rel="stylesheet">

  <!-- Scripts -->
  <script src="{{ asset('bootstrap-5.1.3/bootstrap.bundle.min.js')}}"></script>
  <script src="{{ asset('js/jquery-3.6.0.js') }}"></script>
  <script src="{{ asset('js/jquery-ui-1.13.2.js') }}"></script>
  <script src="{{ asset('js/gchart-loader.js') }}"></script>
  <script src="{{ asset('jquery-dt/datatables.min.js') }}"></script>
</head>

<body>
  @yield('body')
  <div class="overlay"></div>
  <script>
    $(document).ready(function() {
      $('.table').DataTable();
    });
  </script>
</body>

</html>