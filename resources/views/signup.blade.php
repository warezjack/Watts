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

  		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  		<link rel="stylesheet" href="/resources/demos/style.css">

  		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


		<!-- Referencing Bootstrap JS that is hosted locally -->
    	{{ Html::script('js/bootstrap.min.js') }}

    	<!-- Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet" type="text/css">

		 <script type="text/javascript">
        	$(function() {
            	$("#datepicker").datepicker();
        	});
    	</script>

		<!-- Styles -->
		<style type="text/css">
			h3 {
				font-family: 'Pacifico';
				font-size: 45px;
			}

			h2 {
				text-align: center;
				color: #525252;
				font-family: 'Quicksand';
			}

			.radio-inline {
				margin-left: 10px;
			}

			#datepicker {
				 position: relative; 
				 z-index: 100000; 
			}

		</style>
	</head>
	<body>
		<div class="container-fluid">
			<h3 align="center">Watts</h3>
			<hr>
			<h2>Registration</h2>
			<hr>
			<div class="container" id="envelope">
			<form method="post" action="signup">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<label>Input code:</label> 
			<input type="text" class="form-control" id="code">
			<h6 class="text-info"><i>(Please input the code we sent to you in e-mail to continue)</i></h6>

			<label>Type of User:</label>
  			<label class="radio-inline"><input type="radio" name="type_of_user" value="1">Product Administrator</label>
  			<label class="radio-inline"><input type="radio" name="type_of_user" value="0">Employee</label> 
  			<hr>
  			<div class="panel panel-default">
  				<div class="panel-heading">Basic Information</div>
  				<div class="panel-body">
	  				
	  				<label>Full Name:</label>
		  			<input type="text" class="form-control" id="name" name="full_name">
		  			<h6 class="text-info"><i>(Please provide your full name)</i></h6>
	  				
	  				<label>Gender:</label>
  					<label class="radio-inline"><input type="radio" name="male" value="Male">Male</label>
  					<label class="radio-inline"><input type="radio" name="female" value="Female">Female</label>
  					<br>
  					
  					<label for="comment">Address:</label>
  					<textarea class="form-control" rows="2" id="comment" name="address"></textarea> 
  					<h6 class="text-info"><i>(Please provide your full address)</i></h6>
  					
  					<label for="sel1">Select State:</label>
  					<select class="form-control" id="sel1" name="state_name">
					    <option value="Maharashtra">Maharashtra</option>
					    <option value="Gujarat">Gujarat</option>
					    <option value="Tamil Nadu">Tamil Nadu</option>
					    <option value="Rajasthan">Rajasthan</option>
  					</select>
  					<br>
  					<label for="sel1">Select City:</label>
  					<select class="form-control" id="sel1" name="city_name">
					    <option value="Amravati">Amravati</option>
					    <option value="Pune">Pune</option>
					    <option value="Gandhi Nagar">Gandhi Nagar</option>
					    <option value="Jalna">Jalna</option>
  					</select>
  				</div>
			</div>
			<hr>
			<div class="panel panel-default">
				<div class="panel-heading">Authentication Detail</div>
				<div class="panel-body">
					<label for="email">Email address:</label>
    				<input type="email" class="form-control" id="email_addr" name="email">
    				<h6 class="text-info"><i>(Please remember this email as it will be use for log in)</i></h6>
    				<label for="pwd">Password:</label>
    				<input type="password" class="form-control" id="pwd" name="password">
    				<h6 class="text-info"><i>(Your password must be at least 8 characters long, consisting of at least one special character, one number and one upper case letter)</i></h6>
    				<label for="pwd">Confirm Password:</label>
    				<input type="password" class="form-control" id="cfm_pwd">
				</div>
			</div>
			<hr>
			<div class="panel panel-default">
				<div class="panel-heading">Social Media Details</div>
				<div class="panel-body">
					<label>Connect to facebook:</label>
					<input type="text" class="form-control" name="connect_to_fb">
					<h6 class="text-info"><i>(Example: http://www.facebook.com/warezjack)</i></h6>
					<label>Connect to twitter:</label>
					<input type="text" class="form-control" name="connect_to_twitter">
					<h6 class="text-info"><i>(Example: http://www.twitter.com/warezjack)</i></h6>
				</div>
			</div>
			<hr>
			<div class="panel panel-default">
				<div class="panel-heading">Organisation Details</div>
				<div class="panel-body">
					<label for="sel1">Select Organisation:</label>
  					<select class="form-control" id="sel1" name="org_name">
					    <option value="IBM">IBM</option>
					    <option value="Microsoft">Microsoft</option>
					    <option value="Google">Google</option>
					    <option value="Amazon">Amazon</option>
  					</select>
  					<br>
  					<label>Date of Joining:</label>
  					<input type="text" id="datepicker" class="form-control" name="date_of_joining">
				</div>
			</div>
			<hr>
			<div class="checkbox" align="center">
  				<label><input type="checkbox" value="">I agree to <a href="#">License Agreements </a> and <a href="#">Privacy Policy</a></label>
  				<br><br>
				<button type="submit" class="btn btn-primary" style="width: 100px">Register</button>
			</div>
		</div>
		</form>
		</div>
	</body>
</html>