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
			.panel {
				margin-right: 16px;
			}
			.label{
				font-size: 100%;
				float: right;
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
		                    <li><a href="{{ url('/compose') }}"><i class="glyphicon glyphicon-edit"></i> Compose </a></li>
		                    <li><a href="{{ url('/candidates') }}"><i class="glyphicon glyphicon-tasks"></i> Candidates </a></li>
		                    <li class="active"><a href="{{ url('/services') }}"><i class="glyphicon glyphicon-record"></i> Infrastructure Services </a></li>
		                    <li><a href="javascript:;"><i class="glyphicon glyphicon-cog"></i> Settings </a></li>
												<li class="nav-divider"></li>
												<li><a href="{{ url('/storage') }}"><i class="glyphicon glyphicon-th-large"></i> Storage Analyzer </a></li>
												<li><a href="{{ url('/regression') }}"><i class="glyphicon glyphicon-hourglass"></i> Regression </a></li>
												<li><a href="{{ url('/comparator') }}"><i class="glyphicon glyphicon-stats"></i> Comparator </a></li>
		                    <li class="nav-divider"></li>
		                    <li><a href="{{ url('/logout') }}"><i class="glyphicon glyphicon-log-out"></i> Sign Out </a></li>
		                </ul>
		            </nav>
		        </div>
		        <div class="col-sm-10">
		        	<div class="panel panel-info">
	  					<div class="panel-heading">Hadoop Services</div>
	  					<div class="panel-body">
	  						Namenode
	  						<?php echo isset($nameNode) ? '<span class="label label-success">Operational</span>' : '<span class="label label-danger">Not Operational</span>' ?></span><hr>
	  						Datanodes
	  						<?php echo isset($dataNode) ? '<span class="label label-success">Operational</span>' : '<span class="label label-danger">Not Operational</span>' ?></span><hr>
	  						Secondary Namenode
	  						<?php echo isset($secondaryNameNode) ? '<span class="label label-success">Operational</span>' : '<span class="label label-danger">Not Operational</span>' ?></span><hr>
	  						Node Manager
	  						<?php echo isset($nodeManager) ? '<span class="label label-success">Operational</span>' : '<span class="label label-danger">Not Operational</span>' ?></span><hr>
	  						Resource Manager
	  						<?php echo isset($resourceManager) ? '<span class="label label-success">Operational</span>' : '<span class="label label-danger">Not Operational</span>' ?></span>
	  					</div>
					</div>
					<div class="panel panel-info">
	  					<div class="panel-heading">Alluxio Services</div>
	  					<div class="panel-body">
	  						Alluxio Master
	  						<?php echo isset($alluxioMaster) ? '<span class="label label-success">Operational</span>' : '<span class="label label-danger">Not Operational</span>' ?></span><hr>
	  						Alluxio Slaves
	  						<?php echo isset($alluxioWorker) ? '<span class="label label-success">Operational</span>' : '<span class="label label-danger">Not Operational</span>' ?></span>
	  					</div>
					</div>
					<div class="panel panel-info">
	  					<div class="panel-heading">Spark Services</div>
	  					<div class="panel-body">
	  						Spark Master
	  						<?php echo isset($sparkMaster) ? '<span class="label label-success">Operational</span>' : '<span class="label label-danger">Not Operational</span>' ?></span><hr>
	  						Spark Workers
	  						<?php echo isset($sparkWorker) ? '<span class="label label-success">Operational</span>' : '<span class="label label-danger">Not Operational</span>' ?></span>
	  					</div>
					</div>
					<hr>
					<label class="label label-info" style="float: left">Please send us email if system is not fully operational.</label>
				</div>
    		</div>
		</div>
	</body>
</html>
