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
  <div class="col-md-6">
    <div class="card">
    <div class="card-body">
      <div>
        <h4 class="mb-1">{{$teacher['teacher']->fullname ?? ''}}</h4>
        <p class="mb-1">{{$teacher['teacher']->email}} <b>|</b> {{$teacher['teacher']->phone}}</p>
      </div>
      <div>
        <p class='m-0'><b>Subjects:</b></p>
        <p class="px-1 m-0" style="border-left: 1px solid blue;">
          @forelse($teacher['subjects'] as $subject)
          {{$subject->class->name}}: {{$subject->name}}@if (!$loop->last), @endif
          @empty
          No Subjects Assigned
          @endforelse
        </p>
      </div>
    </div>
    <div class="card-footer text-end">
        <a class="btn btn-outline-danger px-3 delete_teacher_btn" key_id="{{$teacher['teacher']->id}}">Delete Account</a>
      </div>
    </div>
  </div>
  @empty
  <p class="text-center p-5">No teachers employed yet.</p>
  @endforelse
</div>
@endsection