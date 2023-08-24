<?php 
session_start();
require('connection.php');

if (isset($_POST["login-btn"])) {
$email_address = mysqli_real_escape_string($con, $_POST["email"]);
$user_password = mysqli_real_escape_string($con, $_POST["password"]);
$password_encry = md5($user_password);
if (!empty($email_address)&&!empty($user_password)) {
	$auth_user_account = mysqli_query($con, "SELECT * FROM students WHERE email='$email_address' AND password='$password_encry'");
	if (mysqli_num_rows($auth_user_account)>0) {
		$row_user_auth = mysqli_fetch_assoc($auth_user_account);
		$_SESSION["email"] = $row_user_auth["email"];
		$_SESSION["fname"] = $row_user_auth["fname"];
		$_SESSION["department"] = $row_user_auth["department"];
echo '<script>window.location.href="index.php";</script>';
	}else{
echo '<script>alert("Error! email or password not correct!")</script>';
echo '<script>window.location.href="login.php";</script>';
	}
}else{
echo '<script>alert("All fields required!")</script>';	
echo '<script>window.location.href="login.php";</script>';
}
}


if(isset($_POST["signout"])){
	session_destroy();
echo '<script>window.location.href="login.php";</script>';
}
?>