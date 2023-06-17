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
        // $questionPoints = $_POST['questionPoints'];
        $questionType = $_POST['questionType'];
     
       if ($questionType === 'trueORFalse') {
        echo "<script>alert('Invalid file. Please make sure the file matches the required format.')</script>";
            // if (isValidFormatTrueFalse($fileContent)) {
            //     $questions = trueFalseParseQuestions($fileContent);     
            //     foreach ($questions as $question) {
            //         $qTF = mysqli_real_escape_string($con, $question['question']);
            //         $answer = mysqli_real_escape_string($con, $question['answer']);
            //         $optionA='true';
            //         $optionB='false';
        
            //         $query = "INSERT INTO question (QUESTION_TYPE, QUESTION, CHOICE1, CHOICE2, QUESTION_POINT, ANSWER, TEACHER_ID, STATUS)
            //             VALUES ('$questionType', '$qTF', '$optionA', '$optionB', '$questionPoints', '$answer', '$teacher_id', '$status')";
        
            //         if (!mysqli_query($con, $query)) {
            //             echo "Error inserting question: " . mysqli_error($con);
            //         } 
            //     }
            //     echo "<script>alert('File entered successfully')</script>";
            // } else {
            //     echo " <script>alert('Invalid file. Please make sure the file matches the required format.') </script>";
            // }
        } 
        else if ($questionType === 'multipleChoice') {
            if (isValidFormatMultipleChoice($fileContent)) {
                $questions = multipleParseQuestions($fileContent);
        
                $x = true;
                $p = true;
                $n = 1;
                $point = null;
                foreach ($questions as $question) {
                    $point = mysqli_real_escape_string($con, $question['point']);
                }
                foreach ($questions as $question) {
                    $q = mysqli_real_escape_string($con, $question['question']);
                    $optionA = mysqli_real_escape_string($con, $question['optionA']);
                    $optionB = mysqli_real_escape_string($con, $question['optionB']);
                    $optionC = mysqli_real_escape_string($con, $question['optionC']);
                    $optionD = mysqli_real_escape_string($con, $question['optionD']);
                    $answer = mysqli_real_escape_string($con, $question['answer']);
        
                    if ($answer !== 'A' && $answer !== 'B' && $answer !== 'C' && $answer !== 'D') {
                        $x = false;
                        break; // Exit the loop if any question has an incorrect answer
                    }
                }
                if ($x) {
                    echo "<script>alert('There is a question that does not have a correct answer')</script>";
                } else {
                    foreach ($questions as $question) {
                        $q = mysqli_real_escape_string($con, $question['question']);
                        $optionA = mysqli_real_escape_string($con, $question['optionA']);
                        $optionB = mysqli_real_escape_string($con, $question['optionB']);
                        $optionC = mysqli_real_escape_string($con, $question['optionC']);
                        $optionD = mysqli_real_escape_string($con, $question['optionD']);
                        $answer = mysqli_real_escape_string($con, $question['answer']);
        
                        $query = "INSERT INTO question (QUESTION_TYPE, QUESTION, CHOICE1, CHOICE2, CHOICE3, CHOICE4, QUESTION_POINT, ANSWER, TEACHER_ID, STATUS)
                            VALUES ('$questionType', '$q', '$optionA', '$optionB', '$optionC', '$optionD', '$point', '$answer', '$teacher_id', '$status')";
                        $result = mysqli_query($con, $query);
                        if (!$result) {
                            echo "Error: " . mysqli_error($con);
                        }
                    }
        
                    echo "<script>alert('File entered successfully')</script>";
                }
            } else {
                echo "<script>alert('Invalid file')</script>";
            }
        }
        
        
        
        else if ($questionType === 'fillInTheBlank') {
            echo "<script>alert('Filehhhhhhhhhhh entered successfully')</script>";
            // if (isValidFormatFillInBlank($fileContent)) {
            //     $questions = fillInBlankParseQuestions($fileContent);
        
            //     // foreach ($questions as $question) {
            //     //     $qFB = mysqli_real_escape_string($con, $question['question']);
            //     //     $answer = mysqli_real_escape_string($con, $question['answer']);
            //     //     $point = floatval($question['point']);
        
            //     //     $query = "INSERT INTO question (QUESTION_TYPE, QUESTION, QUESTION_POINT, ANSWER, TEACHER_ID, STATUS)
            //     //             VALUES ('$questionType', '$qFB', '$point', '$answer', '$teacher_id', '$status')";
            //     //     if (!mysqli_query($con, $query)) {
            //     //         echo "Error inserting question: " . mysqli_error($con);
            //     //     }
            //     // }
            //     echo "<script>alert('File entered successfully')</script>";
            // } else {
            //     echo "Invalid file format. Please make sure the file matches the required format.";
            // }
        }
        else {
            echo "Invalid question type selected";
        }
    }
}

// function isValidFormatMultipleChoice($fileContent) {
//     $pattern = "/^Q\.\s.+\nA\.\s.+\nB\.\s.+\nC\.\s.+\nD\.\s.+\nanswer\.\s.+/m";
//     return preg_match($pattern, $fileContent);
// }

// function multipleParseQuestions($fileContent) {
//     $pattern = "/^Q\.\s(.+)\nA\.\s(.+)\nB\.\s(.+)\nC\.\s(.+)\nD\.\s(.+)\nanswer\.\s(.+)/m";
//     preg_match_all($pattern, $fileContent, $matches, PREG_SET_ORDER);

//     $questions = [];

//     foreach ($matches as $match) {
//         $question = [
//             'question' => $match[1],
//             'optionA' => $match[2],
//             'optionB' => $match[3],
//             'optionC' => $match[4],
//             'optionD' => $match[5],
//             'answer' => $match[6]
//         ];

//         $questions[] = $question;
//     }

//     return $questions;
// }
function isValidFormatMultipleChoice($fileContent) {
    $pattern = "/point_for_each_question\.\s\d+(\.\d+)?\s+Q\.\s.+\s+A\.\s.+\s+B\.\s.+\s+C\.\s.+\s+D\.\s.+\s+answer\.\s.+/ms";
    return preg_match($pattern, $fileContent);
}

function multipleParseQuestions($fileContent) {
    $pattern = "/point_for_each_question\.\s(\d+(\.\d+)?)\s+Q\.\s(.+?)\s+A\.\s(.+?)\s+B\.\s(.+?)\s+C\.\s(.+?)\s+D\.\s(.+?)\s+answer\.\s(.+)/ms";
    preg_match_all($pattern, $fileContent, $matches, PREG_SET_ORDER);

    $questions = [];

    foreach ($matches as $match) {
        $question = [
            'point' => floatval($match[1]),
            'question' => $match[3],
            'optionA' => $match[4],
            'optionB' => $match[5],
            'optionC' => $match[6],
            'optionD' => $match[7],
            'answer' => $match[8]
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
// function isValidFormatFillInBlank($fileContent) {
//     $pattern = "/^Q\.\s.+\nanswer\.\s.+\npoint\.\s.+/m";
//     return preg_match($pattern, $fileContent);
// }

// function fillInBlankParseQuestions($fileContent) {
//     $pattern = "/^Q\.\s(.+)\nanswer\.\s(.+)\npoint\.\s(.+)/m";
//     preg_match_all($pattern, $fileContent, $matches, PREG_SET_ORDER);

//     $questions = [];

//     foreach ($matches as $match) {
//         $question = [
//             'question' => $match[1],
//             'answer' => $match[2],
//             'point' => $match[3]
//         ];

//         $questions[] = $question;
//     }

//     return $questions;
// }


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
                        <option value="Essay">Short answer and Essay</option>
                    </select>
                </div>
                <!-- <div class="form-group" id="Question_Point" style="display: none;" >
                  <label for="questionPoints">Question Point</label>
                  <input class="form-control" id="questionPoints" name="questionPoints" min="1" value="" placeholder="Enter the point" required>
                  <div id="checkPoint" style="color: red"></div>
               </div> -->
                <div class="form-group">
                    <label>Upload Question File</label>
                    <input class="form-control choice" type="file" id="fileInput" name="fileInput" accept=".txt" required>
                </div>
                <br><br>
                <button type="submit" id="addQuestionButton" name="submit" class="btn btn-success"
                        style="width: 20%;">Submit Question
                </button>
            </form>
            <script type="text/javascript">
                // var questionPoints = document.getElementById('Question_Point');
                // var checkPoint = document.getElementById('checkPoint');
                // var questionTypeSelect = document.getElementById('questionType');
                // questionTypeSelect.addEventListener('change', function() { 
                //     var selectedType = questionTypeSelect.value;
                //     if (selectedType === 'multipleChoice') {
                //             questionPoints.style.display = 'block';
                //     }
                //     else if (selectedType === 'trueORFalse') {
                //             questionPoints.style.display = 'block';
                //     }
                    
                //     else{
                //         questionPoints.style.display = 'none';
                //     }
                // });
                function validate() {
                    var questionType = document.getElementById('questionType').value;
                    var questionPoint = document.getElementById('questionPoints');
                    var fileInput = document.getElementById('fileInput');

                    if (questionType === "" || fileInput.files.length === 0) {
                        alert('Please select a question type and upload a file.');
                        return false;
                    }
                    // else if(questionType === 'multipleChoice' || questionType === 'trueORFalse'){
                    //     if(isNaN(questionPoint.value)){
                    //         document.getElementById("checkPoint").innerHTML='Entered value is not a number'
                    //         return false;
                    //     }
                    // }
                    // else if(questionType === 'multipleChoice' || questionType === 'trueORFalse')
                    return true;  
                }
            </script>
           
            <br><br>
        </div>
    </div>
</div>
</body>
</html>

<!-- is the standard markup language for creating Web pages and it describes the structure of a Web page.
which one of the following is a server-side scripting language embedded in HTML in its simplest form.
What are the goal of a Distributed System?
CSS stands for Cascading Style Sheets language and is used to stylize elements written in a markup language such as HTML.  -->