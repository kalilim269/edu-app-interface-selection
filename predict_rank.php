<?php
include_once 'loginfunctions.php';
if (!isLoggedIn()) {
  $_SESSION['msg'] = "You must log in first";
  header('location: index.php');
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
       <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" ></script>

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
  padding-top: 10px;
  margin: 50px auto;
  border-radius: 10px;
  border: 0px solid #FFEBCD;
  
}

.form-style-8{
  max-width: 800px;
  height: 1250px;
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

  .button22 {
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
 margin-top: -90px;
 margin-left: 20px;

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
 float: left;
 margin-top: -90px;
 margin-left: 20px;
}

.button:hover {
 background-color: #000000;
 box-shadow: 0px 15px 20px rgba(46, 229, 157, 0.4);
 color: #fff;
 transform: translateY(-7px);
}

.button2:hover {
 background-color: #000000;
 box-shadow: 0px 15px 20px rgba(46, 229, 157, 0.4);
 color: #fff;
 transform: translateY(-7px);
}

.button:active {
 transform: translateY(-1px);
}

.button2:active {
 transform: translateY(-1px);
}

label {
  display: inline-block;
  width: 500px;
  font-size: 17px;
  font-family: 'system-ui';
  font-weight: 500;
}

input {
  font-size: 15px;
  margin-left: 10px;
  padding: 8px;
  background-color: #F5FFFA;
  border-radius: 5px;
  border: 1px solid;
}

select {
  font-size: 15px;
  margin-left: 10px;
  width: 150px;
  padding: 8px;
  background-color: #F8F8FF;
  border-radius: 5px;
}

</style>

   
    <script type="text/javascript">
        //when the webpage has loaded do this
        $(document).ready(function() {  
            //if the value within the dropdown box has changed then run this code            
            $('#num_alt').change(function(){
                //get the number of fields required from the dropdown box
                var num = $('#num_alt').val();
                

                $("#nt").text(num);     

                var i = 0; //integer variable for 'for' loop
                var html = ''; //string variable for html code for fields 
                //loop through to add the number of fields specified
                for (i=1;i<=num;i++) {
                    //concatinate number of fields to a variable
                    html += 'Alternative ' + i + ': <input type="text" required name="alt-' + i + '"/><br/><br/>'; 
                }
               

                //insert this html code into the div with id catList
                $('#altList').html(html);
            });
        }); 


    </script>
   
  
</head>
<body>
  

 <?php include_once 'navi_bar.php'; ?>

  <div class="sidebar">
  <a href="criteria.php"><b>Criteria</b></a>
  <a href="subcriteria.php"><b>Sub-Criteria</b></a>
  <a href="alternative.php"><b>Alternative</b></a>
  <a href="method.php"><b>AHP Method</b></a>
  <a class="active" href="rank.php"><b>Random Forest Model</b></a>
  <a href="report.php"><b>Summary Report</b></a>
  <a href="save.php"><b>Save Project</b></a>
</div>

<div class="content">
  
  <div class="form-style-9">
          <h2 style="text-align: center;font-size: 25px;"><b>Review AHP Ranking with Random Forest</b></h2>
           <div class="form-style-8">
          <h2 style="text-align: left;font-size: 20px;"></h2>
          
          <h3 style="font-size:20px;"> Please enter the priority values that are calculated by the AHP method (Eigenvalue) to review the ranking :</h3>
          <br>
  <!-- Main Input For Receiving Query to our ML -->
  <form action="predict_rank.php" method="post">

   <!-- <form method="post" action="action.php">-->
        <label>Number of Alternative to be Review: 
        <select id="num_alt" name="num_alt">

            <option value="0"> SELECT </option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
            <option value="13">13</option>
            <option value="14">14</option>
            <option value="15">15</option>

        </select></label> 
        <br><br>

    <div id="altList"></div>
       

     <h4 style="color:red;"><b>*This system can only review a total of 15 alternative value, if you have more than 15 alternative, please select the top 15 to be reviewed.<b></h4>

      

        
        <button type="submit" class="button">Predict</button>

        </form>

        <a href="rank.php" class="button2" >Return</a>
        
        
  

  <h1 style="color: #191970; font-size: 18px; margin-top: 140px; border: 5px solid #00CED1; padding: 20px">The ranking that was predicted through the Random Forest model are as followed :<br><br> 

 <?php 
 if (isset($_POST['alt-1'])){
 	
    $a=$_POST['num_alt'];
  
  	for ($i=1;$i<=$a;$i++) {
    //concatinate number of fields to a variable
    
    	$user = $_POST['alt-'.$i];
    	system("python rfmodel.py $user");
  	}
       
 }
 ?></h1>

   
  </div>
   
  </div>
</div>


   <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

</body>
</html>
