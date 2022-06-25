<?php
$dir = 'www';
$ftp_server = 'lrgs.ftsm.ukm.my'; // change this
    $ftp_user_name = 'a176496'; // change this
    $ftp_user_pass = 'bigwhiterabbit'; // change this
    $remote_dir = 'ftp://lrgs.ftsm.ukm.my/file_uploads/'; // change this
    //$src_file = $_FILES['srcfile']['name'];

// set up basic connection
$ftp = ftp_ssl_connect($ftp_server);

// login with username and password
$login_result = ftp_login($ftp, $ftp_user_name, $ftp_user_pass);

// try to create the directory $dir
if (ftp_mkdir($ftp, $dir)) {
    ftp_put($ftp, $dir, 'aa.pdf', FTP_BINARY);
 echo "successfully created $dir\n";
} else {
 echo "There was a problem while creating $dir\n";
}

// close the connection
ftp_close($ftp);

?>


