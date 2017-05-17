<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace PMMigration\Tables;

/**
 * Description of UserGroupTable
 *
 * @author Aydoom
 */
class UserGroupTable extends \PMMigration\Core\Table {
	
    public $name = 'user_group';
    public $fields = [];

    /**
     * 
     * @param type $name
     */
    public function __construct($name = false)
    {
        parent::__construct($name);
        
        $this->defId("id");
        $this->addField("type", "varchar")->len("10");
    }

}
