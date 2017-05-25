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
            ['rule' => 'textEn', 'message' => 'it must content the only english letters'],
            ['rule' => 'lenght', 'min' => 3, 'max' => 15],
            //['rule' => 'unique'],
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
            ['rule' => 'hasInTable', 'message' => 'key undefinded'],
        ],
    ];
    
    public function save($data) {

        return parent::save([
            'id_user_group' => 1,
            'name'          => $data['name'],
            'username'      => $data['username'],
            'email'         => $data['email'],
            'password'      => md5(md5($data['password'])),
            'registerDate'  => date("Y-m-d H:i:s")
        ]);
    }
        
    public function hasInTable($data, $rule) {
        $conditions = [
                'where' => ['code' => $data, 'id_user' => 'NULL'],
                'limit' => 1,
        ];
        
        return empty($this->loadModel('key')->find($conditions)) ? null 
                                                            : $rule['message'];
    }
}
