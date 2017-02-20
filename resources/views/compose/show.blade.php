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
			h5 {
				font-family: 'Quicksand';
				font-size: 16px;
			}

			#name {
				color: #428bca;
			}

			h4 {
				font-family: 'Quicksand';
				font-weight: bold;
			}
		</style>
	</head>
	<body>
		<div class="container-fluid">
			<h3 align="center">Watts</h3>
			<hr>
			 <div class="row">
		        <div class="col-sm-2">
		            <nav class="nav-sidebar">
		                <ul class="nav">
		                    <li><a href="{{ url('/index') }}"><i class="glyphicon glyphicon-modal-window"></i> Dashboard </a></li>
		                    <li class="active"><a href="{{ url('/index') }}"><i class="glyphicon glyphicon-edit"></i> Compose </a></li>
		                    <li><a href="{{ url('/services') }}"><i class="glyphicon glyphicon-record"></i> System Services </a></li>
		                    <li><a href="javascript:;"><i class="glyphicon glyphicon-tasks"></i> Candidates </a></li>
		                    <li><a href="javascript:;"><i class="glyphicon glyphicon-cog"></i> Settings </a></li>
		            
		                    <li class="nav-divider"></li>
		                    <li><a href="{{ url('/logout') }}"><i class="glyphicon glyphicon-log-out"></i> Sign Out </a></li>
		                </ul>
		            </nav>
		        </div>
		        <div class="col-sm-10">
		        	<h5>Now Showing</h5>
		        	<h3 id="name"> {{ $behaviour->assessment_name }} </h3>
		        	&nbsp;
		        	@if (!is_null($behaviour->emotion_id))
		        	<h5> Following are selected emotion types for assessment </h5>	
		        	<table class="table table-striped table-bordered table-hover">
		      			<thead>
     						<tr class="bg-success">
					         	<th>Fear</th>
					         	<th>Joy</th>
					         	<th>Love</th>
					         	<th>Disgust</th>
					         	<th>Sadness</th>
					         	<th>Surprise</th>
					         	<th>Anger</th>
     						</tr>
     					</thead>
     					<tbody>
     						<tr>
     							@if ( $emotionType->has_fear ) 
     							<td>Yes</td>
     							@else
     							<td>No</td>
     							@endif

     							@if ( $emotionType->has_joy ) 
     							<td>Yes</td>
     							@else
     							<td>No</td>
     							@endif
     							
     							@if ( $emotionType->has_love ) 
     							<td>Yes</td>
     							@else
     							<td>No</td>
     							@endif
     							
     							@if ( $emotionType->has_disgust ) 
     							<td>Yes</td>
     							@else
     							<td>No</td>
     							@endif
     							
     							@if ( $emotionType->has_sadness ) 
     							<td>Yes</td>
     							@else
     							<td>No</td>
     							@endif
     							
     							@if ( $emotionType->has_surprise ) 
     							<td>Yes</td>
     							@else
     							<td>No</td>
     							@endif
     							
     							@if ( $emotionType->has_anger ) 
     							<td>Yes</td>
     							@else
     							<td>No</td>
     							@endif
     						</tr>
     					</tbody>
     				</table>
     				@else
     					<div align="center"><h4>Attention: You do not have any assigned emotion types </h4></div>
     				@endif
     				<hr>
     				@if (!is_null($behaviour->category_id))
		        	<h5> Following are selected subject categories for assessment </h5>
		        	<table class="table table-striped table-bordered table-hover">
		      			<thead>
     						<tr class="bg-success">
					         	<th>Sports</th>
					         	<th>Medicine</th>
					         	<th>Computers</th>
					         	<th>Politics</th>
					         	<th>Religion</th>
					         	<th>Electronics</th>
					         	<th>Space</th>
					         	<th>Motorcycles and Automobiles</th>
     						</tr>
     					</thead>
     					<tbody>
     						<tr>
     							@if ( $categoryType->has_sports ) 
     							<td>Yes</td>
     							@else
     							<td>No</td>
     							@endif

     							@if ( $categoryType->has_medicine ) 
     							<td>Yes</td>
     							@else
     							<td>No</td>
     							@endif
     							
     							@if ( $categoryType->has_computers ) 
     							<td>Yes</td>
     							@else
     							<td>No</td>
     							@endif
     							
     							@if ( $categoryType->has_politics ) 
     							<td>Yes</td>
     							@else
     							<td>No</td>
     							@endif
     							
     							@if ( $categoryType->has_religion ) 
     							<td>Yes</td>
     							@else
     							<td>No</td>
     							@endif
     							
     							@if ( $categoryType->has_electronics ) 
     							<td>Yes</td>
     							@else
     							<td>No</td>
     							@endif
     							
     							@if ( $categoryType->has_space ) 
     							<td>Yes</td>
     							@else
     							<td>No</td>
     							@endif


     							@if ( $categoryType->has_motorcycles ) 
     							<td>Yes</td>
     							@else
     							<td>No</td>
     							@endif
     						</tr>
     					</tbody>
     				</table>
     				@else
     					<div align="center"><h4>Attention: You do not have any assigned subject categories</h4></div>
     				@endif
     				<button class="btn btn-primary" onclick="window.location='{{ url('compose') }}'">Back</button>
		    	</div>
    		</div>
		</div>
	</body>
</html>