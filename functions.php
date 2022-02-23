<?php
	require_once "config.php";

	function select_data($user="") {
		global $con;

		$hasil = array();

		if ($user != "") $sql = "SELECT * FROM tbl_data WHERE NIM = :user";
		else $sql = "SELECT * FROM tbl_data";

		try {
            $stmt = $con->prepare($sql);
            if ($user != "") $stmt->bindValue(':user', $user, PDO::PARAM_STR);

            if ($stmt->execute()) {
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
        		$rs = $stmt->fetchAll();
        		
        		if ($rs != null) {
        			$i = 0;
        			foreach ($rs as $val) {
        				$hasil[$i]['nim'] = $val['NIM'];
        				$hasil[$i]['nama'] = $val['Nama'];
						$hasil[$i]['ipk'] = $val['IPK'];
						$hasil[$i]['asal'] = $val['Asal'];
						$i++;
        			}
        		}
        	}
        } catch(Exception $e) {
			echo 'Error select_data : '.$e->getMessage();
		}

		return $hasil;
	}


	function insert_data($data) {
		global $con;

		if ($data != null) {
			try {
				$sql = "INSERT INTO tbl_data VALUES (:nim, :nama, :ipk, :asal)";
				$stmt = $con->prepare($sql);
				$stmt->bindValue(':nim', $data['nim'], PDO::PARAM_STR);
				$stmt->bindValue(':nama', $data['nama'], PDO::PARAM_STR);
				$stmt->bindValue(':ipk', $data['ipk'], PDO::PARAM_STR);
				$stmt->bindValue(':asal', $data['asal'], PDO::PARAM_STR);

				if ($stmt->execute()) $ok = true;
				else return false;

				$sql = "INSERT INTO tbl_user VALUES (:nim, :pass)";
				$stmt = $con->prepare($sql);
				$stmt->bindValue(':nim', $data['nim'], PDO::PARAM_STR);
				$stmt->bindValue(':pass', $data['pass'], PDO::PARAM_STR);

				if ($stmt->execute()) return true;
				else return false;
			} catch(Exception $e) {
				echo 'Error insert_data : '.$e->getMessage();
				return false;
			}
		} else {
			return false;
		}
	}

	function update_data($nim="",$data) {
		global $con;

		if ($data != null) {
			try {
				$sql = "UPDATE tbl_data SET Nama = :nama, IPK = :ipk, Asal = :asal WHERE NIM = :nim";
				$stmt = $con->prepare($sql);
				$stmt->bindValue(':nim', $nim, PDO::PARAM_STR);
				$stmt->bindValue(':nama', $data['nama'], PDO::PARAM_STR);
				$stmt->bindValue(':ipk', $data['ipk'], PDO::PARAM_STR);
				$stmt->bindValue(':asal', $data['asal'], PDO::PARAM_STR);

				if ($stmt->execute()) return true;
				else return false;
			} catch(Exception $e) {
				echo 'Error update_data : '.$e->getMessage();
				return false;
			}
		} else {
			return false;
		}
	}

	function delete_data($nim="") {
		global $con;

		if ($nim != "") {
			try {
				$sql = "DELETE FROM tbl_data WHERE NIM = :nim";
				$stmt = $con->prepare($sql);
				$stmt->bindValue(':nim', $nim, PDO::PARAM_STR);
				if ($stmt->execute()) $ok = true;
				else return false;

				$sql = "DELETE FROM tbl_user WHERE NIM = :nim";
				$stmt = $con->prepare($sql);
				$stmt->bindValue(':nim', $nim, PDO::PARAM_STR);
				if ($stmt->execute()) return true;
				else return false;
			} catch(Exception $e) {
				echo 'Error delete_data : '.$e->getMessage();
				return false;
			}
		} else {
			return false;
		}
	}

