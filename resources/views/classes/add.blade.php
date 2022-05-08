@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row header bg-light p-3">
    <h5>Add New Class</h5>
  </div>

  <div class="page p-3 flex-grow-1">
    @if(session()->has('message'))
    <div class="alert alert-success">
      {{ session()->get('message') }}
    </div>
    @endif

    <div class="text-end">
      <a href=" {{ route('classes') }} " class="btn btn-secondary btn-sm">
        <i class='bx bx-arrow-back'></i> <span>BACK</span>
      </a>
    </div>

    <div class="justify-content-center d-flex ">
      <div class="col-md-8">
        <form method="POST" action="{{ isset($class)  ?  route('editclass') : route('createclass') }}" class=" p-3">
          @csrf

          <input id="class" type="class" value=" {{ $class->id ?? '' }} " name="class" hidden>

          <div class="col py-2">
            <label for="name" class="col-md-4 col-form-label">{{ __('Class Name') }}</label>
            <input id="name" type="name" value=" {{ $class->name ?? '' }} " class="form-control @error('name') is-invalid @enderror" name="name" required autofocus>
            @error('name')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <div class="col py-2">
            <label for="fee" class="col-md-4 col-form-label ">{{ __('Fees') }}</label>

            <div class="row px-1">
              @foreach(range( 1, $session ) as $fee)
              <div class="col-md-2">
                {{$fee}}:
                <input id="{{ $fee }}" type="number" value=" {{ $class->fee['$loop->index + 1'] ?? '' }} " class="form-control @error('fee') is-invalid @enderror" name=" fee{{$loop->index+1}} " required>
                @error('fee')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              @endforeach
            </div>
          </div>

          <div class="col py-2">
            <label for="teacher" class="col-md-4 col-form-label ">{{ __('Class Teacher') }}</label>
            <select id="teacher" value="{{ $class->teacher->id ?? '' }}" class="form-control @error('teacher') is-invalid @enderror" name="teacher">
              <option value="">Select Teacher</option>
              @foreach($teachers as $teacher)
              <option value="{{ $teacher->id }}"> {{$teacher->lastname}} {{$teacher->firstname}} {{$teacher->othername ?? ''}} </option>
              @endforeach
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
              {{ isset($class)  ? 'Update Class' : 'Create Class'}}
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

</div>
@endsection