<?php 
session_start(); 
require("../DBconnection.php");
$db = Database::getInstance();
$con = $db->getConnection();

if ($_SESSION['login'] === 'none') {
    echo "<script>window.open('../index.php?not_loggined=Please login!','_self')</script>";
} else {
    if (isset($_POST['submit'])) {
        $file = $_FILES['fileInput']['tmp_name'];
        $fileContent = file_get_contents($file);
        $username = $_SESSION['login'];
        $teacher_id = substr($username, -4);
        $status = "new";
        $questionType = $_POST['questionType'];
     
       if ($questionType === 'trueORFalse') {
            if (isValidFormatTrueFalse($fileContent)) {
                $questions = trueFalseParseQuestions($fileContent);
                $questionPoints = $_POST['questionPoints'];     
                foreach ($questions as $question) {
                    $qTF = mysqli_real_escape_string($con, $question['question']);
                    $answer = mysqli_real_escape_string($con, $question['answer']);
                    $optionA='true';
                    $optionB='false';
        
                    $query = "INSERT INTO question (QUESTION_TYPE, QUESTION, CHOICE1, CHOICE2, QUESTION_POINT, ANSWER, TEACHER_ID, STATUS)
                        VALUES ('$questionType', '$qTF', '$optionA', '$optionB', '$questionPoints', '$answer', '$teacher_id', '$status')";
        
                    if (!mysqli_query($con, $query)) {
                        echo "Error inserting question: " . mysqli_error($con);
                    } 
                }
                echo "<script>alert('File entered successfully')</script>";
            } else {
                echo " <script>alert('Invalid file. Please make sure the file matches the required format.') </script>";
            }
        } 
        else if ($questionType === 'multipleChoice') {
            if (isValidFormatMultipleChoice($fileContent)) {
                $questions = multipleParseQuestions($fileContent);
                $questionPoints = $_POST['questionPoints'];
                foreach ($questions as $question) {
                    $q = mysqli_real_escape_string($con, $question['question']);
                    $optionA = mysqli_real_escape_string($con, $question['optionA']);
                    $optionB = mysqli_real_escape_string($con, $question['optionB']);
                    $optionC = mysqli_real_escape_string($con, $question['optionC']);
                    $optionD = mysqli_real_escape_string($con, $question['optionD']);
                    $answer = mysqli_real_escape_string($con, $question['answer']);
                    $query = "INSERT INTO question (QUESTION_TYPE, QUESTION, CHOICE1, CHOICE2, CHOICE3, CHOICE4, QUESTION_POINT, ANSWER, TEACHER_ID, STATUS)
                            VALUES ('$questionType', '$q', '$optionA', '$optionB', '$optionC', '$optionD', '$questionPoints', '$answer', '$teacher_id', '$status')";      
                    $result = mysqli_query($con, $query);
        
                    if (!$result) {
                        echo "Error: " . mysqli_error($con);
                    }
                }
        
                echo "<script>alert('File entered successfully')</script>";
            } else {
                echo "<script>alert('Invalid file format')</script>";
            }
        }
               
        else if ($questionType === 'fillInTheBlank') {
            if (isValidFormatFillInBlank($fileContent)) {
                $questions = fillInBlankParseQuestions($fileContent);
        
                foreach ($questions as $question) {
                    $qFB = mysqli_real_escape_string($con, $question['question']);
                    $answer = mysqli_real_escape_string($con, $question['answer']);
                    $point = floatval($question['point']);
        
                    $query = "INSERT INTO question (QUESTION_TYPE, QUESTION, QUESTION_POINT, ANSWER, TEACHER_ID, STATUS)
                            VALUES ('$questionType', '$qFB', '$point', '$answer', '$teacher_id', '$status')";
                    if (!mysqli_query($con, $query)) {
                        echo "Error inserting question: " . mysqli_error($con);
                    }
                }
                echo "<script>alert('File entered successfully')</script>";
            } else {
                echo "Invalid file format. Please make sure the file matches the required format.";
            }
        }
        else if ($questionType === 'Essay') {
            if (isValidFormatEssay($fileContent)) {
                $questions = essayParseQuestions($fileContent);
    
                foreach ($questions as $question) {
                    $qE = mysqli_real_escape_string($con, $question['question']);
                    $point = mysqli_real_escape_string($con, $question['point']);
    
                    $query = "INSERT INTO question (QUESTION_TYPE, QUESTION, QUESTION_POINT, TEACHER_ID, STATUS)
                        VALUES ('$questionType', '$qE', '$point', '$teacher_id', '$status')";
    
                    $result = mysqli_query($con, $query);
    
                    if (!$result) {
                        echo "Error: " . mysqli_error($con);
                    }
                }
    
                echo "<script>alert('File entered successfully')</script>";
            } else {
                echo "<script>alert('Invalid file format')</script>";
            }
        }
        else {
            echo "Invalid question type selected";
        }
    }
}

function isValidFormatMultipleChoice($fileContent) {
    $pattern = "/^Q\.\s.+\nA\.\s.+\nB\.\s.+\nC\.\s.+\nD\.\s.+\nanswer\.\s.+/m";
    return preg_match($pattern, $fileContent);
}

function multipleParseQuestions($fileContent) {
    $pattern = "/^Q\.\s(.+)\nA\.\s(.+)\nB\.\s(.+)\nC\.\s(.+)\nD\.\s(.+)\nanswer\.\s(.+)/m";
    preg_match_all($pattern, $fileContent, $matches, PREG_SET_ORDER);

    $questions = [];

    foreach ($matches as $match) {
        $question = [
            'question' => $match[1],
            'optionA' => $match[2],
            'optionB' => $match[3],
            'optionC' => $match[4],
            'optionD' => $match[5],
            'answer' => $match[6]
        ];

        $questions[] = $question;
    }

    return $questions;
}

function isValidFormatTrueFalse($fileContent) {
    $pattern = "/^Q\.\s.+(\nanswer\.\s(true|false))+/m";
    return preg_match($pattern, $fileContent);
}

function trueFalseParseQuestions($fileContent) {
    $pattern = "/^Q\.\s(.+)\nanswer\.\s(true|false)/m";
    preg_match_all($pattern, $fileContent, $matches, PREG_SET_ORDER);

    $questions = [];

    foreach ($matches as $match) {
        $question = [
            'question' => $match[1],
            'answer' => $match[2]
        ];

        $questions[] = $question;
    }

    return $questions;
}

function isValidFormatFillInBlank($fileContent) {
    $pattern = "/^Q\.\s.+\nanswer\.\s.+\npoint\.\s\d+(\.\d+)?+/m";
    return preg_match($pattern, $fileContent);
}

function fillInBlankParseQuestions($fileContent) {
    $pattern = "/^Q\.\s(.+)\nanswer\.\s(.+)\npoint\.\s(\d+(\.\d+)?)+/m";
    preg_match_all($pattern, $fileContent, $matches, PREG_SET_ORDER);

    $questions = [];

    foreach ($matches as $match) {
        $question = [
            'question' => $match[1],
            'answer' => $match[2],
            'point' => $match[3]
        ];

        $questions[] = $question;
    }

    return $questions;
}

function isValidFormatEssay($fileContent) {
    $pattern = "/^Q\.\s.+?\npoint\.\s\d+(?:\.\d+)?+/m";
    return preg_match($pattern, $fileContent);
}

function essayParseQuestions($fileContent) {
    $pattern = "/^Q\.\s(.+?)\npoint\.\s(\d+(?:\.\d+)?)+/m";
    preg_match_all($pattern, $fileContent, $matches, PREG_SET_ORDER);

    $questions = [];

    foreach ($matches as $match) {
        $question = [
            'question' => $match[1],
            'point' => $match[2]
        ];

        $questions[] = $question;
    }

    return $questions;
}


?>

<!DOCTYPE html>
<html>
<head>
    <title>Exam Preparation</title>
</head>
<body>
<div class="wrapper">
    <?php
    require("sidebar.php");
    ?>

    <div class="content-wrapper">
        <br><br><br>

        <div class="container">
            <h2>Exam Preparation</h2><br>
            <form onsubmit="return validate()" action="#" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="questionType">Question Type</label>
                    <select class="form-control" id="questionType" name="questionType">
                        <option value="" selected>Select type of question</option>
                        <option value="trueORFalse">True or False</option>
                        <option value="multipleChoice">Multiple Choice</option>
                        <option value="fillInTheBlank">Fill in the Blank</option>
                        <option value="Essay">Essay</option>
                    </select>
                </div>
                <div class="form-group" id="Question_Point"  >
                  <label for="questionPoints">Question Point</label>
                  <input class="form-control" id="questionPoints" name="questionPoints" min="1" value="" placeholder="Enter the point" required>
                  <div id="checkPoint" style="color: red"></div>
               </div>
                <div class="form-group">
                    <label>Upload Question File</label><br>
                    <input class=" choice" type="file" id="fileInput" name="fileInput" accept=".txt" required>
                </div>
                <br><br>
                <button type="submit" id="addQuestionButton" name="submit" class="btn btn-success"
                        style="width: 20%;">Submit Question
                </button>
            </form>
            <script type="text/javascript">
                var questionPoints = document.getElementById('Question_Point');
                var questionTypeSelect = document.getElementById('questionType');
                questionTypeSelect.addEventListener('change', function() {
                    var selectedType = questionTypeSelect.value;
                    if (selectedType === 'fillInTheBlank' || selectedType === 'Essay') {
                        document.getElementById("questionPoints").setAttribute("disabled", "disabled");
                    } else {
                        document.getElementById("questionPoints").removeAttribute("disabled");
                    }
                });
                function validate() {
                    var questionType = document.getElementById('questionType').value;
                    var questionPoint = document.getElementById('questionPoints');
                    var fileInput = document.getElementById('fileInput');

                    if (questionType === "" || fileInput.files.length === 0) {
                        alert('Please select a question type and upload a file.');
                        return false;
                    }
                    else if ((questionType === 'multipleChoice' || questionType === 'trueORFalse') && isNaN(questionPoint.value)) {
                        alert('Please enter a valid question point.');
                        return false;
                    }
                    return true;  
                }
            </script>

           
            <br><br>
        </div>
    </div>
</div>
</body>
</html>
