<?php
include_once 'loginfunctions.php';
if (!isLoggedIn()) {
  $_SESSION['msg'] = "You must log in first";
  header('location: index.php');
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
  height: 1050px;
  background: #FFE4E1;
  padding: 50px;
  padding-top: 10px;
  margin: 50px auto;
  border-radius: 10px;
  border: 0px solid #FFEBCD;
  
}

.form-style-8{
  max-width: 800px;
  height: 900px;
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
  height: 1200px;

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

ol {
  margin-top: 20px;
  font-weight: bold;
  font-size: 15px;
}

</style>
  
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
  
  <div class="form-style-9">
          <h2 style="text-align: center;font-size: 25px;"><b>Alternative</b></h2>
          <div class="form-style-8">

             <h2 style="font-size: 18px; margin-left: 10px;margin-bottom: 5px;"><b>Recommended Data: </b></h2>


          <ol>
            <li>Universal Design
              <ul>
                <li>Representation</li>
                  <ul>
                  <li>Digital Text</li>
                  <li>Multimedia Presentation</li>
                  <li>Symbol</li>
                  <li>Navigation</li>
                  <li>Feedback</li>
                  </ul>

                <li>Action and Expression</li>
                  <ul>
                    <li>Digital Recording</li>
                    <li>Quiz</li>
                  </ul>
                <li>Engagement</li>
                <ul>
                  <li>Learning Game</li>
                  <li>Assessment Training</li>
                </ul>
              </ul>
            </li>
            <br>
            <li>Innovation</li>
              <ul>
                <li>Compatibility</li>
                  <ul>
                    <li>Active-Close Button</li>
                    <li>Interface Technology</li>
                  </ul>
                <li>Complexity</li>
                  <ul>
                    <li>Level of Knowledge</li>
                  </ul>
              </ul>
              <br>
            <li>Intelligence</li>
              <ul>
                <li>Spatial-Orientation</li>
                  <ul>
                    <li>Geometric Objects</li>
                    <li>Art</li>
                    <li>Movement of Physical Object</li>
                  </ul>
                <li>Spatial-Relation</li>
                  <ul>
                    <li>Movement of Geometric Object</li>
                    <li>Left-Right Panel</li>
                    <li>Movement of Static/Dynamic Object</li>
                  </ul>
                <li>Spatial-Visualization</li>
                  <ul>
                    <li>Paper Form-Board</li>
                  </ul>
              </ul>
          </ol>


          <hr style="border-top: 5px solid black;">
          <a href="alternative_data.php" class="button">Evaluate</a>
   
  </div>
   
  </div>
</div>


   <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

</body>
</html>
