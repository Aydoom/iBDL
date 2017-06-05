<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace iBDL\Plugins\Helpers;

/**
 * Description of PaginationHelper
 *
 * @author Aydoom
 */
class PaginationHelper extends HtmlHelper{
    
    public $models;
    public $activeModel;
    public $page;
    
    public function __construct($models) {
        $this->models = array_change_key_case($models, CASE_LOWER);
        
    }
    
    public function create($modelName) {
        $this->setActiveModel($modelName);
        
        return $this;
    }
    
    /**
     * 
     * @return type
     */
    public function items() {
        $html = "";
        for ($i = $this->page['start']; $i <= $this->page['end']; $i++) {
            if ($i === $this->page['active']) {
                $html.= $this->block('li', $this->link($i, '#'), 
                                            ['class' => "active"]);
            } else {
                $html.= $this->block('li', $this->link($i, '#'), 
                                            ['class' => "active"]);
            }
        }
        
        return $html;
    }
    
    /**
     * 
     * @param type $options
     * @return type
     */
    public function nav() {
        return $this->block('nav', $this->block('ul', 
                $this->prev() . $this->items() . $this->next(), 
                ['class' => 'pagination']));
    }
    
    /**
     * 
     * @param type $label
     * @return type
     */
    public function next($label = "&raquo;") {
        $link = $this->link($this->block('span', $label), '#', 
                                            ['aria-label' => "Next"]);
        if ($this->pages['min'] === 1) {
            $next = $this->block('li', $link, ['class' => 'disabled']);
        } else {
            $next = $this->block('li', $link);
        }
        
        return $next;
    }
    
    /**
     * 
     * @param type $name
     */
    public function setActiveModel($name) {
        $lowerName = strtolower($name);
        
        if (!array_key_exists($lowerName, $this->models)) {
            pr("Error from FormHelper \n the model name \"$name\" not found in controller!");
        } else {
            $this->activeModel = $this->models[$lowerName];
            $this->setParams();
        }

    }   
    
    /**
     * 
     * @param type $label
     * @return type
     */
    public function prev($label = "&laquo;") {
        $link = $this->link($this->block('span', $label), '#', 
                                            ['aria-label' => "Previous"]);
        if ($this->pages['max'] === $this->page['count']) {
            $prev = $this->block('li', $link, ['class' => 'disabled']);
        } else {
            $prev = $this->block('li', $link);
        }
        
        return $prev;
    }
    
    private function setParams() {
        $pageParams = $this->activeModel->behaviors['pagination'];
        //pr($pageParams);
        $this->page = [
            'left' => floor(($m->displayPages - 1) / 2),
            'right' => ceil(($m->displayPages - 1) / 2),
            'active'=> $m->activePage,
            'count' => $m->countPages,
            'freeEnd' => 0,
            'freeStart' => 0,
        ];
        
        $p = $this->page;
        $start = $p['active'] - $p['left'];
        $end = $p['active'] + $p['right'];
        
        $startFree = ($start < 1) ? 1 - $start : 0;
        $endFree = ($end > $p['count']) ? $p['active'] + $p['right'] - $p['count'] : 0;
        
        $this->page['max'] = (($end + $startFree) > $p['count']) ? $p['count'] : $end + $startFree;
        $this->page['min'] = (($start - $endFree) < 1) ? 1 : $start - $endFree; 
        
        pr($this->page);
    }
}
