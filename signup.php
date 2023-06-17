<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sign-up </title>
   <link rel="stylesheet" href="style1.css" >
   <link rel="stylesheet" href="style.css" >
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
 <script src="all.min.js" ></script>
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
                <li><a href="login.php"  id="bbb">LOG IN</a></li>
            </ul>
      </div>
   </header>
   <section class="container" id="home">
   <div class="login-container">
       <form onsubmit="return validate()"  action="update_password.php" method="POST">
            <div class="form-group">
                <label class="questionType">Role</label>
                <select class="form-control" id="questionType" name="questionType">
                    <option value="" selected>Select your Role</option>
                    <option value="trueORFalse">True or False</option>
                    <option value="multipleChoice">Multiple Choice</option>
                    <option value="fillInTheBlank">Fill in the Blank</option>
                    <option value="Essay">Essay</option>
                </select>
            </div>
            <div class="form-group">
                <label for="current_password">Current Password</label>
                <input type="password" id="current_password" name="current_password" placeholder="Enter current password" required>
            </div>
            <div class="form-group">
                <label for="new_password">New Password</label>
                <input type="password" id="new_password" name="new_password" placeholder="Enter new password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm password" required><br>
                <div id="checkPass" style="color: red"></div>
            </div>
        </form>

   </div>
   <script type="text/javascript">
            // function validate(){
            // const  username= document.getElementById('username');
            // const password = document.getElementById('password');
            // document.getElementById("checkAll").innerHTML="";
            // const name = /^[A-Za-z]{3,}[0-9]{4}$/;
            // if(!username.value.match(name))
            //         { 
            //         document.getElementById("checkAll").innerHTML='Enter a valid Username!!'
            //         return false;
            //         }
            // if (password.value.length<6) {
            //             document.getElementById("checkAll").innerHTML="password should be greater than 6 characters!!"
            //             return false;
            //         }
            // else{
            //     return true;
            // } 
            
            // }
        </script>        
   </section>





   <br><br><br>

<?php
  require("footer.php");
 ?>

</body>
</html>