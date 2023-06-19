<?php
    require("../to_update_acc.php");
?>


<html lang="en"> 
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>update account</title>
    <script src="code.jquery.com_jquery-3.6.0.min.js"></script>
      <link rel="stylesheet" href="bootstrap-4.6.1-dist/css/bootstrap.css" >
      <script src="bootstrap-4.6.1-dist/js/bootstrap.bundle.js"></script>
      <link rel="stylesheet" href="../bootstrap-4.6.1-dist/asset/fontawesome/css/all.min.css">
      <link rel="stylesheet" href="../bootstrap-4.6.1-dist/asset/css/adminlte.min.css">
      <link rel="stylesheet" href="../bootstrap-4.6.1-dist/asset/css/style.css">
      <link rel="stylesheet" href="../style.css">

</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
         <?php
           require("cm_navbar.php");
         ?>
        <div class="content-wrapper">
        <br><br><br>
               <!-- Main content -->
        <div class="container">
        <section class="content">  

        <?php
           require("../to_update_form.html");
         ?>

        </section> 
     
     </div>      
     </div>
 </div>
</body>
</html>
