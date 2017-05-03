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
		<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
		<link rel="shortcut icon" href="{{ asset('favicon.ico') }}" >

		<!-- Referencing Bootstrap JS that is hosted locally -->
    	{{ Html::script('js/bootstrap.min.js') }}

    	<!-- Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet" type="text/css">

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
			.panel {
				margin-right: 16px;
			}
			.label{
				font-size: 100%;
				float: right;
			}
			#recent {
				margin-bottom: -15px;
				margin-left: 880px;
				font-family: Quicksand;
				font-weight: bold;
			}
			h5 {
				font-family: Quicksand;
				font-weight: bold;
			}
			.checkbox {
				font-family: Quicksand;
			}
			#create_assessment {
				margin-left: 200px;
			}

			table {
				border-radius: 0.25em;
				border-collapse: collapse;
				font-family: Quicksand;
				width: 100%;
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
				            timer: 5500,
				            showConfirmButton: false
				        });
				@endif
			</script>


			<h3 align="center">Watts</h3>
			<!-- Modal -->
  			<div class="modal fade" id="myModal" role="dialog">
		   		<div class="modal-dialog">
		      	<!-- Modal content-->
		      		<div class="modal-content">
		        		<div class="modal-header">
		          			<button type="button" class="close" data-dismiss="modal">&times;</button>
		          			<h4 class="modal-title" style="font-family: Quicksand; font-weight: bold;">Create New Assessment</h4>
		        		</div>
		        		<div class="modal-body">
		          			<!-- Modal Body, Add Form Here -->
		          			<form method="post" action="add">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
		          			<h5>Name of the Assessment</h5>
		          			<input type="text" name="assessment_name" class="form-control">
		          			<hr>
		          			<div class="row">
		          				<div class="col-sm-6">
				          			<h5>Select Categories</h5>
				          			<div class="checkbox">
									 	<label><input type="checkbox" value="Sports" name="category[]">Sports</label>
									</div>
									<div class="checkbox">
									 	<label><input type="checkbox" value="Medicine" name="category[]">Medicine</label>
									</div>
									<div class="checkbox">
									 	<label><input type="checkbox" value="Computers" name="category[]">Computers</label>
									</div>
									<div class="checkbox">
									 	<label><input type="checkbox" value="Politics" name="category[]">Politics</label>
									</div>
									<div class="checkbox">
									 	<label><input type="checkbox" value="Religion" name="category[]">Religion</label>
									</div>
									<div class="checkbox">
									 	<label><input type="checkbox" value="Electronics" name="category[]">Electronics</label>
									</div>
									<div class="checkbox">
									 	<label><input type="checkbox" value="Space" name="category[]">Space</label>
									</div>
									<div class="checkbox">
									 	<label><input type="checkbox" value="Motorcycles" name="category[]">Motorcycles and Automobiles</label>
									</div>
		          				</div>
		          				<div class="col-sm-6">
				          			<h5>Select Emotion Categories</h5>
				          			<div class="checkbox">
									 	<label><input type="checkbox" value="Fear" name="emotion[]">Fear</label>
									</div>
									<div class="checkbox">
									 	<label><input type="checkbox" value="Joy" name="emotion[]">Joy</label>
									</div>
									<div class="checkbox">
									 	<label><input type="checkbox" value="Love" name="emotion[]">Love</label>
									</div>
									<div class="checkbox">
									 	<label><input type="checkbox" value="Disgust" name="emotion[]">Digust</label>
									</div>
									<div class="checkbox">
									 	<label><input type="checkbox" value="Sadness" name="emotion[]">Sadness</label>
									</div>
									<div class="checkbox">
									 	<label><input type="checkbox" value="Surprise" name="emotion[]">Surprise</label>
									</div>
									<div class="checkbox">
									 	<label><input type="checkbox" value="Anger" name="emotion[]">Anger</label>
									</div>
								</div>
							</div>
							<br>
		          			<button class="btn btn-primary" id="create_assessment" type="submit">Create Assessment</button>
		          			</form>
		        		</div>
		        		<div class="modal-footer">
		          			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        		</div>
		      		</div>
		   		</div>
		  	</div>
			<hr>
			 <div class="row">
		        <div class="col-sm-2">
		            <nav class="nav-sidebar">
		                <ul class="nav">
		                    <li><a href="{{ url('/index') }}"><i class="glyphicon glyphicon-modal-window"></i> Dashboard </a></li>
		                    <li><a href="{{ url('/assessments') }}"><i class="glyphicon glyphicon-list-alt"></i> Assessments </a></li>
		                    <li><a href="{{ url('/profiles') }}"><i class="glyphicon glyphicon-user"></i> Profiles </a></li>
		                    <li class="active"><a href="{{ url('/index') }}"><i class="glyphicon glyphicon-edit"></i> Compose </a></li>
		                    <li><a href="{{ url('/candidates') }}"><i class="glyphicon glyphicon-tasks"></i> Candidates </a></li>
		                    <li><a href="{{ url('/services') }}"><i class="glyphicon glyphicon-record"></i> Infrastructure Services </a></li>
		                    <li><a href="javascript:;"><i class="glyphicon glyphicon-cog"></i> Settings </a></li>
												<li class="nav-divider"></li>
												<li><a href="{{ url('/storage') }}"><i class="glyphicon glyphicon-th-large"></i> Storage Analyzer </a></li>
												<li><a href="{{ url('/regression') }}"><i class="glyphicon glyphicon-hourglass"></i> Regression </a></li>
												<li><a href="{{ url('/comparator') }}"><i class="glyphicon glyphicon-stats"></i> Comparator </a></li>
		                    <li class="nav-divider"></li>
		                    <li><a href="{{ url('/logout') }}"><i class="glyphicon glyphicon-log-out"></i> Sign Out </a></li>
		                </ul>
		            </nav>
		        </div>
		        <div class="col-sm-10">
		        	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-plus"></i> Create New</button>
		        	<h5 id='recent'>Your Behavioural Assessment Tests</h5>
		        	<hr>
		      		<table>
		      			<thead>
     						<tr>
					        	<th> Sr. No</th>
					         	<th> Name of Assessment</th>
										<th> Date Of Creation </th>
										<th> Date of Updation </th>
					         	<th> Emotion Types</th>
					         	<th> Subject Categories</th>
					         	<th colspan="3">Actions</th>
     						</tr>
     					</thead>
     					<tbody>

     					@foreach ($behaviours as $behaviour)
     						<tr>
     							<td> {{ $behaviour->id }} </td>
     							<td><b> {{ $behaviour->assessment_name }} </b></td>
									<td> {{ $behaviour->created_at }} </td>
									<td> {{ $behaviour->updated_at }} </td>
     							@if (is_null( $behaviour->emotion_id ))
     							<td><b> No </b></td>
     							@else
     							<td><b> Yes </b></td>
     							@endif

     							@if (is_null( $behaviour->category_id ))
     							<td><b> No </b></td>
     							@else
     							<td><b> Yes </b></td>
     							@endif

     							<td><a href="{{ route('compose.show', $behaviour->id)}}"><i class="btn btn-primary  glyphicon glyphicon-play-circle"></i></a></td>
     							<td><a href="{{ route('compose.edit', $behaviour->id)}}"><i class="btn btn-primary glyphicon glyphicon-pencil"></i></a></td>
     							<td>

     								{{ Form::open(array('url' => '/compose/' . $behaviour->id )) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                		{{ Form::close() }}

     							</td>
     						</tr>
     					@endforeach
     					</tbody>
		      		</table>
		    	</div>
    		</div>
		</div>
	</body>
</html>
