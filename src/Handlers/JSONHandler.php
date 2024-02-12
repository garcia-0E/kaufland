<?php
namespace Handlers;

use \Logger\Logger;

class JSONHandler implements FileHandlerInterface
{
    private $file;

    public function __construct(mixed $file) {
        $this->file = $file;
    }

    public function readFile(Logger $logger): mixed
    {
        //
    }
}
