<?php 
session_start(); 
if($_SESSION['login']==='none'){
	
	echo "<script>window.open('../index.php?not_loggined=Please login!','_self')</script>";
}
else {
    $exam_time=$_GET['EXAM_TIME'];
	?>

<html lang="en"> 
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View Exam</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../bootstrap-4.6.1-dist/asset/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../bootstrap-4.6.1-dist/asset/css/adminlte.min.css">
    <link rel="stylesheet" href="../bootstrap-4.6.1-dist/asset/css/style.css">
    <style>
        .style2 {  font-size: 12px}
        .style12 {  font-size: small; font-weight: bold; }
        .style3 {
            font-family: Verdana, Arial, Helvetica, sans-serif;
            font-size: small;
            color: #e2dddd;
            }
        .style4 {font-size: small;
            color: #FFFFFF;
        }
        .style5 {color: #000000}
        .style6 {color: #000000}
        .style9 {font-family: Verdana, Arial, Helvetica, sans-serif}
     </style>
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
                        <br<br>

                <div id="displayMultiple" style="display: none;">
                <h3>Time to take to this exam  <?php echo $exam_time;  ?></h3><br>
                <h4 > Multiple Choice </h4>
                <table width="100%" border="1" className="table table-lg p-10" bordercolor="#bdaaaa" >
                    <tr>
                      <th bgcolor="#e9eee2" class="style3"><div align="left" class="style9 style5"><strong>QUESTION</strong></div></th>
                      <th  bgcolor="#e9eee2" class="style3"><div align="left" class="style9 style5"><strong>A</strong></div></th>
                      <th bgcolor="#e9eee2" class="style3"><div align="left" class="style9 style5"><strong>B</strong></div></th>
                       <th bgcolor="#e9eee2" class="style3"><div align="left" class="style9 style5"><strong>C</strong></div></th>
                       <th bgcolor="#e9eee2" class="style3"><div align="left" class="style9 style5"><strong>D</strong></div></th>
                       <th bgcolor="#e9eee2" class="style3"><div align="left" class="style9 style5"><strong>QUESTION POINT</strong></div></th>
                       <th bgcolor="#e9eee2" class="style3"><div align="left" class="style9 style5"><strong>ANSWER</strong></div></th>
                    </tr>
                        <!-- // $query = "SELECT * FROM question WHERE TEACHER_ID='$COM_ID' AND QUESTION_TYPE='multipleChoice'"; -->
                    <?php
                        require("../DBconnection.php");
                        $db = Database::getInstance();
                        $con = $db->getConnection();
                        $username = $_SESSION['login'];
                        $COM_ID = substr($username, -4);
                        // Fetch all the questions from the database where the teacher and multiple choice
                        $q= "SELECT q.* FROM question q JOIN teacher t ON q.TEACHER_ID = t.TEACHER_ID JOIN exam_committee e ON t.COURSE_ID = e.ASSIGN_COURSE_ID  where QUESTION_TYPE='multipleChoice' and STATUS='new' ";
                        $result = mysqli_query($con, $q);
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
                                    <td bgcolor="#f8feff" class="style3"><div align="left" class="style9 style6"><?php echo $choice2; ?></div></td>
                                    <td bgcolor="#f8feff" class="style3"><div align="left" class="style9 style6"><?php echo $choice3; ?></div></td>
                                    <td bgcolor="#f8feff" class="style3"><div align="left" class="style9 style6"><?php echo $choice4; ?></div></td>
                                    <td bgcolor="#f8feff" class="style3"><div align="left" class="style9 style6"><?php echo $q_point; ?></div></td>
                                    <td bgcolor="#f8feff" class="style3"><div align="left" class="style9 style6"><?php echo $answer; ?></div></td>
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
                  <table width="100%" border="1" bordercolor="bdaaaa" >
                    <tr>
                      <th bgcolor="#e9eee2" class="style3"><div align="left" class="style9 style5"><strong>QUESTION</strong></div></th>
                       <th bgcolor="#e9eee2" class="style3"><div align="left" class="style9 style5"><strong>QUESTION POINT</strong></div></th>
                       <th bgcolor="#e9eee2" class="style3"><div align="left" class="style9 style5"><strong>ANSWER</strong></div></th>
                    </tr>

                    <?php
                        // Fetch all the questions from the database where the teacher and multiple choice
                        $q_fill= "SELECT q.* FROM question q JOIN teacher t ON q.TEACHER_ID = t.TEACHER_ID JOIN exam_committee e ON t.COURSE_ID = e.ASSIGN_COURSE_ID  where QUESTION_TYPE='fillInTheBlank' and STATUS='new' ";
                        $q_fill_result = mysqli_query($con, $q_fill);
                        if (!$q_fill_result) {
                            echo "Error: " . mysqli_error($con);
                        } else {
                            while ($row = mysqli_fetch_array($q_fill_result)) {
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
                  <table width="100%" border="1" bordercolor="bdaaaa" >
                    <tr>
                      <th bgcolor="#e9eee2" class="style3"><div align="left" class="style9 style5"><strong>QUESTION</strong></div></th>
                       <th bgcolor="#e9eee2" class="style3"><div align="left" class="style9 style5"><strong>QUESTION POINT</strong></div></th>
                    </tr>

                    <?php
                        // Fetch all the questions from the database where the teacher and multiple choice
                        $q_essay= "SELECT q.* FROM question q JOIN teacher t ON q.TEACHER_ID = t.TEACHER_ID JOIN exam_committee e ON t.COURSE_ID = e.ASSIGN_COURSE_ID  where QUESTION_TYPE='Essay' and STATUS='new' ";
                        $q_essay_result = mysqli_query($con, $q_essay);
                        if (!$q_essay_result) {
                            echo "Error: " . mysqli_error($con);
                        } else {
                            // Loop through each record
                            while ($row = mysqli_fetch_array($q_essay_result)) {
                                $q_type = $row['QUESTION_TYPE'];
                                $q_id= $row['QUESTION_ID'];
                                $question = $row['QUESTION'];
                                $q_point = $row['QUESTION_POINT'];
                    ?>
                                <tr>
                                    <td bgcolor="#f8feff" class="style3"><div align="left" class="style9 style6"><?php echo $question; ?></div></td>
                                    <td bgcolor="#f8feff" class="style3"><div align="left" class="style9 style6"><?php echo $q_point; ?></div></td>
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
                </script>
                <?php
                    $result = mysqli_query($con, $q);
                    $mul_exist=mysqli_num_rows($result);
                    if($mul_exist>0){
                        echo "<script> 
                        displayMultiple.style.display = 'block';  
                        </script>"; 
                    }
                    $q_fill_result = mysqli_query($con, $q_fill);
                    $fill_exist=mysqli_num_rows($q_fill_result);
                    if($fill_exist>0){
                        echo "<script> 
                        displayFillBlank.style.display = 'block';  
                        </script>"; 
                    }
                    $q_essay_result = mysqli_query($con, $q_essay);
                    $essay_exist=mysqli_num_rows($q_essay_result);
                    if($essay_exist>0){
                        echo "<script> 
                        displayEssay.style.display = 'block';  
                        </script>"; 
                    }
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