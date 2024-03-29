<?php

class UserModel extends Database {
  private $pdo;

  public function __construct() {
      $conn = $this->getConnection();
      $this->pdo = $conn;
  }

  public function login($user, $password) {
    try {
      $stmt = $this->pdo->prepare("SELECT * FROM `user` WHERE `name` = ?");
      $stmt->execute([$user]);

      if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
      } else {
        $stmt = $this->pdo->prepare("SELECT * FROM `user` WHERE `email` = ?");
        $stmt->execute([$user]);

        if ($stmt->rowCount() > 0) {
          $user = $stmt->fetch(PDO::FETCH_ASSOC);
        } else{
          return false;
        }
      }

      if (password_verify($password, $user['password'])) {
        return $user;
      } else {
        return false;
      }
    } catch (PDOException $e) {
      return false;
    }
  }

  public function create($username, $email, $tel, $password) {
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

  public function fetchByEmail($email) {
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

  public function fetchByName($name) {
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