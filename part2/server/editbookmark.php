<?php 
if (empty($_POST))
{
	include 'forbidden.php';
	die();
}
else {
	include '../helper/database.php';
	session_start();

	$oldurl = $_POST["oldurl"];
	$newurl = $_POST["newurl"];
	$user = DB::run("SELECT userid FROM users WHERE `username`=?", [$_SESSION['loggeduser']])->fetch();
	if ($user) {
		$id = $user['userid'];
		$bookmarkid = DB::run("SELECT bookmarkid FROM bookmarks WHERE `url`=?", [$oldurl])->fetch()['bookmarkid'];
		$update = DB::run("UPDATE bookmarks SET url=? WHERE bookmarkid=?", [$newurl, $bookmarkid]);
		header("Refresh:0");
	}
	else {
		header('Location: notlogged.php');
	}
}
?>
