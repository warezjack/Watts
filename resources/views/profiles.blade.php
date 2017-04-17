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

				$('#month_name').hide();
				$('#month').hide();

				$("#candidate").change(function(){

					$('#year').empty();
					$('#month').empty();

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
	    		title: {
	        	text: 'Year-Wise Emotion Classification',
	    		},
	    		xAxis: {
		        categories: ['2016'],
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
	            borderWidth: 0
	        	}
	    		},
				};

				$('#year').change(function(){
					$('#month').empty();
					$.ajax({
						url: "/months",
						type: 'GET',
						data: {
							candidateId : $("#candidate").val(),
							year: $('#year').val(),
						},
						success: function(data) {
							data = $.parseJSON(data);

							$.each(data[0], function(index, value) {
								$("#month").append('<option value="' + data[0][index].month + '">' + data[0][index].month + '</option>');
							});
							var chart = new Highcharts.Chart(options);

							$.each(data[1], function(index, value) {
								chart.addSeries({
									name: data[1][index],
									data: [data[2][index]]
								});
    					});
						}
					});
				});

				$('#dist').change(function(){
					var dist_value = $('#dist').val();
					if(dist_value == 0) {
						$('#month_name').hide();
						$('#month').hide();
					}
					else if(dist_value == 1) {
						$('#month_name').show();
						$('#month').show();
					}
					else {
						$('#month_name').show();
						$('#month').show();
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


		                    <li class="active"><a href="{{ url('/profiles') }}"><i class="glyphicon glyphicon-user"></i> Profiles </a></li>

		                    <li><a href="{{ url('/compose') }}"><i class="glyphicon glyphicon-edit"></i> Compose </a></li>

		                    <li><a href="{{ url('/candidates') }}"><i class="glyphicon glyphicon-tasks"></i> Candidates </a></li>
		                    <li><a href="{{ url('/services') }}"><i class="glyphicon glyphicon-record"></i> Infrastructure Services </a></li>
		                    <li><a href="javascript:;"><i class="glyphicon glyphicon-cog"></i> Settings </a></li>

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
									<label for="sel1">Select Year: &nbsp;</label>
			  					<select class="form-control" id="year" name="year_list" style="width:140px">
			  					</select>
									&nbsp;
									<label for="sel1" id="month_name">Select Month: &nbsp;</label>
			  					<select class="form-control" id="month" name="month_list" style="width:140px">
			  					</select>
								</div>
								<hr>
							</form>
							<div id="emotion" style="width:100%; height:400px;"></div>
		        </div>
    		</div>
		</div>
	</body>
</html>
