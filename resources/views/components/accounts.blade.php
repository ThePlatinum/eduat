@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row header bg-light p-3">
    <h5>Accounts</h5>
  </div>

  @role('Student')
  @include('accounts.student')
  @endrole

</div>
@endsection