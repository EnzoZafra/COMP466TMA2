<?php 
if (empty($_POST))
{
	include 'forbidden.php';
	die();
}
else {
	include '../helper/database.php';
	session_start();

	$url = $_POST["url"];

	$id = $_SESSION['loggeduser'];
	if ($id) {
		$row = DB::run("DELETE FROM bookmarks WHERE `users_userid`=? AND `url`=?"
			, [$id, $url]);
		header('Location: ../main.php');
	}
	else {
		header('Location: notlogged.php');
	}
}
?>
