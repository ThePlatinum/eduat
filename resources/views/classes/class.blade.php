@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row header bg-light p-3">
    <h5>Classes</h5>
  </div>

  <div class="page p-3 flex-grow-1">
    @if(session()->has('message'))
    <div class="alert alert-success">
      {{ session()->get('message') }}
    </div>
    @endif

    @yield('class')
  </div>
@endsection