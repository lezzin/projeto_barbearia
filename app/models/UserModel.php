<?php

class UserModel extends Model
{
    private $pdo;

    public function __construct()
    {
        $conn = $this->getConnection();
        $this->pdo = $conn;
    }

    public function login($user, $password)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM `user` WHERE `name` = ? OR `email` = ?");
        $stmt->execute([$user, $user]);

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (password_verify($password, $user['password'])) {
                return $user;
            }

            return false;
        }

        return false;
    }

    public function create($username, $email, $tel, $password)
    {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO `user` (`name`, `email`, `tel`, `password`) VALUES (?, ?, ?, ?)");
            $stmt->execute([$username, $email, $tel, $password]);

            if ($this->pdo->lastInsertId() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return false;
        }
    }

    public function fetchByEmail($email)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM `user` WHERE `email` = ?");
            $stmt->execute([$email]);

            if ($stmt->rowCount() > 0) {
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return false;
        }
    }

    public function fetchByName($name)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM `user` WHERE `name` = ?");
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
