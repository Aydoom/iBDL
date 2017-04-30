<?php 

namespace iBDL\Core;

use iBDL\App\Controller;

class App {
	
	public $controller;
	public $action;
	public $param;

	
	
	static public function run($controller, $action, $param = null) {
		
		$className = 'iBDL\App\Controller\\' . $controller;
		$contr = new $className;
		
		$contr->$action($param);
		
		require LAYOUT . $contr->layout . ".php";
		
		
	}

}