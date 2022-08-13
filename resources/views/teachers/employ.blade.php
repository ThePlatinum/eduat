@extends('teachers.teacher')

@section('teacher')
<div class="justify-content-center d-flex ">
  <div class="col-md-6 bg-light p-3 ">
    <div class="header d-flex justify-content-between align-items-center p-3">
      <h5>Add New Teacher</h5>
      <a href="{{route('teachers')}}" class="btn btn-secondary btn-sm">
        <i class='fa fa-arrow-left'></i> <span>BACK</span>
      </a>
    </div>
    <form action="{{ route('employ') }}" method="POST" class="row p-3">
      @csrf
      <div class="col-12 py-2">
        <label for="firstname" class="col-form-label">{{ __('First Name') }}</label>
        <input id="firstname" type="firstname"
          class="form-control @error('firstname') is-invalid @enderror"
          name="firstname" required autofocus
          value="{{old('firstname')}}" autocomplete="first name">
        @error('firstname')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
      <div class="col-md-6 py-2">
        <label for="lastname" class="col-form-label">{{ __('Last Name') }}</label>
        <input id="lastname" type="lastname"
          class="form-control @error('lastname') is-invalid @enderror"
          name="lastname" required autofocus
          value="{{old('lastname')}}" autocomplete="last name">
        @error('lastname')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
      <div class="col-md-6 py-2">
        <label for="othernames" class="col-form-label">{{ __('Other Names') }}</label>
        <input id="othernames" type="othernames"
          class="form-control @error('othernames') is-invalid @enderror"
          name="othernames" autofocus
          value="{{old('othernames')}}" autocomplete="other name">
        @error('othernames')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>

      <div class="col-md-6 py-2">
        <label for="gender" class="col-form-label ">{{ __('Gender') }}</label>
        <select id="gender"
          class="form-control @error('gender') is-invalid @enderror"
          name="gender" autofocus autocomplete="gender">
          <option value="Male" {{ (old('gender')=="Male" ? 'selected' : '' )}} > Male </option>
          <option value="Female" {{ (old('gender')=="Female" ? 'selected' : '' )}} > Female </option>
        </select>
        @error('gender')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>

      <div class="col-md-6 py-2">
        <label for="phone" class="col-form-label ">{{ __('Phone Number') }}</label>
        <input id="phone" type="number" min='0'
          class="form-control @error('phone') is-invalid @enderror"
          name="phone" required autofocus
          value="{{old('phone')}}" autocomplete="phone">
        @error('phone')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>

      <div class="col-12 py-2">
        <label for="email" class="col-form-label ">{{ __('Email') }}</label>
        <input id="email" type="email"
          class="form-control @error('email') is-invalid @enderror"
          name="email" required autofocus
          value="{{old('email')}}" autocomplete="email">
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
@endsection