<?php

class UserModel extends Database {
  private $pdo;

  public function __construct() {
      $conn = $this->getConnection();
      $this->pdo = $conn;
  }

  public function login($username, $password) {
    try {
      $stmt = $this->pdo->prepare("SELECT * FROM `user` WHERE `name` = ?");
      $stmt->execute([$username]);

      if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
      } else {
        return false;
      }

      if (password_verify($password, $user['password'])) {
        return $user['id'];
      } else {
        return false;
      }
    } catch (PDOException $e) {
      return false;
    }
  }

  public function create($username, $password) {
    try {
        $stmt = $this->pdo->prepare("INSERT INTO `user` (`name`, `password`) VALUES (?, ?)");
        $stmt->execute([$username, $password]);

        if ($this->pdo->lastInsertId() > 0) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        return false;
    }
  }
}