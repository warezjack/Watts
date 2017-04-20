<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Watts</title>

		<!-- Latest compiled and minified CSS -->
		{{ Html::style('css/bootstrap.min.css') }}

		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<link rel="shortcut icon" href="{{ asset('favicon.ico') }}" >

		<!-- Referencing Bootstrap JS that is hosted locally -->
    {{ Html::script('js/bootstrap.min.js') }}

    	<!-- Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet" type="text/css">
		<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
		<script src="http://code.highcharts.com/highcharts.js"></script>
		<script src="https://code.highcharts.com/modules/exporting.js"></script>

    <script>
      $(document).ready(function() {

        var options = {
          chart: {
            renderTo: 'comparison',
            type: 'areaspline'
          },
          legend: {
              layout: 'vertical',
              align: 'left',
              verticalAlign: 'top',
              x: 150,
              y: 100,
              floating: true,
              borderWidth: 1,
              backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
          },
          xAxis: {
              categories: [
                  'Anger', 'Disgust', 'Fear', 'Joy', 'Love', 'Sadness', 'Surprise'
              ],
              plotBands: [{
                  from: 4.5,
                  to: 6.5,
                  color: 'rgba(68, 170, 213, .2)'
              }]
          },
          yAxis: {
              title: {
                  text: 'Percentage of Documents'
              }
          },
          tooltip: {
              shared: true,
              valueSuffix: '%'
          },
          credits: {
              enabled: false
          },
          plotOptions: {
              areaspline: {
                  fillOpacity: 0.5
              }
          },
          series: [{}, {}]
        };

        $('#difference').click(function() {
          if($('#first_candidate').val() == $('#second_candidate').val()) {
            alert('Please select another candidate for comparison');
          }
          else {
            $.ajax({
  						url: "/yearsWiseComparison",
  						type: 'GET',
  						data: {
  							firstCandidateId : $("#first_candidate").val(),
                secondCandidateId : $("#second_candidate").val(),
  						},
  						success: function(data) {
                data = $.parseJSON(data);
                options.series[0].name = $('#first_candidate option:selected').text();
  							options.series[0].data = data[0];

                options.series[1].name = $('#second_candidate option:selected').text();
  							options.series[1].data = data[1];

                var chart = new Highcharts.Chart(options);
                chart.setTitle({ text: 'Comparison Between' + ' ' + $('#first_candidate option:selected').text() +  ' And ' + $('#second_candidate option:selected').text() });
  						 }
  					});
          }
        });
      });
    </script>

		<!-- Styles -->
		<style type="text/css">
			h3 {
				font-family: 'Pacifico';
				font-size: 30px;
			}
			.nav-sidebar {
    			width: 100%;
			    border-right: 1px solid #ddd;
			}

			.nav-sidebar a {
			    color: #333;
			    -webkit-transition: all 0.08s linear;
			    -moz-transition: all 0.08s linear;
			    -o-transition: all 0.08s linear;
			    transition: all 0.08s linear;
			    -webkit-border-radius: 4px 0 0 4px;
			    -moz-border-radius: 4px 0 0 4px;
			    border-radius: 4px 0 0 4px;
			}
			.nav-sidebar .active a {
			    cursor: default;
			    background-color: #428bca;
			    color: #fff;
			    text-shadow: 1px 1px 1px #666;
			}
			.nav-sidebar .active a:hover {
			    background-color: #428bca;
			}
			.nav-sidebar .text-overflow a,
			.nav-sidebar .text-overflow .media-body {
			    white-space: nowrap;
			    overflow: hidden;
			    -o-text-overflow: ellipsis;
			    text-overflow: ellipsis;
			}
			h5{
				font-family: Quicksand;
				font-weight: bold;
			}
			label {
				font-family: Quicksand;
			}
      #second_candidate {
        float: right;
        width: 50%;
      }
		</style>
	</head>
	<body>
		<div class="container-fluid">
			<script src="js/sweetalert.min.js"></script>
			<script>
				@if (notify()->ready())
				    	swal({
				            title: "{!! notify()->message() !!}",
				            text: "{!! notify()->option('text') !!}",
				            type: "{{ notify()->type() }}",
				            timer: 1000,
				            showConfirmButton: false
				        });
				@endif
			</script>
			<h3 align="center">Watts</h3>
			<hr>
			 <div class="row">
		        <div class="col-sm-2">
		            <nav class="nav-sidebar">
		                <ul class="nav">
		                    <li><a href="{{ url('/index') }}"><i class="glyphicon glyphicon-modal-window"></i> Dashboard </a></li>
		                    <li><a href="{{ url('/assessments') }}"><i class="glyphicon glyphicon-list-alt"></i> Assessments </a></li>
		                    <li><a href="{{ url('/profiles') }}"><i class="glyphicon glyphicon-user"></i> Profiles </a></li>
		                    <li><a href="{{ url('/compose') }}"><i class="glyphicon glyphicon-edit"></i> Compose </a></li>
		                    <li><a href="{{ url('/candidates') }}"><i class="glyphicon glyphicon-tasks"></i> Candidates </a></li>
		                    <li><a href="{{ url('/services') }}"><i class="glyphicon glyphicon-record"></i> Infrastructure Services </a></li>
		                    <li><a href="javascript:;"><i class="glyphicon glyphicon-cog"></i> Settings </a></li>
												<li class="nav-divider"></li>
												<li><a href="{{ url('/storage') }}"><i class="glyphicon glyphicon-th-large"></i> Storage Analyzer </a></li>
												<li><a href="{{ url('/regression') }}"><i class="glyphicon glyphicon-hourglass"></i> Regression </a></li>
												<li class="active"><a href="{{ url('/comparator') }}"><i class="glyphicon glyphicon-stats"></i> Comparator </a></li>
		                    <li class="nav-divider"></li>
		                    <li><a href="{{ url('/logout') }}"><i class="glyphicon glyphicon-log-out"></i> Sign Out </a></li>
		                </ul>
		            </nav>
		        </div>
		        <div class="col-sm-10">
              <h5>Search Candidates for Comparison</h5>
              <form class="form-inline">
                <select class="form-control" id="first_candidate" name="candidate_user_id" style="width:48%">
                  @foreach ($users as $user)
                    <option value="{{$user->id}}">{{ $user->full_name }} </option>
                  @endforeach
                </select>
                <i class="glyphicon glyphicon-option-vertical"></i>
                <select class="form-control" id="second_candidate" name="candidate_user_id">
                  @foreach ($users as $user)
                    <option value="{{$user->id}}">{{ $user->full_name }} </option>
                  @endforeach
                </select>
                <hr>
                <label for="sel1">Select Comparator Parameter: &nbsp;</label>
                <select class="form-control" id="difference" name="distribution" style="width:140px">
                  <option value="0">Past Year</option>
                </select>
              </form>
              <hr>
              <div id="comparison" style="width:100%; height:400px;"></div>
		        </div>
    		</div>
		</div>
	</body>
</html>
