<?php 

namespace iBDL\Core;

class Router
{
    public $request;
    public $method;
    
    public $baseDir = "/";
    public $paths = [];
    public $args = [];
    
    public $access = true;
    
    static public $exit = false;
    
    public function __construct() {
        $requestUri = $_SERVER['REQUEST_URI'];
        $requestDir = $this->getRootDir();
        $lenRequest = strpos($requestUri, $requestDir)
                        - strlen($requestDir) + strlen($requestUri);
        $this->request = substr($requestUri, -$lenRequest);                
       
        $this->method = strtolower($_SERVER['REQUEST_METHOD']);
        
        $this->paths = array_slice(explode("/", $this->request), 1);
    }
    
    public function access($action) {
        $this->access = call_user_func($action);
        
        return $this;
    }
    
    
    /**
     * Function group()
     *
    */
    public function group($baseDir) {
        $this->baseDir = $baseDir;    
    }
    
    /**
     * Function get()
     *
    */
    public function get($route, $action) {
        if (self::$exit || !$this->access) {
            return false;
        } elseif (is_callable($action) && $this->compareRoute($route)) {
            //pr($this->args, false);
            call_user_func_array($action, $this->args);
            self::$exit = true;
        }
        
        return $this;
    }
    
    /**
     * Function getRootDir()
     *
    */
    public function getRootDir() {
        
        return implode("/", 
            array_slice(explode("/", $_SERVER['SCRIPT_NAME']), 0, -1));
    }
    
    /**
     *
    */
    public function compareRoute($route) {
        //pr($route, false);
        $paths = array_slice(explode("/", $route), 1);
        
        if (count($paths) !== count($this->paths)) {
            //pr("\t out for count: " . count($paths) . "/" . count($this->paths), false);
            return false;
        } else {       
            foreach ($paths as $key => $path) {
                if (substr_count($path, ":") === 1) {
                    $this->args[] = $this->paths[$key];
                } elseif ($path != $this->paths[$key]) {
                    return false;
                }
            }
        }
        
        return true;
    }
}