@extends('layouts.app')

@section('content')
<div class="d-flex flex-column">
  <div class="header bg-light p-3">
    <h5>Settings</h5>
  </div>

  <div class="page p-3 flex-grow-1">

    @if(session()->has('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}
    </div>
    @endif

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
              <i class="fa fa-pen-to-square"></i> &nbsp; Change school name
            </a>
          </div>
          <div class="round-logo">
            <p>Logo</p>
            <div class="d-flex justify-content-between align-items-end">
              <img src="{{ asset('images/logo.png') }}" alt="School Logo">
              <a href="#" class="btn btn-sm btn-outline-danger mb-2">
                <i class="fa fa-pen-to-square"></i> &nbsp; Change logo
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
          <form action="{{route('migrateclass')}}" method="POST" class="d-flex flex-column align-items-center p-2">
            @csrf
            <div class="card col-md-9 p-3">
              @forelse ($classes as $class)
              @if ($class->id != 1)
              <div class="d-flex justify-content-between align-items-center p-2">
                <label for="{{$class->name}}" class="form-control">{{$class->name}}</label>
                <div class="px-3"> => </div>
                <select name="{{$class->name}}" class="form-control " name="{{$class->name}}" required>
                  <option value="">Select Class</option>
                  @foreach ($classes as $classto)
                  @if ($class->id != $classto->id)
                  <option value="{{$classto->id}}">{{$classto->name}}</option>
                  @endif
                  @endforeach
                </select>
              </div>
              @endif
              @empty
              <div class="text-center"> No classes created yet. </div>
              @endforelse
            </div>

            @if(session()->has('formerror'))
            <div class="alert alert-error">
              {{ session()->get('formerror') }}
            </div>
            @endif

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
        <a href="/register" class="btn btn-primary my-2" data-bs-toggle="modal" data-bs-target="#make_admin">
          <i class="fa fa-user-plus"></i> &nbsp; Add New Admin
        </a>
        <!-- Start Make Admin Modal "-->
        <div class="modal fade" tabindex="-1" id="make_admin" data-bs-backdrop="static" data-bs-keyboard="false">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Create Admin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="{{route('create_admin')}}" method="POST">
                @csrf
                <div class="modal-body">

                  <div class="row">
                  <div class="col-6 py-1">
                    <label for="firstname" class="col-form-label">{{ __("Admin's First Name") }}</label>
                    <input id="firstname" class="form-control @error('firstname') is-invalid @enderror" name="firstname" required autofocus value="{{old('firstname')}}" autocomplete="firstname">
                    @error('firstname')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>

                  <div class="col-6 py-1">
                    <label for="lastname" class="col-form-label">{{ __("Admin's Last Name") }}</label>
                    <input id="lastname" class="form-control @error('lastname') is-invalid @enderror" name="lastname" required autofocus value="{{old('lastname')}}" autocomplete="lastname">
                    @error('lastname')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  </div>

                  <div class="col-12 py-1">
                    <label for="role" class="col-form-label ">{{ __("Admin Roles") }}</label>
                    <select id="role" class="form-control @error('role') is-invalid @enderror" name="role" required autofocus autocomplete="role">
                      <option value="">Select Role</option>
                      <option value="admin">Admin</option>
                      <option value="accountant">Accountant</option>
                    </select>
                    @error('role')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>

                  <div class="col-12 py-1">
                    <label for="email" class="col-form-label ">{{ __("Email") }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required autofocus value="{{old('email')}}" autocomplete="email">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>

                  <div class="col-12 py-1">
                    <label for="password" class="col-form-label ">{{ __("Password") }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autofocus value="{{old('password')}}" autocomplete="password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>

                  <div class="col-12 py-1">
                    <label for="password-confirm" class="col-form-label">{{ __('Confirm Password') }}</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                  </div>

                </div>
                <div class="modal-footer">
                  <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-danger px-5">Create Admin</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- End Make Admin Modal -->
      </div>
      <hr>
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr class="bg-light">
              <th scope="col">SN</th>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Role</th>
              <th scope="col"></th>
            </tr>
          </thead>
          @foreach ($admins['super'] as $admin)
          <tr>
            <td>{{$loop->index+1}}</td>
            <td>{{$admin->lastname ?? '' }} {{$admin->firstname}} {{$admin->othername ?? ''}}</td>
            <td>{{$admin->email ?? ''}}</td>
            <td>{{$admin->roles[0]->name ?? ''}}</td>
            <td class="text-end">
              @if (Auth()->user()->id != $admin->id)
              <a class="btn btn-danger btn-sm px-3 delete_admin_btn" key_id="{{$admin->id}}">
                <i class='fa fa-trash'></i> &nbsp; Delete Account
              </a>
              @endif
            </td>
          </tr>
          
          <div class='dialog' id="{{'dialog'.$admin->id}}" title="Delete Admin?">
            <p class="m-0">Are sure you want to delete this Administor's Account?</p>
            <p class="m-0"><b>Please remember that this action is irreversible</b></p>
          </div>
          @endforeach
          @forelse ($admins['accountant'] as $admin)
          <tr>
            <td>{{$loop->index + sizeof($admins['accountant']) + 1 }}</td>
            <td>{{$admin->lastname ?? '' }} {{$admin->firstname}} {{$admin->othername ?? ''}}</td>
            <td>{{$admin->email ?? ''}}</td>
            <td>{{$admin->roles[0]->name ?? ''}}</td>
            <td class="text-end">
              <a class="btn btn-danger btn-sm px-3 delete_admin_btn" key_id="{{$admin->id}}">
                <i class='fa fa-trash'></i> &nbsp; Delete Account
              </a>
            </td>
          </tr>

          <div class='dialog' id="{{'dialog'.$admin->id}}" title="Delete Admin?">
            <p class="m-0">Are sure you want to delete this Administor's Account?</p>
            <p class="m-0"><b>Please remember that this action is irreversible</b></p>
          </div>
          @empty
          @endforelse
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script>
  $(function() {
    $(".dialog").hide()

    let buttons = document.querySelectorAll(".delete_admin_btn");

    buttons.forEach(element => {
      element.addEventListener('click', e => {

        let admin_id = $(e.target).attr('key_id');

        $("#dialog" + admin_id).dialog({
          resizable: false,
          draggable: false,
          height: "auto",
          width: 400,
          modal: true,
          dialogClass: "no-close",
          open: function() {
            $('.overlay').attr('style', 'display:block')
          },
          close: function() {
            $('.overlay').attr('style', 'display:none')
          },
          buttons: {
            "Delete": function() {

              $.ajax({
                url: "{{route('delete_admin')}}",
                method: 'POST',
                data: {
                  admin_id: admin_id,
                  _token: '{{csrf_token()}}'
                },
                success: ()=>{
                  window.location.href = "settings"
                }
              })

              $(this).dialog("close");
            },
            Cancel: function() {
              $(this).dialog("close");
            }
          }
        }).dialog("open");
      })
    });
  });
</script>
@endsection