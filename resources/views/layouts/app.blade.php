@extends('layouts.theme')
@section('body')

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
        <span class="name">{{ $school_name }}</span>
      </div>
    </div>
    <span class='fa fa-chevron-right toggle' id="toggle" style="font-size: small;"></span>
  </header>
  <hr />

  <div class="menu-bar ">
    <div class="menu">
      <ul class="menu-links">

        <li class="nav-link">
          <!-- active -->
          <a href="/dashboard">
            <i class='fas fa-tachometer icon'></i>
            <span class="text nav-text">Dashboard</span>
          </a>
        </li>

        @hasrole('Student|Accountant')
        <li class="nav-link">
          <a href="/items">
            <i class='fa fa-list icon'></i>
            <span class="text nav-text">Items</span>
          </a>
        </li>

        <li class="nav-link">
          <a href="/accounts">
            <i class='fa fa-pie-chart icon'></i>
            <span class="text nav-text">Accounts</span>
          </a>
        </li>
        @endhasrole

        @hasrole('Student')
        <li class="nav-link">
          <a href="/reports">
            <i class='fa fa-line-chart icon'></i>
            <span class="text nav-text">Reports</span>
          </a>
        </li>
        @endhasrole

        @hasrole('Admin')
        <li class="nav-link">
          <a href="/classes">
            <i class='fa fa-chalkboard icon'></i>
            <span class="text nav-text">Classes</span>
          </a>
        </li>

        <li class="nav-link">
          <a href="/students">
            <i class="fas fa-users icon"></i>
            <span class="text nav-text">Students</span>
          </a>
        </li>

        <li class="nav-link">
          <a href="/teachers">
            <i class="fas fa-chalkboard-teacher icon"></i>
            <span class="text nav-text">Teachers</span>
          </a>
        </li>
        @endhasrole

        @unlessrole('Student')
        <li class="nav-link">
          <a href="/bulkmails">
            <i class="fas fa-mail-bulk icon"></i>
            <span class="text nav-text">Mails</span>
          </a>
        </li>
        @endunlessrole

       @hasrole('Admin')
       <li class="nav-link">
          <a href="/settings">
            <i class='fa fa-cog icon'></i>
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
          <i class='fa fa-user icon'></i>
          <span class="text nav-text">Profile</span>
        </a>
      </li>

      <li>
        <a class="logout" href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
          <i class="fas fa-sign-out-alt icon"></i>
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
@endsection