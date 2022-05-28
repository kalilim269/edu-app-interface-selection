<?php
class Subcriteria {
	private $conn;
	private $table_name = "tbl_eduapp_subcriteria_data";

	public $id;
	public $name;
	public $bobot;

	public function __construct($db) {
		$this->conn = $db;
	}

	function insert($a, $b, $c, $d) {
		$query = "INSERT INTO {$this->table_name} VALUES('$a', '$b', '$c', 0, 0, 0, '$d', 0, 0, 0, 0, 0, 0, 0)";
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
		$query = "SELECT fld_subcriteria_id FROM {$this->table_name} ORDER BY fld_subcriteria_id DESC LIMIT 1";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		if ($stmt->rowCount()) {
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$pcs = explode("C", $row['fld_subcriteria_id']);
			$result = "S".($pcs[1]+1);
		} else {
			$result = "S1";
		}
		return $result;
	}

	function readAll() {
		$query = "SELECT * FROM tbl_eduapp_subcriteria ORDER BY fld_subcriteria_id ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function readAllSubCri($a) {
		$query = "SELECT * FROM tbl_eduapp_subcriteria_data WHERE user_id='$a' UNION 
		 SELECT * FROM tbl_eduapp_subcriteria_data_2 WHERE user_id='$a' UNION SELECT * FROM tbl_eduapp_subcriteria_data_3 WHERE user_id='$a'";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function countAll() {
		$query = "SELECT * FROM tbl_eduapp_subcriteria ORDER BY fld_subcriteria_id ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt->rowCount();
	}

	function readOne() {
		$query = "SELECT * FROM {$this->table_name} WHERE fld_subcriteria_id=? LIMIT 0,1";
		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(1, $this->id);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->id = $row['fld_subcriteria_id'];
		$this->nama = $row['fld_subcriteria_name'];
		$this->bobot = $row['subcriteria_em'];
	}

	function readSatu($a) {
		$query = "SELECT * FROM tbl_eduapp_subcriteria WHERE fld_subcriteria_id='$a' LIMIT 0,1";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function update() {
		$query = "UPDATE {$this->table_name}
				SET
					fld_subcriteria_name = :name
				WHERE
					fld_subcriteria_id = :id";

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
		$query = "DELETE FROM {$this->table_name} WHERE fld_subcriteria_id=?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);

		if ($result = $stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function hapusell($ids) {
		$query = "DELETE FROM {$this->table_name} WHERE fld_subcriteria_id IN $ids";
		$stmt = $this->conn->prepare($query);

		if ($result = $stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
}
