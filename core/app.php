<?php 

namespace iBDL\Core;

class App {
	
    public $controller;
    public $action;
    public $param;


    /* Helpers */
    public $html;

    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->html = new \iBDL\Plugins\Helpers\HtmlHelper();
    }
	
    /**
     * Function get data from controller saves
     * 
     * @param type $name
     * @return type
     */
    public function fetch($name) 
    {
        return $this->controller->_get($name);
    }

    
    /**
     * function run controller
     * 
     * @param type $controller
     * @param type $action
     * @param type $param
     */
    public function run($controller, $action, $param = null)
    {
        $className = 'iBDL\App\Controller\\' . $controller;
        $this->controller = new $className($action);
        $this->controller->$action($param);

        require LAYOUT . $this->controller->layout . ".php";
    }
	
    /**
     * function view()
     */
    public function view()
    {
        $fileName = $this->controller->view;
        if (file_exists($fileName)) {
        } else {
            pr("Нет вьювера: " . $this->controller->name . "/"
                    . $this->controller->action . ".php - отсутсвует!");
        }
    }
}