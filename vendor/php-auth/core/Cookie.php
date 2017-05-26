<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace PAuth\Core;

/**
 * Description of Cookie
 *
 * @author Aydoom
 */
class Cookie {
    
    static private $storage = [];
    

    static function getUserID() {
        if(empty(self::$storage['userId'])) {
            self::$storage['userId'] = filter_input(INPUT_COOKIE, 
                                        'userId', FILTER_SANITIZE_SPECIAL_CHARS);
        }
        
        return self::$storage['userId'];
    }

    static function getUserToken() {
        if(empty(self::$storage['token'])) {
            self::$storage['token'] = filter_input(INPUT_COOKIE, 
                                        'token', FILTER_SANITIZE_SPECIAL_CHARS);
        }
        
        return self::$storage['token'];
    }
    
    static function setUserID($id) {
        setcookie("userId", $id, time()+3600);
        self::$storage['userId'] = $id;
    }

    static function setUserToken($token) {
        setcookie("token", $token, time()+3600);
        self::$storage['token'] = $token;
    }
    
    static function updateTime() {
        $userId = filter_input($_COOKIE['userId'], FILTER_SANITIZE_SPECIAL_CHARS);
        $token = filter_input($_COOKIE['token'], FILTER_SANITIZE_SPECIAL_CHARS);
        
        setcookie("userId", $userID, time()+3600, false, false, true);
        setcookie("token", $token, time()+3600, false, false, true);
    }
}
