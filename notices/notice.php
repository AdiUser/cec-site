<!DOCTYPE html>
<html lang="en_EN">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Career Excellence">
    <meta name="author" content="CSIT-Education Section">
	<title>Notice Board</title>
  <!-- <link href="../css/bootstrap.css" rel="stylesheet"> -->
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/style.css" rel="stylesheet">
	<link href="../css/notice-board.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
	<script src="../js/jQuery.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>

</head>
<body>
<?php
	session_start();
	include("../resources/db_login.php");
?>
  <?php include("../nav-bar.php");?>

		<div class="container">
			<div class="row text-center">
				<p id="notice_" >Notice Board</p>
			</div>

		</div>
		<div class="container" style="min-height:450px;">
			<div class="row">
				<hr>
				<?php

					if(isset($_GET["Id"])){
							$id = $_GET["Id"];
							$sqli_ = "SELECT * FROM post__ WHERE id = $id";

							$sql_query = mysqli_query($connect_link, $sqli_);
							if($sql_query){
								$post =  mysqli_fetch_array($sql_query, MYSQLI_ASSOC);
								?>
										<div style="font-size:30px"><?=$post["post_title"]?></div>
									<div class="notice_sec"><?=$post["post_content"]?></div>
								<?php

							}
								else
									header("location: ../html/error.html");



					}
					else
						header("location: ../html/error.html");

				?>
			</div>
		</div>
<!-- Footer Section -->

	<footer class="footer-basic-centered">

		<p class="footer-company-motto">Design & Developed By: Vishal Sanserwal | Aditya Saxena</p>
		<p class="footer-company-name">CEC &copy; 2017</p>

</footer>

	<!-- Footer Section End -->
    <script>
    // Collapse navbar when clicked
    $(document).on('click','.navbar-collapse.in',function(e) {
    if( $(e.target).is('a') ) {
        $(this).collapse('hide');
    }
    });
    </script>




</body>
</html>
