<?php

namespace App\Core;

use PDO;
use PDOException;

class Model
{
    protected static ?PDO $pdo = null;

    public function __construct()
    {
        if (!self::$pdo) {
            self::$pdo = $this->getConnection();
        }
    }

    protected function getConnection(): PDO
    {
        $dbHost = config('database.host');
        $dbUser = config('database.user');
        $dbPass = config('database.pass');
        $dbName = config('database.name');

        try {
            return new PDO(
                "mysql:dbname=$dbName;host=$dbHost",
                $dbUser,
                $dbPass,
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
        } catch (PDOException $e) {
            exit('Connection failed: ' . $e->getMessage());
        }
    }

    protected static function prepare(string $sql)
    {
        self::ensureConnection();
        return self::$pdo->prepare($sql);
    }

    protected static function query(string $sql)
    {
        self::ensureConnection();
        return self::$pdo->query($sql);
    }

    protected static function lastInsertId()
    {
        self::ensureConnection();
        return self::$pdo->lastInsertId();
    }

    protected static function ensureConnection(): void
    {
        if (!self::$pdo) {
            new static();
        }
    }
}
