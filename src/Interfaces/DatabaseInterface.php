<?php
namespace Interfaces;

interface DatabaseInterface
{
    public function connect();
    public function insertData(mixed $data);
    // public function readData(); readData and deleteData are not considered in the scope of this test.
    // public function deleteData();
}