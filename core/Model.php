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
    
    public $modelName;
    public $data;
    
    public function __construct() {
        $this->modelName = substr(array_pop(explode("\\", get_class($this))), 0, -5);
        $this->data = filter_input(INPUT_POST, $this->modelName, FILTER_DEFAULT,
        FILTER_REQUIRE_ARRAY);
    }
    
    /**
     * 
     * @return type
     */
    public function validation() {
        $valid = new Validation();
        foreach($this->validRules as $field => $rules) {
            pr($this->data);
            $rule = $rules['rule'];
            $this->validErrors[$field] = 
                    $valid->$rule($this->data[$field], $rules);
        }
        pr($this->validRules);
        return (!empty($this->validErrors));
    }
    
}
