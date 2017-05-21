<?php 

namespace iBDL\Core;

class Controller {

    public $layout = "default";

    public $data = [];

    public $view;

    public $name;
    public $action;



    public function __construct($action) {

        $this->name = substr(strtolower(array_pop(
                                    explode("\\", get_class($this)))), 0 , -10);
        $this->action = $action;
        $this->view = VIEW . $this->name . DS . $action . ".php";
    }

    public function _set($name, $value) {

        $this->data[$name] = $value;

    }

    public function _get($name) {

        return $this->data[$name];

    }


    public function isPost() {
        $method = filter_input(INPUT_POST, 'method', FILTER_DEFAULT);
        return (!empty($_POST) && strtolower($method) !== "put");
    }
    
    public function isPut() {
        $method = filter_input(INPUT_POST, 'method', FILTER_DEFAULT);
        return (strtolower($method) === "put");
    }

}