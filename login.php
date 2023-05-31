<?php
session_start();
class userLogin{

	function login($uname, $pass) {
        $dbb = Database::getInstance();
        $mysqli = $dbb->getConnection();
        $query = "SELECT ROLE, USERNAME, PASSWORD FROM account WHERE USERNAME=? LIMIT 1";
        $stmt = $mysqli->prepare($query);
        
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