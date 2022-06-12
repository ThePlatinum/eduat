@extends('students.student')

@section('student')
  <div class="justify-content-center d-flex py-5">
    <div class="col-md-6 bg-light p-3 ">
      <div class="header d-flex justify-content-between align-items-center p-3">
        <h5>New Student Admission</h5>
        <a href="{{route('students')}}" class="btn btn-secondary btn-sm">
          <i class='bx bx-arrow-back'></i> <span>BACK</span>
        </a>
      </div>
      <form action="{{ route('admission') }}" method="POST" class="row p-3">
        @csrf
        <div class="col-md-6 py-2">
          <label for="firstname" class="col-form-label">{{ __('First Name') }}</label>
          <input id="firstname" type="firstname"
            class="form-control @error('firstname') is-invalid @enderror"
            name="firstname" value="{{old('firstname')}}"
            required autofocus autocomplete="first name">
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
            name="lastname" value="{{old('lastname')}}"
            required autofocus autocomplete="last name">
          @error('lastname')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="col-12 py-2">
          <label for="othername" class="col-form-label">{{ __('Other Names') }}</label>
          <input id="othername" type="othername"
            class="form-control @error('othername') is-invalid @enderror"
            name="othername"  value="{{old('othername')}}"
            autofocus autocomplete="other name">
          @error('othername')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <div class="col-md-6 py-2">
          <label for="dob" class="col-form-label">Date of Birth</label>
          <input id="dob" type="date"
            class="form-control @error('dob') is-invalid @enderror"
            name="dob" required value="{{old('dob')}}"
            autofocus autocomplete="date of birth">
          @error('dob')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <div class="col-md-6 py-2">
          <label for="gender" class="col-form-label ">{{ __('Gender') }}</label>
          <select id="gender"
            class="form-control @error('gender') is-invalid @enderror"
            name="gender"
            required autofocus autocomplete="gender">
            <option value=""> Select Gender </option>
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
          <label for="phone" class="col-form-label ">{{ __('Phone Number')}} <small>(Students/Parents)</small> </label>
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

        <div class="col-md-6 py-2">
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

        <div class="col-12 py-2">
          <label for="address" class="col-form-label ">{{ __('Home Address') }}</label>
          <input type="address" id="address"
            class="form-control @error('address') is-invalid @enderror"
            name="address" value="{{old('address')}}" autofocus required />
          @error('address')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <div class="col-12 py-3">
          <div class="pb-3">
            <label for="class" class="col-form-label ">{{ __('Assign Class') }}</label>
            <select id="class" type="class"
              class="form-control @error('class') is-invalid @enderror"
              name="class" autofocus>
              <option value=""> Select Class </option>
              @foreach ($classes as $class)
              <option value="{{ $class->id }}" {{ (old('class')==$class->id ? 'selected' : '' )}} > {{ $class->name }} </option>
              @endforeach
            </select>
            @error('class')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
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