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
				<?php
				include 'helper/database.php';
				$id = $_SESSION['loggeduser'];
				if ($id) {
					$mycourses = DB::run('SELECT * from courses where courseid in (select courses_courseid from users_has_courses where users_userid=?);', [$id]);
					$rows = $mycourses->fetchAll(PDO::FETCH_ASSOC);
					if($rows) {
						foreach ($rows as $row)
						{
							echo '<li>';
							echo '<div class="collapsible-header">' . $row['coursename'] . '</div>';
							$units = DB::run('SELECT * from units where courses_courseid=?', [$row['courseid']]);
							while ($unit = $units->fetch(PDO::FETCH_LAZY))
							{
								/* echo '<div class="collapsible-body"> */ 
								/* 	<a class="modal-trigger" href="#myModal"' . $unit['unitid'] . '>' */ 
								/* 	. $unit['unitname'] . '</a> </div>'; */
								echo '<div class="collapsible-body"> <form class="dropdown-form" action="server/loadtopic.php" method="post">
									<a onclick="submitForm(this)" href="#">' . $unit['unitname'] . '</a>
									<input id="hiddenId" type="hidden" name="unitid" value="'. $unit['unitid'] . '">
									</form>
									</div>';
							}
							echo '</li>';
						}
					}
					else {
						echo '<b>You are not registered for any courses. To register, please visit the <a href="courses.php">Register</a> page</b>';
					}
				}
				else {
					header('Location: notlogged.php');
				}
				?>
			</ul>
		</div>
	</div>
	<div id="myModal" class="modal modal-fixed-footer">
		<div class="modal-content">
		<h4>Modal Header</h4>
		<p>A bunch of text</p>
		</div>
		<div class="modal-footer">
		<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Agree</a>
		</div>
	</div>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="../shared/js/materialize.min.js"></script>
<script type="text/javascript" src="js/init.js"></script>
</body>

</html>
