<?php 
$router = new iBDL\Core\Router();
use iBDL\Core\App as App;
logs();
/**
$router->middleware("*", ['PAuth\App\Middleware\HasNotAdmin', 'index'], function(){
        $app = new App();
        $app->redirect("user/registrar");
    });
*/

$router->access(['PAuth\Core\Auth', 'isLogin'], false)
    ->any("/user/:action", function($action) {
        $app = new App();
        $app->run("user", $action);
    })
    ->get('*', function() {
        $app = new App();
        $app->redirect("user/login");
    })
    ->end();

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
    ->end();
