@extends('layouts.app')

@section('content')
  <div class="d-flex flex-column">
  <div class="header bg-light p-3">
    <h5>Subject</h5>
  </div>@extends('subjects.subject')

@section('subject')
<div class="row">
  <div class="col-md-6">
    <div class="card card-body">
      <h2> {{$subject->name}} </h2>
      <div class="">
        <h3> Class: {{$subject->class->name}} </h3>
        <h6>Number of Students: {{$subject->class->student_count}} </h6>
      </div>
    </div>

    <div class="pt-3">
      <div class="d-flex align-items-center justify-content-between">

    Assessments
    <a href="" class="btn btn-primary">Create New Assessment</a>
      </div>
    <hr />
    <div class="table-responsive">
      <table class="table">
        <tr class="bg-light">
          <th scope="col"></th>
          <th scope="col">Date</th>
          <th scope="col">Grade Point</th>
          <th scope="col">Highest</th>
          <th scope="col">Lowest</th>
          <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
          @forelse($subject->class->students as $student)
          <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td> 23rd June, 2022 </td>
            <td> 20 </td>
            <td> 18 </td>
            <td> 10 </td>
            <td>
              <a href="{{ route('viewprofile', $student->id ) }}" class="btn btn-primary btn-sm">
                <i class='bx bx-show'></i></a>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="5" class="text-center p-5">No assessments created yet.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    </div>
  </div>

  <div class="col-md-6 p-2">
    Students
    <div class="table-responsive pt-3">
      <table class="table">
        <tr class="bg-light">
          <th scope="col"></th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Phone</th>
          <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
          @forelse($subject->class->students as $student)
          <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td> {{$student->lastname}} {{$student->firstname}} {{$student->othername ?? ''}} </td>
            <td> {{$student->email ?? ''}} </td>
            <td> {{$student->phone ?? ''}} </td>
            <td>
              <a href="{{ route('viewprofile', $student->id ) }}" class="btn btn-primary btn-sm">
                <i class='bx bx-show'></i></a>
            </td>
          </tr>@extends('subjects.subject')

@section('subject')
<div class="row">
  <div class="col-md-6">
    <div class="card card-body">
      <h2> {{$subject->name}} </h2>
      <div class="">
        <h3> Class: {{$subject->class->name}} </h3>
        <h6>Number of Students: {{$subject->class->student_count}} </h6>
      </div>
    </div>

    <div class="pt-3">
      <div class="d-flex align-items-center justify-content-between">

    Assessments
    <a href="" class="btn btn-primary">Create New Assessment</a>
      </div>
    <hr />
    <div class="table-responsive">
      <table class="table">
        <tr class="bg-light">
          <th scope="col"></th>
          <th scope="col">Date</th>
          <th scope="col">Grade Point</th>
          <th scope="col">Highest</th>
          <th scope="col">Lowest</th>
          <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
          @forelse($subject->class->students as $student)
          <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td> 23rd June, 2022 </td>
            <td> 20 </td>
            <td> 18 </td>
            <td> 10 </td>
            <td>
              <a href="{{ route('viewprofile', $student->id ) }}" class="btn btn-primary btn-sm">
                <i class='bx bx-show'></i></a>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="5" class="text-center p-5">No assessments created yet.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    </div>
  </div>

  <div class="col-md-6 p-2">
    Students
    <div class="table-responsive pt-3">
      <table class="table">
        <tr class="bg-light">
          <th scope="col"></th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Phone</th>
          <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
          @forelse($subject->class->students as $student)
          <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td> {{$student->lastname}} {{$student->firstname}} {{$student->othername ?? ''}} </td>
            <td> {{$student->email ?? ''}} </td>
            <td> {{$student->phone ?? ''}} </td>
            <td>
              <a href="{{ route('viewprofile', $student->id ) }}" class="btn btn-primary btn-sm">
                <i class='bx bx-show'></i></a>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="5" class="text-center p-5">No Students added yet.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
          @empty
          <tr>
            <td colspan="5" class="text-center p-5">No Students added yet.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection

  <div class="page p-3 flex-grow-1">
    @yield('subject')
  </div>
  </div>
@endsection