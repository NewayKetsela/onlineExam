<?php 
session_start(); 
if($_SESSION['login']==='none'){
	
	echo "<script>window.open('../index.php?not_loggined=Please login!','_self')</script>";
}
else {
	?>

<html lang="en">
      <?php
         require("head.html");
      ?>
   <body class="hold-transition sidebar-mini layout-fixed">
      <div class="wrapper">
         <?php
           require("sidebar.php");
         ?>
      
         <div class="content-wrapper">
         <br><br><br>
               <!-- Main content -->
            <div class="container">
            <section class="content">  
                        <br<br>
                  <div class="info-box">
                     <span class="info-box-icon bg2 elevation-1"><i class="fas fa-user" style="color: rgb(211, 209, 207);"></i></span>

                        <div class="info-box-content">
                           <span class="info-box-text">Welcome</span>
                           <span class="info-box-number">
                              <?php if (isset($_SESSION['login'])){
                                 $username = $_SESSION['login'];
                                 $role = $_SESSION['user'];
                                 echo $username; 
                              }   ?> 
                           </span>
                        </div>
                 </div>
            </section> 
            </div>      
         </div>
      </div>
      <script src="../bootstrap-4.6.1-dist/asset/jquery/jquery.min.js"></script>
      <script src="../bootstrap-4.6.1-dist/asset/js/adminlte.js"></script>
   </body>
</html>
<?php } ?>