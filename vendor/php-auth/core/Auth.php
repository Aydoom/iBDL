<?php 

namespace PAuth\Core;

class Auth {
    
    static public function login($userName, $password) {
        $user = DB::getUserByPsw($userName, $password);
        
    }
}