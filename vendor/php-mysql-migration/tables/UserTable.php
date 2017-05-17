<?php 

namespace PMMigration\Tables;

class UserTable extends \PMMigration\Core\Table {
	
    public $name = 'user';
    public $fields = [];

    /**
     * 
     * @param type $name
     */
    public function __construct($name = false)
    {
        parent::__construct($name);
        
        $this->defId("id");
        $this->defId("id_user_group", false);
        $this->defVarchars(["name", "username", "email", "password", "token"]);
        $this->addField("block", "tinyint")->def("NULL");
        $this->addField("sendEmail", "tinyint")->def("NULL");
        $this->defDates(["registerDate", "lastvisitDate"]);
    }

}