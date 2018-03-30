<!DOCTYPE html>
<html lang="en">
<head>
	<title>Register for Bookmark Manager</title>

	<link href="../shared/css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection">
	<link href="../shared/css/style.css" type="text/css" rel="stylesheet" media="screen,projection">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<script type="text/javascript" src="js/plugins/jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="js/materialize.min.js"></script>
</head>

<body class="cyan">
  <div class="row">
	<div class="col s12 z-depth-4 card-panel">
	  <form method="post" action="server/register.php">
		<div class="row">
		  <div class="input-field col s12 center">
			<h4>Register</h4>
		  </div>
		</div>
		<div class="row margin">
		  <div class="input-field col s12">
			<i class="material-icons prefix">perm_identity</i>
			<input name="username" type="text">
			<label for="username" class="center-align">Username</label>
		  </div>
		</div>
		<div class="row margin">
		  <div class="input-field col s12">
			<i class="material-icons prefix">lock_outline</i>
			<input name="password" type="password">
			<label for="password">Password</label>
		  </div>
		</div>
		<div class="row">
		  <div class="input-field col s12">
			<button action="submit" class="btn waves-effect waves-light col s12">Register Now</button>
		  </div>
		  <div class="input-field col s12">
			<p class="margin center medium-small">Already have an account? <a href="welcome.php">Login</a></p>
		  </div>
		</div>
	  </form>
	</div>
  </div>

</body>

</html>
