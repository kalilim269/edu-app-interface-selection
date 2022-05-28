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
include_once('includes/criteria.inc.php');
include_once('includes/bobot.inc.php');

$bobotObj = new Bobot($db);
$criteriaObj = new Criteria($db);
$count = $bobotObj->countAll();

if(isset($_POST['submit'])){
  $criteriaObj = new Criteria($db);
  $criteriaCount = $criteriaObj->countAll();

  $r = [];
  $criterias = $criteriaObj->readAll();
  while ($row = $criterias->fetch(PDO::FETCH_ASSOC)) {
    $criteriass = $criteriaObj->readSatu($row['fld_criteria_id']);
    $criteriaObj->insert($user, $row['fld_criteria_id'], $row['fld_criteria_name']);
    while ($roww = $criteriass->fetch(PDO::FETCH_ASSOC)) {
      $pcs = explode("C", $roww['fld_criteria_id']);
      $c = $criteriaCount - $pcs[1];
    }
    if ($c>=1) {
      $r[$row['fld_criteria_id']] = $c;
    }
  }

  $no=1;
  foreach ($r as $k => $v) {
    for ($i=1; $i<=$v; $i++) {
      $pcs = explode("C", $k);
      $nid = "C".($pcs[1]+$i);

      if ($bobotObj->insert($_POST[$k.$no], $_POST['nl'.$no], $_POST[$nid.$no], $user)) {
        // ...
      } else {
        $bobotObj->update($_POST[$k.$no], $_POST['nl'.$no], $_POST[$nid.$no], $user);
      }

      if ($bobotObj->insert($_POST[$nid.$no], 1/$_POST['nl'.$no], $_POST[$k.$no], $user)) {
        // ...
      } else {
        $bobotObj->update($_POST[$nid.$no], 1/$_POST['nl'.$no], $_POST[$k.$no], $user);
      }
      $no++;
    }
  }
}
if (isset($_POST['delete'])) {
  $bobotObj->delete($user);
  $bobotObj->delete2($user);
  header("location: evaluate_criteria.php");
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
 
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
  height: 1150px;
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

<script type="text/javascript">
  function confirm1()
        {

            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false
            }).then(function () {
                swal(
                  'Deleted!',
                  'Your file has been deleted.',
                  'success'
                )
               //success method
            }, function (dismiss) {
                // dismiss can be 'cancel', 'overlay',
                // 'close', and 'timer'
                if (dismiss === 'cancel') {
                    swal(
                      'Cancelled',
                      'Your imaginary file is safe :)',
                      'error'
                    )                
                }
            })      
        }
</script>
  
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
  <div class="col-xs-12 col-sm-12 col-md-12">
    <div class="row">
  <div class="form-style-9">
  

     <ol class="breadcrumb" style="background-color: #F0FFFF;">
      <li><a href="criteria.php">Criteria</a></li>
      <li><a href="evaluate_criteria.php">Evaluate Criteria</a></li>
      <li class="active">Criteria Evaluation Table</li>
    </ol>

   
    <p style="margin-bottom:10px;">
      <strong style="font-size:18pt;"><span class="fa fa-bomb"></span> Pairwise Comparison Result for Criteria</strong>
    </p>
    <div>
        <form method="post">
          <button name="delete" class="btn btn-danger" style="float:right; margin-bottom: 15px;" onclick="return confirm('Are you sure? All evaluation data will be deleted from the database.')">Delete All Data</button>
          
          
        </form>
      </div>

<table width="100%" class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>Criteria</th>
          <?php $bobots1 = $bobotObj->readAll2($user); while ($row = $bobots1->fetch(PDO::FETCH_ASSOC)): ?>
            <th><?=$row['fld_criteria_name'] ?></th>
          <?php endwhile; ?>
        </tr>
      </thead>
      <tbody>
        <?php $bobots2 = $bobotObj->readAll2($user); while ($baris = $bobots2->fetch(PDO::FETCH_ASSOC)): ?>
          <tr>
            <th class="active"><?=$baris['fld_criteria_name'] ?></th>
            <?php $bobots3 = $bobotObj->readAll2($user); while ($kolom = $bobots3->fetch(PDO::FETCH_ASSOC)): ?>
              <td>
                <?php
                if ($baris['fld_criteria_id'] == $kolom['fld_criteria_id']) {
                  echo '1';

                  $conn = new mysqli('lrgs.ftsm.ukm.my', 'a176496', 'bigwhiterabbit', 'a176496');
                  $sql = "SELECT * FROM tbl_eduapp_analyse_criteria WHERE user_id=$user";
                  if ($result=mysqli_query($conn,$sql)) {
                    $rowcount=mysqli_num_rows($result);
                    //echo "The total number of rows are: ".$rowcount; 

                  }
              if (!isset($_POST['delete'])){

                if ($rowcount<9){

                  if ($bobotObj->insert($baris['fld_criteria_id'], '1', $kolom['fld_criteria_id'], $user)) {
                    // ...
                  } else {
                    $bobotObj->update($baris['fld_criteria_id'], '1', $kolom['fld_criteria_id'], $user);
                  }
                }
                else{
                  //$bobotObj->delete($user);
                  //if ($subbobotObj->insert(null, null, null)) {
                    // ...
                  //} else {
                    //($subbobotObj->update(null, null, null));
                  //}
                }

              }else{
                $bobotObj->delete($user);
              }
                 } else {
                  $bobotObj->readAll1($baris['fld_criteria_id'], $kolom['fld_criteria_id'], $user);
                  echo number_format($bobotObj->kp, 4, '.', ',');
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
          <?php $stmt5 = $bobotObj->readAll2($user); while ($row = $stmt5->fetch(PDO::FETCH_ASSOC)): ?>
            <th>
              <?php
                $bobotObj->readSum1($row['fld_criteria_id'], $user);
                echo number_format($bobotObj->nak, 4, '.', ',');
                $bobotObj->insert3($bobotObj->nak, $row['fld_criteria_id'], $user);
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
          <?php $bobots1x = $bobotObj->readAll2($user); while ($row2x = $bobots1x->fetch(PDO::FETCH_ASSOC)): ?>
            <th><?=$row2x['fld_criteria_name'] ?></th>
          <?php endwhile; ?>
          <th class="info">Total</th>
          <th class="success">Priority</th>
        </tr>
      </thead>
      <tbody>
        <?php $bobots2x = $bobotObj->readAll2($user); while ($baris = $bobots2x->fetch(PDO::FETCH_ASSOC)): ?>
          <tr>
            <th class="active"><?=$baris['fld_criteria_name'] ?></th>
            <?php $stmt4x = $bobotObj->readAll2($user); while ($kolom = $stmt4x->fetch(PDO::FETCH_ASSOC)): ?>
              <td>
              <?php
                if ($baris['fld_criteria_id'] == $kolom['fld_criteria_id']) {
                  $c = 1/$kolom['fld_criteria_total'];
                  $bobotObj->insert2($c, $baris['fld_criteria_id'], $kolom['fld_criteria_id'], $user);
                  echo number_format($c, 4, '.', ',');
                } else {
                  $bobotObj->readAll1($baris['fld_criteria_id'], $kolom['fld_criteria_id'], $user);
                  $c = $bobotObj->kp/$kolom['fld_criteria_total'];
                  $bobotObj->insert2($c, $baris['fld_criteria_id'], $kolom['fld_criteria_id'], $user);
                  echo number_format($c, 4, '.', ',');
                }
                ?>
              </td>
            <?php endwhile; ?>
            <th class="info">
              <?php
              $bobotObj->readSum2($baris['fld_criteria_id'], $user);
              $j = $bobotObj->hak;
              echo number_format($j, 4, '.', ',');
              ?>
            </th>
            <th class="success">
              <?php
              $bobotObj->readAvg($baris['fld_criteria_id'], $user);
              $b = $bobotObj->hak;
              $bobotObj->insert4($b, $baris['fld_criteria_id'], $user);
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
          <th>Criteria</th>
          <?php $bobots1y = $bobotObj->readAll2($user); while ($row = $bobots1y->fetch(PDO::FETCH_ASSOC)): ?>
            <th><?=$row['fld_criteria_name'] ?></th>
          <?php endwhile; ?>
          <th class="info">Total</th>
        </tr>
      </thead>
      <tbody>
        <?php $sumRow = []; $bobots2y = $bobotObj->readAll2($user); while ($baris = $bobots2y->fetch(PDO::FETCH_ASSOC)): ?>
          <tr>
            <th class="active"><?=$baris['fld_criteria_name'] ?></th>
            <?php $jumlah = 0; $bobots3y = $bobotObj->readAll2($user); while ($kolom = $bobots3y->fetch(PDO::FETCH_ASSOC)): ?>
              <td>
              <?php
                if ($baris['fld_criteria_id'] == $kolom['fld_criteria_id']) {
                  $c = $kolom['criteria_em'] * 1;
                  echo number_format($c, 4, '.', ',');
                  $jumlah += $c;
                } else {
                  $bobotObj->readAll1($baris['fld_criteria_id'], $kolom['fld_criteria_id'], $user);
                  $c = $kolom['criteria_em'] * $bobotObj->kp;
                  echo number_format($c, 4, '.', ',');
                  $jumlah += $c;
                }
                ?>
              </td>
            <?php endwhile; ?>
            <th class="info">
              <?php
              $sumRow[$baris['fld_criteria_id']] = $jumlah;
              echo number_format($jumlah, 4, '.', ',');
              ?>
            </th>
          </tr>
        <?php endwhile;?>
      </tbody>
    </table>

    <table width="100%" class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>Criteria</th>
          <th class="info">Total</th>
          <th class="success">Priority</th>
          <th class="warning">Result</th>
        </tr>
      </thead>
      <tbody>
        <?php $total=0; $bobots1z = $bobotObj->readAll2($user); while ($row1 = $bobots1z->fetch(PDO::FETCH_ASSOC)): ?>
          <tr>
            <th class="active"><?=$row1["fld_criteria_name"]?></th>
            <th class="info"><?=number_format($sumRow[$row1["fld_criteria_id"]], 4, '.', ',')?></th>
            <th class="success"><?=number_format($row1["criteria_em"], 4, '.', ',');?></th>
            <?php $jumlah = $sumRow[$row1["fld_criteria_id"]] + $row1["criteria_em"]; ?>
            <th class="warning"><?=number_format($jumlah, 4, '.', ',');?></th>
            <?php $total += $jumlah; ?>
          </tr>
        <?php endwhile; ?>
      </tbody>
      <tfoot>
        <tr>
          <th colspan="3">Average</th>
          <th><?php $rata = $total/$count; echo number_format($rata, 4, '.', ','); ?></th>
        </tr>
      </tfoot>
    </table>

    <table width="100%" class="table table-striped table-bordered">
      <tbody>
        <tr>
          <th>N (Criteria)</th>
          <td><?=$count?></td>
        </tr>
        <tr>
          <th>Maximum Eigenvalue</th>
          <?php
          $bobotObj -> getCI($user);
          ?>
          <td><?=number_format($bobotObj->nak, 4, '.', ',');?>

        </td>
        </tr>
        <tr>
          <th>Random Consistency Index (RI)</th>
          <td><?php echo $ir = $bobotObj->getIr($count); ?></td>
        </tr>


        <tr>
          <th>Consistency Index (CI)</th>
          <td>

          <?php 
          $bobotObj -> getCI($user);
          $ci = ($bobotObj->nak - $count)/($count-1); 
          echo number_format($ci, 4, '.', ',');?>
        
        </td>
        </tr>
        <tr>
          <th>Consistency Ratio (CR)</th>
          <td><?php $cr = $ci/$ir; echo number_format($cr, 4, '.', ',');?></td>
        </tr>
      </tbody>
    </table>
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
