<?php
session_start();
if (isset($_SESSION['loggeduser'])) {
	header('Location: main.php');
}
?>

<html>
<head>
	<title>Bookmark Manager</title>
	<link href="../shared/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
	<link href="../shared/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script src="../shared/js/materialize.js"></script>
	<script src="../shared/js/init.js"></script>
</head>
<nav class="pink lighten-1" role="navigation">
<div class="nav-wrapper container">
	<ul class="right hide-on-med-and-down">
		<li><a class="white-text" href="welcome.php">Home</a></li>
	</ul>
</div>
</nav>

<body class="cyan">
<div class="row">
	<div class="col s3">
		<form class="card-panel" method="post" action="server/login.php">
			<div class="row">
				<div class="input-field col s12 center">
					<h5 class="center login-form-text">Login</h5>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12 center">
					<i class="material-icons prefix">perm_identity</i>
					<input name="username" type="text">
					<label for="username" class="center-align">Username</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12 center">
					<i class="material-icons prefix">lock_outline</i>
					<input name="password" type="password">
					<label for="password">Password</label>
				</div>
			</div>
			<div class="row">
				<p class="red-text center">
				<?php
					if(isset($_GET['failed']) && $_GET['failed']) {
						echo 'Username or password is wrong';
					};
				?>
				</p>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<button type="submit" class="btn waves-effect waves-light col s12">Login</button>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s6 m6 l6">
					<p class="margin medium-small"><a href="registerpage.php">Register Now!</a></p>
				</div>
			</div>

		</form>
	</div>
	<div class="col s9">
		<div class="col-content card-panel">
			<h3>Top Bookmarks:</h3>
			<ol>
				<li>bookmark 1</li>
				<li>bookmark 2</li>
				<li>bookmark 3</li>
				<li>bookmark 4</li>
				<li>bookmark 5</li>
			</ol>
		</div>
	</div>
</div>

</body>

<?php
include 'helper/database.php';
include 'helper/database_init.php';


?>
</html>
