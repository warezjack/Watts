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
				var myChart = Highcharts.chart('emotion', {
	    		chart: {
	        	type: 'column'
	    		},
	    		title: {
	        	text: 'Month-Wise Emotion Classification',
	    		},
	    		xAxis: {
		        categories: [
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
		            'Dec'
		        ],
		        crosshair: true
	    	},
		    yAxis: {
		        min: 0,
		        title: {
		            text: 'Percentage'
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
	    	series: [{
	      		name: 'Anger',
	        	data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]
	    		}, {
	      		name: 'Joy',
	        	data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]
	    		}, {
	        	name: 'Sadness',
	        	data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2]
	    		}, {
	        	name: 'Surprise',
	        	data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]
					}, {
						name: 'Disgust',
	        	data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]
					}, {
						name: 'Love',
	        	data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]
					}, {
						name: 'Fear',
	        	data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]
	    	}]
			});

			var mypolarity = Highcharts.chart('polarity', {
    		chart: {
        	plotBackgroundColor: null,
        	plotBorderWidth: 0,
        	plotShadow: false
    		},
    		title: {
      		text: 'Candidate<br>Polarity',
        	align: 'center',
        	verticalAlign: 'middle',
					fontFamily: 'Quicksand',
        	y: 40
    		},
    		tooltip: {
        	pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    		},
    		plotOptions: {
        pie: {
        	dataLabels: {
              enabled: true,
              distance: -50,
              style: {
                  fontWeight: 'bold',
                  color: 'white',
									fontFamily: 'Quicksand',
              }
          },
          startAngle: -90,
          endAngle: 90,
          center: ['50%', '75%']
        }
    	},
    	series: [{
        type: 'pie',
        name: 'Polarity',
        innerSize: '50%',
        data: [
            ['Positive',   10.38],
            ['Negative',       56.33],
            {
                name: 'Proprietary or Undetectable',
                y: 0.2,
                dataLabels: {
                    enabled: false
                }
            }
        	]
    		}]
			});

			var subject = Highcharts.chart('subject', {
				chart: {
					type: 'column'
				},
				title: {
					text: 'Month-Wise Subject Classification'
				},
				xAxis: {
					categories: [
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
							'Dec'
					],
					crosshair: true
			},
			yAxis: {
					min: 0,
					title: {
							text: 'Percentage'
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
			series: [{
						name: 'Anger',
						data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]
					}, {
						name: 'Joy',
						data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]
					}, {
						name: 'Sadness',
						data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2]
					}, {
						name: 'Surprise',
						data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]
					}, {
						name: 'Disgust',
						data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]
					}, {
						name: 'Love',
						data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]
					}, {
						name: 'Fear',
						data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]
				}]
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
		        	<form>
		        		<h5>Search Candidates</h5>
				  			<div class="input-group">
				    			<input type="text" class="form-control" placeholder="Search">
				    			<div class="input-group-btn">
				      			<button class="btn btn-default" type="submit">
				        		<i class="glyphicon glyphicon-search"></i>
				      			</button>
				    			</div>
				  			</div>
							</form>
							<br>
							<div id="emotion" style="width:100%; height:400px;"></div>
							<br>
							<div id="polarity" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
							<br>
							<div id="subject" style="width:100%; height:400px;"></div>
		        </div>
    		</div>
		</div>
	</body>
</html>
