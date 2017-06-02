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
    
    public $displayPages = 5;
    public $countPages;
    public $pages = false;
    public $activePage = 1;


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
    
    /**
     * 
     * @param type $name
     * @return type
     */
    public function hasCustomRule($name) {
        return (in_array($name, get_class_methods($this)));
    }
    
    /**
     * 
     * @param type $conditions
     * @return type
     */
    public function find($conditions = []) {
        $db = new DB(config(), strtolower($this->modelName));
        
        if (isset($conditions['page']) && $this->pages) {
            $page = $conditions['page'];
            unset($conditions['page']);
            
            $this->countPages = $db->find(
                    array_merge($conditions, ['fields' => 'COUNT(id)']));
            
            $this->activePage = $page;
            $conditions['limit'] = 
                    ($page - 1) * $this->pages . ', ' . $this->pages;
            
        }
        
        return $db->find($conditions);
    }
    
    /**
     * 
     * @param type $modelName
     * @return type
     */
    public function loadModel($modelName) {
        $className = 'iBDL\\App\\Model\\' . ucfirst($modelName) . "Model";
        $this->models[$modelName] = new $className();
        
        return $this->models[$modelName];
    }
    
    /**
     * 
     * @param type $data
     * @return type
     */
    public function save($data) {
        $db = new DB(config(), strtolower($this->modelName));

        $this->lastId = $db->insert($data);
        return (!empty($this->lastId));
    }
    
    public function usePagination($countPages = 10) {
        $this->pages = $countPages;
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
            
            $this->validErrors[$field] = $this->validationRun($rules, 
                                            Request::get($fieldName), $field);
        }

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
                $error = $valid->on($ruleName, $data, $rule, $field);
            } elseif ($this->hasCustomRule($ruleName)) {
                $error = $this->$ruleName($data, $rule, $field);
            } else {
                //pr("$ruleName in the model \"{$this->modelName}\" not exists");
            }
            
            if($error !== Null) {
                $errors[] = $error;
                $this->hasErrors = true;
            }
        }

        return $errors;
    }
}
