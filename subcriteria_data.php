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
include_once('includes/criteria.inc.php');
include_once('includes/subcriteria.inc.php');

$pro = new Criteria($db);
$sub = new Subcriteria($db);
$stmt = $pro->readAll($user);
$count = $pro->countAll($user);
$substmt = $sub->readAll($user);
$subcount = $sub->countAll($user);

if (isset($_POST['delete_subcriteria'])) {
    $imp = "('".implode("','", array_values($_POST['checkbox']))."')";
    $result = $sub->hapusell($imp);
    if ($result) { ?>
        <script type="text/javascript">
        window.onload=function(){
            showSuccessToast();
            setTimeout(function(){
                window.location.reload(1);
                history.go(0)
                location.href = location.href
            }, 5000);
        };
        </script> <?php
    } else { ?>
        <script type="text/javascript">
        window.onload=function(){
            showErrorToast();
            setTimeout(function(){
                window.location.reload(1);
                history.go(0)
                location.href = location.href
            }, 5000);
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
   <title>EDU APP INTERFACE SELECTION : Sub-Criteria</title>
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
  height: 750px;
  background: #FFE4E1;
  padding: 50px;
  padding-top: 20px;
  margin: 50px auto;
  border-radius: 10px;
  border: 0px solid #FFEBCD;
}

.form-style-8{
  max-width: 800px;
  height: 520px;
  background: #FFFAFA;
  padding: 50px;
  padding-top: 10px;
  margin: 50px auto;
  border-radius: 10px;
  border: 0px solid #FFEBCD;
}

.form-style-8 h2{
  margin-bottom: 40px;
  margin-left: 10px;
  font-size: 18px;
}

.sidebar {
  margin: 20px;
  padding: 10px;
  width: 200px;
  background-color: #FFE4E1;
  position: absolute;
  height: 69%;
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
  height: 900px;
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

ol li a{
  color: red;
 }

table {
  border-color: black;

}
th  { 
    background-color: #FFF0F5; 
}

td  { 
    background-color: #F5FFFA; 

  }

.alert {
  padding: 20px;
  background-color: #f44336;
  color: white;
  opacity: 1;
  transition: opacity 0.6s;
  margin-bottom: 15px;
}

.alert.success {background-color: #04AA6D;}
.alert.info {background-color: #2196F3;}
.alert.warning {background-color: #ff9800;}

.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}

.closebtn:hover {
  color: black;
}

</style>


  
</head>
<body>

  <?php include_once 'navi_bar.php'; ?>

   <div class="alert info">
  <span class="closebtn">&times;</span>  
  <strong>Info! Please take note!</strong><br> When creating new Sub-Criteria, please ensure that both Criteria ID and Sub-Criteria ID are in consecutive order. For example: Sub-Criteria ID for C1 would S1, S2, ... and Sub-Criteria ID for C2 will pick up from where it was left off in C1, like S3, S4, ... and then continue for other Criteria.
</div>

  <div class="sidebar">
  <a href="criteria.php"><b>Criteria</b></a>
  <a class="active" href="subcriteria.php"><b>Sub-Criteria</b></a>
  <a href="alternative.php"><b>Alternative</b></a>
  <a href="method.php"><b>AHP Method</b></a>
  <a href="rank.php"><b>Random Forest Model</b></a>
  <a href="report.php"><b>Summary Report</b></a>
  <a href="save.php"><b>Save Project</b></a>
</div>

<div class="content">
  
  <div class="form-style-9">

    <ol class="breadcrumb" style="background-color: #F0FFFF;">
      <li><a href="subcriteria.php">Sub-Criteria</a></li>
      <li class="active">Sub-Criteria Data</li>
      <li><a href="evaluate_subcriteria.php">Evaluate Sub-Criteria</a></li>
      <li><a href="analyse_subcriteria.php">Sub-Criteria Evaluation Table</a></li>
    </ol>

          <h2 style="text-align: center;font-size: 25px;"><b>Sub-Criteria Data</b></h2>

        <form method="post">
          <div class="form-style-8">

        <div style="text-align:right;"> 
          <div class="btn-group">
            <p align="right">
            <!--<button type="submit" name="delete_subcriteria" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Remove</button>-->
                <button type="button" onclick="location.href='new_subcriteria.php'" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span>  Add Sub-Criteria</button>
            </p>
          </div>
         </div>
            <br>
        <table width="100%" class="table table-striped table-bordered" id="tabeldata">
          <thead>
            <tr>
             <!-- <th width="10px"><input type="checkbox" name="select-all" id="select-all" /></th>-->
              <th>Criteria ID</th>
              <th>Criteria Name</th>
              <th>Sub-Criteria ID</th>
              <th>Sub-Criteria Name</th>
              <!--<th>Bobot Kriteria</th>-->
              <th width="100px">Action</th>
            </tr>
          </thead>
          <!--<tfoot>
            <tr>
                <th><input type="checkbox" name="select-all2" id="select-all2" /></th>
                <th>Criteria ID</th>
                <th>Criteria Name</th>-->
                <!--<th>Bobot Kriteria</th>-->
                <!--<th>Action</th>
            </tr>
          </tfoot>-->
          <tbody>
            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) :  ?>
            <?php while ($row2 = $substmt->fetch(PDO::FETCH_ASSOC)) : ?>
              <tr>
                <!--<td style="vertical-align:middle;"><input type="checkbox" value="<?php echo $row2['fld_subcriteria_id'] ?>" name="checkbox[]" /></td>-->

                <td style="vertical-align:middle;"><?php echo $row2['fld_criteria_id'] ?></td>
                <td style="vertical-align:middle;"><?php echo $row2['fld_criteria_name'] ?></td>

                

                <td style="vertical-align:middle;"><?php echo $row2['fld_subcriteria_id'] ?></td>
                <td style="vertical-align:middle;"><?php echo $row2['fld_subcriteria_name'] ?></td>

                <!--<td style="vertical-align:middle;"><?php //echo $row['bobot_kriteria'] ?></td>-->
                <td style="text-align:center;vertical-align:middle;">
                  <a href="edit_subcriteria.php?id=<?php echo $row2['fld_subcriteria_id'] ?>" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                  <a href="delete_subcriteria.php?id=<?php echo $row2['fld_subcriteria_id'] ?>" onclick="return confirm('Are you sure you want to delete this subcriteria?')" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                </td>
              </tr>
              <?php endwhile; ?>
            <?php endwhile; ?>
          </tbody>
        </table>
    </form>

          <a href="evaluate_subcriteria.php" class="button">Evaluate</a>
          

   
  </div>

   
  </div>
</div>

<script>
var close = document.getElementsByClassName("closebtn");
var i;

for (i = 0; i < close.length; i++) {
  close[i].onclick = function(){
    var div = this.parentElement;
    div.style.opacity = "0";
    setTimeout(function(){ div.style.display = "none"; }, 600);
  }
}
</script>

   <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

</body>
</html>
