<?php

class ScheduleModel extends Model
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = $this->getConnection();
    }

    public function create($user, $tel, $email, $service_id, $datetime, $message, $user_id)
    {
        $sql = "INSERT INTO `schedule` (`user`, `tel`, `email`, `service_id`, `datetime`, `message`, `fk_user`) VALUES (:user, :tel, :email, :service_id, :datetime, :message, :user_id)";
        $stmt = $this->pdo->prepare($sql);
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
            return $this->pdo->lastInsertId() > 0;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function allSchedules()
    {
        $sql = "SELECT `schedule`.*, `service`.`name` as `service`, `service`.`price` as `service_price` 
                FROM `schedule` 
                INNER JOIN `service` ON `service`.`id` = `schedule`.`service_id` 
                ORDER BY `datetime`";

        try {
            $stmt = $this->pdo->query($sql);
            return $stmt->rowCount() > 0 ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
        } catch (PDOException $e) {
            return [];
        }
    }

    public function update($user, $tel, $service_id, $datetime, $message, $id)
    {
        $sql = "UPDATE `schedule` SET `user` = :user, `tel` = :tel, `service_id` = :service_id, `datetime` = :datetime, `message` = :message WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
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
            return false;
        }
    }

    public function updateStatus($status, $id)
    {
        $sql = "UPDATE `schedule` SET `status` = :status WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $params = [
            ':status' => $status,
            ':id' => $id
        ];

        try {
            $stmt->execute($params);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function delete($id)
    {
        $sql = "DELETE FROM `schedule` WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $params = [':id' => $id];   

        try {
            $stmt->execute($params);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function fetchByUser($user)
    {
        $sql = "SELECT `schedule`.*, `service`.`name`, `service`.`price` 
                FROM `schedule` 
                INNER JOIN `service` ON `service`.`id` = `schedule`.`service_id` 
                WHERE `fk_user` = :user";
        $stmt = $this->pdo->prepare($sql);
        $params = [':user' => $user];

        try {
            $stmt->execute($params);
            return $stmt->rowCount() > 0 ? $stmt->fetchAll(PDO::FETCH_ASSOC) : false;
        } catch (PDOException $e) {
            return false;
        }
    }
}
