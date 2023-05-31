<?php
  session_start();
    require("DBconnection.php");
    $db = Database::getInstance();
    $con = $db->getConnection();
    if($con)
    { 
    $sql1="select * from  ac";
    $Acinfo=mysqli_query($con,$sql1);
    $userexist=mysqli_num_rows($Acinfo);
    if($userexist>0)
    {	
    while($row=mysqli_fetch_assoc($Acinfo))
    {
    $ac_id=$row["AC_ID"];
    $fname=$row["F_NAME"];
    $lname=$row["L_NAME"];
    $uname=$fname. $ac_id;
    $password=$lname.$ac_id;
    $password = password_hash($password,PASSWORD_DEFAULT);
    $sqlAcc="select * from  account where U_ID='$ac_id'";
    $resultAcc = mysqli_query($con, $sqlAcc);
    if($resultAcc && mysqli_num_rows($resultAcc) > 0){ 
    }
    else{
        $sql="insert into account (U_ID,ROLE,USERNAME,PASSWORD) values ($ac_id,'AC','$uname','$password')";
        mysqli_query($con,$sql);  
    }
    }
    }

    $sql2="select * from  Student";
    $Stu_info=mysqli_query($con,$sql2);
    $Stu_exist=mysqli_num_rows($Stu_info);
    if($Stu_exist>0)
    {	
    while($row=mysqli_fetch_assoc($Stu_info))
    {
    $stu_id=$row["STUDENT_ID"];
    $fname=$row["F_NAME"];
    $lname=$row["L_NAME"];
    $uname=$fname. $stu_id;
    $password=$lname.$stu_id;
    $password = password_hash($password,PASSWORD_DEFAULT);
    $sqlAcc="select * from  account where U_ID='$stu_id'";
    $resultAcc = mysqli_query($con, $sqlAcc);
    if($resultAcc && mysqli_num_rows($resultAcc) > 0){ }
    else{
        $sql="insert into account (U_ID,ROLE,USERNAME,PASSWORD) values ($stu_id,'Student','$uname','$password')";
        mysqli_query($con,$sql);
    }
    }  }

    $sql3="select * from  Teacher";
    $T_info=mysqli_query($con,$sql3);
    $T_exist=mysqli_num_rows($T_info);
    if($T_exist>0)
    {	
    while($row=mysqli_fetch_assoc($T_info))
    {
    $t_id=$row["TEACHER_ID"];
    $fname=$row["F_NAME"];
    $lname=$row["L_NAME"];
    $uname=$fname. $t_id;
    $password=$lname.$t_id;
    $password = password_hash($password,PASSWORD_DEFAULT);
    $sqlAcc="select * from  account where U_ID='$t_id'";
    $resultAcc = mysqli_query($con, $sqlAcc);
    if($resultAcc && mysqli_num_rows($resultAcc) > 0) { }
    else{
        $sql="insert into account (U_ID,ROLE,USERNAME,PASSWORD) values ($t_id,'Teacher','$uname','$password')";
        mysqli_query($con,$sql);
    }
    }
    }

    $sql4="select * from  Admin";
    $Admin_info=mysqli_query($con,$sql4);
    $Admin_exist=mysqli_num_rows($Admin_info);
    if($Admin_exist>0)
    {	
    while($row=mysqli_fetch_assoc($Admin_info))
    {
    $admin_id=$row["ADMIN_ID"];
    $fname=$row["F_NAME"];
    $lname=$row["L_NAME"];
    $uname=$fname. $admin_id;
    $password=$lname.$admin_id;
    $password = password_hash($password,PASSWORD_DEFAULT);
    $sqlAcc="select * from  account where U_ID='$admin_id'";
    $resultAcc = mysqli_query($con, $sqlAcc);
    if($resultAcc && mysqli_num_rows($resultAcc) > 0){ }
    else{
        $sql="insert into account (U_ID,ROLE,USERNAME,PASSWORD) values ($admin_id,'Admin','$uname','$password')";
        mysqli_query($con,$sql);
    }
    }
    }

    $sql5="select * from  exam_committee";
    $committee_info=mysqli_query($con,$sql5);
    $committee_exist=mysqli_num_rows($committee_info);
    if($committee_exist>0)
    {	
    while($row=mysqli_fetch_assoc($committee_info))
    {
    $com_id=$row["COMMITTEE_ID"];
    $fname=$row["F_NAME"];
    $lname=$row["L_NAME"];
    $uname=$fname. $com_id;
    $password=$lname.$com_id;
    $password = password_hash($password,PASSWORD_DEFAULT);
    $sqlAcc="select * from  account where U_ID='$com_id'";
    $resultAcc = mysqli_query($con, $sqlAcc);
    if($resultAcc && mysqli_num_rows($resultAcc) > 0){ }
    else{
        $sql="insert into account (U_ID,ROLE,USERNAME,PASSWORD) values ($com_id,'Exam_Committee','$uname','$password')";
        mysqli_query($con,$sql);
    }
    }
    }


    }
    else
       echo"Connection fail".mysqli_error(); 

  if(isset($_POST['submit'])){
    include('login.php');
    $obj=new userLogin();
    $obj->login($_POST['username'], $_POST['password']);	
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login Page</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
      background-color: #f8f9fa;
    }
    
    .login-container {
      max-width: 400px;
      margin: 0 auto;
      margin-top: 100px;
      padding: 20px;
      background-color: #fff;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    
    .login-container h2 {
      text-align: center;
      margin-bottom: 30px;
    }
    
    .form-group label {
      font-weight: bold;
    }
    
    .form-group input {
      border-radius: 3px;
    }
    
    .form-group input[type="text"],
    .form-group input[type="password"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
    }
    
    .form-group .btn-primary {
      width: 100%;
      margin-top: 20px;
    }
  </style>
  
</head>
<body>
  <div class="container">
    <div class="login-container">
      <h2>Login</h2>
      <form  onsubmit="return validate()" action="index.php" id="loginForm" method="post">
        <div class="form-group">
          <label for="username">Username:</label>
          <input type="text" id="username" name="username"  placeholder="Enter your username" required>
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" id="password" name="password" placeholder="Enter your password" required>
        </div>
        <div id="checkAll" style="color: red"></div>
        <button type="submit" name="submit" class="btn btn-primary">Login</button>
      </form>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script type="text/javascript">
      function validate(){
      const  username= document.getElementById('username');
      const password = document.getElementById('password');
      document.getElementById("checkAll").innerHTML="";
      const name = /^[A-Za-z]{3,}[0-9]{4}$/;
      if(!username.value.match(name))
             { 
              document.getElementById("checkAll").innerHTML='Enter a valid Username!!'
              return false;
            }
      if (password.value.length<6) {
            	document.getElementById("checkAll").innerHTML="password should be greater than 6 characters!!"
            	return false;
             }
      else{
        return true;
      } 
      
      }
  </script>

</body>
</html>
