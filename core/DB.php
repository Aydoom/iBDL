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
class DB extends PDO{


    /**
     * Constructor
     * @param type $config
     */
    public function __construct($config)
    {
        $dns = 'mysql:host=' . $config['host']
                . ';port=3306;dbname=' . $config['dbname'];
        
        parent::__construct($dns, $config['user'], $config['password']);
    }
}
