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
			h5, h4 {
				font-family: Quicksand;
				font-weight: bold;	
			}
			#begin_assessment {
				margin-left: 200px;
			}
			#log {
				margin-bottom: -15px;
				margin-left: 1025px;
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

		                    <li class="active"><a href="{{ url('/assessments') }}"><i class="glyphicon glyphicon-list-alt"></i> Assessments </a></li>

		                    <li><a href="{{ url('/profiles') }}"><i class="glyphicon glyphicon-user"></i> Profiles </a></li>
		                    
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
		        	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-plus"></i> Begin New Assessment</button>
		        	<h5 id='log'>Activity Log</h5>
		        	<hr>
		        </div>

		        <!-- Modal -->
				<div id="myModal" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        <h4 class="modal-title">Begin New Assessment</h4>
				      </div>
				      <div class="modal-body">
				      	<div class="form-group">
  						<label for="candidate_name">Select Candidates:</label>
  						<select class="form-control" id="candidate">
						   @foreach ($users as $user)
						   		 <option value="{{$user->id}}">{{ $user->full_name }} </option>
						   @endforeach
					  	</select>

					  	<br>

					  	<label for="assessment_name">Select Assessment Test:</label>
  						<select class="form-control" id="assessment">
						   	@foreach ($behaviours as $behaviour)
						   		 <option value="{{ $behaviour->id }}">{{ $behaviour->assessment_name }} </option>
						   @endforeach
					  	</select>

					  	<br>

					  	<button class="btn btn-primary" id="begin_assessment">Begin Assessment</button>

						</div>	
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				      </div>
				    </div>

				  </div>
				</div>

    		</div>
		</div>
	</body>
</html>