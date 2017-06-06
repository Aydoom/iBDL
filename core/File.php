<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace iBDL\Core;

/**
 * Description of File
 *
 * @author Aydoom
 */
class File {
    
    public $files = [];
    public $storeDir;
    
    public function __construct($formName, $fieldName) {
        foreach ($_FILES[$formName] as $key => $files) {
            foreach($files[$fieldName] as $index => $value) {
                $this->files[$index][$key] = $value;
            }
        }
    }
    
    public function save($storeDir) {
        $error = false;
        foreach($this->files as $index => &$file) {
            $file["new_name"] = $this->getNewName($index);
            if(is_uploaded_file($file["tmp_name"])) {
                move_uploaded_file($file["tmp_name"], $storeDir . $file["new_name"]);
            } else {
                $file['error'] = 'Не удалось сохранить файл';
                $error = true;
            }
        }
        
        return !$error;
    }
    
    public function getNewName($index) {
        return mktime() . "-" . \PAuth\Core\Auth::$user['id'] . "-" . $index;
    }
}
