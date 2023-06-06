<?php 
session_start(); 
if($_SESSION['login']==='none'){
	
	echo "<script>window.open('../index.php?not_loggined=Please login!','_self')</script>";
}
else {
	?>

<html lang="en"> 
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../asset/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../asset/css/adminlte.min.css">
    <link rel="stylesheet" href="../asset/css/style.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
         <?php
           require("stu_navbar.php");
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
                 <br>
               <table class="table" id="table" style="display: none;">
                  <thead>
                    <tr>
                       
                        <div class="col-6 col-sm-6 col-md-6">
                            <div class="info-box">
                                <span class="info-box-icon bg3 elevation-1"><i class="fas fa-file-word" style="color: rgb(211, 209, 207);"></i></span>

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
                        </div> 

       
                     </tr>
                  </thead>

                  <?php
                        require("../DBconnection.php");
                        $db = Database::getInstance();
                        $con = $db->getConnection();
                        $q= "SELECT * FROM exam_bank where REQUEST_EVALUATION='accepted' and STATUS='not taken' ";
                        $result = mysqli_query($con, $q);
                        if (!$result) {
                            echo "Error: " . mysqli_error($con);
                        } else {
                            // Loop through each record
                            while ($row = mysqli_fetch_array($result)) {

                            }
                        }
                    ?>
               </table>
               <script>
                //   var table = document.getElementById('table');
               </script>
               <?php
                //    $e_exist=mysqli_num_rows($result);
                //    if($e_exist>0)
                //    {	
                //      echo "<script> 
                //      table.style.display = 'table';  
                //      </script>"; 
                //    }

               ?>
  

            </section> 



        
        </div>      
        </div>
    </div>
<script src="asset/jquery/jquery.min.js"></script>
<script src="asset/js/adminlte.js"></script>
</body>
</html>
<?php } ?>