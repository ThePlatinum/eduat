@extends('layouts.app')

@section('content')
<div class="d-flex flex-column">
  <div class="header bg-light p-3">
    <h5>Add New Teacher</h5>
  </div>

  <div class="page p-3 flex-grow-1">
    
    @if(session()->has('message'))
    <div class="alert alert-success">
      {{ session()->get('message') }}
    </div>
    @endif

    <div class="text-end">
      <a href=" {{ url()->previous() }} " class="btn btn-secondary btn-sm">
        <i class='bx bx-arrow-back'></i> <span>BACK</span>
      </a>
    </div>

    <div class="justify-content-center d-flex ">
      
      <div class="col-md-8">
        <form action="{{ route('employ') }}" method="POST" class="row p-3">
          @csrf
          <div class="col-12 py-2">
            <label for="firstname" class="col-form-label">{{ __('First Name') }}</label>
            <input id="firstname" type="firstname" class="form-control @error('firstname') is-invalid @enderror" name="firstname" required autofocus autocomplete="first name">
            @error('firstname')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="col-md-6 py-2">
            <label for="lastname" class="col-form-label">{{ __('Last Name') }}</label>
            <input id="lastname" type="lastname" class="form-control @error('lastname') is-invalid @enderror" name="lastname" required autofocus autocomplete="last name">
            @error('lastname')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="col-md-6 py-2">
            <label for="othernames" class="col-form-label">{{ __('Other Names') }}</label>
            <input id="othernames" type="othernames" class="form-control @error('othernames') is-invalid @enderror" name="othernames" autofocus autocomplete="other name">
            @error('othernames')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

            <div class="col-md-6 py-2">
              <label for="gender" class="col-form-label ">{{ __('Gender') }}</label>
              <select id="gender" class="form-control @error('gender') is-invalid @enderror" name="gender" autofocus autocomplete="gender" >
                <option value="Male" > Male </option>
                <option value="Female" > Female </option>
              </select>
              @error('gender')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

          <div class="col-md-6 py-2">
            <label for="phone" class="col-form-label ">{{ __('Phone Number') }}</label>
            <input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" required autofocus autocomplete="phone">
            @error('phone')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <div class="col-12 py-2">
            <label for="email" class="col-form-label ">{{ __('Email') }}</label>
            <input id="email" type="email" class="form-control @error('phone') is-invalid @enderror" name="email" required autofocus autocomplete="email">
            @error('email')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <div class="col-12 d-flex gap-3 py-3">
            <button type="reset" class="btn btn-secondary block">
              {{ __('Reset') }}
            </button>
            <button type="submit" class="btn btn-primary block">
              {{ __('Save') }}
            </button>
          </div>
        </form>
      </div>
    </div>

  </div>
</div>
@endsection