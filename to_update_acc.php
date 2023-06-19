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
    $A_ID = substr($username, -4);
    if (isset($_POST['submit'])) {
        $query = "SELECT ROLE, USERNAME, PASSWORD FROM account WHERE USERNAME=? LIMIT 1";
        $stmt = $con->prepare($query);
        if (!$stmt) {
              trigger_error("Error in query: " . mysqli_connect_error(), E_USER_ERROR);
        } else {
              $stmt->bind_param('s', $username);
              $stmt->execute();
              $stmt->store_result();
              $currentPassword = $_POST["current_password"];
              if ($stmt->num_rows === 1) {
                 $stmt->bind_result( $role, $uname, $hashedPassword);
                 $stmt->fetch();
                 if (password_verify($currentPassword, $hashedPassword)) {   
                    $newPassword = $_POST['new_password'];
                    $confirmPassword = $_POST['confirm_password'];
                    // If the new password is valid and matches the confirmed password
                    if ($newPassword === $confirmPassword) {
                          $newPassword = password_hash($newPassword,PASSWORD_DEFAULT);
                          $query="update account set PASSWORD='$newPassword' where USERNAME='$username' ";
                          $result = mysqli_query($con, $query);
                          if (!$result) {
                            echo "Error: " . mysqli_error($con);
                        } else {
                          echo "<script>alert('Password updated successfully!')</script>";
                        }
                    } else {
                          echo "<script>alert('New password and confirm password do not match! Please try again.')</script>";
                    }
                 } else {
                    echo "<script>alert('Incorrect password! Please try again.')</script>";
                 }
              } 

        } 
     
     }
    }

	?>

    
