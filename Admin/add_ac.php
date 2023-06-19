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
        <title>Add AC </title>
</head>
<body>
         <?php
           require("ad_nav.php");
         ?>
<div class="content-wrapper">
         <div class="container">

         <form method='post'>
               <br><br><br>
               <h4> Add a acadamic commission </h4><br>
               <div class="form-group">
                  <div class="form-group">
                    <label for="l_name">AC ID</label>
                    <input type="text" class="form-control" id="specialization" name="ac_id" placeholder="Enter ac id">
                 </div>

                 <label for="f_name">First Name</label>
                 <input type="text" class="form-control" id="f_name" name="f_name" placeholder="Enter First name">
              </div>
              <div class="form-group">
                 <label for="m_name">Middle Name</label>
                 <input type="text" class="form-control" id="m_name" name="m_name" placeholder="Enter Middle name">
              </div>
              <div class="form-group">
                 <label for="l_name">Last Name</label>
                 <input type="text" class="form-control" id="l_name" name="l_name" placeholder="Enter Last name">
              </div>

              <div class="form-group">
               <label for="l_name">Gender</label>
               <select class="form-control" id="questionType" name="questionType">
                        <option value="" selected>Select gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                  </select>
            </div>
              <br>
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
   $id=$_POST['ac_id'];   
   $fname=$_POST['f_name'];
   $mname=$_POST['m_name'];
   $lname=$_POST['l_name'];
   $gender = $_POST['questionType'];
;
   $query = "INSERT INTO ac (AC_ID,F_NAME, M_NAME,L_NAME,GENDER)
   VALUES ('$id','$fname', '$mname','$lname','$gender' )";
 $re = mysqli_query($con, $query);
 if (!$re) {
     echo "Error: " . mysqli_error($con);
 }
 else{
     echo "<script>alert('Acadamic commission Added Successfully')</script>";
 } 
}


}
?>