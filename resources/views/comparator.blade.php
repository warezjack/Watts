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

				$('#firstYearWise').hide();
				$('#secondYearWise').hide();
				$('#firstMonthWise').hide();
				$('#secondMonthWise').hide();
				$('#firstDayWise').hide();
				$('#secondDayWise').hide();
				$('#year_name').hide();
				$('#month_name').hide();
				$('#day_name').hide();
				$('#year_icon').hide();
				$('#month_icon').hide();
				$('#day_icon').hide();

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

				var polarityOptions = {
          chart: {
            renderTo: 'polarityComparison',
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
                  'Negative', 'Offensive', 'Positive'
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

				function yearWiseComparison(firstYear, secondYear) {
					$.ajax({
					 url: "/yearsWiseComparison",
					 type: 'GET',
					 data: {
						 firstCandidateId : $("#first_candidate").val(),
						 secondCandidateId : $("#second_candidate").val(),
						 firstCandidateYear : firstYear,
						 secondCandidateYear : secondYear,
					 },
					 success: function(data) {
						 data = $.parseJSON(data);
						 console.log(data);
						 options.series[0].name = $('#first_candidate option:selected').text() + ' - ' + firstYear;
						 options.series[0].data = data[0];

						 options.series[1].name = $('#second_candidate option:selected').text() + ' - ' + secondYear;
						 options.series[1].data = data[1];

						 polarityOptions.series[0].name = $('#first_candidate option:selected').text() + ' - ' + firstYear;
						 polarityOptions.series[0].data = data[2];

						 polarityOptions.series[1].name = $('#second_candidate option:selected').text() + ' - ' + secondYear;
						 polarityOptions.series[1].data = data[3];

						 var chart = new Highcharts.Chart(options);
						 var polarityChart = new Highcharts.Chart(polarityOptions);

						 chart.setTitle({ text: 'Emotional Comparison Between' + ' ' + $('#first_candidate option:selected').text() +  ' And ' + $('#second_candidate option:selected').text() });
						 polarityChart.setTitle({ text: 'Polarity Comparison Between' + ' ' + $('#first_candidate option:selected').text() +  ' And ' + $('#second_candidate option:selected').text() });

					 }
					});
				}

				function getMonths(candidateId, year, monthSelect) {
					$.ajax({
						url: "/getMonths",
						type: 'GET',
						data: {
							candidateId : candidateId,
							candidateYear: year,
						},
						success: function(data) {
							data = data = $.parseJSON(data);
							$.each(data, function(index, value) {
								 $(monthSelect).append('<option value="' + data[index].month + '">' + monthNames[data[index].month] + '</option>');
							});
							$(monthSelect).show();
							$('#month_name').show();
						 }
					});
				}

				function getYears(firstId, secondId) {
					$.ajax({
						url: "/getYears",
						type: 'GET',
						data: {
							firstCandidateId : firstId,
							secondCandidateId : secondId,
						},
						success: function(data) {
							data = data = $.parseJSON(data);
							$.each(data[0], function(index, value) {
								 $("#firstYearWise").append('<option value="' + data[0][index].year + '">' + data[0][index].year + '</option>');
							});
							$.each(data[1], function(index, value) {
								 $("#secondYearWise").append('<option value="' + data[1][index].year + '">' + data[1][index].year + '</option>');
							});
							$('#firstYearWise').show();
							$('#secondYearWise').show();
							$('#year_name').show();
							$('#year_icon').show();

							if($("#difference").val() == 1) {
								getMonths($('#first_candidate').val(), $('#firstYearWise').val(), "#firstMonthWise");
								$("#month_icon").show();
								getMonths($('#second_candidate').val(), $('#secondYearWise').val(), "#secondMonthWise");
							}
						 }
					});
				}

				function getDays(candidateId, year, month, daySelect) {
					$.ajax({
					 url: "/getDays",
					 type: 'GET',
					 data: {
						 candidateId : candidateId,
						 candidateYear: year,
						 candidateMonth: month,
					 },
					 success: function(data) {
						 data = data = $.parseJSON(data);
						 $.each(data, function(index, value) {
								$(daySelect).append('<option value="' + data[index].day + '">' + data[index].day + '</option>');
						 });
					 }
					});
				}

				function monthsWiseComparison(firstCandidateId, secondCandidateId, firstCandidateYear, secondCandidateYear, firstCandidateMonth, secondCandidateMonth) {
					$.ajax({
					 url: "/monthsWiseComparison",
					 type: 'GET',
					 data: {
						 firstCandidateId : firstCandidateId,
						 secondCandidateId : secondCandidateId,
						 firstCandidateYear : firstCandidateYear,
						 secondCandidateYear : secondCandidateYear,
						 firstCandidateMonth : firstCandidateMonth,
						 secondCandidateMonth : secondCandidateMonth,
					 },
					 success: function(data) {
						 data = $.parseJSON(data);
						 options.series[0].name = $('#first_candidate option:selected').text() + ' - ' + monthNames[firstCandidateMonth];
						 options.series[0].data = data[0];

						 options.series[1].name = $('#second_candidate option:selected').text() + ' - ' + monthNames[secondCandidateMonth];
						 options.series[1].data = data[1];

						 polarityOptions.series[0].name = $('#first_candidate option:selected').text() + ' - ' + monthNames[firstCandidateMonth];
						 polarityOptions.series[0].data = data[2];

						 polarityOptions.series[1].name = $('#second_candidate option:selected').text() + ' - ' + monthNames[secondCandidateMonth];
						 polarityOptions.series[1].data = data[3];

						 var chart = new Highcharts.Chart(options);
						 var polarityChart = new Highcharts.Chart(polarityOptions);

						 chart.setTitle({ text: 'Emotional Comparison Between' + ' ' + $('#first_candidate option:selected').text() +  ' And ' + $('#second_candidate option:selected').text() });
						 polarityChart.setTitle({ text: 'Polarity Comparison Between' + ' ' + $('#first_candidate option:selected').text() +  ' And ' + $('#second_candidate option:selected').text() });
					 }
					});
				}

				function daysWiseComparison(firstCandidateId, secondCandidateId, firstCandidateYear, secondCandidateYear, firstCandidateMonth, secondCandidateMonth, firstCandidateDay, secondCandidateDay) {
					$.ajax({
					 url: "/daysWiseComparison",
					 type: 'GET',
					 data: {
						 firstCandidateId : firstCandidateId,
						 secondCandidateId : secondCandidateId,
						 firstCandidateYear : firstCandidateYear,
						 secondCandidateYear : secondCandidateYear,
						 firstCandidateMonth : firstCandidateMonth,
						 secondCandidateMonth : secondCandidateMonth,
						 firstCandidateDay : firstCandidateDay,
						 secondCandidateDay : secondCandidateDay,
					 },
					 success: function(data) {
						 data = $.parseJSON(data);
						 options.series[0].name = $('#first_candidate option:selected').text() + ' - ' + firstCandidateDay;
						 options.series[0].data = data[0];

						 options.series[1].name = $('#second_candidate option:selected').text() + ' - ' + secondCandidateDay;
						 options.series[1].data = data[1];

						 polarityOptions.series[0].name = $('#first_candidate option:selected').text() + ' - ' + firstCandidateDay;
						 polarityOptions.series[0].data = data[2];

						 polarityOptions.series[1].name = $('#second_candidate option:selected').text() + ' - ' + secondCandidateDay;
						 polarityOptions.series[1].data = data[3];

						 var chart = new Highcharts.Chart(options);
						 var polarityChart = new Highcharts.Chart(polarityOptions);

						 chart.setTitle({ text: 'Emotional Comparison Between' + ' ' + $('#first_candidate option:selected').text() +  ' And ' + $('#second_candidate option:selected').text() });
						 polarityChart.setTitle({ text: 'Polarity Comparison Between' + ' ' + $('#first_candidate option:selected').text() +  ' And ' + $('#second_candidate option:selected').text() });
					 }
					});
				}

        $('#difference').click(function() {

					if($('#first_candidate').val() == $('#second_candidate').val()) {
						swal('You can\'t compare same candidate', 'Please choose another candidate for comparison.', 'error')
					}

					else {
						if($('#difference').val() == 0) {
							$('#firstYearWise').empty();
							$('#secondYearWise').empty();

							getYears($('#first_candidate').val(), $('#second_candidate').val());

							$('#firstYearWise').click(function() {
								yearWiseComparison($("#firstYearWise").val(), $("#secondYearWise").val());
							});

							$('#secondYearWise').click(function() {
								yearWiseComparison($("#firstYearWise").val(), $("#secondYearWise").val());
							});
						}

						else if($('#difference').val() == 1) {

							$('#firstYearWise').empty();
							$('#secondYearWise').empty();

							getYears($('#first_candidate').val(), $('#second_candidate').val());

							$('#firstYearWise').click(function() {
								$('#firstMonthWise').empty();
								getMonths($('#first_candidate').val(), $('#firstYearWise').val(), "#firstMonthWise");
								$('#month_icon').show();
							});

							$('#secondYearWise').click(function() {
								$('#secondMonthWise').empty();
								getMonths($('#second_candidate').val(), $('#secondYearWise').val(), "#secondMonthWise");
							});

							$('#firstMonthWise').click(function() {
								monthsWiseComparison($('#first_candidate').val(), $('#second_candidate').val(), $('#firstYearWise').val(), $('#secondYearWise').val(), $('#firstMonthWise').val(), $('#secondMonthWise').val());
							});

							$('#secondMonthWise').click(function () {
									monthsWiseComparison($('#first_candidate').val(), $('#second_candidate').val(), $('#firstYearWise').val(), $('#secondYearWise').val(), $('#firstMonthWise').val(), $('#secondMonthWise').val());
							});
						}

						else {
							$('#firstYearWise').empty();
							$('#secondYearWise').empty();

							getYears($('#first_candidate').val(), $('#second_candidate').val());

							$('#firstYearWise').click(function() {
								$('#firstMonthWise').empty();
								getMonths($('#first_candidate').val(), $('#firstYearWise').val(), "#firstMonthWise");
								$('#month_icon').show();
							});

							$('#secondYearWise').click(function() {
								$('#secondMonthWise').empty();
								getMonths($('#second_candidate').val(), $('#secondYearWise').val(), "#secondMonthWise");
							});

							$('#firstMonthWise').click(function () {
								$('#firstDayWise').empty();
								getDays($('#first_candidate').val(), $('#firstYearWise').val(), $('#firstMonthWise').val(), "#firstDayWise");
								$('#firstDayWise').show();
								$('#day_name').show();
							});

							$('#secondMonthWise').click(function () {
								$('#secondDayWise').empty();
								getDays($('#second_candidate').val(), $('#secondYearWise').val(), $('#secondMonthWise').val(), "#secondDayWise");
								$('#day_icon').show();
								$('#secondDayWise').show();
							});

							$('#firstDayWise').click(function() {
								daysWiseComparison($('#first_candidate').val(), $('#second_candidate').val(), $('#firstYearWise').val(), $('#secondYearWise').val(), $('#firstMonthWise').val(), $('#secondMonthWise').val(), $('#firstDayWise').val(), $('#secondDayWise').val());
							});

							$('#secondDayWise').click(function() {
									daysWiseComparison($('#first_candidate').val(), $('#second_candidate').val(), $('#firstYearWise').val(), $('#secondYearWise').val(), $('#firstMonthWise').val(), $('#secondMonthWise').val(), $('#firstDayWise').val(), $('#secondDayWise').val());
							});
						}
					}
        });
				$("#polarityComparison").hide();
				$("#toggler").change(function() {
					if($(this).prop('checked')) {
						$("#polarityComparison").show();
						$("#comparison").hide();
					}
					else {
						$("#polarityComparison").hide();
						$("#comparison").show();
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
      #second_candidate {
        float: right;
        width: 51%;
      }
			.col-sm-3 {
				width: 22%;
			}
			#bottomhr {
				margin-top: 11px;
				margin-bottom: 11px;
			}
			#upperhr {
				margin-top: 11px;
				margin-bottom: 11px;
			}
			.toggle {
				float: right;
				margin-top: 25px;
				border-radius: 50px;
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
			.col-sm-1 {
				float: right;
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
												<li><a href="{{ url('/regression') }}"><i class="glyphicon glyphicon-hourglass"></i> Regression </a></li>
												<li class="active"><a href="{{ url('/comparator') }}"><i class="glyphicon glyphicon-stats"></i> Comparator </a></li>
												<li class="nav-divider"></li>
												<li><a href="{{ url('/plutchik') }}"><i class="glyphicon glyphicon-certificate"></i> Plutchik's Test </a></li>
		                    <li class="nav-divider"></li>
		                    <li><a href="{{ url('/logout') }}"><i class="glyphicon glyphicon-log-out"></i> Sign Out </a></li>
		                </ul>
		            </nav>
		        </div>
		        <div class="col-sm-10">
              <h5>Search Candidates for Comparison</h5>
              <form class="form-inline">
                <select class="form-control" id="first_candidate" name="candidate_user_id" style="width:47%">
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
                <hr id="upperhr">
								<div class="row">
    							<div class="col-sm-3">
										<label for="sel1">Select Comparator Distribution: &nbsp;</label>
										<br>
		                <select class="form-control" id="difference" name="distribution" style="width:129px">
		                  <option value="0">Year Wise</option>
											<option value="1">Month Wise</option>
											<option value="2">Day Wise</option>
		                </select>
									</div>
    							<div class="col-sm-3">
										<label for="sel1" id="year_name">Select Years for comparison: &nbsp;</label>
										<br>
										<select class="form-control" id="firstYearWise" style="width:80px">
										</select>
										<i class="glyphicon glyphicon-option-vertical" id="year_icon"></i>
										<select class="form-control" id="secondYearWise" style="width:80px">
										</select>
									</div>
    							<div class="col-sm-3">
										<label for="sel1" id="month_name">Select Months for comparison: &nbsp;</label>
										<br>
										<select class="form-control" id="firstMonthWise" style="width:80px">
										</select>
										<i class="glyphicon glyphicon-option-vertical" id="month_icon"></i>
										<select class="form-control" id="secondMonthWise" style="width:80px">
										</select>
									</div>
									<div class="col-sm-3">
										<label for="sel1" id="day_name">Select Days for comparison: &nbsp;</label>
										<br>
										<select class="form-control" id="firstDayWise" style="width:80px">
										</select>
										<i class="glyphicon glyphicon-option-vertical" id="day_icon"></i>
										<select class="form-control" id="secondDayWise" style="width:80px">
										</select>
									</div>
									<div class="col-sm-1">
										<input type="checkbox" data-toggle="toggle" data-on="Polarity" data-off="Emotion" id="toggler">
									</div>
								</div>
              </form>
							<hr id="bottomhr">
              <div id="comparison" style="width:100%; height:400px;"></div>
							<div id="polarityComparison" style="width:100%; height:400px;"></div>
		        </div>
    		</div>
		</div>
	</body>
</html>
