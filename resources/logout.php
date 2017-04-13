<?php

	session_start();
	
	if(session_destroy())
		header("location: ../admin-login.php");
	else{

		$_SESSION["is_logged_in"] = 0;
	}

?>
