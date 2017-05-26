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
     */
    static public function getFalseUrl() {
        return Session::get('falseUri');
    }
    
    /**
     * 
     * @return boolean
     */
    static public function isLogin() {
        logs(__METHOD__);
        //pr($_COOKIE, false);
        $userID = Cookie::getUserID();
        $token = Cookie::getUserToken();

        //pr([$userID, $token], false);
        if (!empty($userID) && !empty($token)) {
            self::$user = DB::getUserByToken($userID, $token);
        } else {
            return self::falseLogin();
        }
        //pr(self::$user);
        
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
        self::$user = DB::getUserByPsw($userName, $password);
        //pr($_COOKIE, false);
        Cookie::setUserId(self::$user['id']);
        Cookie::setUserToken(md5(md5(rand(10000, 100000))));
        //pr($_COOKIE, false);
        DB::saveUserToken(self::$user['id']);
        //pr(self::$user['id']);
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