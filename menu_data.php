<!DOCTYPE html>
<html lang="en">

<head>
	<title>Data Mahasiswa</title>
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
				<li class="nav-item active"> 
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
			$data_table = '';
			$data = select_data();
			foreach ($data as $key => $val) {
				$data_table .= '
					<tr>
						<td><center><a href="menu_detail.php?nim='.$val['nim'].'">'.$val['nim'].'</a></center></td>
						<td>'.$val['nama'].'</td>
						<td><center>'.$val['ipk'].'</center></td>
						<td>'.$val['asal'].'</td>
					</tr>
				';
			}

			if ($data_table == "") {
				$data_table = '<tr class="table-danger"><th colspan="4"><center>NO DATA</center></th></tr>';
			}

			echo '
				<table class="table table-bordered table-hover">
					<tr class="table-success">
						<th width="15%" nowrap><center>NIM</center></th>
						<th width="20%" nowrap>Nama</th>
						<th width="5%" nowrap><center>IPK</center></th>
						<th>Asal</th>
					</tr>
					'.$data_table.'
				</table>
			';
		}
	?>
	</div>
</body>

</html>