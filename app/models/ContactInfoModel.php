<?php

class ContactInfoModel extends Model
{
    private $pdo;

    public function __construct()
    {
        $conn = $this->getConnection();
        $this->pdo = $conn;
    }

    public function create($email, $address, $tel, $whatsapp)
    {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO `contact_info` (`email`, `address`, `tel`, `whatsapp`) VALUES (?, ?, ?, ?)");
            $stmt->execute([$email, $address, $tel, $whatsapp]);

            if ($this->pdo->lastInsertId() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return false;
        }
    }

    public function allContactInfos()
    {
        try {
            $stmt = $this->pdo->query("SELECT * FROM `contact_info`");

            if ($stmt->rowCount() > 0) {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return [];
            }
        } catch (PDOException $err) {
            return [];
        }
    }

    public function update($email, $address, $tel, $whatsapp, $id)
    {
        try {
            $stmt = $this->pdo->prepare("UPDATE `contact_info` SET `email` = ?, `address` = ?, `tel` = ?, `whatsapp` = ? WHERE id = ?");
            $stmt->execute([$email, $address, $tel, $whatsapp, $id]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function delete($id)
    {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM `contact_info` WHERE id = ?");
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
}
