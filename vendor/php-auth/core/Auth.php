<?php 

namespace PAuth\Core;

class Auth {
    
    static public $user;
    
    /**
     * 
     * @return boolean
     */
    static public function enter() {
        $userID = Cookie::getUserID();
        $token = Cookie::getToken();
        
        if (!empty($userID) && !empty($token)) {
            self::$user = DB::getUserByToken($userID, $token);
        } else {
            return false;
        }
        
        if (empty(self::$user)) {
            return false;
        } else {
            Cookie::updateTime();
            return true;
        }
    }

    static public function login($userName, $password) {
        $user = DB::getUserByPsw($userName, $password);
    }
    
    /**
     * 
     * @param type $userName
     * @param type $passw
     * @param type $r_passw
     * @param type $userGroup
     * @return boolean
     */
    static public function registration($userName, $passw, $r_passw, $userGroup = 1) {
        if ($passw === $r_passw) {
            DB::createUser($userName, $passw, $userGroup);
        } else {
            return false;
        }
    }
}