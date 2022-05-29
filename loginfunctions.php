<?php 
session_start();

// connect to database
// development
//$db = mysqli_connect('lrgs.ftsm.ukm.my', 'a176496', 'bigwhiterabbit', 'a176496');

// deployement
$db = mysqli_connect('sql6.freemysqlhosting.net', 'sql6496163', 'KpxBp7Ln2Y', 'sql6496163');

// variable declaration 
$username = "";
$fullname = "";
$errors   = array(); 


// REGISTER USER
if (isset($_POST['new_user'])) {
  // receive all input values from the form
  $fullname = mysqli_real_escape_string($db, $_POST['fullname']);
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($fullname)) { array_push($errors, "Full Name is required"); }
  if (empty($username)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "Validation Error! The passwords does not match.");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM tbl_eduapp_user_a176496 WHERE fld_user_name='$fullname' OR fld_user_email='$username' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['fullname'] === $fullname) {
      array_push($errors, "Username entered already exists");
    }

    if ($user['username'] === $username) {
      array_push($errors, "Email entered already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = $password_1;//encrypt the password before saving in the database

  	$query = "INSERT INTO tbl_eduapp_user_a176496 (fld_user_name, fld_user_email, fld_user_password) 
  			  VALUES('$fullname', '$username', '$password')";
  	mysqli_query($db, $query);
  	$_SESSION['user'] = $user;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: index.php');
  }
}

//direct user to registration page
if (isset($_POST['signup_btn'])) {
	header('location: register.php');
} 

// call the login() function if login_btn is clicked
if (isset($_POST['login_btn'])) {
	login();
}                                                       

// LOGIN USER
function login(){
	global $db, $username, $errors;

	// grap form values
	$username = e($_POST['username']);
	$password = e($_POST['password']);

	// make sure form is filled properly
	if (empty($username)) {
		array_push($errors, "Username is required");
	}
	if (empty($password)) {
		array_push($errors, "Password is required");
	}

	// attempt login if no errors on form
	if (count($errors) == 0) {
		//$password = md5($password);

		$query = "SELECT * FROM tbl_eduapp_user_a176496 WHERE fld_user_email='$username' AND fld_user_password='$password' LIMIT 1";
		$results = mysqli_query($db, $query);

		if (mysqli_num_rows($results) == 1) { // user found
			// check if user is admin or user
			$logged_in_user = mysqli_fetch_assoc($results);
			//if ($logged_in_user['fld_staff_user_level'] == 'Admin') {

				$_SESSION['user'] = $logged_in_user;
				$_SESSION['success']  = "You are now logged in";

				header('location: index.php');		  
			//}else{
				//$_SESSION['user'] = $logged_in_user;
				//$_SESSION['success']  = "You are now logged in";

				//header('location: staffindex.php');
			//}
		}else {
			array_push($errors, "The username or password you entered is incorrect.");
		}
	}
}

function isLoggedIn()
{
	if (isset($_SESSION['user'])) {
		return true;
	}else{
		return false;
	}
}


// log user out if logout button clicked
if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: login.php");
}


// escape string
function e($val){
	global $db;
	return mysqli_real_escape_string($db, trim($val));
}

function display_error() {
	global $errors;

	if (count($errors) > 0){
		echo '<div class="error">';
			foreach ($errors as $error){
				echo $error .'<br>';
			}
		echo '</div>';
	}
}	

/*function isAdmin()
{
	if (isset($_SESSION['user']) && $_SESSION['user']['fld_staff_user_level'] == 'Admin' ) {
		return true;
	}else{
		return false;
	}
}*/



/*
  Accept email of user whose password is to be reset
  Send email to user to reset their password
*/
if (isset($_POST['reset-password'])) {
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $_SESSION['email'] = $email;
  // ensure that the user exists on our system
  $query = "SELECT fld_user_email FROM tbl_eduapp_user_a176496 WHERE fld_user_email='$email'";
  $results = mysqli_query($db, $query);

  if (empty($email)) {
    array_push($errors, "Your email is required");
  }else if(mysqli_num_rows($results) <= 0) {
    array_push($errors, "Sorry, no user exists on our system with that email");
  }

  $expFormat = mktime(
   date("H"), date("i")+5, date("s"), date("m") ,date("d"), date("Y")
   );
   $expDate = date("Y-m-d H:i:s",$expFormat);
   //$_SESSION['expDate'] = $expDate;

  // generate a unique random token of length 100
  $token = bin2hex(random_bytes(20));
  $_SESSION['token'] = $token;
  

  if (count($errors) == 0) {
    // store token in the password-reset database table against the user's email
    $sql = "INSERT INTO tbl_eduapp_resetpassword_a176496(fld_users_email, fld_reset_code, fld_exp_date) VALUES ('$email', '$token', '$expDate')";
    $results = mysqli_query($db, $sql);

    $link = 'http://localhost/fyp/reset_password.php?token='.$token.'&email='.$email;
    // Send email to user with the token in a link they can click on
    /*$to = $email;
    $subject = "Reset your password for EDU APP INTERFACE SELECTION";
    $msg = "Hi there, click on this <a href=\"http://localhost/fyp/reset_password.php?token=" .$token."&email=".$email."\">link</a> to reset your password on our site";
    $msg = wordwrap($msg,70);
    //set content-type header for sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: info@examplesite.com";
    mail($to, $subject, $msg, $headers);
    header('location: pending.php?email=' . $email);*/
    require_once('phpmailer/PHPMailerAutoload.php');
 
    $mail = new PHPMailer();
 
    $mail->CharSet =  "utf-8";
    $mail->IsSMTP();
    //Debug
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
    // enable SMTP authentication
    $mail->SMTPAuth = true;                  
    // GMAIL username
    $mail->Username = "limkali269@gmail.com";
    // GMAIL password
    $mail->Password = "kimheechul710";
    $mail->SMTPSecure = "tls";  
    // sets GMAIL as the SMTP server
    $mail->Host = "smtp.gmail.com";
    // set the SMTP port for the GMAIL server
    $mail->Port = "587";
    $mail->From='limkali269@gmail.com';
    $mail->FromName='EDU APP INTERFACE SELECTION';
    $mail->AddAddress($email, 'reciever_name');
    $mail->Subject  =  'Reset Password';
    $mail->IsHTML(true);
    $mail->Body    = 'Click On This Link to Reset Password '.$link.'';
    if($mail->Send())
    {
      echo "Check Your Email and Click on the link sent to your email";
    }
    else
    {
      echo "Mail Error - >".$mail->ErrorInfo;
    }
  }
  else{
    echo "Invalid Email Address. Go back";
  }
}

//if(isset($_SESSION['token']) && isset($_SESSION['email'])){

  //$token = $_SESSION['token'];
  //$email = $_SESSION['email'];
  

  //$sql = "SELECT fld_exp_date FROM tbl_eduapp_resetpassword_a176496 WHERE fld_reset_code='$token'";
  //$results = mysqli_query($db, $sql);
  //$expDate = mysqli_fetch_assoc($results)['fld_exp_date'];

  //$curDate = date("Y-m-d H:i:s");
  //echo $curDate;
  //echo " ";
  //echo $expDate;

//if($expDate >= $curDate) {


// ENTER A NEW PASSWORD
if (isset($_POST['new_password'])) {


  $new_pass = mysqli_real_escape_string($db, $_POST['new_pass']);
  $new_pass_c = mysqli_real_escape_string($db, $_POST['new_pass_c']);

  // Grab to token that came from the email link
  
  $token = $_SESSION['token'];
  

  if (empty($new_pass) || empty($new_pass_c)) array_push($errors, "Password is required");
  if ($new_pass !== $new_pass_c) array_push($errors, "Password do not match");
  if (count($errors) == 0) {
    // select email address of user from the password_reset table 
    $sql = "SELECT fld_users_email FROM tbl_eduapp_resetpassword_a176496 WHERE fld_reset_code='$token'LIMIT 1";
    $results = mysqli_query($db, $sql);
    $email = mysqli_fetch_assoc($results)['fld_users_email'];
    //$email = mysqli_num_rows($results);
    //$email = 'limkali99@gmail.com';

   

    if ($email) {
      //$new_pass = md5($new_pass);
      //$row = mysqli_fetch_assoc($result);
      $sql = "UPDATE tbl_eduapp_user_a176496 SET fld_user_password='$new_pass' WHERE fld_user_email='$email'";
      $results = mysqli_query($db, $sql);
      
      
    }
    $sql2 = "DELETE FROM tbl_eduapp_resetpassword_a176496 WHERE fld_users_email='$email'";
    $results = mysqli_query($db, $sql2);

    header('location: index.php');
  }

}
//}
//else {
 // echo '<div class="error"><p>Link is expired!</p></div><br />';
//}


//}

?>
