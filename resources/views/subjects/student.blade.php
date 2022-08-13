@extends('subjects.subject')

@section('subject')

<div class="row pt-3">
  @forelse($curentclass->subjects as $subject)
  <div class="col-md-3">
    <div class="card card-body">
      <div class="row">
        <div class="col-2">
          <h4>{{$loop->index+1}}</h4>
        </div>
        <div class="col-10">
          <h6>{{$subject->name}}</h6>
          <p>
            Teacher: <br>
            {{$subject->teacher->fullname}}
          </p>
          <div class="text-end">
            <a href="{{route('subjectreport', $subject->id)}}" class="btn btn-outline-danger">
              <i class='fa fa-arrow-left ' ></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  @empty
  <p class="text-center p-5">No Subjects Registered yet.</p>
  @endforelse
</div>
@endsection