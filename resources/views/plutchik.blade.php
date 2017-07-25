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

      function resetEmotions() {
        $("#anger").css("background-color", "white");
        $("#anger").css("color", "black");

        $("#disgust").css("background-color", "white");
        $("#disgust").css("color", "black");

        $("#fear").css("background-color", "white");
        $("#fear").css("color", "black");

        $("#joy").css("background-color", "white");
        $("#joy").css("color", "black");

        $("#surprise").css("background-color", "white");
        $("#surprise").css("color", "black");

        $("#sadness").css("background-color", "white");
        $("#sadness").css("color", "black");

        $("#trust").css("background-color", "white");
        $("#trust").css("color", "black");

        $("#anticipation").css("background-color", "white");
        $("#anticipation").css("color", "black");

        $("#submission").css("background-color", "white");
        $("#submission").css("color", "black");

        $("#alarm").css("background-color", "white");
        $("#alarm").css("color", "black");

        $("#disappointment").css("background-color", "white");
        $("#disappointment").css("color", "black");

        $("#remorse").css("background-color", "white");
        $("#remorse").css("color", "black");

        $("#contempt").css("background-color", "white");
        $("#contempt").css("color", "black");

        $("#aggression").css("background-color", "white");
        $("#aggression").css("color", "black");

        $("#optimism").css("background-color", "white");
        $("#optimism").css("color", "black");

        $("#guilt").css("background-color", "white");
        $("#guilt").css("color", "black");

        $("#curiosity").css("background-color", "white");
        $("#curiosity").css("color", "black");

        $("#despair").css("background-color", "white");
        $("#despair").css("color", "black");

        $("#envy").css("background-color", "white");
        $("#envy").css("color", "black");

        $("#cynisim").css("background-color", "white");
        $("#cynisim").css("color", "black");

        $("#pride").css("background-color", "white");
        $("#pride").css("color", "black");

        $("#fatalism").css("background-color", "white");
        $("#fatalism").css("color", "black");

        $("#delight").css("background-color", "white");
        $("#delight").css("color", "black");

        $("#sentimentality").css("background-color", "white");
        $("#sentimentality").css("color", "black");

        $("#shame").css("background-color", "white");
        $("#shame").css("color", "black");

        $("#outrage").css("background-color", "white");
        $("#outrage").css("color", "black");

        $("#pessimism").css("background-color", "white");
        $("#pessimism").css("color", "black");

        $("#morbidness").css("background-color", "white");
        $("#morbidness").css("color", "black");

        $("#dominance").css("background-color", "white");
        $("#dominance").css("color", "black");

        $("#anxiety").css("background-color", "white");
        $("#anxiety").css("color", "black");
      }

      function changeEmotionColor(emotionValue, backgroundColor, emotionId) {
        if(emotionValue) {
          $(emotionId).css("background-color", backgroundColor);
          $(emotionId).css("color", "white");
        }
      }

			function setIntensityLevel(value, emotion, lowIntensity, mediumIntensity, highIntensity, tagName, highName, mediumName, lowName) {
				$(emotion).css("width", value + '%');
				if(value <= 20) {
					$(emotion).css("background-color", lowIntensity);
					$(tagName).text(lowName);
				}
				else if(value >= 90) {
					$(emotion).css("background-color", highIntensity);
					$(tagName).text(highName);
				}
				else {
					$(emotion).css("background-color", mediumIntensity);
					$(tagName).text(mediumName);
				}
			}

      $("#year").click(function() {
				resetEmotions();
        $.ajax({
					url: "/dyads",
					type: 'GET',
					data: {
						candidateId : $("#candidate").val(),
            year: $("#year").val()
					},
					success: function(data) {
						data = $.parseJSON(data);

            //For Primary Emotions
            changeEmotionColor(data[0][0], "#DC143C", "#anger");
            changeEmotionColor(data[0][1], "#DC143C", "#disgust");
            changeEmotionColor(data[0][2], "#DC143C", "#fear");
            changeEmotionColor(data[0][3], "#FF4500", "#joy");
            changeEmotionColor(data[0][4], "#DC143C", "#sadness");
            changeEmotionColor(data[0][5], "#FF4500", "#surprise");
            changeEmotionColor(data[0][6], "#FF4500", "#trust");
            changeEmotionColor(data[0][7], "#FF4500", "#anticipation");

            //primary dyads
            changeEmotionColor(data[1][0], "#FF4500", "#submission");
            changeEmotionColor(data[1][1], "#DC143C", "#alarm");
            changeEmotionColor(data[1][2], "#DC143C", "#disappointment");
            changeEmotionColor(data[1][3], "#FF4500", "#remorse");
            changeEmotionColor(data[1][4], "#DC143C", "#contempt");
            changeEmotionColor(data[1][5], "#DC143C", "#aggression");
            changeEmotionColor(data[1][6], "#FF4500", "#optimism");
            changeEmotionColor(data[1][7], "#FF4500", "#anticipation");

            //secondary dyads
            changeEmotionColor(data[2][0], "#FF4500", "#guilt");
            changeEmotionColor(data[2][1], "#FF4500", "#curiosity");
            changeEmotionColor(data[2][2], "#DC143C", "#despair");
            changeEmotionColor(data[2][3], "#FF4500", "#envy");
            changeEmotionColor(data[2][4], "#DC143C", "#cynisim");
            changeEmotionColor(data[2][5], "#DC143C", "#pride");
            changeEmotionColor(data[2][6], "#DC143C", "#fatalism");

            //secondary dyads
            changeEmotionColor(data[3][0], "#FF4500", "#delight");
            changeEmotionColor(data[3][1], "#FF4500", "#sentimentality");
            changeEmotionColor(data[3][2], "#DC143C", "#shame");
            changeEmotionColor(data[3][3], "#DC143C", "#outrage");
            changeEmotionColor(data[3][4], "#DC143C", "#pessimism");
            changeEmotionColor(data[3][5], "#DC143C", "#morbidness");
            changeEmotionColor(data[3][6], "#FF4500", "#dominance");
            changeEmotionColor(data[3][6], "#DC143C", "#anxiety");

						//Set intensityLevels
						setIntensityLevel(data[4][0], ".angerWidth", "PaleVioletRed", "IndianRed", "#DC143C", "#angerName", "Rage", "Anger", "Annoyance");
						setIntensityLevel(data[4][1], ".disgustWidth", "#DDA0DD", "Orchid", "#800080", "#disgustName", "Loathing", "Disgust", "Boredom");
						setIntensityLevel(data[4][2], ".fearWidth", "#00FA9A", "#3CB371", "#32CD32", "#fearName", "Terror", "Fear", "Apprehension");
						setIntensityLevel(data[4][3], ".joyWidth", "#CD853F", "#FFA500", "#FF4500", "#joyName", "Ecstacy", "Joy", "Serenity");
						setIntensityLevel(data[4][4], ".sadnessWidth", "#87CEFA", "#7B68EE", "#000080", "#sadnessName", "Grief", "Sadness", "Pensiveness");
						setIntensityLevel(data[4][5], ".surpriseWidth", "#ADD8E6", "#20B2AA", "#1E90FF", "#surpriseName", "Amazement", "Surprise", "Distraction");
					}
				});
      });
			$("#intensityLevels").hide();
			$("#toggler").change(function() {
				if($(this).prop('checked')) {
					$("#intensityLevels").show();
					$("#dyads").hide();
				}
				else {
					$("#intensityLevels").hide();
					$("#dyads").show();
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
			  border-collapse: separate;
			  font-family: Quicksand;
        border-spacing: 2px;
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
        margin-top: 10px;
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
      #emotions {
        background-color: #2E8B57;
        color: white;
      }
			* {box-sizing: border-box}
			.container {
  			width: 100%;
  			background-color: white;
			}
			.skills {
			  line-height: 40px;
			}
			.angerWidth {
				height: 15px;
			}
			.disgustWidth {
				height: 15px;
			}
			.fearWidth {
				height: 15px;
			}
			.joyWidth {
				height: 15px;
			}
			.sadnessWidth {
				height: 15px;
			}
			.surpriseWidth {
				height: 15px;
			}
			p {
				margin-bottom: 20px;
			}
			img {
				margin-left: 60px;
				margin-top: 5px;
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
		                    <li><a href="{{ url('/settings') }}"><i class="glyphicon glyphicon-cog"></i> Settings </a></li>
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
                  <table border="0px">
                    <thead>
                      <tr>
                        <th id="emotions">PRIMARY EMOTIONS</th>
                        <th id="primary">PRIMARY DYADS</th>
                        <th id="secondary">SECONDARY DYADS</th>
                        <th id="tertiary">TERTIARY DYADS</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td id="anger">Anger</td>
                        <td id="submission">Submission</td>
                        <td id="guilt">Guilt</td>
                        <td id="delight">Delight</td>
                      </tr>
                      <tr>
                        <td id="disgust">Disgust</td>
                        <td id="alarm">Alarm</td>
                        <td id="curiosity">Curiosity</td>
                        <td id="sentimentality">Sentimentality</td>
                      </tr>
                      <tr>
                        <td id="fear">Fear</td>
                        <td id="disappointment">Disappointment</td>
                        <td id="despair">Despair</td>
                        <td id="shame">Shame</td>
                      </tr>
                      <tr>
                        <td id="joy">Joy</td>
                        <td id="remorse">Remorse</td>
                        <td id="envy">Envy</td>
                        <td id="outrage">Outrage</td>
                      </tr>
                      <tr>
                        <td id="sadness">Sadness</td>
                        <td id="contempt">Contempt</td>
                        <td id="cynisim">Cynisim</td>
                        <td id="pessimism">Pessimisim</td>
                      </tr>
                      <tr>
                        <td id="surprise">Surprise</td>
                        <td id="aggression">Aggression</td>
                        <td id="pride">Pride</td>
                        <td id="morbidness">Morbidness</td>
                      </tr>
                      <tr>
                        <td id="trust">Trust</td>
                        <td id="optimism">Optimism</td>
                        <td id="fatalism">Fatalism</td>
                        <td id="dominance">Dominance</td>
                      </tr>
                      <tr>
                        <td id="anticipation">Anticipation</td>
                        <td></td>
                        <td></td>
                        <td id="anxiety">Anxiety</td>
                      </tr>
                    </tbody>
                  </table>
									<hr>
								</div>
									<div class="row" id="intensityLevels">
										<div class="col-sm-6" style="margin-top: -35px;">
											<img src="wheel.png" style="width:430px;height:430px;">
										</div>
										<div class="col-sm-6">
											<h5 id="angerName">Anger</h5>
											<div class="container">
  											<div class="skills angerWidth" id="anger_percent"></div>
											</div>
											<p></p>
											<h5 id="disgustName">Disgust</h5>
											<div class="container">
  											<div class="skills disgustWidth" id="disgust_percent"></div>
											</div>
											<p></p>
											<h5 id="fearName">Fear</h5>
											<div class="container">
  											<div class="skills fearWidth" id="fear_percent"></div>
											</div>
											<p></p>
											<h5 id="joyName">Joy</h5>
											<div class="container">
  											<div class="skills joyWidth" id="joy_percent"></div>
											</div>
											<p></p>
											<h5 id="sadnessName">Sadness</h5>
											<div class="container">
  											<div class="skills sadnessWidth" id="sadness_percent"></div>
											</div>
											<p></p>
											<h5 id="surpriseName">Surprise</h5>
											<div class="container">
												<div class="skills surpriseWidth" id="surprise_percent"></div>
											</div>
										</div>
                </div>
              </form>
            </div>
		</div>
	</body>
</html>
