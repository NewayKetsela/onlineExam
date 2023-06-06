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
                <div id="ifNotDisplay" style="display: none;"> 
                <br><br>
                     <p style="font-size: large;"> There are currently no prepared exams available. </p>
                     <p style="font-size: large;"> To edit the exam, you must first prepare the exam!</p>
                </div> 

                <div id="displayMultiple" style="display: none;">
                <h4 > Multiple Choice </h4>
                <table width="100%" border="1" bordercolor="#bdaaaa" >
                    <tr>
                      <th bgcolor="#e9eee2" class="style3"><div align="left" class="style9 style5"><strong>QUESTION</strong></div></th>
                      <th  bgcolor="#e9eee2" class="style3"><div align="left" class="style9 style5"><strong>A</strong></div></th>
                      <th bgcolor="#e9eee2" class="style3"><div align="left" class="style9 style5"><strong>B</strong></div></th>
                       <th bgcolor="#e9eee2" class="style3"><div align="left" class="style9 style5"><strong>C</strong></div></th>
                       <th bgcolor="#e9eee2" class="style3"><div align="left" class="style9 style5"><strong>D</strong></div></th>
                       <th bgcolor="#e9eee2" class="style3"><div align="left" class="style9 style5"><strong>QUESTION POINT</strong></div></th>
                       <th bgcolor="#e9eee2" class="style3"><div align="left" class="style9 style5"><strong>ANSWER</strong></div></th>
                       <th bgcolor="#e9eee2" class="style3"><div align="left" class="style9 style5"><strong>EDIT</strong></div></th>
                      <th bgcolor="#e9eee2" class="style3"><div align="left" class="style9 style5"><strong>DELETE</strong></div></th>
                    </tr>

                    <?php
                        require("../DBconnection.php");
                        $db = Database::getInstance();
                        $con = $db->getConnection();
                        $username = $_SESSION['login'];
                        $T_ID = substr($username, -4);
                        // Fetch all the questions from the database where the teacher and multiple choice
                        $query1 = "SELECT * FROM question WHERE TEACHER_ID='$T_ID' AND QUESTION_TYPE='multipleChoice'";
                        $result = mysqli_query($con, $query1);
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
                                    <td bgcolor="#f8feff" class="style3"><div align="left" class="style9 style6"><?php echo $question; ?></div></td>
                                    <td bgcolor="#f8feff" class="style3"><div align="left" class="style9 style6"><?php echo $choice1; ?></div></td>
                                    <td bgcolor="#f8feff" class="style3"><div align="left" class="style9 style6"><?php echo $choice2; ?>></div></td>
                                    <td bgcolor="#f8feff" class="style3"><div align="left" class="style9 style6"><?php echo $choice3; ?></div></td>
                                    <td bgcolor="#f8feff" class="style3"><div align="left" class="style9 style6"><?php echo $choice4; ?></div></td>
                                    <td bgcolor="#f8feff" class="style3"><div align="left" class="style9 style6"><?php echo $q_point; ?></div></td>
                                    <td bgcolor="#f8feff" class="style3"><div align="left" class="style9 style6"><?php echo $answer; ?></div></td>
                                    <td bgcolor="#f8feff" class="style3"><div align="left" class="style9 style6"><a href="EditExam.php?QUESTION_ID=<?php echo $q_id;?>&QUESTION_TYPE=<?php echo $q_type;?>" >Edit</a></div></td>
                                    <td bgcolor="#f8feff" class="style3"><div align="left" class="style9 style6"><a href="DeleteExam.php?QUESTION_ID=<?php echo $q_id;?>" >Delete</a></div></td>
                                </tr>
                    <?php
                            }
                            // Retrieve Number of records returned
                            // $records = mysqli_num_rows($result);
                        }
                    ?>

                  </table>
                  </div>
           
<!--display fill in the blank -->
                  <br><br>
                <div id="displayFillBlank" style="display: none;">
                <h4 > Fill In The Blank </h4>
                <table width="100%" border="1" bordercolor="#bdaaaa" >
                    <tr>
                      <th bgcolor="#e9eee2" class="style3"><div align="left" class="style9 style5"><strong>QUESTION</strong></div></th>
                       <th bgcolor="#e9eee2" class="style3"><div align="left" class="style9 style5"><strong>QUESTION POINT</strong></div></th>
                       <th bgcolor="#e9eee2" class="style3"><div align="left" class="style9 style5"><strong>ANSWER</strong></div></th>
                       <th bgcolor="#e9eee2" class="style3"><div align="left" class="style9 style5"><strong>EDIT</strong></div></th>
                      <th bgcolor="#e9eee2" class="style3"><div align="left" class="style9 style5"><strong>DELETE</strong></div></th>
                    </tr>

                    <?php
                        // Fetch all the questions from the database where the teacher and multiple choice
                        $query2 = "SELECT * FROM question WHERE TEACHER_ID='$T_ID' AND QUESTION_TYPE='fillInTheBlank'";
                        $result = mysqli_query($con, $query2);
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
                                    <td bgcolor="#f8feff" class="style3"><div align="left" class="style9 style6"><?php echo $question; ?></div></td>
                                    <td bgcolor="#f8feff" class="style3"><div align="left" class="style9 style6"><?php echo $q_point; ?></div></td>
                                    <td bgcolor="#f8feff" class="style3"><div align="left" class="style9 style6"><?php echo $answer; ?></div></td>
                                    <td bgcolor="#f8feff" class="style3"><div align="left" class="style9 style6"><a href="EditExam.php?QUESTION_ID=<?php echo $q_id;?>&QUESTION_TYPE=<?php echo $q_type;?>" >Edit</a></div></td>
                                    <td bgcolor="#f8feff" class="style3"><div align="left" class="style9 style6"><a href="DeleteExam.php?QUESTION_ID=<?php echo $q_id;?>" >Delete</a></div></td>
                                </tr>
                    <?php
                            }
                        }
                    ?>
                  </table>
                  </div> 

<!--display Essay question -->
                <br><br>
                <div id="displayEssay" style="display: none;">
                <h4 > Short Answer and Essay </h4>
                <table width="100%" border="1" bordercolor="#bdaaaa" >
                    <tr>
                      <th bgcolor="#e9eee2" class="style3"><div align="left" class="style9 style5"><strong>QUESTION</strong></div></th>
                       <th bgcolor="#e9eee2" class="style3"><div align="left" class="style9 style5"><strong>QUESTION POINT</strong></div></th>
                       <th bgcolor="#e9eee2" class="style3"><div align="left" class="style9 style5"><strong>EDIT</strong></div></th>
                      <th bgcolor="#e9eee2" class="style3"><div align="left" class="style9 style5"><strong>DELETE</strong></div></th>
                    </tr>

                    <?php
                        // Fetch all the questions from the database where the teacher and multiple choice
                        $query3 = "SELECT * FROM question WHERE TEACHER_ID='$T_ID' AND QUESTION_TYPE='Essay'";
                        $result = mysqli_query($con, $query3);
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
                                    <td bgcolor="#f8feff" class="style3"><div align="left" class="style9 style6"><?php echo $question; ?></div></td>
                                    <td bgcolor="#f8feff" class="style3"><div align="left" class="style9 style6"><?php echo $q_point; ?></div></td>
                                    <td bgcolor="#f8feff" class="style3"><div align="left" class="style9 style6"><a  href="EditExam.php?QUESTION_ID=<?php echo $q_id;?>&QUESTION_TYPE=<?php echo $q_type;?>" >Edit</a></div></td>
                                    <td bgcolor="#f8feff" class="style3"><div align="left" class="style9 style6"><a href="DeleteExam.php?QUESTION_ID=<?php echo $q_id;?>" >Delete</a></div></td>
                                </tr>
                    <?php
                            }
                           
                        }
                    ?>
                  </table>
                  </div> 
                  <script>
                    var displayEssay = document.getElementById('displayEssay');
                    var displayFillBlank = document.getElementById('displayFillBlank');
                    var displayMultiple = document.getElementById('displayMultiple'); 
                    var ifNotDisplay = document.getElementById('ifNotDisplay'); 
                </script>
                <?php
                    $result = mysqli_query($con, $query1);
                    $mul_exist=mysqli_num_rows($result);
                    $q_fill_result = mysqli_query($con, $query2);
                    $fill_exist=mysqli_num_rows($q_fill_result);
                    $q_essay_result = mysqli_query($con, $query3);
                    $essay_exist=mysqli_num_rows($q_essay_result);
                    if( $mul_exist>0 || $fill_exist>0 || $essay_exist>0){ 
                        if($mul_exist>0){
                        echo "<script> 
                        displayMultiple.style.display = 'block';  
                        </script>"; 
                        } 
                        if($fill_exist>0){
                            echo "<script> 
                            displayFillBlank.style.display = 'block';  
                            </script>"; 
                        }
                        if($essay_exist>0){
                            echo "<script> 
                            displayEssay.style.display = 'block';  
                            </script>"; 
                        }
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
