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
			h5{
				font-family: Quicksand;
				font-weight: bold;
			}
			label {
				font-family: Quicksand;
			}
      table {
			  border-radius: 0.25em;
			  border-collapse: collapse;
			  font-family: Quicksand;
			}
			th {
			  border-bottom: 1px solid #364043;
			  font-size: 0.90em;
			  font-weight: bold;
			  padding: 0.5em 1em;
			  text-align: left;
			}
			td {
			  font-weight: 400;
			  padding: 0.65em 1em;
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
												<li class="active"><a href="{{ url('/storage') }}"><i class="glyphicon glyphicon-th-large"></i> Storage Analyzer </a></li>
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
              <table>
                <thead>
                  <th>Name of candidate</th>
                  <th>Type</th>
                  <th>Email Address</th>
                  <th>Twitter Status</th>
                  <th>Assessment Status</th>
                  <th>Name of the Assessment</th>
                  <th colspan="2">Actions</th>
                </thead>
                <tbody>
                  @foreach ($usersDownloadedData as $user)
                    <tr>
                      <td> {{ $user->full_name }} </td>

                      @if ($user->is_admin == '0')
    		        				<td><b> Internal </b></td>
    		        			@elseif($user->is_admin == '2')
    		        				<td><b> External </b></td>
    		        			@endif

                      <td> {{ $user->email }} </td>
                      <td><i class="glyphicon glyphicon-ok"><i></td>
                      @if (isset($user->is_completed))
      		        	    <td><i class="glyphicon glyphicon-ok"><i></td>
      		            @else
      		        			<td><i class="glyphicon glyphicon-remove"><i></td>
      		        		@endif

                      @if (isset($user->assessment_name))
      		        	    <td><b>{{ $user->assessment_name }}</b></td>
      		            @else
      		        			<td><b>Not Yet Assessed</b></td>
      		        		@endif

											@if(isset($user->is_downloaded))
	                      <td>
	         								{{ Form::open(array('url' => '/deleteCSV/' . $user->twitterId)) }}
	                        {{ Form::hidden('_method', 'DELETE') }}
	                        {{ Form::submit('Delete Data', array('class' => 'btn btn-danger')) }}
	                    		{{ Form::close() }}
	         							</td>
											@else
												<td><i class="glyphicon glyphicon-remove"><i></td>
											@endif

                      @if (isset($user->assessment_name))
                        <td>
                          {{ Form::open(array('url' => '/deleteRecords/' . $user->id )) }}
                          {{ Form::hidden('_method', 'DELETE') }}
                          {{ Form::submit('Delete Records', array('class' => 'btn btn-danger')) }}
                      		{{ Form::close() }}
                        </td>
                      @else
                        <td><b>Not Yet Assessed</b></td>
                      @endif

                    </tr>
                  @endforeach
                </tbody>
              </table>
							<h5 class="text-danger"><i>(Caution: Deleting Data, removes only CSV file from storage but keeps records. Deleting records, removes candidate details and assessment records.)</i></h5>
            </div>
    		</div>
		</div>
	</body>
</html>
