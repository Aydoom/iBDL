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
    
    /**
     * Constructor
     * @param type $models
     */
    public function __construct($models) {
        $this->activeModels = array_change_key_case($models, CASE_LOWER);
    }
    
    /**
     * 
     * @param type $name
     * @param type $action
     * @return type
     */
    public function create($name, $action = false, $args = []) {
        $this->setNames($name);
        $this->setAction($action);
        
        $formArgs = array_merge([
            'id'    => $this->name,
            'name'  => $this->name,
            'action'=> $this->action,
            'method'=> 'post'
        ], $args);
        
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
     * @param type $content
     * @return type
     */
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
     * @param type $attrs
     * @return type
     */
    public function file($name, $attrs = []) {
        $inputAttrs = array_merge([
            'class' => false,
            'type' => 'file',
        ], $attrs);
        
        return $this->div($name, $this->input($name, $inputAttrs));
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
     * @param type $name
     * @param type $attrs
     * @return type
     */
    public function input($name, $attrs = []) {
        
        $id = 'Input' . ucfirst($attrs['type']) . ucfirst($name);
        
        if (substr_count($name, "[]") === 1) {
            $clearName = "{$this->name}[" . trim($name, "[]") . "][]";
        } else {
            $clearName = "{$this->name}[$name]";
        }
        
        $inputAttrs = array_merge([
            'class' => 'form-control',
            'name'  => $clearName,
            'value' => Request::get($this->name . "." . $name),
            'id'    => $id
        ], $attrs);

        unset($inputAttrs['label']);
        
        if (isset($this->post[$name])) {
            $inputAttrs['value'] = $this->post[$name];
        }
        
        return $this->label($id, $name, $attrs['label'])
                . $this->tag('input', $inputAttrs);
    }
    
    /**
     * 
     * @param type $id
     * @param type $name
     * @param type $text
     * @return type
     */
    public function label($id, $name, $text) {
        $model = $this->activeModel;
        if(isset($model->validRules[$name])) {
            foreach ($model->validRules[$name] as $rule) {
                if($rule['rule'] === 'required') {
                    $text.= "*";
                    break;
                }
            }
        }
        //pr([$name, $model->validErrors], false);

        if (!empty($model->validErrors[$name])) {
            $text.= $this->block("small", " - " . $model->validErrors[$name][0]);
        }
        
        if ($text === false) {
            $label = null;
        } elseif (!empty($text)) {
            $label = parent::label($id, $text);
        } else {
            $label = parent::label($id, ucfirst(strtolower($name)));
        }
        
        return $label;
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
     * @param type $attrs
     * @return type
     */
    public function password($name, $attrs = []) {
        $content = $this->input($name, array_merge($attrs, ['type' => 'password']));
        
        return $this->div($name, $content);
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
    public function setMethod($name) {
        $this->method = (empty($this->post[$name]['id'])) ? "put" : "post";
    }
    
    /**
     * 
     * @param type $name
     */
    public function setNames($name) {
        $lowerName = strtolower($name);
        
        if (!array_key_exists($lowerName, $this->activeModels)) {
            pr("Error from FormHelper \n the model name \"$name\" not found in controller!");
        } else {
            $this->activeModel = $this->activeModels[$lowerName];
        }

        $this->name = $lowerName . 'Form';
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
}