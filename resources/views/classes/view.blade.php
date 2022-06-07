@extends('classes.class')

@section('class')
<div class="page p-3 flex-grow-1">
  <div class="d-flex header justify-content-between">
    <h5>View Class</h5>
    <a href=" {{ route('classes') }} " class="btn btn-secondary btn-sm">
      <i class='bx bx-arrow-back'></i> <span>BACK</span>
    </a>
  </div>

  <div class="row mt-3 p-4 bg-light ">

    @if(session()->has('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session()->get('message') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="col-md-6">
      <h2> {{$class->name}} </h2>
      Class Teacher: <span> {{$classteacher->lastname ?? $classteacher}} {{$classteacher->firstname ?? '' }} {{$classteacher->othername ?? ''}} </span>

      <div class="py-3">
        <a href=" {{ route('edit', $class->id) }} " class="btn btn-primary">Edit Class</a>
      </div>

    </div>
    <div class="col-md-6 p-3">
      Subjects
      <hr>
      <div class="row">
        @forelse($subjects as $subject)
        <div class="col-md-6 py-2">
          <div class="subjectlist d-flex">
            <div class="flex-grow-1 d-flex align-items-center px-3">{{$subject->name}}</div>
            <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#editsubject{{$subject->id}}">
              <i class='bx bx-edit'></i>
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
                    <form action=" {{ route('editsubject') }} " method="POST">
                      @csrf

                      <input id="class" type="class" class="form-control" value=" {{ $class->id }} " name="class" hidden>
                      <input id="subject" type="subject" class="form-control" value=" {{ $subject->id }} " name="subject" hidden>

                      <div class="col-12 py-2">
                        <label for="name" class="col-md-4 col-form-label ">{{ __('Subject Name') }}</label>
                        <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" required autofocus autocomplete="name" value=" {{$subject->name}} ">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>

                      <div class="col-12 py-2">
                        <label for="teacher" class="col-md-4 col-form-label ">{{ __('Assign Teacher') }}</label>
                        <select id="teacher" type="teacher" class="form-control @error('teacher') is-invalid @enderror" name="teacher" autofocus autocomplete="teacher" value="{{ $subject->teacher->id }}">
                          @foreach ($teachers as $teacher)
                          <option value="{{ $teacher->id }}"> {{$teacher->lastname}} {{$teacher->firstname}} {{$teacher->othername ?? ''}} </option>
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
    <div class="py-3">
      Students
      <hr />
      <div class="table-responsive pt-3">
        <table class="table">
          <tr class="bg-light">
            <th scope="col"></th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Phone</th>
            <th scope="col"></th>
          </tr>
          </thead>
          <tbody>
            @forelse($class->students as $toget)
            @php
            $student = App\Models\User::Where('id', $toget->student_id)->first()
            @endphp
            <tr>
              <td>{{ $loop->index + 1 }}</td>
              <td> {{$student->lastname}} {{$student->firstname}} {{$student->othername ?? ''}} </td>
              <td> {{$student->email ?? ''}} </td>
              <td> {{$student->phone ?? ''}} </td>
              <td>
                <a href="{{ route('viewprofile', $student->id ) }}" class="btn btn-primary btn-sm">
                  <i class='bx bx-show'></i></a>
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
            <label for="name" class="col-md-4 col-form-label ">{{ __('Subject Name') }}</label>
            <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" required autofocus autocomplete="name">
            @error('name')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <div class="col-12 py-2">
            <label for="teacher" class="col-md-4 col-form-label ">{{ __('Assign Teacher') }}</label>
            <select id="teacher" type="teacher" class="form-control @error('teacher') is-invalid @enderror" name="teacher" autofocus autocomplete="teacher">
              <option value=""> Select Teacher </option>
              @foreach ($teachers as $teacher)
              <option value="{{ $teacher->id }}"> {{$teacher->lastname}} {{$teacher->firstname}} {{$teacher->othername ?? ''}} </option>
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
</div>
@endsection