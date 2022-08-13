@extends('layouts.master')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-7">
      <div class="card">
        <div class="card-body">
          @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
          @endif

          <form method="POST" action="{{ route('password.email') }}" class="p-3">
            @csrf

            <div class="auth_header">
              <h4>{{ __('Reset Password') }}</h4>
            </div>

            <div class="py-3">
              <label for="email" class="col-form-label">{{ __('Email Address') }}</label>
              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

              @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="py-3 d-flex justify-content-between align-items-center flex-column-reverse flex-md-row gap-3">
              <a class="btn btn-outline-secondary" href="{{route('login')}}">
                <i class="fa fa-arrow-left"></i> &nbsp;
                Back to Login
              </a>
              <button type="submit" class="btn btn-primary">
                {{ __('Send Password Reset Link') }}
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection