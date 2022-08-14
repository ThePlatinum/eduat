Welcome {{ Auth()->user()->firstname }}

<script type="text/javascript">
  google.charts.load('current', {
    'packages': ['corechart']
  });
  google.charts.setOnLoadCallback(drawVisualization);

  function drawVisualization() {
    var data = google.visualization.arrayToDataTable([
      ['Subject', 'Your Score', 'Possible Score', 'Average'],
      <?php echo $subject_performance; ?>
    ]);

    var options = {
      title: 'Your Performance in each subjects',
      vAxis: { title: 'Score' },
      hAxis: { title: 'Subjects' },
      curveType: 'function',
      seriesType: 'bars',
      series: {
        2: { type: 'line' }
      },
      animation: {
        duration: 1500,
        easing: 'out',
        startup: true
      },
      colors: ['#EE8100', '#9575CD', '#CECEA7'],
      chartArea: {
        left: 100,
        right: 100,
        top: 100,
        bottom: 100,
      }
    };

    var chart = new google.visualization.ComboChart(document.getElementById('subjects_chart'));
    chart.draw(data, options);
  }
</script>

<div class="row py-3">
  <div class="col-md-4">
    <div class="card card-body">
      Current Class
      <hr />
      <h3 class="p-2">{{$curentclass->name}}</h3>
      <div class="row p-2">
        <div class="col-md-8">
          Class Teacher: <br> 
          <span>{{$curentclass->teacher->fullname ?? 'Class Teacher not Set'}}</span> <br>
          <span>{{$curentclass->teacher->qualification ?? 'Class Teacher not Set'}}</span>
        </div>
        <div class="col-md-4 text-end d-flex flex-column justify-content-center">
          Contact:
          <div class="d-flex text-end justify-content-end">
            <a href="tel:{{$curentclass->teacher->phone ?? ''}}" class="btn btn-outline-danger btn-sm"> <i class='fa fa-phone'></i></a>
            <a href="mailto:{{$curentclass->teacher->email ?? ''}}" class="btn btn-danger btn-sm"> <i class='fa fa-envelope'></i> </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card card-body">
      All Subjects
      <hr />
      <div class="row px-2">
        <div class="col-md-7">
          <h5 class="text-center dashboardcounts">{{$curentclass->subjects->count()}}</h5>
        </div>
        <div class="col-md-5 text-end d-flex flex-column justify-content-center">
          <a href="{{route('reports')}}" class="btn btn-danger btn-sm">Reports</a>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card card-body">
      Outstanding Balance
      <hr />
      <div class="row p-2">
        <div class="col-md-7">
          <h3> &#8358;{{Auth()->user()->should_pay}}</h3>
        </div>
        <div class="col-md-5 text-end d-flex flex-column justify-content-center">
          <a href="{{route('accounts')}}"" class=" btn btn-danger btn-sm">Accounts</a>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row pt-3">
  @if (str_word_count($subject_performance) < 1) <div class="text-center p-5 bg-light">
    No data to display
</div>
@else
<div id="subjects_chart" style="width: 100%; height: 90vh;"></div>
@endif
</div>