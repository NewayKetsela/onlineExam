<?php 
session_start(); 
    $t_id=$_GET['TEACHER_ID'];
    require("../DBconnection.php");
    $db = Database::getInstance();
    $con = $db->getConnection();
    // echo '<script> alert("Question Deleted Succesfully");window.location=\'manage_exam.php\'; </script>';
	
?>
<?php
  
  ?>
  <!DOCTYPE html>
  <html lang="en">
     <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Online Examination System</title>
        <!-- Font Awesome -->
        <link rel="stylesheet" href="../bootstrap-4.6.1-dist/asset/fontawesome/css/all.min.css">
        <link rel="stylesheet" href="../bootstrap-4.6.1-dist/asset/css/adminlte.min.css">
        <link rel="stylesheet" href="../bootstrap-4.6.1-dist/asset/css/style.css">
              <style type="text/css">
                 td a.btn{
                    font-size: 0.7rem;
                 }
                 td p{
                    padding-left: 0.5rem !important;
                 }
                 th{
                    padding: 1rem !important;
                 }
                 table tr td {
                    padding: 0.3rem !important;
                    font-size: 13px;
                 }
                 .bg1{
                    background-color: rgb(160,20,79);
                 }
                 .bg2{
                    background-color: rgb(4,91,98);
                 }
                 .bg3{
                    background-color: rgb(20,83,154);
                 }
                 .bg4{
                    background-color: rgb(109,65,161);
                 }
              </style>
     </head>
     <body class="hold-transition sidebar-mini layout-fixed">
        
           <nav class="main-header navbar navbar-expand navbar-white navbar-light fixed-top" style="background-color: rgba(24,57,46);">
              <!-- Left navbar links -->
              <ul class="navbar-nav">
              <li class="nav-item">
                    <a class="nav-link"  href="#"  style="color:white;" ><label>Your Username: 
                       <?php
                       if (isset($_SESSION['login'])){
                       $username = $_SESSION['login'];
                       $role = $_SESSION['user'];
                       echo $username; 
                        }   ?>  
                        </label>
                    </a>
                 </li>
              </ul>
              <!-- Right navbar links -->
              <ul class="navbar-nav ml-auto">
                 <!-- <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt" style="color: rgb(211, 209, 207);" title="Full Screen"></i>
                    </a>
                 </li> -->
                 <li class="nav-item">
                    <a class="nav-link" href="../logout.php">
                    <i class="fas fa-power-off" style="color: rgb(211, 209, 207);" title="Logout"></i>
                    </a>
                 </li>
              </ul>
           </nav>
  
           <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: rgba(39,93,43);">
           </aside>
       
                    
        <script src="../asset/jquery/jquery.min.js"></script>
        <script src="../asset/js/adminlte.js"></script>
     </body>
  </html>