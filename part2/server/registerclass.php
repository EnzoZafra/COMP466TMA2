<?php 
if (empty($_POST))
{
	include 'forbidden.php';
	die();
}
else {
	include '../helper/database.php';
	session_start();
	$id = $_SESSION['loggeduser'];
	$courseid = $_POST["courseid"];

	if ($id && $courseid) {
		$row = DB::run("INSERT INTO users_has_courses (`users_userid`, `courses_courseid`) VALUES (?, ?)"
			, [$id, $courseid]);
		header('Location: ../success.php');
	}
}
?>
