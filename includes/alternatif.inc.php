<?php
class Alternatif {
	private $conn;
	private $table_name = "tbl_eduapp_alternative_data";

	public $id;
	public $nik;
	public $nama;
	public $tempat_lahir;
	public $tanggal_lahir;
	public $kelamin;
	public $alamat;
	public $jabatan;
	public $tanggal_masuk;
	public $pendidikan;
	public $hasil_akhir;
	public $skor_alternatif;

	public $periode;

	public function __construct($db) {
		$this->conn = $db;
	}

	function insert($a) {
		$query = "INSERT INTO {$this->table_name} VALUES('$a', ?, ?, 0, 0, 0)";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);
		$stmt->bindParam(2, $this->name);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function readAll($a) {
		$query = "SELECT * FROM {$this->table_name} WHERE user_id='$a' ORDER BY alt_id ASC";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}

	function readByFilter($a) {
		$query = "SELECT * FROM tbl_eduapp_alternative_data WHERE user_id='$a' ORDER BY alt_id ASC";
		//$query = "SELECT * FROM {$this->table_name} a JOIN nilai_awal b ON a.id_alternatif=b.id_alternatif WHERE b.keterangan='B'";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function readByFilter2($a) {
		$query = "SELECT * FROM tbl_eduapp_alternative_data WHERE user_id='$a' ORDER BY alt_id ASC";
		//$query = "SELECT * FROM {$this->table_name} a JOIN nilai_awal b ON a.id_alternatif=b.id_alternatif WHERE b.keterangan='B'";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function countByFilter($a) {
		$query = "SELECT * FROM tbl_eduapp_alternative_data WHERE user_id='$a' ORDER BY alt_id ASC";
		//$query = "SELECT * FROM {$this->table_name} a JOIN nilai_awal b ON a.id_alternatif=b.id_alternatif WHERE b.keterangan='B'";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt->rowCount();
	}

	function readAllWithNilai() {
		//$query = "SELECT *, b.nilai, b.keterangan
				//FROM {$this->table_name} a
					//JOIN nilai_awal b ON a.id_alternatif=b.id_alternatif
				//WHERE a.id_alternatif IN (SELECT id_alternatif FROM nilai_awal)
				//ORDER BY a.id_alternatif";
		$query = "SELECT * FROM {$this->table_name} ORDER BY alt_id ASC";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt;
	}

	function readByRank($a) {
		//$query = "SELECT *
				//FROM {$this->table_name} a
					//JOIN nilai_awal b ON a.id_alternatif=b.id_alternatif
				//WHERE b.keterangan='B'
					//AND b.periode=?
				//ORDER BY hasil_akhir DESC
				//LIMIT 0,5";
		$query = "SELECT * FROM {$this->table_name} WHERE user_id='$a' ORDER BY em_result DESC";
		$stmt = $this->conn->prepare($query);
		//$stmt->bindParam(1, $this->periode);
		$stmt->execute();

		return $stmt;
	}

	function readByRank2($a) {
		//$query = "SELECT *
				//FROM {$this->table_name} a
					//JOIN nilai_awal b ON a.id_alternatif=b.id_alternatif
				//WHERE b.keterangan='B'
					//AND b.periode=?
				//ORDER BY hasil_akhir DESC
				//LIMIT 0,5";
		$query = "SELECT * FROM {$this->table_name} WHERE user_id='$a' ORDER BY gm_result DESC";
		$stmt = $this->conn->prepare($query);
		//$stmt->bindParam(1, $this->periode);
		$stmt->execute();

		return $stmt;
	}

	function readByRank3($a) {
		//$query = "SELECT *
				//FROM {$this->table_name} a
					//JOIN nilai_awal b ON a.id_alternatif=b.id_alternatif
				//WHERE b.keterangan='B'
					//AND b.periode=?
				//ORDER BY hasil_akhir DESC
				//LIMIT 0,5";
		$query = "SELECT * FROM {$this->table_name} WHERE user_id='$a' ORDER BY an_result ASC";
		$stmt = $this->conn->prepare($query);
		//$stmt->bindParam(1, $this->periode);
		$stmt->execute();

		return $stmt;
	}


	function countAll($a){
		$query = "SELECT * FROM {$this->table_name} WHERE user_id='$a' ORDER BY alt_id ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt->rowCount();
	}

	function countAll2($a) {
		$query = "SELECT * FROM tbl_eduapp_alternative_data WHERE user_id='$a'";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt->rowCount();
	}

	function readOne($a){
		$query = "SELECT * FROM {$this->table_name} WHERE alt_id=? AND user_id='$a' LIMIT 0,1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->id = $row["alt_id"];
		$this->name = $row["alt_name"];
		
		// $this->skor_alternatif = $row['skor_alternatif'];
	}

	function readOneByNik(){
		$query = "SELECT * FROM {$this->table_name} WHERE nik=? LIMIT 0,1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->nik);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->id = $row["alt_id"];
		$this->nik = $row["nik"];
		$this->nama = $row["nama"];
		$this->tempat_lahir = $row["tempat_lahir"];
		$this->tanggal_lahir = $row["tanggal_lahir"];
		$this->kelamin = $row["kelamin"];
		$this->alamat = $row["alamat"];
		$this->jabatan = $row["jabatan"];
		$this->tanggal_masuk = $row["tanggal_masuk"];
		$this->pendidikan = $row["pendidikan"];
		$this->hasil_akhir = $row["hasil_akhir"];
		// $this->skor_alternatif = $row['skor_alternatif'];
	}

	function readSatu($a, $b) {
		$query = "SELECT * FROM tbl_eduapp_alternative_data WHERE alt_id='$a' AND user_id='$b' LIMIT 0,1";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function getNewID($a) {
		$query = "SELECT MAX(alt_id) AS code FROM {$this->table_name} WHERE user_id='$a' ";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if ($row) {
			return $this->genCode($row["code"], 'A', 3);
		} else {
			return $this->genCode($nomor_terakhir, 'A', 3);
		}
	}

	function genCode($latest, $key, $chars = 0) {
    $new = intval(substr($latest, strlen($key))) + 1;
    $numb = str_pad($new, $chars, "0", STR_PAD_LEFT);
    return $key . $numb;
	}

	function genNextCode($start, $key, $chars = 0) {
    $new = str_pad($start, $chars, "0", STR_PAD_LEFT);
    return $key . $new;
	}

	function update() {
		$query = "UPDATE {$this->table_name}
				SET
					alt_name = :name			
				WHERE
					alt_id = :id
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
		$query = "DELETE FROM {$this->table_name} WHERE alt_id = ? AND user_id='$a'";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);
		if ($result = $stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function hapusell($ax) {
		$query = "DELETE FROM {$this->table_name} WHERE alt_id in $ax";
		$stmt = $this->conn->prepare($query);
		if ($result = $stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
}
