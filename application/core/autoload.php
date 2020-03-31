<?php

class MongoDB {
	
	public function __construct() {
	    $this->manager = new MongoDB\Driver\Manager('mongodb://127.0.0.1:27017/');
	}
		
	public function count($database=null,$collection=null,$where=null) {

	    if ($database and $collection) {
		
		if (!$where or $where==null or !is_array($where)) { $where = null; }
		    $command = new MongoDB\Driver\Command(['count'=>$collection,'query'=>$where]);
		    $cursor = $this->manager->executeCommand($database, $command);
		    $output = []; foreach($cursor as $count) { $output[] = $count; }
		    $output=$output['0'];
		
	    }
	    
	    return $output;
	    
	}
	
	public function select($database=null,$collection=null,$where=null,$paging=null) {
	    
	    if ($database and $collection) {

		$opts = ['limit'=>0]; if (is_array($paging)) { $opts['limit'] = (int)$paging['limit']; if (is_array($paging['sort'])) { if (count($paging['sort'])) { $opts['sort'] = $paging['sort']; } } }
		
		if (!$where or $where==null or !is_array($where)) { $where=[]; }
		if ($where['_id']) { $where['_id'] = new MongoDB\BSON\ObjectID($where['_id']); }

		$query = new MongoDB\Driver\Query($where,$opts);
		$cursor = $this->manager->executeQuery($database.'.'.$collection,$query);

		$output = [];
		foreach ($cursor as $document) { $output[] = $document; }

	    } elseif ($database) {

		$command = new MongoDB\Driver\Command(['listCollections'=>1]);
		$cursor = $this->manager->executeCommand($database, $command);

		$output = [];
		foreach($cursor as $collection) { $output[] = $collection; }
		
	    } else {

		$command = new MongoDB\Driver\Command(['listDatabases'=>1]);
		$cursor = $this->manager->executeCommand('admin', $command);

		$output = [];
		foreach($cursor as $collection) { $output[] = $collection; }
		
	    }
	    
	    return $output;
	}

	public function insert($database,$collection,$data) {
	    
	    if (is_array($data)) {
		if (count($data)!==0) {
		    $bulkWrite = new MongoDB\Driver\BulkWrite;
		    $bulkWrite->insert($data);
		    $output = $this->manager->executeBulkWrite($database.'.'.$collection,$bulkWrite);
		    return $output;
		}
	    }
	}

	public function update($database,$collection,$data,$where,$paging=null) {
	    
	    if (is_array($data)) {
		if (count($data)!==0) {
		    
		    $opts = (int)$paging['limit']; if ($opts==0) { $opts=true; } else { $opts=false; } $opts = ['multi'=>$opts,'upsert'=>false];
		    if ($where['_id']) { $where['_id'] = new MongoDB\BSON\ObjectId($where['_id']); }
		    
		    $bulkWrite = new MongoDB\Driver\BulkWrite;
		    $bulkWrite->update($where,['$set'=>$data],$opts);
		    $output = $this->manager->executeBulkWrite($database.'.'.$collection,$bulkWrite);
		    $output = $output;
		    return $output;
		}
	    }
	    
	}

	public function delete($database=null,$collection=null,$where=null,$paging=null) {

	    $opts = ['limit'=>0]; if (is_array($paging)) { $opts['limit'] = (int)$paging['limit']; }
	    
	    if ($database and $collection and is_array($where)) {
		
		    if (!$where or $where==null) { $where=[]; }
		    if ($where['_id']) { $where['_id'] = new MongoDB\BSON\ObjectID($where['_id']); }
		    $bulkWrite = new MongoDB\Driver\BulkWrite;
		    $bulkWrite->delete($where,$opts);
		    $output = $this->manager->executeBulkWrite($database.'.'.$collection,$bulkWrite);

	    } elseif ($database and $collection) {
		
		    $command = new MongoDB\Driver\Command(['drop'=>$collection]);
		    $output = $this->manager->executeCommand($database, $command);
		    
	    } elseif ($database) {
		    if ($database!=='admin' and $database!=='config' and $database!=='local') {
		    $command = new MongoDB\Driver\Command(['dropDatabase'=>1]);
		    $output = $this->manager->executeCommand($database, $command);
		    }
	    }
	    
	    return $output;
	}
}

require($_SERVER['DOCUMENT_ROOT'].'/application/models/main.php');

class Views {
    
    public function get($view_name) {
	require($_SERVER['DOCUMENT_ROOT'].'/application/views/'.$view_name.'.php');
    }
}

class App {
    
    public function __construct() {
	
	$this->model = new Model();
	$this->view = new Views();

    }

}

?>