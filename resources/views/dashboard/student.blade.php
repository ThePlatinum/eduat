  <div class="page p-3 flex-grow-1">
    Welcome Emmanuel
    <div class="row py-3">
      <div class="col-md-4">
        <div class="card card-body">
          Current Class
          <hr />
            <h3 class="p-2"> Primary 4 | Term 2 </h3>
          <div class="row p-2">
            <div class="col-md-8">
              Class Teacher: <br> <span>Jhon Edy</span>
            </div>
            <div class="col-md-4 text-end d-flex flex-column justify-content-center">
              <a href="tel:" class="btn btn-danger btn-sm">Contact</a>
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
            <h5 class="text-center allsubjects"> 9 </h5>
            </div>
            <div class="col-md-5 text-end d-flex flex-column justify-content-center">
              <a href="#" class="btn btn-danger btn-sm">Reports</a>
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

      @forelse([1,2,3,4,5,6,7,8,9] as $subject)
      <div class="col-md-3">
        <div class="card card-body">
          <div class="row">
            <div class="col-2">
              <h3>1</h3>
            </div>
            <div class="col-10">
              <h6> Mathematics </h6>
              <p>Emmauel A</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal -->

      @empty
      <p class="text-center p-5">No Subjects Registered yet.</p>
      @endforelse
    </div>

  </div>