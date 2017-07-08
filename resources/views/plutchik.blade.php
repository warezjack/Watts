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
		<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
		<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
		<link rel="shortcut icon" href="{{ asset('favicon.ico') }}" >


		<!-- Referencing Bootstrap JS that is hosted locally -->
    	{{ Html::script('js/bootstrap.min.js') }}

    	<!-- Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet" type="text/css">
		<link rel="stylesheet" type="text/css" href="css/sweetalert.css">

    <script>

    $(document).ready(function() {
      $("#candidate").click(function() {
        $('#year').empty();

        $.ajax({
					url: "/years",
					type: 'GET',
					data: {
						candidateId : $("#candidate").val()
					},
					success: function(data) {
						data = $.parseJSON(data)
						$.each(data, function(index, value) {
								$("#year").append('<option value="' + data[index].year + '">' + data[index].year + '</option>');
						});
					}
				});
      });

      $("#year").click(function() {
        $.ajax({
					url: "/dyads",
					type: 'GET',
					data: {
						candidateId : $("#candidate").val(),
            year: $("#year").val()
					},
					success: function(data) {
						data = $.parseJSON(data)
						console.log(data);
					}
				});
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
        width: 100%;
			}
			th {
			  border-bottom: 1px solid #364043;
			  font-size: 0.90em;
			  font-weight: bold;
			  padding: 0.5em 1em;
			  text-align: center;
			}
			td {
			  font-weight: 400;
			  padding: 0.65em 1em;
        text-align: center;
			}
      h5 {
        font-family: Quicksand;
        font-weight: bold;
      }
      #upperhr {
        margin-top: 15px;
        margin-bottom: 15px;
      }
      #bottomhr {
        margin-top: 15px;
        margin-bottom: 15px;
      }
      label {
				font-family: Quicksand;
			}
      .toggle {
				float: right;
				border-radius: 50px;
			}
      .btn-primary {
				background-color: #DC143C;
				border-color: #DC143C;
			}
			.btn-default.active {
				background-color: #008080;
				border-color: #008080;
				color: #fff;
			}
      #primary {
        background-color: #008B8B;
        color: white;
      }
      #secondary {
        background-color: #BA55D3;
        color: white;
      }
      #tertiary {
        background-color:	#FFA07A;
        color: white;
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
		                    <li><a href="javascript:;"><i class="glyphicon glyphicon-cog"></i> Settings </a></li>
												<li class="nav-divider"></li>
												<li><a href="{{ url('/queues') }}"><i class="glyphicon glyphicon-align-justify"></i> Queues </a></li>
												<li><a href="{{ url('/storage') }}"><i class="glyphicon glyphicon-th-large"></i> Storage Analyzer </a></li>
												<li><a href="{{ url('/regression') }}"><i class="glyphicon glyphicon-hourglass"></i> Regression </a></li>
												<li><a href="{{ url('/comparator') }}"><i class="glyphicon glyphicon-stats"></i> Comparator </a></li>
												<li class="nav-divider"></li>
												<li class="active"><a href="{{ url('/plutchik') }}"><i class="glyphicon glyphicon-certificate"></i> Plutchik's Test </a></li>
		                    <li class="nav-divider"></li>
		                    <li><a href="{{ url('/logout') }}"><i class="glyphicon glyphicon-log-out"></i> Sign Out </a></li>
		                </ul>
		            </nav>
		        </div>
		        <div class="col-sm-10">
              <form class="form-inline">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
		        		<h5>Search Candidates</h5>
								<select class="form-control" id="candidate" name="candidate_user_id" style="width:100%">
									@foreach ($users as $user)
										<option value="{{$user->id}}">{{ $user->full_name }} </option>
									@endforeach
								</select>
                <hr id="upperhr">
                <label for="sel1">Select Year: &nbsp;</label>
                <select class="form-control" id="year" name="years" style="width:140px">
                </select>
                <input type="checkbox" data-toggle="toggle" data-on="Intensity" data-off="Dyads" id="toggler">
                <hr id="bottomhr">
                <div id="dyads">
                  <table class="table">
                    <thead>
                      <tr>
                        <th id="primary">PRIMARY DYADS</th>
                        <th id="secondary">SECONDARY DYADS</th>
                        <th id="tertiary">TERTIARY DYADS</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Submission</td>
                        <td>Guilt</td>
                        <td>Delight</td>
                      </tr>
                      <tr>
                        <td>Alarm</td>
                        <td>Curiosity</td>
                        <td>Sentimentality</td>
                      </tr>
                      <tr>
                        <td>Disappointment</td>
                        <td>Despair</td>
                        <td>Shame</td>
                      </tr>
                      <tr>
                        <td>Remorse</td>
                        <td>Envy</td>
                        <td>Outrage</td>
                      </tr>
                      <tr>
                        <td>Contempt</td>
                        <td>Cynisim</td>
                        <td>Pessimisim</td>
                      </tr>
                      <tr>
                        <td>Aggression</td>
                        <td>Pride</td>
                        <td>Morbidness</td>
                      </tr>
                      <tr>
                        <td>Optimism</td>
                        <td>Fatalism</td>
                        <td>Dominance</td>
                      </tr>
                      <tr>
                        <td></td>
                        <td></td>
                        <td>Anxiety</td>
                      </tr>
                    </tbody>
                  </table>
                  <hr>
                </div>
              </form>
            </div>
		</div>
	</body>
</html>
