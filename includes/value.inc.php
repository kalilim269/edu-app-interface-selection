<?php
class Value {
	private $conn;
	private $table_name = "tbl_eduapp_scale";

	public $id;//scale id
	public $jm;//scale value
	public $kt;//scale explanation

	public function __construct($db) {
		$this->conn = $db;
	}

	function insert() {
		$query = "INSERT INTO {$this->table_name} VALUES('',?,?)";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->jm);
		$stmt->bindParam(2, $this->kt);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function readAll() {
		$query = "SELECT * FROM {$this->table_name} ORDER BY fld_scale_id ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function countAll() {
		$query = "SELECT * FROM {$this->table_name} ORDER BY fld_scale_id ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt->rowCount();
	}

	function readOne() {
		$query = "SELECT * FROM {$this->table_name} WHERE fld_scale_id=? LIMIT 0,1";
		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(1, $this->id);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->id = $row['fld_scale_id'];
		$this->jm = $row['fld_scale_value'];
		$this->kt = $row['fld_scale_exp'];
	}

	// update the product
	function update() {
		$query = "UPDATE {$this->table_name}
				SET
					fld_scale_value = :jm,
					fld_scale_exp = :kt
				WHERE
					fld_scale_id = :id";

		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':jm', $this->jm);
		$stmt->bindParam(':kt', $this->kt);
		$stmt->bindParam(':id', $this->id);

		// execute the query
		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	// delete the product
	function delete() {
		$query = "DELETE FROM {$this->table_name} WHERE fld_scale_id = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);

		if ($result = $stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function hapusell($ax) {
		$query = "DELETE FROM {$this->table_name} WHERE fld_scale_id in $ax";
		$stmt = $this->conn->prepare($query);
		if ($result = $stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
}
