<!DOCTYPE html>
<html lang="en">

<head>
	<title>Detail Mahasiswa</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="templates/bootstrap.min.css">
	<script src="templates/jquery.min.js"></script>
	<script src="templates/popper.min.js"></script>
	<script src="templates/bootstrap.min.js"></script>
</head>
<body>
	<nav class="navbar navbar-expand-sm bg-dark navbar-dark"> 
		<a class="navbar-brand" href="index.php">ADMIN PANEL</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar"> <span class="navbar-toggler-icon"></span></button>
		<div class="collapse navbar-collapse" id="collapsibleNavbar">
			<ul class="navbar-nav">
				<li class="nav-item"> 
					<a class="nav-link" href="menu_tambah.php">Tambah Mahasiswa</a>
				</li>
				<li class="nav-item"> 
					<a class="nav-link" href="menu_data.php">Data Mahasiswa</a>
				</li>
				<li class="nav-item active"> 
					<a class="nav-link" href="menu_detail.php">Detail Mahasiswa</a>
				</li>
			</ul>
			<ul class="navbar-nav ml-auto">
				<li class="nav-item"> 
					<a class="nav-link" href="logout.php">Logout</a>
				</li>
			</ul>
		</div>
	</nav>
	<div class="container" style="margin-top:50px">
	<?php
		require_once "functions.php";

		if (!isset($_SESSION['user'])) {
			header("Location: login.php");
		} else {
			$nim = isset($_GET['nim']) ? $_GET['nim'] : "";

			$hapus = isset($_GET['hapus']) ? $_GET['hapus'] : "";
			if ($hapus != "") {
				$nim = "";
				$data = select_data($hapus);
				if (sizeof($data) > 0) {
					if (delete_data($hapus)) echo '<div class="alert alert-success">Sukses hapus data mahasiswa dengan NIM ('.$hapus.')!</div>';
					else echo '<div class="alert alert-danger">Gagal hapus data mahasiswa dengan NIM ('.$hapus.')!</div>';
				} else {
					echo '<div class="alert alert-danger">NIM ('.$hapus.') tidak ditemukan!</div>';
				}
			}

			echo '
				<form method="get">
					<table class="table table-bordered">
						<tr>
							<th class="table-info" width="15%" nowrap>NIM</th>
							<td><input type="text" class="form-control" name="nim" value="'.$nim.'" required></td>
						</tr>
						<tr>
							<td colspan="2"><input class="btn btn-success" type="submit" value="CARI"></td>
						</tr>
					</table>
				</form>
				<br>
			';

			if ($nim != "") {
				if (isset($_POST['ganti'])) {
					$new_data['nama'] = isset($_POST['nama']) ? $_POST['nama'] : "";
					$new_data['ipk'] = isset($_POST['ipk']) ? (float) $_POST['ipk'] : "";
					$new_data['asal'] = isset($_POST['asal']) ? $_POST['asal'] : "";

					if ($new_data['nama'] == "" || $new_data['ipk'] == "" || $new_data['asal'] == "") {
						echo '<div class="alert alert-danger">Pastikan semua kolom sudah diisi!</div>';
					} else {
						$data = select_data($nim);
						if (sizeof($data) > 0) {
							if (update_data($nim,$new_data)) echo '<div class="alert alert-success">Sukses ganti data mahasiswa dengan NIM ('.$nim.')!</div>';
							else echo '<div class="alert alert-danger">Gagal ganti data mahasiswa dengan NIM ('.$hapus.')!</div>';
						} else {
							echo '<div class="alert alert-danger">NIM ('.$hapus.') tidak ditemukan!</div>';
						}
					}
				}

				$data_table = '';
				$data = select_data($nim);
				if (sizeof($data) > 0) {
					echo '
						<form method="post" action="menu_detail.php?nim='.$nim.'">
							<table class="table table-bordered table-hover">
								<tr>
									<th class="table-info" width="15%" nowrap>NIM</th>
									<td><input type="text" class="form-control" value="'.$nim.'" disabled></td>
								</tr>
								<tr>
									<th class="table-info">Nama</th>
									<td><input class="form-control" type="text" name="nama" value="'.$data[0]['nama'].'" required></td>
								</tr>
								<tr>
									<th class="table-info">IPK</th>
									<td><input class="form-control" type="text" name="ipk" value="'.$data[0]['ipk'].'" required></td>
								</tr>
								<tr>
									<th class="table-info">Asal</th>
									<td><input class="form-control" type="text" name="asal" value="'.$data[0]['asal'].'" required></td>
								</tr>
								<tr>
									<td colspan="2">
										<input class="btn btn-warning text-light" type="submit" name="ganti" value="GANTI">
										 &nbsp;&nbsp;&nbsp; 
										<a class="btn btn-danger text-light" href="menu_detail.php?hapus='.$nim.'">HAPUS</a>
									</td>
								</tr>
							</table>
						</form>
					';
				} else {
					echo '<div class="alert alert-danger">NIM tidak ditemukan</div>';
				}
			}
		}
	?>
	</div>
</body>

</html>