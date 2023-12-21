
<?php

class ServiceModel extends Database
{
    private $pdo;

    public function __construct() {
        $conn = $this->getConnection();
        $this->pdo = $conn;
    }

    public function create($name, $price) {
        try {
            $stm = $this->pdo->prepare("INSERT INTO service (name, price) VALUES (?, ?)");
            $stm->execute([$name, $price]);

            if ($this->pdo->lastInsertId() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getTotalServices()
    {
        try {
            $stm = $this->pdo->query("SELECT COUNT(*) as total FROM service");

            if ($stm->rowCount() > 0) {
                return $stm->fetch(PDO::FETCH_ASSOC)['total'];
            } else {
                return [];
            }
        } catch (PDOException $e) {
            return [];
        }
    }

    public function allServices()
    {
        try {
            $stm = $this->pdo->query("SELECT * FROM service");

            if ($stm->rowCount() > 0) {
                return $stm->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return [];
            }
        } catch (PDOException $err) {
            return [];
        }
    }

    public function fetchService($id)
    {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM service WHERE id = ?");
            $stm->execute([$id]);

            if ($stm->rowCount() > 0) {
                return $stm->fetch(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return false;
        }
    }

    public function update($name, $price, $id)
    {
        try {
            $stm = $this->pdo->prepare("UPDATE service SET name = ?, price = ? WHERE id = ?");
            $stm->execute([$name, $price, $id]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function delete($id)
    {
        try {
            $stm = $this->pdo->prepare("DELETE FROM service WHERE id = ?");
            $stm->execute([$id]);
            if ($stm->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return false;
        }
    }
}