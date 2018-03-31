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
	$id = $_SESSION['loggeduser'];
	if ($id) {
		$bookmarkid = DB::run("SELECT bookmarkid FROM bookmarks WHERE `url`=?", [$oldurl])->fetch()['bookmarkid'];
		$update = DB::run("UPDATE bookmarks SET url=? WHERE bookmarkid=?", [$newurl, $bookmarkid]);
		header("Refresh:0");
	}
	else {
		header('Location: notlogged.php');
	}
}
?>
