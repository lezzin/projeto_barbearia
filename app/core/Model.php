<?php

namespace App\Core;

use PDO;
use PDOException;

class Model
{
    protected string $db_host = DB_HOST;
    protected string $db_user = DB_USER;
    protected string $db_pass = DB_PASS;
    protected string $db_name = DB_NAME;

    protected static ?PDO $pdo = null;

    public function __construct()
    {
        if (!self::$pdo) {
            self::$pdo = $this->getConnection();
        }
    }

    protected function getConnection(): PDO
    {
        try {
            return new PDO(
                "mysql:dbname=$this->db_name;host=$this->db_host",
                $this->db_user,
                $this->db_pass,
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
