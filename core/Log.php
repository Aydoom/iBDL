<?php 

namespace iBDL\Core;

/**
 * Description of Log
 *
 * @author Aydoom
 */
class Log {
    
    static private $fileName = false;
    
    static private function setFileName() {
        self::$fileName = LOGS . date("Y-m-d_H:i:s") . ".log";
    }
    
    static public function write($content = "") {
        if (empty(self::$fileName)) {
            self::setFileName();
        }
        $debug = debug_backtrace();
        $file = implode("/", array_slice(explode("/", $debug[1]['file']), 9));
        $content.= "\n" . $file . ':' . $debug[1]['line'] . "\n\n";

        file_put_contents(self::$fileName, $content, FILE_APPEND);
    }
    
    
}
