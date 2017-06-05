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
        
        return $sql;
    }
    
    static public function getFields($table, $conditions) {
        if (!empty($conditions['fields'])) {
            if (!is_array($conditions['fields'])) {
                $conditions['fields'] = [$conditions['fields']];
            }
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
        $output = [];
        foreach($conditions as $operator => $value) {
            switch ($operator) {
                case 'where':
                    $output[10] = self::getWhere($value);                    
                    break;
                case 'limit' :
                    $output[20] = "LIMIT $value";
                    break;
            }
        }
        
        return implode(" ", $output);
    }
    
    static public function getWhere($conditions) {
        $handler = function ($field, $val, $glue, $hasGlue) {
            $matches = [];
            preg_match_all('/([=!<>]+)(.+)/u', "=$val", $matches);
            $sign = (strlen($matches[1][0]) > 1) ? ltrim($matches[1][0], "=") 
                                                            : $matches[1][0];
            $echoGlue = ($hasGlue) ? strtoupper($glue) : "";
                                                            
            return " $echoGlue `$field` $sign :$field";             
        };
        
        if (is_array($conditions)) {
            $output = " WHERE ";
            
            $hasGlue = false;
            foreach($conditions as $field => $val) {
                
                if(is_array($val)) {
                    foreach($val as $f => $v) {
                        $output.= $handler($f, $v, $field, $hasGlue);
                        $hasGlue = true;
                    }
                } else {
                    $output.= $handler($field, $val, "AND", $hasGlue);
                    $hasGlue = true;
                }
            }
        } else {
            $output = NULL;
        }
        
        return $output;
    }
}
