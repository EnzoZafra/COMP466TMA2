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
			<h4>Available Courses</h4>
			<ul class="collapsible">
				<?php
				include 'helper/database.php';
				$id = $_SESSION['loggeduser'];
				if ($id) {
					$courses = DB::run('SELECT * from courses where courseid not in (select courses_courseid from users_has_courses where users_userid=?);', [$id]);
					$rows = $courses->fetchAll(PDO::FETCH_ASSOC);
					if($rows) {
						foreach ($rows as $row)
						{
							echo '<li>';
							echo '<div class="collapsible-header">' . $row['coursename'] . '</div>';
							echo '<div class="collapsible-body"> <form action="server/registerclass.php" method="post"><p>' . $row['description'] . '</p> 
								<input type="hidden" name="courseid" value="'. $row['courseid'] . '">
								<button type="submit" class="btn waves-effect waves-light"><i class="material-icons left">send</i>Register</button>  </form> </div>';
							echo '</li>';
						}
					}
					else {
						echo '<b>There are no available courses that you have not registered for at the moment.</b>';
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
