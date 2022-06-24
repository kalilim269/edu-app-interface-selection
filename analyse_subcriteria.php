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
include_once('includes/subcriteria.inc.php');
include_once('includes/subbobot.inc.php');
include_once('includes/criteria.inc.php');
//include_once 'store_subcri.php';

if (isset($_SESSION['criteria_id']))  { 

    $cri_id = $_SESSION['criteria_id'];
}


$subbobotObj = new Subbobot($db);
$criteriaObj = new Criteria($db);
$count = $subbobotObj->countAll($user, $cri_id);
//$cri_id = $_SESSION['cri_id'];

if(isset($_POST['submit'])){
  //$cri_id = $_POST['criteria_id'];
  
  $subcriteriaObj = new Subcriteria($db);
  $subcriteriaCount = $subcriteriaObj->countAll($user);
  $subcriteriaCount2 = $subcriteriaObj->countAll2($user, $cri_id);
  $subcriteriaCount3 = $subcriteriaObj->countAll2($user, 'C1');
  //print_r($cri_id);

  $r = [];
  $subcriterias = $subcriteriaObj->readAll($user);
  while ($row = $subcriterias->fetch(PDO::FETCH_ASSOC)) {
    $subcriteriass = $subcriteriaObj->readSatu($row['fld_subcriteria_id'], $user, $cri_id);
    //$subcriteriaObj->insert($user, $row['fld_subcriteria_id'], $row['fld_subcriteria_name'], 'C1');
    while ($roww = $subcriteriass->fetch(PDO::FETCH_ASSOC)) {

  if ($row['fld_criteria_id'] == 'C1'){

    $pcs = explode("S", $roww['fld_subcriteria_id']);
    $c = $subcriteriaCount2 - $pcs[1];
    
  }
  elseif ($row['fld_criteria_id'] == 'C2' && $subcriteriaCount3 == 2) {

    $v = explode("C", $_SESSION['criteria_id']);

    $b = "C".$v[1]-1;
    $subcriteriaCount = $subcriteriaObj->countAll2($user, $b);
    //print_r($subcriteriaCount);

    $val = explode("S", $roww['fld_subcriteria_id']);
    
    $a = $val[1] - $subcriteriaCount; 
    $c = $subcriteriaCount - $a;
    //print_r($c);
  }

  else {

    $v = explode("C", $_SESSION['criteria_id']);
    $e=0;

    for ($i=1; $i<=$v[1]-1; $i++){
      
      $b = "C".$v[1]-$i;
      $subcriteriaCount1 = $subcriteriaObj->countAll2($user, $b);
      $e+=$subcriteriaCount1;
  }
  
    $val = explode("S", $roww['fld_subcriteria_id']);
  
    $a = $val[1] - $e; 
    $c = $subcriteriaCount2 - $a;
    //print_r($subcriteriaCount2);
  }  
    
    if ($c>=1) {
      $r[$row['fld_subcriteria_id']] = $c;
    }
  }
}

  $no=1;
  foreach ($r as $k => $v) {
    for ($i=1; $i<=$v; $i++) {
      $pcs = explode("S", $k);
      $nid = "S".($pcs[1]+$i);

      if ($subbobotObj->insert($_POST[$k.$no], $_POST['nl'.$no], $_POST[$nid.$no], $user, $cri_id)) {
        // ...
      } else {
        $subbobotObj->update($_POST[$k.$no], $_POST['nl'.$no], $_POST[$nid.$no], $user, $cri_id);
      }

      if ($subbobotObj->insert($_POST[$nid.$no], 1/$_POST['nl'.$no], $_POST[$k.$no], $user, $cri_id)) {
        // ...
      } else {
        $subbobotObj->update($_POST[$nid.$no], 1/$_POST['nl'.$no], $_POST[$k.$no], $user, $cri_id);
      }
      $no++;
    }
  }
}
if (isset($_POST['delete'])) {
  $subbobotObj->delete($user ,$cri_id);
  //$subbobotObj->delete2($user);
  header("location: evaluate_subcriteria.php");
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
  height: 1400px;
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
  height: 1500px;
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
 float: left;
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
  input[type=submit] {
  background-color: #FF8C00;
  border: none;
  color: white;
  padding: 8px 20px;
  text-decoration: none;
  margin: 4px 2px;
  cursor: pointer;
  border-radius:8px ;
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

<script type="text/javascript">
  if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

  
</head>
<body>
  <?php include_once 'navi_bar.php'; ?>

    <div class="alert info">
  <span class="closebtn">&times;</span>  
  <strong>Info! Please take note!</strong><br> Please remember to click on the "Delete All Data" button if you wished to do another evaluation. Otherwise, if you procced to evaluate without deleting the previous data, then the calculation returned will not be accurate.
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
  <div class="col-xs-12 col-sm-12 col-md-12">
    <div class="row">
  <div class="form-style-9">
  

     <ol class="breadcrumb" style="background-color: #F0FFFF;">
      <li><a href="subcriteria.php">Sub-Criteria</a></li>
      <li><a href="subcriteria_data.php">Sub-Criteria Data</a></li>
      <li><a href="evaluate_subcriteria.php">Evaluate Sub-Criteria</a></li>
      <li class="active">Sub-Criteria Evaluation Table</li>
    </ol>

   
    <p style="margin-bottom:10px;">
      <strong style="font-size:18pt;"><span class="fa fa-bomb"></span> Pairwise Comparison Result for Sub-Criteria</strong>
    </p>

    <form method="post" action="store_subcri.php">
          <div class="form-group">
            <label for="subcriteria">Choose Criteria</label>
              <select class="form-control" name="criteria_id" id="criteria_id">
                  <?php $rows = $criteriaObj->readAll($user); while ($row = $rows->fetch(PDO::FETCH_ASSOC)): ?>
                      <option value="<?=$row['fld_criteria_id']?>"><?=$row['fld_criteria_id']?> - <?=$row['fld_criteria_name']?></option>
                      
                  <?php endwhile; ?>

              </select>
          </div>
          <input type="submit" value="Select" name="criteria">

       </form>
       <br><br>
    <div>
        <form method="post">
          <button name="delete" class="btn btn-danger" style="float:right; margin-bottom: 15px;" onclick="return confirm('Are you sure? All evaluation data will be deleted from the database.')">Delete All Data</button>
        </form>
    </div>

    <table width="100%" class="table table-striped table-bordered">
      <thead>
        <tr>
          
          <th>Sub-Criteria</th>
          <?php $subbobots1 = $subbobotObj->readAll2($user, $cri_id); while ($row = $subbobots1->fetch(PDO::FETCH_ASSOC)): ?>
            <th><?=$row['fld_subcriteria_name'] ?></th>
          <?php endwhile; ?>
        </tr>
      </thead>
      <tbody>
        <?php $subbobots2 = $subbobotObj->readAll2($user, $cri_id); while ($baris = $subbobots2->fetch(PDO::FETCH_ASSOC)): ?>
          <tr>
            <th class="active"><?=$baris['fld_subcriteria_name'] ?></th>
            <?php $subbobots3 = $subbobotObj->readAll2($user, $cri_id); while ($kolom = $subbobots3->fetch(PDO::FETCH_ASSOC)): ?>
              <td>
                <?php
                if ($baris['fld_subcriteria_id'] == $kolom['fld_subcriteria_id']) {
                  echo '1';

                  $conn = new mysqli('localhost', 'root', '', 'a176496');
                  $sql = "SELECT * FROM tbl_eduapp_analyse_subcriteria WHERE user_id=$user AND fld_criteria_id='$cri_id'";
                  //$sql2 = "SELECT * FROM tbl_eduapp_analyse_subcriteria WHERE user_id=$user ";
                  if ($result=mysqli_query($conn,$sql)) {
                    $rowcount=mysqli_num_rows($result);
                    $row=$count*$count;
                    //echo "The total number of rows are: ".$row; 
                    //print_r($cri_id);

                  }

                if (!isset($_POST['delete'])){

                  if ($rowcount<$row){

                  if ($subbobotObj->insert($baris['fld_subcriteria_id'], '1', $kolom['fld_subcriteria_id'], $user, $cri_id)) {
                    // ...
                  } else {
                    $subbobotObj->update($baris['fld_subcriteria_id'], '1', $kolom['fld_subcriteria_id'], $user, $cri_id);
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
          <?php $stmt5 = $subbobotObj->readAll2($user, $cri_id); while ($row = $stmt5->fetch(PDO::FETCH_ASSOC)): ?>
            <th>
              <?php
                $subbobotObj->readSum1($row['fld_subcriteria_id'], $user);
                echo number_format($subbobotObj->nak, 4, '.', ',');
                $subbobotObj->insert3($subbobotObj->nak, $row['fld_subcriteria_id'], $user);
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
          <?php $subbobots1x = $subbobotObj->readAll2($user, $cri_id); while ($row2x = $subbobots1x->fetch(PDO::FETCH_ASSOC)): ?>
            <th><?=$row2x['fld_subcriteria_name'] ?></th>
          <?php endwhile; ?>
          <th class="info">Total</th>
          <th class="success">Local Priority</th>
          <th style="background-color:#FFD700">Criteria Priority</th>
        </tr>
      </thead>
      <tbody>
        <?php $subbobots2x = $subbobotObj->readAll2($user, $cri_id); while ($baris = $subbobots2x->fetch(PDO::FETCH_ASSOC)): ?>
          <tr>
            <th class="active"><?=$baris['fld_subcriteria_name'] ?></th>
            <?php $stmt4x = $subbobotObj->readAll2($user, $cri_id); while ($kolom = $stmt4x->fetch(PDO::FETCH_ASSOC)): ?>
              <td>
              <?php
                if ($baris['fld_subcriteria_id'] == $kolom['fld_subcriteria_id']) {
                  $c = 1/$kolom['fld_subcriteria_total'];
                  $subbobotObj->insert2($c, $baris['fld_subcriteria_id'], $kolom['fld_subcriteria_id'], $user);
                  echo number_format($c, 4, '.', ',');
                } else {
                  $subbobotObj->readAll1($baris['fld_subcriteria_id'], $kolom['fld_subcriteria_id'], $user);
                  $c = $subbobotObj->kp/$kolom['fld_subcriteria_total'];
                  $subbobotObj->insert2($c, $baris['fld_subcriteria_id'], $kolom['fld_subcriteria_id'], $user);
                  echo number_format($c, 4, '.', ',');
                }
                ?>
              </td>
            <?php endwhile; ?>
            <th class="info">
              <?php
              $subbobotObj->readSum2($baris['fld_subcriteria_id'], $user);
              $j = $subbobotObj->hak;
              echo number_format($j, 4, '.', ',');
              ?>
            </th>
            <th class="success">
              <?php
              $subbobotObj->readAvg($baris['fld_subcriteria_id'], $user);
              $b = $subbobotObj->hak;
              $subbobotObj->insert4($b, $baris['fld_subcriteria_id'], $user);
              echo number_format($b, 4, '.', ',');
              ?>
            </th>

            <th style="background-color:#FFD700">
              <?php
              //<?php $bobots1y = $criteriaObj->readCriteria("C1"); while ($row = $bobots1y->fetch(PDO::FETCH_ASSOC)): 
              $conn = new mysqli('localhost', 'root', '', 'a176496');
                  $sql = "SELECT criteria_em FROM tbl_eduapp_criteria_data WHERE fld_criteria_id='$cri_id' AND user_id=$user";
                  $result=mysqli_query($conn,$sql)
                ?>
                <?php  
                while($rows=$result->fetch_assoc())
                {
             ?>
              
            <?php echo number_format($rows['criteria_em'], 4, '.', ',');?>
              <?php }
          
              ?>
            </th>

          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>

    <table width="100%" class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>Sub-Criteria</th>
          <?php $subbobots1y = $subbobotObj->readAll2($user, $cri_id); while ($row = $subbobots1y->fetch(PDO::FETCH_ASSOC)): ?>
            <th><?=$row['fld_subcriteria_name'] ?></th>
          <?php endwhile; ?>
          <th class="info">Total</th>
        </tr>
      </thead>
      <tbody>
        <?php $sumRow = []; $subbobots2y = $subbobotObj->readAll2($user, $cri_id); while ($baris = $subbobots2y->fetch(PDO::FETCH_ASSOC)): ?>
          <tr>
            <th class="active"><?=$baris['fld_subcriteria_name'] ?></th>
            <?php $jumlah = 0; $subbobots3y = $subbobotObj->readAll2($user, $cri_id); while ($kolom = $subbobots3y->fetch(PDO::FETCH_ASSOC)): ?>
              <td>
              <?php
                if ($baris['fld_subcriteria_id'] == $kolom['fld_subcriteria_id']) {
                  $c = $kolom['subcriteria_em'] * 1;
                  echo number_format($c, 4, '.', ',');
                  $jumlah += $c;
                } else {
                  $subbobotObj->readAll1($baris['fld_subcriteria_id'], $kolom['fld_subcriteria_id'], $user);
                  $c = $kolom['subcriteria_em'] * $subbobotObj->kp;
                  echo number_format($c, 4, '.', ',');
                  $jumlah += $c;
                }
                ?>
              </td>
            <?php endwhile; ?>
            <th class="info">
              <?php
              $sumRow[$baris['fld_subcriteria_id']] = $jumlah;
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
          <th>Consistency Ratio</th>
          <th class="info">Total</th>
          <th class="success">Global Priority</th>
          <th class="warning">Result</th>
        </tr>
      </thead>
      <tbody>
        <?php $total=0; $subbobots1z = $subbobotObj->readAll2($user, $cri_id); while ($row1 = $subbobots1z->fetch(PDO::FETCH_ASSOC)): ?>
          <tr>
            <th class="active"><?=$row1["fld_subcriteria_name"]?></th>
            <th class="info"><?=number_format($sumRow[$row1["fld_subcriteria_id"]], 4, '.', ',')?></th>
            <th class="success">
              <?php
              $subbobotObj->getsubGlobal($row1['fld_subcriteria_id'], $user);
              $m = $subbobotObj->hak;
              $subbobotObj->insert5($m, $row1['fld_subcriteria_id'], $user);
              echo number_format($m, 4, '.', ',');
              ?>

            </th>
            <?php $jumlah = $sumRow[$row1["fld_subcriteria_id"]] + $row1["subcriteria_em"]; ?>
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
          <th>N (Sub-Criteria)</th>
          <td><?=$count?></td>
        </tr>
        <tr>
          <th>Maximum Eigenvalue</th>
          <?php
          $subbobotObj -> getCI($user,$cri_id);
          ?>
          <td><?=number_format($subbobotObj->nak, 4, '.', ',');?></td>
        </tr>
        <tr>
          <th>Random Consistency Index (RI)</th>
          <td><?php echo $ir = $subbobotObj->getIr($count); ?></td>
        </tr>
        <tr>
          <th>Consistency Index (CI)</th>
          <td><?php $ci = ($subbobotObj->nak-$count)/($count-1); echo number_format($ci, 4, '.', ',');?></td>
        </tr>
        <tr>
          <th>Consistency Ratio (CR)</th>
          <td><?php if ($ir != 0){$cr = $ci/$ir; echo number_format($cr, 4, '.', ',');} else {echo '0';}?></td>
        </tr>
      </tbody>
    </table>

    <a href="evaluate_subcriteria.php" class="button">Return</a>
</div>


          
        
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
