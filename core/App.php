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
    public $user;

    
    /**
     * Constructor
     */
    public function __construct()
    {
    }

    public function abort($error) {
        if ($error === 404) {
            require VIEW . "/errors/404.php";
        }
    }
    
    /**
     * Function get data from controller saves
     * 
     * @param type $name
     * @return type
     */
    public function fetch($name) {
        
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
        logs();
        $className = 'iBDL\App\Controller\\' . ucfirst($controller) . "Controller";
        $this->controller = new $className($action);
        $this->controller->$action($param);
        if (!empty($this->controller->redirect)) {
            $this->redirect($this->controller->redirect);
            die();
        }
        
        $this->html = new \iBDL\Plugins\Helpers\HtmlHelper();
        $this->form = new \iBDL\Plugins\Helpers\FormHelper($this->controller->models);
        $this->user = new \iBDL\Plugins\Helpers\UserHelper();

        require LAYOUT . $this->controller->layout . ".php";
    }
	
    /**
     * function redirect()
     */
    public function redirect($uri)
    {
        //pr($_SERVER);
        $location = 'http://' . $_SERVER['SERVER_NAME']
            . substr($_SERVER['SCRIPT_NAME'], 0 , -9) . ltrim($uri, '/');
        logs(__METHOD__ . "[$location]");
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