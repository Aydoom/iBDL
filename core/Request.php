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

    static public function take($name) {
        $namePath = explode(".", $name);
        $request = $_REQUEST;
        foreach($namePath as $path) {
            if (!is_array($request[$path])) {
                self::$vars[$name] = htmlspecialchars(strip_tags($request[$path]));
                break;
            } else {
                $request = $request[$path];
            }
        }
    }
    
    static public function get($name) {
        if (!isset(self::$vars[$name])) {
            self::take($name);
        }

        return self::$vars[$name];
    }
    
    static public function set($name, $value) {
        self::$vars[$name] = $value;
    }
}
