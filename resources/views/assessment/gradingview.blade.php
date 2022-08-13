@extends('layouts.app')

@section('content')

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jquery-editable/css/jquery-editable.css" rel="stylesheet" />
<script>
  $.fn.poshytip = {
    defaults: null
  }
</script>
<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jquery-editable/js/jquery-editable-poshytip.min.js"></script>


<div class="d-flex flex-column">
  <div class="header bg-light p-3">
    <h5>Subject</h5>
  </div>
  <div class="page p-3 flex-grow-1">

    <div class="text-end">
      <a href=" {{ url()->previous() }} " class="btn btn-secondary btn-sm">
        <i class='fa fa-arrow-left'></i> <span>BACK</span>
      </a>
    </div>

    <div class="card card-body">
      <div class="row">
        <div class="col-md-6">
          <h4>{{$assessment->subject->name}}</h4>
          <h5> Class: {{$assessment->subject->class->name}}</h5>
          <h6> Number of Students: {{$assessment->subject->class->student_count}}</h6>
        </div>

        <div class="col-md-6">
          <h3>{{$assessment->title}}</h3>
          <h5>Grade Point: {{$assessment->grade_point}}</h5>
          <h6>{{$assessment->type}} | {{$assessment->assessed_at}}</h6>
          <a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit_assessment">Edit Assessment</a>

          <!-- Edit Assessment Modal -->
          <div class="modal fade" tabindex="-1" id="edit_assessment">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Edit Assessment</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="{{ route('makeassessment') }}" method="POST">
                    @csrf
                    <input value="{{$assessment->id ?? ''}}" name="assessment_id" hidden>
                    <div class="col-12 py-2">
                      <label for="title" class="col-form-label ">{{ __('Title') }}</label>
                      <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{$assessment->title}}" autofocus placeholder="e.g Test on Topic 1">
                      @error('title')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                    <div class="row">
                      <div class="col-6 py-2">
                        <label for="grade_point" class="col-form-label ">{{ __('Grade Point') }}</label>
                        <input id="grade_point" type="text" class="form-control @error('grade_point') is-invalid @enderror" name="grade_point" value="{{$assessment->grade_point}}" autofocus>
                        @error('grade_point')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                      <div class="col-6 py-2">
                        <label for="assessed_at" class="col-form-label ">{{ __('Assessed At') }}</label>
                        <input id="assessed_at" type="date" class="form-control @error('assessed_at') is-invalid @enderror" name="assessed_at" value="{{$assessment->assessed_at}}" autofocus>
                        @error('assessed_at')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-12 py-2">
                      <label for="type" class="col-form-label ">{{ __('Type') }}</label>
                      <select id="type" class="form-control @error('type') is-invalid @enderror" name="type" value="{{$assessment->type}}" autofocus>
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
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
              </div>
            </div>
          </div>
          <!-- Delete Assessment Modal -->
        </div>

        <div class="col-12">
          Highest Score: {{$assessment->highest_score}} | Average Score: {{$assessment->average_score}} | Lowest Score: {{$assessment->lowest_score}}
        </div>
      </div>
    </div>
    <div class="card card-body">
      <div class="row">
        <div class="col-md-6">
          <h4> Scoring </h4>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Student</th>
                <th>Scores</th>
                <th>Remark</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($assessment->subject->class->students as $student)
              @php
              $grade = $assessment->scores->where('user_id', $student->id)->first();
              if ($grade) {
                $score = $grade->score;
                $remark = $grade->remarks;
              } else {
                $score = 0;
                $remark = '';
              }
              @endphp
              <tr>
                <td>{{$student->fullname}}</td>
                <td>
                  <a href="" class="update_score" data-name="score" data-type="number"  min='0'data-pk="{{$student->id}}">{{ $score }}</a>
                </td>
                <td>
                  <a href="" class="update_remark" data-name="remark" data-type="textarea" data-pk="{{$student->id}}">{{ $remark }}</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $.fn.editable.defaults.mode = 'inline';

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': '{{csrf_token()}}'
    }
  });

  $('.update_score').editable({
    url: "{{ route('addscore',$assessment->id) }}",
    type: 'number',
    name: 'score'
  });

  $('.update_remark').editable({
    url: "{{ route('addscore',$assessment->id) }}",
    type: 'textarea',
    name: 'review'
  });
</script>

@endsection