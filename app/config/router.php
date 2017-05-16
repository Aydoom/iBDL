<?php 

use iBDL\Core;

//require VENDOR . "crouter" . DS . "crouter.php";


/*
(new CRouter("router.inc.php", false))
->group(HOME)
	->get('/', function(){
            $app = new iBDL\Core\App;
            $app->run("home", "index");
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
*/

$router = new iBDL\Core\Router();
use iBDL\Core\App as App;

$router
    ->get('/', function() {
        $app = new App();
        $app->run("home", "index");
    })
    ->get('/:controller', function($controller){
        $app = new App();
        $app->run($controller, "index");
    })
    ->get('/:controller/:action', function($controller, $action){
        $app = new App();
        $app->run($controller, $action);
    })
    ->get('/:controller/:action/:id', function($controller, $action, $id){
        $app = new App();
        $app->run($controller, $action, ['id' => $id]);
    })
;