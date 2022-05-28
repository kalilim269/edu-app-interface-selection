<?php
class Skor {
	private $conn;
	private $table_name = "tbl_eduapp_analyse_alternative";

	public $kp;
	public $nak;
	public $hak;
	public $kk;
	public $bb;
	public $kri;
	public $jak;
	public $glo;
	public $sub;
	public $alt;
	public $test;

	public function __construct($db) {
		$this->conn = $db;
	}

	function insert($a, $b, $c, $d, $e) {
		$query = "INSERT INTO {$this->table_name} VALUES('$e', '$a','$b','','$c','$d', 0, 0)";
		$stmt = $this->conn->prepare($query);
		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function insert2($a, $b, $c, $d, $e) {
		$query = "UPDATE {$this->table_name} SET alternative_analysis_result = '$a' WHERE fld_alternative_1 = '$b' AND fld_alternative_2 = '$c' AND fld_subcriteria_id='$d' AND user_id='$e'";
		$stmt = $this->conn->prepare($query);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function insert3($a, $b, $c, $d) {
		$query = "INSERT INTO tbl_eduapp_alternative_details VALUES('$d', '$a', '$b', $c, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0)";
		$stmt = $this->conn->prepare($query);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function insert4($a, $b, $c, $d) {
		$query = "UPDATE tbl_eduapp_alternative_details SET alt_em='$a' WHERE alt_id='$b' AND fld_subcriteria_id='$c' AND user_id='$d'";
		$stmt = $this->conn->prepare($query);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function insert5($a, $b, $c, $d) {
		$query = "UPDATE tbl_eduapp_alternative_details SET alt_em_total='$a' WHERE alt_id='$b' AND fld_subcriteria_id='$c' AND user_id='$d'";
		$stmt = $this->conn->prepare($query);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function insert6($a, $b) {
		$query = "UPDATE nilai_awal SET global_priority='$a' WHERE id_alternatif='$b'";
		$stmt = $this->conn->prepare($query);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function insert7($a, $b, $c) {
		$query = "UPDATE tbl_eduapp_alternative_details SET alt_gm_total='$a' WHERE alt_id='$b' AND user_id='$c'";
		$stmt = $this->conn->prepare($query);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function insert8($a, $b, $c, $d) {
		$query = "UPDATE tbl_eduapp_alternative_details SET alt_gm='$a' WHERE alt_id='$b' AND fld_subcriteria_id = '$c' AND user_id='$d'";
		$stmt = $this->conn->prepare($query);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function insert9($a, $b, $c) {
		$query = "UPDATE tbl_eduapp_alternative_details SET global_priority_gm='$a' WHERE alt_id='$b' AND user_id='$c'";
		$stmt = $this->conn->prepare($query);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function insert10($a, $b, $c, $d) {
		$query = "UPDATE tbl_eduapp_alternative_details SET alt_an_total='$a' WHERE alt_id='$b' AND fld_subcriteria_id='$c' AND user_id='$d'";
		$stmt = $this->conn->prepare($query);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function insert11($a, $b, $c, $d, $e) {
		$query = "UPDATE {$this->table_name} SET an_alt_analysis_1 = '$a' WHERE fld_alternative_1 = '$b' AND fld_alternative_2 = '$c' AND fld_subcriteria_id='$d' AND user_id='$e'";
		$stmt = $this->conn->prepare($query);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function insert12($a, $b, $c, $d, $e) {
		$query = "UPDATE {$this->table_name} SET an_alt_analysis_2 = '$a' WHERE fld_alternative_1 = '$b' AND fld_alternative_2 = '$c' AND fld_subcriteria_id='$d' AND user_id='$e'";
		$stmt = $this->conn->prepare($query);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function insert13($a, $b, $c, $d) {
		$query = "UPDATE tbl_eduapp_alternative_details SET alt_an_total_2='$a' WHERE alt_id='$b' AND fld_subcriteria_id='$c' AND user_id='$d'";
		$stmt = $this->conn->prepare($query);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function insert14($a, $b, $c, $d) {
		$query = "UPDATE tbl_eduapp_alternative_details SET alt_an='$a' WHERE alt_id='$b' AND fld_subcriteria_id='$c' AND user_id='$d'";
		$stmt = $this->conn->prepare($query);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function insert15($a, $b, $c, $d) {
		$query = "UPDATE tbl_eduapp_alternative_details SET global_priority_an='$a' WHERE alt_id = '$b' AND fld_subcriteria_id='$c' AND user_id='$d'";
		$stmt = $this->conn->prepare($query);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function readAll() {
		$query = "SELECT * FROM tbl_eduapp_alternative_data";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function readAlternatif($a) {
		$query = "SELECT * FROM tbl_eduapp_alternative WHERE alt_id='$a'";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function readAll1($a, $b, $c, $d) {
		$query = "SELECT * FROM {$this->table_name} WHERE fld_alternative_1='$a' AND fld_alternative_2='$b' AND fld_subcriteria_id='$c' AND user_id='$d' LIMIT 0,1";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->kp = $row['alternative_analysis_value'];
	}

	function readAll2() {
		$query = "SELECT * FROM tbl_eduapp_alternative_data";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function readAll3($a, $b, $c) {
		$query = "SELECT * FROM tbl_eduapp_alternative_details WHERE alt_id='$a' AND fld_subcriteria_id='$b' AND user_id='$c' LIMIT 0,1";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->jak = $row['alt_em_total'];
	}

	function readAll4($a, $b, $c) {
		$query = "SELECT * FROM tbl_eduapp_alternative_details WHERE alt_id = '$a' AND fld_subcriteria_id='$b' AND user_id='$c' LIMIT 0,1";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->prio = $row['alt_gm_total'];
	}

	function readAll5($a, $b, $c) {
		$query = "SELECT * FROM tbl_eduapp_alternative_details WHERE alt_id='$a' AND fld_subcriteria_id='$b' AND user_id='$c' LIMIT 0,1";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->test = $row['alt_an_total'];
	}

	function readAll6($a, $b, $c, $d) {
		$query = "SELECT * FROM {$this->table_name} WHERE fld_alternative_1 = '$a' AND fld_alternative_2 = '$b' AND fld_subcriteria_id='$c' AND user_id='$d' LIMIT 0,1";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->kp = $row['an_alt_analysis_1'];
	}

	function readAll7($a, $b, $c) {
		$query = "SELECT * FROM tbl_eduapp_alternative_details WHERE alt_id='$a' AND fld_subcriteria_id='$b' AND user_id='$c' LIMIT 0,1";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->jak = $row['alt_an_total_2'];
	}

	function countAll() {
		$query = "SELECT * FROM tbl_eduapp_alternative_data";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt->rowCount();
	}

	function readSum1($a, $b, $c) {
		$query = "SELECT sum(alternative_analysis_value) AS jumkr FROM {$this->table_name} WHERE fld_alternative_2='$a' AND fld_subcriteria_id='$b' AND user_id='$c' ";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->nak = $row['jumkr'];
	}

	function readSum2($a, $b) {
		$query = "SELECT sum(alternative_analysis_result) AS jumkr2 FROM {$this->table_name} WHERE fld_alternative_2='$a' AND fld_subcriteria_id='$b'";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->nak = $row['jumkr2'];
	}

	function readSum3($a) {
		$query = "SELECT sum(alt_em) AS bbkr FROM tbl_eduapp_alternative_details WHERE fld_subcriteria_id='$a'";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->bb = $row['bbkr'];
	}

	function readSum4($a) {
		$query = "SELECT sum(alt_em) AS bbkr FROM tbl_eduapp_alternative_details WHERE fld_subcriteria_id='$a'";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->bb = $row['bbkr'];
	}

	function readSum5($a, $b, $c) {
		$query = "SELECT sum(an_alt_analysis_1) AS jumkr FROM {$this->table_name} WHERE fld_alternative_2='$a' AND fld_subcriteria_id='$b' AND user_id='$c' ";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->nak = $row['jumkr'];
	}

	function readSum6($a, $b, $c) {
		$query = "SELECT SUM(an_alt_analysis_2) AS ansum FROM {$this->table_name} WHERE fld_alternative_1='$a' AND fld_subcriteria_id='$b' AND user_id='$c'";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->hak = $row['ansum'];
	}

	function readMulti($a, $b, $c) {
		$query = "SELECT EXP(SUM(LOG(alternative_analysis_value))) AS multitotal FROM {$this->table_name} WHERE fld_alternative_1='$a' AND fld_subcriteria_id = '$b' AND user_id='$c'";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->hak = $row['multitotal'];
	}

	function readMulti2($a, $b, $c) {
		$query = "SELECT POWER(EXP(SUM(LOG(alternative_analysis_value))), 1/19) AS multitotal FROM {$this->table_name} WHERE fld_alternative_1='$a' AND fld_subcriteria_id = '$b' AND user_id='$c'";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->hak2 = $row['multitotal'];
	}

	function readAvg($a, $b, $c) {
		$query = "SELECT avg(alternative_analysis_result) AS avgkr FROM {$this->table_name} WHERE fld_alternative_1 = '$a' AND fld_subcriteria_id='$b' AND user_id = '$c'";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->hak = $row['avgkr'];
	}

	function readAvg2($a, $b, $c) {
		$query = "SELECT avg(an_alt_analysis_2) AS anavg2 FROM {$this->table_name} WHERE fld_alternative_1 = '$a' AND fld_subcriteria_id='$b' AND user_id='$c'";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->hak = $row['anavg2'];
	}

	function readVectorSum($a, $b, $c) {
		$query = "SELECT SQRT(sum(POWER((alternative_analysis_value), 2))) AS vecsum FROM {$this->table_name} WHERE fld_alternative_2='$a' AND fld_subcriteria_id='$b' AND user_id='$c'";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->nak = $row['vecsum'];
	}

	function readSubPri($a, $b) {
		$query = "SELECT sub_global_priority  FROM 
		(SELECT * FROM tbl_eduapp_subcriteria_data
		UNION
		SELECT * FROM tbl_eduapp_subcriteria_data_2
		UNION 
		SELECT * FROM tbl_eduapp_subcriteria_data_3 
		) AS subpri 
		WHERE fld_subcriteria_id='$a' AND user_id='$b'";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		//return $stmt;
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->sub = $row['sub_global_priority'];
	}

	function readSubPriGm($a, $b) {
		$query = "SELECT global_priority_gm  FROM 
		(SELECT * FROM tbl_eduapp_subcriteria_data
		UNION
		SELECT * FROM tbl_eduapp_subcriteria_data_2
		UNION 
		SELECT * FROM tbl_eduapp_subcriteria_data_3 
		) AS subpri 
		WHERE fld_subcriteria_id='$a' AND user_id='$b'";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		//return $stmt;
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->sub = $row['global_priority_gm'];
	}

	function readSubPriAn($a, $b) {
		$query = "SELECT global_priority_an  FROM 
		(SELECT * FROM tbl_eduapp_subcriteria_data
		UNION
		SELECT * FROM tbl_eduapp_subcriteria_data_2
		UNION 
		SELECT * FROM tbl_eduapp_subcriteria_data_3 
		) AS subpri 
		WHERE fld_subcriteria_id='$a' AND user_id='$b'";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		//return $stmt;
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->sub = $row['global_priority_an'];
	}

	function readKri($a) {
		$query = "SELECT *  FROM 
		(SELECT * FROM tbl_eduapp_subcriteria_data 
		UNION
		 SELECT * FROM tbl_eduapp_subcriteria_data_2 
		UNION
		SELECT * FROM tbl_eduapp_subcriteria_data_3) AS rkri
		 WHERE fld_subcriteria_id='$a' ";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->kri = $row['fld_subcriteria_name'];
	}

	function readKriId($a, $b) {
		$query = "SELECT *  FROM 
		(SELECT * FROM tbl_eduapp_subcriteria_data 
		UNION
		 SELECT * FROM tbl_eduapp_subcriteria_data_2 
		UNION
		SELECT * FROM tbl_eduapp_subcriteria_data_3) AS criid
		 WHERE fld_subcriteria_id='$a' AND user_id='$b' ";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->criid = $row['fld_subcriteria_id'];
	}

	function getaltGlobal($a) {
		$query = " SELECT a.sub_global_priority*b.alt_em AS altglo FROM 
		(SELECT * FROM tbl_eduapp_subcriteria_data UNION ALL
		SELECT * FROM tbl_eduapp_subcriteria_data_2 
			UNION ALL
		SELECT * FROM tbl_eduapp_subcriteria_data_3) AS a JOIN tbl_eduapp_alternative_details AS b ON
		 a.fld_subcriteria_id=b.fld_subcriteria_id WHERE b.alt_id='$a'";

		//$query = "SELECT s.sub_global_priority*a.skor_alt_kri AS altglo FROM tbl_eduapp_subcriteria_data s JOIN jum_alt_kri a ON s.fld_subcriteria_id=a.fld_subcriteria_id WHERE a.id_alternatif='$a'";

		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->alt = $row['altglo'];
	}



	function update($a,$b,$c,$d, $e) {
		$query = "UPDATE  ".$this->table_name."  SET alternative_analysis_value = '$b' WHERE fld_alternative_1 = '$a' and fld_alternative_2 = '$c' and fld_subcriteria_id = '$d' and user_id='$e'";
		$stmt = $this->conn->prepare($query);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function delete($a) {
		$query = "DELETE FROM {$this->table_name} WHERE user_id='$a'";
		$stmt = $this->conn->prepare($query);

		if ($result = $stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function delete2($a) {
		$query = "DELETE FROM tbl_eduapp_alternative_details WHERE user_id='$a'";
		$stmt = $this->conn->prepare($query);

		if ($result = $stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function delete3($a) {
		$query = "DELETE FROM tbl_eduapp_alternative_data WHERE user_id='$a'";
		$stmt = $this->conn->prepare($query);

		if ($result = $stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}


}
