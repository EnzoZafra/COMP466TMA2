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
			<h4>Course Overview</h4>
			<hr>
			<ul class="collapsible">
				<li>
					<div class="collapsible-header">COMP 466</div>
					<div class="collapsible-body">
						<ul class="browser-default">
							<li><a>Unit 1</a></li>
							<li><a>Unit 2</a></li>
							<li><a>Unit 3</a></li>
						</ul>
					</div>
				</li>
				<li>
					<div class="collapsible-header">COMP 466</div>
					<div class="collapsible-body">
						<ul class="browser-default">
							<li><a>Unit 1</a></li>
							<li><a>Unit 2</a></li>
							<li><a>Unit 3</a></li>
						</ul>
					</div>
				</li>
				<li>
					<div class="collapsible-header">COMP 466</div>
					<div class="collapsible-body">
						<ul class="browser-default">
							<li><a>Unit 1</a></li>
							<li><a>Unit 2</a></li>
							<li><a>Unit 3</a></li>
						</ul>
					</div>
				</li>
			</ul>
		</div>
	</div>

</body>

<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="../shared/js/materialize.min.js"></script>
<script src="js/init.js"></script>
</html>
