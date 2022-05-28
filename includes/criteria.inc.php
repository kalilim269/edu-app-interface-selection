<?php
class Criteria {
	private $conn;
	private $table_name = "tbl_eduapp_criteria_data";

	public $id;
	public $name;
	public $bobot;
	public $nak;

	public function __construct($db) {
		$this->conn = $db;
	}

	function insert($a, $b, $c) {
		$query = "INSERT INTO {$this->table_name} VALUES('$a', '$b', '$c', 0, 0, 0, 0, 0, 0, 0)";
		$stmt = $this->conn->prepare($query);
		//$stmt->bindParam(1, $this->id);
		//$stmt->bindParam(2, $this->name);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function getNewID() {
		$query = "SELECT fld_criteria_id FROM {$this->table_name} ORDER BY fld_criteria_id DESC LIMIT 1";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		if ($stmt->rowCount()) {
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$pcs = explode("C", $row['fld_criteria_id']);
			$result = "C".($pcs[1]+1);
		} else {
			$result = "C1";
		}
		return $result;
	}

	function getCI() {
		$query = "SELECT sum(fld_criteria_total*criteria_em) AS total FROM {$this->table_name}";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->nak = $row['total'];
	}

	function readAll() {
		$query = "SELECT * FROM tbl_eduapp_criteria ORDER BY fld_criteria_id ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function readC1($a) {
		$query = "SELECT * FROM {$this->table_name} WHERE fld_criteria_id='C1' AND user_id='$a'";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function readC2($a) {
		$query = "SELECT * FROM {$this->table_name} WHERE fld_criteria_id='C2' AND user_id='$a'";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function readC3($a) {
		$query = "SELECT * FROM {$this->table_name} WHERE fld_criteria_id='C3' AND user_id='$a'";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function countAll() {
		$query = "SELECT * FROM tbl_eduapp_criteria ORDER BY fld_criteria_id ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt->rowCount();
	}

	function readCriteria($a) {
		$query = "SELECT criteria_em FROM {$this->table_name} WHERE fld_criteria_id=$a ";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function readOne() {
		$query = "SELECT * FROM {$this->table_name} WHERE fld_criteria_id=? LIMIT 0,1";
		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(1, $this->id);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->id = $row['fld_criteria_id'];
		$this->nama = $row['fld_criteria_name'];
		$this->bobot = $row['criteria_em'];
	}

	function readSatu($a) {
		$query = "SELECT * FROM tbl_eduapp_criteria WHERE fld_criteria_id='$a' LIMIT 0,1";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function update() {
		$query = "UPDATE {$this->table_name}
				SET
					fld_criteria_name = :name
				WHERE
					fld_criteria_id = :id";

		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':name', $this->name);
		$stmt->bindParam(':id', $this->id);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function delete() {
		$query = "DELETE FROM {$this->table_name} WHERE fld_criteria_id=?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);

		if ($result = $stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function hapusell($ids) {
		$query = "DELETE FROM {$this->table_name} WHERE fld_criteria_id IN $ids";
		$stmt = $this->conn->prepare($query);

		if ($result = $stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
}
