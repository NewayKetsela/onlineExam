<?php 
session_start();
require("DBconnection.php");
    $db = Database::getInstance();
    $con = $db->getConnection();
    $username = $_SESSION['login'];
    $role = $_SESSION['user'];
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
               $stmt->bind_result($role, $uname, $hashedPassword);
               $stmt->fetch();
               if (password_verify($currentPassword, $hashedPassword)) {   
                  $newPassword = $_POST['new_password'];
                  $confirmPassword = $_POST['confirm_password'];

                  // If the new password is valid and matches the confirmed password
                  if ($newPassword === $confirmPassword) {
                        $newPassword = password_hash($newPassword,PASSWORD_DEFAULT);
                        $query="update account set PASSWORD='$newPassword' where USERNAME='$username' ";
                        $result = mysqli_query($con, $query);
                        echo "<script>alert('Password updated successfully!')</script>";
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
                  echo "<script>alert('Incorrect password! Please try again.')</script>";
               }
            } 
            
            $stmt->close();
      } 
   
   }
?>

<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <title>Change Password</title>
   <link rel="stylesheet" href="bootstrap-4.6.1-dist/asset/fontawesome/css/all.min.css">
   <link rel="stylesheet" href="bootstrap-4.6.1-dist/asset/css/adminlte.min.css">
   <link rel="stylesheet" href="bootstrap-4.6.1-dist/asset/css/style.css">
   <style> 
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
      button[type="submit"] {
         display: block;
         width: 100%;
         padding: 10px;
         color: white;
         border: none;
         border-radius: 4px;
         cursor: pointer;
      }
   </style>
</head>
<body style="background: #e5e5e5;">
   <div class="container" ><br>
      <h2>Update Password</h2><br>
      <form onsubmit="return validate()"  action="update_password.php" method="POST">
         <div class="form-group">
            <label for="current_password">Current Password</label>
            <input type="password" id="current_password" name="current_password" placeholder="Enter current password" required>
         </div>
         <div class="form-group">
            <label for="new_password">New Password</label>
            <input type="password" id="new_password" name="new_password" placeholder="Enter new password" required>
         </div>
         <div class="form-group">
            <label for="confirm_password">Confirm Password</label>
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm password" required><br>
             <div id="checkPass" style="color: red"></div>
         </div>
         
         <button type="submit" name="submit" class="btn btn-primary"  >Update Password</button>
      </form>
   </div>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   <script>
      function validate(){
         const checkPass = document.getElementById('checkPass');
         const newPasswordInput = document.getElementById('new_password');
         const confirmPasswordInput = document.getElementById('confirm_password');
         const current_password = document.getElementById('current_password');
         if (newPasswordInput.value.length<6 || current_password.value.length<6 || confirmPasswordInput.value.length<6) {
                document.getElementById("checkPass").innerHTML="password should be greater than 6 characters."
                return false;
          }
         else if (newPasswordInput.value !== confirmPasswordInput.value) {
            document.getElementById("checkPass").innerHTML="New password and confirm password does not match."
            return false;
         } else {
            return true;
         }
      }
            
   </script>

</body>
</html>
