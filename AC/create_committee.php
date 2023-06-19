<?php 
session_start(); 
if($_SESSION['login']==='none'){
	
	echo "<script>window.open('../index.php?not_loggined=Please login!','_self')</script>";
}
else {
    require("../DBconnection.php");
    $db = Database::getInstance();
    $con = $db->getConnection();

    if(isset($_POST['submitForm'])){
        $cid=$_POST['cid'];   
        $fname=$_POST['fname'];
        $mname=$_POST['mname'];
        $lname=$_POST['lname'];
        $selectedCourse = $_POST['course'];
        $t= "SELECT * FROM teacher WHERE COURSE_ID ='$selectedCourse' ";
        $r_t = mysqli_query($con, $t);
        if (!$r_t) {
            echo "Error: " . mysqli_error($con);
        } else {
            while ($row = mysqli_fetch_array($r_t)) {
            $t_c_id= $row['TEACHER_ID']; 
        }
        if($t_c_id==$cid){
            echo "<script>alert('Can not add Committee to this Course')</script>";
        }
        else{
            $query = "INSERT INTO exam_committee (COMMITTEE_ID,F_NAME, M_NAME,L_NAME,ASSIGN_COURSE_ID)
              VALUES ('$cid','$fname', '$mname','$lname','$selectedCourse' )";
            $re = mysqli_query($con, $query);
            if (!$re) {
                echo "Error: " . mysqli_error($con);
            }
            else{
                echo "<script>alert('Account Created Successfully')</script>";
            }      
        }   
    }
}
	?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>create committee</title>
    <script src="code.jquery.com_jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="bootstrap-4.6.1-dist/css/bootstrap.css" >
    <script src="bootstrap-4.6.1-dist/js/bootstrap.bundle.js"></script>
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
            <section class="content">  
                        <br<br>
            <h5> Create Exam Committee Account </h5><br>
            <div class="formMargin" id="formM" style="">
            <form  action="create_committee.php" method="post" >
                <div class="form-group">
                    <label for="course">Select course</label>
                    <select id="course" name="course" class="form-control">
                        <option value="" selected>Select the course </option>
                            <?php
                               
                                    $q= "SELECT * FROM course ";
                                    $result = mysqli_query($con, $q);
                                    if (!$result) {
                                        echo "Error: " . mysqli_error($con);
                                    } else {
                                        // Loop through each record
                                        while ($row = mysqli_fetch_array($result)) {
                                            $c_name= $row['COURSE_NAME'];
                                            $c_id= $row['COURSE_ID']; 
                                            
                                            $qEXAM_C= "SELECT * FROM exam_committee where ASSIGN_COURSE_ID='$c_id'  ";
                                            $committee_info = mysqli_query($con, $qEXAM_C);
                                            $committee_exist=mysqli_num_rows($committee_info);
                                            if($committee_exist>0)
                                            {     
                                            }else {
                                                  
                            ?>
                        <option value="<?php echo $c_id; ?>"><?php echo $c_name; ?></option>
                        <?php     }
                                }
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group"  >
                  <label for="questionPoints">Committee ID</label>
                  <input type="number" class="form-control" name="cid" id="questionPoints" placeholder="Enter first choice" required style="width: 100% !important;">
               </div>
               <div class="form-group"  >
                  <label for="questionPoints">First Name</label>
                  <input type="text" class="form-control"name="fname" id="questionPoints" placeholder="Enter first name" required>
               </div>
               <div class="form-group"  >
                  <label for="questionPoints">Middle Name</label>
                  <input type="text" class="form-control" name="mname" id="questionPoints" placeholder="Enter Middle name" required>
               </div>
               <div class="form-group"  >
                  <label for="questionPoints">Last Name</label>
                  <input type="text" class="form-control" name="lname" id="questionPoints" placeholder="Enter Last name" required>
               </div>
               
                <button type="submit" name="submitForm" class="btn btn-primary" style="width: 23% !important;" >Add Account</button>
            </form>
            </div>
            </section>       
         </div>
        </div>
      </div>
   </body>
</html>
<?php } ?>