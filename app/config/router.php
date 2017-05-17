<?php 

use iBDL\Core;
use PAuth\Core\Auth as Auth;

$router = new iBDL\Core\Router();
use iBDL\Core\App as App;

$router->access(['iBDL\Core\App', 'enter'], false)
            ->get('*', function() {
                $app = new App();
                $app->run("user", "login");
        });

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