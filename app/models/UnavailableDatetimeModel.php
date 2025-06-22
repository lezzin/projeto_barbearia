<?php

namespace App\Models;

use App\Core\Model;
use PDO;
use PDOException;

class UnavailableDatetimeModel extends Model
{
    public static function create($datetime)
    {
        $sql = "INSERT INTO `unavailable_datetime` (`datetime`) VALUES (:datetime)";
        $stmt = self::prepare($sql);
        $params = [":datetime" => $datetime];

        try {
            $stmt->execute($params);
            return self::lastInsertId() > 0;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }

    public static function allUnavailableDatetimes()
    {
        $sql = "SELECT * FROM `unavailable_datetime`";

        try {
            $stmt = self::query($sql);
            return $stmt->rowCount() > 0 ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }

    public static function update($datetime, $id)
    {
        $sql = "UPDATE `unavailable_datetime` SET `datetime` = :datetime WHERE id = :id";
        $stmt = self::prepare($sql);
        $params = [
            ":datetime" => $datetime,
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
        $sql = "DELETE FROM `unavailable_datetime` WHERE id = :id";
        $stmt = self::prepare($sql);
        $params = [":id" => $id];

        try {
            $stmt->execute($params);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }

    public static function fetchByDatetime($datetime)
    {
        $sql = "SELECT * FROM `unavailable_datetime` WHERE `datetime` = :datetime";
        $stmt = self::prepare($sql);
        $params = [":datetime" => $datetime];

        try {
            $stmt->execute($params);
            return ($stmt->rowCount() > 0) ? $stmt->fetch(PDO::FETCH_ASSOC) : [];
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }
}
