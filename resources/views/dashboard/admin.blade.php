<div class="page p-3 flex-grow-1">
  
  Welcome {{ Auth()->user()->firstname }}
  
  <div class="row py-3">
    <div class="col-md-4">
      <div class="card card-body">
        Teachers
        <hr />
        <div class="text-center dashboardcounts">
          {{ $counts['teachers'] }}
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card card-body">
        Students
        <hr />
        <div class="text-center dashboardcounts">
        {{ $counts['students'] }}
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card card-body">
        Classes
        <hr />
        <div class="text-center dashboardcounts">
        {{ $counts['classes'] }}
        </div>
      </div>
    </div>
  </div>
</div>