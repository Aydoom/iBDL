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

    static function getUserID() {
        return filter_input($_COOKIE['userId'], FILTER_SANITIZE_SPECIAL_CHARS);
    }

    static function getUserToken() {
        return filter_input($_COOKIE['token'], FILTER_SANITIZE_SPECIAL_CHARS);
    }
    
    static function updateTime() {
        $userId = filter_input($_COOKIE['userId'], FILTER_SANITIZE_SPECIAL_CHARS);
        $token = filter_input($_COOKIE['token'], FILTER_SANITIZE_SPECIAL_CHARS);
        
        setcookie("userId", $userID, time()+3600, false, false, true);
        setcookie("token", $token, time()+3600, false, false, true);
    }
}
