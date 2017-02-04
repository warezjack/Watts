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
			.btn {
				float: right;
				margin-top: 15px;
				margin-left: 10px;
			}

			h3 {
				font-family: 'Pacifico';
				font-size: 45px;
			}

			h2 {
				text-align: center;
				color: #525252;
				font-family: 'Quicksand';
			}

		</style>
	</head>
	<body>
		<div class="container-fluid">
			<button type="button" class="btn btn-success" onclick="window.location='{{ url("/signup") }}'">Sign Up</button>
			<button type="button" class="btn btn-success" onclick="window.location='{{ url("/login") }}'">Log In</button>
			<h3>Watts</h3>
			<hr>
		</div>
		<h2>Introducing Behavioural Analytics</h2>		
	</body>
</html>
