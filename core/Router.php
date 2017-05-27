<?php 

namespace iBDL\Core;

/**
 * Description of Router
 *
 * @author Aydoom
 */
class Router
{
    static public $request;
    static public $method;
    
    public $baseDir = "/";
    static public $rootDir = "/";
    
    public $paths = [];
    public $args = [];
    
    public $access = true;
    
    static public $exit = false;
    
    /**
     * Constructor
     */
    public function __construct() {
        $requestUri = filter_input(INPUT_SERVER, 'REQUEST_URI', 
                            FILTER_SANITIZE_SPECIAL_CHARS);
        $requestDir = $this->getRootDir();
        $lenRequest = strpos($requestUri, $requestDir)
                        - strlen($requestDir) + strlen($requestUri);
        self::$request = substr($requestUri, -$lenRequest);                
       
        $this->setMethod();
        $this->paths = explode("/", self::$request);
    }
    
    /**
     * 
     * @param type $action
     * @param type $ok
     * @return $this
     */
    public function access($action, $ok = true) {
        logs(__METHOD__);
        if($ok) {
            $this->access = call_user_func($action);
        } else {
            $this->access = !call_user_func($action);
        }
        
        return $this;
    }
    
    /**
     * 
     * @param type $route
     * @param type $action
     * @return $this
     */
    public function any($route, $action) {
        //pr([__METHOD__, $route], false);
        $this->run($route, $action);

        return $this;
    }
    
    /**
     * 
     * @param type $route
     * @param type $action
     * @return $this
     */
    public function ajax($route, $action) {
        if (self::$method === 'ajax') {
            $this->run($route, $action);
        }
        
        return $this;
    }
    
    public function start() {
        logs(__METHOD__);
        $this->access = true;
        
        return $this;
    }
    
    /**
     *
    */
    private function compareRoute($route) {
        logs(__METHOD__ . "[$route] <> [" . implode("/", $this->paths) . ']');
        //pr(['req' => $route, 'uri' => implode("/", $this->paths)], false);
        $paths = explode("/", $route);

        if (count($paths) !== count($this->paths)) {
            //pr('out by different counts', false);
            logs(__METHOD__ . 'return false-1]');
            return false;
        }
        
        foreach ($paths as $key => $path) {
            if (substr_count($path, ":") === 1) {
                $name = ltrim($path, ":");
                $this->args[$name] = $this->paths[$key];
            } elseif ($path != $this->paths[$key]) {
                //pr('out by different $path', false);
                logs(__METHOD__ . 'return false-2]');
                return false;
            } else {
                //$this->args[] = $this->paths[$key];
            }
        }
        //pr($this->args);
        //pr('compareRoute: true', false);
        logs(__METHOD__ . 'return true');
        return true;
    }
    
    /**
     * 
     * @param type $baseDir
     */
    public function group($baseDir) {
        $this->baseDir = $baseDir;
        
        return $this;
    }
    
    /**
     * 
     * @param type $route
     * @param type $action
     * @return $this
     */
    public function get($route, $action) {
        logs(__METHOD__);
        if (self::$method === 'get') {
            $this->run($route, $action);
        }

        return $this;
    }
    
    /**
     * Function getRootDir()
     *
    */
    public function getRootDir() {
        $scriptName = filter_input(INPUT_SERVER, 'SCRIPT_NAME', 
                                    FILTER_SANITIZE_SPECIAL_CHARS);
        self::$rootDir = implode("/", array_slice(explode("/", $scriptName), 0, -1));
        
        return self::$rootDir;
    }
    
    public function middleware($route, $middleware, $action, $ok = true) {
        if(call_user_func($middleware) === $ok) {
            $this->run($route, $action);
        }
        
        return $this;
    }
   
    /**
     * 
     * @param type $route
     * @param type $action
     * @return $this
     */
    public function post($route, $action) {
        logs(__METHOD__);
        if (self::$method === 'post') {
            $this->run($route, $action);
        }
        
        return $this;
    }
    
    /**
     * 
     * @param type $route
     * @param type $action
     * @return $this
     */
    public function put($route, $action) {
        if (self::$method === 'put') {
            $this->run($route, $action);
        }
        
        return $this;
    }    
    
    /**
     * 
     * @param type $route
     * @param type $action
     * @return $this
     */
    public function run($route, $action) {
        logs(__METHOD__ . "[$route]");
        logs((empty(self::$exit)) ? 'self::$exit [' . 'false]' : 'self::$exit [' . 'true]');
        logs((empty($this->access)) ? '$this->access [' . 'false]' : '$this->access [' . 'true]');
        //pr([__METHOD__, $route], false);
        //pr(['$route === *' => ($route === '*'),'$this->compareRoute($route)' => $this->compareRoute($route)], false);
        if (self::$exit || !$this->access) {
            //pr([__METHOD__, 'out by exit or access', 'exit' => self::$exit, 'access' => $this->access]);
            return $this;
        } elseif ($route === '*' || $this->compareRoute($route)) {
            call_user_func_array($action, $this->args);
            //pr([__METHOD__, 'ok']);
            self::$exit = true;
        }
        //pr([__METHOD__, 'just out'], false);
        return $this;
    }
    
    private function setMethod() {
        $method = strtolower(filter_input(INPUT_SERVER, 'REQUEST_METHOD', 
                            FILTER_SANITIZE_SPECIAL_CHARS));
        if ($method === 'post') {
            $postType = strtolower(filter_input(INPUT_POST, 'method', 
                            FILTER_SANITIZE_SPECIAL_CHARS));
            self::$method = (empty($postType)) ? $method : $postType;
        } else {
            self::$method = $method;
        }
    }
}