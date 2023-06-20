
<?php 
session_start(); 
$t_id = $_GET['TEACHER_ID'];
require("../DBconnection.php");
$db = Database::getInstance();
$con = $db->getConnection();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Online Examination System</title>
    <script src="code.jquery.com_jquery-3.6.0.min.js"></script>
    <script src="bootstrap-4.6.1-dist/js/bootstrap.bundle.js"></script>
    <link rel="stylesheet" href="bootstrap-4.6.1-dist/css/bootstrap.css" >
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../bootstrap-4.6.1-dist/asset/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../bootstrap-4.6.1-dist/asset/css/adminlte.min.css">
    <link rel="stylesheet" href="../bootstrap-4.6.1-dist/asset/css/style.css">
    <style type="text/css">
        td a.btn {
            font-size: 0.7rem;
        }
        td p {
            padding-left: 0.5rem !important;
        }
        th {
            padding: 1rem !important;
        }
        table tr td {
            padding: 0.3rem !important;
            font-size: 13px;
        }
        .bg1 {
            background-color: rgb(160,20,79);
        }
        .bg2 {
            background-color: rgb(4,91,98);
        }
        .bg3 {
            background-color: rgb(20,83,154);
        }
        .bg4 {
            background-color: rgb(109,65,161);
        }
        .question {
            margin-bottom: 20px;
        }
        .options {
            margin-bottom: 10px;
        }
        .btn {
            margin-right: 10px;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light fixed-top" style="background-color: rgba(24,57,46);">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="#" style="color:white;"><label>Your Username: 
                <?php
                if (isset($_SESSION['login'])) {
                    $username = $_SESSION['login'];
                    $role = $_SESSION['user'];
                    echo $username;
                }
                ?>  
                </label></a>
            </li>
        </ul>
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="../logout.php">
                    <i class="fas fa-power-off" style="color: rgb(211, 209, 207);" title="Logout"></i>
                </a>
            </li>
        </ul>
    </nav>

    <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: rgba(39,93,43);"></aside>

    <div class="content-wrapper">
        <br><br><br>
        <!-- Main content -->
        <div class="container">
            <form id="quizForm" method="post">
                <?php
                $questionsPerPage = 2;
                $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
                $offset = ($currentPage - 1) * $questionsPerPage;

                $q = "SELECT * FROM question WHERE TEACHER_ID = '$t_id' AND STATUS = 'new' LIMIT $offset, $questionsPerPage";
                $result = mysqli_query($con, $q);

                if (!$result) {
                    echo "Error: " . mysqli_error($con);
                } else {
                    $questionCounter = 0;
                    while ($row = mysqli_fetch_array($result)) {
                        $q_type = $row['QUESTION_TYPE'];
                        $question = $row['QUESTION'];
                        $ch1 = $row['CHOICE1'];
                        $ch2 = $row['CHOICE2'];
                        $ch3 = $row['CHOICE3'];
                        $ch4 = $row['CHOICE4'];
                        $ans= $row['ANSWER'];
                        $q_point= $row['QUESTION_POINT'];
                ?>
                <div class="question">
                    <?php  if($q_type=='trueORFalse'){  
                    ?>
                    <h4>Question:</h4>
                    <p><?php echo $question; ?></p>
                    <div class="options">
                        <label style="font-weight: normal;">
                            <input type="radio" name="question_<?php echo $questionCounter; ?>" value="1"> A.
                            <?php echo $ch1; ?>
                        </label>
                        <br>
                        <label style="font-weight: normal;">
                            <input type="radio" name="question_<?php echo $questionCounter; ?>" value="2"> B.
                            <?php echo $ch2; ?>
                        </label>
                    </div>
                    <?php  }  ?>
                </div>

                <div class="question">
                    <?php  if($q_type=='multipleChoice'){  
                    ?>
                    <h4>Question:</h4>
                    <p><?php echo $question; ?></p>
                    <div class="options">
                        <label style="font-weight: normal;">
                            <input type="radio" name="question_<?php echo $questionCounter; ?>" value="1"> A.
                            <?php echo $ch1; ?>
                        </label>
                        <br>
                        <label style="font-weight: normal;">
                            <input type="radio" name="question_<?php echo $questionCounter; ?>" value="2"> B.
                            <?php echo $ch2; ?>
                        </label>
                        <br>
                        <label style="font-weight: normal;">
                            <input type="radio" name="question_<?php echo $questionCounter; ?>" value="3"> C.
                            <?php echo $ch3; ?>
                        </label>
                        <br>
                        <label style="font-weight: normal;">
                            <input type="radio" name="question_<?php echo $questionCounter; ?>" value="4"> D.
                            <?php echo $ch4; ?>
                        </label>
                    </div>
                    <?php  }  ?>
                </div>

                <div class="question">
                    <?php if($q_type=='fillInTheBlank'){
                      ?>
                    <h4>Question:</h4>
                    <p><?php echo $question; ?></p>
                    <div id="answerContainer" >
                        <label for="answer" >Answer:</label>
                        <input type="text" class="form-control" id="answer" name="question_<?php echo $questionCounter; ?>" placeholder="Enter the answer">
                     </div><br>
                     <?php  }  ?>
                </div>
                
                <div class="question">
                    <?php if($q_type=='Essay'){
                      ?>
                    <h4>Question:</h4>
                    <p><?php echo $question; ?></p>
                    <div id="questionContainer" class="form-group">
                        <label >Answer:</label>
                        <textarea class="form-control" placeholder="Enter the answer" name="question"  rows="3"></textarea>
                    </div>
                     <?php  }  ?>
                </div>

                <?php
                        $questionCounter++;
                    }
                }

                // Check if there are more questions on the next page
                $nextPageOffset = $offset + $questionsPerPage;
                $qNextPage = "SELECT * FROM question WHERE TEACHER_ID = '$t_id' AND STATUS = 'new' LIMIT $nextPageOffset, $questionsPerPage";
                $resultNextPage = mysqli_query($con, $qNextPage);
                $hasNextPage = mysqli_num_rows($resultNextPage) > 0;
                ?>
                <br>
                <div class="navigation-buttons">
                    <?php if ($currentPage > 1) { ?>
                    <a href="take_exam.php?TEACHER_ID=<?php echo $t_id; ?>&page=<?php echo $currentPage - 1; ?>"  style="margin-right: 300px;">
                        <button type="button" class="btn btn-primary">Back Page</button>
                    </a>
                    <?php } ?>
                    <?php if ($hasNextPage) { ?>
                    <a href="take_exam.php?TEACHER_ID=<?php echo $t_id; ?>&page=<?php echo $currentPage + 1; ?>">
                        <button type="button" class="btn btn-primary">Next Page</button>
                    </a>
                    <?php } ?>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
