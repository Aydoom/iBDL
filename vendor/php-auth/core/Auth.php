<?php 
namespace PAuth\Core;

use iBDL\Core\Router as Router;

class Auth {
    
    static public $user;
    
    /**
     *
     */
    static public function falseLogin() {
        Session::set('falseUri', Router::$request);
                            
        return false;
    }
    
    /**
     * 
     * @return boolean
     */
    static public function isLogin() {
        $userID = Cookie::getUserID();
        $token = Cookie::getUserToken();
        
        if (!empty($userID) && !empty($token)) {
            self::$user = DB::getUserByToken($userID, $token);
        } else {
            return self::falseLogin();
        }
        
        if (empty(self::$user)) {
            return self::falseLogin();
        } else {
            Cookie::updateTime();
            return true;
        }
    }

    /**
     *
     */
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