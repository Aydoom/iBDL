<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace iBDL\App\Model;

use iBDL\Core\Model;
use iBDL\Core\FileValidation;
use PAuth\Core\Auth;

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
            ['rule' => 'fileType', 'type' => 'text/plain', 'message' => 'Только [.txt]'],
            ['rule' => 'fileSize', 'max' => 1028000, 'message' => 'Файл не более 1Мб'],
            ['rule' => 'fileCount', 'max' => 30],
        ],
    ];
    
    public function fileValidation() {
        $validation = new FileValidation($this);
        $errors = [];
        foreach ($this->validRules['files'] as $rule) {
            $ruleName = $rule['rule'];
            $errors[] = $validation->on($ruleName, 'files', $rule);
        }
        $this->validErrors['files[]'] = array_values(array_diff($errors, [NULL]));
        if (!$this->hasErrors && count($this->validErrors['files[]']) > 0) {
            $this->hasErrors = true;
        }

        return (count($this->validErrors['files[]']) === 0);
    }
    
    public function save($data) {
        
        return parent::save([
            'id_user'       => Auth::$user['id'],
            'name'          => $data['name'],
            'registerDate'  => date("Y-m-d H:i:s")
        ]);
    }

}
