
<?php

class ServiceModel extends Database {
    private $pdo;

    public function __construct() {
        $conn = $this->getConnection();
        $this->pdo = $conn;
    }

    public function create($name, $price) {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO `service` (`name`, `price`) VALUES (?, ?)");
            $stmt->execute([$name, $price]);

            if ($this->pdo->lastInsertId() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return false;
        }
    }

    public function allServices() {
        try {
            $stmt = $this->pdo->query("SELECT * FROM `service` ORDER BY `name`");

            if ($stmt->rowCount() > 0) {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return [];
            }
        } catch (PDOException $err) {
            return [];
        }
    }

    public function update($name, $price, $id) {
        try {
            $stmt = $this->pdo->prepare("UPDATE `service` SET `name` = ?, `price` = ? WHERE id = ?");
            $stmt->execute([$name, $price, $id]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function delete($id) {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM `service` WHERE id = ?");
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

    public function fetchByName($name) {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM `service` WHERE `name` = ?");
            $stmt->execute([$name]);

            if ($stmt->rowCount() > 0) {
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return false;
        }           
    }
}