<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace iBDL\Core;

/**
 * Description of migration
 *
 * @author Angel
 */
class migration {
    
    public $pdo;
    public $table_name;
    
    public $fields = [];
    public $primary_key;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pdo = new DB(config());
        $this->table_name = array_pop(explode("\\", get_class($this)));
    }
    
    /**
     * Function to add the field in table bd before it created
     * 
     * @param type $name
     * @param type $type
     * @param type $default
     */
    public function addField($name, $type, $default = false)
    {
        $field = "`$name` $type";
        if ($default) {
            $field.=" $default";
        }
        
        $this->fields[] = $field;
    }
    
    /**
     * function createTable()
     */
    public function createTable()
    {
        $sql = "CREATE TABLE  `" . $this->table_name
                . "` (" . implode(" ,", $this->fields);
        if ($this->primary_key) {
            $sql.= " , PRIMARY KEY (  `" . $this->primary_key . "` ))";
        } else {
            $sql.= ")";
        }
        
        $this->pdo->query($sql);
    }
}
