@extends('profile.profile')

@section('profile')
<div class="text-end">
  <a href=" {{ url()->previous() }} " class="btn btn-secondary btn-sm">
    <i class='bx bx-arrow-back'></i> <span>BACK</span>
  </a>
</div>

<div class="card card-body">
  <div class="row p-3 ">
    <div class="col-md-6 d-flex flex-column align-items-center justify-content-center">
      <img class="avater" src=" {{asset('images/avatar.png')}} " alt="User Avater">
      <div class="d-flex gap-2">
        <span class="role my-3">{{$user->gender ?? 'Not Provided'}}</span>
        <span class="role my-3">{{$user->roles->pluck('name')[0]}}</span>
      </div>
      <h4> {{$user->lastname}} {{$user->firstname}} {{$user->othername ?? ''}} </h4>
      <div class="d-flex gap-2">
        <a href=" {{ route('editprofile') }} " class="btn btn-primary btn-sm"> Edit Profile </a>
        <input type="button" value="Change Avater" class="btn btn-primary btn-sm">
      </div>
    </div>
    <div class="col-md-6 profile p-3">
      <p>Date of Birth</p>
      {{$user->dob ?? 'Not Provided'}}

      <p>Phone</p>
      {{$user->phone ?? 'Not Provided'}}

      <p>Email</p>
      {{$user->email ?? 'Not Provided'}}

      <p>Address</p>
      {{$user->address ?? 'Not Provided'}}
      <!-- No.3 Valley View Estate, Akute. Ogba, Lagos -->

      <p>Bio</p>
      {{$user->bio ?? 'Not Provided'}}
      <!-- I don't really have a lot to say about myself for now,
          just know that I love Efunckule Oluwaseyin, "EWA mi". -->

    </div>
  </div>
</div>
@endsection