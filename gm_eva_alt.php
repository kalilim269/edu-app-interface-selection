<?php
include_once 'loginfunctions.php';
if (!isLoggedIn()) {
  $_SESSION['msg'] = "You must log in first";
  header('location: login.php');
}

if (isset($_SESSION['user']))  { 

    $user = $_SESSION['user']['fld_user_num'];
}

include_once ("includes/config.php");
$config = new Config();
$db = $config->getConnection();
include_once('includes/skor.inc.php');
include_once('includes/alternatif.inc.php');
include_once('includes/criteria.inc.php');
include_once('includes/value.inc.php');
include_once('includes/subcriteria.inc.php');

$altObj = new Alternatif($db);
$skoObj = new Skor($db);
$subcriObj = new Subcriteria($db);
$nilObj = new Value($db);

$altCount = $altObj->countByFilter();

$no = 1; $r = []; $nid = [];
$alt1 = $altObj->readByFilter();
while ($row = $alt1->fetch(PDO::FETCH_ASSOC)){
	$alt2 = $altObj->readByFilter();
	while ($roww = $alt2->fetch(PDO::FETCH_ASSOC)) {
		$nid[$row['alt_id']][] = $roww['alt_id'];
	}
	$total = $altCount-$no;
	if ($total>=1) {
		$r[$row['alt_id']] = $total;
	}
	$no++;
}

$ni=1;
foreach ($nid as $key => $value) {
	array_splice($nid[$key], 0, $ni++);
}
$ne = count($nid)-1;
array_splice($nid, $ne, 1);
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
  padding-top: 20px;
  margin: 50px auto;
  border-radius: 10px;
  border: 0px solid #FFEBCD;
  margin-top: 30px;
}

.form-style-8{
  max-width: 800px;
  height: 1850px;
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

@media screen and (max-width: 1500px) {
  .form-style-9 {
    height: 100%;
    position: relative;
  }
}


/* From uiverse.io */
button {
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

button:hover {
 background-color: #000000;
 box-shadow: 0px 15px 20px rgba(46, 229, 157, 0.4);
 color: #fff;
 transform: translateY(-7px);
}

button:active {
 transform: translateY(-1px);
}

ol li a{
  color: red;
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
 float: left;
 margin-top: 20px;
 margin-right: 30px;
 
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

</style>
  
</head>
<body>
  <?php include_once 'navi_bar.php'; ?>

  <div class="sidebar">
  <a href="criteria.php"><b>Criteria</b></a>
  <a href="subcriteria.php"><b>Sub-Criteria</b></a>
  <a href="alternative.php"><b>Alternative</b></a>
  <a class="active" href="method.php"><b>AHP Method</b></a>
  <a href="rank.php"><b>Random Forest Model</b></a>
  <a href="report.php"><b>Summary Report</b></a>
  <a href="save.php"><b>Save Project</b></a>
</div>

<div class="content">
  <div class="col-xs-12 col-sm-12 col-md-12">
    <div class="row">
  <div class="form-style-9">
  

     <ol class="breadcrumb" style="background-color: #F0FFFF;">
      <li><a href="gm_criteria.php">Criteria</a></li>
      <li><a href="gm_sub1.php">Sub-Criteria (Universal Design)</a></li>
      <li><a href="gm_sub2.php">Sub-Criteria (Innovation)</a></li>
      <li><a href="gm_sub3.php">Sub-Criteria (Intelligence)</a></li>
      <li class="active">Select Alternative</li>
      <li><a href="gm_alt.php">Alternative</a></li>
      <li><a href="gm_result.php">Summary Report</a></li>
    </ol>

  
   
    <p style="margin-bottom:10px;">
      <strong style="font-size:18pt;"><span class="fa fa-bomb"></span> Evaluate Alternative</strong>
    </p>
    <div class="panel panel-default">
      <div class="panel-body">
        <form method="post" action="gm_alt.php">
        	<div class="row">
						<div class="col-xs-12 col-md-3">
							<div class="form-group">
								<p style="padding:10px 0;"><label>Choose Sub-Criteria</label></p>
							</div>
						</div>
						<div class="col-xs-12 col-md-9">
							<div class="form-group">
								<select class="form-control" id="subcriteria" name="subcriteria">
								<?php $kri2 = $subcriObj->readAllSubCri($user); while ($row = $kri2->fetch(PDO::FETCH_ASSOC)): ?>
									<option value="<?=$row['fld_subcriteria_id']?>"><?=$row['fld_subcriteria_name']?></option>
								<?php endwhile; ?>
								</select>
							</div>
						</div>
					</div>
					<hr>

         
          
          <button type="submit" name="submit"> Select</button>
          <a href="gm_sub3.php" class="button">Return</a>
        </form>
      </div>
    </div>
  </div>
</div>


          
        
  </div>

   
  </div>
</div>


   <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

</body>
</html>
