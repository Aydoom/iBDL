<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace iBDL\Core;

/**
 * Description of FileValidation
 *
 * @author Aydoom
 */
class FileValidation {
    public $model;
    public $files;
    
    public function __construct($model) {
        $this->model = $model;
        $this->files = $_FILES[strtolower($model->modelName) . 'Form'];
    }
    
    public function fileType($fieldName, $rule) {
        $error = false;
        foreach ($this->files['type'][$fieldName] as $type) {
            if ($type !== $rule['type'] && !empty($type)) {
                $error = true;
                break;
            }
        }
        $message = ($rule['message']) ? $rule['message'] :
                     'Один или несколько файлов с неподдерживаемым расширением';
        
        return ($error) ? $message : null;
    }    
    
    public function fileSize($fieldName, $rule) {
        $error = false;
        foreach ($this->files['size'][$fieldName] as $size) {
            if ($size > $rule['size'] && !empty($size)) {
                $error = true;
                break;
            }
        }
        $message = ($rule['message']) ? $rule['message'] :
                     'Один или несколько файлов слишком большие';
        
        return ($error) ? $message : null;
    }    
    
    public function fileCount($fieldName, $rule) {
        $message = ($rule['message']) ? $rule['message'] :
                    'Одновременно можно загрузить не более ' . $rule['count']
                    . ' фалов.';
        
        return (count($this->files['count'][$fieldName]) > $rule['count'])
                                                            ? $message : null;
    }    
}
