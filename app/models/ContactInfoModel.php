<?php

namespace App\Models;

use App\Core\Model;
use PDO;
use PDOException;

class ContactInfoModel extends Model
{
    public static function create($email, $address, $tel, $whatsapp)
    {
        $sql = "INSERT INTO `contact_info` (`email`, `address`, `tel`, `whatsapp`) VALUES (:email, :address, :tel, :whatsapp)";
        $stmt = self::prepare($sql);
        $params = [
            ':email' => $email,
            ':address' => $address,
            ':tel' => $tel,
            ':whatsapp' => $whatsapp,
        ];

        try {
            $stmt->execute($params);
            return self::lastInsertId() > 0;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }

    public static function allContactInfos()
    {
        $sql = "SELECT * FROM `contact_info`";
        $stmt = self::query($sql);

        try {
            return $stmt->rowCount() > 0 ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
        } catch (PDOException $e) {
            return [];
        }
    }

    public static function update($email, $address, $tel, $whatsapp, $id)
    {
        $sql = "UPDATE `contact_info` SET `email` = :email, `address` = :address, `tel` = :tel, `whatsapp` = :whatsapp WHERE id = :id";
        $stmt = self::prepare($sql);
        $params = [
            ':email' => $email,
            ':address' => $address,
            ':tel' => $tel,
            ':whatsapp' => $whatsapp,
            ':id' => $id,
        ];

        try {
            $stmt->execute($params);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function delete($id)
    {
        $sql = "DELETE FROM `contact_info` WHERE id = :id";
        $stmt = self::prepare($sql);
        $params = [':id' => $id];

        try {
            $stmt->execute($params);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            return false;
        }
    }
}
