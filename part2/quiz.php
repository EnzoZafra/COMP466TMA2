<?php 
include 'helper/database.php';
session_start();
if (isset($_POST["unitid"]))
{
	$unitid = $_POST["unitid"];
	if ($unitid) {
		$_SESSION['selectedunit'] = $unitid;
		$topics = DB::run("SELECT * FROM topics WHERE units_unitid=?", [$unitid])->fetchAll(PDO::FETCH_ASSOC);
	}
}
else if (isset($_SESSION['selectedunit'])) {
	$unitid = $_SESSION['selectedunit'];
	$topics = DB::run("SELECT * FROM topics WHERE units_unitid=?", [$unitid])->fetchAll(PDO::FETCH_ASSOC);
}
else {
	header('Location: forbidden.php');
	die();
}
?>

<html>

<?php include 'navigation.php'; ?>
<body class="cyan">
	<div class="container">
		<div class="card-panel">
			<h3 class="teal-text text-lighten-3"><?php echo 'Unit '.$unitid.' Quiz';?></h3>
			<hr>
			<div id="quiz" class="row">
				<form id="quizform">
				</form>
			</div>
			<div id="results" class="row"></div>
			<input id="hiddenid" type="hidden" value="<?php echo $unitid; ?>">
		</div>
	</div>

	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="../shared/js/materialize.min.js"></script>
	<script type="text/javascript" src="js/quiz.js"></script>
	<script>startQuiz();</script>

</body>
</html>
