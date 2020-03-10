<?php
namespace Engine;

class DB {
    static $db = null;
    static function getDB(){
        $options = [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION];
        if(self::$db == null){
            self::$db = new \PDO("mysql:host=localhost;dbname=2019_chungnam_c1;charset=utf8mb4", "root", "", $options);
        }
        return self::$db;
    }

    static function query($sql, $data = []){
        $q = self::getDB()->prepare($sql);
        $q->execute($data);
        return $q;
    }

    static function fetch($sql, $data = [], $fetchMode = \PDO::FETCH_OBJ){
        return self::query($sql, $data)->fetch($fetchMode);
    }
    static function fetchAll($sql, $data = [], $fetchMode = \PDO::FETCH_OBJ){
        return self::query($sql, $data)->fetchAll($fetchMode);
    }

}