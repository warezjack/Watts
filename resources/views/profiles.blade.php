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

			var monthNames = JSON.parse('{"1":"Jan", "2":"Feb", "3":"Mar", "4":"Apr", "5":"May", "6":"Jun","7":"Jul", "8":"Aug", "9":"Sept", "10":"Oct", "11":"Nov", "12":"Dec"}');

			$(document).ready(function() {

				$('#month_name').hide();
				$('#month').hide();
				$('#year').hide();
				$('#year_name').hide();

				$("#candidate").click(function() {
					$('#year').empty();
					$('#month').empty();

					$.ajax({
						url: "/yearsWiseData",
						type: 'GET',
						data: {
							candidateId : $("#candidate").val()
						},
						success: function(data) {
							data = $.parseJSON(data);
							for(i = 0; i <= 6; i++) {
								var years = [];
								$.each(data[0], function(index, value) {
									year = data[0][index];
									years.push(data[1][year][i]);
								});
								options.series[i].data = years;
							}
							for(i = 0; i <= 2; i++) {
								var polarityYears = [];
								$.each(data[0], function(index, value) {
									year = data[0][index];
									polarityYears.push(data[3][year][i]);
								});
								polarityOptions.series[i].data = polarityYears;
							}
							var chart = new Highcharts.Chart(options);
							var polarityChart = new Highcharts.Chart(polarityOptions);

							chart.xAxis[0].setCategories(data[0]);
							polarityChart.xAxis[0].setCategories(data[0]);
							chart.setTitle({ text: 'Yearwise Emotion Classification of' + ' ' + $('#candidate option:selected').text()});
							polarityChart.setTitle({ text: 'Yearwise Polarity Classification of' + ' ' + $('#candidate option:selected').text()});
						}
					 });

					 $.ajax({
						 url: "/years",
						 type: 'GET',
						 data: {
							 candidateId : $("#candidate").val()
						 },
						 success: function(data) {
							 data = $.parseJSON(data)
							 $.each(data, function(index, value) {
									 $("#year").append('<option value="' + data[index].year + '">' + data[index].year + '</option>');
							 });
						 }
					 });
				});

				var options = {
	    		chart: {
						renderTo: 'emotion',
	        	type: 'column',
	    		},
	    		xAxis: {
						categories: [],
		        crosshair: true
	    		},
		    	yAxis: {
		        min: 0,
		        title: {
		            text: 'Total Percentage Of Documents'
		        }
		    	},
	    		tooltip: {
	      		headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
	        	pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
	            '<td style="padding:0"><b>{point.y:.1f} </b></td></tr>',
	        	footerFormat: '</table>',
	        	shared: true,
	        	useHTML: true
	    		},
	    		plotOptions: {
	      		column: {
	            pointPadding: 0.2,
	            borderWidth: 0,
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

				var polarityOptions = {
	    		chart: {
						renderTo: 'polarity',
	        	type: 'column',
	    		},
	    		xAxis: {
						categories: [],
		        crosshair: true
	    		},
		    	yAxis: {
		        min: 0,
		        title: {
		            text: 'Total Percentage Of Documents'
		        }
		    	},
	    		tooltip: {
	      		headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
	        	pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
	            '<td style="padding:0"><b>{point.y:.1f} </b></td></tr>',
	        	footerFormat: '</table>',
	        	shared: true,
	        	useHTML: true
	    		},
	    		plotOptions: {
	      		column: {
	            pointPadding: 0.2,
	            borderWidth: 0,
	        	}
	    		},
					series: [{
        		name: 'Negative',
					}, {
        		name: 'Offensive',
					}, {
        		name: 'Positive',
					}]
				};

				$.ajax({
					url: "/yearsWiseData",
					type: 'GET',
					data: {
						candidateId : $("#candidate").val()
					},
					success: function(data) {
						data = $.parseJSON(data);
						for(i = 0; i <= 6; i++) {
							var years = [];
							$.each(data[0], function(index, value) {
								year = data[0][index];
								years.push(data[1][year][i]);
							});
							options.series[i].data = years;
						}
						for(i = 0; i <= 2; i++) {
							var polarityYears = [];
							$.each(data[0], function(index, value) {
								year = data[0][index];
								polarityYears.push(data[3][year][i]);
							});
							polarityOptions.series[i].data = polarityYears;
						}
						var chart = new Highcharts.Chart(options);
						var polarityChart = new Highcharts.Chart(polarityOptions);

						chart.xAxis[0].setCategories(data[0]);
						polarityChart.xAxis[0].setCategories(data[0]);
						chart.setTitle({ text: 'Yearwise Emotion Classification of' + ' ' + $('#candidate option:selected').text()});
						polarityChart.setTitle({ text: 'Yearwise Polarity Classification of' + ' ' + $('#candidate option:selected').text()});
					}
				});

				$.ajax({
					url: "/years",
					type: 'GET',
					data: {
						candidateId : $("#candidate").val()
					},
					success: function(data) {
						data = $.parseJSON(data)
						$.each(data, function(index, value) {
								$("#year").append('<option value="' + data[index].year + '">' + data[index].year + '</option>');
						});
					}
				});

				$('#dist').click(function() {
					var dist_value = $('#dist').val();
					if(dist_value == 0) {
						$('#year').hide();
						$('#year_name').hide();
						$('#month_name').hide();
						$('#month').hide();
					}
					else if(dist_value == 1) {
						$('#year').show();
						$('#year_name').show();
						$('#month').hide();
						$('#month_name').hide();

						$('#year').click(function() {

							$.ajax({
								url: "/monthsWiseData",
								type: 'GET',
								data: {
									candidateId : $("#candidate").val(),
									year: $("#year").val()
								},

								success: function(data) {
									data = $.parseJSON(data);
									console.log(data);
									for(i = 0; i <= 6; i++) {
										var years = [];
										$.each(data[0], function(index, value) {
											year = data[0][index];
											years.push(data[2][year][i]);
										});
										options.series[i].data = years;
									}

									for(i = 0; i <= 2; i++) {
										var polarityYears = [];
										$.each(data[0], function(index, value) {
											year = data[0][index];
											polarityYears.push(data[4][year][i]);
										});
										polarityOptions.series[i].data = polarityYears;
									}

									var monthNamesArray = [];
									$.each(data[0], function(index, value) {
											monthNamesArray.push(monthNames[data[0][index]]);
									});

									var chart = new Highcharts.Chart(options);
									var polarityChart = new Highcharts.Chart(polarityOptions);

									chart.xAxis[0].setCategories(monthNamesArray);
									polarityChart.xAxis[0].setCategories(monthNamesArray);
									chart.setTitle({ text: 'Month Wise Emotion Classification of' + ' ' + $('#candidate option:selected').text() + ' for ' + $("#year").val() });
									polarityChart.setTitle({ text: 'Month Wise Polarity Classification of' + ' ' + $('#candidate option:selected').text() + ' for ' + $("#year").val() });

								}
							});

						});
					}
					else {
						$('#year').show();
						$('#year_name').show();
						$('#month_name').show();
						$('#month').show();

						$('#year').click(function() {
							$('#month').empty();

							$.ajax({
								url: "/months",
								type: 'GET',
								data: {
									candidateId : $("#candidate").val(),
									year: $('#year').val(),
								},
								success: function(data) {
									data = $.parseJSON(data)
									$.each(data, function(index, value) {
											$("#month").append('<option value="' + data[index].month + '">' + monthNames[data[index].month] + '</option>');
									});
								}
							});
						});

						$('#month').click(function() {

							$.ajax({
								url: "/daysWiseData",
								type: 'GET',
								data: {
									candidateId : $("#candidate").val(),
									year: $('#year').val(),
									month: $('#month').val(),
								},
								success: function(data) {
									data = $.parseJSON(data);
									for(i = 0; i <= 6; i++) {
										var days = [];
										$.each(data[0], function(index, value) {
											year = data[0][index];
											days.push(data[2][year][i]);
										});
										options.series[i].data = days;
									}
									for(i = 0; i <= 2; i++) {
										var polarityYears = [];
										$.each(data[0], function(index, value) {
											year = data[0][index];
											polarityYears.push(data[4][year][i]);
										});
										polarityOptions.series[i].data = polarityYears;
									}
									var chart = new Highcharts.Chart(options);
									var polarityChart = new Highcharts.Chart(polarityOptions);
									chart.xAxis[0].setCategories(data[0]);
									polarityChart.xAxis[0].setCategories(data[0]);
									chart.setTitle({ text: 'Day Wise Emotion Classification of' + ' ' + $('#candidate option:selected').text() + ' for ' + monthNames[$("#month").val()] });
									polarityChart.setTitle({ text: 'Day Wise Polarity Classification of' + ' ' + $('#candidate option:selected').text() + ' for ' + monthNames[$("#month").val()] });

								}
							});
						});
					}
				});
				$("#polarity").hide();
				$("#toggler").change(function() {
					if($(this).prop('checked')) {
						$("#polarity").show();
						$("#emotion").hide();
					}
					else {
						$("#polarity").hide();
						$("#emotion").show();
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
					margin-top: -15px;
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
			.toggle {
				float: right;
				border-radius: 50px;
			}
			hr {
				margin-top: 15px;
				margin-bottom: 15px;
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
			ol, ul {
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
		                    <li class="active"><a href="{{ url('/profiles') }}"><i class="glyphicon glyphicon-signal"></i> Profiles </a></li>
		                    <li><a href="{{ url('/compose') }}"><i class="glyphicon glyphicon-edit"></i> Compose </a></li>
		                    <li><a href="{{ url('/candidates') }}"><i class="glyphicon glyphicon-tasks"></i> Candidates </a></li>
		                    <li><a href="{{ url('/services') }}"><i class="glyphicon glyphicon-record"></i> Infrastructure Services </a></li>
		                    <li><a href="javascript:;"><i class="glyphicon glyphicon-cog"></i> Settings </a></li>
												<li class="nav-divider"></li>
												<li><a href="{{ url('/queues') }}"><i class="glyphicon glyphicon-align-justify"></i> Queues </a></li>
												<li><a href="{{ url('/storage') }}"><i class="glyphicon glyphicon-th-large"></i> Storage Analyzer </a></li>
												<li><a href="{{ url('/regression') }}"><i class="glyphicon glyphicon-hourglass"></i> Regression </a></li>
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
								<hr>
								<div class="form-group">
									<label for="sel1">Select Distribution: &nbsp;</label>
			  					<select class="form-control" id="dist" name="distribution" style="width:140px">
								    <option value="0">Year Wise</option>
								    <option value="1">Month Wise</option>
								    <option value="2">Day Wise</option>>
			  					</select>
									&nbsp;
									<label for="sel1" id="year_name">Select Year: &nbsp;</label>
			  					<select class="form-control" id="year" name="year_list" style="width:140px">
			  					</select>
									&nbsp;
									<label for="sel1" id="month_name">Select Month: &nbsp;</label>
			  					<select class="form-control" id="month" name="month_list" style="width:140px">
			  					</select>
								</div>
								<input type="checkbox" data-toggle="toggle" data-on="Polarity" data-off="Emotion" id="toggler">
								<hr>
							</form>
							<div id="emotion" style="width:100%; height:400px;"></div>
							<div id="polarity" style="width:100%; height:400px;"></div>
		        </div>
    		</div>
		</div>
	</body>
</html>
