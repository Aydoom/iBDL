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
        $this->models = $models;
    }
    
    public function create($modelName) {
        if (in_array($modelName, $this->models)) {
            $m = $this->activeModel = $modelName;
            $this->page = [
                'left' => floor(($m->countPages - 1) / 2),
                'right' => ceil(($m->countPages - 1) / 2),
                'active'=> $m->activePage,
                'count' => ($m->countPages > $m->displayPages) ? $m->displayPages :
                                                                    $m->countPages,
                'freeEnd' => 0,
                'freeStart' => 0,
            ];
        } else {
            pr('Не найдена модель ' . $modelName . ' для пагинатора');
        }
    }
    
    /**
     * 
     * @param type $options
     * @return type
     */
    public function nav($options = []) {
        $prev = $this->block('li', $this->prev($options['prev']));
        $count = "";
        
        if ($this->page['active'] - $this->page['left'] < 1) {
            $start = 1;
            $this->page['freeEnd'] = $this->page['left'] - $this->page['active'];
        } 
        if ($this->page['active'] + $this->page['right'] > $this->page['count']) {
            $end = $this->page['count'];
            $this->page['freeStart'] = $this->page['right'] - $this->page['active'];
        }
        
        if ($start-= $this->page['freeStart'] < 1) {
            $start = 1;
        }
        if ($end+= $this->page['freeStart'] > $this->page['count']) {
            $end = $this->page['count'];
        }
        
        for ($number = $start; $number <= $end; $number++) {
            $count.= $this->block('li', $this->page($number));
        }

        $next = $this->block('li', $this->next($options['next']));
        
        return $this->block('nav', $this->block('ul', $prev . $count . $next));
    }
    
    /**
     * 
     * @param type $label
     * @return type
     */
    public function next($label = "&raquo;") {
        return $this->link($this->block('span', $label), '#', 
                                            ['aria-label' => "Next"]);        
    }
    
    /**
     * 
     * @param type $number
     * @return type
     */
    public function page($number) {
        return $this->link($number, '#');   
    }
    
    /**
     * 
     * @param type $label
     * @return type
     */
    public function prev($label = "&laquo;") {
        return $this->link($this->block('span', $label), '#', 
                                            ['aria-label' => "Previous"]);
    }
    
}
