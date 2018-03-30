<?php 
if (empty($_POST))
{
	include 'forbidden.php';
	die();
}
else {
	include '../helper/database.php';

	$username = $_POST["username"];
	$password = md5($_POST["password"]);

	$check = DB::run("SELECT * FROM users WHERE `username`=?", [$username])->fetch();
	if ($check) {
		$usertaken = true;
		header('Location: ../registerpage.php?taken='. $usertaken);
	}
	else {
		$row = DB::run("INSERT INTO users (`username`, `password`) VALUES (?, ?)"
			, [$username, $password]);
		header('Location: ../welcome.php');
	}
}
?>
