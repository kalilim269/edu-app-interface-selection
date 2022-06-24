<?php
include_once 'loginfunctions.php';
if (!isLoggedIn()) {
  $_SESSION['msg'] = "You must log in first";
  header('location: login.php');
}

include_once("includes/config.php");
$database = new Config();
$db = $database->getConnection();

if (isset($_SESSION['user']))  { 

  $user = $_SESSION['user']['fld_user_num'];
}

include_once('includes/subcriteria.inc.php');
$pro = new Subcriteria($db);
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
//$user = isset($_SESSION['user']) ? $_SESSION['user']['fld_user_num'] : die('ERROR: missing USER.');
$pro->id = $id;
//$pro->user = $user;

if($pro->delete($user)){
	echo "<script>location.href='subcriteria_data.php';</script>";
} else{
	echo "<script>alert('Failed to delete sub-criteria.');location.href='subcriteria_data.php';</script>";
}
