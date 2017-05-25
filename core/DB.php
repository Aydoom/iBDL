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
        $this->table = $table;
        
        $dns = 'mysql:host=' . $config['host']
                . ';port=3306;dbname=' . $config['dbname'];
        
        $options = [\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'];
        
        try {
            parent::__construct($dns, $config['user'], $config['password'], $options);
        } catch (PDOException $e) {
            die('Подключение не удалось: ' . $e->getMessage());
        }        
    }
    
    public function find($conditions = []) {
        $query = $this->prepare(Sql::getSelect($this->table, $conditions));
        $cond = (empty($conditions['where'])) ? [] : $conditions['where'];
        $query->execute($cond);

        $output = [];
        foreach ($query as $row) {
            $output[] = $row;
        }
        
        return $output;
    }
    
    public function insert($data) {
        $query = $this->prepare("INSERT INTO `" . $this->config['dbname'] . '`.`'
                    . $this->table . "` " . "("
                    . implode(", ", array_keys($data)) . ")"
                    . " VALUES(:" . implode(", :", array_keys($data)) . ")");
       
        $query->execute($data);
        if(!$query) {
            pr($this->errorInfo());
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
