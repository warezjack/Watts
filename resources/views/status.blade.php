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
    
    	
		<link rel="stylesheet" type="text/css" href="css/sweetalert.css">

    	<!-- Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet" type="text/css">
		
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

			h5 {
				font-family: Quicksand;
			}

		</style>
	</head>
	<body>
		<div class="container" align="center">
			<h3>Watts</h3>
			<hr>
			<div class="progress">
    			<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemax="100" style="width:100%">
    			</div>
  			</div>
  			<h5>Please wait, while we download candidate's tweets</h5>
  			{{ print_r($processOutput) }}
		</div>		
	</body>
</html>
