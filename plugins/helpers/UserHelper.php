<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace iBDL\Plugins\Helpers;
use PAuth\Core\Auth;
/**
 * Description of UserHelper
 *
 * @author Aydoom
 */
class UserHelper {
    
    public function getName() {
        return Auth::$user['name'];
    }
}
