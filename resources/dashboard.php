
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Dashboard</title>

	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/dashboard.css">
	<link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
	<link type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.0.47/jquery.fancybox.min.css" rel="stylesheet">

  <script src="../js/jQuery.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="http://cloud.tinymce.com/stable/tinymce.min.js?apiKey=tv3h8x41h03u9lp1wup21pui63cq1edpupvepnxexsifgxq9"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.0.47/jquery.fancybox.min.js"></script>

  <script>
	tinymce.init({
	    selector: "textarea",theme: "modern",width: 680,height: 100,
	    plugins: [
	         "advlist autolink link image lists charmap print preview hr anchor pagebreak",
	         "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
	         "table contextmenu directionality emoticons paste textcolor responsivefilemanager code"
	   ],
	   toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
	   toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
	   image_advtab: true ,

	   external_filemanager_path:"/filemanager/",
	   filemanager_title:"Responsive Filemanager" ,
	   external_plugins: { "filemanager" : "http://localhost/CEC-Website/UnitTest/tinymce/plugins/responsivefilemanager/plugin.min.js"}
	 });
</script>
<script src="/fancybox/jquery.fancybox-1.3.4-min.js"></script>
<style type="text/css">
	.mce-notification {display: none !important;}
	.fancybox-content{height : 606px !important;}
</style>
<style type="text/css">.notice_part{width:66%;}</style>
</head>
<body>
<?php session_start() ;
if(!isset($_SESSION["username"])) header("location: ../admin-login.php"); 
else{
	include("db_login.php");
	include("pagination.php");

	$postCount = $pageCount = 0;  
	$postPerPage = 7;
	$page = 1;
	$postCount = getTotalPostCount($connect_link, 'post__');
	$pageCount = ceil($postCount/$postPerPage);

	if(!isset($_GET["page"])){
		$pageNum = 1;
		$sql_resultSet = getPostFromInterval($connect_link,($pageNum-1)*$postPerPage, $postPerPage,"post__");

		if(!$sql_resultSet)
			header("location: ../html/error.html");
	}

	if(isset($_GET["page"])){
		$pageNum = $_GET["page"];
		if($pageNum > $pageCount)
			header("location: ../html/error.html");
		else{
		$sql_resultSet = getPostFromInterval($connect_link,($pageNum-1)*$postPerPage, $postPerPage,"post__");

		if(!$sql_resultSet)
			header("location: ../html/error.html");
		}
	}
}


?>


<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#"><span id="admin">ADMIN</span><span id="cec">Career Excellence</span></a>
    </div>
    <div class="dropdown">
  <a class="dropdown-toggle userinfo" data-toggle="dropdown"> Welcome, <?=$_SESSION["username"]?> !<span class="caret"></span></a>
  <ul class="dropdown-menu dropdown-menu-right">
  <li><a href="../index.php">Visit Site</a></li>
   <li><a href="new_post.php">New Post</a></li> 
  <li><a href="logout.php">Logout</a></li>
    

  </ul>
</div>
  </div>
</nav>


<div class="container-fluid">

	
	<div class="row">
		<div class="col-md-2 left-section">
		<ul class="nav nav-pills nav-stacked">
		  <li class="active"><a data-toggle="tab" href="#home">Post</a></li>
		  <li><a data-toggle="tab" href="#resources">Resources</a></li>
		  <li><a data-toggle="tab" href="#maincarousel">Main Carousel</a></li>
		  
		</ul>
	</div>
	
	<div class="col-md-10">
		<div class="tab-content">
		  <div id="home" class="tab-pane fade in active">
		  
		  <span id="new_post_text">Create a New Post </span><a class="btn btn-warning" href="new_post.php">New Post</a>
		  <hr>
		  <table class="table table-striped">
		  	<thead>
		  		<tr>
		  			<th>Title</td>
		  			<th>Author</td>
		  			<th>Date</td>
		  			<th></th>
		  		</tr>
		  	</thead>
		  	<tbody>
		  	<!-- 
				Found an even better way for looping through all the saved posts. (insdead of the 'echo'-ing)
			-->
		  	<?php

				while($posts = mysqli_fetch_array($sql_resultSet, MYSQLI_ASSOC)){
					?>
		
					<tr>
						<td class="notice_part"><a title="Click to edit" href="new_post.php?id=<?=$posts['id'];?>&role=edit"><?=$posts["post_title"]?>
						</td>
						<td><?=$posts["post_by"]?></td>
						<td><?=$posts["post_date"]?></td>
						<td><a href="delete_post.php?x=p&id=<?=$posts['id']?>" class="btn btn-danger">Delete</a>
						</td>
					</tr>
		  	

		  <?php }?>
		  		
		  	</tbody>
		  </table>
		  <div class="container">

		  <ul class="pagination" style="font-size: 17px;">
		  <?php while($pageCount!=0){ ?>

		   <li><a href="dashboard.php?page=<?=$page?>"><?=$page;?></a></li>
		    <?php
		    	$pageCount--;
		    	$page++;
		    	}
		    ?>
  		</ul>
		</div>

		  

		  </div>
		  <div id="resources" class="tab-pane fade">

		  <ul class="nav nav-tabs">
			  <li class="active"><a data-toggle="tab" href="#upload">Upload Resources</a></li>
			  <li><a data-toggle="tab" href="#view_delete">View/Delete</a></li>
			</ul>

			<div class="tab-content">
			  <div id="upload" class="tab-pane fade in active">
			    <div class="resources_content">


		  <p id="upload_res">Upload Resources</p>
		  <small>NOTE: Use the 'Upload Resource' button to upload any file or link - "one-by-on"'</small>
		  </div>
		  <hr>
		  <div class="uplaod_col">


		    	<form action="resource_upload.php" method="POST">

		    	<div class="row">
		    	<div class="col-md-8 col-sm-8 col-lg-8">
		    	<label for="heading">Resource Title</label>
		    	<input type="text" name="upload_title" class="form-control" required>
		    	</div>
		    	<div class="col-md-4 col-sm-4 col-lg-4">
		    	<label for="cat">Category of Post</label>
		    	<br>
		    	<select name="upload_category" class="form-control" required>
		    		<option value="second">2nd Year</option>
		    		<option value="third">3rd Year</option>
		    		<option value="fourth">4th Year</option>
		    		<option value="common">Common Resources</option>
		    	</select>
		    	</div>
		    	</div>
		    	<br>
		    	<label for="content">Resource Content</label>
		    	<textarea id="text-area" id="upload_c" name="upload_content"></textarea>
		    	<button type="submit"  name="submitRes" id="upload_btn" class="btn btn-warning">Upload Resource</button>
		    	</form>
		    	</div>		  
			  </div>
			  
			  <div id="view_delete" class="tab-pane fade">
			  
			    <table class="table table-striped">
		  	<thead>
		  		<tr>
		  			<th>Title</td>
		  			<th>Category</td>
		  			<th>Date</td>
		  			<th></th>
		  		</tr>
		  	</thead>
		  	<tbody>
		  	<!-- 
				Found an even better way for looping through all the saved posts. (insdead of the 'echo'-ing)
			-->
		  	<?php

		  		$sql_fetchDatax = "SELECT * FROM upload__ ORDER BY id DESC";
				$sql_resultSetx = mysqli_query($connect_link, $sql_fetchDatax);	
				while($postsx = mysqli_fetch_array($sql_resultSetx, MYSQLI_ASSOC)){
					?>
		
					<tr>
						<td><p title="Click to edit" ><?=$postsx["upload_title"]?>
						</td>
						<td><?php

						$category = "";
						switch($postsx["upload_category"]){
							case "fourth":
								$category = "Fourth Year";
								break;
							case "third":
							$category = "Third Year";
							break;
						
							case "second":
									$category = "Second Year";
									break;
							
							case "common":
									$category = "Commonn Resource";
									break;
							default:
								$category = "Not in the list";
								break;
							
						}

						echo $category;?></td>
						<td><?=$postsx["upload_date"]?></td>
						<td><a href="delete_post.php?x=u&id=<?=$postsx['id']?>" class="btn btn-danger">Delete</a>
						</td>
					</tr>
		  	

		  <?php }?>
		  		
		  	</tbody>
		  </table>
		  
			  </div>
			  
			</div>


		  <!-- -->
		    	<!-- -->
		    
		</div>

		  
		 
		

		  <div id="maincarousel" class="tab-pane fade">

		  <div class="carousel">
		  <div id="carousel_content">
		  <p id="carousel_head">Select Carousel Images</p>
		  <p id="carousel_text">Upload or choose from the images to be used as a carousel. </p>
		  <small id="carousel_small">NOTE: You can select only 10 images max.</small>
		  </div>
		  <hr>

		  <form action="CarouselUpload.php" method="POST">
		  
		  <div class="row">
		  <div class="col-md-3 col-sm-3 col-lg-3">
		  <label for="imgName">#Img1</label><br>
		  <input class="form-control limit-width" id="fieldID" type="text" name="img0">
		  <a href="/filemanager/dialog.php?type=1&field_id=fieldID&relative_url=0" class="upload_btn iframe-btn">&#8594; Choose/Upload Image</a>
		  </div>
		  
		  <div class="col-md-3 col-lg-3 col-sm-3">
		  <label for="imgName">#Img2</label><br>
		  <input  class="form-control limit-width" id="fieldID0" type="text" name="img1">
		  <a href="/filemanager/dialog.php?type=1&field_id=fieldID0&relative_url=0" class="upload_btn iframe-btn">&#8594;Choose/Upload Image</a>
		  </div>
		  </div>
		  <div class="row">
		  <div class="col-md-3 col-lg-3 col-sm-3">
		  <label for="imgName">#Img3</label><br>
		  <input  class="form-control limit-width" id="fieldID1" type="text" name="img2">
		  <a href="/filemanager/dialog.php?type=1&field_id=fieldID1&relative_url=0" class="upload_btn iframe-btn">&#8594;Choose/Upload Image</a>
		  </div>
		  <div class="col-md-3 col-lg-3 col-sm-3">
		  <label for="imgName">#Img4</label><br>
		  <input class="form-control limit-width" id="fieldID2" type="text" name="img3">
		  <a href="/filemanager/dialog.php?type=1&field_id=fieldID2&relative_url=0" class="upload_btn iframe-btn">&#8594;Choose/Upload Image</a>
		  </div>
		  </div>
		  <div class="row">
		  <div class="col-md-3 col-lg-3 col-sm-3">
		  <label for="imgName">#Img5</label><br>
		  <input class="form-control limit-width" id="fieldID3" type="text" name="img4">
		  <a href="/filemanager/dialog.php?type=1&field_id=fieldID3&relative_url=0" class="upload_btn iframe-btn">&#8594;Choose/Upload Image</a>
		  </div>
		  <div class="col-md-3 col-lg-3 col-sm-3">
		  <label for="imgName">#Images to show</label><br>
		  <input class="form-control limit-width" type="number" name="carousel_int" placeholder="#images to show" class="" min="3" max="10" required>
		  </div>
		  </div>
		  <!-- @MAX_VALUE : 5-->
		  <br>
		  <input type="submit" name="carousel_submit" id="" class="btn btnl btn-success" >


		  </form>
		  	</div>
		 </div>

		  <div id="menu2" class="tab-pane fade">
		    <h3>Menu 2</h3>
		    <p>Some content in menu 2.</p>
		  </div>
		</div>
	</div>	
</div>
</div>


<?php mysqli_close($connect_link);?>
<script type="text/javascript">
	$('.iframe-btn').fancybox({	
		'width'		: 900,
		'height'	: 1000,
		'type'		: 'iframe',
       	 'autoScale'    	: false
    })

	function responsive_filemanager_callback(field_id){ 
            
           console.log(field_id);
           var url=jQuery('#'+field_id).val();
           parent.$.fancybox.close();
        }

</script>
</div>
</div>
</body>

</html>
