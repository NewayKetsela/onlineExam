<?php 
session_start(); 
if($_SESSION['login']==='none'){
	
	echo "<script>window.open('../index.php?not_loggined=Please login!','_self')</script>";
}
else {
    require("../DBconnection.php"); 
    $db = Database::getInstance();
    $con = $db->getConnection();
    if(isset($_POST['submit'])){
        $check=true;
        $date=$_POST['date'];
        $start_time=$_POST['start-time'];
        $selectedCourse = $_POST['course'];
        $q = "SELECT * FROM exam_bank WHERE REQUEST_EVALUATION='accepted' AND STATUS='not taken' and TIME_SET='not set' ";
        $result_e = mysqli_query($con, $q);
        while ($row_o = mysqli_fetch_array($result_e)) {      
            $c_id= $row_o['COURSE_ID']; 
            $cn_name= $row_o['COURSE_NAME'];   
            $e_time = $row_o['EXAM_TIME'];
            if($cn_name == $selectedCourse){ 
                $qC= "SELECT * FROM course where COURSE_ID='$c_id' ";
                $result_course = mysqli_query($con, $qC);
                if($row_c = mysqli_fetch_array($result_course)) {
                        $deprt_name = $row_c['DEPARTMENT_NAME'];
                        $year = $row_c['YEAR'];
                    }          
                // Extract hours and minutes from $e_time and $start_time
                list($e_hours, $e_minutes) = explode(':', $e_time);
                list($start_hours, $start_minutes) = explode(':', $start_time);
                
                // Calculate the sum of hours and minutes
                $sum_hours = intval($e_hours) + intval($start_hours);
                $sum_minutes = intval($e_minutes) + intval($start_minutes);
                // Adjust the sum if the minutes exceed 60
                if ($sum_minutes >= 60) {
                    $sum_hours += floor($sum_minutes / 60);
                    $sum_minutes = $sum_minutes % 60;
                }     
                // Convert the start time and end time to minutes
                $start_time_minutes = intval($start_hours) * 60 + intval($start_minutes);
                $end_time_minutes = $sum_hours * 60 + $sum_minutes;
                // Format the result
                $end_timeOfNew = sprintf('%02d:%02d:00', $sum_hours, $sum_minutes); 
    
                $qS= "SELECT * FROM exam_schedule ";
                $result_exam_schedule = mysqli_query($con, $qS);
                while ($row_row = mysqli_fetch_array($result_exam_schedule)) {
                    $b_date= $row_row['EXAM_DATE'];
                    $b_start_time= $row_row['START_TIME'];
                    $b_end_time = $row_row['END_TIME'];
                    $dep_name = $row_row['DEPARTMENT_NAME'];
                    $y = $row_row['YEAR'];

                    if (trim($deprt_name) == trim($dep_name) && $year == $y) {
                        $d_date = new DateTime($date);
                        $d_b_date = new DateTime($b_date);

                        list($b_hours, $b_minutes) = explode(':', $b_start_time);
                        list($b_end_hours, $b_end_minutes) = explode(':', $b_end_time);
                        $b_start_time_minutes = intval($b_hours) * 60 + intval($b_minutes);
                        $b_end_time_minutes = intval($b_end_hours) * 60 + intval($b_end_minutes);
                
                        if ($d_date == $d_b_date ) {
                            if($start_time_minutes < $b_start_time_minutes && $end_time_minutes < $b_end_time_minutes + 60){
                                echo "<script>alert('There is another exam in this time, Set Schedule NOT successfully')</script>";
                                $check = false;
                            }
                            elseif( $start_time_minutes >= $b_start_time_minutes && $start_time_minutes < $b_end_time_minutes + 60){
                                echo "<script>alert('There is another exam in this time, Set Schedule NOT successfully')</script>";
                                $check = false;
                            }
                            
                        }     
                        
                     }       
                }

                if($check){
                    $query = "INSERT INTO exam_schedule (COURSE_ID,EXAM_DATE, START_TIME,END_TIME,DEPARTMENT_NAME,YEAR)
                    VALUES ('$c_id','$date', '$start_time','$end_timeOfNew','$deprt_name','$year' )";
                    $re = mysqli_query($con, $query);
                    if ($re) {
                        $sqll = "Update exam_bank set TIME_SET='set' where COURSE_ID='$c_id' ";
                        if ( !(mysqli_query($con, $sqll))) {
                            echo "Error updating question: " . mysqli_error($con);
                        } 
                            
                        echo "<script>alert('The Schedule Successfully set.')</script>";
                    } else {
                        echo "Error: " . mysqli_error($con);
                    }
                }        
            }
    
        }
    }

	?>

<html lang="en"> 
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>set schedule</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../bootstrap-4.6.1-dist/asset/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../bootstrap-4.6.1-dist/asset/css/adminlte.min.css">
    <link rel="stylesheet" href="../bootstrap-4.6.1-dist/asset/css/style.css">
    <link rel="stylesheet" href="../style.css">
    

</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
         <?php
           require("ac_nav.php");
         ?>
        <div class="content-wrapper">
        <br><br><br>
               <!-- Main content -->
        <div class="container">  
            <h1>Exam Schedule</h1> <br>
            <div class="formMargin" id="formM" style="">
            <form onsubmit="return validate()" action="set_schedule.php" method="post" >
                <div class="form-group">
                <label for="course">Course Name:</label>
                <select id="course" name="course">
                    <option value="" selected>Select the course </option>
                        <?php
                            $q= "SELECT * FROM exam_bank where REQUEST_EVALUATION='accepted' and STATUS='not taken' and TIME_SET='not set' ";
                            $result = mysqli_query($con, $q);
                            if (!$result) {
                                echo "Error: " . mysqli_error($con);
                            } else {
                                // Loop through each record
                                while ($row = mysqli_fetch_array($result)) {
                                    $c_name= $row['COURSE_NAME'];
                                    $c_id= $row['COURSE_ID'];
                                    $e_time = $row['EXAM_TIME'];         
                         ?>
                    <option value="<?php echo $c_name; ?>"><?php echo $c_name; ?></option>
                    <?php
                            }
                        }
                    ?>
                </select>
                <div id="display_select_error" style="color: red"> </div>
                </div>
                
                <div class="form-group">
                <label for="date">Exam Date:</label>
                <input type="date" id="date" name="date">
                <div id="display_date_error" style="color: red"> </div>
                </div>
                
                <div class="form-group">
                <label for="start-time">Exam Start Time:</label>
                <input type="" id="start-time" name="start-time" placeholder="Enter Time like 6:30" required>
                <div id="display_time_error" style="color: red"> </div>
                </div><br>
                <button type="submit" name="submit" class="btn btn-success" style="width: 23%; " >Set Schedule</button>
            </form> 
            <script type="text/javascript">
                function validate() {
                    var course = document.getElementById('course').value;
                    var date = document.getElementById('date').value;
                    var time = document.getElementById('start-time').value;

                    if (course === '') {
                        document.getElementById("display_select_error").innerHTML = 'Please select a course.';
                        return false;
                    } else {
                        document.getElementById("display_select_error").innerHTML = '';
                    }

                    if (date === '') {
                        document.getElementById("display_date_error").innerHTML = 'Please enter the exam date.';
                        return false;
                    } else {
                        document.getElementById("display_date_error").innerHTML = '';
                    }

                    var currentDate = new Date();
                    var enteredDate = new Date(date);
                    currentDate.setHours(0, 0, 0, 0);
                    enteredDate.setHours(0, 0, 0, 0);

                    if (enteredDate <= currentDate) {
                        document.getElementById("display_date_error").innerHTML = 'The exam date must be after the current date.';
                        return false;
                    } else {
                        document.getElementById("display_date_error").innerHTML = '';
                    }

                    // Check if the time is in the format "6:30"
                    var timeRegex = /^\d{1,2}:\d{2}$/;
                    if (!timeRegex.test(time)) {
                        document.getElementById("display_time_error").innerHTML = 'Please enter in the format "6:30".';
                        return false;
                    } else {
                        document.getElementById("display_time_error").innerHTML = '';
                    }

                    // Split the time into hours and minutes
                    var timeParts = time.split(':');
                    var hours = parseInt(timeParts[0], 10);
                    if (hours > 24) {
                        document.getElementById("display_time_error").innerHTML = 'Please enter a valid time.';
                        return false;
                    } else {
                        document.getElementById("display_time_error").innerHTML = '';
                    }
                  return true;
                }
             </script>
            </div> 
        </div>      
        </div>
    </div>
<script src="../bootstrap-4.6.1-dist/asset/jquery/jquery.min.js"></script>
<script src="../bootstrap-4.6.1-dist/asset/js/adminlte.js"></script>
</body>
</html>
<?php


} ?>