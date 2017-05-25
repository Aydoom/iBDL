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
        $options = [\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'];
        
        try {
            self::$db = new static($connect, $config['user'], 
                                                $config['password'], $options);
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
    
    static public function getUserByToken($id, $token) {
        $query = 'SELECT * FROM `user` LEFT JOIN `user_group`'
                            . ' ON id_user_group.user = id.user_group'
                            . ' WHERE user.id = ' . strval($id)
                            . ' AND user.token = ' . strval($token);

        return (self::$db->query($query));
    }
    
    static public function getUserByPsw($user, $password) {
        $query = self::$db->prepare(
            'SELECT `user`.*, `user_group`.`type` as `type_group`'
            . ' FROM `user` LEFT JOIN `user_group`'
            . ' ON `user`.`id_user_group` = `user_group`.`id`'
            . ' WHERE `user`.`name` = ?'
            . ' AND `user`.`password` = ?'
            . ' LIMIT 1');
        $query->execute([$user, md5(md5($password))]);
        
        return $query->fetchAll();
    }}