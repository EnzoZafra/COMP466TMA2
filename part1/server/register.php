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

	$row = DB::run("INSERT INTO users (`username`, `password`) VALUES (?, ?)"
		, [$username, $password]);

	include 'welcome.php';
}
?>
