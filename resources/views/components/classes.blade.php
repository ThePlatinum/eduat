@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row header bg-light p-3">
    <h5>Classes</h5>
  </div>

  <div class="page p-3 flex-grow-1">

    <div class="row pt-3">

      @forelse([1,2,3,4,5,6] as $subject)
      <div class="col-md-4">
        <div class="card card-body">
          <div class="row">
            <div class="col-2">
              <h5>{{$subject}}</h5>
            </div>
            <div class="col-10">
              <h5> JS {{$subject}} </h5>
              Class Teacher: <span>Jhon Edy</span>
            </div>
            <hr />
            <div class="row px-2">
              <div class="col-md-6">
                <h5 class="text-center allsubjects"> 9 </h5>
                <p class="text-center">subjects</p>
              </div>
              <div class="col-md-6 text-end d-flex flex-column justify-content-center">

                <div class="py-1">
                  <h5 class="role text-center">123 Students</h5>
                </div>
                <a href="#" class="btn btn-danger btn-sm">View</a>
              </div>
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
</div>
@endsection