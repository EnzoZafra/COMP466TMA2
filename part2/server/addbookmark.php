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

	$user = DB::run("SELECT userid FROM users WHERE `username`=?", [$_SESSION['loggeduser']])->fetch();
	if ($user) {
		var_dump($user);
		$id = $user['userid'];
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
