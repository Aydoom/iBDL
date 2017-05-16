<?php 

namespace iBDL\Core;

class Controller {

	public $layout = "default";
	
	public $data = [];
	
	public $view;
	
	public $name;
	public $action;
	
	
	
	public function __construct($action) {
		
		$this->name = $className = strtolower(array_pop(explode("\\", get_class($this))));
		
		$this->action = $action;
		
		$this->view = VIEW . $className . DS . $action . ".php";
		
	}
	
	
	
	public function _set($name, $value) {
	
		$this->data[$name] = $value;
	
	}
	
	
	
	public function _get($name) {
	
		return $this->data[$name];
	
	}
	

}