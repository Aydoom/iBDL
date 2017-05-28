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
    
    public $lastId;
    
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
        return strtolower($this->modelName) . "Form." . $name;
    }
    
    public function hasCustomRule($name) {
        return (in_array($name, get_class_methods($this)));
    }
    
    public function find($conditions = []) {
        $db = new DB(config(), strtolower($this->modelName));
        
        return $db->find($conditions);
    }
    
    public function loadModel($modelName) {
        $className = 'iBDL\\App\\Model\\' . ucfirst($modelName) . "Model";
        $this->models[$modelName] = new $className();
        
        return $this->models[$modelName];
    }
    
    public function save($data) {
        $db = new DB(config(), strtolower($this->modelName));

        $this->lastId = $db->insert($data);
        return (!empty($this->lastId));
    }
    
    /**
     * 
     * @return type
     */
    public function validation() {
        foreach($this->validRules as $field => $rules) {
            $fieldName = $this->getFieldName($field);            
            if (!is_array($rules)) {
                $rules = [$rules];
            }
            
            if (!Request::has($fieldName)) {
                continue;
            } else {
                $this->validErrors[$field] = $this->validationRun($rules, 
                                            Request::get($fieldName), $field);
            }
        }
        $this->hasErrors = !empty($this->validErrors);
        return !$this->hasErrors;
    }
    
    private function validationRun($rules, $data, $field) {
        $valid = new Validation($this);
        $validRules = $valid->getListRules(); 
        $errors = [];
        foreach($rules as $rule) {
            $ruleName = $rule['rule'];
            if (substr_count($ruleName, "::") === 1) {
                $names = explode("::", $ruleName);
                $extRuleName = $names[1];
                $valid->extention($names[0])->$extRuleName($data, $rule, $field);                
            } elseif (in_array($ruleName, $validRules)) {
                $errors[] = $valid->$ruleName($data, $rule, $field);
            } elseif ($this->hasCustomRule($ruleName)) {
                $errors[] = $this->$ruleName($data, $rule, $field);
            } else {
                pr("$ruleName in the model \"{$this->modelName}\" not exists");
            }
        }
        
        return array_values(array_diff($errors, [null]));
    }
}
