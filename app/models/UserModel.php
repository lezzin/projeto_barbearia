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
        $sql = "SELECT * FROM `user` WHERE `name` = :name OR `email` = :email";
        $stmt = $this->pdo->prepare($sql);
        $params = [
            ":name" => $user,
            ":email" => $user,
        ];

        try {
            $stmt->execute($params);

            if ($stmt->rowCount() > 0) {
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if (password_verify($password, $user['password'])) {
                    return $user;
                }

                return false;
            }

            return false;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function create($name, $email, $tel, $password)
    {
        $sql = "INSERT INTO `user` (`name`, `email`, `tel`, `password`) VALUES (:name, :email, :tel, :password)";
        $stmt = $this->pdo->prepare($sql);
        $params = [
            ":name" => $name,
            ":email" => $email,
            ":tel" => $tel,
            ":password" => $password,
        ];

        try {
            $stmt->execute($params);
            return $this->pdo->lastInsertId() > 0;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function fetchByEmail($email)
    {
        $sql = "SELECT * FROM `user` WHERE `email` = :email";
        $stmt = $this->pdo->prepare($sql);
        $params = [":email" => $email];

        try {
            $stmt->execute($params);
            return ($stmt->rowCount() > 0) ? $stmt->fetch(PDO::FETCH_ASSOC) : false;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function fetchByName($name)
    {
        $sql = "SELECT * FROM `user` WHERE `name` = :name";
        $stmt = $this->pdo->prepare($sql);
        $params = [":name" => $name];

        try {
            $stmt->execute($params);
            return ($stmt->rowCount() > 0) ? $stmt->fetch(PDO::FETCH_ASSOC) : false;
        } catch (PDOException $e) {
            return false;
        }
    }
}
