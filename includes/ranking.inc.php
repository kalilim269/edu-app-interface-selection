<?php
class Ranking {
	private $conn;
	private $table_name = "tbl_eduapp_ranking";

	public $ia;
	public $ik;
	public $nn;
	public $nn2;
	public $nn3;
	public $nn4;
	public $mnr1;
	public $mnr2;
	public $has1;
	public $has2;

	public function __construct($db) {
		$this->conn = $db;
	}

	function insert() {
		$query = "INSERT INTO ".$this->table_name." VALUES(?,?,?,'')";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->ia);
		$stmt->bindParam(2, $this->ik);
		$stmt->bindParam(3, $this->nn);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function readAll() {
		$query = "SELECT * FROM ".$this->table_name;
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		return $stmt;
	}

	function readBob($a) {
		$query = "SELECT *  FROM 
		(SELECT * FROM tbl_eduapp_subcriteria_data WHERE user_id='$a' 
		UNION
		 SELECT * FROM tbl_eduapp_subcriteria_data_2 WHERE user_id='$a'
		UNION
		SELECT * FROM tbl_eduapp_subcriteria_data_3 WHERE user_id='$a') AS rkri";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function readPrioC1($a) {
		$query = "SELECT * FROM tbl_eduapp_criteria_data WHERE fld_criteria_id='C1' AND user_id='$a'";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function readPrioC2($a) {
		$query = "SELECT * FROM tbl_eduapp_criteria_data WHERE fld_criteria_id='C2' AND user_id='$a'";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function readPrioC3($a) {
		$query = "SELECT * FROM tbl_eduapp_criteria_data WHERE fld_criteria_id='C3' AND user_id='$a'";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function countAll(){
		$query = "SELECT * FROM ".$this->table_name;
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt->rowCount();
	}

	function readKhusus(){
		$query = "SELECT * FROM tbl_eduapp_alternative_data a, tbl_eduapp_criteria_data b, tbl_eduapp_ranking c where a.alt_id=c.alt_id and b.fld_criteria_id=c.criteria_id order by a.alt_id asc";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		return $stmt;
	}

	function readR($a, $b, $c){
		$query = "SELECT * FROM tbl_eduapp_alternative_details where fld_subcriteria_id='$b' AND alt_id='$a' AND user_id='$c'";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function readMax($a){
		$query = "SELECT sum(alt_em) as mnr1 FROM tbl_eduapp_alternative_details where id_kriteria='$a'";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		return $stmt;
	}

	function readMax2(){

		$query = "SELECT sum(em_result) as mnr2 FROM tbl_eduapp_alternative_data";

		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function readHasil1($a, $b){

		$query = "SELECT sum(alt_em_value) as bbn FROM tbl_eduapp_alternative_details WHERE alt_id='$a' AND user_id='$b' LIMIT 0,1";

		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function readHasil3($a, $b){

		$query = "SELECT sum(alt_gm_value) as tot FROM tbl_eduapp_alternative_details WHERE alt_id='$a' AND user_id='$b' LIMIT 0,1";

		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt;
	}

	function readHasil4($a, $b){

		$query = "SELECT sum(alt_an_value) as tot FROM tbl_eduapp_alternative_details WHERE alt_id='$a' AND user_id='$b' LIMIT 0,1";

		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt;
	}

	function readHasil2($a){

		$query = "SELECT em_result FROM tbl_eduapp_alternative_data WHERE alt_id='$a' LIMIT 0,1";

		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	// used when filling up the update product form
	function readOne(){

		$query = "SELECT * FROM " . $this->table_name . " WHERE id_alternatif=? and id_kriteria=? LIMIT 0,1";

		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(1, $this->ia);
		$stmt->bindParam(2, $this->ik);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->ia = $row['id_alternatif'];
		$this->ik = $row['id_kriteria'];
		$this->nn = $row['nilai_rangking'];
	}

	// update the product
	function update(){

		$query = "UPDATE
					" . $this->table_name . "
				SET
					nilai_rangking = :nn
				WHERE
					id_alternatif = :ia
				AND
					id_kriteria = :ik";

		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':nn', $this->nn);
		$stmt->bindParam(':ia', $this->ia);
		$stmt->bindParam(':ik', $this->ik);

		// execute the query
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}

	function normalisasi1(){

		$query = "UPDATE tbl_eduapp_alternative_details
				SET
					alt_em_value = :nn4
				WHERE
					alt_id = :ia
				AND
					fld_subcriteria_id = :ik
				AND 
					user_id = :us";

		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':nn4', $this->nn4);
		$stmt->bindParam(':ia', $this->ia);
		$stmt->bindParam(':ik', $this->ik);
		$stmt->bindParam(':us', $this->us);

		// execute the query
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}

	function insert2($a, $b, $c, $d){

		$query = "UPDATE tbl_eduapp_alternative_details
				SET
					alt_gm_value = '$a'
				WHERE
					alt_id = '$b'
				AND
					fld_subcriteria_id = '$c'
				AND
					user_id = '$d'";

		$stmt = $this->conn->prepare($query);

		//$stmt->bindParam(':nn4', $this->nn4);
		//$stmt->bindParam(':ia', $this->ia);
		//$stmt->bindParam(':ik', $this->ik);

		// execute the query
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}

	function insert3($a, $b, $c, $d){

		$query = "UPDATE tbl_eduapp_alternative_details
				SET
					alt_an_value = '$a'
				WHERE
					alt_id = '$b'
				AND
					fld_subcriteria_id = '$c'
				AND
					user_id='$d'";

		$stmt = $this->conn->prepare($query);

		//$stmt->bindParam(':nn4', $this->nn4);
		//$stmt->bindParam(':ia', $this->ia);
		//$stmt->bindParam(':ik', $this->ik);

		// execute the query
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}

	function hasil1(){

		$query = "UPDATE
					tbl_eduapp_alternative_data
				SET
					em_result = :has1
				WHERE
					alt_id = :ia
				AND 
					user_id = :us";

		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':has1', $this->has1);
		$stmt->bindParam(':ia', $this->ia);
		$stmt->bindParam(':us', $this->us);

		// execute the query
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}

	function hasil2(){

		$query = "UPDATE
					tbl_eduapp_alternative_data
				SET
					gm_result = :has1
				WHERE
					alt_id = :ia
				AND
					user_id = :us";

		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':has1', $this->has1);
		$stmt->bindParam(':ia', $this->ia);
		$stmt->bindParam(':us', $this->us);

		// execute the query
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}

	function hasil3(){

		$query = "UPDATE
					tbl_eduapp_alternative_data
				SET
					an_result = :has1
				WHERE
					alt_id = :ia
				AND
					user_id = :us";

		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':has1', $this->has1);
		$stmt->bindParam(':ia', $this->ia);
		$stmt->bindParam(':us', $this->us);

		// execute the query
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}

	// delete the product
	function delete(){

		$query = "DELETE FROM " . $this->table_name . " WHERE id_alternatif = ? and id_kriteria = ?";

		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->ia);
		$stmt->bindParam(2, $this->ik);

		if($result = $stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
}
?>
