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
            ['rule' => 'required', 'message' => 'it must be filled'],
            ['rule' => 'text', 'message' => 'it must content the only letters'],
            ['rule' => 'lenght', 'min' => 3, 'max' => 15],
            ['rule' => 'unique'],
        ],
        'username' => [
            ['rule' => 'required', 'message' => 'it must be filled'],
            ['rule' => 'text', 'message' => 'it must content the only letters'],
            ['rule' => 'lenght', 'min' => 3, 'max' => 15],
        ],
        'password' => [
            ['rule' => 'required', 'message' => 'it must be filled'],
            ['rule' => 'lenght', 'min' => 3, 'max' => 15],
        ],
        'repeatPassword' => [
            ['rule' => 'required', 'message' => 'it must be filled'],
            ['rule' => 'lenght', 'min' => 3, 'max' => 15],
            ['rule' => 'equal', 'field' => 'password', 
                'message' => 'does not match with "password"'],            
        ],
        'key' => [
            ['rule' => 'required', 'message' => 'it must be filled'],
            ['rule' => 'numbers', 'message' => 'it must content the only numbers'],
        ],
    ];
    
}
