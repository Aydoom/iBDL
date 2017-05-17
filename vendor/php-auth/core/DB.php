<?php 

namespace PAuth\Core;

class DB extends \PDO {
    
    static public $db;
    
    /**
     * Connect
    */
    static public function connect($config) {
        $connect = $config['driver'] . ':host=' . $config['host']
            