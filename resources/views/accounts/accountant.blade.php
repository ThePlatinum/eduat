<div class="flex-grow-1">
  Welcome {{ Auth()->user()->firstname }}

  <div class="row py-2">
    <div class="col-md-2">
      <div class="card card-body">
        All Items
        <hr />
        <div class="text-center dashboardcounts">
          {{ $counts['items'] }}
        </div>
      </div>
    </div>
    <div class="col-md-10">
      <div class="row">

        <div class="col-md-7">
          <div class="card card-body">
            All Students
            <hr />
            <div class="text-center dashboardcounts row">
              <div class="col-5">{{ $counts['students'] }}</div>

              <div class="col-7 row text-start">
                <div class="col l-red">
                  <p>Defaulters</p>
                  <h6>{{$outstanding['defaulters']}}</h6>
                </div>
                <div class="col l-blue">
                  <p>Non-Defaulters</p>
                  <h6>{{$counts['students']-$outstanding['defaulters']}}</h6>
                </div>
              </div>

            </div>
          </div>
        </div>

        <div class="col-md-5">
          <div class="card card-body">
            Total Outstandings
            <hr />
            <div class="text-center dashboardcounts">
              {{$outstanding['balance']}}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <h5 class="mt-2">Quick Actions</h5>
  <hr class='mt-0'>
  <div class="d-flex flex-wrap gap-3 justify-content-center">
    <a href="{{route('bulkmail')}}" class="btn btn-outline-secondary px-3 py-2 px-md-5 py-md-3">Send Bulk E-Mails</a>
    <a href="{{route('items')}}" class="btn btn-outline-primary px-3 py-2 px-md-5 py-md-3">View Items</a>
    <a href="{{route('additem')}}" class="btn btn-outline-danger px-3 py-2 px-md-5 py-md-3">Create New Item</a>
    <a href="{{route('accounts')}}" class="btn btn-outline-primary px-3 py-2 px-md-5 py-md-3">View Student's Account Reports</a>
  </div>

</div>