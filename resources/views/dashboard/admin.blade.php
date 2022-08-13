<div class="flex-grow-1">

  Welcome {{ Auth()->user()->firstname }}

  <div class="row py-2">

    <div class="col-md-6">
      <div class="card card-body">
        Students
        <hr />
        <div class="text-center dashboardcounts row">
          <div class="col-6">{{ $counts['students'] }}</div>
          <div class="col-6 row text-start">
            <div class="col l-red">
              <p>Graduated</p>
              <h6>{{ $counts['grad_students'] }}</h6>
            </div>
            <div class="col l-blue">
              <p>Current</p>
              <h6>{{$counts['students']-$counts['grad_students']}}</h6>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-6 col-md-3">
      <div class="card card-body">
        Teachers
        <hr />
        <div class="text-center dashboardcounts">
          {{ $counts['teachers'] }}
        </div>
      </div>
    </div>

    <div class="col-6 col-md-3">
      <div class="card card-body">
        Classes
        <hr />
        <div class="text-center dashboardcounts">
          {{ $counts['classes'] }}
        </div>
      </div>
    </div>
  </div>

  <h5 class="mt-2">Quick Actions</h5>
  <hr class='mt-0'>
  <div class="d-flex flex-wrap gap-3 justify-content-center">
    <a href="{{route('bulkmail')}}" class="btn btn-outline-secondary px-3 py-2 px-md-5 py-md-3">Send Bulk E-Mails</a>
    <a href="{{route('classes')}}" class="btn btn-outline-primary px-3 py-2 px-md-5 py-md-3">View Classes</a>
    <a href="{{route('addclass')}}" class="btn btn-outline-danger px-3 py-2 px-md-5 py-md-3">Create New Class</a>
    <a href="{{route('students')}}" class="btn btn-outline-primary px-3 py-2 px-md-5 py-md-3">View Students</a>
    <a href="{{route('newstudent')}}" class="btn btn-outline-danger px-3 py-2 px-md-5 py-md-3">Add New Student</a>
    <a href="{{route('teachers')}}" class="btn btn-outline-primary px-3 py-2 px-md-5 py-md-3">View Teachers</a>
    <a href="{{route('newteacher')}}" class="btn btn-outline-danger px-3 py-2 px-md-5 py-md-3">Add New Teacher</a>
  </div>
</div>