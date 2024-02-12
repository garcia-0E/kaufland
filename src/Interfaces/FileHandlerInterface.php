<?php
namespace Interfaces;
use \Logger\Logger;

/**
 * 
 * Describes the function that's going to be used by every implementation according the file type
 * 
 */

interface FileHandlerInterface
{
    function readFile(Logger $logger): mixed;    
}