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


  	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  	<link rel="shortcut icon" href="{{ asset('favicon.ico') }}" >

		<!-- Referencing Jquery Validation Plugin Scripts -->
		<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.js"></script>
		<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
		<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.js"></script>
		<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

		<!-- Referencing Bootstrap JS that is hosted locally -->
    {{ Html::script('js/bootstrap.min.js') }}

    <!-- Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet" type="text/css">

		<script type="text/javascript">
        	$(function() {
            	$("#datepicker").datepicker();
        	});
					$(document).ready(function(){

							//disabled register button initially
							$('#register').prop('disabled', true);

							//Jquery Validations
							var form = $("#registration");
							form.validate();

							$("#input_code").rules("add", {
  							required: true,
  							messages: {
    							required: '<h6 class="text-danger"><i>(Please input the code we sent to you in e-mail to continue)</i></h6>'
  							}
							});

							$("#name").rules("add", {
  							required: true,
  							messages: {
    							required: '<h6 class="text-danger"><i>(Please provide your full name)</i></h6>'
  							}
							});

							$("#comment").rules("add", {
  							required: true,
  							messages: {
    							required: '<h6 class="text-danger"><i>(Please provide your full address)</i></h6>'
  							}
							});

							$("#email_addr").rules("add", {
  							required: true,
								email: true,
  							messages: {
    							required: '<h6 class="text-danger"><i>(Please provide your email address)</i></h6>',
									email: '<h6 class="text-danger"><i>(Please provide valid email address)</i></h6>'
  							}
							});

							$('#pwd').rules("add", {
								minlength: 8,
								required: true,
								messages: {
									required: '<h6 class="text-danger"><i>(Please provide your password)</i></h6>',
									minlength: '<h6 class="text-danger"><i>(Your password must be at least 8 characters long, consisting of at least one special character, one number and one upper case letter)</i></h6>'
								}
							});

							$('#confirm_pwd').rules("add", {
								minlength: 8,
								equalTo: '#pwd',
								messages: {
									minlength: '<h6 class="text-danger"><i>(Your password must be at least 8 characters long, consisting of at least one special character, one number and one upper case letter)</i></h6>',
									equalTo: '<h6 class="text-danger"><i>(Passwords do not match)</i></h6>'
								}
							});

							$('#connect_fb').rules("add", {
									required: true,
									minlength:8,
									messages: {
										required: '<h6 class="text-danger"><i>(Example: http://www.facebook.com/warezjack)</i></h6>',
									}
							});

							$('#connect_twitter').rules("add", {
									required: true,
									minlength:8,
									messages: {
										required: '<h6 class="text-danger"><i>(Example: http://www.twitter.com/warezjack)</i></h6>',
									}
							});

							$('#product').click(function() {
								//disabled elements not needed by PA.
								$('#connect_fb').prop('disabled', true);
								$('#connect_twitter').prop('disabled', true);
								$('#input_code').prop('disabled', false);
								$('#pwd').prop('disabled', false);
								$('#confirm_pwd').prop('disabled', false);
							});

							$('#employee').click(function(){
								$('#connect_fb').prop('disabled', false);
								$('#connect_twitter').prop('disabled',false);
								$('#input_code').prop('disabled', true);
								$('#pwd').prop('disabled', false);
								$('#confirm_pwd').prop('disabled', false);
							});

							$('#candidate').click(function(){
								$('#connect_fb').prop('disabled', false);
								$('#connect_twitter').prop('disabled', false);
								$('#input_code').prop('disabled', true);
								$('#pwd').prop('disabled', true);
								$('#confirm_pwd').prop('disabled', true);
							});

							$('#agree').click(function(){
								$('#register').prop('disabled', false);
							});
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
			<div class="container" id="envelope">
			<form method="post" action="signup" id="registration">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<label>Type of User:</label>
			<label class="radio-inline"><input type="radio" name="type_of_user" value="1" id="product">Product Administrator</label>
			<label class="radio-inline"><input type="radio" name="type_of_user" value="0" id="employee">Employee</label>
			<label class="radio-inline"><input type="radio" name="type_of_user" value="2" id="candidate">Candidate</label><br><br>
			<label>Input code:</label>
			<input type="text" class="form-control" id="input_code">
  		<hr>
  		<div class="panel panel-default">
  			<div class="panel-heading">Basic Information</div>
  				<div class="panel-body">

	  				<label>Full Name:</label>
		  			<input type="text" class="form-control" id="name" name="full_name">
						<br>

	  				<label>Gender:</label>
  					<label class="radio-inline"><input type="radio" name="male" value="Male">Male</label>
  					<label class="radio-inline"><input type="radio" name="female" value="Female">Female</label>
  					<br>

  					<label for="comment">Address:</label>
  					<textarea class="form-control" rows="2" id="comment" name="address"></textarea>
						<br>

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
						<br>
    				<label for="pwd">Password:</label>
    				<input type="password" class="form-control" id="pwd" name="password">
    				<br>
    				<label for="pwd">Confirm Password:</label>
    				<input type="password" class="form-control" id="confirm_pwd">
				</div>
			</div>
			<hr>
			<div class="panel panel-default">
				<div class="panel-heading">Social Media Details</div>
				<div class="panel-body">
					<label>Connect to facebook:</label>
					<input type="text" class="form-control" name="connect_to_fb" id="connect_fb">
					<br>
					<label>Connect to twitter:</label>
					<input type="text" class="form-control" name="connect_to_twitter" id="connect_twitter">
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
						<h6 class="text-info"><i>(Please provide the name of organisation you want to apply for or currently working)</i></h6>
  					<br>
  					<label>Date of Joining / Registration Date:</label>
  					<input type="text" id="datepicker" class="form-control" name="date_of_joining">
				</div>
			</div>
			<hr>
			<div class="checkbox" align="center">
  				<label><input type="checkbox" value="" id="agree">I agree to <a href="#">License Agreements </a> and <a href="#">Privacy Policy</a></label>
  				<br><br>
				<button type="submit" class="btn btn-primary" style="width: 100px" id="register">Register</button>
			</div>
		</div>
		</form>
		</div>
	</body>
</html>
