@extends('profile.profile')

@section('profile')

@php
$is_admin = Auth()->user()->roles->pluck('name')[0] == 'Admin';
$is_me = Auth()->user()->id == $user->id;
@endphp

<div class="justify-content-center d-flex py-5">
  <div class="col-md-6 bg-light p-3">

    <div class="header d-flex justify-content-between align-items-center p-3">
      <h5>Edit Profile</h5>
      <a href=" {{ route('profile') }} " class="btn btn-secondary btn-sm">
        <i class='bx bx-arrow-back'></i> <span>BACK</span>
      </a>
    </div>

    <form method="POST" action="{{route('profileedit')}}" class="row p-3">
      @csrf
      <input type="hidden" name="user_id" value="{{$user->id}}">
      <div class="col-md-6 py-2">
        <label for="firstname" class="col-form-label">{{ __('First Name') }}</label>
        <input id="firstname" type="firstname" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{$user->firstname}}" required {{$is_admin ? '' : 'readonly'}} autofocus autocomplete="first name">
        @error('firstname')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
      <div class="col-md-6 py-2">
        <label for="lastname" class="col-form-label">{{ __('Last Name') }}</label>
        <input id="lastname" type="lastname" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{$user->lastname}}" required {{$is_admin ? '' : 'readonly'}} autofocus autocomplete="last name">
        @error('lastname')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
      <div class="col-12 py-2">
        <label for="othername" class="col-form-label">{{ __('Other Names') }}</label>
        <input id="othername" type="text" class="form-control @error('othername') is-invalid @enderror" name="othername" value="{{$user->othername}}" {{$is_admin ? '' : 'readonly'}} autofocus autocomplete="other name">
        @error('othername')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>

      <div class="col-md-6 py-2">
        <label for="dob" class="col-form-label ">{{ __('Date of Birth') }}</label>
        <input id="dob" type="date" class="form-control @error('dob') is-invalid @enderror" name="dob" value="{{$user->dob ? date_format($user->dob, 'mm/dd/yyyy') : ''}}" required {{$is_admin ? '' : 'readonly'}} autofocus autocomplete="date of birth">
        @error('dob')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>

      <div class="col-md-6 py-2">
        <label for="gender" class="col-form-label ">{{ __('Gender') }}</label>
        <select id="gender" class="form-control @error('gender') is-invalid @enderror" name="gender" autofocus required {{$is_admin ? '' : 'readonly'}}>
          <option value=""> Select... </option>
          <option value="Male" {{($user->gender=="Male" ? 'selected' : '')}}> Male </option>
          <option value="Female" {{($user->gender=="Female" ? 'selected' : '')}}> Female </option>
        </select>
        @error('gender')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>

      <div class="col-md-6 py-2">
        <label for="phone" class="col-form-label ">{{ __('Phone Number') }}</label>
        <input id="phone" type="number" min='0' class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{$user->phone}}" required {{$is_admin ? '' : 'readonly'}} autofocus autocomplete="phone">
        @error('phone')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>

      <div class="col-md-6 py-2">
        <label for="email" class="col-form-label ">{{ __('Email') }}</label>
        <input id="email" type="email" class="form-control @error('phone') is-invalid @enderror" name="email" value="{{$user->email}}" required {{$is_admin ? '' : 'readonly'}} autofocus autocomplete="email">
        @error('email')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>

      <div class="col-12 py-2">
        <label for="address" class="col-form-label ">{{ __('Home Address') }}</label>
        <input type="address" id="address" class="form-control @error('address') is-invalid @enderror" name="address" value="{{$user->address}}" />
        @error('address')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>

      <div class="col-12 py-2">
        <label for="bio" class="col-form-label ">{{ __('About') }}</label>
        <textarea id="bio" class="form-control @error('bio') is-invalid @enderror" name="bio" {{($is_admin && !$is_me) ? 'readonly' : ''}}>{{$user->bio ?? ''}}</textarea>
        @error('bio')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>

      @if ($is_admin && !$is_me)

      @else
      <label class="col-form-label pt-2">{{ __('Change Password') }}</label>
      <div class="row">
        <div class="col-6">
          <label for="old_password" class="col-form-label ">{{ __('Old Password') }}</label>
          <input id="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" placeholder="Enter Old Password or leave empty">
          @error('old_password')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="col-6">
          <label for="new_password" class="col-form-label ">{{ __('New Password') }}</label>
          <input id="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" autocomplete="new-password" placeholder="Enter new Password or leave empty">
          @error('new_password')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>
      @endif

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