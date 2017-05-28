<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace iBDL\App\Model;

use iBDL\Core\Model;

/**
 * Description of SessionModel
 *
 * @author Aydoom
 */
class SessionModel extends Model {
    public $validRules = [
        'name' => [
            ['rule' => 'required', 'message' => 'it must be filled'],
            ['rule' => 'name'],
            ['rule' => 'lenght', 'min' => 3, 'max' => 15],
        ],
        'files' => [
            ['rule' => 'File::Type', 'type' => 'txt'],
            ['rule' => 'File::Size', 'max' => 1028],
            ['rule' => 'File::Count', 'max' => 30],
        ],
        
    ];
}
