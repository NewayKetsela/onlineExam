<?php 
session_start(); 
    $q_id=$_GET['QUESTION_ID'];
	// Establish Connection with MYSQL
    require("../DBconnection.php");
    $db = Database::getInstance();
    $con = $db->getConnection();

    $sql = "delete from question where QUESTION_ID='".$q_id."' ";
    mysqli_query ($con,$sql); 
    mysqli_close ($con);
    echo '<script> alert("Question Deleted Succesfully");window.location=\'manage_exam.php\'; </script>';
	
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

</div>
</body>
</html>
