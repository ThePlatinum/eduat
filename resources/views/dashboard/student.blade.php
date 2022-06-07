     Welcome {{ Auth()->user()->firstname }}
    <div class="row py-3">
      <div class="col-md-4">
        <div class="card card-body">
          Current Class
          <hr />
          <h3 class="p-2"> {{$curentclass->name}} | Term 2 </h3>
          <div class="row p-2">
            <div class="col-md-8">
              Class Teacher: <br> <span>{{$curentclass->teacher->firstname ?? 'Not set'}} {{$curentclass->teacher->lastname ?? ''}} {{$curentclass->teacher->othername ?? ''}}</span>
            </div>
            <div class="col-md-4 text-end d-flex flex-column justify-content-center">
              Contact:
              <div class="d-flex text-end justify-content-end">
                <a href="tel:{{$teacher->phone ?? ''}}" class="btn btn-outline-danger btn-sm"> <i class='bx bxs-phone-call'></i></a>
                <a href="mailto:{{$teacher->email ?? ''}}" class="btn btn-danger btn-sm"> <i class='bx bxs-envelope'></i> </a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card card-body">
          All Subjects
          <hr />
          <div class="row px-2">
            <div class="col-md-7">
              <h5 class="text-center dashboardcounts"> {{ $curentclass->subjects->count() }} </h5>
            </div>
            <div class="col-md-5 text-end d-flex flex-column justify-content-center">
              <a href="{{route('reports')}}" class="btn btn-danger btn-sm">Reports</a>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card card-body">
          Outstanding Balance
          <hr />
          <div class="row p-2">
            <div class="col-md-7">
              <h3> &#8358; 23,456</h3>
            </div>
            <div class="col-md-5 text-end d-flex flex-column justify-content-center">
              <a href="#" class="btn btn-danger btn-sm">Accounts</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row pt-3">
      Subjects
      <hr />

      @forelse($curentclass->subjects as $subject)
      <div class="col-md-3">
        <div class="card card-body">
          <div class="row">
            <div class="col-2">
              <h4>{{$loop->index+1}}</h4>
            </div>
            <div class="col-10">
              <h6> {{$subject->name}} </h6>
              <p>
                Teacher: <br>
                {{$subject->teacher->firstname ?? 'Not set'}} {{$subject->teacher->lastname}} {{$subject->teacher->othername ?? ''}}
              </p>
            </div>
          </div>
        </div>
      </div>
      @empty
      <p class="text-center p-5">No Subjects Registered yet.</p>
      @endforelse
    </div>