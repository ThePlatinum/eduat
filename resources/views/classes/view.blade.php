@extends('classes.class')

@section('class')
<div class="flex-grow-1">

  <div class="row">
    <div class="col-md-3 bg-light p-4">
      <h2>{{$class->fullname}}</h2>
      Class Teacher: <br>
      <b>{{$class['teacher']->fullname ?? "No teacher Assigned"}}</b>
      <div class="py-3">
        <a href=" {{ route('edit', $class->id) }} " class="btn btn-primary">Edit Class</a>
      </div>
      <div>
        Subjects
        <hr>
        <div class="row">
          @forelse($class['subjects'] as $subject)
          <div class="col-12 py-2">
            <div class="subjectlist d-flex">
              <div class="flex-grow-1 d-flex align-items-center px-3">{{$subject->name}}</div>
              <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#editsubject{{$subject->id}}">
                <i class='fa fa-pen-to-square'></i>
              </a>
              <!-- Edit Modal -->
              <div class="modal fade" tabindex="-1" id="editsubject{{$subject->id}}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Edit Subject</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form action=" {{route('editsubject')}} " method="POST">
                        @csrf

                        <input id="class" type="class" class="form-control" value=" {{ $class->id }} " name="class" hidden>
                        <input id="subject" type="subject" class="form-control" value=" {{ $subject->id }} " name="subject" hidden>

                        <div class="col-12 py-2">
                          <label for="name" class="col-form-label ">{{ __('Subject Name') }}</label>
                          <input id="name" type="name" name="name"
                            class="form-control @error('name') is-invalid @enderror" 
                            required autofocus autocomplete="name" value="{{$subject->name}}">
                          @error('name')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>

                        <div class="col-12 py-2">
                          <label for="teacher" class="col-form-label ">{{ __('Assign Teacher') }}</label>
                          <select id="teacher" type="teacher" class="form-control @error('teacher') is-invalid @enderror" name="teacher" autofocus autocomplete="teacher">
                            <option value=""> Select Teacher </option>
                            @foreach ($teachers as $teacher)
                            <option value="{{ $teacher->id }}" {{ ($subject->teacher_id == $teacher->id ? 'selected' : '') }}>{{$teacher->fullname}}</option>
                            @endforeach
                          </select>
                          @error('teacher')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>

                        <div class="modal-footer mt-2">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Update Subject</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Edit Modal End -->
            </div>
          </div>
          @empty
          <p class="text-center p-5">No Subjects added yet.</p>
          @endforelse
          <div class="py-2 text-center">
            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#newsubject">
              Add New Subject
            </button>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-9">
      <div class="d-flex header justify-content-between align-items-center">
        <b>Students</b>
        <a href="{{ route('classes') }}" class="btn btn-secondary btn-sm">
          <i class='fa fa-arrow-left'></i> &nbsp; <span>BACK</span>
        </a>
      </div>
      <hr />
      <div class="table-responsive pt-3">
        <table class="table">
          <thead>
            <tr class="bg-light">
              <th scope="col"></th>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Phone</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            @forelse($class->students as $student)
            <tr>
              <td>{{ $loop->index + 1 }}</td>
              <td>{{$student->fullname}}</td>
              <td>{{$student->email ?? ''}}</td>
              <td>{{$student->phone ?? ''}}</td>
              <td>
                <a href="{{ route('viewprofile', $student->id ) }}" class="btn btn-primary btn-sm">
                  <i class='fa fa-eye'></i></a>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="5" class="text-center p-5">No Students added yet.</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" id="newsubject" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">New Subject</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action=" {{ route('createsubject') }} " method="POST">
          @csrf

          <input id="class" type="class" class="form-control" value=" {{ $class->id }} " name="class" hidden>

          <div class="col-12 py-2">
            <label for="name" class="col-form-label ">{{ __('Subject Name') }}</label>
            <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" required autofocus autocomplete="name">
            @error('name')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <div class="col-12 py-2">
            <label for="teacher" class="col-form-label ">{{ __('Assign Teacher') }}</label>
            <select id="teacher" type="teacher" class="form-control @error('teacher') is-invalid @enderror" name="teacher" autofocus autocomplete="teacher">
              <option value=""> Select Teacher </option>
              @foreach ($teachers as $teacher)
              <option value="{{ $teacher->id }}">{{$teacher->fullname}}</option>
              @endforeach
            </select>
            @error('teacher')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <div class="modal-footer mt-2">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save Subject</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection