@extends('layouts.app')

@section('content')
<div class="d-flex flex-column">
  <div class="header bg-light p-3">
    <h5>Settings</h5>
  </div>

  <div class="page p-3 flex-grow-1">
    <div class="row">
      <div class="col-md-6">
        <div class="card card-body">
          School details
          <hr>
          <p>Name</p>
          <div class="d-flex justify-content-between align-items-end">
            <h2>
              @php
              $school_name = App\Models\Settings::Where('name', 'school_name')->first()->value;
              @endphp
              {{ $school_name }}
            </h2>
            <a href="#" class="btn btn-sm btn-outline-danger mb-2">
              <i class="bx bx-edit"></i> &nbsp; Change school name
            </a>
          </div>
          <div class="round-logo">
            <p>Logo</p>
            <div class="d-flex justify-content-between align-items-end">
              <img src="{{ asset('images/logo.png') }}" alt="School Logo">
              <a href="#" class="btn btn-sm btn-outline-danger mb-2">
                <i class="bx bx-edit"></i> &nbsp; Change logo
              </a>
            </div>
          </div>
          <h6 class="mt-3">
            @php
            $number_of_session = App\Models\Settings::Where('name', 'sessions')->first()->value;
            @endphp
            Number of sessions/terms: {{ $number_of_session }}
          </h6>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card card-body">
          Migrate classes
          <hr>
          <form action="" method="post" class="d-flex flex-column align-items-center p-2">
            <div class="card col-md-9 p-3">
              @forelse ($classes as $class)
              @if ($class->id != 1)
              <div class="d-flex justify-content-between align-items-center p-2">
                <label for="{{$class->name}}" class="form-control">{{$class->name}}</label>
                <div class="px-3"> => </div>
                <select name="{{$class->name}}" class="form-control " name="{{$class->name}}">
                  <option value="">Select Class</option>
                  @foreach ($classes as $class)
                  <option value="{{$class->id}}">{{$class->name}}</option>
                  @endforeach
                </select>
              </div>
              @endif
              @empty
              <div class="text-center"> No classes created yet. </div>
              @endforelse
            </div>
            <div class="d-flex gap-3 justify-content-center p-3">
              <button type="reset" class="btn btn-outline-secondary">Reset</button>
              <button type="submit" class="btn btn-danger">Migrate Classes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="row p-3">
      <div class="d-flex justify-content-between align-items-center">
        Admins and Accountants
        <a href="/register" class="btn btn-primary my-2">
          <i class="bx bx-user-plus"></i> &nbsp; Add New Admin
        </a>
      </div>
      <hr>
      <div class="table-responsive">
        <table class="table">
          <tr class="bg-light">
            <th scope="col"></th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Role</th>
            <th scope="col"></th>
          </tr>
          </thead>
          @foreach ($admins['super'] as $admin)
          <tr>
            <td> {{$loop->index+1}} </td>
            <td> {{$admin->lastname ?? '' }} {{$admin->firstname}} {{$admin->othername ?? ''}} </td>
            <td> {{$admin->email ?? ''}} </td>
            <td> {{$admin->roles[0]->name ?? ''}} </td>
            <td class="text-end">
              @if (Auth()->user()->id != $admin->id)
              <a href="{{ route('viewprofile', $admin->id ) }}" class="btn btn-danger btn-sm">
                <i class='bx bx-trash'></i> &nbsp; Delete
              </a>
              @endif
            </td>
          </tr>
          @endforeach
          @forelse ($admins['accountant'] as $admin)
          <tr>
            <td> {{$loop->index + sizeof($admins['accountant']) + 1 }} </td>
            <td> {{$admin->lastname ?? '' }} {{$admin->firstname}} {{$admin->othername ?? ''}} </td>
            <td> {{$admin->email ?? ''}} </td>
            <td> {{$admin->roles[0]->name ?? ''}} </td>
            <td class="text-end">
              <a href="{{ route('viewprofile', $admin->id ) }}" class="btn btn-danger btn-sm">
                <i class='bx bx-trash'></i> &nbsp; Delete
              </a>
            </td>
          </tr>
          @empty
          @endforelse
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection