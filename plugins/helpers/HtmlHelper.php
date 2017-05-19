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
 
 
class HtmlHelper {
    
    const TAG_CLOSED = true;
    const TAG_OPENED = false;
    
    
    /**
     *
     */
    public function block($name, $content = null, $attrs = []) {
        
        $n = (strlen($content) < 25 && substr_count($content, "\n") == 0) ? "" : "\n"; 
        
        return '<' . $name . $this->getAttrString($attrs) . '>'
                    . $n . $content . $n . "</$name>\n";
    }

    /**
     *
    */
    public function getAttrString($attrs) {
        $attrStirng = "";
        foreach($attrs as $name => $val) {
            $attrStirng.= ' ' . $name . '="' . $val . '"'; 
        }
        
        return $attrStirng;
    }
    
    /**
     * 
     * @param type $files
     * @return string
     */
    public function css($files) {
        if (!is_array($files)) {
            $files = [$files];
        }

        $output = "";
        foreach($files as $file) {
            $output.= '<link rel="stylesheet" media="screen" href="'
                    . CSS . $file . '">' . "\n";
        }

        return $output;
    }
    
    /**
     *
     */
    public function div($class, $content = null, $attrs = []) {
        return '<div'
            . $this->getAttrString(array_merge($attrs, ['class' => $class]))
            . '>' . "\n" . $content . "\n" . "</div>";
    }
    
    /**
     *
     */
    public function label($for, $text) {
        return $this->block("label", $text, ['for' => $for]);
    }
    
    /**
     * 
     * @param type $text
     * @param type $url
     * @param type $params
     * @return type
     */
    public function link($text, $url, $params = []) {
        $attrs = '';
        
        if (!empty($params)) {
            foreach ($params as $arg => $val) {
                $attrs.= ' ' . $arg . '="' . $val . '"';
            }
        }

        return '<a href="' . HOME . $url . '"' . $attrs . '>' . $text . '</a>'; 
    }
    
    /**
     *
    */
    public function tag($tagName, $attrs = [], $close = TAG_OPENED) {
        $closeTag = ($close === TAG_CLOSED) ? ' /' : ' ';
        
        return '<' . $tagName . $this->getAttrString($attrs) . $closeTag . '>' . "\n";
    }
    
    /**
     *
     */
    public function endTag($tagName) {
        return "</$tagName>";
    }
    
	
}
