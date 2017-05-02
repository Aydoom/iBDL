<?php 

namespace iBDL\Core;

class App {
	
    public $controller;
    public $action;
    public $param;


    /* Helpers */
    public $Html;

    

    public function __construct()
    {
        $this->Html = new \iBDL\Plugins\Helpers\HtmlHelper();
    }
	
	
	// Function get data from controller saves
	public function fetch($name) {
		
		return $this->controller->_get($name);
		
	}

    
    
    public function run($controller, $action, $param = null) {

        $className = 'iBDL\App\Controller\\' . $controller;
		
        $this->controller = new $className($action);

        $this->controller->$action($param);

        require LAYOUT . $this->controller->layout . ".php";

    }
	
	
	
	public function view() {
	
		$fileName = $this->controller->view;
		
		if (file_exists($fileName)) {
		
		
		} else {
		
			pr("Нет вьювера: " . $this->controller->name . "/" . $this->controller->action . ".php - отсутсвует!");
		
		}
	
	}
}