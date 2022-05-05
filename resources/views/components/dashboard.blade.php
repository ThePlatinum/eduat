@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row header bg-light p-3">
    <h5>Dashboard</h5>
  </div>

  @role('Admin')
  @include('dashboard.admin')
  @endrole

  @role('Accountant')
  @include('dashboard.accountant')
  @endrole

  @role('Teacher')
  @include('dashboard.teacher')
  @endrole

  @role('Student')
  @include('dashboard.student')
  @endrole

</div>
@endsection