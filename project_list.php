<?php
include_once 'loginfunctions.php';
if (!isLoggedIn()) {
  $_SESSION['msg'] = "You must log in first";
  header('location: index.php');
}
include_once 'filesLogic.php';
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
   <title>EDU APP INTERFACE SELECTION : Project List</title>
   <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
 
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<style type="text/css">
@import url(https://fonts.googleapis.com/css?family=Open+Sans);

body {
        width:100%;
        height:100%;
        min-height:100%;
        background-color: #FFFFF0;
        margin:  0;
        font-family: "Lato", sans-serif;
}


.form-style-9{
  max-width: 900px;
  height: 600px;
  background: #FFE4E1;
  padding: 50px;
  padding-top: 10px;
  margin: 50px auto;
  border-radius: 10px;
  border: 0px solid #FFEBCD;
}

.form-style-8{
  max-width: 800px;
  height: 450px;
  background: #FFFAFA;
  padding: 50px;
  padding-top: 10px;
  margin: 50px auto;
  border-radius: 10px;
  border: 0px solid #FFEBCD;
}


div.content {
  margin-left: 0px;
  padding: 0px 20px;
  height: 600px;
}

@media screen and (max-width: 1000px) {
 

  .form-style-9{
  max-width: 900px;
  height: 600px;
  background: #FFE4E1;
  padding: 50px;
  padding-top: 10px;
  margin: 50px auto;
  border-radius: 10px;
  border: 0px solid #FFEBCD;
}

.form-style-8{
  max-width: 800px;
  height: 450px;
  background: #FFFAFA;
  padding: 50px;
  padding-top: 10px;
  margin: 50px auto;
  border-radius: 10px;
  border: 0px solid #FFEBCD;
}
}


@media screen and (max-width: 700px) {
  .sidebar {
    width: 92%;
    height: auto;
    position: relative;
  }
  
  div.content {
    margin-left: 0;
    height: 750px;}

  .form-style-9{
  max-width: 900px;
  height: 700px;
  background: #FFE4E1;
  padding: 50px;
  padding-top: 10px;
  margin: 50px auto;
  border-radius: 10px;
  border: 0px solid #FFEBCD;
}

.form-style-8{
  max-width: 800px;
  height: 550px;
  background: #FFFAFA;
  padding: 50px;
  padding-top: 10px;
  margin: 50px auto;
  border-radius: 10px;
  border: 0px solid #FFEBCD;
}
}

@media screen and (max-width: 400px) {
  .sidebar a {
    text-align: center;
    float: none;
  }
 
}

.button {
 padding: 1.3em 3em;
 font-size: 12px;
 text-transform: uppercase;
 letter-spacing: 2.5px;
 font-weight: 500;
 color: #000;
 background-color: #fff;
 border: none;
 border-radius: 45px;
 box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
 transition: all 0.3s ease 0s;
 cursor: pointer;
 outline: none;
 vertical-align: top;
 float: right;
 margin-top: -10px;
 display: inline-block;
}

.button:hover {
 background-color: #000000;
 box-shadow: 0px 15px 20px rgba(46, 229, 157, 0.4);
 color: #fff;
 transform: translateY(-7px);
}

.button:active {
 transform: translateY(-1px);
}




table {
  width: 100%;
  border-collapse: collapse;
  margin: 10px auto;
  font-size: 15px;
}
th,
td {
  height: 40px;
  vertical-align: center;
  
  padding:8px;
}


</style>
  
</head>
<body>
  <?php include_once 'navi_bar.php'; ?>

  
<div class="content">
  
  <div class="form-style-9">
          <h2 style="text-align: center;font-size: 25px;"><b>Project List</b></h2>
           <div class="form-style-8">
          <table>
<thead style="background-color:#AFEEEE;">
    <th>ID</th>
    <th>Filename</th>
    <th>File Size (in KB)</th>
    <th>Downloads</th>
    <th>Action</th>
</thead>
<tbody>
  <?php foreach ($files as $file): ?>
    <tr style="background-color:#F5FFFA">
      <td><?php echo $file['id']; ?></td>
      <td><?php echo $file['file_name']; ?></td>
      <td><?php echo floor($file['file_size'] / 1000) . ' KB'; ?></td>
      <td><?php echo $file['downloads_count']; ?></td>
      <td><a href="project_list.php?file_id=<?php echo $file['id'] ?>" class="btn btn-success btn-xs">Download</a>
        <a href="project_list.php?delete=<?php echo $file['id'] ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs">Delete</a></td>
    </tr>
  <?php endforeach;?>

</tbody>
</table>

          
      
  </div>
   
  </div>
</div>


   <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

</body>
</html>
