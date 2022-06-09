@extends('subjects.subject')

@section('subject')
<div class="row">
  <div class="col-md-6">
    <div class="card card-body">
      <h2> {{$subject->name}} </h2>
      <div class="">
        <h3> Class: {{$subject->class->name}} </h3>
        <h6>Number of Students: {{$subject->class->student_count}} </h6>
      </div>
    </div>

    <div class="pt-3">
      <div class="d-flex align-items-center justify-content-between">
        Assessments
        <a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create_assessment">Create New Assessment</a>

        <!-- Add Assessment Modal -->
        <div class="modal fade" tabindex="-1" id="create_assessment">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Create New Assessment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="{{ route('makeassessment') }}" method="POST">
                  @csrf
                  <input value="{{$subject->id ?? ''}}" name="subject_id" hidden>

                  <div class="col-12 py-2">
                    <label for="title" class="col-md-4 col-form-label ">{{ __('Title') }}</label>
                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" autofocus placeholder="e.g Test on Topic 1">
                    @error('title')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>

                  <div class="row">
                    <div class="col-6 py-2">
                      <label for="grade_point" class="col-md-4 col-form-label ">{{ __('Grade Point') }}</label>
                      <input id="grade_point" type="text" class="form-control @error('grade_point') is-invalid @enderror" name="grade_point" autofocus>
                      @error('grade_point')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>

                    <div class="col-6 py-2">
                      <label for="assessed_at" class="col-md-4 col-form-label ">{{ __('Assessment Date') }}</label>
                      <input id="assessed_at" type="date" class="form-control @error('assessed_at') is-invalid @enderror" name="assessed_at" autofocus>
                      @error('assessed_at')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                  <div class="col-12 py-2">
                    <label for="type" class="col-md-4 col-form-label ">{{ __('Assessment Type') }}</label>
                    <select id="type" class="form-control @error('type') is-invalid @enderror" name="type" autofocus>
                      <option value="">Select Type</option>
                      <option value="quiz">Quiz</option>
                      <option value="test">Test</option>
                      <option value="assignment">Assignment</option>
                      <option value="midterm">Midterm</option>
                      <option value="final">Final</option>
                    </select>
                    @error('type')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>

                  <div class="modal-footer mt-2">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create Assessment</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- End Add Assessment -->

      </div>
      <hr />
      <div class="table-responsive">
        <table class="table">
          <tr class="bg-light">
            <th scope="col"></th>
            <th scope="col">Date</th>
            <th scope="col">Title</th>
            <th scope="col">Grade Point</th>
            <th scope="col">Highest</th>
            <th scope="col">Avg.</th>
            <th scope="col">Lowest</th>
            <th scope="col"></th>
          </tr>
          </thead>
          <tbody>
            @forelse($subject->assessments as $assessments)
            <tr>
              <td>{{ $loop->index + 1 }}</td>
              <td> {{ date_format($assessments->assessed_at, 'd, D M, Y') }} </td>
              <td> {{$assessments->title}} </td>
              <td> {{$assessments->grade_point}} </td>
              <td> {{$assessments->highest_score}} </td>
              <td> {{$assessments->average_score}}  </td>
              <td> {{$assessments->lowest_score}} </td>
              <td>
                <a href="{{ route('gradingview', $assessments->id ) }}" class="btn btn-primary btn-sm">
                  <i class='bx bx-show'></i>
                </a>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="7" class="text-center p-5">No assessments created yet.</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="col-md-6 p-2">
    Students
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
          @forelse($subject->class->students as $student)
          <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td> {{$student->fullname }} </td>
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
@endsection