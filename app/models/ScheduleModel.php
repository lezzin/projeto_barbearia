<?php

namespace App\Models;

use App\Core\Model;
use PDO;
use PDOException;

class ScheduleModel extends Model
{
    public static function create($user, $tel, $email, $service_id, $datetime, $message, $user_id)
    {
        $sql = "INSERT INTO `schedule` (`user`, `tel`, `email`, `service_id`, `datetime`, `message`, `fk_user`) VALUES (:user, :tel, :email, :service_id, :datetime, :message, :user_id)";
        $stmt = self::prepare($sql);
        $params = [
            ':user' => $user,
            ':tel' => $tel,
            ':email' => $email,
            ':service_id' => $service_id,
            ':datetime' => $datetime,
            ':message' => $message,
            ':user_id' => $user_id
        ];

        try {
            $stmt->execute($params);
            return self::lastInsertId() > 0;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }

    public static function allSchedules()
    {
        $sql = "SELECT `schedule`.*, `service`.`name` as `service`, `service`.`price` as `service_price` 
                FROM `schedule` 
                INNER JOIN `service` ON `service`.`id` = `schedule`.`service_id` 
                ORDER BY `datetime`";

        try {
            $stmt = self::query($sql);
            return $stmt->rowCount() > 0 ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }

    public static function update($user, $tel, $service_id, $datetime, $message, $id)
    {
        $sql = "UPDATE `schedule` SET `user` = :user, `tel` = :tel, `service_id` = :service_id, `datetime` = :datetime, `message` = :message WHERE id = :id";
        $stmt = self::prepare($sql);
        $params = [
            ':user' => $user,
            ':tel' => $tel,
            ':service_id' => $service_id,
            ':datetime' => $datetime,
            ':message' => $message,
            ':id' => $id
        ];

        try {
            $stmt->execute($params);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }

    public static function updateStatus($status, $id)
    {
        $sql = "UPDATE `schedule` SET `status` = :status WHERE id = :id";
        $stmt = self::prepare($sql);
        $params = [
            ':status' => $status,
            ':id' => $id
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
        $sql = "DELETE FROM `schedule` WHERE id = :id";
        $stmt = self::prepare($sql);
        $params = [':id' => $id];

        try {
            $stmt->execute($params);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }

    public static function fetchByUser($user)
    {
        $sql = "SELECT `schedule`.*, `service`.`name`, `service`.`price` 
                FROM `schedule` 
                INNER JOIN `service` ON `service`.`id` = `schedule`.`service_id` 
                WHERE `fk_user` = :user";
        $stmt = self::prepare($sql);
        $params = [':user' => $user];

        try {
            $stmt->execute($params);
            return $stmt->rowCount() > 0 ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }
}
