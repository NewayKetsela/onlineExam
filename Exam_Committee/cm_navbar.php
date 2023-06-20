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
                  <a class="nav-link"  href="#"  style="color:white;" ><label>Online Examination System 
                      </label>
                  </a>
               </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
               <li class="nav-item">
                  <a class="nav-link"  href="#"  style="color:white;" ><label>
                     <?php
                     if (isset($_SESSION['login'])){
                     $username = $_SESSION['login'];
                     $role = $_SESSION['user'];
                     echo $username; 
                      }   ?>  
                      </label>
                  </a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="../logout.php">
                  <i class="fas fa-power-off" style="color: rgb(211, 209, 207);" title="Logout"></i>
                  </a>
               </li>
            </ul>
         </nav>

         <!-- /.navbar -->
         <!-- Main Sidebar Container -->
         <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: rgba(39,93,43);">
                        <!-- Brand Logo -->
            <a href="index.php" class="brand-link animated swing">
            <img src="../bootstrap-4.6.1-dist/asset/img/logo.png" alt="DSMS Logo" width="200" style="margin-bottom: -50px;">
            </a>
            <!-- Sidebar -->
            <div class="sidebar">
               <!-- Sidebar Menu -->
               <nav class="mt-2">
                  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                     <li class="nav-item">
                        <a href="index.php" class="nav-link">
                           <i class="nav-icon fa fa-tachometer-alt"></i>
                           <p>
                              Home
                           </p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="Evaluate_exam.php" class="nav-link">
                           <i class="nav-icon far fa-file-word"></i>
                           <p>
                           Evaluate Exam
                           </p>
                        </a>
                     </li>
                     
                     <li class="nav-item">
                        <a href="update_acc_committee.php" class="nav-link">
                           <i class="nav-icon fa fa-poll"></i>
                           <p>
                           Update Account
                           </p>
                        </a>
                     </li>
                  </ul>
               </nav>
               <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
         </aside>
     
                  

   </body>
</html>