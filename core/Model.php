<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace iBDL\Core;
use \iBDL\Core\Request;
/**
 * Description of Model
 *
 * @author Aydoom
 */
class Model {
    
    public $validRules = [];
    public $validErrors = [];
    public $hasErrors = false;
    
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
    public function getFieldName($name) {
        return strtolower($this->modelName) . "." . $name;
    }
    
    public function find($conditions = []) {
        $db = new DB(config(), strtolower($this->modelName));
        
        return $db->find($conditions);
    }
    
    /**
     * 
     * @return type
     */
    public function validation() {
        $valid = new Validation($this);
        foreach($this->validRules as $field => $rules) {
            $fieldName = $this->getFieldName($field);            
            if (!is_array($rules)) {
                $rules = [$rules];
            }
            
            if (!Request::has($fieldName)) {
                continue;
            }
            
            foreach($rules as $rule) {
                $ruleName = $rule['rule'];
                $error = $valid->$ruleName(Request::get($fieldName), $rule, $field);
                if ($error !== null) {
                    $this->hasErrors = true;
                    $this->validErrors[$field][] = $error;                    
                }
            }
        }
        return !$this->hasErrors;
    }
    
}
