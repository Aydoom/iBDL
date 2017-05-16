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
        if ($name) {
            $this->name = $name;
        }
        
        $this->defId("id");
        $this->defId("id_user_group", false);
        $this->defVarchars(["name", "username", "email", "password"]);
        $this->addField("block", "tinyint")->def("NULL");
        $this->addField("sendEmail", "tinyint")->def("NULL");
        $this->defDates(["registerDate", "lastvisitDate"]);
    }

}