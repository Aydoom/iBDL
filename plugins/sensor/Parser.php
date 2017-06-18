<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace iBDL\Plugins\Sensor;
/**
 * Description of Parser
 *
 * @author Aydoom
 */
class Parser {
    
    public $content;
    
    public function __construct($filename) {
        if (file_exists($filename)) {
            $this->content = file_get_contents($filename);
        }
    }
    
    public function getSerialNumber() {
        $row = mb_substr($content, 0, mb_stripos($this->content, "\n"));
        pr($row);
    }
}
