<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace iBDL\Core;
use PAuth\Core\Auth;
/**
 * Description of File
 *
 * @author Aydoom
 */
class File {
    
    public $files = [];
    public $storeDir;
    
    public function newName($subDir, $index) {
        return Auth::$user['id'] . DS . $subDir . DS . time() . "-$index.txt";
    }
    
    /**
     * 
     * @param type $formName
     * @param type $fieldName
     */
    public function getFromForm($formName, $fieldName, $subDir) {
        foreach ($_FILES[$formName] as $key => $files) {
            foreach($files[$fieldName] as $index => $value) {
                $this->files[$index][$key] = $value;
                $this->files[$index]['new_name'] = $this->newName($subDir, $index);
            }
        } 
        
        return $this;
    }
    
    public function save($storeDir) {
        $error = false;
        foreach($this->files as &$file) {
            if(is_uploaded_file($file["tmp_name"])) {
                $this->createDir($storeDir, $file["new_name"]);               
                move_uploaded_file($file["tmp_name"], $storeDir . $file["new_name"]);
            } else {
                $file['error'] = 'Не удалось сохранить файл';
                $error = true;
            }
        }
        
        return !$error;
    }
    
    public function getAll() {
        return $this->files;
    }
    
    /**
     * 
     * @param type $baseDir
     * @param type $newDir - at baseDir
     */
    public function createDir($baseDir, $newDir) {
        $paths = explode(DS, $newDir);
        foreach ($paths as $value) {
            if (!is_dir($baseDir . DS . $value)
                    && substr_count($value, ".") == 0) {
                mkdir($baseDir . DS . $value);
            }
            $baseDir.= DS . $value;
        }
    }
}
