<?php
	session_start();
	include("db_login.php");
	$delete_id = $sql_delete = "";
	if($_SERVER["REQUEST_METHOD"] == "GET"){
			$delete_id = $_GET["id"];
			$dataMeta = $_GET["x"];
			$dataTable = ""; $col = "id";

			switch($dataMeta){
				case "u":
					$dataTable = "upload__";
					break;

				case "p":
					$dataTable = "post__";
					break;
				default:
					$dataTable = "";
					break;		
			}


			// deleting the post/resource who's id is being send as a 'GET' request


			$sql_delete = "DELETE FROM $dataTable WHERE $col = '$delete_id'";

			if(mysqli_query($connect_link, $sql_delete))
				header("location: dashboard.php");
			else
				header("location: ../html/error.html");

			//!! IMPORTANT : redirect the control to a page that shows error(maybe one page for error only! [error can be non-specific])

	}
?>
