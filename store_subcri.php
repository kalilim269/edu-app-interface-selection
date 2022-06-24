<?php

if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

if ($_POST && isset($_POST['evasub'])) {
	$_SESSION['criteria_id'] = $_POST['criteria_id'];
	$value = $_SESSION['criteria_id'];
	//print_r($value);
	header('location: evaluate_subcriteria.php');
}

if ($_POST && isset($_POST['criteria'])) {
	$_SESSION['criteria_id'] = $_POST['criteria_id'];
	$value = $_SESSION['criteria_id'];
	//print_r($value);
	header('location: analyse_subcriteria.php');
}



//unset($_SESSION['criteria_id']);

?>