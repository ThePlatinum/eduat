@extends('students.student')

@section('student')
<div class="d-flex justify-content-between align-items-center">
  <div class="text-start">
    <a href=" {{ route('newstudent') }} " class="btn btn-danger btn-bg">
      <i class='bx bx-message-square-add bx-flip-horizontal'></i> <span>Stundet Admission</span>
    </a>
  </div>
</div>

<hr />
<div class="table-responsive pt-2">
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
        <td class="name">{{$student->lastname}} {{$student->firstname}} {{$student->othername ?? ''}} </td>
        <td> {{$student->email ?? ''}} </td>
        <td> {{$student->phone ?? ''}} </td>
        <td> JSS 1 </td>
        <td>
          <a href="{{ route('viewprofile', $student->id ) }}" class="btn btn-primary btn-sm">
            <i class='bx bx-show'></i></a>
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