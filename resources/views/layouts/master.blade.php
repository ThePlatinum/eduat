@extends('layouts.theme')
@section('body')
  <style>

    p{
      font-size: 0.8rem;
    }

    body {
      background-color: #131827;
    }
  </style>
  
  <div class="d-flex flex-column justify-content-between h-100">
    <div style="padding-top: 5%;">
      @yield('content')
    </div>
    <div class="footer p-3">
      <hr>
      <div class="d-flex justify-content-between credit">
        {{ config('app.name', 'EduAT') }}
        <!-- <img src="" alt=""> -->
        <div class="social">
          <p>Powered by <a href="https://emmannueldesina.vercel.app">Platinum Innovations</a> </p>
        </div>
      </div>
    </div>
  </div>
  
@endsection