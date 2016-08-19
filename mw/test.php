<?php
include_once('/data/lib/iphp/framework/Logger.php');
Logger::init();

include_once(dirname(__FILE__) . '/MasterWorker.php');

class MyMasterWorker extends MasterWorker
{
	function master(){
		for($i=0; $i<5; $i++){
			Logger::debug("add job $i");
			$this->add_job($i);
			#$this->wait();
			#Logger::debug("");
		}
		Logger::debug("master add all job");
		
		// 当需要在确保所有任务处理完毕后再做其它操作时, 才需要调用 wait
		// $this->wait();
		// ...
	}

	function worker($job){
		sleep(2);
		// ...
		Logger::debug("process job: " . json_encode($job));
		return true;
	}
}

$mw = new MyMasterWorker();
$mw->set_num_workers(2);
$mw->run();


