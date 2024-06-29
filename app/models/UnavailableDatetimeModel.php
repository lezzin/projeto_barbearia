<?php

class UnavailableDatetimeModel extends Model
{
    private $pdo;

    public function __construct()
    {
        $conn = $this->getConnection();
        $this->pdo = $conn;
    }

    public function create($datetime)
    {
        $sql = "INSERT INTO `unavailable_datetime` (`datetime`) VALUES (:datetime)";
        $stmt = $this->pdo->prepare($sql);
        $params = [":datetime" => $datetime];

        try {
            $stmt->execute($params);
            return $this->pdo->lastInsertId() > 0;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function allUnavailableDatetimes()
    {
        $sql = "SELECT * FROM `unavailable_datetime`";

        try {
            $stmt = $this->pdo->query($sql);
            return $stmt->rowCount() > 0 ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
        } catch (PDOException $e) {
            return [];
        }
    }

    public function update($datetime, $id)
    {
        $sql = "UPDATE `unavailable_datetime` SET `datetime` = :datetime WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $params = [
            ":datetime" => $datetime,
            ":id" => $id,
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
        $sql = "DELETE FROM `unavailable_datetime` WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $params = [":id" => $id];

        try {
            $stmt->execute($params);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function fetchByDatetime($datetime)
    {
        $sql = "SELECT * FROM `unavailable_datetime` WHERE `datetime` = :datetime";
        $stmt = $this->pdo->prepare($sql);
        $params = [":datetime" => $datetime];

        try {
            $stmt->execute($params);
            return ($stmt->rowCount() > 0) ? $stmt->fetch(PDO::FETCH_ASSOC) : [];
        } catch (PDOException $e) {
            return [];
        }
    }
}
