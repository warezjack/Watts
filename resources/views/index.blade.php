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
		</style>
	</head>
	<body>
		<div class="container-fluid">	
			<h3 align="center">Watts</h3>
			<h4>{{ Auth::user()->email }}</h4>
			<hr>
			 <div class="row">
		        <div class="col-sm-2">
		            <nav class="nav-sidebar">
		                <ul class="nav">
		                    <li class="active"><a href="javascript:;">Dashboard</a></li>
		                    <li><a href="signup">System Services</a></li>
		                    <li><a href="javascript:;">Candidates</a></li>
		                    <li><a href="javascript:;">Settings</a></li>
		                    <li class="nav-divider"></li>
		                    <li><a href="{{ url('/logout') }}"><i class="glyphicon glyphicon-off"></i> Sign Out </a></li>
		                </ul>
		            </nav>
		        </div>
    		</div>
		</div>
	</body>
</html>