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
include_once('includes/subcriteria.inc.php');
include_once('includes/subbobot.inc.php');
include_once('includes/criteria.inc.php');

$subbobotObj = new Subbobot($db);
$criteriaObj = new Criteria($db);
$count = $subbobotObj->countAll();

if(isset($_POST['submit'])){
  $subcriteriaObj = new Subcriteria($db);
  $subcriteriaCount = $subcriteriaObj->countAll();

  $r = [];
  $subcriterias = $subcriteriaObj->readAll();
  while ($row = $subcriterias->fetch(PDO::FETCH_ASSOC)) {
    $subcriteriass = $subcriteriaObj->readSatu($row['fld_subcriteria_id']);
    while ($roww = $subcriteriass->fetch(PDO::FETCH_ASSOC)) {
      $pcs = explode("S", $roww['fld_subcriteria_id']);
      $c = $subcriteriaCount - $pcs[1];
    }
    if ($c>=1) {
      $r[$row['fld_subcriteria_id']] = $c;
    }
  }

  $no=1;
  foreach ($r as $k => $v) {
    for ($i=1; $i<=$v; $i++) {
      $pcs = explode("S", $k);
      $nid = "S".($pcs[1]+$i);

      if ($subbobotObj->insert($_POST[$k.$no], $_POST['nl'.$no], $_POST[$nid.$no], $user)) {
        // ...
      } else {
        $subbobotObj->update($_POST[$k.$no], $_POST['nl'.$no], $_POST[$nid.$no], $user);
      }

      if ($subbobotObj->insert($_POST[$nid.$no], 1/$_POST['nl'.$no], $_POST[$k.$no], $user)) {
        // ...
      } else {
        $subbobotObj->update($_POST[$nid.$no], 1/$_POST['nl'.$no], $_POST[$k.$no], $user);
      }
      $no++;
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
  height: 1250px;
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
  height: 450px;
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
      <li><a href="an_criteria.php">Criteria</a></li>
      <li class="active">Sub-Criteria (Universal Design)</li>
      <li><a href="an_sub2.php">Sub-Criteria (Innovation)</a></li>
      <li><a href="an_sub3.php">Sub-Criteria (Intelligence)</a></li>
      <li><a href="an_eva_alt.php">Select Alternative</a></li>
      <li><a href="an_alt.php">Alternative</a></li>
      <li><a href="an_result.php">Summary Report</a></li>
    </ol>

   
    <p style="margin-bottom:10px;">
      <strong style="font-size:18pt;"><span class="fa fa-bomb"></span> Pairwise Comparison Result for Sub-Criteria - Universal Design</strong>
    </p>
<table width="100%" class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>Sub-Criteria</th>
          <?php $subbobots1 = $subbobotObj->readAll2($user); while ($row = $subbobots1->fetch(PDO::FETCH_ASSOC)): ?>
            <th><?=$row['fld_subcriteria_name'] ?></th>
          <?php endwhile; ?>
        </tr>
      </thead>
      <tbody>
        <?php $subbobots2 = $subbobotObj->readAll2($user); while ($baris = $subbobots2->fetch(PDO::FETCH_ASSOC)): ?>
          <tr>
            <th class="active"><?=$baris['fld_subcriteria_name'] ?></th>
            <?php $subbobots3 = $subbobotObj->readAll2($user); while ($kolom = $subbobots3->fetch(PDO::FETCH_ASSOC)): ?>
              <td>
                <?php
                if ($baris['fld_subcriteria_id'] == $kolom['fld_subcriteria_id']) {
                  echo '1';
                  
                  $conn = new mysqli('sql6.freemysqlhosting.net', 'sql6496163', 'KpxBp7Ln2Y', 'sql6496163');
                  //$conn = new mysqli('lrgs.ftsm.ukm.my', 'a176496', 'bigwhiterabbit', 'a176496');
                  $sql = "SELECT * FROM tbl_eduapp_analyse_subcriteria WHERE user_id=$user";
                  if ($result=mysqli_query($conn,$sql)) {
                    $rowcount=mysqli_num_rows($result);
                    //echo "The total number of rows are: ".$rowcount; 

                  }

                if (!isset($_POST['delete'])){

                  if ($rowcount<9){

                  if ($subbobotObj->insert($baris['fld_subcriteria_id'], '1', $kolom['fld_subcriteria_id'], $user)) {
                    // ...
                  } else {
                    $subbobotObj->update($baris['fld_subcriteria_id'], '1', $kolom['fld_subcriteria_id'], $user);
                  }

                }
                else {
                  //....
                }

                } else{
                $subbobotObj->delete($user);
              }

                } else {
                  $subbobotObj->readAll1($baris['fld_subcriteria_id'], $kolom['fld_subcriteria_id'], $user);
                  echo number_format($subbobotObj->kp, 4, '.', ',');
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
          <?php $stmt5 = $subbobotObj->readAll2($user); while ($row = $stmt5->fetch(PDO::FETCH_ASSOC)): ?>
            <th>
              <?php
                $subbobotObj->readSum1($row['fld_subcriteria_id'], $user);
                echo number_format($subbobotObj->nak, 4, '.', ',');
                $subbobotObj->insert3($subbobotObj->nak, $row['fld_subcriteria_id'], $user);
              ?>
            </th>
          <?php endwhile; ?>
        </tr>
        <tr class="info">
          <th style="background-color: #FFFFE0;">AN Total</th>
          <?php $stmt5 = $subbobotObj->readAll2($user); while ($row = $stmt5->fetch(PDO::FETCH_ASSOC)): ?>
            <th style="background-color: #FFFFE0">
              <?php
                $subbobotObj->readVectorSum($row['fld_subcriteria_id'], $user);
                echo number_format($subbobotObj->nak, 4, '.', ',');
                $subbobotObj->insert9($subbobotObj->nak, $row['fld_subcriteria_id'], $user);
              ?>
            </th>
          <?php endwhile; ?>
        </tr>
      </tfoot>
    </table>

    <table width="100%" class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>Sub-Criteria (AN)</th>
          <?php $subbobots1x = $subbobotObj->readAll2($user); while ($row2x = $subbobots1x->fetch(PDO::FETCH_ASSOC)): ?>
            <th><?=$row2x['fld_subcriteria_name'] ?></th>
          <?php endwhile; ?>
          
          
        </tr>
      </thead>
      <tbody>
        <?php $subbobots2x = $subbobotObj->readAll2($user); while ($baris = $subbobots2x->fetch(PDO::FETCH_ASSOC)): ?>
          <tr>
            <th class="active"><?=$baris['fld_subcriteria_name'] ?></th>
            <?php $stmt4x = $subbobotObj->readAll2($user); while ($kolom = $stmt4x->fetch(PDO::FETCH_ASSOC)): ?>
              <td>
              <?php
                if ($baris['fld_subcriteria_id'] == $kolom['fld_subcriteria_id']) {
                  $c = 1- (1/$kolom['subcriteria_an_total']);
                  $subbobotObj->insert10($c, $baris['fld_subcriteria_id'], $kolom['fld_subcriteria_id'], $user);
                  echo number_format($c, 4, '.', ',');
                } else {
                  $subbobotObj->readAll1($baris['fld_subcriteria_id'], $kolom['fld_subcriteria_id'], $user);
                  $c = 1-($subbobotObj->kp/$kolom['subcriteria_an_total']);
                  $subbobotObj->insert10($c, $baris['fld_subcriteria_id'], $kolom['fld_subcriteria_id'], $user);
                  echo number_format($c, 4, '.', ',');
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
          <?php $stmt5 = $subbobotObj->readAll2($user); while ($row = $stmt5->fetch(PDO::FETCH_ASSOC)): ?>
            <th>
              <?php
                $subbobotObj->readSum4($row['fld_subcriteria_id'], $user);
                echo number_format($subbobotObj->hak, 4, '.', ',');
                $subbobotObj->insert11($subbobotObj->hak, $row['fld_subcriteria_id'], $user);
              ?>
            </th>
          <?php endwhile; ?>
        </tr>
      </tfoot>
    </table>

    <table width="100%" class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>Comparison</th>
          <?php $subbobots1x = $subbobotObj->readAll2($user); while ($row2x = $subbobots1x->fetch(PDO::FETCH_ASSOC)): ?>
            <th><?=$row2x['fld_subcriteria_name'] ?></th>
          <?php endwhile; ?>
          <th class="info">Total</th>
          <th class="success">Local Priority</th>
          
        </tr>
      </thead>
      <tbody>
        <?php $subbobots2x = $subbobotObj->readAll2($user); while ($baris = $subbobots2x->fetch(PDO::FETCH_ASSOC)): ?>
          <tr>
            <th class="active"><?=$baris['fld_subcriteria_name'] ?></th>
            <?php $stmt4x = $subbobotObj->readAll2($user); while ($kolom = $stmt4x->fetch(PDO::FETCH_ASSOC)): ?>
              <td>
              <?php
                
                  $subbobotObj->readAll4($baris['fld_subcriteria_id'], $kolom['fld_subcriteria_id'], $user);
                  $c = ($subbobotObj->kp/$kolom['subcriteria_an_total_2']);
                  $subbobotObj->insert12($c, $baris['fld_subcriteria_id'], $kolom['fld_subcriteria_id'], $user);
                  echo number_format($c, 4, '.', ',');
               
                ?>
              </td>
            <?php endwhile; ?>
            <th class="info">
              <?php
              $subbobotObj->readSum5($baris['fld_subcriteria_id'], $user);
              $j = $subbobotObj->hak;
              echo number_format($j, 4, '.', ',');
              ?>
            </th>
            <th class="success">
              <?php
              $subbobotObj->readAvg2($baris['fld_subcriteria_id'], $user);
              $b = $subbobotObj->hak;
              $subbobotObj->insert13($b, $baris['fld_subcriteria_id'], $user);
              echo number_format($b, 4, '.', ',');
              ?>
            </th>

            

          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>

    

    <table width="100%" class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>Consistency Ratio</th>
          
          <th style="background-color:#FFD700">Criteria Priority</th>
          <th class="success">Global Priority</th>
         
        </tr>
      </thead>
      <tbody>
        <?php $total=0; $subbobots1z = $subbobotObj->readAll2($user); while ($row1 = $subbobots1z->fetch(PDO::FETCH_ASSOC)): ?>
          <tr>
            <th class="active"><?=$row1["fld_subcriteria_name"]?></th>
            

            <th style="background-color:#FFD700">
              <?php
              //<?php $bobots1y = $criteriaObj->readCriteria("C1"); while ($row = $bobots1y->fetch(PDO::FETCH_ASSOC)): 
              $conn = new mysqli('sql6.freemysqlhosting.net', 'sql6496163', 'KpxBp7Ln2Y', 'sql6496163');
              //$conn = new mysqli('lrgs.ftsm.ukm.my', 'a176496', 'bigwhiterabbit', 'a176496');
                  $sql = "SELECT criteria_an FROM tbl_eduapp_criteria_data WHERE fld_criteria_id='C1' AND user_id=$user";
                  $result=mysqli_query($conn,$sql)
                ?>
                <?php  
                while($rows=$result->fetch_assoc())
                {
             ?>
              
            <?php echo number_format($rows['criteria_an'], 4, '.', ',');?>
              <?php }
          
              ?>
            </th>

            <th class="success">
              <?php
              $subbobotObj->getsubGlobal3($row1['fld_subcriteria_id'], $user);
              $m = $subbobotObj->hak;
              $subbobotObj->insert14($m, $row1['fld_subcriteria_id'], $user);
              echo number_format($m, 4, '.', ',');
              $total += $m
              ?>

            </th>
            
            
          </tr>
        <?php endwhile; ?>
      </tbody>
      <tfoot>
        <tr>
          <th colspan="2">Total</th>
          <th><?php $sub = $total; echo number_format($sub, 4, '.', ','); ?></th>
        </tr>
      </tfoot>
    </table>

    <table width="100%" class="table table-striped table-bordered">
      <tbody>
        <tr>
          <th>N (Sub-Criteria)</th>
          <td><?=$count?></td>
        </tr>
        <tr>
          <th>Final Results</th>
          <td><?php
          $subbobotObj->getCI2($user);
          $a=$subbobotObj->nak;
          echo number_format($a, 4, '.', ',');
        ?></td>
        </tr>
        <tr>
          <th>IR</th>
          <td><?php echo $ir = $subbobotObj->getIr($count); ?></td>
        </tr>
        <tr>
          <th>CI</th>
          <td><?php $ci = ($a -$count)/($count-1); echo number_format($ci, 4, '.', ',');?></td>
        </tr>
        <tr>
          <th>CR</th>
          <td><?php $cr = $ci/$ir; echo number_format($cr, 4, '.', ',');?></td>
        </tr>
      </tbody>
    </table>
    <a href="an_sub2.php" class="button">Next</a>
    <a style="float:left" href="an_criteria.php" class="button">Return</a>
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
