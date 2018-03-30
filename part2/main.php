<html>
<head>
	<title>Bookmark Manager</title>
	<link href="../shared/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
	<link href="../shared/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
	<link rel="stylesheet" href="../shared/css/materialize-collection-actions-1.0.0.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script src="../shared/js/materialize.js"></script>
	<script src="../shared/js/materialize-collection-actions-1.0.0.min.js"></script>
</head>

<nav class="pink lighten-1" role="navigation">
	<div class="nav-wrapper container">
		<a href="main.php" class="brand-logo">Bookmark Manager</a>
		<ul class="right hide-on-med-and-down">
			<li><a class="white-text" href="server/logout.php">Logout</a></li>
		</ul>
	</div>
</nav>

<body class="cyan">

<div class="row">
	<div class="col s3">
		<form name="bookmarkform" class="card" action="server/addbookmark.php" method="post" onsubmit="return validateURL()">
			<div class="row">
				<div class="input-field col s12 center">
					<h5 class="center login-form-text">Add a Bookmark</h5>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s11 center">
					<i class="material-icons prefix">link</i>
					<input name="url" type="url">
					<label for="url" class="center-align">URL</label>
				</div>
			</div>
			<div class="row">
				<p class="red-text center">
				<?php
					if(isset($_GET['duplicate']) && $_GET['duplicate']) {
						echo 'That URL is already bookmarked';
					};
				?>
				</p>
			</div>
			<div class="row">
				<div class="input-field center">
					<button type="submit" class="btn waves-effect waves-light">Add</button>
				</div>
			</div>
			<div class="row"></div>
		</form>
	</div>
	<div class="col s9">
		<div class="col-content card-panel">
			<h4> Your Bookmarks</h4>
			<div id="collection-id" class="collection mca-always-visible">
			<?php
			include 'helper/database.php';
			session_start();
			$id = DB::run("SELECT userid FROM users WHERE `username`=?", [$_SESSION['loggeduser']])->fetch()['userid'];
			$query = DB::run("SELECT * FROM bookmarks WHERE users_userid=?", [$id]);
			while ($row = $query->fetch(PDO::FETCH_LAZY))
			{
				$url = $row['url'];
				echo "<a href=\"" . $url . "\" class=\"collection-item\" target=\"_blank\">" . $url . "</a>";
			}
			?>
			</div>
		</div>

	</div>
</div>

<script src="main.js"></script>
</body>
</html>
