<?php 

namespace iBDL\Core;

class App {
	
    public $controller;
    public $action;
    public $param;
    public $view;

    /* Helpers */
    public $html;
    public $form;

    
    /**
     * Constructor
     */
    public function __construct()
    {
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
        $className = 'iBDL\App\Controller\\' . ucfirst($controller) . "Controller";
        $this->controller = new $className($action);
        $this->controller->$action($param);
        
        $this->html = new \iBDL\Plugins\Helpers\HtmlHelper();
        $this->form = new \iBDL\Plugins\Helpers\FormHelper($this->controller->models);

        require LAYOUT . $this->controller->layout . ".php";
    }
	
    /**
     * function redirect()
     */
    public function redirect($uri)
    {
        $location = 'http://' . $_SERVER['SERVER_NAME']
            . $_SERVER['REQUEST_URI'] . $uri;
        header('Location: ' . $location);
    }
	
    /**
     * function view()
     */
    public function view()
    {
        $fileName = $this->controller->view;
        if (file_exists($fileName)) {
            require $fileName;
        } else {
            pr("Нет вьювера: " . $this->controller->name . "/"
                    . $this->controller->action . ".php - отсутсвует!");
        }
    }
}