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

    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.js"></script>
		<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
		<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.js"></script>
		<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
		<link rel="shortcut icon" href="{{ asset('favicon.ico') }}" >


		<!-- Referencing Bootstrap JS that is hosted locally -->
    	{{ Html::script('js/bootstrap.min.js') }}

    	<!-- Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet" type="text/css">
		<link rel="stylesheet" type="text/css" href="css/sweetalert.css">

    <script type="text/javascript">
      $(document).ready(function() {
        var form = $("#authentication");
        form.validate();

        $('#host_name').rules("add", {
          required: true,
          messages: {
            required: '<h6 class="text-danger"><i>(Please provide Kerberos Host Name)</i></h6>'
          }
        });

        $('#realm_name').rules("add", {
          required: true,
          messages: {
            required: '<h6 class="text-danger"><i>(Please provide Kerberos Realm Name)</i></h6>'
          }
        });

        $('#pwd').rules("add", {
          required: true,
          messages: {
            required: '<h6 class="text-danger"><i>(Please provide Password for Kerberos Host@Realm)</i></h6>'
          }
        });

        $('#confirm_pwd').rules("add", {
          required: true,
          equalTo: '#pwd',
          messages: {
            required: '<h6 class="text-danger"><i>(Please provide your password)</i></h6>',
            equalTo: '<h6 class="text-danger"><i>(Passwords do not match)</i></h6>'
          }
        });

      });
    </script>

		<!-- Styles -->
		<style type="text/css">
			h3 {
				font-family: 'Pacifico';
				font-size: 30px;
			}
			.nav-sidebar {
    			width: 100%;
					margin-top: -20px;
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
      h5, h4 {
				font-family: Quicksand;
				font-weight: bold;
			}
      #auth_button {
				background-color: #DC143C;
				border-color: #DC143C;
        margin-left: 200px;
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
		                    <li><a href="{{ url('/assessments') }}"><i class="glyphicon glyphicon-list-alt"></i> Assessments </a></li>
		                    <li><a href="{{ url('/profiles') }}"><i class="glyphicon glyphicon-signal"></i> Profiles </a></li>
		                    <li><a href="{{ url('/compose') }}"><i class="glyphicon glyphicon-edit"></i> Compose </a></li>
		                    <li><a href="{{ url('/candidates') }}"><i class="glyphicon glyphicon-tasks"></i> Candidates </a></li>
		                    <li><a href="{{ url('/services') }}"><i class="glyphicon glyphicon-record"></i> Infrastructure Services </a></li>
		                    <li class="active"><a href="{{ url('/settings') }}"><i class="glyphicon glyphicon-cog"></i> Settings </a></li>
												<li class="nav-divider"></li>
												<li><a href="{{ url('/queues') }}"><i class="glyphicon glyphicon-align-justify"></i> Queues </a></li>
												<li><a href="{{ url('/storage') }}"><i class="glyphicon glyphicon-th-large"></i> Storage Analyzer </a></li>
												<li><a href="{{ url('/regression') }}"><i class="glyphicon glyphicon-hourglass"></i> Regression </a></li>
												<li><a href="{{ url('/comparator') }}"><i class="glyphicon glyphicon-stats"></i> Comparator </a></li>
												<li class="nav-divider"></li>
												<li><a href="{{ url('/plutchik') }}"><i class="glyphicon glyphicon-certificate"></i> Plutchik's Test </a></li>
												<li class="nav-divider"></li>
		                    <li><a href="{{ url('/logout') }}"><i class="glyphicon glyphicon-log-out"></i> Sign Out </a></li>
		                </ul>
		            </nav>
		        </div>
		        <div class="col-sm-10">
              <h4 align="center" style="padding-right:220px;">Authentication for Kerberos</h4>
              <hr>
              <div class="row">
                <div class="col-sm-7">
                  <form method="post" action="authenticate" id="authentication">
    								<input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                      <h5>Host Name: </h5>
                      <input type="text" class="form-control" id="host_name" name="host" style="width:500px;">
                      <h5>Realm Name: </h5>
                      <input type="text" class="form-control" id="realm_name" name="realm" style="width:500px;">
                      <h5>Password: </h5>
                      <input type="password" class="form-control" id="pwd" name="password" style="width:500px;">
                      <h5>Confirm Password: </h5>
                      <input type="password" class="form-control" id="confirm_pwd" style="width:500px;">
                      <br><br>
                      <button type="submit" class="btn btn-primary" id="auth_button">Authenticate</button>
                    </div>
                  </form>
                </div>
                <div class="col-sm-3">
                  @if (isset($userAuthenticated))
                  <div class="alert alert-success" style="margin-top:90px;margin-left:20px;">
                    <strong>Authenticated!</strong><br>You can now download candidate's tweets and profile candidates.
                  </div>
                  @else
                  <div class="alert alert-danger" style="margin-top:90px;margin-left:20px;">
                    <strong>Not Yet Authenticated!</strong><br>Please authenticate yourself with correct credentials.
                  </div>
                  @endif
                </div>
		        </div>
    		</div>
		</div>
	</body>
</html>
