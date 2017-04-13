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
			<h3 align="center">Watts</h3>
			<hr>
			 <div class="row">
		        <div class="col-sm-2">
		            <nav class="nav-sidebar">
		                <ul class="nav">
											<li><a href="{{ url('/index') }}"><i class="glyphicon glyphicon-modal-window"></i> Dashboard </a></li>
											<li><a href="{{ url('/assessments') }}"><i class="glyphicon glyphicon-list-alt"></i> Assessments </a></li>
											<li><a href="{{ url('/profiles') }}"><i class="glyphicon glyphicon-user"></i> Profiles </a></li>
											<li class="active"><a href="{{ url('/compose') }}"><i class="glyphicon glyphicon-edit"></i> Compose </a></li>
											<li><a href="{{ url('/candidates') }}"><i class="glyphicon glyphicon-tasks"></i> Candidates </a></li>
											<li><a href="{{ url('/services') }}"><i class="glyphicon glyphicon-record"></i> Infrastructure Services </a></li>
											<li><a href="javascript:;"><i class="glyphicon glyphicon-cog"></i> Settings </a></li>
											<li class="nav-divider"></li>
											<li><a href="{{ url('/logout') }}"><i class="glyphicon glyphicon-log-out"></i> Sign Out </a></li>
		                  <li class="nav-divider"></li>
		                  <li><a href="{{ url('/logout') }}"><i class="glyphicon glyphicon-log-out"></i> Sign Out </a></li>
		                </ul>
		            </nav>
		        </div>
		        <div class="col-sm-10">
		        	<h5>Now Editing</h5>

                    {{ Form::model($behaviour, array('route' => array('compose.update', $behaviour->id), 'method' => 'PUT')) }}

                    {{ Form::text('assessment_name', $behaviour->assessment_name, array('class' => 'form-control')) }}
                    &nbsp;

		        	<h5> Following are selected emotion types for assessment </h5>
		        	<table class="table table-striped table-bordered table-hover">
		      			<thead>
									<tr>
										<th> Emotion </th>
										<th> Value </th>
									</tr>
     						</thead>
     					<tbody>
								<tr>
									<td>Fear</td>
									@if ( isset($emotionType->has_fear) )
                  	@if ($emotionType->has_fear)
                    	<td>{{ Form::checkbox('has_fear', 1, true) }}</td>
                    @else
                      <td> {{ Form::checkbox('has_fear', 1, false) }} </td>
                	@endif
     							@else
     								<td> {{ Form::checkbox('has_fear', 1, false) }} </td>
     							@endif
								</tr>
								<tr>
									<td>Love</td>
									@if ( isset($emotionType->has_love) )
                  	@if ($emotionType->has_love)
                  		<td>{{ Form::checkbox('has_love', 1, true) }}</td>
                    @else
                      <td> {{ Form::checkbox('has_love', 1, false) }} </td>
                  @endif
                  @else
                      <td> {{ Form::checkbox('has_love', 1, false) }} </td>
                  @endif
								</tr>
								<tr>
									<td>Disgust</td>
									@if ( isset($emotionType->has_disgust) )
                  	@if ($emotionType->has_disgust)
                    	<td>{{ Form::checkbox('has_disgust', 1, true) }}</td>
                    @else
                      <td> {{ Form::checkbox('has_disgust', 1, false) }} </td>
                  @endif
                  @else
                      <td> {{ Form::checkbox('has_disgust', 1, false) }} </td>
                  @endif
								</tr>
								<tr>
									<td>Sadness</td>
									@if ( isset($emotionType->has_sadness) )
                		@if ($emotionType->has_sadness)
                      <td>{{ Form::checkbox('has_sadness', 1, true) }}</td>
                    @else
                      <td> {{ Form::checkbox('has_sadness', 1, false) }} </td>
                  	@endif
                  @else
                    	<td> {{ Form::checkbox('has_sadness', 1, false) }} </td>
                  @endif
								</tr>
								<tr>
									<td>Surprise</td>
									@if ( isset($emotionType->has_surprise) )
                  	@if ($emotionType->has_surprise)
                    	<td>{{ Form::checkbox('has_surprise', 1, true) }}</td>
                    @else
                      <td> {{ Form::checkbox('has_surprise', 1, false) }} </td>
                    @endif
                  @else
                  	<td> {{ Form::checkbox('has_surprise', 1, false) }} </td>
                  @endif
								</tr>
								<tr>
									<td>Anger</td>
									@if ( isset($emotionType->has_anger) )
                  	@if ($emotionType->has_anger)
                    	<td>{{ Form::checkbox('has_anger', 1, true) }}</td>
                    @else
                      <td> {{ Form::checkbox('has_anger', 1, false) }} </td>
                  @endif
                  @else
                    	<td> {{ Form::checkbox('has_anger', 1, false) }} </td>
                  @endif
								</tr>
								<tr>
									<td>Joy</td>
									@if ( isset($emotionType->has_joy) )
                  	@if ($emotionType->has_joy)
                    	<td>{{ Form::checkbox('has_joy', 1, true) }}</td>
                    @else
                      <td> {{ Form::checkbox('has_joy', 1, false) }} </td>
                  	@endif
                  @else
                      <td> {{ Form::checkbox('has_joy', 1, false) }} </td>
                	@endif
								</tr>
							</tbody>
     				</table>
     				<hr>
		        	<h5> Following are selected subject categories for assessment </h5>
		        	<table class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th> Subject </th>
										<th width="450px"> Value </th>
									</tr>
     						</thead>
								<tbody>
	     						<tr>
						      	<td>Sports</td>
										@if ( isset($categoryType->has_sports) )
												 @if ($categoryType->has_sports)
															<td>{{ Form::checkbox('has_sports', 1, true) }}</td>
												 @else
															<td> {{ Form::checkbox('has_sports', 1, false) }} </td>
												 @endif
										@else
										<td> {{ Form::checkbox('has_sports', 1, false) }} </td>
										@endif
									</tr>
									<tr>
										<td>Medicine</td>
										@if ( isset($categoryType->has_medicine) )
												 @if ($categoryType->has_medicine)
															<td>{{ Form::checkbox('has_medicine', 1, true) }}</td>
												 @else
															<td> {{ Form::checkbox('has_medicine', 1, false) }} </td>
												 @endif
										@else
										<td> {{ Form::checkbox('has_medicine', 1, false) }} </td>
										@endif
									</tr>
									<tr>
						        <td>Computers</td>
										@if ( isset($categoryType->has_computers) )
												 @if ($categoryType->has_computers)
															<td>{{ Form::checkbox('has_computers', 1, true) }}</td>
												 @else
															<td> {{ Form::checkbox('has_computers', 1, false) }} </td>
												 @endif
										@else
										<td> {{ Form::checkbox('has_computers', 1, false) }} </td>
										@endif
									</tr>
									<tr>
						        <td>Politics</td>
										@if ( isset($categoryType->has_politics) )
												 @if ($categoryType->has_politics)
															<td>{{ Form::checkbox('has_politics', 1, true) }}</td>
												 @else
															<td> {{ Form::checkbox('has_politics', 1, false) }} </td>
												 @endif
										@else
										<td> {{ Form::checkbox('has_politics', 1, false) }} </td>
										@endif
									</tr>
									<tr>
						        <td>Religion</td>
										@if ( isset($categoryType->has_religion) )
												 @if ($categoryType->has_religion)
															<td>{{ Form::checkbox('has_religion', 1, true) }}</td>
												 @else
															<td> {{ Form::checkbox('has_religion', 1, false) }} </td>
												 @endif
										@else
										<td> {{ Form::checkbox('has_religion', 1, false) }} </td>
										@endif
									</tr>
									<tr>
						        <td>Electronics</td>
										@if ( isset($categoryType->has_electronics) )
												 @if ($categoryType->has_electronics)
															<td>{{ Form::checkbox('has_electronics', 1, true) }}</td>
												 @else
															<td> {{ Form::checkbox('has_electronics', 1, false) }} </td>
												 @endif
										@else
										<td> {{ Form::checkbox('has_electronics', 1, false) }} </td>
										@endif
									</tr>
									<tr>
						      	<td>Space</td>
										@if ( isset($categoryType->has_space) )
												 @if ($categoryType->has_space)
															<td>{{ Form::checkbox('has_space', 1, true) }}</td>
												 @else
															<td> {{ Form::checkbox('has_space', 1, false) }} </td>
												 @endif
										@else
										<td> {{ Form::checkbox('has_space', 1, false) }} </td>
										@endif
									</tr>
									<tr>
						         	<td>Motorcycles and Automobiles</td>
											@if ( isset($categoryType->has_motorcycles) )
													 @if ($categoryType->has_motorcycles)
																<td>{{ Form::checkbox('has_motorcycles', 1, true) }}</td>
													 @else
																<td> {{ Form::checkbox('has_motorcycles', 1, false) }} </td>
													 @endif
											@else
											<td> {{ Form::checkbox('has_motorcycles', 1, false) }} </td>
											@endif
	     						</tr>
     						</tbody>
     				</table>
            	<div align="center">
								{{ Form::submit('Edit Assessment', array('class' => 'btn btn-primary')) }}
            		{{ Form::close() }}
								<br>
								<br>
								<button class="btn btn-primary" onclick="window.location='{{ url('compose') }}'">Back</button>
						</div>
		    	</div>
    		</div>
		</div>
	</body>
</html>
