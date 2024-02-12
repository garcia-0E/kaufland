<?php
require './autoload.php';
require_once __DIR__ . '\src/main.php';
/**
 * An issue with the PHPUnit configuration forced me to do a manual approach regard testings, the coverage described below consists in: 
 * [X] Create a file handler based in the file extension.
 * [X] Define a new database connection
 * [X] Read and parse the data
 * [X] Insert the data into the database.
 * 
 * Instructions:
 * 
 * Executing php .\test.php will execute a complete flow of the system and insert all the records in feed.xml in a SQLite3 Database.
 */

use Handlers\FileHandlerFactory;
use Database\SQLite;
use Logger\Logger;
use Main\Main;

$fileDir = "feed.xml";

$logger = new Logger("error.log");
$handler = new FileHandlerFactory();
$database = new SQLite("kaufland.db", $logger);
$fileHandler = $handler->createHandler($fileDir);


$sys = new Main($database, $logger, $fileHandler);
$sys->processFile($fileDir);

