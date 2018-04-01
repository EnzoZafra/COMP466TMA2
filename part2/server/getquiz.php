<?php 
include '../helper/database.php';
include '../helper/parser.php';
session_start();

if (isset($_POST["unitid"]))
{
	$unitid = $_POST["unitid"];
	if ($unitid) {
		$_SESSION['selectedunit'] = $unitid;
	}
}
else if (isset($_SESSION['selectedunit'])) {
	$unitid = $_SESSION['selectedunit'];
}
else {
	header('Location: forbidden.php');
	die();
}
$quiz = DB::run("SELECT * FROM quizzes WHERE units_unitid=?", [$unitid])->fetch();

$content = $quiz['content'];
$parsedcontent = parseQuiz($content);
if ($parsedcontent) {
	echo json_encode($parsedcontent);
}
