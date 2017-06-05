<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace iBDL\Core;
use iBDL\Core\DB;

/**
 * Description of Behavior
 *
 * @author Angel
 */
class Behavior {
    
    
    public function beforeFind($conditions = []) {
        
        return $conditions;
    }
    
    public function afterFind($result) {
        
        return $result;
    }
    
    public function save($conditions) {
        
        return $conditions;
    }
    
    public function update($conditions) {
        
        return $conditions;
    }
    
    public function delete($conditions) {
         
        return $conditions;
   }
}
