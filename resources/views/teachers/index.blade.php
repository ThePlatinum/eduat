@extends('teachers.teacher')

@section('teacher')
<div class="d-flex justify-content-between align-items-center">
  <div class="text-start">
    <a href=" {{ route('newteacher') }} " class="btn btn-danger btn-bg">
      <i class='fa fa-square-plus '></i> <span>Add New Teacher</span>
    </a>
  </div>
</div>

<hr />
<div class="row">
  @forelse($teachers as $teacher)
  <div class="col-md-6 ">
    <div class="card card-body">
      <div class="row">
        <div class="col-md-5">
          <h4>{{$teacher['teacher']->fullname ?? ''}}</h4>
          <p>{{$teacher['teacher']->email}} <br>{{$teacher['teacher']->phone}}</p>
        </div>
        <div class="col-md-7">
          Subjects:
          <div class="d-flex flex-wrap gap-2">
            @forelse($teacher['subjects'] as $subject)
            <p class="px-1" style="margin-bottom: 0px;">{{$subject->class->name}}: {{$subject->name}}</p>
            @empty
            <div>No Subjects Assigned</div>
            @endforelse
          </div>
        </div>
      </div>
    </div>
  </div>
  @empty
  <p class="text-center p-5">No teachers employed yet.</p>
  @endforelse
</div>
@endsection