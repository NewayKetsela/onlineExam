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
        if (!isset($_SESSION['request'])) {
            $_SESSION['request'] = 0;
         
         }
	?>

<html lang="en"> 
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exam Evaluation Request</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../bootstrap-4.6.1-dist/asset/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../bootstrap-4.6.1-dist/asset/css/adminlte.min.css">
    <link rel="stylesheet" href="../bootstrap-4.6.1-dist/asset/css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
            <br> <br>
            <div class="input-group">
                <label for="ExamTime" >Exam Time:</label>&nbsp&nbsp&nbsp&nbsp 
                <input type="text" id="ExamTime" name="ExamTime" class="" placeholder="Enter exam time" style="width: 150px;">
                <script>
                    const examTimeInput = document.getElementById('ExamTime');
                        const currentValue = this.value;
                        if( currentValue ==='' ){
                            alert('Question submitted!');
                        }

                        // Remove any non-digit characters
                        const cleanedValue = currentValue.replace(/\D/g, '');

                        // Format the value as HH:MM
                        let formattedValue = '';
                        if (cleanedValue.length >= 2) {
                            formattedValue += cleanedValue.substr(0, 2);
                        }
                        if (cleanedValue.length >= 4) {
                            formattedValue += ':' + cleanedValue.substr(2, 2);
                        }

                        // Update the input field with the formatted value
                        this.value = formattedValue;
                </script>


            </div>
            
            <br><br>
            
            <button name="submit" id="requestEvaluationButton" class="btn btn-primary" style="width: 20%; " >Request Evaluation</button>
            
            <br><br>
            
            <div class="form-group">
                <div class="col-md-10">
                <textarea class="form-control" id="resultSpace" name="question" id="question" rows="4" readonly >
                <?php
                $check_ExamExist="select * from  exam_bank where TEACHER_ID='$T_ID' and REQUEST_EVALUATION='asked'  ";
                $r_check_Exam=mysqli_query($con,$check_ExamExist);
                $Exam_exist=mysqli_num_rows($r_check_Exam);

                $check_ExamExistAS="select * from  exam_bank where TEACHER_ID='$T_ID' and ( REQUEST_EVALUATION='accepted' or REQUEST_EVALUATION='rejected') and STATUS='not taken' ";
                $r_check_ExamAS=mysqli_query($con,$check_ExamExistAS);
                $Exam_existAS=mysqli_num_rows($r_check_ExamAS);
                if($Exam_exist>0)
                   {
                        echo "\nThe request evaluation has been sent : Pending";
                   }
                else if($Exam_existAS>0){
                    while($row=mysqli_fetch_assoc($r_check_ExamAS))
                        {
                        $com=$row["COMMENT"];
                        $r_eva=$row["REQUEST_EVALUATION"];
                        echo "\nThe request evaluation is " . $r_eva . "\nCOMMENT :  " . $com;
                       
                    }
                }
                 ?>
                </textarea>
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
<script src="../bootstrap-4.6.1-dist/asset/jquery/jquery.min.js"></script>
<script src="../bootstrap-4.6.1-dist/asset/js/adminlte.js"></script>
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
    // echo "<script> 
    //     if(ExamTime == ''){
    //     alert('The request is already submitted!')  
    //     }</script>";
    
    $e_time=$_POST['ExamTime'];
    $selectedExamType = $_POST['examType'];
    if ($selectedExamType === 'midExam') {
        $e_type= 'Mid Exam';
    } elseif ($selectedExamType === 'finalExam') {
        $e_type= 'Final Exam';
    }
    $check_ExamExist="select * from  exam_bank where TEACHER_ID='$T_ID' and EXAM_TYPE='$e_type' and (REQUEST_EVALUATION='asked' or REQUEST_EVALUATION='accepted') ";
    $r_check_Exam=mysqli_query($con,$check_ExamExist);
    $Exam_exist=mysqli_num_rows($r_check_Exam);
    if($Exam_exist>0)
    {
        echo "<script>alert('The request is already submitted!')</script>";

    }
    else{
        $sql="insert into exam_bank (TEACHER_ID,COURSE_ID,COURSE_NAME,EXAM_TYPE,EXAM_TIME,REQUEST_EVALUATION) values ('$T_ID','$c_id','$c_name','$e_type','$e_time','asked')";
        mysqli_query($con,$sql); 
        echo "<script> document.getElementById('resultSpace').value = ' The request evaluation has been sent : Pending ';  </script>";
    }
    if($Exam_exist>0){
        $_SESSION['request'] = 0;
    }else{
        $_SESSION['request'] = $T_ID;
    }
    
}


}
?>