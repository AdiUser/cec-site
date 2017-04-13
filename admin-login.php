<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin Login</title>
	<link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Open+Sans:600'>
	<link rel="stylesheet" href="css/login.css">
</head>
<body>
<body>
<!-- Php Database -->
<?php

 include("resources/db_login.php");
 $username = $pass = $sql_findUser = $login_error = "";
 session_start();
 $_SESSION['is_logged_in'] = 0;

 if($_SERVER["REQUEST_METHOD"] == "POST"){

 	$username = $_POST["username"];
 	$pass = $_POST["pass"];

 	$sql_findUser = "SELECT * FROM login_info WHERE username = '$username' AND pass = '$pass'";
 	$result_set = mysqli_query($connect_link, $sql_findUser);
 	$result_count = mysqli_num_rows($result_set);

 	if($result_count == 1){

 		$_SESSION["is_logged_in"] = 1;
 		$_SESSION["username"] = $username;
 		header("location: resources/dashboard.php?page=1");
 	}
 	else
 		$login_error = "Invalid Username or Password!";

 }

?>


<!-- Php End -->



  <div class="login-wrap">
	<div class="login-html">
		<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In</label>
    <span id="login_error"><?php echo $login_error; ?></span>
		<!-- <input id="tab-2" type="radio" name="tab" class="sign-up">< for="labeltab-2" class="tab"></label> -->
		<div class="login-form">
			<div class="sign-in-htm">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST" id="login-form">

				<div class="group">
					<label for="user" class="label">Username</label>
					<input id="user" type="text" class="input" name="username">
				</div>
				<div class="group">
					<label for="pass" class="label">Password</label>
					<input id="pass" type="password" class="input" data-type="password" name="pass">
				</div>
				<div class="group">
					<input id="check" type="checkbox" class="check" checked>
					<label for="check"><span class="icon"></span> Keep me Signed in</label>
				</div>
				<div class="group">
					<input type="submit" class="button" value="Sign In">
				</div>

      </form>
			</div>
			<!-- <div class="sign-up-htm">
				<div class="group">
					<label for="user" class="label">Username</label>
					<input id="user" type="text" class="input">
				</div>
				<div class="group">
					<label for="pass" class="label">Password</label>
					<input id="pass" type="password" class="input" data-type="password">
				</div>
				<div class="group">
					<label for="pass" class="label">Repeat Password</label>
					<input id="pass" type="password" class="input" data-type="password">
				</div>
				<div class="group">
					<label for="pass" class="label">Email Address</label>
					<input id="pass" type="text" class="input">
				</div>
				<div class="group">
					<input type="submit" class="button" value="Sign Up">
				</div>
				<div class="hr"></div>
				<div class="foot-lnk">
					<label for="tab-1">Already Member?</a>
				</div>
			</div> -->
		</div>
	</div>
</div>


</body>
</html>


</body>
</html>
