<?php 
session_start(); 
if($_SESSION['login']==='none'){
	
	echo "<script>window.open('../index.php?not_loggined=Please login!','_self')</script>";
}
else {
    $e_id=$_GET['COMMITTEE_ID'];
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

                 <h4 > Edit Committee information </h4><br>
                    <?php
                    $query = "select * from exam_committee where COMMITTEE_ID='".$e_id."'";
                    $result = mysqli_query($con, $query);
                    // Loop through each records 
                    while($row = mysqli_fetch_array($result))
                    {
                        $f_name = $row['F_NAME'];
                        $m_name = $row['M_NAME'];
                        $l_name = $row['L_NAME'];
                        $A_course_id = $row['ASSIGN_COURSE_ID']; 
                            
                    }
                  ?>
                <form method="post" >
                    
                   <div class="row">
                        <div class="col-md-2">
                            <label for="choice" class="choice-label">COMMITTEE ID:</label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" id="choice2" name="comm_id" class="form-control choice" value="<?php echo $e_id; ?>" placeholder="Enter committee ID">
                        </div>
                    </div>
                    <br>
                    <div class="choice-input" id="ch12">
                        <div class="row">
                        <div class="col-md-2">
                            <label for="choice" class="choice-label">FIRST NAME:</label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" id="choice1" name="fname" class="form-control choice" value="<?php echo $f_name; ?>" placeholder="Enter first name">
                        </div>
                    </div>
                        <br>
                    <div class="row">
                        <div class="col-md-2">
                            <label for="choice" class="choice-label">MIDDLE NAME:</label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" id="choice2" name="mname" class="form-control choice" value="<?php echo $m_name; ?>" placeholder="Enter middle namne">
                        </div>
                    </div>
                        <br>
                    <div class="row">
                        <div class="col-md-2">
                            <label for="choice" class="choice-label">LAST NAME:</label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" id="choice3" name="lname" class="form-control choice" value="<?php echo $l_name; ?>" placeholder="Enter last name">
                        </div>
                    </div>
                        <br>
                    <div class="row">
                        <div class="col-md-2">
                            <label for="choice" class="choice-label">ASSIGN TO COURSE</label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" id="choice4" name="courID" class="form-control choice" value="<?php echo $A_course_id; ?>" placeholder="Enter course ID">
                        </div>
                    </div>
                        <br>
                    <br>
                    <button type="submit" name="submit" class="btn btn-primary" style="width: 24% !important;" >Update Committee Account</button>  
                </form>
            </section> 
          </div>      
        <script src="../bootstrap-4.6.1-dist/asset/jquery/jquery.min.js"></script>
        <script src="../bootstrap-4.6.1-dist/asset/js/adminlte.js"></script>
    </div>
    </div>
      
   </body>
</html>
<?php 

 if(isset($_POST['submit'])){
    $comm_id = $_POST['comm_id'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $courID = $_POST['courID'];
    $check=true;

    
    if("SELECT * FROM teacher WHERE COURSE_ID ='$courID' " ){
        $t="SELECT * FROM teacher WHERE COURSE_ID ='$courID' ";
        $r_t = mysqli_query($con, $t);
        if (!$r_t) {
            echo "Error: " . mysqli_error($con);
        } else {
            while ($row = mysqli_fetch_array($r_t)) {
            $t_c_id= $row['TEACHER_ID']; 
        } }
        if($t_c_id==$comm_id){
            echo "<script>alert('Can not add Committee to this Course') </script>";
            $check=false;
        }
    }
        

        if($check){
            if( "SELECT * FROM course where COURSE_ID ='$courID' "){  
                $q= "SELECT * FROM course WHERE COURSE_ID ='$courID' ";
                $result = mysqli_query($con, $q);
                if (!$result) {
                    echo "Error: " . mysqli_error($con);
                } else {
                    $comt=mysqli_num_rows($result);
                    if($comt>0)
                    {
                        
                        $sqll = "Update exam_committee set COMMITTEE_ID='$comm_id',F_NAME='$fname',M_NAME='$mname',L_NAME='$lname',ASSIGN_COURSE_ID='$courID' where COMMITTEE_ID='$e_id' ";
                        if (mysqli_query($con, $sqll)) {
                                echo '<script>alert("Committee Account Updated Succesfully");
                                window.location=\'edit_committee.php\'; </script>';
                        } else {
                                echo "Error updating account: " . mysqli_error($con);
                            }
                    }
                    else{
                        echo "<script>alert('The Course Does Not Exist') </script>";
                    }
                }
            }
            
        }
        
}



 } 
?>
