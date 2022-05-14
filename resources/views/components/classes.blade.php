@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row header bg-light p-3">
    <h5>Classes</h5>
  </div>

  <div class="page p-3 flex-grow-1">
    <div class="text-end">
      <a href=" {{ route('addclass') }} " class="btn btn-primary">
        <i class='bx bx-list-plus'></i> <span>New Class</span>
      </a>
    </div>
    <div class="row pt-3">
      @forelse($classes as $class)
      <div class="col-md-4">
        <div class="card card-body">
          <div class="row">
            <div class="col-2">
              <h5>{{$loop->index + 1}}</h5>
            </div>
            <div class="col-10">
              <h5> {{$class['class']->name}} </h5>
              Class Teacher: <span>Jhon Edy</span>
            </div>
            <hr />
            <div class="row px-2">
              <div class="col-md-6">
                <h5 class="text-center dashboardcounts"> {{ $class['class']->subjects->count() }} </h5>
                <p class="text-center">subjects</p>
              </div>
              <div class="col-md-6 text-end d-flex flex-column justify-content-center">

                <div class="py-1">
                  <h5 class="role text-center"> {{ sizeof($class['student']) }} Students</h5>
                </div>
                <a href="{{ route('viewclass', $class['class']->id ) }}" class="btn btn-danger btn-sm">View</a>
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