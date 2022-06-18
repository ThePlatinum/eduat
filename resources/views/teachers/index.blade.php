@extends('teachers.teacher')

@section('teacher')
    <div class="d-flex justify-content-between align-items-center">
      <div class="text-start">
        <a href=" {{ route('newteacher') }} " class="btn btn-danger btn-bg">
          <i class='bx bx-message-square-add bx-flip-horizontal'></i> <span>Add New Teacher</span>
        </a>
      </div>
    </div>
    
    <hr />
    <div class="row">
    @forelse($teachers as $teacher)
      <div class="col-md-6 py-2">
      <div class="row card card-body">
        <div class="col-md-6">
          <div class="name">{{$teacher->fullname ?? ''}} </div>
          <p> {{$teacher->email}} <br> {{$teacher->phone}}  </p>
        </div>
        <div class="col-md-6">
          <div class="classlist"></div>
        </div>
      </div>
      </div>
      @empty
      <p class="text-center p-5">No teachers employed yet.</p>
      @endforelse
    </div>
@endsection