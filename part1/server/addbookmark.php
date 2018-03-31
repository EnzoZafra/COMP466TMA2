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
		$duplicate = DB::run("SELECT bookmarkid FROM bookmarks WHERE `url`=? AND `users_userid`=?", [$url, $id])->fetch();
		if($duplicate) {
			header('Location: ../main.php?duplicate=true');
			die();
		}
		$row = DB::run("INSERT INTO bookmarks (`url`, `users_userid`) VALUES (?, ?)"
			, [$url, $id]);
		header('Location: ../main.php');
	}
	else {
		header('Location: notlogged.php');
	}
}
?>
