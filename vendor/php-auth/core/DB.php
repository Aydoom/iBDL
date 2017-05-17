<?php 

namespace PAuth\Core;

/**
 * We need two tables in the DB:
 * 'user' from migration
 * 'user_group' from migration
 * in 'user_group' we will have two record: [1, admin], [2, user], [3, guest]
 */

class DB extends \PDO {
    
    static public $db;
    
    /**
     * Connect
    */
    static public function connect($config) {
        $connect = $config['driver'] . ':host=' . $config['host']
            . ';dbname=' . $config['dbname'];
       
        try {
            self::$db = new static($connect, $config['user'], $config['password']);
        } catch (PDOException $e) {
            die('Подключение не удалось: ' . $e->getMessage());
        }
    }
    
    static public function createUser($user, $psw, $group) {
        $query = sql_placeholder(
                'insert into user(user, password, id_user_group) values(?, ?, ?)', 
                $user, $psw, $group);
        return (self::$db->query($query));
    }
}      