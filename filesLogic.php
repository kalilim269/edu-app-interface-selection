<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<style type="text/css">
.swal-modal {
  background-color: #FFFAFA;
 
}
.swal-button {
  padding: 10px 25px;
  border-radius: 2px;
  background-color: #DC143C;
  font-size: 12px;
}
</style>

<?php
include_once 'loginfunctions.php';
if (!isLoggedIn()) {
  $_SESSION['msg'] = "You must log in first";
  header('location: index.php');

}

if (isset($_SESSION['user']))  { 

    $user = $_SESSION['user']['fld_user_num'];
}

$ftp_hostname = 'ftp.drivehq.com';
$ftp_username = 'limkali';
$ftp_password = '@ra5M6zXnS8iiy_';
$remote_dir = '/file_uploads';

$ftpcon = ftp_connect($ftp_hostname);
$ftplogin = ftp_login($ftpcon, $ftp_username, $ftp_password);

// connect to the database
$conn = mysqli_connect('sql6.freemysqlhosting.net', 'sql6496163', 'KpxBp7Ln2Y', 'sql6496163');
//$conn = mysqli_connect('lrgs.ftsm.ukm.my', 'a176496', 'bigwhiterabbit', 'a176496');


$sql = "SELECT * FROM tbl_eduapp_files_data WHERE user_id=$user";
$result = mysqli_query($conn, $sql);

$files = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Uploads files
if (isset($_POST['save'])) { // if save button on the form is clicked
    
    $filename = $_FILES['myfile']['name'];
   
    // destination of the file on the server
    $destination = dirname('file_uploads/') . basename($filename);

    // get the file extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['myfile']['tmp_name'];
    $size = $_FILES['myfile']['size'];

    if (!in_array($extension, ['zip', 'pdf', 'docx'])) {
            echo '<script type="text/javascript">';
            echo 'setTimeout(function () {';
            echo 'swal("Error !","You file extension must be .zip, .pdf or .docx!","error")';
            echo '}, 200);  </script>';
    } elseif ($_FILES['myfile']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte
        
            echo '<script type="text/javascript">';
            echo 'setTimeout(function () {';
            echo 'swal("Error !","File too large!","error")';
            echo '}, 200);  </script>';
    } else {
        // move the uploaded (temporary) file to the specified destination
        //if (move_uploaded_file($file, $destination)) {
       if (ftp_put($ftpcon, "$remote_dir/$filename", $file, FTP_BINARY)) {
          
            $sql = "INSERT INTO tbl_eduapp_files_data(file_name, file_size, downloads_count, user_id) VALUES ('$filename', $size, 0, $user)";
            if (mysqli_query($conn, $sql)) {
                
            echo '<script type="text/javascript">';
            echo 'setTimeout(function () {';
            echo 'swal("Success !","File uploaded successfully","success")';
            echo '}, 200);  </script>';
               
            }
            
            ftp_close($ftpcon);
          
        } else {
           
            echo '<script type="text/javascript">';
            echo 'setTimeout(function () {';
            echo 'swal("Error !","Failed to upload file!","error")';
            echo '}, 200);  </script>';
        }
       
    }
}

// Downloads files
if (isset($_GET['file_id'])) {
    $id = $_GET['file_id'];
   

    // fetch file to download from database
    $sql = "SELECT * FROM tbl_eduapp_files_data WHERE id=$id AND user_id=$user";
    $result = mysqli_query($conn, $sql);

    $file = mysqli_fetch_assoc($result);
    $filepath = 'file_uploads/' . $file['file_name'];

    if (file_exists($filepath)) {
        //header('Content-Description: File Transfer');
        //header('Content-Type: application/octet-stream');
        //header('Content-Disposition: attachment; filename=' . basename($filepath));
        //header('Expires: 0');
        //header('Cache-Control: must-revalidate');
        //header('Pragma: public');
        //header('Content-Length: ' . filesize('file_uploads/' . $file['file_name']));
        //readfile('file_uploads/' . $file['file_name']);
       
        //$localFilePath  = $file['file_name'];
        $remoteFilePath = '/file_uploads/' . $file['file_name'];
        $size = ftp_size($ftpcon, $remoteFilePath);

        // try to download a file from server
        if(ftp_get($ftpcon, "php://output", $remoteFilePath, FTP_BINARY)){
           header("Content-Type: application/octet-stream");
           header("Content-Disposition: attachment; filename=" . basename($remoteFilePath));
           header("Content-Length: $size"); 
        } else {
           echo '<script type="text/javascript">';
           echo 'setTimeout(function () {';
           echo 'swal("Error !","Failed to download file!","error")';
           echo '}, 200);  </script>';
        }

       // close the connection
       ftp_close($ftpcon);

        // Now update downloads count
        $newCount = $file['downloads_count'] + 1;
        $updateQuery = "UPDATE tbl_eduapp_files_data SET downloads_count=$newCount WHERE id=$id";
        mysqli_query($conn, $updateQuery);
        exit;
    }

}


//Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

  try {

    $sql = "SELECT * FROM tbl_eduapp_files_data WHERE id=$id";
    $stmt = mysqli_query($conn, $sql);

    $file = mysqli_fetch_assoc($stmt);

    //get image path
    $filepath = 'file_uploads/'.$file['file_name'];

    //check if image exists
    if(file_exists($filepath)){
       if (ftp_delete($ftpcon, "$remote_dir/$file_name['file_name']")) 
          //delete the image
          unlink($filepath);
          ftp_close($ftpcon);
       
    $delstmt = "DELETE FROM tbl_eduapp_files_data WHERE id=$id";
    mysqli_query($conn, $delstmt);
    header("location: project_list.php");
    
    
}
 }
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }

}
