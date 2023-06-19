
<?php 
session_start(); 
if($_SESSION['login']==='none'){
	
	echo "<script>window.open('../index.php?not_loggined=Please login!','_self')</script>";
}
else {
   require("../DBconnection.php");
   $db = Database::getInstance();
   $con = $db->getConnection();
	?>

<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add course </title>
        <script src="../bootstrap-4.6.1-dist/asset/jquery/jquery.min.js"></script>
      <script src="../bootstrap-4.6.1-dist/asset/js/adminlte.js"></script>
</head>
<body>
         <?php
           require("ac_nav.php");
         ?>
<div class="content-wrapper">
         <div class="container">
         <form method='post'>
            <br><br><br>
            <h4> Add course </h4><br>
            <div class="form-group">
               <label for="f_name">Course ID</label>
               <input type="text" class="form-control" id="student_id" name="c_id" placeholder="Enter course id" required>
            </div>
               <div class="form-group">
               <label for="f_name">Course Name</label>
               <input type="text" class="form-control" id="f_name" name="c_name" placeholder="Enter course name" required>
            </div>
            <div class="form-group">
               <label for="m_name">Department Name</label>
               <input type="text" class="form-control" id="m_name" name="department_name" placeholder="Enter department name" required>
            </div>
            <div class="form-group">
               <label for="l_name">Year</label>
               <input type="number" class="form-control" id="l_name" name="year" placeholder="Enter the year" required>
            </div>
                <br>
            <button type="submit"  name="submit"  class="btn btn-primary" style="width: 23% !important;">Submit</button>
         </form>
</div>
</div>
                  
      
   </body>
</html>
<?php
if(isset($_POST['submit'])){
   $cid=$_POST['c_id'];   
   $cname=$_POST['c_name'];
   $DEPT=$_POST['department_name'];   
   $year=$_POST['year'];
   $query = "INSERT INTO course (COURSE_ID,COURSE_NAME,DEPARTMENT_NAME,YEAR)
   VALUES ('$cid','$cname','$DEPT','$year' )";
 $re = mysqli_query($con, $query);
 if (!$re) {
     echo "Error: " . mysqli_error($con);
 }
 else{
     echo "<script>alert('Course Added Successfully')</script>";
 } 
}


}
?>