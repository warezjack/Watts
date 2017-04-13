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
			$process = new Process('jps');
			$process->run();
			$processes = $process->getOutput();

			//check hadoop services
			$nameNode = $this->checkService($processes, 'NameNode');
			$dataNode = $this->checkService($processes, 'DataNode');
			$nodeManager = $this->checkService($processes, 'NodeManager');
			$resourceManager = $this->checkService($processes, 'ResourceManager');
			$secondaryNameNode = $this->checkService($processes, 'SecondaryNameNode');

			//check alluxio services
			$alluxioMaster = $this->checkService($processes, 'AlluxioMaster');
			$alluxioWorker = $this->checkService($processes, 'AlluxioWorker');

			//check spark services
			$sparkMaster = $this->checkService($processes, 'Master');
			$sparkWorker = $this->checkService($processes, 'Worker');

    	return view('services', array(
				'nameNode' => $nameNode,
				'dataNode' => $dataNode,
				'nodeManager' => $nodeManager,
				'resourceManager' => $resourceManager,
				'secondaryNameNode' => $secondaryNameNode,
				'sparkMaster' => $sparkMaster,
				'sparkWorker' => $sparkWorker,
				'alluxioMaster' => $alluxioMaster,
				'alluxioWorker' => $alluxioWorker,
			));
    }

		public function checkService($process, $service) {
			if(strpos($process, $service) !== false) {
					return true;
			}
		}
}
