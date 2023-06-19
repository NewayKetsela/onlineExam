
<?php 
session_start(); 
if($_SESSION['login']==='none'){
	
	echo "<script>window.open('../index.php?not_loggined=Please login!','_self')</script>";
}
else {
   require("../DBconnection.php");
   $db = Database::getInstance();
   $con = $db->getConnection();
   $e_id=$_GET['TEACHER_ID'];
	?>

<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>edit teacher </title>
</head>
<body>
         <?php
           require("ad_nav.php");
         ?>
<div class="content-wrapper">
         <div class="container">
<br><br>
         <?php
            $query = "select * from teacher where TEACHER_ID='".$e_id."'";
            $result = mysqli_query($con, $query);
            // Loop through each records 
            while($row = mysqli_fetch_array($result))
            {
                $e_id= $row['TEACHER_ID'];
                $f_name = $row['F_NAME'];
                $m_name = $row['M_NAME'];
                $l_name = $row['L_NAME'];
                $gen = $row['GENDER'];
                $CID = $row['COURSE_ID'];
                $status = $row['STATUS'];
                    
            }
            ?>
         <form method='post'>
            <br>
            <h4> Edit teacher </h4><br>
            <div class="form-group">
                  <div class="form-group">
                    <label for="l_name">Teacher ID</label>
                    <input type="text" class="form-control" id="specialization" name="teacher_id" value="<?php echo $e_id; ?>" placeholder="Enter teacher id" required>
                 </div>

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
                 <input type="text" class="form-control" id="gender"  name="gender" value="<?php echo $gen; ?>" placeholder="Enter gender" required>
              </div>
              <div class="form-group">
                 <label for="l_name">Course ID</label>
                 <input type="text" class="form-control" id="gender" name="c_idd" value="<?php echo $CID; ?>" placeholder="Enter gender" required>
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
   $cid=$_POST['teacher_id'];   
   $fname=$_POST['f_name'];
   $mname=$_POST['m_name'];
   $lname=$_POST['l_name'];
   $course=$_POST['c_idd'];
   $gender = $_POST['gender'];
   $status = $_POST['questionType'];
   if($status=='acc'){
      $status='active';
   }
   else{
     $status='in active' ;
   }
$query10 = "Update teacher set TEACHER_ID='$cid',F_NAME='$fname',M_NAME='$mname',L_NAME='$lname',GENDER='$gender',COURSE_ID='$course',STATUS='$status' where TEACHER_ID='$e_id' " ;
                        $resultTF = mysqli_query($con, $query10);
                        if (!$resultTF) {
                            echo "Error: " . mysqli_error($con);
                        } else {
                            echo '<script>alert("Teacher Account Updated Succesfully");
                                window.location=\'edit_teacher.php\'; </script>';
                        }
                    }


}
?>