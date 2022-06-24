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

include_once('includes/alternatif.inc.php');
include_once('includes/subcriteria2.inc.php');
include_once('includes/subcriteria3.inc.php');
include_once('includes/subcriteria.inc.php');
include_once('includes/criteria.inc.php');
include_once('includes/ranking.inc.php');

$altObj = new Alternatif($db);

$kriObj = new Criteria($db);
$subcriObj = new Subcriteria($db);
$subcriObj2 = new Subcriteria2($db);
$subcriObj3 = new Subcriteria3($db);

$ranObj = new Ranking($db);
$stmt = $ranObj->readKhusus();
$stmty = $ranObj->readKhusus();
$count = $ranObj->countAll();
//$stmtx1y = $ranObj->readBob();
//$stmtx2y = $ranObj->readBob();




?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
   <title>EDU APP INTERFACE SELECTION : Summary Report</title>
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
  max-width: 1200px;
  height: 4000px;
  background: #FFE4E1;
  padding: 50px;
  padding-top: 10px;
  margin: 50px auto;
  border-radius: 10px;
  border: 0px solid #FFEBCD;
}

.form-style-8{
  max-width: 1100px;
  height:3750px;
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
  height: 4200px;
}

@media screen and (max-width: 800px) {
  .sidebar {
    width: 95%;
    height: auto;
    position: relative;
  }
  .sidebar a {float: left;}
  div.content {
    margin-left: 0;
    height: 4300px;
  }

  .form-style-9{
  max-width: 1200px;
  height: 4200px;
  background: #FFE4E1;
  padding: 50px;
  padding-top: 10px;
  margin: 50px auto;
  border-radius: 10px;
  border: 0px solid #FFEBCD;
}

.form-style-8{
  max-width: 1100px;
  height:3950px;
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

ol li a{
  color: red;

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
  
<script src="assets/js/jquery-1.11.3.min.js"></script>
  <!--<script src="assets/js/bootstrap.min.js"></script>-->
  <script src="assets/js/highcharts.js"></script>
  <script src="assets/js/exporting.js"></script>


</head>
<body>
  <?php include_once 'navi_bar.php'; ?>

<div class="alert info">
  <span class="closebtn">&times;</span>  
  <strong>Info! Please take note!</strong><br> Please go through all the Alternative Evaluation Table before proceeding to the Summary Report to obtain the complete report.
</div>

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
  
  <div class="form-style-9">

    <ol class="breadcrumb" style="background-color: #F0FFFF; margin-top: 10px;">
      <li><a href="gm_criteria.php">Criteria</a></li>
      <li><a href="gm_sub1.php">Sub-Criteria</a></li>
      <li><a href="gm_eva_alt.php">Select Alternative</a></li>
      <li><a href="gm_alt.php">Alternative</a></li>
      <li class="active">Summary Report</a></li>
    </ol>

          <h2 style="text-align: center;font-size: 25px; margin-top: 10px;"><b>Summary Report</b></h2>
           <div class="form-style-8">
          <h2 style="text-align: center;font-size: 25px;"><b></b></h2>

          <div class="row">
  <div class="col-xs-12 col-sm-12 col-md-12">
   
    <div class="row">
      <div class="col-md-6 text-left">
        <p style="margin-bottom:-10px;">
      <strong style="font-size:14pt;"><span class="fa fa-bomb"></span>Priority Weightage</strong>
    </p>
        
      </div>
      <div class="col-md-6 text-right">
        <!--<button type="button" onclick="location.href='index.php'" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</button>-->
      </div>
    </div>
    <br/>
    <table width="100%" class="table table-striped table-bordered">
      <thead>
        <tr>
          <th rowspan="6" class="text-center active">Alternative</th>
          <th colspan="<?php $subcri1a = $subcriObj->readAll($user); echo $subcri1a->rowCount(); ?>" class="text-center">Criteria</th>

          <!--<th colspan="<?php $subcri1a //= $subcriObj->readAll(); echo $subcri1a->rowCount(); ?>" class="text-center">Sub-Criteria</th>-->
        </tr>

        <tr>
          <?php $kri2a = $kriObj->readC1($user); while ($row = $kri2a->fetch(PDO::FETCH_ASSOC)): ?>
            <th colspan="<?php $subcri1a = $subcriObj->readAll2($user, $row['fld_criteria_id']); echo $subcri1a->rowCount(); ?>" class="text-center"><?=$row['fld_criteria_name']?></th>
          <?php endwhile; ?>
          

        </tr>

        <tr class="success">
          <?php $bobot1 = $ranObj->readPrioC1($user); while ($row = $bobot1->fetch(PDO::FETCH_ASSOC)): ?>
            <td colspan="<?php $subcri1a = $subcriObj->readAll2($user, $row['fld_criteria_id']); echo $subcri1a->rowCount(); ?>" class="text-center"><?=number_format($row['criteria_gm'], 4, '.', ',')?></td> 
          <?php endwhile; ?>

          
        </tr>

        <tr>
          <th colspan="<?php $subcri1a = $subcriObj->readAll($user); echo $subcri1a->rowCount(); ?>" class="text-center">Sub-Criteria</th>
          
          
        </tr>

        <tr>
          <?php $subcri2a = $subcriObj->readAll($user); while ($row = $subcri2a->fetch(PDO::FETCH_ASSOC)): ?>
            <th><?=$row['fld_subcriteria_name']?></th>
          <?php endwhile; ?>

        </tr>

        <tr class="success">
          <?php $subbobot1 = $ranObj->readBob($user); while ($row = $subbobot1->fetch(PDO::FETCH_ASSOC)): ?>
            <td><?=number_format($row['global_priority_gm'], 4, '.', ',')?></td> 
          <?php endwhile; ?>
        </tr>

      </thead>
      <tbody>
        <?php $alt1a = $altObj->readByFilter($user); while ($row1 = $alt1a->fetch(PDO::FETCH_ASSOC)): ?>
          <tr>
            <th class="active"><?=$row1['alt_name']?></th>
            <?php $a = $row1['alt_id']; ?>
            <?php $subcri2a = $subcriObj->readAllSubCri($user); while ($row2 = $subcri2a->fetch(PDO::FETCH_ASSOC)): ?>
              <?php $b = $row2['fld_subcriteria_id']; ?>
              <?php $ran1a = $ranObj->readR($a, $b, $user); while ($row3 = $ran1a->fetch(PDO::FETCH_ASSOC)): ?>
                <td>
                  <?php
                    echo $nor = number_format($row3['alt_gm'], 4, '.', ',');
                    /*
                    pow($rowr['skor_alt_kri'],$bobot);
                    $ranObj->ia = $a;
                    $ranObj->ik = $b;
                    $ranObj->nn4 = $nor;
                    $ranObj->normalisasi1();
                    */
                  ?>
                </td>
              <?php endwhile; ?>
            <?php endwhile; ?>
          </tr>
        <?php endwhile; ?>
        <!-- <tr class="info">
          <th>Jumlah</th>
          <?php //$bobot2 = $ranObj->readBob(); while ($row = $bobot2->fetch(PDO::FETCH_ASSOC)): ?>
            <td>
              <?php
                // $rmax1 = $ranObj->readMax($row['id_kriteria']);
                // $max = $rmax1->fetch(PDO::FETCH_ASSOC);
                // echo number_format($max['mnr1'], 4, '.', ',');
              ?>
            </td>
          <?php //endwhile; ?>
        </tr> -->
      </tbody>
    </table>
    <br>

    <p style="margin-bottom:-10px;">
      <strong style="font-size:14pt;"><span class="fa fa-bomb"></span>Final Result</strong>
    </p>
    <br/>
    <table width="100%" class="table table-striped table-bordered">
      <thead>
        <tr>

          <th rowspan="6" class="text-center active">Alternative</th>
          <th colspan="<?php $subcri1a = $subcriObj->readAll($user); echo $subcri1a->rowCount(); ?>" class="text-center">Criteria</th>

          
          <th rowspan="4" style="background-color:#E0FFFF">Final Results</th>
        </tr>
        <tr>
       
          <?php $kri2a = $kriObj->readC1($user); while ($row = $kri2a->fetch(PDO::FETCH_ASSOC)): ?>
            <th colspan="<?php $subcri1a = $subcriObj->readAll2($user, $row['fld_criteria_id']); echo $subcri1a->rowCount(); ?>" class="text-center"><?=$row['fld_criteria_name']?></th>
          <?php endwhile; ?>
         
        </tr>

         <tr>
          <th colspan="<?php $subcri1a = $subcriObj->readAll($user); echo $subcri1a->rowCount(); ?>" class="text-center">Sub-Criteria</th>
          
          
        </tr>

        <tr>
          <?php $subcri2a = $subcriObj->readAll($user); while ($row = $subcri2a->fetch(PDO::FETCH_ASSOC)): ?>
            <th><?=$row['fld_subcriteria_name']?></th>
          <?php endwhile; ?>


        </tr>

      </thead>
      <tbody>
        <?php $alt1b = $altObj->readByFilter($user); while ($row1 = $alt1b->fetch(PDO::FETCH_ASSOC)): ?>
          <tr>
            <th class="active"><?=$row1['alt_name']?></th>
            <?php $a1 = $row1['alt_id']; ?>
            <?php $subcri2b = $subcriObj->readAllSubCri($user); while ($row2 = $subcri2b->fetch(PDO::FETCH_ASSOC)): ?>
              <?php $b2 = $row2['fld_subcriteria_id']; ?>
              <?php $ran1b = $ranObj->readR($a1, $b2, $user); while ($row3 = $ran1b->fetch(PDO::FETCH_ASSOC)): ?>
                <td>
                  <?php
                    $norx = $row3['alt_gm'] * $row2['global_priority_gm'];
                    //pow($row3['skor_alt_kri'],$bobot);
                    echo number_format($norx, 4, '.', ',');
                    //$ranObj->ia = $a1;
                    //$ranObj->ik = $b2;
                    //$ranObj->nn4 = $norx;
                    //$ranObj->normalisasi2();
                    $ranObj->insert2($norx, $a1, $b2, $user);
                  ?>
                </td>
              <?php endwhile; ?>
            <?php endwhile; ?>
            <td style="background-color:#E0FFFF">
              <?php
              $stmthasil = $ranObj->readHasil3($a1, $user);
              $hasil = $stmthasil->fetch(PDO::FETCH_ASSOC);
              echo number_format($hasil['tot'], 4, '.', ',');
              $ranObj->ia = $a1;
              $ranObj->has1 = $hasil['tot'];
              $ranObj->us = $user;
              $ranObj->hasil2();
              ?>
            </td>
          </tr>
        <?php endwhile; ?>
        <!-- <tr>
          <th>Jumlah</th>
          <?php //while ($rowx2 = $stmtx2y->fetch(PDO::FETCH_ASSOC)): ?>
            <td>
              <?php
                // $stmtx3y = $ranObj->readMax($rowx2['id_kriteria']);
                // $rowx3 = $stmtx3y->fetch(PDO::FETCH_ASSOC);
                // echo number_format($rowx3['mnr1'], 5, '.', ',');
              ?>
            </td>
          <?php //endwhile; ?>
          <td>
            <?php
              // $stmtx4y = $ranObj->readMax2();
              // $rowx4 = $stmtx4y->fetch(PDO::FETCH_ASSOC);
              // echo number_format($rowx4['mnr2'], 5, '.', ',');
            ?>
          </td>
        </tr> -->
      </tbody>
    </table>
    


  </div>
</div>
<br>
<?php
// Graph
include_once 'includes/alternatif.inc.php';
$pro1 = new Alternatif($db);
$stmt4 = $pro1->readByFilter2($user);
?>
<p style="margin-bottom:10px;">
      <strong style="font-size:14pt;"><span class="fa fa-bomb"></span>Alternative Preference Value</strong>
    </p>

<div id="container2" style="min-width: 100%; height: 400px; margin: 0 auto"></div>
     
     <br><br>

  <p style="margin-bottom:10px;">
      <strong style="font-size:14pt;"><span class="fa fa-bomb"></span>Alternative Ranking</strong>
    </p>
       <?php for ($i=2017; $i<=2017; $i++): ?>
      <!--<h4>Tahun <?=$i?></h4>-->
<table width="100%" class="table table-striped table-bordered">
          <thead>
          <tr>
            <!--<th>NIK</th>-->
            <th>Name</th>
            <th>Final Result</th>
            <th class="success">Ranking</th>
          </tr>
          </thead>
          <tbody>
          <?php $rank = 1; $alt1c = $altObj->readByRank2($user); while ($row = $alt1c->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
              <!--<td><?=$row["nik"]?></td>-->
              <td><?=$row["alt_name"]?></td>
              <td><?=number_format($row["gm_result"], 4, '.', ',')?></td>
              <td class="success"><?=$rank++?></td>
                </tr>
          <?php endwhile; ?>
          </tbody>
      </table>
   <?php endfor; ?>
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

  <script>
    var chart1; // globally available
    $(document).ready(function() {
      chart1 = new Highcharts.Chart({
      chart: {
        renderTo: 'container2',
        type: 'column'
      },
      title: {
        text: 'Final Priority By Alternative'
      },
      xAxis: {
        categories: ['Alternative']
      },
      yAxis: {
        title: {
          text: 'Priority Weightage'
        }
      },
      series: [
        <?php while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) : ?>
          //retrive data from database and insert into name and data variable
          {
            name: '<?php echo $row4['alt_name'] ?>',
            data: [<?php echo $row4['gm_result'] ?>]
          },
        <?php endwhile; ?>
      ]
      });
    });
  </script>

</body>
</html>
