<?php 
session_start(); 
if($_SESSION['login']==='none'){
	
	echo "<script>window.open('../index.php?not_loggined=Please login!','_self')</script>";
}
else {
	?>

<html lang="en">
    
      <?php
         require("head.html");
      ?>
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
           require("sidebar.php");
         ?>
      
         <div class="content-wrapper">
         <br><br><br>
               <!-- Main content -->
            <div class="container">
            <section class="content">  
                        <br<br>

                <h4 align="center"> Multiple Choice </h4>
                <table width="100%" border="1" bordercolor="black" >
                    <tr>
                      <th bgcolor="#e9eee2" class="style3"><div align="left" class="style9 style5"><strong>QUESTION</strong></div></th>
                      <th  bgcolor="#e9eee2" class="style3"><div align="left" class="style9 style5"><strong>A</strong></div></th>
                      <th bgcolor="#e9eee2" class="style3"><div align="left" class="style9 style5"><strong>B</strong></div></th>
                       <th bgcolor="#e9eee2" class="style3"><div align="left" class="style9 style5"><strong>C</strong></div></th>
                       <th bgcolor="#e9eee2" class="style3"><div align="left" class="style9 style5"><strong>D</strong></div></th>
                       <th bgcolor="#e9eee2" class="style3"><div align="left" class="style9 style5"><strong>QUESTION POINT</strong></div></th>
                       <th bgcolor="#e9eee2" class="style3"><div align="left" class="style9 style5"><strong>ANSWER</strong></div></th>
                       <th bgcolor="#e9eee2" class="style3"><div align="left" class="style9 style5"><strong>EDIT</strong></div></th>
                      <th bgcolor="#e9eee2" class="style3"><div align="left" class="style4">DELETE</div></th>
                    </tr>

                    <?php
                        require("../DBconnection.php");
                        $db = Database::getInstance();
                        $con = $db->getConnection();
                        $username = $_SESSION['login'];
                        $T_ID = substr($username, -4);
                        // Fetch all the questions from the database where the teacher and multiple choice
                        $query = "SELECT * FROM question WHERE TEACHER_ID='$T_ID' AND QUESTION_TYPE='multipleChoice'";
                        $result = mysqli_query($con, $query);
                        if (!$result) {
                            echo "Error: " . mysqli_error($con);
                        } else {
                            // Loop through each record
                            while ($row = mysqli_fetch_array($result)) {
                                $q_id= $row['QUESTION_ID'];
                                $q_type = $row['QUESTION_TYPE'];
                                $question = $row['QUESTION'];
                                $choice1 = $row['CHOICE1'];
                                $choice2 = $row['CHOICE2'];
                                $choice3 = $row['CHOICE3'];
                                $choice4 = $row['CHOICE4'];
                                $q_point = $row['QUESTION_POINT'];
                                $answer = $row['ANSWER'];
                    ?>
                                <tr>
                                    <td bgcolor="#f8feff" class="style3"><div align="left" class="style9 style6"><strong><?php echo $question; ?></strong></div></td>
                                    <td bgcolor="#f8feff" class="style3"><div align="left" class="style9 style6"><strong><?php echo $choice1; ?></strong></div></td>
                                    <td bgcolor="#f8feff" class="style3"><div align="left" class="style9 style6"><strong><?php echo $choice2; ?></strong></div></td>
                                    <td bgcolor="#f8feff" class="style3"><div align="left" class="style9 style6"><strong><?php echo $choice3; ?></strong></div></td>
                                    <td bgcolor="#f8feff" class="style3"><div align="left" class="style9 style6"><strong><?php echo $choice4; ?></strong></div></td>
                                    <td bgcolor="#f8feff" class="style3"><div align="left" class="style9 style6"><strong><?php echo $q_point; ?></strong></div></td>
                                    <td bgcolor="#f8feff" class="style3"><div align="left" class="style9 style6"><strong><?php echo $answer; ?></strong></div></td>
                                    <td bgcolor="#f8feff" class="style3"><div align="left" class="style9 style6"><strong><a href="EditExam.php?QUESTION_ID=<?php echo $q_id;?>&QUESTION_TYPE=<?php echo $q_type;?>" >Edit</a></strong></div></td>
                                    <td bgcolor="#f8feff" class="style3"><div align="left" class="style9 style6"><strong><a href="DeleteExam.php?QUESTION_ID=<?php echo $q_id;?>" >Delete</a></strong></div></td>
                                </tr>
                    <?php
                            }
                            // Retrieve Number of records returned
                            // $records = mysqli_num_rows($result);
                        }
                    ?>

                  </table>
           
<!--display fill in the blank -->
                  <br><br>
                  <h4 align="center"> Fill In The Blank </h4>
                <table width="100%" border="1" bordercolor="white" >
                    <tr>
                      <th bgcolor="#e9eee2" class="style3"><div align="left" class="style9 style5"><strong>QUESTION</strong></div></th>
                       <th bgcolor="#e9eee2" class="style3"><div align="left" class="style9 style5"><strong>QUESTION POINT</strong></div></th>
                       <th bgcolor="#e9eee2" class="style3"><div align="left" class="style9 style5"><strong>ANSWER</strong></div></th>
                       <th bgcolor="#e9eee2" class="style3"><div align="left" class="style9 style5"><strong>EDIT</strong></div></th>
                      <th bgcolor="#e9eee2" class="style3"><div align="left" class="style4">DELETE</div></th>
                    </tr>

                    <?php
                        // Fetch all the questions from the database where the teacher and multiple choice
                        $query = "SELECT * FROM question WHERE TEACHER_ID='$T_ID' AND QUESTION_TYPE='fillInTheBlank'";
                        $result = mysqli_query($con, $query);
                        if (!$result) {
                            echo "Error: " . mysqli_error($con);
                        } else {
                            // Loop through each record
                            while ($row = mysqli_fetch_array($result)) {
                                $q_type = $row['QUESTION_TYPE'];
                                $q_id= $row['QUESTION_ID'];
                                $question = $row['QUESTION'];
                                $q_point = $row['QUESTION_POINT'];
                                $answer = $row['ANSWER'];
                    ?>
                                <tr>
                                    <td bgcolor="#f8feff" class="style3"><div align="left" class="style9 style6"><strong><?php echo $question; ?></strong></div></td>
                                    <td bgcolor="#f8feff" class="style3"><div align="left" class="style9 style6"><strong><?php echo $q_point; ?></strong></div></td>
                                    <td bgcolor="#f8feff" class="style3"><div align="left" class="style9 style6"><strong><?php echo $answer; ?></strong></div></td>
                                    <td bgcolor="#f8feff" class="style3"><div align="left" class="style9 style6"><strong><a href="EditExam.php?QUESTION_ID=<?php echo $q_id;?>&QUESTION_TYPE=<?php echo $q_type;?>" >Edit</a></strong></div></td>
                                    <td bgcolor="#f8feff" class="style3"><div align="left" class="style9 style6"><strong><a href="DeleteExam.php?QUESTION_ID=<?php echo $q_id;?>" >Delete</a></strong></div></td>
                                </tr>
                    <?php
                            }
                        }
                    ?>
                  </table>

<!--display Essay question -->
<br><br>
                <h4 align="center"> Short Answer and Essay </h4>
                <table width="100%" border="1" bordercolor="black" >
                    <tr>
                      <th bgcolor="#e9eee2" class="style3"><div align="left" class="style9 style5"><strong>QUESTION</strong></div></th>
                       <th bgcolor="#e9eee2" class="style3"><div align="left" class="style9 style5"><strong>QUESTION POINT</strong></div></th>
                       <th bgcolor="#e9eee2" class="style3"><div align="left" class="style9 style5"><strong>EDIT</strong></div></th>
                      <th bgcolor="#e9eee2" class="style3"><div align="left" class="style4">DELETE</div></th>
                    </tr>

                    <?php
                        // Fetch all the questions from the database where the teacher and multiple choice
                        $query = "SELECT * FROM question WHERE TEACHER_ID='$T_ID' AND QUESTION_TYPE='Essay'";
                        $result = mysqli_query($con, $query);
                        if (!$result) {
                            echo "Error: " . mysqli_error($con);
                        } else {
                            // Loop through each record
                            while ($row = mysqli_fetch_array($result)) {
                                $q_type = $row['QUESTION_TYPE'];
                                $q_id= $row['QUESTION_ID'];
                                $question = $row['QUESTION'];
                                $q_point = $row['QUESTION_POINT'];
                                $answer = $row['ANSWER'];
                    ?>
                                <tr>
                                    <td bgcolor="#f8feff" class="style3"><div align="left" class="style9 style6"><strong><?php echo $question; ?></strong></div></td>
                                    <td bgcolor="#f8feff" class="style3"><div align="left" class="style9 style6"><strong><?php echo $q_point; ?></strong></div></td>
                                    <td bgcolor="#f8feff" class="style3"><div align="left" class="style9 style6"><strong><a  href="EditExam.php?QUESTION_ID=<?php echo $q_id;?>&QUESTION_TYPE=<?php echo $q_type;?>" >Edit</a></strong></div></td>
                                    <td bgcolor="#f8feff" class="style3"><div align="left" class="style9 style6"><strong><a href="DeleteExam.php?QUESTION_ID=<?php echo $q_id;?>" >Delete</a></strong></div></td>
                                </tr>
                    <?php
                            }
                            mysqli_close($con);
                        }
                    ?>
                  </table>


            </section> 
            </div>      
         </div>
    </div>
      <script src="asset/jquery/jquery.min.js"></script>
      <script src="asset/js/adminlte.js"></script>
   </body>
</html>
<?php } ?>
