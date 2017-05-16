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
     * @param type $text
     * @param type $url
     * @param type $params
     * @return type
     */
    public function link($text, $url, $params = []) {
        $args = '';
        
        if (!empty($params)) {
            foreach ($params as $arg => $val) {
                $args.= ' ' . $arg . '="' . $val . '"';
            }
        }

        return '<a href="' . HOME . $url . '"' . $args . '>' . $text . '</a>'; 
    }
	
}
