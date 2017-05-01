<?php
return new Router(array('GET' => array(':' => array(), 'iBDL' => array(':' => array('controller' => array(':' => array('action' => array(':' => array('id' => array(':' => array(), 'LEAF' => array(0 => function($controller, $action, $id){
		echo $controller . "+" . $action . "+" . $id;
	}, 1 => array()))), 'LEAF' => array(0 => function($controller, $action){
		echo $controller . "+" . $action;
	}, 1 => array()))), 'LEAF' => array(0 => function($controller){
		echo $controller;
	}, 1 => array()))), 'LEAF' => array(0 => function(){
		iBDL\Core\App::run("Home", "Index");
	}, 1 => array())))), array());