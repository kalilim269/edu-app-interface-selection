<?php

include_once 'loginfunctions.php';
if (!isLoggedIn()) {
  $_SESSION['msg'] = "You must log in first";
  header('location: login.php');
}

if (isset($_SESSION['user']))  { 

    $user = $_SESSION['user']['fld_user_num'];
}

#Create/Open a file and prepare it for writing
$tempFile = "temp.dat";
$fh = fopen($tempFile, 'w') or die("can't open file");
#foreach ($phpVariablesToPass as $key=>$value) {
    fwrite($fh, $user);
#}
fclose($fh);


?>