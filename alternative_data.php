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
include_once('includes/alternatif.inc.php');

$pro = new Alternatif($db);
$stmt = $pro->readAll($user);
$count = $pro->countAll($user);

if (isset($_POST['delete_alt'])) {
    $imp = "('".implode("','", array_values($_POST['checkbox']))."')";
    $result = $pro->hapusell($imp);
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
   <title>EDU APP INTERFACE SELECTION : Criteria</title>
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
  height: 800px;
  background: #FFE4E1;
  padding: 50px;
  padding-top: 20px;
  margin: 50px auto;
  border-radius: 10px;
  border: 0px solid #FFEBCD;
  
}

.form-style-8{
  max-width: 800px;
  height: 600px;
  background: #FFFAFA;
  padding: 50px;
  padding-top: 10px;
  margin: 50px auto;
  border-radius: 10px;
  border: 0px solid #FFEBCD;
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
  div.content {
    margin-left: 0;
}



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
 margin-top: 20px;
 margin-bottom: 20px;
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

    <ol class="breadcrumb" style="background-color: #F0FFFF;">
      <li><a href="alternative.php">Alternative</a></li>
      <li class="active">Alternative Data</li>
      <li><a href="evaluate_alternative.php">Evaluate Alternative</a></li>
      <li><a href="analyse_alternative.php">Alternative Evaluation Table</a></li>
    </ol>

          <h2 style="text-align: center;font-size: 25px;"><b>Alternative Data</b></h2>

        <form method="post">
          <div class="form-style-8">

        <div style="text-align:right;"> 
          <div class="btn-group">
            <p align="right">
            <!--<button type="submit" name="delete_alt" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Remove</button>-->
                <button type="button" onclick="location.href='new_alternative.php'" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span>  Add Alternative</button>
            </p>
          </div>
         </div>
            <br>
        <table width="100%" class="table table-striped table-bordered" id="tabeldata">
          <thead>
            <tr>
              <!--<th width="10px"><input type="checkbox" name="select-all" id="select-all" /></th>-->
              <th>Alternative ID</th>
              <th>Alternative Name</th>
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
            <?php $no=1; while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) :  ?>
              <tr>
                <!--<td style="vertical-align:middle;"><input type="checkbox" value="<?php echo $row['alt_id'] ?>" name="checkbox[]" /></td>-->
                <td style="vertical-align:middle;"><?php echo $row['alt_id'] ?></td>
                <td style="vertical-align:middle;"><?php echo $row['alt_name'] ?></td>
                <!--<td style="vertical-align:middle;"><?php //echo $row['bobot_kriteria'] ?></td>-->
                <td style="text-align:center;vertical-align:middle;">
                  <a href="edit_alternative.php?id=<?php echo $row['alt_id'] ?>" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                  <a href="delete_alternative.php?id=<?php echo $row['alt_id'] ?>" onclick="return confirm('Are you sure you want to delete this alternative?')" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                </td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
    </form>

          <a href="evaluate_alternative.php" class="button">Evaluate</a>
          

   
  </div>

   
  </div>
</div>


   <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

</body>
</html>
