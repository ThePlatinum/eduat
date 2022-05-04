@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row header bg-light p-3">
    <h5>Add New Class</h5>
  </div>

  <div class="page p-3 flex-grow-1">
    <div class="text-end">
      <a href=" {{ route('classes') }} " class="btn btn-secondary btn-sm">
        <i class='bx bx-arrow-back'></i> <span>BACK</span>
      </a>
    </div>

    <div class="justify-content-center d-flex ">
      <div class="col-md-8">
        <div class=" card-body">
          <form method="POST" action="{{ route('createclass') }}" class=" p-3">
            @csrf
            <div class="col py-2">
              <label for="name" class="col-md-4 col-form-label">{{ __('Class Name') }}</label>
              <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" required autofocus>
              @error('name')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="col py-2">
              <label for="level" class="col-md-4 col-form-label ">{{ __('Class Level') }}</label>
              <input id="level" type="number" class="form-control @error('level') is-invalid @enderror" name="level" required>

              @error('level')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="col py-2">
              <label for="fee" class="col-md-4 col-form-label ">{{ __('Fees') }}</label>
              <input id="fee" type="number" class="form-control @error('fee') is-invalid @enderror" name="fee" required>

              @error('fee')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="col py-2">
              <label for="teacher" class="col-md-4 col-form-label ">{{ __('Class Teacher') }}</label>
              <select id="teacher" class="form-control @error('teacher') is-invalid @enderror" name="level">
              </select>

              @error('teacher')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="col d-flex gap-3 py-3">
              <button type="reset" class="btn btn-secondary block">
                {{ __('Reset') }}
              </button>
              <button type="submit" class="btn btn-primary block">
                {{ __('Create') }}
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection