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
    <title>Student</title>
    <script src="code.jquery.com_jquery-3.6.0.min.js"></script>
    <script src="bootstrap-4.6.1-dist/js/bootstrap.bundle.js"></script>
    <link rel="stylesheet" href="bootstrap-4.6.1-dist/css/bootstrap.css" >

</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
         <?php
           require("stu_navbar.php");
         ?>
        <div class="content-wrapper">
        <br><br><br>
               <!-- Main content -->
        <div class="container">
        <section class="content">  
                        <br<br>
                  <div class="info-box">
                     <span class="info-box-icon bg2 elevation-1"><i class="fas fa-user" style="color: rgb(211, 209, 207);"></i></span>

                        <div class="info-box-content">
                           <span class="info-box-text">Welcome</span>
                           <span class="info-box-number">
                              <?php if (isset($_SESSION['login'])){
                                 $username = $_SESSION['login'];
                                 $role = $_SESSION['user'];
                                 $stu_ID = substr($username, -4);
                                 echo $username; 
                              }   ?> 
                           </span>
                        </div>
                 </div>
                 <br>
               <table class="table" id="table" >
                  <thead>
                    <?phP
                      $x=0;
                   $query10=" SELECT s.*
                    FROM student s
                    JOIN Course c ON s.DEPARTMENT_NAME = c.DEPARTMENT_NAME AND s.YEAR = c.YEAR ";
                    $resultTF = mysqli_query($con, $query10);
                    if (!$resultTF) {
                        echo "Error: " . mysqli_error($con);
                    } else {
                        while ($row = mysqli_fetch_array($resultTF)) {
                            $s_id= $row['STUDENT_ID'];
                            if($s_id == $stu_ID ){
                                $t=" SELECT eb.*FROM exam_bank eb JOIN Course c ON eb.COURSE_ID = c.COURSE_ID 
                                   where REQUEST_EVALUATION='accepted' and STATUS='not taken' and TIME_SET='set'  ";
                                $ttt= mysqli_query($con, $t);
                                if (!$ttt) {
                                    echo "Error: " . mysqli_error($con);
                                } else {
                                    while ($row = mysqli_fetch_array($ttt)) {
                                        $t_id= $row['TEACHER_ID'];
                                        $c_name= $row['COURSE_NAME'];
                                        $c_id= $row['COURSE_ID'];
                                        $e_time = $row['EXAM_TIME'];
                                        $e_type = $row['EXAM_TYPE']; 
                                         
                    ?> 
                    <tr> &nbsp&nbsp&nbsp 
                        <?php
                            date_default_timezone_set('Etc/GMT+3');
                            $qE = "SELECT * FROM exam_schedule WHERE COURSE_ID='$c_id'";
                            $result_E = mysqli_query($con, $qE);
                            if (!$result_E) {
                                echo "Error: " . mysqli_error($con);
                            } else {
                                while ($row_r = mysqli_fetch_array($result_E)) {
                                    $e_date = $row_r['EXAM_DATE'];
                                    $start_time = $row_r['START_TIME'];
                                    $end_time = $row_r['END_TIME'];
                                    $current_t_time = date('h:i A');
                                    $current_time = date('H:i', strtotime($current_t_time));
                                    $c_date = date('Y-m-d');
                                    $current_date = new DateTime($c_date);
                                    $exam_e_date = new DateTime($e_date);

                                    list($current_hours, $current_minutes) = explode(':', $current_time);
                                    list($start_hours, $start_minutes) = explode(':', $start_time);
                                    $cal_start_time = intval($start_hours) * 60 + intval($start_minutes);
                                    $cal_current_time = intval($current_hours) * 60 + intval($current_minutes);   
                                    echo  $e_date;  
                                    // Determine if the button should be enabled or disabled
                                    $button_disabled = '';
                                    if ($exam_e_date == $current_date) {
                                        if ($cal_current_time <= $cal_start_time) {
                                            $button_disabled = 'disabled';
                                        }
                                    }
                                    else{
                                        $button_disabled = 'disabled';
                                    }

                                 }   
                               }      
                        ?>  
                    </tr>
                    <tr>&nbsp&nbsp&nbsp&nbsp&nbsp &nbsp&nbsp&nbsp&nbsp&nbsp 
                        <div class="info-box">
                            <span class="info-box-text">
                                <?php echo $start_time ?>
                            </span>&nbsp&nbsp&nbsp&nbsp&nbsp 
                            <span class="info-box-icon bg3 elevation-1" style=" width: 60px !important; height: 70px;">
                            <i class="fas fa-file-word" style="color: rgb(211, 209, 207); width: 50px !important;"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-number">
                                    <?php echo $c_name ?>
                                </span>
                                <span class="info-box-text">This is a <?php echo $e_type;    
                                    // $timezone = date_default_timezone_get();
                                    // echo $timezone;?> </span>
                            </div>
                            <span id="takeExam">  
                                <?php echo $c_id ?> 
                                    <br> 
                                    <a href=" take_exam.php?TEACHER_ID=<?php echo $t_id ?>  "  >  
                                    <button name="view_exam_submit"  class="btn btn-primary"  <?php echo $button_disabled ?>  >Take Exam Now</button> 
                                    </a>&nbsp&nbsp&nbsp&nbsp
                            </span>

                        </div></tr>
                        <?php    
                                  }
                                }
                               }
                            }
                        }
                        ?>

       
                     
                     
                  </thead>
               </table>

            </section> 
     
        </div>      
        </div>
    </div>
</body>
</html>
<?php } ?>
