<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace iBDL\Plugins\Helpers;
use iBDL\Core\App;

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
        for ($i = $this->page->min; $i <= $this->page->max; $i++) {
            if ($i == $this->page->active) {
                $html.= $this->block('li', $this->link($i, '#'), 
                                            ['class' => "active"]);
            } else {
                $html.= $this->block('li', $this->link($i, App::$actionUri . $i));
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
        $uri = $this->page->active + 1;
        $link = $this->link($this->block('span', $label), 
                    App::$actionUri . $uri, 
                    ['aria-label' => "Next"]);
                    
        if ($this->page->active == $this->page->max) {
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
            $this->page = $this->activeModel->behaviors['pagination'];
        }

    }   
    
    /**
     * 
     * @param type $label
     * @return type
     */
    public function prev($label = "&laquo;") {
        $uri = $this->page->active - 1;
        $link = $this->link($this->block('span', $label),
                App::$actionUri . $uri, 
               ['aria-label' => "Previous"]);
               
        if ($this->page->min == $this->page->active) {
            $prev = $this->block('li', $link, ['class' => 'disabled']);
        } else {
             $prev = $this->block('li', $link);
        }
        
        return $prev;
    }
}













