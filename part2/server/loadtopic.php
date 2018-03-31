<?php 
if (empty($_POST))
{
	include 'forbidden.php';
	die();
}
else {
	include '../helper/database.php';
	session_start();
	$unitid = $_POST["unitid"];

	if ($unitid) {
		$topics = DB::run("SELECT * FROM topics WHERE units_unitid=?", [$unitid]);
		while ($topic = $topics->fetch(PDO::FETCH_LAZY)) {
			/* TODO: change <> to {} or some sort of delimiter for EML */
echo '<script>
    console.log(json_encode('.addslashes($topic['content']).'); ?>);
</script>';
		}
	}
}
?>
