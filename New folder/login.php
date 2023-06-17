<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equv="x-UA-compatible" content="IE=edge">
	<meta name="viewport"content="width=device-width, intial-scale=1.0">
<title>log in</title>
<link rel="stylesheet" href="style.css">
 <script type="text/javascript">
      function validate(){
      const  uname= document.getElementById('uname');
      const password = document.getElementById('passw');
      document.getElementById("checkAll").innerHTML="";
      const mail = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      
      if(!uname.value.match(mail))
             { 
              document.getElementById("checkAll").innerHTML='Enter a valid Email!!'
              return false;
            }
      if (password.value.length<8) {
            	document.getElementById("checkAll").innerHTML="your password should be greater than 8 characters!!"
            	return false;
             }
      else{
        return true;
      }
   }
 </script>


</head>
<body style="padding-top:80px;">  
     
    <header>
      <div class="nav container">
        <span class="logo">
          <img src="image/NEWAYpng.png" alt="">
      </span>
          <input type="checkbox"  name="" id="menu">
           <label for="menu" class="image-menu" ><i class="fas fa-bars"></i>
           </label>
           <a href="index.php" class="Hmenu">Home </a>
       </div>
  </header>
<!--log in-->
<div class="login container">
   <div class="login-container">
     <h2>Login to continue</h2>
     <p>Log in with your data that you entered <br>during your registration</p>
 <!--login form-->
      <form onsubmit="return validate()" action="Login.php" method="post">
	       <span>Enter your Email</span>
	    <input type="text" name= "email" id="uname"placeholder="Your Email" required>
	       <span>Enter your password</span>
	    <input type="password" name="password" id="passw"placeholder="password" required>
         <div id="checkAll" style="color: red"></div>
	      <input type="submit" value="log in" name="login" class="buttom">
	       <a href="forgetPass.html">forget password?</a>
       </form>
   <p>Do you need to create an account?</p>
   <a href="sign-up.php" class="btn" id="btnn">sign up now</a>
 </div>
</div><br><br>

<!--footer-->
<section class="footer">
    <div class="footer-container container">
        <h2>House</h2>
        <div class="footer-box">
            <h3>Quick links</h3>
            <a href="sign-up.php">sign up</a>
        </div>
        <div class="footer-box">
            <h3>Contact us</h3>
            <a href="tel:+251 967 30 68 27">Tellphone</a><br>
            <a href="mailto:newayny20@gmail.com">Email </a>
        </div>
    </div>
   </section>
   <div class="copyright">
      <br><br><p>&copy; Group 6 Student All rights Reserved</p>
   </div>
</body>
</html>


<?php

include("Admin/includes/db.php");
	if(isset($_POST['login'])){
		$email = $_POST['email'];
		$pass = $_POST['password'];
	$sel_user = "SELECT * FROM `customers` WHERE `Email`='$email' AND `password`='$pass'";
	$run_user = mysqli_query($con, $sel_user);
	$check_user = mysqli_num_rows($run_user);

	if($check_user==1){
	$_SESSION['user_email']=$email;
  echo "<script>alert('You have successfully Logged in!')</script>";
	echo "<script>window.open('after_login.php?logged_in=You have successfully Logged in!','_self')</script>";

	}

	else {
	echo "<script>alert('Password or Email is wrong, try again!')</script>";
	}


	}


?>