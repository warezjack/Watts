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
		                    <li><a href="{{ url('/compose') }}"><i class="glyphicon glyphicon-edit"></i> Compose </a></li>
		                    <li class="active"><a href="{{ url('/services') }}"><i class="glyphicon glyphicon-record"></i> System Services </a></li>
		                    <li><a href="javascript:;"><i class="glyphicon glyphicon-tasks"></i> Candidates </a></li>
		                    <li><a href="javascript:;"><i class="glyphicon glyphicon-cog"></i> Settings </a></li>
		            
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
	  						<span class="label label-info"><?php echo isset($namenode) ? $namenode : 'Not Operational'; ?></span><hr>
	  						Datanodes
	  						<span class="label label-info"><?php echo isset($datanode) ? $datanode : 'Not Operational'; ?></span><hr>
	  						Secondary Namenode
	  						<span class="label label-info"><?php echo isset($secondaryNamenode) ? $secondaryNamenode : 'Not Operational'; ?></span><hr>
	  						Node Manager
	  						<span class="label label-info"><?php echo isset($nodeManager) ? $nodeManager : 'Not Operational'; ?></span><hr>
	  						Resource Manager
	  						<span class="label label-info"><?php echo isset($resourceManager) ? $resourceManager : 'Not Operational'; ?></span>
	  					</div>
					</div>
					<div class="panel panel-info">
	  					<div class="panel-heading">Alluxio Services</div>
	  					<div class="panel-body">
	  						Alluxio Master
	  						<span class="label label-info">Not Operational</span><hr>
	  						Alluxio Slaves
	  						<span class="label label-info">Not Operational</span><hr>
	  					</div>
					</div>
					<hr>
					<label class="label label-info" style="float: left">Please send us email if system is not fully operational.</label>
				</div>
    		</div>
		</div>
	</body>
</html>