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
    
	
	public function css($files) {
		
		if (!is_array($files)) {
		
			$files = [$files];
		
		}
		
		$output = "";
		
		foreach($files as $file) {
		
			$output.= '<link rel="stylesheet" media="screen" href="' . CSS . $file . '">' . "\n";
		
		}
		
		return $output;
		
	}
	
	
	
	public function link($text, $url, $params = []) {
	
		$class = '';
		
		if (isset($params['actUrl']) && $params['actUrl'] == $url) {
			
			$class.= ' active';
			
		}
		
		if (empty($class)) {
			
			$class = '';
			
		} else {
			
			$class = ' class="' . $class . '" ';
			
		}
		
		return '<a href="' . HOME . $url . '"' . $class . '>' . $text . '</a>'; 
	
	}
	
}
