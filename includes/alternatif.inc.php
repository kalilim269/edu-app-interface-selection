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

	function insert($a, $b, $c) {
		$query = "INSERT INTO {$this->table_name} VALUES('$a', '$b', '$c', 0, 0, 0)";
		$stmt = $this->conn->prepare($query);
		

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function readAll() {
		$query = "SELECT * FROM {$this->table_name} ORDER BY alt_id ASC";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}

	function readByFilter() {
		$query = "SELECT * FROM tbl_eduapp_alternative ORDER BY alt_id ASC";
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

	function countByFilter() {
		$query = "SELECT * FROM tbl_eduapp_alternative ORDER BY alt_id ASC";
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
		$query = "SELECT * FROM {$this->table_name} WHERE user_id='$a' ORDER BY an_result DESC";
		$stmt = $this->conn->prepare($query);
		//$stmt->bindParam(1, $this->periode);
		$stmt->execute();

		return $stmt;
	}


	function countAll(){
		$query = "SELECT * FROM {$this->table_name} ORDER BY alt_id ASC";
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

	function readOne(){
		$query = "SELECT * FROM {$this->table_name} WHERE alt_id=? LIMIT 0,1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);
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

	function readSatu($a) {
		$query = "SELECT * FROM tbl_eduapp_alternative WHERE alt_id='$a' LIMIT 0,1";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function getNewID() {
		$query = "SELECT MAX(alt_id) AS code FROM {$this->table_name}";
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
					nik = :nik,
					nama = :nama,
					tempat_lahir = :tempat_lahir,
					tanggal_lahir = :tanggal_lahir,
					kelamin = :kelamin,
					alamat = :alamat,
					jabatan = :jabatan,
					tanggal_masuk = :tanggal_masuk,
					pendidikan = :pendidikan
				WHERE
					id_alternatif = :id";
		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':nik', $this->nik);
		$stmt->bindParam(':nama', $this->nama);
		$stmt->bindParam(':tempat_lahir', $this->tempat_lahir);
		$stmt->bindParam(':tanggal_lahir', $this->tanggal_lahir);
		$stmt->bindParam(':kelamin', $this->kelamin);
		$stmt->bindParam(':alamat', $this->alamat);
		$stmt->bindParam(':jabatan', $this->jabatan);
		$stmt->bindParam(':tanggal_masuk', $this->tanggal_masuk);
		$stmt->bindParam(':pendidikan', $this->pendidikan);
		$stmt->bindParam(':id', $this->id);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function delete() {
		$query = "DELETE FROM {$this->table_name} WHERE alt_id = ?";
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
