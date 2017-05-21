<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace iBDL\Core;

/**
 * Description of Model
 *
 * @author Aydoom
 */
class Model {
    
    public $validRules = [];
    public $validErrors = [];
    public $hasErros = false;
    
    public $modelName;
    
    /**
     * 
     */
    public function __construct() {
        $this->modelName = substr(array_pop(explode("\\", get_class($this))), 0, -5);
    }
    
    /**
     * 
     * @param type $name
     * @return type
     */
    public function getRequest($name) {
        $name = special_chars()
        return filter_input(INPUT_POST, $name, FILTER_DEFAULT, FILTER_);
    }
    
    /**
     * 
     * @return type
     */
    public function validation() {
        $valid = new Validation();
        foreach($this->validRules as $field => $rules) {
            if (!is_array($rules)) {
                $rules = [$rules];
            }
            
            foreach($rules as $rule) {
                $ruleName = $rule['rule'];
                $error = $valid->$ruleName($this->getRequest($field), $rule);
                if ($error !== null) {
                    $this->hasErros = true;
                    $this->validErrors[$field] = $error;                    
                }
            }
        }
        return !$this->hasErros;
    }
    
}
