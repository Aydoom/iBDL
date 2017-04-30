<?php

namespace iBDL;

spl_autoload_register(function($class) {
    if (strpos($class, 'iBDL\\') === 0) {
        $name = substr($class, strlen('iBDL'));
		$file = __DIR__  . DIRECTORY_SEPARATOR . ".." 
				. strtolower(strtr($name, '\\', DIRECTORY_SEPARATOR) . '.php');
		
		if (!file_exists($file)) {
			echo "file not find: \n";
			pr($file);
		} else {
			require_once $file;
		}	
    }
});