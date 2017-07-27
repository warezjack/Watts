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
		<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
		<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
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

				var polarity_options = {
    			chart: {
						renderTo: 'polarity_container',
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
        		name: 'Positive',
					}, {
        		name: 'Negative',
					}, {
        		name: 'Offensive',
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
								$("#polarity_container").hide();
								$(".btn").hide();
							}
							else {
								$(".btn").show();
								$("#noPrediction").hide();

								if($('#toggler').prop('checked')) {
									$("#polarity_container").show();
									$("#container").hide();
								}
								else {
									$("#polarity_container").hide();
									$("#container").show();
								}

								data = $.parseJSON(data);
								emotions = ['Anger', 'Disgust', 'Fear', 'Joy', 'Love', 'Sadness', 'Surprise'];
								polarity = ['Positive', 'Negative', 'Offensive'];

								var years = [];
								$.each(data[0], function(index, value) {
									years.push(data[0][index]['year']);
								});
								for(i = 0; i <= 6; i++) {
									var predicted_values = [];
									for(j = 0; j <=4; j++) {
										if(typeof data[1][emotions[i]][j] == "undefined") {
											predicted_values.push(0);
										}
										else {
											predicted_values.push(parseInt(data[1][emotions[i]][j][1]));
										}
									}
									options.series[i].data = predicted_values;
								}
								for(i = 0; i<= 2; i++) {
									var predicted_polarity_values = [];
									for(j = 0; j <= 4; j++) {
										if(typeof data[2][polarity[i]][j] == "undefined") {
											predicted_polarity_values.push(0);
										}
										else {
											predicted_polarity_values.push(parseInt(data[2][polarity[i]][j][1]));
										}
									}
									polarity_options.series[i].data = predicted_polarity_values;
								}
								var chart = new Highcharts.Chart(options);
								var polarityChart = new Highcharts.Chart(polarity_options);

								chart.xAxis[0].setCategories(years);
								polarityChart.xAxis[0].setCategories(years);

								chart.setTitle({ text: 'Emotional Future Prediction of' + ' ' + $('#candidate option:selected').text()});
								polarityChart.setTitle({ text: 'Polarity Future Prediction of' + ' ' + $('#candidate option:selected').text()});
							}
            }
           });
        });
				$("#toggler").change(function() {
					if($(this).prop('checked')) {
						$("#polarity_container").show();
						$("#container").hide();
					}
					else {
						$("#polarity_container").hide();
						$("#container").show();
					}
				});
				$("#polarity_container").hide();
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
					margin-top: -20px;
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
			h5 {
				font-family: Quicksand;
				font-weight: bold;
			}
			label {
				font-family: Quicksand;
			}
			.btn-primary {
				background-color: #DC143C;
				border-color: #DC143C;
			}
			.btn-default.active {
				background-color: #008080;
				border-color: #008080;
				color: #fff;
			}
			.toggle {
				float: right;
				border-radius: 50px;
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
		                    <li><a href="{{ url('/assessments') }}"><i class="glyphicon glyphicon-list-alt"></i> Assessments </a></li>
		                    <li><a href="{{ url('/profiles') }}"><i class="glyphicon glyphicon-signal"></i> Profiles </a></li>
		                    <li><a href="{{ url('/compose') }}"><i class="glyphicon glyphicon-edit"></i> Compose </a></li>
		                    <li><a href="{{ url('/candidates') }}"><i class="glyphicon glyphicon-tasks"></i> Candidates </a></li>
		                    <li><a href="{{ url('/services') }}"><i class="glyphicon glyphicon-record"></i> Infrastructure Services </a></li>
		                    <li><a href="{{ url('/settings') }}"><i class="glyphicon glyphicon-cog"></i> Settings </a></li>
												<li class="nav-divider"></li>
												<li><a href="{{ url('/queues') }}"><i class="glyphicon glyphicon-align-justify"></i> Queues </a></li>
												<li><a href="{{ url('/storage') }}"><i class="glyphicon glyphicon-th-large"></i> Storage Analyzer </a></li>
												<li class="active"><a href="{{ url('/regression') }}"><i class="glyphicon glyphicon-hourglass"></i> Regression </a></li>
												<li><a href="{{ url('/comparator') }}"><i class="glyphicon glyphicon-stats"></i> Comparator </a></li>
												<li class="nav-divider"></li>
												<li><a href="{{ url('/plutchik') }}"><i class="glyphicon glyphicon-certificate"></i> Plutchik's Test </a></li>
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
							</form>
							<br>
								<input type="checkbox" data-toggle="toggle" data-on="Polarity" data-off="Emotion" id="toggler">
								<div class="alert alert-danger" id="noPrediction">
  								<strong>We cannot predict!</strong> Candidate's collected data may be limited up to 2 years.
								</div>
								<div id="container" style="width:100%; height:400px;"></div>
								<div id="polarity_container" style="width:100%; height:400px;"></div>
		        </div>
    		</div>
		</div>
	</body>
</html>
