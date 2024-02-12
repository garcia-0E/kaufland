<?php
namespace Database;

use Exception;
use SQLite3;
use \Interfaces\DatabaseInterface;
use Throwable;

class SQLite implements DatabaseInterface
{
    private $db;
    private $dbName;
    private \Logger\Logger $logger;

    public function __construct($dbName, $logger)
    {
        $this->dbName = $dbName;
        $this->logger = $logger;
    }

    public function connect()
    {
        try{
            $this->db = new SQLite3($this->dbName);
            $this->db->enableExceptions(true);
        } catch (Throwable $e) {
            $this->logger->logError("[SQLite] " . $e);
        }
    }

    public function insertData(mixed $data)
    {
        /**
         * Each insert will be made atomically, in terms of loads it's more efficient than parsing a bulk payload for the database.
         */
        try{ 
            $this->db->enableExceptions(true);
            foreach($data as $item){
                $query = $this->prepareData($item);
                // I considered using SQLite bind params but I thought that it would have been harder to maintain and scale if new params were added to the code
                $query->execute();
            }
            return true;
        } catch (Throwable $e) {
            $this->logger->logError("[SQLite] " . $e);
            throw new Exception("[SQLite] " . $e);
        }
    } 

    private function prepareData($item){
        /**
         * This function is designed to handle magic characters, double quotes, and proper SQL parsing.
         * 
         */
        $query = $this->db->prepare("insert into items 
                values (?, ?, ?, ?,
                        ?, ?, ?, ?,
                        ?, ?, ?, ?,
                        ?, ?, ?, ?,
                        ?,?)");
        foreach ($item as $key => $value) {
            if (gettype($value) == "string" || empty($value) || str_starts_with($value, "http")){
                $query->bindValue($key + 1, $value, SQLITE3_TEXT);
            } else {
                $query->bindValue($key + 1, $value, SQLITE3_NUM);
            }
        }
        return $query;
    }
}