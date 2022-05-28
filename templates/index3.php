<?php
include_once 'loginfunctions.php';
if (!isLoggedIn()) {
  $_SESSION['msg'] = "You must log in first";
  header('location: login.php');
}

if (isset($_SESSION['user']))  { 

    $user = $_SESSION['user']['fld_user_num'];
}



?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
   <title>EDU APP INTERFACE SELECTION : Random Forest Model</title>
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
  height: 1700px;
  background: #FFE4E1;
  padding: 50px;
  padding-top: 10px;
  margin: 50px auto;
  border-radius: 10px;
  border: 0px solid #FFEBCD;
  
}

.form-style-8{
  max-width: 800px;
  height: 1550px;
  background: #FFFAFA;
  padding: 50px;
  padding-top: 10px;
  margin: 50px auto;
  border-radius: 10px;
  border: 0px solid #FFEBCD;
  
}

div.content {
  margin-left: 0px;
  padding: 0px 16px;
  height: 1800px;
}



@media screen and (max-width: 700px) {
  .sidebar {
    width: 92%;
    height: auto;
    position: relative;
  }

a {
  float: left;
}

.form-style-9 {
    text-align: center;
    padding-top: 10px;
    height: 1800px;
    
  }

  .form-style-8 {
    text-align: center;
    margin-top: 0;
    height: 1670px;
    
  }

div.content {
  margin-left: 0;
  height: 2600px
}
}

@media screen and (max-width: 600px) {
  .form-style-9 {
    text-align: center;
    margin-top: 10px;
    height: 2500px;
    
  }

  .form-style-8 {
    text-align: center;
    margin-top: 0;
    height: 2300px;
    
  }

  div.content {
  margin-top: 10px;
  height: 2650px;
  }

  .button2 {
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
 margin-bottom: 0px;
 margin-left: 20px;
 display: block;
}

}

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
 margin-left: 20px;
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

label {
  display: inline-block;
  width: 220px;
  font-size: 17px;
  font-family: 'system-ui';
  font-weight: 500;
}

input {
  font-size: 15px;
  padding: 10px;
  background-color: #F5FFFA;
  border-radius: 5px;
}

</style>
  
</head>
<body>
  

 

<div class="content">
  
  <div class="form-style-9">
          <h2 style="text-align: center;font-size: 25px;"><b>Review AHP Ranking with Random Forest</b></h2>
           <div class="form-style-8">
          <h2 style="text-align: left;font-size: 20px;"></h2>
          
          <h3> Please enter the priority values that are calculated by the AHP method to review the ranking :</h3>

  <!-- Main Input For Receiving Query to our ML -->
  <form action="{{ url_for('predict')}}"method="post">

      <div class="form-group">
        <label for="alt1" style="text-align:left;">Digital Text</label>
        <input type="text" name="alt1" placeholder="Priority Value" style="border: none; border-bottom: 2px solid red;" required>
      </div><br>

      <div class="form-group">
        <label for="alt2" style="text-align:left;">Multimedia Presentation</label>
        <input type="text" name="alt2" placeholder="Priority Value" style="border: none; border-bottom: 2px solid red;" required>
      </div><br>

      <div class="form-group">
        <label for="alt3" style="text-align:left;">Symbol</label>
        <input type="text" name="alt3" placeholder="Priority Value" style="border: none; border-bottom: 2px solid red;" required>
      </div><br>

      <div class="form-group">
        <label for="alt4" style="text-align:left;">Navigation</label>
        <input type="text" name="alt4" placeholder="Priority Value" style="border: none; border-bottom: 2px solid red;" required>
      </div><br>

      <div class="form-group">
        <label for="alt6" style="text-align:left;">Feedback</label>
        <input type="text" name="alt6" placeholder="Priority Value" style="border: none; border-bottom: 2px solid red;" required>
      </div><br>

      <div class="form-group">
        <label for="alt8" style="text-align:left;">Digital Recording</label>
        <input type="text" name="alt8" placeholder="Priority Value" style="border: none; border-bottom: 2px solid red;" required>
      </div><br>

      <div class="form-group">
        <label for="alt9" style="text-align:left;">Quiz</label>
        <input type="text" name="alt9" placeholder="Priority Value" style="border: none; border-bottom: 2px solid red;" required>
      </div><br>

      <div class="form-group">
        <label for="alt10" style="text-align:left;">Learning Game</label>
        <input type="text" name="alt10" placeholder="Priority Value" style="border: none; border-bottom: 2px solid red;" required>
      </div><br>

      <div class="form-group">
        <label for="alt11" style="text-align:left;">Assessment Training</label>
        <input type="text" name="alt11" placeholder="Priority Value" style="border: none; border-bottom: 2px solid red;" required>
      </div><br>

      <div class="form-group">
        <label for="alt12" style="text-align:left;">Active-Close Button</label>
        <input type="text" name="alt12" placeholder="Priority Value" style="border: none; border-bottom: 2px solid red;" required>
      </div><br>

      <div class="form-group">
        <label for="alt13" style="text-align:left;">Interface Technology</label>
        <input type="text" name="alt13" placeholder="Priority Value" style="border: none; border-bottom: 2px solid red;" required>
      </div><br>


      <div class="form-group">
        <label for="alt15" style="text-align:left;">Level of Knowledge</label>
        <input type="text" name="alt15" placeholder="Priority Value" style="border: none; border-bottom: 2px solid red;" required>
      </div><br>

      <div class="form-group">
        <label for="alt16" style="text-align:left;">Geometric Objects</label>
        <input type="text" name="alt16" placeholder="Priority Value" style="border: none; border-bottom: 2px solid red;" required>
      </div><br>

      <div class="form-group">
        <label for="alt17" style="text-align:left;">Art</label>
        <input type="text" name="alt17" placeholder="Priority Value" style="border: none; border-bottom: 2px solid red;" required>
      </div><br>

      <div class="form-group">
        <label for="alt18" style="text-align:left;">Movement of Physical Object</label>
        <input type="text" name="alt18" placeholder="Priority Value" style="border: none; border-bottom: 2px solid red;" required>
      </div><br>

      <div class="form-group">
        <label for="alt19" style="text-align:left;">Movement of Geometric Object</label>
        <input type="text" name="alt19" placeholder="Priority Value" style="border: none; border-bottom: 2px solid red;" required>
      </div><br>


      <div class="form-group">
        <label for="alt21" style="text-align:left;">Left-Right Panel</label>
        <input type="text" name="alt21" placeholder="Priority Value" style="border: none; border-bottom: 2px solid red;" required>
      </div><br>

      <div class="form-group">
        <label for="alt22" style="text-align:left;">Movement of Static/Dynamic Object</label>
        <input type="text" name="alt22" placeholder="Priority Value" style="border: none; border-bottom: 2px solid red;" required>
      </div><br>

      <div class="form-group">
        <label for="alt23" style="text-align:left;">Paper Form-Board</label>
        <input type="text" name="alt23" placeholder="Priority Value" style="border: none; border-bottom: 2px solid red;" required>
      </div><br>

        
        <button type="submit" class="btn">Predict</button>

        <button onclick="document.location='http://localhost/fyp/rank.php'" class="button2">Return</button>
        </form>
        
  

  <h1 style="color: #191970; font-size: 15px; margin-top: 140px; border: 5px solid #00CED1; padding: 20px">{{ prediction_text }}</h1>

   
  </div>
   
  </div>
</div>


   <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

</body>
</html>
