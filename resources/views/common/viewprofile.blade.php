@extends('layouts.app')

@section('content')
  <div class="d-flex flex-column">
  <div class="header bg-light p-3">
    <h5>View Profile</h5>
  </div>

  <div class="page p-3 flex-grow-1">
    <div class="text-end">
      <a href=" {{ route('classes') }} " class="btn btn-secondary btn-sm">
        <i class='bx bx-arrow-back'></i> <span>BACK</span>
      </a>
    </div>
    
    <div class="card card-body">
      <div class="row p-3 ">
        <div class="col-md-6 d-flex flex-column align-items-center justify-content-center">
          <img class="avater" src=" {{asset('images/avatar.png')}} " alt="User Avater">
          <div class="d-flex gap-2">
            <span class="role my-3">Male</span>
          </div>
          <h4> {{$user}} </h4>
          <div class="d-flex gap-2">
            <a href=" {{ route('editprofile') }} " class="btn btn-primary btn-sm" > Edit Profile </a>
            <input type="button" value="Change Avater" class="btn btn-primary btn-sm">
          </div>
        </div>
        <div class="col-md-6 profile p-3">
          <p>Date of Birth</p>
          12/02/1999

          <p>Phone</p>
          07014293952

          <p>Email</p>
          platinumemirate@gmail.com
          
          <p>Address</p>
          No.3 Valley View Estate, Akute. Ogba, Lagos
          
          <p>Bio</p>
          I don't really have a lot to say about myself for now,
          just know that I love Efunckule Oluwaseyin, "EWA mi".
          
        </div>
      </div>
    </div>
  </div>
  </div>
@endsection