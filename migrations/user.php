<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace iBDL\Migrations;

use \iBDL\Core;

/**
 * Description of user
 *
 * @author Aydoom
 */
class user extends Core\migration {
    
    public function create()
    {
        $this->addField("id", "INT", "NOT NULL");
        $this->addField("id_user_group", "INT", "NOT NULL");
        $this->addField("name", "VARCHAR(100)", "NOT NULL");
        $this->addField("username", "VARCHAR(100)", "NOT NULL");
        $this->addField("email", "VARCHAR(100)", "NOT NULL");
        $this->addField("password", "VARCHAR(100)", "NOT NULL");
        $this->addField("block", "tinyint(4)", "NULL");
        $this->addField("sendEmail", "tinyint(4)", "NULL");
        $this->addField("registerDate", "datetime");
        $this->addField("lastvisitDate", "datetime");
        
        $this->primary_key = "id";
        
        $this->createTable();
    }
    /**CREATE TABLE  `tests` (`id` INT NOT NULL ,`test` VARCHAR( 100 ) 
            CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , PRIMARY KEY (  `id` ))"*/
}
