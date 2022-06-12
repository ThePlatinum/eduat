@extends('subjects.subject')

@section('subject')
<script type="text/javascript">
  google.charts.load('current', {
    'packages': ['corechart']
  });
  google.charts.setOnLoadCallback(drawVisualization);

  function drawVisualization() {
    var data = google.visualization.arrayToDataTable([
      ['Assesment', 'Your Score', 'Possible Score'],
      <?php echo $subject_assessments; ?>
    ]);

    var options = {
      title: 'Your Performance in each assessments',
      vAxis: {
        title: 'Score'
      },
      hAxis: {
        title: 'Subjects'
      },
      seriesType: 'bars',
      animation: {
        duration: 1500,
        easing: 'out',
        startup: true
      },
      // colors: ['#ee8100', '#9575cd'],
    };

    var chart = new google.visualization.ComboChart(document.getElementById('subject_chart'));
    chart.draw(data, options);
  }
</script>
<!-- <div class="text-end">
  <a href=" {{ url()->previous() }} " class="btn btn-secondary btn-sm">
    <i class='bx bx-arrow-back'></i> <span>BACK</span>
  </a>
</div> -->
<div class="row">

<div class="col-md-7">
  <div class="row">
    <div class="col-md-6">
      <div class="card card-body">
        <h4>{{$subject->name}}</h4>
        <p>
          Teacher: <br>
          {{$subject->teacher->fullname}}
        </p>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card card-body">
        <h4>{{auth()->user()->fullname}}</h4>
        <p>
          {{$subject->class->name}}
        </p>
      </div>
    </div>
  </div>


  @if (str_word_count($subject_assessments) < 1)
    <div class="text-center p-5 bg-light">
      No data to display
    </div>
  @else
    <div id="subject_chart" style="width: 100% ; height: 65vh ;"></div>
  @endif
</div>

<div class="col-md-5">
  <div class="card card-body">
    <h4>Assessment</h4>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Assessment</th>
          <th>Score</th>
          <th>Grade Point</th>
          <th>Remark</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($score_table as $score)
        <tr>
          <td>{{$score['name']}}</td>
          <td>{{$score['score']}}</td>
          <td>{{$score['grade_point']}}</td>
          <td>{{$score['remark']}}</td>
        </tr>
        @empty
        <tr>
          <td colspan="4" class="text-center">No data to display</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
</div>

@endsection