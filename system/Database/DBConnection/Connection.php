<?php

namespace System\Database\DBConnection;

use PDO;
use PDOException;
use System\Config\Config;

class Connection
{
    private static $connectionDBInstance = null;
    private function __construct()
    {
    }
    public static function DBInstanse()
    {
        if (self::$connectionDBInstance == null) {
            $ObjInstance = new Connection();
            self::$connectionDBInstance = $ObjInstance->Connection();
        }
        return self::$connectionDBInstance;
    }

    private function Connection()
    {
        try {
            $option = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            );
            return new PDO("mysql:host=" . Config::get("database.HOST") . ";dbname=" . Config::get("database.DB_NAME"), Config::get("database.USERNAME"), Config::get("database.PASSWORD_DB"), $option);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public static function lastInsert()
    {
        return self::DBInstanse()->lastInsertId();
    }
}
