
<?php

class ScheduleModel extends Model
{
    private $pdo;

    public function __construct()
    {
        $conn = $this->getConnection();
        $this->pdo = $conn;
    }

    public function create($user, $tel, $email, $service_id, $datetime, $message, $user_id)
    {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO `schedule` (`user`, `tel`, `email`, `service_id`, `datetime`, `message`, `fk_user`) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$user, $tel, $email, $service_id, $datetime, $message, $user_id]);

            if ($this->pdo->lastInsertId() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return false;
        }
    }

    public function allSchedules()
    {
        try {
            $stmt = $this->pdo->query("SELECT `schedule`.*, `service`.`name` as `service`, `service`.`price` as `service_price` FROM `schedule`  inner join `service` on `service`.`id` = `schedule`.`service_id` WHERE `service`.`id` = `schedule`.`service_id` order by `datetime`");

            if ($stmt->rowCount() > 0) {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return [];
            }
        } catch (PDOException $err) {
            return [];
        }
    }

    public function update($user, $tel, $service_id, $datetime, $message, $id)
    {
        try {
            $stmt = $this->pdo->prepare("UPDATE `schedule` SET `user` = ?, `tel` = ?, `service_id` = ?, `datetime` = ?, `message` = ? WHERE id = ?");
            $stmt->execute([$user, $tel, $service_id, $datetime, $message, $id]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function updateStatus($status, $id)
    {
        try {
            $stmt = $this->pdo->prepare("UPDATE `schedule` SET `status` = ? WHERE id = ?");
            $stmt->execute([$status, $id]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function delete($id)
    {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM `schedule` WHERE id = ?");
            $stmt->execute([$id]);
            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return false;
        }
    }

    public function fetchByUser($user)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT `schedule`.*, `service`.`name`, `service`.`price` FROM `schedule` INNER JOIN service ON `service`.`id` = `schedule`.`service_id` WHERE `fk_user` = ?");
            $stmt->execute([$user]);

            if ($stmt->rowCount() > 0) {
                $data = [];

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $data[] = $row;
                }

                return $data;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return false;
        }
    }
}
