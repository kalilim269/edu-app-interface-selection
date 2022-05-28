<?php include('loginfunctions.php'); ?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>EDU APP INTERFACE SELECTION : Reset Password</title>
	<link rel="stylesheet" href="main.css">
	<style type="text/css">
		
body {
	background: #ADD8E6;
	font-size: 1.1em;
	font-family: system-ui;
}
a {
	text-decoration: none;
}
form {
	width: 50%;
	margin: 90px auto;
	background: #FFFAFA;
	padding: 30px;
	border-radius: 15px;
}
h2.form-title {
	text-align: center;
	margin-bottom: 10px;
}
input {
	display: block;
	box-sizing: border-box;
	width: 100%;
	padding: 10px;
	border-radius: 15px;
	margin-top: 10px;

}
form .form-group {
	margin: 10px auto;
}
form button {
	width: 100%;
	border: none;
	color: white;
	background: #3b5998;
	padding: 15px;
	border-radius: 15px;
	font-weight: bold;
	font-size: 15px;
	margin-top: 10px;
}
.msg {
	margin: 5px auto;
	border-radius: 5px;
	border: 1px solid red;
	background: pink;
	text-align: left;
	color: brown;
	padding: 10px;
}
	</style>
</head>
<body>
	<form class="login-form" action="insert_email.php" method="post">
		<h2 class="form-title">Reset password</h2>
		<!-- form validation messages -->
		<i style="color: red;"><b><?php echo display_error(); ?></b></i>
			<br>
		<div class="form-group">
			<label>Email Address :</label>
			<input type="email" name="email">
		</div>
		<div class="form-group">
			<button type="submit" name="reset-password" class="login-btn">Submit</button>
		</div>
	</form>
</body>
</html>