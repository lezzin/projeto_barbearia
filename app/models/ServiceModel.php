<?php

namespace App\Models;

use App\Core\Model;
use PDO;
use PDOException;

class ServiceModel extends Model
{
    public static function create($name, $price)
    {
        $sql = "INSERT INTO `service` (`name`, `price`) VALUES (:name, :price)";
        $stmt = self::prepare($sql);
        $params = [
            ":name" => $name,
            ":price" => $price,
        ];

        try {
            $stmt->execute($params);
            return self::lastInsertId() > 0;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }

    public static function allServices()
    {
        $sql = "SELECT * FROM `service` ORDER BY `name`";

        try {
            $stmt = self::query($sql);
            return $stmt->rowCount() > 0 ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }

    public static function update($name, $price, $id)
    {
        self::ensureConnection();

        $sql = "UPDATE `service` SET `name` = :name, `price` = :price WHERE id = :id";
        $stmt = self::prepare($sql);
        $params = [
            ":name" => $name,
            ":price" => $price,
            ":id" => $id,
        ];

        try {
            $stmt->execute($params);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }

    public static function delete($id)
    {
        self::ensureConnection();

        $sql = "DELETE FROM `service` WHERE id = :id";
        $stmt = self::prepare($sql);
        $params = [":id" => $id];

        try {
            $stmt->execute($params);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }

    public static function fetchByName($name)
    {
        self::ensureConnection();

        $sql = "SELECT * FROM `service` WHERE `name` = :name";
        $stmt = self::prepare($sql);
        $params = [":name" => $name];

        try {
            $stmt->execute($params);
            return $stmt->rowCount() > 0 ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }
}
