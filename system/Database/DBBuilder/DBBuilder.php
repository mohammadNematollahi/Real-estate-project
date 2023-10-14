<?php

namespace System\Database\DBBuilder;

use System\Database\DBConnection\Connection;
use System\Config\Config;

class DBBuilder
{
    public function __construct()
    {
        $this->createTable();
        die("add Table successfully");
    }
    private function getMigration()
    {
        // baseUrl / database / migrations / ;
        $pathMigrations = Config::get("app.BDIR") . DIRECTORY_SEPARATOR . "database" . DIRECTORY_SEPARATOR . "migrations" . DIRECTORY_SEPARATOR;
        $allMigrations = glob($pathMigrations . "*.php");
        $oldMigrationsArray = $this->getOldMigration();
        $newMigrations = array_diff($allMigrations, $oldMigrationsArray);
        if (!empty($newMigrations)) {
            $this->putOldMigration($allMigrations);
            $MigrationsArray = [];
            foreach ($newMigrations as $newMigration) {
                $oldMigratoin = require $newMigration;
                array_push($MigrationsArray, $oldMigratoin[0]);
            }
            return $MigrationsArray;
        }
        return [];
    }

    private function getOldMigration()
    {
        $oldTable = file_get_contents(Config::get("app.BDIR") . "/system/Database/DBBuilder/oldTable.db");
        return empty($oldTable) ? [] : unserialize($oldTable);
    }

    private function putOldMigration($values)
    {
        file_put_contents(Config::get("app.BDIR") . "/system/Database/DBBuilder/oldTable.db", serialize($values));
    }
    private function createTable()
    {
        $migrations = $this->getMigration();
        foreach ($migrations as $migration) {
            $instance = Connection::DBInstanse();
            $stmt = $instance->prepare($migration);
            $stmt->execute();
        }
    }
}
