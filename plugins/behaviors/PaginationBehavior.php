<?php

/**
 * Description of PaginationBehaviors
 *
 * @author Aydoom
 */
 
namespace iBDL\Plugins\Behaviors;
use iBDL\Core\DB;


class PaginationBehavior extends \iBDL\Core\Behavior {
    
    public $countItems;
    public $countPages;
    public $display = 5;
    public $active;
    
    public $min;
    public $max;

    public $model;
    
    public function __construct($model, $options = []) {
        $this->active = $options['page'];
        $this->model = $model;
    }
    
    public function beforeFind($conditions = array()) {
        $this->countItems = $this->getCount($conditions);
        $this->countPages = ceil ($this->countItems/ $this->display);
        $this->init();
        $newConditions = array_merge($conditions, [
            'limit' => ($this->active - 1) * $this->display . ", " . $this->display
        ]);

        return $newConditions;
    }
    
    public function getCount($conditions) {
        $db = new DB(config(), strtolower($this->model->modelName));
        $output = $db->count($conditions);
        
        return $output;
    }
    
    public function init() {
        $leftItems = floor(($this->display - 1) / 2);
        $rightItems = ceil(($this->display - 1) / 2);

        $freeLeft = 0;
        $freeRight = 0;
        
        $start = $this->active - $leftItems;
        $end = $this->active + $rightItems;
        
        $startFree = ($start < 1) ? 1 - $start : 0;
        
        if  ($end > $this->countPages) {
            $free = ceil(($this->active + $rightItems) / $this->display) - $this->countPages;
            $endFree = ($free > 0) ? $free : 0;
        }

        $this->max = (($end + $startFree) > $this->countPages) ? $this->countPages : $end + $startFree;
        $this->min = (($start - $endFree) < 1) ? 1 : $start - $endFree; 
    }
}























