@extends('layouts.app')

@section('content')
@role('Accountant')
<div class="container-fluid">
  <div class="row header bg-light p-3">
    <h5>Students Accounts</h5>
  </div>

  <div class="p-3">
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr class="bg-light">
            <th scope="col"></th>
            <th scope="col">Name</th>
            <th scope="col">Current Class</th>
            <th scope="col">Outstanding</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($students as $student)
          <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td> {{$student->fullname}} </td>
            <td> {{$student->class->name ?? ''}} </td>
            <td> &#8358; {{$student->should_pay ?? ''}} </td>
            <td>
              <a href="{{route('getaccounts',$student->id)}}" class="btn btn-primary btn-sm">
                <i class='fa fa-eye'></i> &nbsp; View Payments
              </a>
              <a href="tel://{{$student->phone}}" class="btn btn-outline-danger btn-sm">
                <i class='fa fa-phone'></i>
              </a>
              <a href="mailto://{{$student->email}}" class="btn btn-outline-danger btn-sm">
                <i class='fa fa-envelope'></i>
              </a>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="6" class="text-center">No Students found</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endrole

@endsection