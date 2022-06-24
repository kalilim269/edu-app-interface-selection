<?php
class Subbobot {
	private $conn;
	private $table_name = "tbl_eduapp_analyse_subcriteria";

	public $kp;
	public $nak;
	public $hak;
	public $kk;
	public $bb;
	public $prio;

	public function __construct($db) {
		$this->conn = $db;
	}

	function insert($a, $b, $c, $d, $e) {
		$query = "INSERT INTO {$this->table_name} VALUES('$d', '$e', '$a', '$b', 0, '$c', 0, 0)";
		$stmt = $this->conn->prepare($query);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function insert2($a, $b, $c, $d) {
		$query = "UPDATE {$this->table_name} SET fld_subcriteria_result='$a' WHERE fld_subcriteria_1='$b' AND fld_subcriteria_2='$c' AND user_id='$d'";
		$stmt = $this->conn->prepare($query);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function insert3($a, $b, $c) {
		$query = "UPDATE tbl_eduapp_subcriteria_data SET fld_subcriteria_total='$a' WHERE fld_subcriteria_id='$b' AND user_id='$c'";
		$stmt = $this->conn->prepare($query);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function insert4($a, $b, $c) {
		$query = "UPDATE tbl_eduapp_subcriteria_data SET subcriteria_em='$a' WHERE fld_subcriteria_id='$b' AND user_id='$c'";
		$stmt = $this->conn->prepare($query);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function insert5($a, $b, $c) {
		$query = "UPDATE tbl_eduapp_subcriteria_data SET sub_global_priority='$a' WHERE fld_subcriteria_id='$b' AND user_id='$c'";
		$stmt = $this->conn->prepare($query);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function insert6($a, $b, $c) {
		$query = "UPDATE tbl_eduapp_subcriteria_data SET subcriteria_gm_total='$a' WHERE fld_subcriteria_id='$b' AND user_id='$c' ";
		$stmt = $this->conn->prepare($query);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function insert7($a, $b, $c) {
		$query = "UPDATE tbl_eduapp_subcriteria_data SET subcriteria_gm='$a' WHERE fld_subcriteria_id='$b' AND user_id='$c' ";
		$stmt = $this->conn->prepare($query);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function insert8($a, $b, $c) {
		$query = "UPDATE tbl_eduapp_subcriteria_data SET global_priority_gm='$a' WHERE fld_subcriteria_id='$b' AND user_id='$c'";
		$stmt = $this->conn->prepare($query);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function insert9($a, $b, $c) {
		$query = "UPDATE tbl_eduapp_subcriteria_data SET subcriteria_an_total='$a' WHERE fld_subcriteria_id='$b' AND user_id='$c'";
		$stmt = $this->conn->prepare($query);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function insert10($a, $b, $c, $d) {
		$query = "UPDATE {$this->table_name} SET an_subcriteria_analysis_1='$a' WHERE fld_subcriteria_1='$b' AND fld_subcriteria_2='$c' AND user_id='$d'";
		$stmt = $this->conn->prepare($query);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function insert11($a, $b, $c) {
		$query = "UPDATE tbl_eduapp_subcriteria_data SET subcriteria_an_total_2='$a' WHERE fld_subcriteria_id='$b' AND user_id='$c'";
		$stmt = $this->conn->prepare($query);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function insert12($a, $b, $c, $d) {
		$query = "UPDATE {$this->table_name} SET an_subcriteria_analysis_2='$a' WHERE fld_subcriteria_1='$b' AND fld_subcriteria_2='$c' AND user_id='$d'";
		$stmt = $this->conn->prepare($query);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function insert13($a, $b, $c) {
		$query = "UPDATE tbl_eduapp_subcriteria_data SET subcriteria_an='$a' WHERE fld_subcriteria_id='$b' AND user_id='$c'";
		$stmt = $this->conn->prepare($query);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function insert14($a, $b, $c) {
		$query = "UPDATE tbl_eduapp_subcriteria_data SET global_priority_an='$a' WHERE fld_subcriteria_id='$b' AND user_id='$c'";
		$stmt = $this->conn->prepare($query);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function readAll() {
		$query = "SELECT * FROM tbl_eduapp_subcriteria_data";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt;
	}

	function readAll1($a, $b, $c) {
		$query = "SELECT * FROM {$this->table_name} WHERE fld_subcriteria_1 = '$a' AND fld_subcriteria_2 = '$b' AND user_id='$c' LIMIT 0,1";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->kp = $row['fld_subcriteria_value'];
	}

	function readAll2($a, $b) {
		$query = "SELECT * FROM tbl_eduapp_subcriteria_data WHERE user_id='$a' AND fld_criteria_id='$b' ";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		return $stmt;
	}

	function readAll3($a, $b) {
		$query = "SELECT * FROM tbl_eduapp_subcriteria_data WHERE fld_subcriteria_id = '$a' AND user_id='$b' LIMIT 0,1";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->prio = $row['subcriteria_gm_total'];
	}

	function readAll4($a, $b, $c) {
		$query = "SELECT * FROM {$this->table_name} WHERE fld_subcriteria_1 = '$a' AND fld_subcriteria_2 = '$b' AND user_id='$c' LIMIT 0,1";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->kp = $row['an_subcriteria_analysis_1'];
	}

	function countAll($a, $b) {
		$query = "SELECT * FROM tbl_eduapp_subcriteria_data WHERE user_id='$a' AND fld_criteria_id='$b' ";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt->rowCount();
	}

	function readSum1($a, $b) {
		$query = "SELECT sum(fld_subcriteria_value) AS total FROM {$this->table_name} WHERE fld_subcriteria_2='$a' AND user_id='$b'";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->nak = $row['total'];
	}

	function getIr($n) {
		switch ($n) {
		case 3:
			$r = 0.58;
			break;
		case 4:
			$r = 0.90;
			break;
		case 5:
			$r = 1.12;
			break;
		case 6:
			$r = 1.24;
			break;
		case 7:
			$r = 1.32;
			break;
		case 8:
			$r = 1.41;
			break;
		case 9:
			$r = 1.45;
			break;
		case 10:
			$r = 1.49;
			break;
		case 11:
			$r = 1.51;
			break;
		case 12:
			$r = 1.48;
			break;
		case 13:
			$r = 1.56;
			break;
		case 14:
			$r = 1.57;
			break;
		case 15:
			$r = 1.59;
			break;

		default:
			$r = 0.00;
			break;
		}
		return $r;
	}

	function readSum2($a, $b) {
		$query = "SELECT sum(fld_subcriteria_result) AS total2 FROM {$this->table_name} WHERE fld_subcriteria_1='$a' AND user_id='$b'";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->hak = $row['total2'];
	}

	function readSum3() {
		$query = "SELECT sum(subcriteria_em) AS bbkr FROM tbl_eduapp_subcriteria_data";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->bb = $row['bbkr'];
	}

	function readSum4($a, $b) {
		$query = "SELECT sum(an_subcriteria_analysis_1) AS ansum FROM {$this->table_name} WHERE fld_subcriteria_2='$a' AND user_id='$b'";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->hak = $row['ansum'];
	}

	function readSum5($a, $b) {
		$query = "SELECT sum(an_subcriteria_analysis_2) AS ansum FROM {$this->table_name} WHERE fld_subcriteria_1='$a' AND user_id='$b'";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->hak = $row['ansum'];
	}

	function readVectorSum($a, $b) {
		$query = "SELECT SQRT(sum(POWER((fld_subcriteria_value), 2))) AS vecsum FROM {$this->table_name} WHERE fld_subcriteria_2='$a' AND user_id='$b'";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->nak = $row['vecsum'];
	}

	function readMulti($a, $b) {
		$query = "SELECT EXP(SUM(LOG(fld_subcriteria_value))) AS multitotal FROM {$this->table_name} WHERE fld_subcriteria_1='$a' AND user_id='$b' ";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->hak = $row['multitotal'];
	}

	function readMulti2($a, $b, $c) {
		$query = "SELECT POWER(EXP(SUM(LOG(fld_subcriteria_value))), 1/'$c') AS multitotal FROM {$this->table_name} WHERE fld_subcriteria_1='$a' AND user_id='$b' ";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->hak2 = $row['multitotal'];
	}

	function readAvg($a, $b) {
		$query = "SELECT avg(fld_subcriteria_result) AS avgkr FROM {$this->table_name} WHERE fld_subcriteria_1 = '$a' AND user_id='$b'";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->hak = $row['avgkr'];
	}

	function readAvg2($a, $b) {
		$query = "SELECT avg(an_subcriteria_analysis_2) AS anavg2 FROM {$this->table_name} WHERE fld_subcriteria_1 = '$a' AND user_id='$b'";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->hak = $row['anavg2'];
	}

	function getsubGlobal($a, $b) {
		$query = "SELECT s.fld_subcriteria_id, s.subcriteria_em*c.criteria_em AS subglo FROM tbl_eduapp_subcriteria_data s JOIN tbl_eduapp_criteria_data c ON s.fld_criteria_id=c.fld_criteria_id WHERE s.fld_subcriteria_id='$a' AND s.user_id='$b' AND c.user_id='$b'";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->hak = $row['subglo'];
	}

	function getsubGlobal2($a, $b) {
		$query = "SELECT s.fld_subcriteria_id, s.subcriteria_gm*c.criteria_gm AS subglo FROM tbl_eduapp_subcriteria_data s JOIN tbl_eduapp_criteria_data c ON s.fld_criteria_id=c.fld_criteria_id WHERE s.fld_subcriteria_id='$a' AND s.user_id='$b' AND c.user_id='$b'";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->hak = $row['subglo'];
	}

	function getsubGlobal3($a, $b) {
		$query = "SELECT s.fld_subcriteria_id, s.subcriteria_an*c.criteria_an AS subglo FROM tbl_eduapp_subcriteria_data s JOIN tbl_eduapp_criteria_data c ON s.fld_criteria_id=c.fld_criteria_id WHERE s.fld_subcriteria_id='$a' AND s.user_id='$b' AND c.user_id='$b'";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->hak = $row['subglo'];
	}

	function getCI($a, $b) {
		$query = "SELECT sum(fld_subcriteria_total*subcriteria_em) AS total FROM tbl_eduapp_subcriteria_data WHERE user_id='$a' AND fld_criteria_id='$b' ";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->nak = $row['total'];
	}

	function getCI2($a, $b) {
		$query = "SELECT sum(fld_subcriteria_total*subcriteria_an) AS total FROM tbl_eduapp_subcriteria_data WHERE user_id='$a' AND fld_criteria_id='$b' ";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->nak = $row['total'];
	}

	function update($a, $b, $c, $d, $e) {
		$query = "UPDATE  {$this->table_name} SET fld_subcriteria_value = '$b' WHERE fld_subcriteria_1 = '$a' and fld_subcriteria_2 = '$c' AND user_id='$d' AND fld_criteria_id='$e'";
		$stmt = $this->conn->prepare($query);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function delete($a, $b) {
		$query = "DELETE FROM {$this->table_name} WHERE user_id='$a' AND fld_criteria_id='$b' ";
		$stmt = $this->conn->prepare($query);

		if ($result = $stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function delete2($a) {
		$query = "DELETE FROM tbl_eduapp_subcriteria_data WHERE user_id='$a'";
		$stmt = $this->conn->prepare($query);

		if ($result = $stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
}
