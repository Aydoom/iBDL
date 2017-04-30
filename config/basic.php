<?php

function pr($array, $end = true)
{
	if (!is_object($array)) {
		if (!is_array($array)) {
			$array = htmlspecialchars($array);
		} else {
			foreach ($array as $key => $str) {
				if (!is_array($str)) {
					$array[$key] = htmlspecialchars($str);
				}
			}
		}
	}
	
	echo "<pre>";
		print_r($array);
	echo "</pre>";
	if ($end) {
		die();
	}
}