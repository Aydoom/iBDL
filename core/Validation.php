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
 * @author Angel
 */
class Validation {
    
    public function text($data, $rule) {
        pr($data);
        preg_match("/[a-zA-Z,.\s]*/", $data, $matches);
        pr($matches);
    }
}
