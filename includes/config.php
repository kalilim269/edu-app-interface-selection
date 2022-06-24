<?php
class Config {
  private $host = "sql6.freemysqlhosting.net";
  private $db_name = "sql6496163";
  private $username = "sql6496163";
  private $password = "KpxBp7Ln2Y";
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
