<?php

class Database{
    public static function conexion(){
        $db = new mysqli('localhost', 'root', '', 'bdMijoStore');
        $db->query("SET NAMES 'utf8'");
        return $db;
    }
}