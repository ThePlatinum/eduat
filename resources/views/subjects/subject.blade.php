@extends('layouts.app')

@section('content')
  <div class="d-flex flex-column">
  <div class="header bg-light p-3">
    <h5>Subject</h5>
  </div>

  <div class="page p-3 flex-grow-1">
    @yield('subject')
  </div>
  </div>
@endsection