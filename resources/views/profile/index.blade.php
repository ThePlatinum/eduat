@extends('profile.profile')

@section('profile')
<div class="card card-body">
  <div class="row p-3 ">
    <div class="col-md-6 d-flex flex-column align-items-center justify-content-center">
      @if($user->image != 'avater.png')
      <img class="avater" src="{{Storage::url($user->image)}}" alt="User Avater">
      @else
      <img class="avater" src="{{asset('images/avatar.png')}}" alt="User Avater">
      @endif

      <div class="d-flex gap-2">
        <span class="role my-3">{{$user->gender ?? 'Gender Not Provided'}}</span>
        <span class="role my-3">{{$user->roles->pluck('name')[0]}}</span>
      </div>
      <h4> {{$user->fullname}}</h4>
      <div class="d-flex gap-2">
        <a href=" {{ route('editprofile',$user->id) }} " class="btn btn-primary btn-sm"> Edit Profile </a>
      </div>
    </div>
    <div class="col-md-6 profile p-3">
      <p>Date of Birth</p>
      {{$user->dob ? date_format($user->dob, 'd, D M, Y') : 'Not Provided'}}

      <p>Phone</p>
      {{$user->phone ?? 'Not Provided'}}

      <p>Email</p>
      {{$user->email ?? 'Not Provided'}}

      <p>Address</p>
      {{$user->address ?? 'Not Provided'}}

      <p>Bio</p>
      {{$user->bio ?? 'Not Provided'}}

    </div>
  </div>
</div>
@endsection