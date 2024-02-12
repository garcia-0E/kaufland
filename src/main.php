<?php
namespace Main;

use \Interfaces\DatabaseInterface;
use \Logger\Logger;
use Interfaces\FileHandlerInterface;

class Main
{
    private $database;
    private $logger;
    private $fileHandler;

    public function __construct(DatabaseInterface $database, Logger $logger, FileHandlerInterface $fileHandler)
    {
        $this->database = $database;
        $this->logger = $logger;
        $this->fileHandler = $fileHandler;
    }

    public function processFile($file)
    {
        try {
            $this->database->connect();
            $data = $this->fileHandler->readFile($this->logger);
            if (!$data)
                throw new Exception("The file is empty.");
            $this->database->insertData($data); 
            echo "All records succesfully inserted.";
        } catch (\Exception $e) {
            echo "An error happened, please check error.log";
            $this->logger->logError("[Main] " . $e->getMessage());
        }
    }
}