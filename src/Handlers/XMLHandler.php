<?php
namespace Handlers;

use \Interfaces\FileHandlerInterface;
use \Logger\Logger;

class XMLHandler implements FileHandlerInterface
{
    private $file; 

    public function __construct(mixed $file) {
        $this->file = $file;
    }

    public function readFile(Logger $logger): mixed
    {
        try{
            $companies = simplexml_load_file($this->file);
            if ($companies === false) {
                // Failed to load XML file
                throw new Exception("Failed to load XML file: $this->file");
            }
            $parsedData = [];
            foreach ($companies->children() as $item) {
                $parsedItem = [
                    (string)$item->entity_id ,
                    (string)$item->CategoryName,
                    (int)$item->sku,
                    (string) $item->name,
                    (string)$item->description,
                    (string)$item->shortdesc,
                    (float)$item->price,
                    (string)$item->link,
                    (string)$item->image,
                    (string)$item->Brand,
                    (int)$item->Rating,
                    (string)$item->CaffeineType,
                    (int)$item->Count,
                    (string) $item->Flavored,
                    (string)$item->Seasonal,
                    (string)$item->Instock,
                    (int)$item->Facebook,
                    (int)$item->IsKCup 
                ];
                array_push($parsedData, $parsedItem);
            }
            return $parsedData;
        } catch (Exception $e){
            $logger->logError('[XML Hander] '. $e);
        }
    }
}