
<?php 
session_start(); 
if($_SESSION['login']==='none'){
	
	echo "<script>window.open('../index.php?not_loggined=Please login!','_self')</script>";
}
else {
   require("../DBconnection.php");
   $db = Database::getInstance();
   $con = $db->getConnection();
   $e_id=$_GET['COURSE_ID'];
	?>

<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>edit course </title>
    <script src="../bootstrap-4.6.1-dist/asset/jquery/jquery.min.js"></script>
      <script src="../bootstrap-4.6.1-dist/asset/js/adminlte.js"></script>
</head>
<body>
         <?php
           require("ac_nav.php");
         ?>
<div class="content-wrapper">
         <div class="container">
<br><br>
         <?php
            $query = "select * from course where COURSE_ID='".$e_id."'";
            $result = mysqli_query($con, $query);
            // Loop through each records 
            while($row = mysqli_fetch_array($result))
            {
                $e_id= $row['COURSE_ID'];
                $f_name = $row['COURSE_NAME'];
                $year = $row['YEAR'];
                $dept = $row['DEPARTMENT_NAME'];
                    
            }
            ?>
         <form method='post'>
            <br> 
            <h4> Edit course </h4><br>
            <div class="form-group">
               <label for="f_name">Course ID</label>
               <input type="text" class="form-control" id="student_id" name="ct_id" value="<?php echo $e_id; ?>" placeholder="Enter course id" required>
            </div>
               <div class="form-group">
               <label for="f_name">Course Name</label>
               <input type="text" class="form-control" id="f_name" name="c_name" value="<?php echo $f_name; ?>" placeholder="Enter course name" required>
            </div>
            <div class="form-group">
               <label for="l_name">Department Name</label>
               <input type="text" class="form-control" id="department_name" name="department_name" value="<?php echo $dept; ?>" placeholder="Enter department name" required>
            </div>
            <div class="form-group">
               <label for="l_name">Year</label>
               <input type="number" class="form-control" id="year" name="year" placeholder="Enter the year" value="<?php echo $year; ?>" style="width: 100%; !important" required>
            </div><br>
            <button type="submit"  name="submit"  class="btn btn-primary" style="width: 23% !important;">Submit</button>
         </form>
</div>
</div>
                  
      
   </body>
</html>
<?php
if(isset($_POST['submit'])){
   $cid=$_POST['ct_id'];   
   $cname=$_POST['c_name'];
   $DEPT=$_POST['department_name'];   
   $year=$_POST['year'];
   $query10 = "Update course set COURSE_ID='$cid',COURSE_NAME='$cname',DEPARTMENT_NAME='$DEPT',YEAR='$year' where COURSE_ID='$e_id' " ;
                        $resultTF = mysqli_query($con, $query10);
                        if (!$resultTF) {
                            echo "Error: " . mysqli_error($con);
                        } else {
                            echo '<script>alert("Course Updated Succesfully");
                                window.location=\'edit_course.php\'; </script>';
                        }
                    }


}
?>