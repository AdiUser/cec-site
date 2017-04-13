<?php
	
	function getTotalPostCount($connect_link, $tableName){
		$sql_ = "SELECT count(id) FROM $tableName";
		$sql_result = mysqli_query($connect_link , $sql_);
		$rowCount = mysqli_fetch_array($sql_result, MYSQLI_NUM);
		return $rowCount[0];
	}


	function getTotalPostCountWithCategory($connect_link, $tableName, $category){
		$sql_ = "SELECT count(id) FROM $tableName WHERE upload_category= '$category'";
		$sql_result = mysqli_query($connect_link , $sql_);
		$rowCount = mysqli_fetch_array($sql_result, MYSQLI_NUM);
		return $rowCount[0];
	}

	function getPostFromInterval($connect_link, $form, $postPerPage, $table){
		$sql = "SELECT * FROM $table ORDER BY id DESC LIMIT $form, $postPerPage";
		$sql_result = mysqli_query($connect_link, $sql);
		if(!$sql_result)
			die("Could Not get Data from the database ".mysqli_error($connect_link));

		return $sql_result;

	}

	function getResources($connect_link,$from, $postPerPage, $table, $category){
		$sql = "SELECT * FROM $table WHERE upload_category = '$category' ORDER BY id DESC LIMIT $from, $postPerPage";
		$sql_result = mysqli_query($connect_link, $sql);
		if(!$sql_result)
			die("Could Not get Data from the database ".mysqli_error($connect_link));

		return $sql_result;

	}


	?>