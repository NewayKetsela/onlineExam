
<?php 
session_start(); 
if($_SESSION['login']==='none'){
	
	echo "<script>window.open('../index.php?not_loggined=Please login!','_self')</script>";
}
else {
   require("../DBconnection.php");
   $db = Database::getInstance();
   $con = $db->getConnection();
   $e_id=$_GET['STUDENT_ID'];
	?>

<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>edit student </title>
</head>
<body>
         <?php
           require("ad_nav.php");
         ?>
<div class="content-wrapper">
         <div class="container">
<br><br>
         <?php
            $query = "select * from student where STUDENT_ID='".$e_id."'";
            $result = mysqli_query($con, $query);
            // Loop through each records 
            while($row = mysqli_fetch_array($result))
            {
                $e_id= $row['STUDENT_ID'];
                $f_name = $row['F_NAME'];
                $m_name = $row['M_NAME'];
                $l_name = $row['L_NAME'];
                $gen = $row['GENDER'];
                $year = $row['YEAR'];
                $dept = $row['DEPARTMENT_NAME'];
                $status = $row['STATUS'];
                    
            }
            ?>
         <form method='post'>
            <br>
            <h4> Edit a student </h4><br>
            <div class="form-group">
               <label for="f_name">Student ID</label>
               <input type="text" class="form-control" id="student_id" name="student_id" value="<?php echo $e_id; ?>" placeholder="Enter student id" required>
            </div>
               <div class="form-group">
               <label for="f_name">First Name</label>
               <input type="text" class="form-control" id="f_name" name="f_name" value="<?php echo $f_name; ?>" placeholder="Enter First name" required>
            </div>
            <div class="form-group">
               <label for="m_name">Middle Name</label>
               <input type="text" class="form-control" id="m_name" name="m_name" value="<?php echo $m_name; ?>" placeholder="Enter Middle name" required>
            </div>
            <div class="form-group">
               <label for="l_name">Last Name</label> 
               <input type="text" class="form-control" id="l_name" name="l_name" value="<?php echo $l_name; ?>" placeholder="Enter Last name" required>
            </div>
            <div class="form-group">
                 <label for="l_name">Gender</label>
                 <input type="text" class="form-control" id="gender" name="gender" name="gender" value="<?php echo $gen; ?>" placeholder="Enter gender">
              </div>
            <div class="form-group">
               <label for="l_name">Department Name</label>
               <input type="text" class="form-control" id="department_name" name="department_name" value="<?php echo $dept; ?>" placeholder="Enter department" required>
            </div>
            <div class="form-group">
               <label for="l_name">Year</label>
               <input type="number" class="form-control" id="year" name="year" placeholder="Enter year" value="<?php echo $year; ?>" required>
            </div>
            <div class="form-group">
               <label for="l_name">STATUS</label>
               <select class="form-control" id="questionType" name="questionType">
                        <option value="acc" selected>active</option>
                        <option value="inacc">in active</option>
                  </select>
            </div><br>
            <button type="submit"  name="submit"  class="btn btn-primary" style="width: 23% !important;">Submit</button>
         </form>
</div>
</div>
                  
      <script src="../bootstrap-4.6.1-dist/asset/jquery/jquery.min.js"></script>
      <script src="../bootstrap-4.6.1-dist/asset/js/adminlte.js"></script>
   </body>
</html>
<?php
if(isset($_POST['submit'])){
   $cid=$_POST['student_id'];   
   $fname=$_POST['f_name'];
   $mname=$_POST['m_name'];
   $lname=$_POST['l_name'];
   $DEPT=$_POST['department_name'];   
   $year=$_POST['year'];
   $gender = $_POST['gender'];
   $status = $_POST['questionType'];
   if($status=='acc'){
      $status='active';
   }
   else{
     $status='in active' ;
   }
$query10 = "Update student set STUDENT_ID='$cid',F_NAME='$fname',M_NAME='$mname',L_NAME='$lname',GENDER='$gender',YEAR='$year',DEPARTMENT_NAME='$DEPT',STATUS='$status' where STUDENT_ID='$e_id' " ;
                        $resultTF = mysqli_query($con, $query10);
                        if (!$resultTF) {
                            echo "Error: " . mysqli_error($con);
                        } else {
                            echo '<script>alert("Student Account Updated Succesfully");
                                window.location=\'edit_stu.php\'; </script>';
                        }
                    }


}
?>