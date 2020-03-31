<?php

require($_SERVER['DOCUMENT_ROOT'].'/application/core/autoload.php');

class Controller extends App {
    
    public function __construct() {
	parent::__construct();
    }
    
    public function run() {
	
	if ($_POST['action']=='read') {
	    
	    $this->model->read();
	    
	} elseif ($_POST['action']=='create') {
	    
	    $this->model->create();
	    
	} elseif ($_POST['action']=='update') {
	    
	    $this->model->update();
	    
	} elseif ($_POST['action']=='delete') {

	    $this->model->delete();

	} else {

	    $this->view->get('main');

	}
    }
}

$app = new Controller();
$app->run();
    
?>