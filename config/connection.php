<?php

class Database
{

    public static $connection;
    public static function setupConnectin() {
        if (!isset(Database::$connection)) {
            Database::$connection = new mysqli("localhost", "root", "72927292", "online_store", 3306);
        }
    }

    public static function search($query){
        Database::setupConnectin();
        $rs = Database::$connection->query($query);
        return $rs;
    }

    public static function iud($query){
        Database::setupConnectin();
        $rs = Database::$connection->query($query);
    }
}
