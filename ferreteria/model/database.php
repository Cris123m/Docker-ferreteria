<?php
class Database
{
    public static function StartUp()
    {
        $pdo = new PDO('mysql:host=db;port=3306;dbname=ferreteria;charset=utf8', 'leydi', 'leydi');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
}