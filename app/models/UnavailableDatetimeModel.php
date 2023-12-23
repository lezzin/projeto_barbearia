<?php

class UnavailableDatetimeModel extends Database {
    private $pdo;

    public function __construct() {
        $conn = $this->getConnection();
        $this->pdo = $conn;
    }

    public function create($datetime) {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO `unavailable_datetime` (`datetime`) VALUES (?)");
            $stmt->execute([$datetime]);

            if ($this->pdo->lastInsertId() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return false;
        }
    }

    public function allUnavailableDatetimes() {
        try {
            $stmt = $this->pdo->query("SELECT * FROM `unavailable_datetime`");

            if ($stmt->rowCount() > 0) {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return [];
            }
        } catch (PDOException $err) {
            return [];
        }
    }

    public function update($price, $id) {
        try {
            $stmt = $this->pdo->prepare("UPDATE `unavailable_datetime` SET `datetime` = ? WHERE id = ?");
            $stmt->execute([$price, $id]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function delete($id) {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM `unavailable_datetime` WHERE id = ?");
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

    public function fetchByDatetime($datetime) {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM `unavailable_datetime` WHERE `datetime` = ?");
            $stmt->execute([$datetime]);

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