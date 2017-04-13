<!DOCTYPE html>
<html>
<head>
	<title>New Post</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/dashboard.css">
	<link rel="stylesheet" type="text/css" href="../css/newpost.css">
	<script src="../js/jQuery.min.js"></script>
  	<script src="../js/bootstrap.min.js"></script>
	<script type="text/javascript" src = "../js/LinkGenerator.js"></script>
	<script src="http://cloud.tinymce.com/stable/tinymce.min.js?apiKey=tv3h8x41h03u9lp1wup21pui63cq1edpupvepnxexsifgxq9"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.0.47/jquery.fancybox.min.js"></script>

  <script>
tinymce.init({
    selector: "textarea",theme: "modern",width: 780,height: 300,
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
<style type="text/css">
	.mce-notification {display: none !important;}
</style>
</head>
<body >

<?php

	session_start();
	$save_error = $fetch_error = $id = $role = $post_pre_title = $post_pre_content = null;
	include("db_login.php");
	include("file_upload.php");
        
     if(!isset($_SESSION["username"])) header("location: ../admin-login.php");
	/*
		For editing any post! The 'id' of that post is passes as a 'GET' request. The content of the post
		having that id will be loaded in the input section.
	*/

	if(isset($_GET["id"])){
		$id = $_GET["id"];
		$role = $_GET["role"];
       
		$sql_getPost = "SELECT post_title, post_content FROM post__ WHERE id ='$id'";
		$postQuery = mysqli_query($connect_link,  $sql_getPost);
		if($postQuery){
			$postRow = mysqli_fetch_array($postQuery, MYSQLI_ASSOC);
			$post_pre_title = $postRow["post_title"];
			$post_pre_content = $postRow["post_content"];

		}

		else
			$fetch_error = "Sorry! Could Not Load data.";
	}
	else{
	   // something here!!
	   
	}
	    


	if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["postPublish"])){

		$post_head = mysqli_real_escape_string($connect_link, $_POST["post_head"]);
		$post_content = mysqli_real_escape_string($connect_link, $_POST["post_content"]);
		$date = date("Y-m-d");
        
		if(isset($_GET["role"])){

			$id = $_GET["id"];
			$sql_save = "UPDATE post__ SET post_title = '$post_head', post_content = '$post_content', post_date = 	'$date' WHERE id = '$id'";
		}
		else{
			$sql_save = "INSERT INTO post__ (post_date, post_title, post_content, post_by) VALUE (
					'$date', '$post_head', '$post_content', 'CEC')";}

		if(mysqli_query($connect_link, $sql_save)){
			header("location: dashboard.php");
            
        }
		else
			$save_error = "Oops! Could not save data.".mysqli_error($connect_link);
	}


        
	 mysqli_close($connect_link);

?>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#"><span id="admin">ADMIN</span><span id="cec">Career Excellence</span></a>
    </div>
    <div class="dropdown">
  <a class="dropdown-toggle userinfo" data-toggle="dropdown"> Welcome, <?=$_SESSION["username"]?> !<span class="caret"></span></a>
  <ul class="dropdown-menu dropdown-menu-right">
  <li><a href="dashboard.php?page=1">Dashboard</a></li>
  <li><a href="../index.php">Visit Site</a></li>

  <li><a href="logout.php">Logout</a></li>


  </ul>
</div>
  </div>
</nav>
<?=$save_error ; ?>
<?=$fetch_error ; ?>
<?php if(isset($id) && isset($role)){ ?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])."?id=".$id."&role=".$role;?>" method="POST" id="">
<?php } 
    else{  echo "here"; ?>
    
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST" id="">
    <?php } ?>
	<input type="text" name="post_head" id="post_title" class="form-control max-width" placeholder="New Notice Title" value="<?=$post_pre_title;?>" required>
	<br>

	<textarea cols="70" rows="20" class="form-control" id="post_content" name="post_content"><?=$post_pre_content;?></textarea>
	<br>


	<input type="submit" class="btn btn-warning" name="postPublish" value="Publish">
 </form>

</body>
</html>
