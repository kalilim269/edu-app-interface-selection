<?php
include_once 'loginfunctions.php';
if (!isLoggedIn()) {
  $_SESSION['msg'] = "You must log in first";
  header('location: index.php');
}

if (isset($_SESSION['user']))  { 

  $user = $_SESSION['user']['fld_user_num'];
}

include_once ("includes/config.php");
$config = new Config();
$db = $config->getConnection();
//include_once('includes/criteria.inc.php');
include_once('includes/alternatif.inc.php');


//$criObj = new Criteria($db);
$altObj = new Alternatif($db);

if ($_POST) {

  $altObj->id = $_POST['alt_id'];
  $altObj->name = $_POST['name'];

  if ($altObj->insert($user)) { ?>
    <script type="text/javascript">
      window.onload=function(){
        showStickySuccessToast();
      };
    </script> <?php
  } else { ?>
    <script type="text/javascript">
      window.onload=function(){
        showStickyErrorToast();
      };
    </script> <?php
  }
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
   <title>EDU APP INTERFACE SELECTION : Alternative</title>
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
  height: 500px;
  background: #FFE4E1;
  padding: 50px;
  padding-top: 10px;
  margin: 50px auto;
  border-radius: 10px;
  border: 0px solid #FFEBCD;
}

.form-style-8{
  max-width: 800px;
  height: 350px;
  background: #FFFAFA;
  padding: 50px;
  padding-top: 10px;
  margin: 50px auto;
  border-radius: 10px;
  border: 0px solid #FFEBCD;
}
.form-style-8 h2{
  margin-bottom: 40px;
  margin-left: 10%;
  font-size: 18px;
}

.sidebar {
  margin: 20px;
  padding: 10px;
  width: 200px;
  background-color: #FFE4E1;
  position: absolute;
  height: 70%;
  overflow: auto;
}

.sidebar a {
  display: block;
  color: black;
  padding: 16px;
  text-decoration: none;
  margin-bottom: 17px;
}
 
.sidebar a.active {
  background-color: #FA8072;
  color: white;
}

.sidebar a:hover:not(.active) {
  background-color: #AFEEEE;
  color: black;
}

div.content {
  margin-left: 225px;
  padding: 0px 16px;
  height: 500px;
}

@media screen and (max-width: 700px) {
  .sidebar {
    width: 92%;
    height: auto;
    position: relative;
  }
  .sidebar a {float: left;}
  div.content {margin-left: 0;}
}

@media screen and (max-width: 400px) {
  .sidebar a {
    text-align: center;
    float: none;
  }
}

/* From uiverse.io */
button {
    
    top:50%;
    background-color:#3CB371;
    color: #fff;
    border:none; 
    border-radius:10px; 
    padding:10px;
    min-height:20px; 
    min-width: 100px;
  }




</style>
  
</head>
<body>
  <?php include_once 'navi_bar.php'; ?>

  <div class="sidebar">
  <a class="active" href="criteria.php"><b>Criteria</b></a>
  <a href="subcriteria.php"><b>Sub-Criteria</b></a>
  <a href="alternative.php"><b>Alternative</b></a>
  <a href="method.php"><b>AHP Method</b></a>
  <a href="rank.php"><b>Random Forest Model</b></a>
  <a href="report.php"><b>Summary Report</b></a>
  <a href="save.php"><b>Save Project</b></a>
</div>

<div class="content">
  
  <div class="form-style-9">

    <!--<ol class="breadcrumb" style="background-color: #F0FFFF;">
      <li><a href="criteria.php">Criteria</a></li>
      <li class="active">Criteria Data</li>
      <li><a href="evaluate_criteria.php">Evaluate Criteria</a></li>
      <li><a href="analyse_criteria.php">Criteria Evaluation Table</a></li>
    </ol>-->

          <h2 style="text-align: center;font-size: 25px;"><b>Add Alternative</b></h2>

        <form method="post">
          <div class="form-style-8">

        <div class="form-group">
          <br>
            <label for="id_kriteria">Alternative ID</label>
            <input type="text" class="form-control" id="alt_id" name="alt_id" required readonly="on" value="<?=$altObj->getNewID($user)?>">
          </div>
          <div class="form-group">
            <label for="name">Alternative Name</label>
            <input type="text" class="form-control" id="name" name="name" minlength="3" required="on">
          </div>
          <div class="btn-group">
            <button type="submit">Save</button> 
            <button type="button" onclick="location.href='alternative_data.php'">Return</button>
          </div>
    </form>

   
  </div>

   
  </div>
</div>


   <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

</body>
</html>
