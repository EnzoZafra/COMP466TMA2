<?php 
include 'helper/database.php';
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
$topics = DB::run("SELECT * FROM topics WHERE units_unitid=?", [$unitid])->fetchAll(PDO::FETCH_ASSOC);
?>

<html>
<?php include 'navigation.php'; ?>
<body class="cyan">
	<div class="container">
		<div class="card-panel">
			<?php 
			include 'helper/parser.php';
			echo '<h2 class="teal-text">Unit ' . $unitid . '</h2>';
			foreach ($topics as $topic) {
				echo('<hr></hr>');
				echo '<h4>'.$topic['topicname'].'</h4>';
				$content = $topic['content'];
				$parsedcontent = parseContent($content);
				if ($parsedcontent) {
					foreach($parsedcontent as $subtopic) {
						echo '<h5>' . $subtopic['header'] . '</h5>';
						echo '<div class="collection"><ul>';
						foreach($subtopic['data'] as $data) {
							echo '<li class="black-text collection-item">'. $data .'</li>';
						}
						echo '</ul></div>';
					}

				}

			}
			echo '<div class="center row">
				<form action="quiz.php" method="post" class="dropdown-form">
				<input type="hidden" name="unitid" value="' . $unitid . '"></input>
				<button class="waves-effect waves-light btn" type="submit">Take the quiz</button></form></div>';

			?>
		</div>
	</div>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="../shared/js/materialize.min.js"></script>
<script type="text/javascript" src="js/init.js"></script>
</body>

</html>
