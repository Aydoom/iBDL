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
    
    public function required($data, $rule) {
        return (empty($data)) ? $rule['message'] : null;
    }
    
    public function text($data, $rule) {
        preg_match("/[a-zA-Z,.\s]*/", $data, $matches);
        return ($data !== $matches[0]) ? $rule['message'] : null;
    }
}
