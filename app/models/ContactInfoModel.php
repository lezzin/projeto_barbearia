<?php

class ContactInfoModel extends Model
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = $this->getConnection();
    }

    public function create($email, $address, $tel, $whatsapp)
    {
        $sql = "INSERT INTO `contact_info` (`email`, `address`, `tel`, `whatsapp`) VALUES (:email, :address, :tel, :whatsapp)";
        $stmt = $this->pdo->prepare($sql);
        $params = [
            ':email' => $email,
            ':address' => $address,
            ':tel' => $tel,
            ':whatsapp' => $whatsapp,
        ];

        try {
            $stmt->execute($params);
            return $this->pdo->lastInsertId() > 0;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }

    public function allContactInfos()
    {
        $sql = "SELECT * FROM `contact_info`";
        $stmt = $this->pdo->query($sql);

        try {
            return $stmt->rowCount() > 0 ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
        } catch (PDOException $e) {
            return [];
        }
    }

    public function update($email, $address, $tel, $whatsapp, $id)
    {
        $sql = "UPDATE `contact_info` SET `email` = :email, `address` = :address, `tel` = :tel, `whatsapp` = :whatsapp WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
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

    public function delete($id)
    {
        $sql = "DELETE FROM `contact_info` WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $params = [':id' => $id];

        try {
            $stmt->execute($params);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            return false;
        }
    }
}
