<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace iBDL\Core;

/**
 * Description of Validation
 *
 * @author Aydoom
 */
class Validation {
    
    public $model;
    
    public function __construct($model) {
        $this->model = $model;
    }
    
    public function equal($data, $rule) {
        $message = ($rule['message']) ? $rule['message'] :
                    'it must does match with "' . $rule['field'] . '"';
        $dataForEqual = strtolower($this->model->modelName)
                            . 'Form.' . $rule['field'];

        return ($data == Request::get($dataForEqual)) ? null : $message;        
    }
    
    public function numbers($data, $rule) {
        preg_match("/[0-9]*/u", $data, $matches);
        $message = ($rule['message']) ? $rule['message'] :
                    'it must be only numbers';
        
        return ($data !== $matches[0]) ? $message : null;
    }
    
    /**
     * 
     * @param type $data
     * @param type $rule
     * @return type
     */
    public function lenght($data, $rule) {
        $len = mb_strlen($data);
        $min = (empty($rule['min'])) ? 3 : $rule['min'];
        $max = (empty($rule['max'])) ? 10 : $rule['max'];
        
        $message = ($rule['message']) ? $rule['message'] :
                    'length is must be between '
                    . $min . " - " . $max;
        
        return ($len >= $min && $len <= $max) ? null : $message;
    }
    
    public function required($data, $rule) {
        return (empty($data)) ? $rule['message'] : null;
    }
    
    public function text($data, $rule) {
        preg_match("/[a-zA-Zа-яА-ЯЁё,.\s]*/u", $data, $matches);

        return ($data !== $matches[0]) ? $rule['message'] : null;
    }
    
    public function unique($data, $rule, $field) {
        $message = ($rule['message']) ? $rule['message'] :
            'it must be unique';
        $result = $this->model->find([
            'where' => "$field=\"$data\"",
            'limit' => 1]);
            
        return (empty($result)) ? null : $message;
    }
}
