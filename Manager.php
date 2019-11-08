<?php  

namespace Cornelissen\Blog\Model;

class Manager
{
    protected function dbConnect()
    {
        $db = new \PDO('mysql:host=cornelisganoumea.mysql.db;dbname=cornelisganoumea;charset=utf8', 'cornelisganoumea', 'Rugbydu81');
        return $db;
    }
}
