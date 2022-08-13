Welcome {{ Auth()->user()->firstname }}
<div class="page py-2 flex-grow-1">
  <div class="row">
    <div class="col-4 px-2">
      <div class="card card-body">
        Subjects
        <hr />
        <div class="text-center dashboardcounts">
          {{ $teaches->count() }}
        </div>
      </div>
    </div>
    <div class="col-4 px-2">
      <div class="card card-body">
        All Students
        <hr />
        <div class="text-center dashboardcounts">
          {{ $all_students }}
        </div>
      </div>
    </div>
  </div>
  Subjects
  <div class="row">
  @foreach ($teaches as $subject)
    <div class="col-3 px-2">
      <div class="card card-body">
        <h5>{{$subject->name}}</h5>
        <h6 class="pt-2"> Class: {{$subject->class->name}}</h6>
        <h6> Students: {{$subject->class->student_count}}</h6>
        <div class="text-end">
          <a href="{{route('teacherview',$subject->id)}}" class="btn btn-outline-primary">View</a>
        </div>
      </div>
    </div>
  @endforeach
  </div>
</div>