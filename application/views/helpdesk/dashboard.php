<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Dashboard</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><i class="fa fa-home"></i> Dashboard</li>
        </ol>
    </div>
    <div class="col-md-7 col-4 align-self-center">

    </div>
</div>

<div class="row">
<!-- Column -->
  <div class="col-lg-6 col-md-6">
    <a href="#/user">
      <div class="card">
          <div class="card-body">
              <div class="d-flex flex-row">
                  <div class="round round-lg align-self-center round-info"><i class="fa fa-user"></i></div>
                  <div class="m-l-10 align-self-center">
                      <h3 class="m-b-0 font-light" id="count_user">0</h3>
                      <h5 class="text-muted m-b-0">Total User</h5></div>
              </div>
          </div>
      </div>
    </a>
  </div>
  <!-- Column -->
  <!-- Column -->
  <div class="col-lg-6 col-md-6">
      <a href="#/log">
        <div class="card">
          <div class="card-body">
              <div class="d-flex flex-row">
                  <div class="round round-lg align-self-center round-warning"><i class="mdi mdi-recycle"></i></div>
                  <div class="m-l-10 align-self-center">
                      <h3 class="m-b-0 font-lgiht" id="count_log">0</h3>
                      <h5 class="text-muted m-b-0">Total Log</h5></div>
              </div>
          </div>
        </div>
      </a>
  </div>
</div>

<div class="row">
  <div class="col-md-4">
    <div class="card">
      <div class="card-body">
        <canvas id="userChart" height="230"></canvas>
      </div>
    </div>
  </div>
  <div class="col-md-8">
    <div class="card">
      <div class="card-body">
        <canvas id="logChart" height="120"></canvas>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
$(document).ready(function(){

  var userChart = new Chart(document.getElementById('userChart').getContext('2d'),{
    type : 'pie',
    data : {
      labels : [],
      datasets: [{
        data : [],
        backgroundColor: [
          "#17a2b8",
          "#28a745",
          'yellow',
          'red'
        ]
      }],
    },

    options : {
      legend : {
        display : true,
      },
      responsive : true,
      tooltips: {
        enabled: true,
      }
    }
  });

    var logChart = new Chart(document.getElementById('logChart').getContext('2d'),{
    type: 'bar',
    data: {
      labels:[
        'Jan',
        'Feb',
        'Mar',
        'Apr',
        'May',
        'Jun',
        'Jul',
        'Aug',
        'Sep',
        'Oct',
        'Nov',
        'Dec',
      ],
      datasets:[{
        label: 'Log by month',
        data: [],
        borderColor: "rgba(0, 176, 228, 0.75)",
        backgroundColor: "rgb(0, 176, 228)",
        pointBorderColor: "rgba(0, 176, 228, 0)",
        pointBackgroundColor: "rgba(0, 176, 228, 0.9)",
        pointBorderWidth: 1,
      }],
    },
    options:{
      responsive : true,
      legend : {
        display : true,
      },
    },
  });

  $.ajax({
    url: `<?= base_url('api/log/statistic/') ?>${auth.token}`,
    type: 'GET',
    dataType: 'JSON',
    success: function(response){
      $.each(response.data.log_by_month, function(k, v){
        logChart.data.datasets[0].data.push(v);
      });
      $('#count_log').text(response.data.total_log);
      logChart.update();
    }
  });

  $.ajax({
    url: `<?= base_url('api/user/statistic/') ?>${auth.token}`,
    type: 'GET',
    dataType: 'JSON',
    success: function(response){
      var total = 0;
      $.each(response.data, function(k, v){
        userChart.data.labels.push(v.level);
        userChart.data.datasets[0].data.push(v.jml_user);

        total += parseInt(v.jml_user);
      });
      $('#count_user').text(total);
      userChart.update();
    }
  })
})
</script>
