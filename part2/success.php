<?php
session_start();
if (!isset($_SESSION['loggeduser'])) {
	header('Location: server/notlogged.php');
}
?>
<html>
<?php include 'navigation.php'; ?>
<body class="cyan">
	<div class="container">
		<div class="card-panel">
			<h5>Success!</h5>
			<b>You are being redirected back to the main page in 3 seconds. To redirect now, click <a href="main.php">here.</a></b>
			<?php
			header( "refresh:5;url=main.php" );
			?>
		</div>
	</div>
</body>

<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="../shared/js/materialize.min.js"></script>
<script src="js/init.js"></script>
</html>
