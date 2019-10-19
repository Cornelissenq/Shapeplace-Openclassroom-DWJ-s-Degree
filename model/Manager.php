<?php  

namespace Cornelissen\Shapeplace\Model;

class Manager
{
    protected function dbConnect()
    {
        $db = new \PDO('mysql:host=localhost;dbname=shapeplace;charset=utf8', 'root', '');
        return $db;
    }
}
