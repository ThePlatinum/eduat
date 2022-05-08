@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row header bg-light p-3">
    @unlessrole('Accountant')
    <h5>Dashboard</h5>
    @else
    <h5>Accounts</h5>
    @endunlessrole
  </div>

  @role('Admin')
  @include('dashboard.admin')
  @endrole

  <!-- Accountants Dashboard is the accounts page -->
  @role('Accountant')
  @include('accounts.accountant')
  @endrole

  @role('Teacher')
  @include('dashboard.teacher')
  @endrole

  @role('Student')
  @include('dashboard.student')
  @endrole

</div>
@endsection