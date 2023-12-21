<?php

class UserModel extends Database {
  private $pdo;

  public function __construct() {
      $conn = $this->getConnection();
      $this->pdo = $conn;
  }

  public function login($username, $password) {
    try {
      $stm = $this->pdo->prepare("SELECT * FROM `user` WHERE `name` = ?");
      $stm->execute([$username]);

      if ($stm->rowCount() > 0) {
        $user = $stm->fetch(PDO::FETCH_ASSOC);
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
}