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

		<!-- Styles -->
		<style type="text/css">
			h3 {
				font-family: 'Pacifico';
				font-size: 60px;
			}

			.input-group {
				margin-top: 20px;
				margin-bottom: 20px;
				margin-left: 20px;
				margin-right: 20px;
			}

			.btn {
				margin-bottom: 20px;
				width: 350px;
			}

			.container {
				margin-top: 140px;
			}

			.col-sm-4 {
				margin-left: 390px;
			}

			hr {
				width: 180px;
			}

		</style>
	</head>
	<body>
		<div class="container" align="center">
			<h3>Watts</h3>
			<hr>
			<div class="col-sm-4">
				<div class="panel panel-default">
	  				<div class="input-group">
		    			<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
		    			<input id="email" type="text" class="form-control" name="email" placeholder="Email">
	  				</div>
		  			<div class="input-group">
		    			<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
		    			<input id="password" type="password" class="form-control" name="password" placeholder="Password">
		  			</div>
				</div>
				<button type="button" class="btn btn-primary">Log In</button>
			</div>
		</div>		
	</body>
</html>
