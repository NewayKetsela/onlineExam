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

<html lang="en">
    
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>edit committee</title>
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
   <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
         <?php
           require("ac_nav.php");
         ?>
      
         <div class="content-wrapper">
         <br><br><br>
               <!-- Main content -->
            <div class="container">
            <section class="content">  
                        <br<br>
                <div id="ifNotDisplay" style="display: none;"> 
                <br><br>
                     <p style="font-size: large;"> There are currently no added Committee available. </p>
                     <p style="font-size: large;"> To edit the Committee information, you must first add Committee!</p>
                </div> 

                <div id="displayTF" style="display: none;" >
                <h5 > Exam Committee information  </h5><br>
                <table width="100%" border="1" bordercolor="#bdaaaa"  >
                    <tr>
                      <th bgcolor="#e9eee2" class="style3"><div style=" text-align: left !important;" class="style9 style5"><strong>COMMITTEE ID</strong></div></th>
                      <th  bgcolor="#e9eee2" class="style3"><div align="left" class="style9 style5"><strong>FIRST NAME</strong></div></th>
                      <th bgcolor="#e9eee2" class="style3"><div align="left" class="style9 style5"><strong>MIDDLE NAME</strong></div></th>
                       <th bgcolor="#e9eee2" class="style3"><div align="left" class="style9 style5"><strong>LAST NAME</strong></div></th>
                       <th bgcolor="#e9eee2" class="style3"><div align="left" class="style9 style5"><strong>ASSIGNED TO COURSE ID</strong></div></th>
                       <th bgcolor="#e9eee2" class="style3"><div align="left" class="style9 style5"><strong>EDIT</strong></div></th>
                    </tr>

                    <?php
                        $query10 = " SELECT * FROM exam_committee ";
                        $resultTF = mysqli_query($con, $query10);
                        if (!$resultTF) {
                            echo "Error: " . mysqli_error($con);
                        } else {
                            while ($row = mysqli_fetch_array($resultTF)) {
                                $e_id= $row['COMMITTEE_ID'];
                                $f_name = $row['F_NAME'];
                                $m_name = $row['M_NAME'];
                                $l_name = $row['L_NAME'];
                                $A_course_id = $row['ASSIGN_COURSE_ID']; 
                    ?>
                                <tr>
                                    <td bgcolor="#f8feff" class="style3"><div align="left" class="style9 style6"><?php echo $e_id; ?></div></td>
                                    <td bgcolor="#f8feff" class="style3"><div align="left" class="style9 style6"><?php echo $f_name; ?></div></td>
                                    <td bgcolor="#f8feff" class="style3"><div align="left" class="style9 style6"><?php echo $m_name; ?></div></td>
                                    <td bgcolor="#f8feff" class="style3"><div align="left" class="style9 style6"><?php echo $l_name; ?></div></td>
                                    <td bgcolor="#f8feff" class="style3"><div align="left" class="style9 style6"><?php echo $A_course_id; ?></div></td>
                                    <td bgcolor="#f8feff" class="style3">
                                        <div align="left" class="style9 style6"><a href="update_committee.php?COMMITTEE_ID=<?php echo $e_id;?>&ASSIGN_COURSE_ID=<?php echo $A_course_id;?>" >
                                        Edit</a></div></td>
                                </tr>
                    <?php
                            }
                        }
                    ?>

                  </table>
                  <!-- </div> -->
                  <br>
                  <script>
                    var ifNotDisplay = document.getElementById('ifNotDisplay'); 
                    var displayTF = document.getElementById('displayTF'); 
                  </script>
                <?php
                    $resultTF = mysqli_query($con, $query10);
                    $TF_exist=mysqli_num_rows($resultTF);
                    if($TF_exist>0){
                        echo "<script> 
                        displayTF.style.display = 'block';  
                        </script>"; 
                    }          
                    else{
                        echo "<script> 
                        ifNotDisplay.style.display = 'block';  
                        </script>";  
                    } 
                 mysqli_close($con);
                ?>


            </section> 
            </div>      
         </div>
    </div>
      <script src="../bootstrap-4.6.1-dist/asset/jquery/jquery.min.js"></script>
      <script src="../bootstrap-4.6.1-dist/asset/js/adminlte.js"></script>
   </body>
</html>
<?php } ?>
