
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
        <title>Add Teacher </title>
</head>
<body>
         <?php
           require("ad_nav.php");
         ?>
<div class="content-wrapper">
         <div class="container">
         <form method='post'>
            <br><br><br>
            <h4> Add Teacher </h4><br>
               <div class="form-group">
                  <div class="form-group">
                    <label for="l_name">Teacher ID</label>
                    <input type="text" class="form-control" id="specialization" name="teacher_id" placeholder="Enter teacher id" required>
                 </div>

                 <label for="f_name">First Name</label>
                 <input type="text" class="form-control" id="f_name" name="f_name" placeholder="Enter First name" required>
              </div>
              <div class="form-group">
                 <label for="m_name">Middle Name</label>
                 <input type="text" class="form-control" id="m_name" name="m_name" placeholder="Enter Middle name" required>
              </div>
              <div class="form-group">
                 <label for="l_name">Last Name</label>
                 <input type="text" class="form-control" id="l_name" name="l_name" placeholder="Enter Last name" required>
              </div>

              <div class="form-group">
               <label for="l_name">Gender</label>
               <select class="form-control" id="questionType" name="questionType">
                        <option value="" selected>Select gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                  </select>
            </div>
              <div class="form-group">
                 <label for="l_name">Course ID</label>
                 <input type="text" class="form-control" id="assign_course_id" name="course_id" placeholder="Enter Course Id">
              </div>

              <br>
            <button type="submit"  name="submit"  class="btn btn-primary" style="width: 23% !important;">Submit</button>
           </form>
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
   $course_id=$_POST['course_id']; 
   $gender = $_POST['questionType'];

   $query = "INSERT INTO teacher (TEACHER_ID,F_NAME, M_NAME,L_NAME,GENDER,COURSE_ID)
   VALUES ('$cid','$fname', '$mname','$lname','$gender','$course_id')";
 $re = mysqli_query($con, $query);
 if (!$re) {
     echo "Error: " . mysqli_error($con);
 }
 else{
     echo "<script>alert('Teacher Added Successfully')</script>";
 } 
}


}
?>