<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace iBDL\Core;

/**
 * Description of DB
 *
 * @author Aydoom
 */
class DB extends \PDO{

    public $table;
    /**
     * Constructor
     * @param type $config
     */
    public function __construct($config, $table)
    {
        $dns = 'mysql:host=' . $config['host']
                . ';port=3306;dbname=' . $config['dbname'];
        $this->table = $table;
        
        parent::__construct($dns, $config['user'], $config['password']);
    }
    
    public function find($conditions = []) {
        $fields = (!empty($conditions['fields'])) ? 
                implode(", ", $conditions['fields']) : "*";
        
        $query = 'SELECT ' . $fields . ' FROM ' . $this->table . 
                ' ' . $this->getCondition($conditions);
        
        pr($query);
        
        return $this->query($query);
    }
    
    public function getCondition($cond) {
        $output = [];
        foreach($cond as $operator => $value) {
            switch ($operator) {
                case 'where':
                    $output[10] = "WHERE $value";
                    break;
                case 'limit' :
                    $output[20] = "LIMIT $value";
                    break;
            }
        }
        
        return implode(" ", $output);
    }
}
