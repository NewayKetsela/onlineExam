<?php
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
  include('after_login.php');
  $obj=new userLogin();
  $obj->login($_POST['username'], $_POST['password']);	
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login </title>

   <link rel="stylesheet" href="style1.css" >
   <link rel="stylesheet" href="bootstrap-4.6.1-dist/css/bootstrap.css" >
   <script src="code.jquery.com_jquery-3.6.0.min.js"></script>
   
   <link rel="stylesheet" href="style.css" >
   <script src="bootstrap-4.6.1-dist/js/bootstrap.bundle.js"></script>
 
</head>
<body>
<header>
       <div class="nav container">
           <span class="logo">
               <img src="logo.jpg" alt="">
           </span>
           <input type="checkbox"  name="" id="menu">
            <label for="menu" class="image-menu" ><i class="fas fa-bars"></i>
            </label>
            <ul class="navbar" id="navbarLogin">
                <li><a href="index.php">Home </a></li> 
                <li><a href="#about">About Us </a></li>
                <li><a href="#footer-container">Contact us </a></li>
                <!-- <li><a href="signup.php"  id="bbb">SIGN UP</a></li> -->
            </ul>
      </div>
   </header>
   <section class="container" id="home">
        <div class="container">
            <div class="login-container">
            <h2>Login to continue</h2>
            <form  onsubmit="return validate()" action="login.php" id="loginForm" method="post">
                <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username"  placeholder="Enter your username" required>
                </div>
                <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <div id="checkAll" style="color: red"></div>
                <button type="submit" name="submit" class="btn btn-primary" id=" buttonLogin">Login</button><br><br>
                <a href="reset_password.php">Reset Password </a>
            </form>
            </div>
        </div>

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
   </section>
   
<br><br><br>

<?php
  require("footer.php");
 ?>


</body>
</html>