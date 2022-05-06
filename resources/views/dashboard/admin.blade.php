<div class="page p-3 flex-grow-1">
  
  <div class="row py-3">
    <div class="col-md-4">
      <div class="card card-body">
        Teachers
        <hr />
        {{ $counts['teachers'] }}
      </div>
    </div>

    <div class="col-md-4">
      <div class="card card-body">
        Students
        <hr />
        {{ $counts['students'] }}
      </div>
    </div>

    <div class="col-md-4">
      <div class="card card-body">
        Classes
        <hr />
        {{ $counts['classes'] }}
      </div>
    </div>
  </div>
</div>