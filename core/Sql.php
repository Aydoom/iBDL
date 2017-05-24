<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace iBDL\Core;

/**
 * Description of SQL
 *
 * @author Aydoom
 */
class Sql {

    static public function getSelect($table, $conditions = []) {
        $sql = 'SELECT ' . self::getFields($table, $conditions)
                                                    . ' FROM `' . $table . '`';
        
        $sql.= self::getConditions($conditions);
    }
    
    static public function getFields($table, $conditions) {
        if (!empty($conditions['fields'])) {
            foreach($conditions['fields'] as &$field) {
                $field = "`$table`.`$field`";
            }
            
            $fields = implode(", ", $conditions['fields']);
        } else {
            $fields = "*";
        }
        
        return $fields;
    }
    
    static public function getConditions($conditions) {
        foreach($cond as $operator => $value) {
            switch ($operator) {
                case 'where':
                    $output[10] = "WHERE " . self::getWhere($value);                    
                    break;
                case 'limit' :
                    $output[20] = "LIMIT $value";
                    break;
            }
        }
        
        return implode(" ", $output);
    }
}
