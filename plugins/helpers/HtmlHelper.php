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
     * @param type $name
     * @param type $content
     * @param type $attrs
     * @return type
     */
    public function block($name, $content = null, $attrs = []) {
        
        $n = (strlen($content) < 25 && substr_count($content, "\n") == 0) ? "" : "\n"; 
        
        return '<' . $name . $this->getAttrString($attrs) . '>'
                    . $n . $content . $n . "</$name>\n";
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
     * @param type $class
     * @param type $content
     * @param type $attrs
     * @return type
     */
    public function div($class, $content = null, $attrs = []) {
        $divAttrs = array_merge($attrs, ['class' => $class]);
        
        return $this->block("div", $content, $divAttrs);
    }
    
    /**
     * 
     * @param type $tagName
     * @return type
     */
    public function endTag($tagName) {
        return "</$tagName>";
    }

    /**
     * 
     * @param type $attrs
     * @return string
     */
    public function getAttrString($attrs) {
        $attrStirng = "";
        foreach($attrs as $name => $val) {
            if (is_int($name)) {
                $attrStirng.= " $val ";
            } elseif ($val === false) {
                continue;
            } else {
                $attrStirng.= ' ' . $name . '="' . $val . '"'; 
            }
        }
        
        return $attrStirng;
    }
    
    /**
     * 
     * @param type $for
     * @param type $text
     * @return type
     */
    public function label($for, $text) {
        return $this->block("label", $text, ['for' => $for]);
    }
    
    /**
     * 
     * @param type $text
     * @param type $url
     * @param type $attrs
     * @return type
     */
    public function link($text, $url, $attrs = []) {
        $linkAttrs = array_merge(['href' => HOME . $url], $attrs);

        return $this->block("a", $text, $linkAttrs); 
    }
    
    /**
     * 
     * @param type $tagName
     * @param type $attrs
     * @param type $close
     * @return type
     */
    public function tag($tagName, $attrs = [], $close = TAG_CLOSED) {
        $closeTag = ($close !== TAG_OPENED) ? ' /' : ' ';
        
        return '<' . $tagName . $this->getAttrString($attrs) . $closeTag . '>' . "\n";
    }
}
