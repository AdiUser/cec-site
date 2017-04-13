<?php
	

	//include("db_login.php");

	$directory = "uploads/";
	$filePath = $fileName = $error = "";
	$fileUpload_status = $fileCounter = 1;
	$date = date("Y-m-d");
	if(isset($_FILES["fileupload"]["name"]) && isset($_POST["fileUpload"])){

	$filePath = $directory.basename($_FILES["fileupload"]["name"]);
	
	// 'pathinfo($filepath, option)' returns an assosiative array with INFO about the file if no option is passed, else returns the requested INFO.
	$fileType = pathinfo($filePath, PATHINFO_EXTENSION);
	$supportedImgTypes = ["png","jpeg","jpg","gif","ico"];
	$exceptions = ["exe", "bin", "sh", "o"];
	if(in_array($fileType, $supportedImgTypes)){
		// file is an image.
	
	}

	if(in_array($fileType, $exceptions))
		$fileUpload_status = 0;

	if(file_exists($filePath)){
		$fileName = pathinfo($filePath, PATHINFO_FILENAME) . '_' . $fileCounter++ . '.' . pathinfo($filePath, 
			PATHINFO_EXTENSION);

		$filePath = $directory.$fileName;
	}

	if ($_FILES["fileupload"]["size"] > 1000000) {
	    $error = "Sorry, your file is too large.";
	    $fileUpload_status = 0;
	}

	if($fileUpload_status == 1){
		if(move_uploaded_file($_FILES["fileupload"]["tmp_name"], $filePath)){
			$sql = "INSERT INTO uploads__ ( upload_path, upload_date) VALUE ('$filePath','$date')";
			 if(mysqli_query($connect_link, $sql)){
			 	$status = "File Uploaded : ". pathinfo($filePath, PATHINFO_FILENAME);
			 }
			 else
			 	$status = "Failed to uplaod file".mysqli_error($connect_link);
		}
			
	}
	else
			$status = "File Not Uploaded! Please check the file size or extention.";
	}

?>