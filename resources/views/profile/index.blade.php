@extends('profile.profile')

@section('profile')
@if ($user->id != Auth()->user()->id)
<div class="text-end">
  <a href="{{url()->previous()}}" class="btn btn-secondary">
    <i class='fa fa-arrow-left'></i> &nbsp; <span>BACK</span>
  </a>
</div>
@endif
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
      <h4>{{$user->fullname}}</h4>
      @if ( ($user->id == Auth()->user()->id) || (Auth()->user()->roles->pluck('name')[0] == 'Admin' ) )
        <a href="{{route('editprofile',$user->id) }}" class="btn btn-primary px-4 my-2"> Edit Profile </a>
      @endif
    </div>
    <div class="col-md-6 profile p-3">
      <p>Date of Birth</p>
      <b>{{$user->dob ? date_format($user->dob, 'd, D M, Y') : 'Not Provided'}}</b>

      <p>Phone</p>
      <b>{{$user->phone ?? 'Not Provided'}}</b>

      <p>Email</p>
      <b>{{$user->email ?? 'Not Provided'}}</b>

      <p>Address</p>
      <b>{{$user->address ?? 'Not Provided'}}</b>

      <p>Bio</p>
      <b>{{$user->bio ?? 'Not Provided'}}</b>

    </div>
  </div>
</div>
@endsection