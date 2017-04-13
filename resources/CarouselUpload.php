<?php
	
	include ("db_login.php");

	$imgArr = []; $imgCount = 0; $carousel_int = ""; $query = false;
	if($_SERVER["REQUEST_METHOD"] == "POST"){

		for($i = 0 ; $i<=4 ; $i++)
			if(!empty($_POST["img".$i])){
				$imgArr[$imgCount] = $_POST["img".$i];
				$imgCount++;
			}

		if(!empty($_POST["carousel_int"]))
			$carousel_int = $_POST["carousel_int"];

		foreach($imgArr as $img){
			$query = mysqli_query($connect_link,
				"INSERT INTO carousel (__path, __carousel_int) VALUES ('$img','$carousel_int')");
			if(!$query){
				//header("location: error.php")
				header("location: ../html/error.html");
			}
		}

		if($query)
			header("location: dashboard.php");
		else
			header("location: ../html/error.html");

		mysqli_close($connect_link);



			
			




	}

?>
