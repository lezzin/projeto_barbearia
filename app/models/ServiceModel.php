
<?php

class ServiceModel extends Model
{
    private $pdo;

    public function __construct()
    {
        $conn = $this->getConnection();
        $this->pdo = $conn;
    }

    public function create($name, $price)
    {
        $sql = "INSERT INTO `service` (`name`, `price`) VALUES (:name, :price)";
        $stmt = $this->pdo->prepare($sql);
        $params = [
            ":name" => $name,
            ":price" => $price,
        ];

        try {
            $stmt->execute($params);
            return $this->pdo->lastInsertId() > 0;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function allServices()
    {
        $sql = "SELECT * FROM `service` ORDER BY `name`";

        try {
            $stmt = $this->pdo->query($sql);
            return $stmt->rowCount() > 0 ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
        } catch (PDOException $e) {
            return [];
        }
    }

    public function update($name, $price, $id)
    {
        $sql = "UPDATE `service` SET `name` = :name, `price` = :price WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $params = [
            ":name" => $name,
            ":price" => $price,
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
        $sql = "DELETE FROM `service` WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $params = [":id" => $id];

        try {
            $stmt->execute($params);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function fetchByName($name)
    {
        $sql = "SELECT * FROM `service` WHERE `name` = :name";
        $stmt = $this->pdo->prepare($sql);
        $params = [":name" => $name];

        try {
            $stmt->execute($params);
            return $stmt->rowCount() > 0 ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
        } catch (PDOException $e) {
            return [];
        }
    }
}
