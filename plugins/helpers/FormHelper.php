<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HtmlHelpers
 *
 * @author aydoom
 */
 
namespace iBDL\Plugins\Helpers;
use iBDL\Core\Router as Router; 
 
class FormHelper extends HtmlHelper {
    
    public $name;
    public $method;
    public $action; 
    public $post = [];
    
    /**
     *
     */
    public function create($name, $action = false) {
        $this->setName($name);
        $this->setMethod($name);
        $this->setAction($action);
        
        $formArgs = [
            'id'    => $this->name . 'Form',
            'name'  => $this->name,
            'action'=> $this->action,
            'method'=> $this->method
        ];
        
        if ($this->method === 'post') {
            $hiddenMethod = null;
        } else {
            $hiddenMethod = $this->hiddenInput('method', '_put');
        }
        
        $this->post = filter_input(INPUT_POST, $formArgs['id'], FILTER_DEFAULT,
        FILTER_REQUIRE_ARRAY);
        
        return $this->tag('form', $formArgs) . $hiddenMethod;
    }
    
    /**
     *
     */
    public function hiddenInput($name, $value, $args = []) {
        $defArgs = ['type' => 'hidden', 'name' => $name];
        
        return $this->tag('input', array_merge($defArgs, $args), TAG_CLOSED);
    }
    
    /**
     *
     */
    public function setAction($action = false) {
        $this->action = ($action) ? $action : Router::$request;
    }
    
    /**
     *
     */
    public function setName($name) {
        $this->name = $name;
    }
    
    /**
     *
     */
    public function setMethod($name) {
        $this->method = (empty($_POST[$name])) ? "post" : "put";
    }
    
    /**
     *
     */
    public function input($name, $attrs = []) {
        
        $id = 'Input' . ucfirst($attrs['type']) . ucfirst($name);
        
        if ($attrs['label'] === false) {
            $label = null;
        } elseif (!empty($attrs['label'])) {
            $label = $this->label($id, $attrs['label']);
        } else {
            $label = $this->label($id, ucfirst(strtolower($name)));
        }
        
        $inputAttrs = array_merge([
            'class' => 'form-control',
            'name'  => $name,
            'id'    => $id
        ], $attrs);
        
        if (isset($this->post[$name])) {
            $inputAttrs['value'] = $this->post[$name];
        };
        
        return $label . $this->tag('input', $inputAttrs);
    }
    
    
    /**
     *
     */
    public function text($name, $attrs = []) {
        $content = $this->input($name, array_merge($attrs, ['type' => 'text']));
        
        return $this->div("form-group", $content);
    }
    
    
    /**
     *
     */
    public function password($name, $attrs = []) {
        $content = $this->input($name, array_merge($attrs, ['type' => 'password']));
        
        return $this->div("form-group", $content);
    }
    
    /**
     *
     */
    public function end($name) {
        $attrs = [
            'type'  => 'submit',
            'class' => 'btn btn-default'
        ];
        
        return $this->block("button", $name, $attrs) . $this->endTag("form");
    }
}