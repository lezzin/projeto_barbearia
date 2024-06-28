<?php

class Model
{
    private $db_host = DB_HOST;
    private $db_user = DB_USER;
    private $db_pass = DB_PASS;
    private $db_name = DB_NAME;

    public function getConnection()
    {
        try {
            return new PDO("mysql:dbname=$this->db_name;host=$this->db_host", $this->db_user, $this->db_pass);
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }
}
