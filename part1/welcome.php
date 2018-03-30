<?php
include 'helper/database.php';
include 'helper/database_init.php';
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
	<div class="container"><a href="welcome.php" class="brand-logo">Bookmark Manager</a></div>
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
				<?php
				$query = DB::run("SELECT url, count(url) as count FROM bookmarks GROUP BY url ORDER BY count DESC LIMIT 10;");
				while ($row = $query->fetch(PDO::FETCH_LAZY))
				{
					$url = $row['url'];
					echo "<li><a href=\"" . $url . "\" target=\"_blank\">". $url . "</a></li>";
				}
				?>
			</ol>
		</div>
	</div>
</div>

</body>

</html>
