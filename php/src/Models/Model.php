<?php

namespace Core\Models;


use PDO;
use Core\Config\ConfigDatabase;

/**
 * Base model
 *
 * PHP version 7.0
 */
abstract class Model
{

    /**
     * Get the PDO database connection
     *
     * @return mixed
     */
    protected static function getDB()
    {
        static $db = null;

        if ($db === null) {
            $dsn = 'mysql:host=' . ConfigDatabase::DB_HOST . ';dbname=' . ConfigDatabase::DB_NAME . ';charset=utf8';
            $db = new PDO($dsn, ConfigDatabase::DB_USER, ConfigDatabase::DB_PASSWORD);

            // Throw an Exception when an error occurs
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return $db;
    }
}