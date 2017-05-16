<?php 

namespace PMMigration\Core;

use PMMigration\Core\Fields as Fields;
/**
 * 
 */
class Table {
    
    public $name = "table";
    public $fields = [];
    
    /**
     * 
     * @param type $name
     * @param type $type
     */
    public function addField($name, $type)
    {
        switch(strtolower($type)):
            case "datetime": 
                $field = new Fields\DateTimeField($name);
                break;
            default:
                $className = 'PMMigration\\Core\\Fields\\'
                    . ucfirst(strtolower($type)) . "Field";
                $field = new $className($name);
                break;
        endswitch;
        
        $this->fields[$name] = $field;
        
        return $this->fields[$name];
    }
    
    /**
     * 
     */
    public function getQuery()
    {
        foreach ($this->fields as $name => $field) {
            $fields[] = $field->getString();
            if ($field->primary) {
                $add = "PRIMARY KEY({$name})";
            }
        }
        
        $query = "CREATE TABLE `{$this->name}` (" . implode(", ", $fields);
            $query.= ($add) ? ", {$add}" : "";
        $query.=")";

        return $query;
    }
    
    /**
     * 
     * @param type $name
     */
    public function defDate($name)
    {
        $this->addField($name, "datetime");
    }
    
    /**
     * 
     * @param type $names
     */
    public function defDates($names)
    {
        foreach ($names as $name) {
            $this->defDate($name);
        }
    }
    
    /**
     * 
     * @param type $name
     * @param type $primary
     */
    public function defId($name, $primary = true)
    {
        if ($primary) {
            $this->addField($name, 'int')
                ->len(11)
                ->def('not null')
                ->autoincrement()
                ->primary_key();
        } else {
            $this->addField($name, 'int')
                ->len(11)
                ->def('not null');
        }
    }
    /**
     * 
     * @param type $name
     * @param type $primary
     */
    public function defIds($names)
    {
        foreach($names as $name) {
            $this->defId($name, false);
        }
    }
    
    /**
     * 
     */
    public function defText()
    {
        $this->addField('id', 'text')->len(512);
    }

    /**
     * 
     * @param type $name
     */
    public function defVarchar($name)
    {
        $this->addField($name, 'varchar')
                ->len(100)
                ->def('not null')
                ->compare('utf-8');
    }

    /**
     * 
     * @param type $names
     */
    public function defVarchars($names)
    {
        foreach($names as $name) {
            $this->defVarchar($name);
        }
    }
	
	public function getFields()
    {
        return $this->fields;
    }
}