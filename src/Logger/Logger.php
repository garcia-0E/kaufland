<?php
namespace Logger;

class Logger{
    private $logFile;
    
    public function __construct($logFile) {
        $this->logFile = $logFile;
    }
    
    public function logError($message) {
        file_put_contents($this->logFile, $message . PHP_EOL, FILE_APPEND);
    }
}