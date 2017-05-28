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
    
    public function __construct($model) {
        $this->model = $model;
        pr('ok');
    }
    
}
