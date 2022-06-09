<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>{{ config('app.name', 'EduAT') }}</title>

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Styles -->
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
  <link href="{{asset('bootstrap5.1.3/bootstrap.min.css')}}" rel="stylesheet">
  <script src="{{asset('bootstrap5.1.3/bootstrap.bundle.min.js')}}"></script>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/components.css') }}" rel="stylesheet">
</head>

<body>

@php
  $school_name = App\Models\Settings::Where('name', 'school_name')->first()->value;
@endphp

  <nav class="sidebar close" id="sidebar">
    <header>
      <div class="image-text">
        <span class="image">
          <img src="{{ asset('images/logo.png') }}" alt="School Logo">
        </span>

        <div class="text logo-text">
          <span class="name"> {{ $school_name }} </span>
        </div>
      </div>
      <span class='bx bx-chevron-right toggle' id="toggle"></span>
    </header>
      <hr />

    <div class="menu-bar ">
      <div class="menu">
        <ul class="menu-links">

          <li class="nav-link">   <!-- active -->
            <a href="/dashboard">
              <i class='bx bx-home-alt icon'></i>
              <span class="text nav-text">Dashboard</span>
            </a>
          </li>

          @hasrole('Student|Accountant')
          <li class="nav-link">
            <a href="/items">
              <i class='bx bx-list-ul icon'></i>
              <span class="text nav-text">Items</span>
            </a>
          </li>
          
          <li class="nav-link">
            <a href="/accounts">
              <i class='bx bx-bar-chart-alt-2 icon'></i>
              <span class="text nav-text">Accounts</span>
            </a>
          </li>
          @endhasrole

          <!-- @hasrole('Teacher')
          <li class="nav-link">
            <a href="/assessments">
              <i class='bx bx-dumbbell icon'></i>
              <span class="text nav-text">Assessments</span>
            </a>
          </li>
          @endhasrole -->

          @hasrole('Student')
          <li class="nav-link">
            <a href="/reports">
              <i class='bx bx-pie-chart-alt icon'></i>
              <span class="text nav-text">Reports</span>
            </a>
          </li>
          @endhasrole

          @hasrole('Admin')
          <li class="nav-link">
            <a href="/classes">
              <i class='bx bx-chalkboard icon'></i>
              <span class="text nav-text">Classes</span>
            </a>
          </li>

          <li class="nav-link">
            <a href="/teachers">
              <i class='bx bx-user-circle icon'></i>
              <span class="text nav-text">Teachers</span>
            </a>
          </li>

          <li class="nav-link">
            <a href="/students">
              <i class='bx bx-male-female icon'></i>
              <span class="text nav-text">Students</span>
            </a>
          </li>

          <li class="nav-link">
            <a href="/settings">
              <i class='bx bx-wrench bx-flip-horizontal icon' ></i>
              <span class="text nav-text">Settings</span>
            </a>
          </li>
          @endhasrole

        </ul>
      </div>
      <div class="bottom-content">
        <hr />
        <li class="nav-link">
          <a href="{{ route('profile') }}">
            <i class='bx bx-user icon'></i>
            <span class="text nav-text">Profile</span>
          </a>
        </li>

        <li>
          <a class="logout" href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            <i class='bx bx-log-out icon'></i>
            <span class="text nav-text">Logout</span>
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        </li>

      </div>
    </div>
  </nav>

  <div class="content d-flex flex-column">
    <div class="flex-grow-1">
      @yield('content')
    </div>
    <div class="p-3">
      <hr>
      <div class="d-flex d-flex justify-content-between credit">
        EduAT
        <!-- <img src="" alt=""> -->
        <div class="social">
          <p>Product of <a href="">Platinum Innovations</a> </p>
        </div>
      </div>
    </div>
  </div>
  
    <!-- Scripts -->
    <script src="{{ asset('js/sidebar.js') }}"></script>
</body>

</html>