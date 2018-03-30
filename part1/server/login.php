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

	$row = DB::run("SELECT * FROM users WHERE username=? AND password=?", [$username, $password])->fetch();
	var_dump($row);
}
?>
