
<?php 
session_start(); 
if($_SESSION['login']==='none'){
	
	echo "<script>window.open('../index.php?not_loggined=Please login!','_self')</script>";
}
else {
   require("../DBconnection.php");
   $db = Database::getInstance();
   $con = $db->getConnection();
   $schedule_id=$_GET['SCHEDULE_ID'];
	?>

<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>edit course </title>
    <script src="../bootstrap-4.6.1-dist/asset/jquery/jquery.min.js"></script>
      <script src="../bootstrap-4.6.1-dist/asset/js/adminlte.js"></script>
</head>
<body>
         <?php
           require("ac_nav.php");
         ?>
<div class="content-wrapper">
         <div class="container">
<br><br><br><h4> Edit Schedule </h4><br>
         <?php
            $query = "select * from exam_schedule where SCHEDULE_ID='".$schedule_id."'";
            $result = mysqli_query($con, $query);
            // Loop through each records 
            while($row = mysqli_fetch_array($result))
            {
                $sche_id = $row['SCHEDULE_ID'];
                $c_id= $row['COURSE_ID'];
                $e_date = $row['EXAM_DATE'];
                $st_time = $row['START_TIME'];
                $E_TIME = $row['END_TIME'];
                $year = $row['YEAR'];
                $dept = $row['DEPARTMENT_NAME'];
                    
            }
            ?>
         
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
                <input type="" id="start-time" name="start-time" placeholder="Enter Time like 6:30" value="" required>
                <div id="display_time_error" style="color: red"> </div>
                </div><br>
                <button type="submit" name="submit" class="btn btn-primary" style="width: 23% !important;" >Set Schedule</button>
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
                  
      
   </body>
</html>
<?php
if(isset($_POST['submit'])){
   $cid=$_POST['ct_id'];   
   $cname=$_POST['c_name'];
   $DEPT=$_POST['department_name'];   
   $year=$_POST['year'];
   $query10 = "Update course set COURSE_ID='$cid',COURSE_NAME='$cname',DEPARTMENT_NAME='$DEPT',YEAR='$year' where COURSE_ID='$e_id' " ;
                        $resultTF = mysqli_query($con, $query10);
                        if (!$resultTF) {
                            echo "Error: " . mysqli_error($con);
                        } else {
                            echo '<script>alert("Course Updated Succesfully");
                                window.location=\'edit_course.php\'; </script>';
                        }
                    }


}
?>