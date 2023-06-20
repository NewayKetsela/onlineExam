<?php 
if(isset($_POST['submit'])){
   require("DBconnection.php");
   $db = Database::getInstance();
   $con = $db->getConnection();
   $username = $_POST['username'];;
   $T_ID = substr($username, -4);
   $sql5="select * from  account where USERNAME='$username' ";
   $com=mysqli_query($con,$sql5);
   while($row=mysqli_fetch_assoc($com))
    {
    $role=$row["ROLE"];
    
    if($role == 'Admin' ){
        $sqll="select * from  admin where ADMIN_ID='$T_ID' ";
    }
    else if($role == 'Student' ){
        $sqll="select * from  student where STUDENT_ID='$T_ID' ";
    }
    else if($role == 'Teacher' ){
        $sqll="select * from  teacher where TEACHER_ID='$T_ID' ";
    }
    else if($role == 'AC' ){
        $sqll="select * from  ac where AC_ID='$T_ID' ";
    }
    else if($role == 'Exam_Committee' ){
        $sqll="select * from  exam_Committee where COMMITTEE_ID='$T_ID' ";
    }

    $re=mysqli_query($con,$sqll);
    while($roww=mysqli_fetch_assoc($re))
    {
        $lname=$roww["L_NAME"];
        $password=$lname.$T_ID;
        $pass = password_hash($password,PASSWORD_DEFAULT);
        $sqlAcc="Update account set PASSWORD='$pass' where U_ID='$T_ID'";
        $resultAcc = mysqli_query($con, $sqlAcc);
        if (!$resultAcc) {
            echo "Error: " . mysqli_error($con);
        } else {
            echo '<script>alert("Password Reset Succesfully");
                window.location=\'login.php\'; </script>';
        }

    }
   }
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
            <form  onsubmit="return validate()" action="reset_password.php" id="loginForm" method="post">
                <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username"  placeholder="Enter your username" required>
                </div>
                <div id="checkAll" style="color: red"></div>
                <button type="submit" name="submit" class="btn btn-primary" id=" buttonLogin">Reset Password</button><br><br>
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
   
<br><br><br><br><br><br><br>

<?php
  require("footer.php");
 ?>


</body>
</html>

