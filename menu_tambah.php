<!DOCTYPE html>
<html lang="en">

<head>
	<title>Tambah Mahasiswa</title>
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
				<li class="nav-item active"> 
					<a class="nav-link" href="menu_tambah.php">Tambah Mahasiswa</a>
				</li>
				<li class="nav-item"> 
					<a class="nav-link" href="menu_data.php">Data Mahasiswa</a>
				</li>
				<li class="nav-item"> 
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
			if (isset($_POST['tambah'])) {
				$tambah_data['nim'] = isset($_POST['nim']) ? $_POST['nim'] : "";
				$tambah_data['nama'] = isset($_POST['nama']) ? $_POST['nama'] : "";
				$tambah_data['ipk'] = isset($_POST['ipk']) ? (float) $_POST['ipk'] : "";
				$tambah_data['asal'] = isset($_POST['asal']) ? $_POST['asal'] : "";
				$tambah_data['pass'] = isset($_POST['pass']) ? $_POST['pass'] : "";

				if ($tambah_data['nim'] == "" || $tambah_data['nama'] == "" || $tambah_data['ipk'] == "" || $tambah_data['asal'] == "" ||$tambah_data['pass'] == "") {
					echo '<div class="alert alert-danger">Pastikan semua kolom sudah diisi!</div>';
				} else {
					$data = select_data($tambah_data['nim']);
					if (sizeof($data) > 0) {
						echo '<div class="alert alert-danger">NIM ('.$tambah_data['nim'].') sudah terdaftar!</div>';
					} else {
						if (insert_data($tambah_data)) echo '<div class="alert alert-success">Sukses tambah data mahasiswa dengan NIM ('.$tambah_data['nim'].')!</div>';
						else echo '<div class="alert alert-danger">Gagal tambah data mahasiswa!</div>';
					}
				}
			}

			echo '
				<form method="post">
					<table class="table table-bordered ">
						<tr>
							<th class="table-info" width="15%" nowrap>NIM</th>
							<td><input class="form-control" type="text" name="nim" required></td>
						</tr>
						<tr>
							<th class="table-info">Nama</th>
							<td><input class="form-control" type="text" name="nama" required></td>
						</tr>
						<tr>
							<th class="table-info">IPK</th>
							<td><input class="form-control" type="text" name="ipk" required></td>
						</tr>
						<tr>
							<th class="table-info">Asal</th>
							<td><input class="form-control" type="text" name="asal" required></td>
						</tr>
						<tr>
							<th class="table-info">Password</th>
							<td><input class="form-control" type="password" name="pass" required></td>
						</tr>
						<tr>
							<td colspan="2"><input class="btn btn-info" type="submit" name="tambah" value="TAMBAH"></td>
						</tr>
					</table>
				</form>
			';
		}
	?>
	</div>
</body>

</html>