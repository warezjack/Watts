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
				$("#noPrediction").hide();
				var options = {
    			chart: {
						renderTo: 'container',
        		type: 'spline'
    			},
			    yAxis: {
			        title: {
			            text: 'Total Percentage of Documents'
			        }
			    },
			    tooltip: {
			        crosshairs: true,
			        shared: true
			    },
			    plotOptions: {
			        spline: {
			            marker: {
			                radius: 4,
			                lineColor: '#666666',
			                lineWidth: 1
			            }
			        }
			    },
					series: [{
        		name: 'Anger',
					}, {
        		name: 'Disgust',
					}, {
        		name: 'Fear',
					}, {
						name: 'Joy',
					}, {
						name: 'Love',
					}, {
						name: 'Sadness',
					}, {
						name: 'Surprise',
					}]
				};

        $('#candidate').click(function() {
          $.ajax({
            url: "/predictBehavior",
            type: 'GET',
            data: {
              candidateId : $("#candidate").val()
            },
            success: function(data) {
							if(data == 1) {
								$("#noPrediction").show();
								$("#container").hide();
							}
							else {
								$("#container").show();
								$("#noPrediction").hide();

	 							data = $.parseJSON(data);
								emotions = ['Anger', 'Disgust', 'Fear', 'Joy', 'Love', 'Sadness', 'Surprise'];
								var years = [];
								$.each(data[0], function(index, value) {
									years.push(data[0][index]['year']);
								});
								for(i = 0; i <= 6; i++) {
									var predicted_values = [];
									for(j = 0; j <=4; j++) {
										predicted_values.push(parseInt(data[1][emotions[i]][j][1]));
									}
									options.series[i].data = predicted_values;
								}
								var chart = new Highcharts.Chart(options);
								chart.xAxis[0].setCategories(years);
								chart.setTitle({ text: 'Emotional Future Prediction of' + ' ' + $('#candidate option:selected').text()});
							}
            }
           });
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
		                    <li><a href="{{ url('/profiles') }}"><i class="glyphicon glyphicon-signal"></i> Profiles </a></li>
		                    <li><a href="{{ url('/compose') }}"><i class="glyphicon glyphicon-edit"></i> Compose </a></li>
		                    <li><a href="{{ url('/candidates') }}"><i class="glyphicon glyphicon-tasks"></i> Candidates </a></li>
		                    <li><a href="{{ url('/services') }}"><i class="glyphicon glyphicon-record"></i> Infrastructure Services </a></li>
		                    <li><a href="javascript:;"><i class="glyphicon glyphicon-cog"></i> Settings </a></li>
												<li class="nav-divider"></li>
												<li><a href="{{ url('/queues') }}"><i class="glyphicon glyphicon-align-justify"></i> Queues </a></li>
												<li><a href="{{ url('/storage') }}"><i class="glyphicon glyphicon-th-large"></i> Storage Analyzer </a></li>
												<li class="active"><a href="{{ url('/regression') }}"><i class="glyphicon glyphicon-hourglass"></i> Regression </a></li>
												<li><a href="{{ url('/comparator') }}"><i class="glyphicon glyphicon-stats"></i> Comparator </a></li>
		                    <li class="nav-divider"></li>
		                    <li><a href="{{ url('/logout') }}"><i class="glyphicon glyphicon-log-out"></i> Sign Out </a></li>
		                </ul>
		            </nav>
		        </div>
		        <div class="col-sm-10">
		        	<form class="form-inline">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
		        		<h5>Search Candidates</h5>
								<select class="form-control" id="candidate" name="candidate_user_id" style="width:100%">
									@foreach ($users as $user)
										<option value="{{$user->id}}">{{ $user->full_name }} </option>
									@endforeach
								</select>
								<hr>
								<div class="alert alert-danger" id="noPrediction">
  								<strong>We cannot predict!</strong> Candidate's collected data may be limited up to 2 years.
								</div>
								<div id="container" style="width:100%; height:400px;"></div>
							</form>
		        </div>
    		</div>
		</div>
	</body>
</html>
