<?php

$server = "localhost";
$username = "root";
$pass = "";
$db_name = "cepp";

$connect_link = mysqli_connect($server, $username, $pass, $db_name);

	if(mysqli_connect_errno())
		header("location: ../html/error.html"); 




?>
