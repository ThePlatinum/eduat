@extends('layouts.app')

@section('content')
<div class="d-flex flex-column">
  <div class="header bg-light p-3">
    <h5>Items</h5>
  </div>

  <div class="page p-3 flex-grow-1">
    
    @if(session()->has('message'))
    <div class="alert alert-success">
      {{ session()->get('message') }}
    </div>
    @endif

    @yield('item')
  </div>
</div>
@endsection