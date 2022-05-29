<?php //include_once 'loginfunctions.php' ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>EDU APP INTERFACE SELECTION : Login Form</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">

    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 

<style type="text/css">
@import url(https://fonts.googleapis.com/css?family=Open+Sans);

body {
    background: #ADD8E6;
    font-family: 'Gill Sans', sans-serif;
}

.login-box {
    margin-top: 80px;
    height: 550px;
    background: #FFFAFA;
    text-align: center;
    box-shadow: 0 0px 0px rgba(0, 0, 0, 0.16), 0 0px 0px rgba(0, 0, 0, 0.23);
    border-radius: 30px;
    
}

.login-key {
    height: auto;
    font-size: 80px;
    line-height: 140px;
    background: -webkit-linear-gradient(#27EF9F, #0DB8DE);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.login-title {
    height: 20%;
    margin-top: 80px;
    text-align: center;
    font-size: 40px;
    letter-spacing: 2px;
    margin-top: 20px;
    font-weight: bold;
    color: black;
    margin-bottom: 50px;

}

@media screen and (max-width: 600px) {
  .login-title {
    height: 20%;
    margin-top: 80px;
    text-align: center;
    font-size: 40px;
    letter-spacing: 2px;
    margin-top: 30px;
    font-weight: bold;
    color: black;
    margin-bottom: 60px;

}
}

.login-form {
    margin-top: 30px;
    text-align: left;
}

input[type=text] {
    background-color: #F0F8FF;
    border: 2px solid #0DB8DE;
    border-radius: 20px;
    font-weight: bold;
    outline: 0;
    margin-bottom: 20px;
    padding-left: 10px;
    color: black;
}

input[type=password] {
    background-color: #F0F8FF;
    border: 2px solid #0DB8DE;
    border-radius: 20px;
    font-weight: bold;
    outline: 0;
    padding-left: 10px;
    margin-bottom: -20px;
    color: black;
}

.form-group {
    margin-bottom: 50px;
    outline: 0px;
}

.form-control {
  background-color: #00008B;
}

.form-control:focus {
    border-color: inherit;
    -webkit-box-shadow: none;
    box-shadow: none;
    
    outline: 0;
    background-color: #00CED1;
    color: #FFFAFA;
}

input:focus {
    outline: none;
    box-shadow: 0 0 0;

}

label {
    margin-bottom: 0px;
}

.form-control-label {
    font-size: 15px;
    color: #00008B;
    font-weight: bold;
    letter-spacing: 1px;
}

.btn-outline-primary {
  font-weight: bold;
  border-radius: 20px; 
  width: 35%;
  padding: 10px;
  margin: 0 auto;
  display: table-cell;
  padding-left: 10px;
  padding-right: 10px;
 
}

.btn-outline-primary:hover {
    background-color: #0DB8DE;
    right: 0px;
}

.login-btm {
   outline: none;
}

.login-button {
    display: inline;
    margin-left: 35px;
    text-align: center;
    margin-bottom: 25px;
    font-weight: bold;

}

.login-text {
    text-align: left;
    padding-left: 0px;
    margin-top: 0px;
    font-weight: bold;
}

.loginbttm {
    padding: 0px;
}

p {
    text-align: center;
    margin-bottom: 20px;
}

</style>



</head>
<body>

	<div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-2 col-xs-6">
            </div>
            <div class="col-lg-6 col-md-8 col-xs-6 login-box">
                <div class="col-lg-12 login-key">
                  <div class="col-xs-6 text-center">
                    <!--<img src="starbook.png" alt="StarBook" width="40%" height="40%">-->
                  </div>
                </div>
                <div class="col-lg-12 col-md-12 col-xs-6 login-title">
                    EDU APP INTERFACE SELECTION
                </div>

                <div class="col-lg-12 col-xs-6 login-form">
                    <div class="col-lg-12 col-xs-6 login-form">

	<form method="post" action="login.php">
		
		<div class="form-group">
			<i style="color: red;"><b><?php echo display_error(); ?></b></i>
			<br>
			<label class="form-control-label">Email</label>
			<input type="text" name="username", class="form-control" required>
		</div>
		<div class="form-group">
			<label class="form-control-label">Password</label>
			<input type="password" name="password" class="form-control" required>
		</div>

        <p>
        Forgot Password? <a href="insert_email.php">Click Here</a>
       </p>

		<div class="col-lg-12 loginbttm">
                                <div class="col-lg-6 login-btm login-text">
                                    <!-- Error Message -->
                                    	
                                </div>
		

        <div class="col-lg-12 col-xs-6 login-btm login-button">
            <form method="POST" action="register.php">
            <button type="submit" class="btn btn-outline-primary" name="signup_btn" value="ignore" formnovalidate>
            SIGN UP</button>&nbsp; &nbsp; &nbsp;
			</form>
            <button type="submit" class="btn btn-outline-primary" name="login_btn">LOGIN</button>
		</div>
        



		</div>
	</form>
</div>
</div>

</body>
</html>


