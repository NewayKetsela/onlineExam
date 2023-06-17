<?php
  session_start();
    require("DBconnection.php");
    $db = Database::getInstance();
    $con = $db->getConnection();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>DBU Online Examination </title>
   <link rel="stylesheet" href="style1.css" >
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
        <ul class="navbar">
            <li><a href="index.php">Home </a></li> 
            <li><a href="#about">About Us </a></li>
            <li><a href="#footer-container">Contact us </a></li>
            <li><a href="login.php"  id="bbb">LOG IN</a></li>
            <!-- <li><a href="signup.php"  id="bbb">SIGN UP</a></li> -->
        </ul>
      </div>
</header><br><br><br><br>
        <div class="container home-text">
           <label>Debre Birhan University is a university in the <br> city Debre Birhan, 
           Amhara Region, Ethiopia. <br>It is one of thirteen new universities <br>
            which were established in 2007 by the Ethiopian government.</label>
        </div>  
   <section class="home container" id="home">
               
   </section>
   
<br><br>
<?php
  require("footer.php");
 ?>


</body>
</html>
