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
							echo '<div class="collapsible-body"> <a href="TODO">' . $unit['unitname'] . '</a> </div>';
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

</body>

<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="../shared/js/materialize.min.js"></script>
<script src="js/init.js"></script>
</html>
