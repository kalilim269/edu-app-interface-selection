

<style type="text/css">
.navbar-nav a{
  color: black !important;
}
.dropdown-menu a{
  color: black !important;
}
.navbar-header a{
  color: black !important;
}
.navbar-collapse a{
  color: #2f4f4f !important;
}
.dropdown-menu {
  background-color: #ffb6c1;
}
.navbar-collapse li a:hover{
  background-color: #F08080;
}

.dropdown-menu li a:hover{
  background-color: #FFF0F5;
}
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: #ffb6c1; color: black; font-family: 'Gill Sans', 'Lucida Sans Unicode',sans-serif;">

  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false" style="background-color: #FFE4E1;">
        <span class="sr-only">Toggle navigation</span>
         <span class="glyphicon glyphicon-menu-hamburger"></span>
        

      </button>
      <a class="navbar-brand" href="index.php"><b>EDU APP INTERFACE SELECTION</b></a>
    </div>
 
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
   
    <!-- KIV
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><b>Menu</b> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#" ><b>Criteria</b></a></li>      
            <li><a href="#"><b>Sub-Criteria</b></a></li>
            <li><a href="#"><b>Alternative</b></a></li>
            <li><a href="#"><b>AHP Method</b></a></li>
            <li><a href="#"><b>Ranking SVM</b></a></li>
            <li><a href="#"><b>Summary Report</b></a></li>
            <li><a href="#"><b>Save Project</b></a></li>
            
          </ul>
        </li>
      </ul>
    -->
    <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span>
        <?php  if (isset($_SESSION['user'])) : ?>
          <strong><?php echo $_SESSION['user']['fld_user_name']; ?></strong>

          <!--<small>
            <i  style="color: #00008b;"><b>(<?php //echo ucfirst($_SESSION['user']['fld_staff_user_level']); ?>)</b></i> 
          </small>
        -->

        <?php endif ?>
     
           </a>
          <ul class="dropdown-menu">
            <li><a href="index.php?logout='1'" style="color: black;"><span class="glyphicon glyphicon-log-out"></span>&nbsp; <b>Log Out</b></a></li>      
            
          </ul>
        </li>
      </ul>
    
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><b>About</b></a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="project_list.php"><b>Project</b></a></li>
    </ul>
     <ul class="nav navbar-nav navbar-right">
      <li><a href="index.php"><b>Home</b></a></li>
    </ul>
    
      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

