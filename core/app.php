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
        $this->Html = new iBDL\Plugins\Helpers\HtmlHelper();
    }

    
    
    public function run($controller, $action, $param = null) {

        $className = 'iBDL\App\Controller\\' . $controller;
        $contr = new $className;

        $contr->$action($param);

        require LAYOUT . $contr->layout . ".php";

    }

}