<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace PMMigration\Tables;

/**
 * Description of SessionTable
 *
 * @author Aydoom
 */
class SessionTable {
	
    public $name = 'session';
    public $fields = [];

    /**
     * 
     * @param type $name
     */
    public function __construct($name = false)
    {
        if ($name) {
            $this->name = $name;
        }
        
        $this->defId("id");
        $this->defId("id_user");
        $this->defVarchars(["name"])->def("NOT NULL");
        $this->addField("trash", "tinyint")->def("NULL");
        $this->defDates(["registerDate", "trashDate"]);
    }
}
