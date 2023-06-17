<?php
session_start();
class userLogin{

	function login($uname, $pass) {
        $dbb = Database::getInstance();
        $con = $dbb->getConnection();
        $query = "SELECT ROLE, USERNAME, PASSWORD FROM account WHERE USERNAME=? LIMIT 1";
        $stmt = $con->prepare($query);
        
        if (!$stmt) {
            trigger_error("Error in query: " . mysqli_connect_error(), E_USER_ERROR);
        } else {
            $stmt->bind_param('s', $uname);
            $stmt->execute();
            $stmt->store_result();
            
            if ($stmt->num_rows === 1) {
                $stmt->bind_result($role, $username, $hashedPassword);
                $stmt->fetch();
                
                if (password_verify($pass, $hashedPassword)) {
                    $_SESSION['login'] = $username;
                    $_SESSION['user'] = $role;
                    $ID = substr($username, -4);

                    if ($role == 'Admin') {
                        $sql="select * from  admin where ADMIN_ID='$ID' ";
                        $Adinfo=mysqli_query($con,$sql);
                        while($row=mysqli_fetch_assoc($Adinfo))
                        {
                            $lname=$row["L_NAME"];
                        }
                        $B_pass=$lname.$ID;
                        if(password_verify($B_pass, $hashedPassword)){
                            header('location: update_password.php');
                        }else{
                           header('location: admin/index.php'); 
                        }            
                    } 
                    else if ($role == 'Student') {
                        $sql="select * from  student where STUDENT_ID='$ID' ";
                        $Adinfo=mysqli_query($con,$sql);
                        while($row=mysqli_fetch_assoc($Adinfo))
                        {
                            $lname=$row["L_NAME"];
                        }
                        $B_pass=$lname.$ID;
                        if(password_verify($B_pass, $hashedPassword)){
                            header('location: update_password.php');
                        }else{
                           header('location: Student/index.php');
                        }    
                    } 
                    else if ($role == 'Teacher') {
                        $sql="select * from  teacher where TEACHER_ID='$ID' ";
                        $Adinfo=mysqli_query($con,$sql);
                        while($row=mysqli_fetch_assoc($Adinfo))
                        {
                            $lname=$row["L_NAME"];
                        }
                        $B_pass=$lname.$ID;
                        if(password_verify($B_pass, $hashedPassword)){
                            header('location: update_password.php');
                        }else{
                           header('location: Teacher/index.php');
                        }    
                    } 
                    else if ($role == 'AC') {
                        $sql="select * from  AC where AC_ID='$ID' ";
                        $Adinfo=mysqli_query($con,$sql);
                        while($row=mysqli_fetch_assoc($Adinfo))
                        {
                            $lname=$row["L_NAME"];
                        }
                        $B_pass=$lname.$ID;
                        if(password_verify($B_pass, $hashedPassword)){
                            header('location: update_password.php');
                        }else{
                           header('location: AC/index.php');
                        }    
                    } 
                    else if ($role == 'Exam_Committee') {
                        $sql="select * from  exam_committee where COMMITTEE_ID='$ID' ";
                        $Adinfo=mysqli_query($con,$sql);
                        while($row=mysqli_fetch_assoc($Adinfo))
                        {
                            $lname=$row["L_NAME"];
                        }
                        $B_pass=$lname.$ID;
                        if(password_verify($B_pass, $hashedPassword)){
                            header('location: update_password.php');
                        }else{
                           header('location: Exam_Committee/index.php');
                        }

                    } else {
                        header('location: index.php');
                    }
                } else {
                    echo "<script>alert('Invalid password! Please try again.')</script>";
                }
            } else {
                echo "<script>alert('Username not found!')</script>";
            }
            
            $stmt->close();
        }
    }
        
  }
?>