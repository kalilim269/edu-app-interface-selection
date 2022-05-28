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
include_once('includes/subcriteria.inc.php');

$skoObj = new Skor($db);
$altObj = new Alternatif($db);
$altsubcriteria = isset($_POST['subcriteria']) ? $_POST['subcriteria'] : $_GET['subcriteria'];

//$altsubcriteria = ($_POST['subcriteria']);

if (isset($altsubcriteria)) {
 
  $skoObj->readKri($altsubcriteria);
  $count = $skoObj->countAll();
  $count2 = $altObj->countAll2($user);

  if (isset($_POST['submit'])) {
    $altCount = $altObj->countByFilter();

    $no=1; $r = []; $nid = [];
    $alt1 = $altObj->readByFilter();
    while ($row = $alt1->fetch(PDO::FETCH_ASSOC)){
      if ($count2 < 19){
      $altObj->insert($user, $row['alt_id'], $row['alt_name']);
    }
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

    // print_r($r);
    // print_r($nid);
    // die();

    $no=1; foreach ($r as $k => $v) {
       $j=0; for ($i=1; $i<=$v; $i++) {
        // $rows = $altObj->readSatu($k); while ($row = $rows->fetch(PDO::FETCH_ASSOC)){
          if ($skoObj->insert($_POST[$k.$no], $_POST['nl'.$no], $_POST[$nid[$k][$j].$no], $altsubcriteria, $user)) {
            // ...
          } else {
            $skoObj->update($_POST[$k.$no], $_POST['nl'.$no], $_POST[$nid[$k][$j].$no], $altsubcriteria, $user);
          }

          if ($skoObj->insert($_POST[$nid[$k][$j].$no], 1/$_POST['nl'.$no], $_POST[$k.$no], $altsubcriteria, $user)) {
            // ...
          } else {
            $skoObj->update($_POST[$nid[$k][$j].$no], 1/$_POST['nl'.$no], $_POST[$k.$no], $altsubcriteria, $user);
          }
          $no++; $j++;
        // }
      }
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
  max-width: 1200px;
  height: 2500px;
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
 margin-top: -5px;
 
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

</style>

<script type="text/javascript">
  if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

  
</head>
<body>
  <?php include_once 'navi_bar.php'; ?>

  <div class="sidebar">
  <a href="criteria.php"><b>Criteria</b></a>
  <a href="subcriteria.php"><b>Sub-Criteria</b></a>
  <a class="active" href="alternative.php"><b>Alternative</b></a>
  <a href="method.php"><b>AHP Method</b></a>
  <a href="rank.php"><b>Random Forest Model</b></a>
  <a href="report.php"><b>Summary Report</b></a>
  <a href="save.php"><b>Save Project</b></a>
</div>

<div class="content">
  <div class="col-xs-12 col-sm-12 col-md-12">
    <div class="row">
  <div class="form-style-9">
  

     <ol class="breadcrumb" style="background-color: #F0FFFF;">
      <li><a href="alternative.php">Alternative</a></li>
      <li><a href="evaluate_alternative.php">Evaluate Alternative</a></li>
      <li class="active">Alternative Evaluation Table</li>
    </ol>

   
    <p style="margin-bottom:10px;">
      <strong style="font-size:18pt;"><span class="fa fa-bomb"></span> Pairwise Comparison Result for Alternative</strong>
    </p>

    <div>
        <form method="post">
          <button name="delete" class="btn btn-danger" style="float:right; margin-bottom: 15px;" onclick="return confirm('Are you sure? All evaluation data will be deleted from the database.')">Delete All Data</button>
        </form>
      </div>

<table width="100%" class="table table-striped table-bordered">
      <thead>
          <tr>
            <th><?=$skoObj->kri?></th>
            <?php $alt1a = $altObj->readByFilter(); while ($row = $alt1a->fetch(PDO::FETCH_ASSOC)): ?>
              <th><?=$row['alt_name']?></th>
            <?php endwhile; ?>
          </tr>
        </thead>
        <tbody>
          <?php $alt2a = $altObj->readByFilter(); while ($baris = $alt2a->fetch(PDO::FETCH_ASSOC)): ?>
            <tr>
              <th class="active"><?=$baris['alt_name']?></th>
              <?php $alt3a = $altObj->readByFilter(); while ($kolom = $alt3a->fetch(PDO::FETCH_ASSOC)): ?>
                <td>
                <?php
                  if ($baris['alt_id'] == $kolom['alt_id']) {
                    echo '1';

                    $conn = new mysqli('lrgs.ftsm.ukm.my', 'a176496', 'bigwhiterabbit', 'a176496');
                  $sql = "SELECT * FROM tbl_eduapp_analyse_alternative WHERE user_id=$user";
                  if ($result=mysqli_query($conn,$sql)) {
                    $rowcount=mysqli_num_rows($result);
                    //echo "The total number of rows are: ".$rowcount; 

                  }

                  //if ($rowcount<9){


                    if (!$skoObj->insert($baris['alt_id'], '1', $kolom['alt_id'], $altsubcriteria, $user)) {
                      $skoObj->update($baris['alt_id'], '1', $kolom['alt_id'], $altsubcriteria, $user);
                    }
                  //} else {
                    //....
                  //}
                }
                  else {
                    $skoObj->readAll1($baris['alt_id'], $kolom['alt_id'], $altsubcriteria, $user);
                    echo number_format($skoObj->kp, 4, '.', ',');
                  }
                ?>
                </td>
              <?php endwhile; ?>
            </tr>
          <?php endwhile; ?>
        </tbody>
        <tfoot>
          <tr class="info">
            <th>Total</th>
            <?php /*$jumlahBobot=[];*/ $alt4a = $altObj->readByFilter(); while ($row = $alt4a->fetch(PDO::FETCH_ASSOC)): ?>
            <th>
              <?php

                 $conn = new mysqli('lrgs.ftsm.ukm.my', 'a176496', 'bigwhiterabbit', 'a176496');
                  $sql = "SELECT * FROM tbl_eduapp_analyse_alternative WHERE user_id=$user";
                  if ($result=mysqli_query($conn,$sql)) {
                    $rowcount=mysqli_num_rows($result);
                    //echo "The total number of rows are: ".$rowcount; 

                  }

                  //if ($rowcount<10){

                $skoObj->readSum1($row['alt_id'], $altsubcriteria, $user);
                echo number_format($skoObj->nak, 4, '.', ',');
                if (!$skoObj->insert3($row['alt_id'], $altsubcriteria, $skoObj->nak, $user)) {
                  $skoObj->insert5($skoObj->nak, $row['alt_id'], $altsubcriteria, $user);
                }
              //}
                //else{
                  //$skoObj->readAll3($row['id_alternatif'], $altsubcriteria);
                    //echo number_format($skoObj->jak, 4, '.', ',');
                //}
                //$jumlahBobot[$row["id_alternatif"]] = $skoObj->nak;
              ?>
            </th>
          <?php endwhile;?>
          </tr>
        </tfoot>
      </table>

      <table width="100%" class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>Comparison</th>
            <?php $alt1b = $altObj->readByFilter(); while ($row = $alt1b->fetch(PDO::FETCH_ASSOC)): ?>
              <th><?=$row['alt_name']?></th>
            <?php endwhile; ?>
            <th class="success">Local Priority</th>
            <th style="background-color:#FFD700">Sub-Criteria Priority</th>
            <th style="background-color:#00CED1">Global Priority</th>
          </tr>
        </thead>
        <tbody>
          <?php $alt2b = $altObj->readByFilter(); while ($baris = $alt2b->fetch(PDO::FETCH_ASSOC)): ?>
            <tr>
              <th class="active"><?=$baris['alt_name']?></th>
              <?php $alt3b = $altObj->readByFilter(); while ($kolom = $alt3b->fetch(PDO::FETCH_ASSOC)): ?>
                <td>
                  <?php
                    $skoObj->readAll3($kolom['alt_id'], $altsubcriteria, $user);
                    $jumlahBobot = $skoObj->jak;
                    if ($baris['alt_id'] == $kolom['alt_id']) {
                      $n = 1/$jumlahBobot;
                      $skoObj->insert2($n, $baris['alt_id'], $kolom['alt_id'], $altsubcriteria, $user);
                      echo number_format($n, 4, '.', ',');
                    } else {
                      $skoObj->readAll1($baris['alt_id'], $kolom['alt_id'], $altsubcriteria, $user);
                      $bobot = $skoObj->kp;
                      $n = $bobot/$jumlahBobot;
                      $skoObj->insert2($n, $baris['alt_id'], $kolom['alt_id'], $altsubcriteria, $user);
                      echo number_format($n, 4, '.', ',');
                    }
                  ?>
                </td>
              <?php endwhile; ?>
              <th class="success">
                <?php
              
                $skoObj->readAvg($baris['alt_id'], $altsubcriteria, $user);
                $prioritas = $skoObj->hak;
                $skoObj->insert4($prioritas, $baris['alt_id'], $altsubcriteria, $user);
                echo number_format($prioritas, 4, '.', ',');
              
                ?>
              </th>

              <th style="background-color:#FFD700">
         
            <?php 
            $skoObj->readKriId($altsubcriteria, $user);
            $skoObj->readSubPri($altsubcriteria, $user);
            $a = $skoObj->sub;
            echo number_format($a, 4, '.', ',');
            ?>
            
          </th>
            <th style="background-color:#00CED1">  
              
              <?php
              $skoObj->readAvg($baris['alt_id'], $altsubcriteria, $user);
                $prioritas = $skoObj->hak;
                //$skoObj->insert4($prioritas, $baris['id_alternatif'], $altsubcriteria);
                //echo number_format($prioritas, 4, '.', ',');

                $skoObj->readKriId($altsubcriteria, $user);
                $skoObj->readSubPri($altsubcriteria, $user);
                $a = $skoObj->sub;
                
                echo number_format($prioritas*$a, 4, '.', ',');
              //$skoObj->getaltGlobal($baris['id_alternatif'], $altsubcriteria);
              //$m = $skoObj->alt;
              //$skoObj->insert6($m, $baris['id_alternatif'], $altsubcriteria);
              //echo number_format($m, 4, '.', ',');
              ?>
                      
           </th>
            </tr>
         <?php endwhile; ?>
        </tbody>
      </table>

      <!-- <table width="100%" class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>Penjumlahan</th>
            <?php //$alt1y = $skoObj->readAll2(); while ($row = $alt1y->fetch(PDO::FETCH_ASSOC)): ?>
              <th><?//=$row['nama']?></th>
            <?php //endwhile; ?>
            <th class="info">Jumlah</th>
          </tr>
        </thead>
        <tbody>
          <?php //$sumRow = []; $alt2y = $skoObj->readAll2(); while ($baris = $alt2y->fetch(PDO::FETCH_ASSOC)): ?>
            <tr>
              <th class="active"><?//=$baris['nama'] ?></th>
              <?php //$jumlah = 0; $alt3y = $skoObj->readAll2(); while ($kolom = $alt3y->fetch(PDO::FETCH_ASSOC)): ?>
                <td>
                <?php
                  // if ($baris['id_alternatif'] == $kolom['id_alternatif']) {
                  //  $c = $prioritas * 1;
                  //  echo number_format($c, 4, '.', ',');
                  //  $jumlah += $c;
                  // } else {
                  //  $skoObj->readAll1($baris['id_alternatif'], $kolom['id_alternatif'], $altkriteria);
                  //  $c = $prioritas * $skoObj->kp;
                  //  echo number_format($c, 4, '.', ',');
                  //  $jumlah += $c;
                  // }
                  ?>
                </td>
              <?php //endwhile; ?>
              <th class="info">
                <?php
                // $sumRow[$baris['id_alternatif']] = $jumlah;
                // echo number_format($jumlah, 4, '.', ',');
                ?>
              </th>
            </tr>
          <?php //endwhile;?>
        </tbody>
      </table> -->
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

<?php } else {
  echo "<script>location.href='evaluate_alternative.php'</script>";
}

?>

<?php
if (isset($_POST['delete'])) {
    $skoObj->delete($user);
    $skoObj->delete2($user);
    $skoObj->delete3($user);
    //echo "<script>location.href='evaluate_alternative.php'</script>";
    //exit();
    
  }
?>