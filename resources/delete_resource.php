<?php

	session_start();
	include("db_login.php");
	$delete_id = $sql_delete = "";
	if($_SERVER["REQUEST_METHOD"] == "GET"){
			$delete_id = $_GET["id"];

			// deleting the post who's id is being send as a 'GET' request
			$sql_delete = "DELETE FROM upload__ WHERE id = '$delete_id'";

			if(mysqli_query($connect_link, $sql_delete))
				header("location: dashboard.php");
			else
				header("location: ../html/error.html");

			//!! IMPORTANT : redirect the control to a page that shows error(maybe one page for error only! [error can be non-specific])

	}
?>
