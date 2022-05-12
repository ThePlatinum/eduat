@extends('layouts.app')

@section('content')
@role('Accountant')
<div class="container-fluid">
  <div class="row header bg-light p-3">
    <h5>Students Accounts</h5>
  </div>

  <div class="p-3">
    <div class="search py-2">
      <form action="" class="d-flex">
        <input type="search" name="search" id="searchbox" placeholder="Search..." class="flex-grow-1 " />
        <button type="submit" class="btn btn-danger" id="searchbtn">
          <i class='bx bx-search'></i> Search
        </button>
      </form>
    </div>
    <hr />
    <div class="table-responsive">
      <table class="table">
        <tr class="bg-light">
          <th scope="col"></th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Phone</th>
          <th scope="col">Class</th>
          <th scope="col">Outstanding</th>
          <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
          @forelse($eachstudent as $student)
          <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td> {{$student['student']->lastname}} {{$student['student']->firstname}} {{$student['student']->othername ?? ''}} </td>
            <td> {{$student['student']->email ?? ''}} </td>
            <td> {{$student['student']->phone ?? ''}} </td>
            <td> {{$student['class'] ?? ''}} </td>
            <td> &#8358; {{$student['fee'] ?? ''}} </td>
            <td>
              <a href="#" class="btn btn-primary btn-sm">
                <i class='bx bx-show'></i>
              </a>
              <a href="tel://{{$student['student']->phone}}" class="btn btn-outline-danger btn-sm">
                <i class='bx bx-phone-call'></i>
              </a>
              <a href="mailto://{{$student['student']->email}}" class="btn btn-outline-danger btn-sm">
                <i class='bx bx-envelope'></i>
              </a>
            </td>
          </tr>
          @empty
          <p class="text-center p-5">No students registered yet.</p>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endrole

@endsection