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
        <title>Edit course </title>
        <script src="code.jquery.com_jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="bootstrap-4.6.1-dist/css/bootstrap.css" >
    <script src="bootstrap-4.6.1-dist/js/bootstrap.bundle.js"></script>
    <link rel="stylesheet" href="../bootstrap-4.6.1-dist/asset/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../bootstrap-4.6.1-dist/asset/css/adminlte.min.css">
    <link rel="stylesheet" href="../bootstrap-4.6.1-dist/asset/css/style.css">
        <link rel="stylesheet" href="../style.css">
</head>
<style>
        .style2 {  font-size: 12px}
        .style12 {  font-size: small; font-weight: bold; }
        .style3 {
            font-family: Verdana, Arial, Helvetica, sans-serif;
            font-size: small;
            color: #000000;
            }
        .style4 {font-size: small;
            color: #FFFFFF;
        }
        .style5 {color: #000000}
        .style6 {color: #000000}
        .style9 {font-family: Verdana, Arial, Helvetica, sans-serif}
     </style>
<body>
         <?php
           require("ac_nav.php");
         ?>
<div class="content-wrapper">
         <div class="container">
         <form method='post'>
            <br><br><br>
            <h4> Edit a course </h4><br>
            <table width="100%" border="1" bordercolor="#bdaaaa"  >
                    <tr>
                      <th bgcolor="#e9eee2" class="style3"><div style=" text-align: left !important;" class="style9 style5"><strong>COURSE ID</strong></div></th>
                      <th  bgcolor="#e9eee2" class="style3"><div align="left" class="style9 style5"><strong>COURSE NAME</strong></div></th>
                      <th bgcolor="#e9eee2" class="style3"><div align="left" class="style9 style5"><strong>DIPARTMENT NAME</strong></div></th>
                       <th bgcolor="#e9eee2" class="style3"><div align="left" class="style9 style5"><strong>YEAR</strong></div></th>
                       <th bgcolor="#e9eee2" class="style3"><div align="left" class="style9 style5"><strong>EDIT</strong></div></th>
                    </tr>

                    <?php
                        $query10 = " SELECT * FROM course ";
                        $resultTF = mysqli_query($con, $query10);
                        if (!$resultTF) {
                            echo "Error: " . mysqli_error($con);
                        } else {
                            while ($row = mysqli_fetch_array($resultTF)) {
                                $e_id= $row['COURSE_ID'];
                                $f_name = $row['COURSE_NAME'];
                                $year = $row['YEAR'];
                                $dept = $row['DEPARTMENT_NAME'];
                    ?>
                                <tr>
                                    <td bgcolor="#f8feff" class="style3"><div align="left" class="style9 style6"><?php echo $e_id; ?></div></td>
                                    <td bgcolor="#f8feff" class="style3"><div align="left" class="style9 style6"><?php echo $f_name; ?></div></td>
                                    <td bgcolor="#f8feff" class="style3"><div align="left" class="style9 style6"><?php echo $dept; ?></div></td>
                                    <td bgcolor="#f8feff" class="style3"><div align="left" class="style9 style6"><?php echo $year; ?></div></td>
                                    <td bgcolor="#f8feff" class="style3">
                                        <div align="left" class="style9 style6"><a href="update_course.php?COURSE_ID=<?php echo $e_id;?> " >
                                        Edit</a></div></td>
                                </tr>
                    <?php
                            }
                        }
                    ?>

                  </table>
</div>
</div>
                  
      <script src="../bootstrap-4.6.1-dist/asset/jquery/jquery.min.js"></script>
      <script src="../bootstrap-4.6.1-dist/asset/js/adminlte.js"></script>
   </body>
</html>
<?php } ?>