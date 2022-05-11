<div class="page p-3 flex-grow-1">
  Welcome {{ Auth()->user()->firstname }}
   
  <div class="row py-3">
    <div class="col-md-4">
      <div class="card card-body">
        All Items
        <hr />
        <div class="text-center dashboardcounts">
        {{ $counts['items'] }}
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card card-body">
        All Students
        <hr />
        <div class="text-center dashboardcounts">
        {{ $counts['students'] }}
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card card-body">
        Total Outstandings
        <hr />
        <div class="text-center dashboardcounts">
        </div>
      </div>
    </div>
  </div>

</div>