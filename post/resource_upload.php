<?php
			
	include("../php/db_login.php");		
	$resource_title = $resource_content = $sql_resource_save = $resource_cat = $resource_date = "";
		  	
		if(isset($_POST["resource_submit"]) 
		  	&& $_SERVER["REQUEST_METHOD"] == "POST" ){
		  	
		  	$upload_date = date("Y:m:d");
		  	$resource_title = $_POST["upload_title"];
		  	$resource_content = $_POST["upload_content"];
		  	$resource_cat = $_POST["upload_category"];

		  		if(isset($resource_content)
		  			&& isset($resource_title)){
		  			$resource_date = date("Y-m-d");
		  			$sql_resource_save = "INSERT INTO upload__ (upload_title, upload_content, upload_category,
		  			upload_date) VALUES('$resource_title', '$resource_content','$resource_cat','$resource_date')";

		  			if(mysqli_query($connect_link, $sql_resource_save))
		  					header("location: ../php/dashboard.php");
		  			else
		  					echo "Could not uplaod the resource".mysqli_error($connect_link).$sql_resource_save;
		  				// header to the error page!
		  			}
		  			else
		  				echo "Input not recived!".$_POST["upload_title"].$_POST["upload_content"];

		  		}
?>
