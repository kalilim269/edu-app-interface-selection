<?php 
include_once('loginfunctions.php') 
?>


<!DOCTYPE html>
<html>
<head>
  <title>EDU APP INTERFACE SELECTION : Registration Form</title>
  <link rel="stylesheet" type="text/css" href="style.css">

<style type="text/css">

* {
  margin: 0px;
  padding: 0px;
}
body {
  font-size: 120%;
  background: #ADD8E6;
  font-family: system-ui;
}

.header {
  width: 49%;
  margin: 40px auto 0px;
  color: white;
  background: #483D8B;
  text-align: center;
  border: 1px solid #B0C4DE;
  border-bottom: none;
  border-radius: 20px 20px 0px 0px;
  padding: 20px;
}
form, .content {
  width: 50%;
  margin: 0px auto;
  padding: 15px;
  border: 1px solid #B0C4DE;
  background: white;
  border-radius: 0px 0px 10px 10px;
}
.input-group {
  margin: 20px 0px 10px 0px;
}
.input-group label {
  display: block;
  text-align: left;
  margin: 3px;
}
.input-group input {
  height: 30px;
  width: 93%;
  padding: 4px 10px;
  font-size: 16px;
  border-radius: 5px;
  border: 1px solid gray;
}
.btn {
  padding: 10px;
  font-size: 15px;
  color: white;
  background: #6495ED;
  border: none;
  border-radius: 10px;
  margin-top: 20px;
  margin-bottom: 20px;
  width: 20%;
  margin-left: 300px;

}
.error {
  width: 92%; 
  margin: 0px auto; 
  padding: 10px; 
  border: 1px solid #a94442; 
  color: #a94442; 
  background: #f2dede; 
  border-radius: 5px; 
  text-align: left;
}
.success {
  color: #3c763d; 
  background: #dff0d8; 
  border: 1px solid #3c763d;
  margin-bottom: 20px;
}
</style>

</head>
<body>
  <div class="header">
  	<h2>Registration Form</h2>
  </div>
	
  <form method="post" action="register.php">
  	<i style="color: red;"><b><?php echo display_error(); ?></b></i>
      <br>

  	<div class="input-group">
  	  <label>Full Name</label>
  	  <input type="text" name="fullname" value="<?php echo $fullname; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Email</label>
  	  <input type="email" name="username" value="<?php echo $username; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password_1">
  	</div>
  	<div class="input-group">
  	  <label>Confirm password</label>
  	  <input type="password" name="password_2">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="new_user">SIGN UP</button>
  	</div>
  	<p>
  		Already a member? <a href="index.php">LOGIN</a>
  	</p>
  </form>
</body>
</html>
