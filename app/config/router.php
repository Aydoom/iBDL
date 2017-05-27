<?php 
$router = new iBDL\Core\Router();
use iBDL\Core\App as App;
logs($_COOKIE['userid'] . '==>' . $_COOKIE['token']);

$router->access(['PAuth\Core\Auth', 'isLogin'])
    ->any('/', function() {
        //pr('home/index', false);
        $app = new App();
        $app->run("home", "index");
    })
    ->any('/:controller', function($controller){
        $app = new App();
        $app->run($controller, "index");
    })
    ->any('/:controller/:action', function($controller, $action){
        $app = new App();
        $app->run($controller, $action);
    })
    ->any('/:controller/:action/:id', function($controller, $action, $id){
        $app = new App();
        $app->run($controller, $action, ['id' => $id]);
    })
    ->any('*', function() {
        $app = new App();
        $app->abort(404);
    });

$router->start()
    ->any("/user/:action", function($action) {
        logs(__METHOD__);
        $app = new App();
        $app->run("user", $action);
    })
    ->get('*', function() {
        logs(__METHOD__);
        $app = new App();
        $app->redirect("user/login");
    });
