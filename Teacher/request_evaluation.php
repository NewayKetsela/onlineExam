<?php 
session_start();
if($_SESSION['login']==='none'){
	
	echo "<script>window.open('../index.php?not_loggined=Please login!','_self')</script>";
}
else {
        require("../DBconnection.php");
        $db = Database::getInstance();
        $con = $db->getConnection();
        $username = $_SESSION['login'];
        $T_ID = substr($username, -4);
	?>

<html lang="en"> 
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exam Evaluation Request</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../asset/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../asset/css/adminlte.min.css">
    <link rel="stylesheet" href="../asset/css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Function to handle the button click
            // $('#requestEvaluationButton').click(function() {
            //     // Display "Pending" in the result space
            //     $('#resultSpace').text('The request evaluation is sent : Pending');
                
            //     /* Make an AJAX request to submit the evaluation request */
            //     $.ajax({
            //         type: 'POST',
            //         url: 'submit_evaluation_request.php',
            //         success: function(response) {
            //             // Handle the response from the server (if needed)
            //             // For example, you can update the result space with the server's response
            //             // $('#resultSpace').text(response);
            //         }
            //     });
            // });
        });
    </script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
         <?php
           require("sidebar.php");
         ?>
        <div class="content-wrapper">
        <br><br><br>
               <!-- Main content -->
        <div class="container"><br>
        <h1>Exam Evaluation Request</h1>
        <br>
        <p> By submitting your exam, you are kindly requesting the Exam Committee to evaluate it and </p>
        <p>wait some time for the committee to review and provide their response. </P> <br>
        <div id="toSendRequest" style="display: none;">
            <form method="post">
            <label for="examType">Exam Type:</label>&nbsp&nbsp&nbsp&nbsp  
            <select id="examType" name="examType">
                <option value="midExam">Mid Exam</option>
                <option value="finalExam">Final Exam</option>
            </select>
            
            <br><br>
            
            <label for="courseName">Course Name:</label>&nbsp&nbsp&nbsp&nbsp  
            <?php
                $cou_teacher="select * from  teacher where TEACHER_ID='$T_ID' ";
                $r_cou=mysqli_query($con,$cou_teacher);
                if($row=mysqli_fetch_assoc($r_cou))
                {
                $c_id=$row["COURSE_ID"];
                }
                
                $cou="select * from  course where COURSE_ID='$c_id' ";
                $cou_result=mysqli_query($con,$cou);
                if($row=mysqli_fetch_assoc($cou_result))
                {
                $c_name=$row["COURSE_NAME"];
                echo $c_name; 
                }
            ?>
            
            <br><br>
            
            <button name="submit" id="requestEvaluationButton" class="btn btn-primary" style="width: 20%; " >Request Evaluation</button>
            
            <br><br>
            
            <div class="form-group">
                <div class="col-md-10">
                <textarea class="form-control" id="resultSpace" name="question" id="question" rows="4" readonly>   <?php  ?> </textarea>
                </div>
            </div>
            </form>
        </div>
       <script>
            var toSendRequest = document.getElementById('toSendRequest');
            var resultSpace = document.getElementById('resultSpace');
        </script>
        
        </div>      
        </div>
    </div>
<script src="asset/jquery/jquery.min.js"></script>
<script src="asset/js/adminlte.js"></script>
</body>
</html>
<?php  

// Fetch all the questions from the database
$query = "select * from question where TEACHER_ID='$T_ID' and STATUS='new' ";
$result = mysqli_query($con, $query);
$Q_exist=mysqli_num_rows($result);
if($Q_exist>0)
{	
    echo "<script> 
    toSendRequest.style.display = 'block'; 
        </script>";

} 
if(isset($_POST['submit'])){
    $selectedExamType = $_POST['examType'];
    if ($selectedExamType === 'midExam') {
        $e_type= 'Mid Exam';
    } elseif ($selectedExamType === 'finalExam') {
        $e_type= 'Final Exam';
    }
    $check_ExamExist="select * from  exam_bank where TEACHER_ID='$T_ID' and EXAM_TYPE='$e_type' and REQUEST_EVALUATION='asked' ";
    $r_check_Exam=mysqli_query($con,$check_ExamExist);
    $Exam_exist=mysqli_num_rows($r_check_Exam);
    if($Exam_exist>0)
    {
        echo "<script>alert('The request is already submitted!')</script>";
    }
    else{
        $sql="insert into exam_bank (TEACHER_ID,COURSE_ID,COURSE_NAME,EXAM_TYPE,REQUEST_EVALUATION) values ('$T_ID','$c_id','$c_name','$e_type','asked')";
        mysqli_query($con,$sql); 
        echo "<script> document.getElementById('resultSpace').value = ' The request evaluation is sent : Pending ';  </script>";
    }
    
}


}
?>