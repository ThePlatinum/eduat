@extends('students.student')

@section('student')
<div class="d-flex justify-content-between align-items-center">
  <div class="text-start">
    <a href=" {{ route('newstudent') }} " class="btn btn-danger btn-bg">
      <i class='fa fa-square-plus '></i> <span>Student Admission</span>
    </a>
  </div>
</div>

<hr />
<div class="table-responsive pt-2">
  <table class="table">
    <thead>
      <tr class="bg-light">
        <th scope="col"></th>
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
        <td> {{$loop->index + 1}} </td>
        <td class="name">{{$student->fullname}}</td>
        <td> {{$student->email ?? ''}} </td>
        <td> {{$student->phone ?? ''}} </td>
        <td> {{$student->class->name ?? ''}} </td>
        <td>
          <a href="{{ route('viewprofile', $student->id ) }}" class="btn btn-primary btn-sm">
            <i class='fa fa-eye'></i></a>
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="6" class="text-center p-5">No Students added yet.</td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection