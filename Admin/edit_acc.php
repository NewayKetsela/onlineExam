
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
        <title>edit AC </title>
</head>
<body>
         <?php
           require("ad_nav.php");
         ?>
<div class="content-wrapper">
         <div class="container">
         <?php
            $query = "select * from AC ";
            $result = mysqli_query($con, $query);
            // Loop through each records 
            while($row = mysqli_fetch_array($result))
            {
                $id= $row['AC_ID'];
                $f_name = $row['F_NAME'];
                $m_name = $row['M_NAME'];
                $l_name = $row['L_NAME'];
                $gen = $row['GENDER'];           
            }
            ?>
         <form method='post'>
            <br><br><br>
            <h4> Edit Acadamic commission </h4><br>
            <div class="form-group">
                  <div class="form-group">
                    <label for="l_name">AC ID</label>
                    <input type="text" class="form-control" id="specialization" name="ac_id" value="<?php echo $id; ?>" placeholder="Enter ac id">
                 </div>

                 <label for="f_name">First Name</label>
                 <input type="text" class="form-control" id="f_name" name="f_name" value="<?php echo $f_name; ?>" placeholder="Enter First name">
              </div>
              <div class="form-group">
                 <label for="m_name">Middle Name</label>
                 <input type="text" class="form-control" id="m_name" name="m_name" value="<?php echo $m_name; ?>" placeholder="Enter Middle name">
              </div>
              <div class="form-group">
                 <label for="l_name">Last Name</label>
                 <input type="text" class="form-control" id="l_name" name="l_name" value="<?php echo $l_name; ?>" placeholder="Enter Last name">
              </div>

              <div class="form-group">
                 <label for="l_name">Gender</label>
                 <input type="text" class="form-control" id="gender" name="gender" name="gender" value="<?php echo $gen; ?>" placeholder="Enter gender">
              </div>
            <div class="form-group">
               <label for="l_name">STATUS</label>
               <select class="form-control" id="questionType" name="status">
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
   $cid=$_POST['ac_id'];   
   $fname=$_POST['f_name'];
   $mname=$_POST['m_name'];
   $lname=$_POST['l_name'];
   $gender = $_POST['gender'];
   $status = $_POST['status'];
   if($status=='acc'){
      $status='active';
   }
   else{
     $status='in active' ;
   }
$query10 = "Update AC set AC_ID='$cid',F_NAME='$fname',M_NAME='$mname',L_NAME='$lname',GENDER='$gender',STATUS='$status' where AC_ID='$id' " ;
                        $resultTF = mysqli_query($con, $query10);
                        if (!$resultTF) {
                            echo "Error: " . mysqli_error($con);
                        } else {
                            echo '<script>alert("AC Account Updated Succesfully");
                                window.location=\'edit_acc.php\'; </script>';
                        }
                    }


}
?>