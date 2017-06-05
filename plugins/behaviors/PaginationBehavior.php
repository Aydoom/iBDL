<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PaginationBehaviors
 *
 * @author Aydoom
 */
 
namespace iBDL\Plugins\Behaviors;
use iBDL\Core\DB;


class PaginationBehavior extends \iBDL\Core\Behavior {
    
    public $count;
    public $display = 5;
    public $items;
    public $active;
    
    public $model;
    
    public function __construct($model, $options = []) {
        $this->active = $options['page'];
        $this->model = $model;
    }
    
    public function beforeFind($conditions = array()) {
        $this->count = $this->getCount($conditions);
        $newConditions = array_merge($conditions, [
            'limit' => ($this->active - 1) * $this->display . ", " . $this->display
        ]);

        return $newConditions;
    }
    
    public function getCount($conditions) {
        $db = new DB(config(), strtolower($this->model->modelName));
        
        return $db->count($conditions);
    }
}
