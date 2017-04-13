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
?>
  <?php include("../nav-bar.php");include("pagination.php"); ?>

		<div class="container" >
			<br>
			<br>
			<br>

			<div class="row text-center">
				<p id="notice_" >Resources</p>
			</div>
      <hr>

		</div>
		<div class="container " style="min-height:400px;" >
			<div class="row">
      <div class="col-md-6">
				
				<?php
          $categories = array("first","second","third","fourth","common");
          $postCount = $pageCount = 0;  
          $postPerPage = 10;
          $page = 1;
          
          if(!isset($_GET["page"])) $pageNum = 1;
          else $pageNum = $_GET["page"];


					if(isset($_GET["cat"])){

            if(in_array($_GET["cat"], $categories)){
							$category = $_GET["cat"];
              $postCount = getTotalPostCountWithCategory($connect_link, "upload__",$category);
              $pageCount = ceil($postCount/$postPerPage);

              
              if($pageNum > $pageCount) header("location: ../html/error.html");
               
              else $sql__ = getResources($connect_link,($pageNum-1)*$postPerPage, $postPerPage,"upload__", $category);
              
              if($sql__){
                for($i=0; $i < 5; $i++){
                  $resources = mysqli_fetch_array($sql__, MYSQLI_ASSOC);
                  if($resources){
                  $resourcesDate = explode("-", $resources["upload_date"]);
                  $month = date("M", mktime(0,0,0,$resourcesDate[1],10));


                  ?>
                  
                  <div class="whole_notice">
              			<div class="notice_section">
              			<div class="row-my">
              			<div class="col-my-2">
              				<div class="date">
              				  <span class="day"><?=$resourcesDate[2]?></span>
              				  <span class="month"><?=$month?></span>
              				  <span class="year"><?=$resourcesDate[0]?></span>
              				</div>
              				</div>
              				<div class="col-my-10 upload_title">

              				<div class="notice_sec">
              					<a id="notice_post" download><?=$resources["upload_title"]?></a>
              				</div>
                      <div class="post_credits">
              				<?=$resources["upload_content"]?>
              				</div>

              			</div>
              			</div>
              			</div>

              			</div>

                     <?php }
                     }
                      ?>

                    </div>
                    <div class="col-md-6">
                    <?php 
                      for(; $i<=10; $i++){ 
                          $resources = mysqli_fetch_array($sql__, MYSQLI_ASSOC);
                          if($resources){
                          $resourcesDate = explode("-", $resources["upload_date"]);
                          $month = date("M", mktime(0,0,0,$resourcesDate[1],10));

                        ?>

                      <div class="whole_notice">
                    <div class="notice_section">
                    <div class="row-my">
                    <div class="col-my-2">
                      <div class="date">
                        <span class="day"><?=$resourcesDate[2]?></span>
                        <span class="month"><?=$month?></span>
                        <span class="year"><?=$resourcesDate[0]?></span>
                      </div>
                      </div>
                      <div class="col-my-10 upload_title">

                      <div class="notice_sec">
                        <a id="notice_post" download><?=$resources["upload_title"]?></a>
                      </div>
                      <div class="post_credits">
                      <?=$resources["upload_content"]?>
                      </div>

                    </div>
                    </div>
                    </div>

                    </div>
                     <?php } } ?>

                    </div>
                    </div>
              <?php }

              else 
                header("location: ../html/error.html");
            }
					else
						header("location: ../html/error.html");
        }
        else
            header("location: ../html/error.html"); 
				?>
			</div>
		</div>
    <div class="container">

      <ul class="pagination" style="font-size: 17px;">
      <?php while(($pageCount)!=0){ ?>

       <li><a href="resources?cat=<?=$category?>&page=<?=$page?>"><?=$page;?></a></li>
        <?php
          $pageCount--;
          $page++;
         }
        ?>
      </ul>
    </div>
<!-- Footer Section -->
<div class="footer-basic-centered">
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
