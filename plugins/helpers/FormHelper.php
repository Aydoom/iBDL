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
use iBDL\Core\Router;
use \iBDL\Core\Request;
 
class FormHelper extends HtmlHelper {
    
    public $name;
    public $method;
    public $action; 
    public $post = [];
    
    public $activeModels = [];
    public $activeModel;
    
    public function __construct($models) {
        $this->activeModels = array_change_key_case($models, CASE_LOWER);
    }
    
    public function div($name, $content) {
        $class = "form-group";
        if (!empty($this->activeModel->validErrors[$name])) {
            $class.= ' has-error';
        }
        
        return parent::div($class, $content);
    }
    
    /**
     * 
     * @param type $name
     * @param type $action
     * @return type
     */
    public function create($name, $action = false) {
        $this->setName(strtolower($name));
        
        if (!array_key_exists($this->name, $this->activeModels)) {
            pr("Error from FormHelper \n the model name \"$name\" not found in controller!");
        } else {
            $this->activeModel = $this->activeModels[$this->name];
        }
        
        $this->setAction($action);
        
        $formArgs = [
            'id'    => $this->name . 'Form',
            'name'  => $this->name,
            'action'=> $this->action,
            'method'=> 'post'
        ];
        
        $this->post = filter_input(INPUT_POST, $formArgs['id'], FILTER_DEFAULT,
        FILTER_REQUIRE_ARRAY);        
        
        $this->setMethod($name);
        
        if ($this->method === 'post') {
            $hiddenMethod = null;
        } else {
            $hiddenMethod = $this->methodInput('put');
        }
        
        return $this->tag('form', $formArgs) . $hiddenMethod;
    }
    
    /**
     * 
     * @param type $name
     * @param type $value
     * @param type $args
     * @return type
     */
    public function hiddenInput($name, $value, $args = []) {
        $defArgs = [
            'type' => 'hidden', 
            'name' => "{$this->name}[$name]", 
            'value' => $value
        ];
        
        return $this->tag('input', array_merge($defArgs, $args), TAG_CLOSED);
    }
    
    /**
     * 
     * @param type $action
     */
    public function setAction($action = false) {
        $this->action = ($action) ? Router::$rootDir . $action : 
            Router::$rootDir . Router::$request;
    }
    
    /**
     * 
     * @param type $name
     */
    public function setName($name) {
        $this->name = $name;
    }
    
    /**
     * 
     * @param type $name
     */
    public function setMethod($name) {
        $this->method = (empty($this->post[$name])) ? "put" : "post";
    }
    
    /**
     *
     */
    public function input($name, $attrs = []) {
        
        $id = 'Input' . ucfirst($attrs['type']) . ucfirst($name);
        
        if (!empty($this->activeModel->validErrors[$name])) {
            $attrs['label'].= ' *' . $this->activeModel->validErrors[$name];
        }        
        
        if ($attrs['label'] === false) {
            $label = null;
        } elseif (!empty($attrs['label'])) {
            $label = $this->label($id, $attrs['label']);
        } else {
            $label = $this->label($id, ucfirst(strtolower($name)));
        }
        
        $inputAttrs = array_merge([
            'class' => 'form-control',
            'name'  => "{$this->name}[$name]",
            'value' => Request::get($this->name . "." . $name),
            'id'    => $id
        ], $attrs);
        
        if (isset($this->post[$name])) {
            $inputAttrs['value'] = $this->post[$name];
        }
        
        return $label . $this->tag('input', $inputAttrs);
    }
    
    
    /**
     * 
     * @param type $name
     * @param type $attrs
     * @return type
     */
    public function text($name, $attrs = []) {
        $content = $this->input($name, array_merge($attrs, ['type' => 'text']));
        
        return $this->div($name, $content);
    }
    
    
    /**
     *
     */
    public function password($name, $attrs = []) {
        $content = $this->input($name, array_merge($attrs, ['type' => 'password']));
        
        return $this->div($name, $content);
    }
    
    /**
     * 
     * @param type $name
     * @param type $value
     * @param type $args
     * @return type
     */
    public function methodInput($method) {
        $defArgs = [
            'type' => 'hidden', 
            'name' => "method", 
            'value' => $method
        ];
        
        return $this->tag('input', $defArgs, TAG_CLOSED);
    }
    
    /**
     * 
     * @param type $name
     * @param type $attrs
     * @return type
     */
    public function number($name, $attrs = []) {
        $content = $this->input($name, array_merge($attrs, ['type' => 'number']));
        
        return $this->div($name, $content);
    }

    /**
     * 
     * @param type $name
     * @return type
     */
    public function end($name) {
        $attrs = [
            'type'  => 'submit',
            'class' => 'btn btn-default'
        ];
        
        return $this->block("button", $name, $attrs) . $this->endTag("form");
    }
}