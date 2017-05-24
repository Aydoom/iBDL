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
    public $config;
    
    /**
     * Constructor
     * @param type $config
     */
    public function __construct($config, $table)
    {
        $this->config = $config;
        
        $dns = 'mysql:host=' . $config['host']
                . ';port=3306;dbname=' . $config['dbname'];
        $this->table = $table;
        $options = [\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'];
        
        parent::__construct($dns, $config['user'], $config['password'], $options);
    }
    
    public function find($conditions = []) {
        $fields = (!empty($conditions['fields'])) ? 
                implode(", ", $conditions['fields']) : "*";
        
        $sql = "SELECT $fields FROM `{$this->table}`";
        $query = $this->getPrepare($sql, $conditions);
        
        $result = $this->query('SELECT ' . $fields . ' FROM `' . $this->table . 
                '` ' . $this->getCondition($conditions));
        pr([$conditions, $result, 'SELECT ' . $fields . ' FROM `' . $this->table . 
                '` ' . $this->getCondition($conditions)], false);
        $output = [];
        foreach ($result as $row) {
            $output[] = $row;
        }

        return $output;
    }
    
    public function insert($data) {
        $query = $this->prepare("INSERT INTO `" . $this->config['dbname'] . '`.`'
                    . $this->table . "` " . "("
                    . implode(", ", array_keys($data)) . ")"
                    . " VALUES(:" . implode(", :", array_keys($data)) . ")");

        try { 
            $query->execute($data);
        } catch(PDOExecption $e) { 
            pr("Error!: " . $e->getMessage());
        }

        return $this->lastInsertId();
    }
    
    public function getCondition($cond) {
        $output = [];
        foreach($cond as $operator => $value) {
            switch ($operator) {
                case 'where':
                    $condition = str_replace(
                        ['"', '"', "=", ">", "<", ">=", "<=", "!="],
                        ['', '', "`='", "`>'", "`<'", "`>='", "`<='", "`!='"],
                        trim($value));
                    $output[10] = "WHERE `$condition'";
                    break;
                case 'limit' :
                    $output[20] = "LIMIT $value";
                    break;
            }
        }
        
        return implode(" ", $output);
    }
}
