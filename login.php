<!DOCTYPE html>
<html lang="en">

<head>
	<title>Login Page</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="templates/bootstrap.min.css">
	<script src="templates/jquery.min.js"></script>
	<script src="templates/popper.min.js"></script>
	<script src="templates/bootstrap.min.js"></script>
</head>
<body>
	<nav class="navbar navbar-expand-sm bg-dark navbar-dark"> 
		<a class="navbar-brand" href="login.php">ADMIN PANEL</a>
	</nav>
	<div class="container" style="margin-top:50px">
<?php
require_once "functions.php";

if (isset($_SESSION['user'])) {
	header("Location: index.php");
} else {
	if (isset($_POST['login'])) {
		$user = $_POST['user'];
		$pass = $_POST['pass'];

		if ($user == "admin" && $pass = "1234") {
			$_SESSION['user'] = $user;
			header("Location: index.php");
		} else {
			echo '<div class="alert alert-danger">Username/Password salah!</div>';
		}
	}

	echo '
		<form method="post">
			<table class="table">
				<tr>
					<th width="5%" nowrap>Username</th>
					<td><input class="form-control" type="text" name="user" required></td>
				</tr>
				<tr>
					<th width="5%" nowrap>Password</th>
					<td><input class="form-control" type="password" name="pass" required></td>
				</tr>
				<tr>
					<td colspan="2"><input class="btn btn-success" type="submit" name="login" value="LOGIN"></td>
				</tr>
			</table>
		</form>
	';
}
?>
	</div>
</body>

</html>