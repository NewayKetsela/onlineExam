<?php 
session_start();
require("DBconnection.php");
    $db = Database::getInstance();
    $con = $db->getConnection();
 class update_password{
    function updatePass(){
     // Check if the user is logged in and the password update form is submitted
        if (isset($_SESSION['login']) && isset($_POST['update_pass'])) {
            // Retrieve the logged-in user's information from the session
            $username = $_SESSION['login'];
            $role = $_SESSION['user'];
            $query = "SELECT ROLE, USERNAME, PASSWORD FROM account WHERE USERNAME=? LIMIT 1";
            $stmt = $mysqli->prepare($query);
            if (!$stmt) {
                trigger_error("Error in query: " . mysqli_connect_error(), E_USER_ERROR);
            } else {
                $stmt->bind_param('s', $username);
                $stmt->execute();
                $stmt->store_result();
                
                if ($stmt->num_rows === 1) {
                    $stmt->bind_result($role, $uname, $hashedPassword);
                    $stmt->fetch();
                    if (password_verify($pass, $hashedPassword)) {
                                    // Validate and sanitize the new password input
                        $currentPassword = $_POST["current_password"];
                        $newPassword = $_POST['new_password'];
                        $confirmPassword = $_POST['confirm_password'];
                        // Perform any necessary password validation checks here

                        // If the new password is valid and matches the confirmed password
                        if ($newPassword === $confirmPassword) {
                            $newPassword = password_hash($newPassword,PASSWORD_DEFAULT);
                            $query="update account set PASSWORD='$newPassword' where USERNAME='$username' ";
                            $result = mysqli_query($con, $query);
                            echo "<script>alert('Password updated successfully!')</script>";

                            // Redirect the user to the appropriate page based on their role
                            if ($role == 'Admin') {
                                 header('location: admin/index.php');
                            } else if ($role == 'Student') {
                                header('location: Student/index.php');
                            } else if ($role == 'Teacher') {
                                header('location: Teacher/index.php');
                            } else if ($role == 'AC') {
                                header('location: AC/index.php');
                            } else if ($role == 'Exam_Committee') {
                                header('location: Exam_Committee/index.php');
                            } else {
                                header('location: index.php');
                            }
                            exit(); // Stop further execution
                        } else {
                            echo "<script>alert('New password and confirm password do not match! Please try again.')</script>";
                        }
                    } else {
                        echo "<script>alert('Invalid password! Please try again.')</script>";
                    }
                } 
                
                $stmt->close();
            } 
        
        }
   }
}
?>

<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <title>Change Password</title>
   <style>
      body {
         font-family: Arial, sans-serif;
         padding: 20px;
      }
      .container {
         max-width: 400px;
         margin: 0 auto;
      }
      .form-group {
         margin-bottom: 20px;
      }
      label {
         display: block;
         font-weight: bold;
         margin-bottom: 5px;
      }
      input[type="password"] {
         width: 100%;
         padding: 10px;
         border: 1px solid #ccc;
         border-radius: 4px;
      }
      input[type="submit"] {
         display: block;
         width: 100%;
         padding: 10px;
         background-color: #4CAF50;
         color: white;
         border: none;
         border-radius: 4px;
         cursor: pointer;
      }
   </style>
</head>
<body>
   <div class="container">
      <h1>Update Password</h1>
      <form method="POST" action="" id="updatePasswordForm">
         <div class="form-group">
            <label for="current_password">Current Password:</label>
            <input type="password" id="current_password" name="current_password" required>
         </div>
         <div class="form-group">
            <label for="new_password">New Password:</label>
            <input type="password" id="new_password" name="new_password" required>
         </div>
         <div class="form-group">
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
            <p class="error-message" id="passwordMatchError" style="display: none; color: red;">New password and confirm password do not match.</p>
         </div>
         <input type="submit" name="update_pass" value="Update Password">
      </form>
   </div>

   <script>
         var updatePasswordForm = document.getElementById('updatePasswordForm');
         var newPasswordInput = document.getElementById('new_password');
         var confirmPasswordInput = document.getElementById('confirm_password');
         var passwordMatchError = document.getElementById('passwordMatchError');

         updatePasswordForm.addEventListener('submit', function(event) {
            if (newPasswordInput.value !== confirmPasswordInput.value) {
               event.preventDefault();
               passwordMatchError.style.display = 'block';
            } else {
               passwordMatchError.style.display = 'none';
            }
         });
      </script>

</body>
</html>
