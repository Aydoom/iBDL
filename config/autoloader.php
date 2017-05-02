<?php

namespace iBDL;

spl_autoload_register(function($class) {
	
    if (strpos($class, 'iBDL\\') === 0) {
		
		$parts = explode("\\", rtrim($class, "\\"));
		
		$className = array_pop($parts);
		
        $name = substr(implode(DIRECTORY_SEPARATOR, $parts), strlen('iBDL'));
		
        $file = __DIR__  . DIRECTORY_SEPARATOR . ".." 
                . strtolower($name . DIRECTORY_SEPARATOR) . $className . '.php';
		

        if (!file_exists($file)) {
            echo "file not find: \n";
			pr($file);
        } else {
            require_once $file;
        }	
    }
});