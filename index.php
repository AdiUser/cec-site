<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Career Excellence">
    <meta name="author" content="CSIT-Education Section">

    <title>CEC-GEU</title>
    <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
   <link href="css/bootstrap.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/full-slider.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/notice-board.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body >

    <!-- Navigation -->
    <?php session_start();
        include("resources/db_login.php");

        $imgCount= $imgCount2 =$imgCount3 = $carousel_index = 0; $imagePath=""; $resulSet = $result = false;

        $sql = "SELECT __carousel_int FROM carousel ORDER BY incr DESC LIMIT 1";

        $result = mysqli_query($connect_link, $sql);
        if($result){
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $imgCount = $row["__carousel_int"];
            $imgCount2 = $imgCount;
            $imgCount3 = $imgCount;


        }
        else
              header("location: html/error.html");

        $sql_2 = "SELECT __path FROM carousel ORDER BY incr DESC LIMIT $imgCount";
        $resulSet = mysqli_query($connect_link, $sql_2);
    ?>
    <?php include("nav-bar.php"); ?>




    <!-- Full Page Image Background Carousel Header -->
    <header id="myCarousel" class="carousel slide ">
        <!-- Indicators -->
        <ol class="carousel-indicators">

        <?php
            while($imgCount3){
                if($imgCount3 == $imgCount2){

        ?>
            <li data-target="#myCarousel" data-slide-to="<?=$carousel_index;?>" class="active"></li>

            <?php }
            else { ?>


            <li data-target="#myCarousel" data-slide-to="<?=$carousel_index;?>"></li>
            <?php }
                $imgCount3--;
                $carousel_index++;
            } ?>

        </ol>


        <!-- Wrapper for Slides -->
        <div class="carousel-inner">


        <?php

            if($resulSet){
                while($imgCount){
                    $result_row = mysqli_fetch_array($resulSet, MYSQLI_ASSOC);
                    $imagePath = $result_row["__path"];

                    if($imgCount == $imgCount2){?>
                        <div class="item active">
                            <!-- Set the first background image using inline CSS below. -->
                            <div class="fill" style="background-image:url('<?=$imagePath;?>');">

                            </div>
                            <div class="carousel-caption">
                                <h2></h2>
                            </div>
                        </div>
                     <?php }

                else{ ?>

                    <div class="item">
                    <!-- Set the first background image using inline CSS below. -->
                    <div class="fill" style="background-image:url('<?=$imagePath;?>');">

                    </div>
                    <div class="carousel-caption">
                        <h2></h2>
                    </div>
                </div>

            <?php }
                $imgCount--;
                }
            }
                else
                      header("location: html/error.html");

            ?>
        </div>
        <!-- Controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="icon-next"></span>
        </a>

    </header>

    <!-- Page Content -->
    <section id="about">
    <div class="container">

        <div class="row ">
            <div  class="col-lg-12">
                <h1 style="text-align:center">Recent Posts</h1>

        </div>
      </div>
    </div>
  </section>
<!-- </div> -->
<div class="container" >
  <div class="row">

  <hr>
    <?php

        $sql_query = "SELECT * FROM post__ ORDER BY id DESC LIMIT 5 ";

      $sql = mysqli_query($connect_link, $sql_query);
      if($sql)
          while($sql_row =  mysqli_fetch_array($sql, MYSQLI_ASSOC)){
            $arrDate = explode("-", $sql_row["post_date"]);
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
         <div class="col-my-10 notice_see">

         <div class="notice_sec">
           <a href="notices/notice?Id=<?=$sql_row['id']?>" id="notice_post"><?=$sql_row["post_title"]?></a>
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

        <!-- <hr> -->

<div class="footer-basic-centered">
<footer >

  <p class="footer-company-motto">Design & Developed By: Vishal Sanserwal | Aditya Saxena</p>
  <p class="footer-company-name">CEC &copy; 2017</p>
</footer>
</div>

<!-- jQuery -->
<script src="js/jQuery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- Script to Activate the Carousel -->
<script>
$('.carousel').carousel({
    interval: 1000 //changes the speed
})
// Collapse navbar when clicked
$(document).on('click','.navbar-collapse.in',function(e) {
if( $(e.target).is('a') ) {
    $(this).collapse('hide');
}
});
</script>

</body>

</html>
