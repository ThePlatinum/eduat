@extends('layouts.app')

@section('content')
<div class="d-flex flex-column">
  <div class="header bg-light p-3">
    <h5>Students</h5>
  </div>

  <div class="page p-3 flex-grow-1">

    <div class="d-flex justify-content-between align-items-center">
      <div class="text-start">
        <a href=" {{ route('newstudent') }} " class="btn btn-danger btn-bg">
          <i class='bx bx-message-square-add bx-flip-horizontal'></i> <span>Stundet Admission</span>
        </a>
      </div>
    </div>

    <hr />
    <table class="table">
      <tr class="bg-light">
        <th scope="col">Id</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Phone</th>
        <th scope="col">Class</th>
        <th scope="col"></th>
      </tr>
      </thead>
      <tbody>
        @forelse($students as $student)
        <tr>
          <td></td>
          <td class="name">{{$student->lastname}} {{$student->firstname}} {{$student->othername  ?? ''}} </td>
          <td> {{$student->email ?? ''}} </td>
          <td> {{$student->phone ?? ''}} </td>
          <td> JSS 1 </td>
          <td>
            <a href="{{ route('viewprofile', $student->id ) }}" class="btn btn-primary btn-sm">
              <i class='bx bx-show'></i></a>
          </td>
        </tr>
        @empty
          <p class="text-center p-5">No students registered in the class yet.</p>
        @endforelse
      </tbody>
    </table>

  </div>
</div>
@endsection