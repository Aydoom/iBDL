<?php 

use iBDL\Core;

require VENDOR . "crouter" . DS . "crouter.php";



(new CRouter("router.inc.php", false))
->group(HOME)
	->get('/', function(){
            $app = new iBDL\Core\App;
            $app->run("Home", "Index");
	})
	->get('/:controller', function($controller){
		echo $controller;
	})
	->get('/:controller/:action', function($controller, $action){
		echo $controller . "+" . $action;
	})
	->get('/:controller/:action/:id', function($controller, $action, $id){
		echo $controller . "+" . $action . "+" . $id;
	})
->execute();
