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

	function insert($a, $b, $c) {
		$query = "INSERT INTO {$this->table_name} VALUES('$a', ?, ?, 0, 0, 0, '$b', '$c', 0, 0, 0, 0, 0, 0, 0)";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);
		$stmt->bindParam(2, $this->name);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}


	function getNewID($a) {
		$query = "SELECT fld_subcriteria_id FROM {$this->table_name} WHERE user_id='$a' ORDER BY fld_subcriteria_id DESC LIMIT 1";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		if ($stmt->rowCount()) {
			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			$pcs = explode("S", $row['fld_subcriteria_id']);
			$result = "S".($pcs[1]+1);
		} else {
			$result = "S1";
		}
		return $result;
	}

	function readAll($a) {
		$query = "SELECT * FROM {$this->table_name} WHERE user_id='$a' ORDER BY fld_subcriteria_id ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function readAll2($a, $b) {
		$query = "SELECT * FROM {$this->table_name} WHERE user_id='$a' AND fld_criteria_id='$b' ORDER BY fld_subcriteria_id ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function readCriName($a, $b) {
		$query = "SELECT * FROM tbl_eduapp_criteria_data WHERE fld_criteria_id='$a' AND user_id='$b' LIMIT 0,1";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	//function readAllSubCri($a) {
		//$query = "SELECT * FROM tbl_eduapp_subcriteria_data WHERE user_id='$a' UNION 
		 //SELECT * FROM tbl_eduapp_subcriteria_data_2 WHERE user_id='$a' UNION SELECT * FROM tbl_eduapp_subcriteria_data_3 WHERE user_id='$a'";
		//$stmt = $this->conn->prepare( $query );
		//$stmt->execute();

		//return $stmt;
	//}

	function readAllSubCri($a) {
		$query = "SELECT * FROM tbl_eduapp_subcriteria_data WHERE user_id='$a' ";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function countAll($a) {
		$query = "SELECT * FROM {$this->table_name} WHERE user_id='$a' ORDER BY fld_subcriteria_id ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt->rowCount();
	}

	function countAll2($a, $b) {
		$query = "SELECT * FROM {$this->table_name} WHERE user_id='$a' AND fld_criteria_id='$b' ORDER BY fld_subcriteria_id ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt->rowCount();
	}

	function readOne($a) {
		$query = "SELECT * FROM {$this->table_name} WHERE user_id='$a' AND fld_subcriteria_id=? LIMIT 0,1";
		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(1, $this->id);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->id = $row['fld_subcriteria_id'];
		$this->name = $row['fld_subcriteria_name'];
		//$this->bobot = $row['subcriteria_em'];
	}

	function readSatu($a, $b, $c) {
		$query = "SELECT * FROM {$this->table_name} WHERE fld_subcriteria_id='$a' AND user_id='$b' AND fld_criteria_id='$c' LIMIT 0,1";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function update() {
		$query = "UPDATE {$this->table_name}
				SET
					fld_subcriteria_name = :name
				WHERE
					fld_subcriteria_id = :id
				AND
					user_id = :user";

		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':name', $this->name);
		$stmt->bindParam(':id', $this->id);
		$stmt->bindParam(':user', $this->user);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function delete($a) {
		$query = "DELETE FROM {$this->table_name} WHERE user_id='$a' AND fld_subcriteria_id=?";
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
