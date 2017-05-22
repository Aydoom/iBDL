<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace iBDL\Core;

/**
 * Description of Request
 *
 * @author Aydoom
 */
class Request {

    static private $vars = [];

    static public function init($array = false) {
        $request = ($array) ? $array : $_REQUEST;
        foreach ($request as $key => $val) {
            if (is_array($val)) {
                $request[$key] = self::init($val);
            } else {
                $request[$key] = htmlspecialchars(strip_tags(trim($val)));
            }
        }
        
        return $request;
    }
    
    static public function get($name) {
        if (empty(self::$vars)) {
            self::$vars = self::init();
        }

        eval('$value = self::$vars[' . str_replace(".", "][", $name) . '];');
        
        return $value;
    }
    
    static public function has($name) {
        
        return (self::get($name) !== null);
    }
    
    static public function set($name, $value) {
        eval('self::$vars[' . str_replace(".", "][", $name) . '] = ' . $value . ';');
    }
}
