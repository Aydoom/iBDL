<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace iBDL\App\Model;

use iBDL\Core\Model;

/**
 * Description of userModel
 *
 * @author Aydoom
 */
class UserModel extends Model{
    
    public $validRules = [
        'name' => [
            ['rule'      => 'text', 'message'   => 'login is wrong'],
            ['rule'      => 'required', 'message'   => 'login is not filled'],
        ]
    ];
    
}
