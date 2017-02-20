<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use View;

class ServicesController extends Controller
{

	public function __construct() {
		$this->middleware('auth', ['except' => 'logout']);
	}

    public function status() {
    	//check hadoop services

    	// $hadoopServiceStatus = "ps -ef | grep hadoop | grep -P  'namenode|datanode|tasktracker|jobtracker|nodemanager|resourcemanager'";
   
    	// $namenodeService = $this->namenodeCheck($hadoopServiceStatus);
    	// $datanodeService = $this->datanodeCheck($hadoopServiceStatus);
    	// $SecondaryNameNodeService = $this->secondaryNameNodeCheck($hadoopServiceStatus);
    	// $nodeManagerService = $this->nodeManagerCheck($hadoopServiceStatus);
    	// $resourceManagerService = $this->resourceManagerCheck($hadoopServiceStatus);

    	/*return View::make('services', 
    		array(
    			'namenode' => $namenodeService,
    			'datanode' => $datanodeService,
    			'secondaryNamenode' => $SecondaryNameNodeService,
    			'nodeManager' => $nodeManagerService,
    			'resourceManager' => $resourceManagerService
    		)
    	);*/
    	return view('services');
    }

 //    public function namenodeCheck($hadoopServiceStatus) {
	// 	/*if (strpos($hadoopServiceStatus, 'org.apache.hadoop.hdfs.server.namenode.NameNode') !== false) {
	// 		return 'Operational'; 	
	// 	}
	// 	return 'Not Operational. Contact Administrator';*/
	// }

	// public function datanodeCheck($hadoopServiceStatus) {
	// 	if (strpos($hadoopServiceStatus, 'org.apache.hadoop.hdfs.server.datanode.DataNode') !== false) {
	// 		return 'Operational';
	// 	}
	// 	return 'Not Operational. Contact Administrator';
	// }

	// public function secondaryNameNodeCheck($hadoopServiceStatus) {
	// 	if (strpos($hadoopServiceStatus, 'org.apache.hadoop.hdfs.server.namenode.SecondaryNameNode') !== false) {
	// 		return 'Operational';
	// 	}
	// 	return 'Not Operational. Contact Administrator';
	// }

	// public function resourceManagerCheck($hadoopServiceStatus) {
	// 	$status = 0;
	// 	if (strpos($hadoopServiceStatus, 'org.apache.hadoop.yarn.server.resourcemanager.ResourceManager') !== false) {
	// 		return 'Operational';
	// 	}
	// 	return 'Not Operational. Contact Administrator';
	// }

	// public function nodeManagerCheck($hadoopServiceStatus) {
	// 	if (strpos($hadoopServiceStatus, 'org.apache.hadoop.yarn.server.nodemanager.NodeManager') !== false) {
	// 		return 'Operational';
	// 	}
	// 	return 'Not Operational. Contact Administrator';	
	// }
}
	