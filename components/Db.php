<?php

class Db {
    
    public static function getConnection() {
        
        $paramsPath = ROOT . '/config/db_params.php';
        $params = require $paramsPath;
        
        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
        $db = new PDO($dsn, $params['user'], $params['password']);
        $db->exec('set names utf8');
        
        return $db;
    }
}
