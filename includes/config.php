<?php
class Config {
  private $host = "lrgs.ftsm.ukm.my";
  private $db_name = "a176496";
  private $username = "a176496";
  private $password = "bigwhiterabbit";
  public $conn;

  public function getConnection() {
    $this->conn = null;
    try {
      $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
    } catch (PDOException $exception) {
      echo "Connection error: " . $exception->getMessage();
    }
    return $this->conn;
  }
}
