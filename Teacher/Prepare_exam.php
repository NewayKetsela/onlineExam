<?php 
session_start(); 
if($_SESSION['login']==='none'){
	
	echo "<script>window.open('../index.php?not_loggined=Please login!','_self')</script>";
}
else {
	?>
<!DOCTYPE html>
<html>
      <?php
         require("head.html");
      ?>
<body class="hold-transition sidebar-mini layout-fixed">
   <div class="wrapper">
      <?php
         require("sidebar.php");
      ?>

      <div class="content-wrapper">
      <br><br><br>
         <h2 align="center">Exam Preparation</h2>
         <div class="container">
            <form  action="#" method="POST">
               <div class="form-group">
                  <label class="questionType">Question Type:</label>
                  <select class="form-control" id="questionType" name="questionType">
                     <option value="multipleChoice">Multiple Choice</option>
                     <option value="fillInTheBlank">Fill in the Blank</option>
                     <option value="Essay">Short answer and Essay</option>
                  </select>
               </div>
               <div class="form-group" id="Question_Point"  >
                  <label for="questionPoints">Question Point:</label>
                  <input class="form-control" id="questionPoints" name="questionPoints" min="1" value="1">
                  <div id="checkPoint" style="color: red"></div>
               </div>
               <div id="questionContainer" class="form-group">
                  <label for="question">Question:</label>
                  <textarea class="form-control" placeholder="Enter the question here" name="question" id="question" rows="3"></textarea>
                  <div id="checkQuestion" style="color: red"></div>
               </div>
               <div id="choicesContainer" class="form-group" >
                  <label for="choices">Choices:</label>
                  <div id="choicesWrapper">
                     <div class="choice-input" id="ch12">
                        <div class="input-group">
                           <input type="text" id="choice1" name="choice1" class="form-control choice" placeholder="Enter first choice">
                        </div><br>
                        <div class="input-group">
                           <input type="text" id="choice2" name="choice2" class="form-control choice" placeholder="Enter second choice">
                        </div><br>
                        <div class="input-group">
                           <input type="text" id="choice3" name="choice3" class="form-control choice" placeholder="Enter third choice">
                        </div><br>
                        <div class="input-group">
                           <input type="text" id="choice4" name="choice4" class="form-control choice" placeholder="Enter fourth choice">
                        </div><br>
                     </div>
                     <div id="checkChoice" style="color: red"></div>
                  </div>
               </div>
               <div id="answerContainer" >
                     <label for="answer">Answer:</label>
                     <input type="text" class="form-control" id="answer" name="answer" placeholder="Enter the answer">
                     <div id="checkAnswer" style="color: red"></div>
               </div><br>
               <button type="submit" id="addQuestionButton" name="submit" class="btn btn-success" style="width: 48%; " >Submit Question</button>
            </form><br><br>
         </div>
      <script>
            var questionTypeSelect = document.getElementById('questionType');
            var questionPointsInput = document.getElementById('questionPoints');
            var questionContainer = document.getElementById('questionContainer');
            var choicesContainer = document.getElementById('choicesContainer');
            var addChoiceButton = document.getElementById('addChoiceButton');
            var answerContainer = document.getElementById('answerContainer');
            var Question_Point = document.getElementById('Question_Point');
            var addQuestionButton = document.getElementById('addQuestionButton');
            questionTypeSelect.addEventListener('change', function() { 
               var selectedType = questionTypeSelect.value;
               if (selectedType === 'multipleChoice') {
                  Question_Point.style.display = 'block';
                  questionContainer.style.display = 'block';
                  addQuestionButton.style.display = 'inline';
                  choicesContainer.style.display = 'block';
                  answerContainer.style.display = 'block';
               } 
               else if (selectedType === 'fillInTheBlank') {
                  Question_Point.style.display = 'block';
                  questionContainer.style.display = 'block';
                  addQuestionButton.style.display = 'inline';
                  choicesContainer.style.display = 'none';
                  answerContainer.style.display = 'block';
               } 
               else {
                  addQuestionButton.style.display = 'inline';
                  Question_Point.style.display = 'block';
                  questionContainer.style.display = 'block';
                  choicesContainer.style.display = 'none';
                  answerContainer.style.display = 'none';
               }
            });
            // addQuestionButton.addEventListener('click', function(event) {
            //          event.preventDefault();

            //          var questionType = questionTypeSelect.value;
            //          var questionPoints = questionPointsInput.value;
            //          var question = document.getElementById('question').value;  
              
            //          if (questionPoints === '') {
            //             alert('Please enter the question points');
            //             return false;
            //          }

            //          if (question === '') {
            //             alert('Please enter the question');
            //             return false;
            //          }

            //         if (questionType === 'multipleChoice') {
            //             var choices = Array.from(document.getElementsByClassName('choice')).map(function (choice) {
            //             return choice.value.trim(); // Trim the whitespace from the choices
            //               });

            //               // Remove empty choices from the array
            //             choices = choices.filter(function (choice) {
            //                 return choice !== '';
            //               });

            //             if (choices.length < 2) {
            //                 alert('Please enter at least two choices');
            //                 return false;
            //               }

            //             var answer = document.getElementById('answer').value.trim(); // Trim the whitespace from the answer

            //             if (answer === '') {
            //               alert('Please enter the answer');
            //                return false;
            //             }
            //          }
            //          if (questionType === 'fillInTheBlank') {
            //             if (document.getElementById('answer').value === '') {
            //                alert('Please enter the answer');
            //                return false;
            //             }
            //          }
            //          // Reset form fields
            //          document.getElementById('question').value = '';
            //          document.getElementById('choice1').value = '';
            //          document.getElementById('choice2').value = '';
            //          document.getElementById('choice3').value = '';
            //          document.getElementById('choice4').value = '';
            //          document.getElementById('answer').value = '';
            //       });    

      </script>
      
      </div>
   </div>
</body>
</html>
<?php } ?>
<?php
require("../DBconnection.php");
$db = Database::getInstance();
$con = $db->getConnection();
// $q= "select * from QUESTION";
// $questionId;
// $q_id = mysqli_query($con, $q);
// if($row=mysqli_fetch_assoc($q_id))
//    {
//     $ques_id=$row["QUESTION_ID"];
//     if($ques_id=='None'){
//       $questionId=0;
//     }
//    }
// Check if the questionId session variable is set
if (!isset($_SESSION['questionId'])) {
   $_SESSION['questionId'] = 0;
}


 if(isset($_POST['submit'])){
   $username = $_SESSION['login'];
   $teacher_id = substr($username, -4);
   $questionType = $_POST['questionType'];
   $questionPoints = $_POST['questionPoints'];
   $question = $_POST['question'];
   $status="new";

   $_SESSION['questionId']++;
   $questionId = $_SESSION['questionId'];
   // echo "<script>alert('questionId  ='+$questionId)</script>";
  
   if ($questionType === 'multipleChoice') {
      $choice1 = $_POST['choice1'];
      $choice2 = $_POST['choice2'];
      $choice3 = $_POST['choice3'];
      $choice4 = $_POST['choice4'];
      $answer = $_POST['answer'];
      if($choice3=="" ){    $choice3="NULL";    }
      if($choice4=="" ){    $choice4="NULL";    }

      $query = "INSERT INTO question (QUESTION_ID,QUESTION_TYPE, QUESTION, CHOICE1, CHOICE2, CHOICE3, CHOICE4, QUESTION_POINT, ANSWER,TEACHER_ID,STATUS)
                VALUES ('$questionId','$questionType', '$question', '$choice1', '$choice2', '$choice3', '$choice4', '$questionPoints','$answer','$teacher_id','$status')";
      // Execute the query
      $result = mysqli_query($con, $query);

      if ($result) {
         echo "<script>alert('Question submitted!')</script>";
      } else {
         echo "Error: " . mysqli_error($con);
      }
   } elseif ($questionType === 'fillInTheBlank') {
      $answer = $_POST['answer'];

      $query = "INSERT INTO question (QUESTION_ID,QUESTION_TYPE, QUESTION,QUESTION_POINT, ANSWER,TEACHER_ID,STATUS)
                VALUES ('$questionId','$questionType', '$question','$questionPoints','$answer','$teacher_id','$status')";

      // Execute the query
      $result = mysqli_query($con, $query);
      if ($result) { 
         echo "<script>alert('Question submitted!')</script>";
         echo "<script>
            document.getElementById('questionType').value = 'fillInTheBlank';
            Question_Point.style.display = 'block';
            questionContainer.style.display = 'block';
            addQuestionButton.style.display = 'inline';
            choicesContainer.style.display = 'none';
            answerContainer.style.display = 'block';
         </script>";
      } else {
         echo "Error: " . mysqli_error($con);
      }
   } elseif ($questionType === 'Essay') {

      $query = "INSERT INTO question (QUESTION_ID,QUESTION_TYPE, QUESTION,QUESTION_POINT,TEACHER_ID,STATUS)
                VALUES ('$questionId','$questionType', '$question','$questionPoints','$teacher_id','$status')";

      // Execute the query
      $result = mysqli_query($con, $query);

      if ($result) {
         echo "<script>alert('Question submitted!')</script>";
         echo "<script>
            document.getElementById('questionType').value = 'Essay';
            addQuestionButton.style.display = 'inline';
            Question_Point.style.display = 'block';
            questionContainer.style.display = 'block';
            choicesContainer.style.display = 'none';
            answerContainer.style.display = 'none';
         </script>";
      } else {
         echo "Error: " . mysqli_error($con);
      }
   }
 }
?>

<!-- is the standard markup language for creating Web pages and it describes the structure of a Web page.
which one of the following is a server-side scripting language embedded in HTML in its simplest form.
What are the goal of a Distributed System?
CSS stands for Cascading Style Sheets language and is used to stylize elements written in a markup language such as HTML.  -->