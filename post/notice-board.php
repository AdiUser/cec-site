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
<body >
<?php
	session_start();
	include("../resources/db_login.php");
	include("../resources/pagination.php");
	$postCount = $pageCount = 0;  
	$postPerPage = 8;
	$page = 1;
	
	$postCount = getTotalPostCount($connect_link, 'post__');
	$pageCount = ceil($postCount/$postPerPage);

	if(isset($_GET["page"])){
		$pageNum = $_GET["page"];
		if($pageNum > $pageCount)
			header("location: ../html/error.html");
		else{
		$posts = getPostFromInterval($connect_link,($pageNum-1)*$postPerPage, $postPerPage,"post__");

		if(!$posts)
			header("location: ../html/error.html");
	
	}
	}

?>

	<?php include("../nav-bar.php");?>

<div class="container" >
	<br>
	<br>
	<br>

	<div class="row">
		<p id="notice_" style="text-align:center">Notice Board</p>
	</div>

</div>
<div class="container" style="min-height:400px;" >
	<div class="row">

	<hr>
	<?php

		while($fetched_posts = mysqli_fetch_array($posts, MYSQLI_ASSOC)){

			$arrDate = explode("-", $fetched_posts["post_date"]);
			$month = date("M", mktime(0,0,0,$arrDate[1],10));

	?>
		<div class="whole_notice">
			<div class="notice_section">
			<div class="row-my">
			<div class="col-my-2">
				<div class="date">
				  <span class="day"><?=$arrDate[2]?></span>
				  <span class="month"><?=$month?></span>
				  <span class="year"><?=$arrDate[0]?></span>
				</div>
				</div>
				<div class="col-my-10 upload_title">

				<div class="notice_sec">
					<a href="../notices/notice?Id=<?=$fetched_posts['id']?>" id="notice_post"><?=$fetched_posts["post_title"]?></a>
				</div>
				<div class="post_credits">
			<span id="post_by" >Post by: CEC</span><span id="post_for"></span>
			</div>
			</div>
			</div>
			</div>

			</div>
			<?php }?>


			</div>

</div>
<div class="container">

  <ul class="pagination">
  <?php while($pageCount!=0){ ?>

    <li><a href="notice-board?page=<?=$page?>"><?=$page;?></a></li>


    <?php
    	$pageCount--;
    	$page++;
    	}
    ?>
  </ul>
</div>
<div class="footer-basic-centered">
<!-- Footer Section -->

	<footer >

		<p class="footer-company-motto">Design & Developed By: Vishal Sanserwal | Aditya Saxena</p>
		<p class="footer-company-name">CEC &copy; 2017</p>

</footer>
</div>

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
