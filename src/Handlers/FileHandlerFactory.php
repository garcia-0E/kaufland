<?php
namespace Handlers;

use \Interfaces\FileHandlerInterface;

class FileHandlerFactory
{
    public function createHandler($file): FileHandlerInterface
    {
        $filePath = pathinfo($file);
        switch ($filePath['extension']) {
            case 'json':
                return new JSONHandler($file);
            case 'xml':
                return new XMLHandler($file);
            default:
                throw new InvalidArgumentException("[File Handler Factory] ]Unsupported file type: {$filePath['extension']}");
        }
    }
}