<?php
session_start(); 
 require("../DBconnection.php");
 $db = Database::getInstance();
 $con = $db->getConnection();
?>

<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Exam Preparation</title>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   <link rel="stylesheet" href="../asset/fontawesome/css/all.min.css">
   <link rel="stylesheet" href="../asset/css/adminlte.min.css">
   <link rel="stylesheet" href="../asset/css/style.css">
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
         background-color: rgb(160, 20, 79);
      }

      .bg2 {
         background-color: rgb(4, 91, 98);
      }

      .bg3 {
         background-color: rgb(20, 83, 154);
      }

      .bg4 {
         background-color: rgb(109, 65, 161);
      }

      #overflowTest {
         background: #4CAF50;
         color: white;
         padding: 15px;
         width: 100%;
         height: 200px;
         overflow: scroll;
         border: 1px solid #ccc;
      }
   </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
   <div class="wrapper">
      <?php
         require("sidebar.php");
      ?>

      <div class="content-wrapper">
         <h1>Exam Preparation</h1>
         <div class="container">
            <form id="examForm" action="prepare_exam.php" method="POST">
               <div class="form-group">
                  <label for="questionType">Question Type:</label>
                  <select class="form-control" id="questionType">
                     <option value="" selected disabled>Select the type of question</option>
                     <option value="multipleChoice">Multiple Choice</option>
                     <option value="fillInTheBlank">Fill in the Blank</option>
                     <option value="Eassy">Short answer and Eassy</option>
                  </select>
               </div>
               <div class="form-group" id="Question_Point" >
                  <label for="questionPoints">Question Point:</label>
                  <input type="number" class="form-control" id="questionPoints" min="1" value="1">
               </div>
               <div id="questionContainer" class="form-group">
                  <label for="question">Question:</label>
                  <textarea class="form-control" placeholder="Enter the question here" id="question" rows="4"></textarea>
               </div>
               <div id="choicesContainer" class="form-group" style="display: none;">
                  <label for="choices">Choices:</label>
                  <div id="choicesWrapper">
                     <div class="choice-input" id="ch12">
                        <div class="input-group">
                           <input type="text" id="choice1" class="form-control choice" placeholder="Enter first choice">
                           <!-- <div class="input-group-append">
                              <button type="button" class="btn btn-danger remove-choice">Remove</button>
                           </div> -->
                        </div><br>
                        <div class="input-group">
                           <input type="text" id="choice2" class="form-control choice" placeholder="Enter second choice">
                           <!-- <div class="input-group-append">
                              <button type="button" class="btn btn-danger remove-choice">Remove</button>
                           </div> -->
                        </div><br>
                        <div class="input-group">
                           <input type="text" id="choice3" class="form-control choice" placeholder="Enter third choice">
                           <!-- <div class="input-group-append">
                              <button type="button" class="btn btn-danger remove-choice">Remove</button>
                           </div> -->
                        </div><br>
                        <div class="input-group">
                           <input type="text" id="choice4" class="form-control choice" placeholder="Enter fourth choice">
                           <!-- <div class="input-group-append">
                              <button type="button" class="btn btn-danger remove-choice">Remove</button>
                           </div> -->
                        </div><br>
                     </div>
                  </div>
                  <!-- <button type="button" id="addChoiceButton" class="btn btn-primary mt-2">Add Choice</button> -->
               </div>
               <div id="answerContainer" style="display: none;">
                     <label for="answer">Answer:</label>
                     <input type="text" class="form-control" id="answer" placeholder="Enter the answer">
               </div><br>
               <button id="addQuestionButton" class="btn btn-primary" style="width: 48%; " >Add Question</button>   &nbsp&nbsp&nbsp&nbsp  <button type="submit" id="submitExam" class="btn btn-success" style="width: 48%;">Submit Exam</button>
            </form><br><br>
            <div id="overflowTest"></div>
         </div>

         <script>
            var questionTypeSelect = document.getElementById('questionType');
            var questionPointsInput = document.getElementById('questionPoints');
            var questionContainer = document.getElementById('questionContainer');
            var choicesContainer = document.getElementById('choicesContainer');
            var addChoiceButton = document.getElementById('addChoiceButton');
            var answerContainer = document.getElementById('answerContainer');
            var overflowTestContainer = document.getElementById('overflowTest');
            var Question_Point = document.getElementById('Question_Point');
            var addQuestionButton = document.getElementById('addQuestionButton');
            var submitExam = document.getElementById('submitExam');
            var ch12 = document.getElementById('ch12');

            Question_Point.style.display = 'none';
            questionContainer.style.display = 'none';
            submitExam.style.display = 'none';
            addQuestionButton.style.display = 'none';
            answerContainer.style.display = 'none';

            questionTypeSelect.addEventListener('change', function() {
               var selectedType = questionTypeSelect.value;
               if (selectedType === 'multipleChoice') {
                  Question_Point.style.display = 'block';
                  questionContainer.style.display = 'block';
                  submitExam.style.display = 'inline';
                  addQuestionButton.style.display = 'inline';
                  choicesContainer.style.display = 'block';
                  answerContainer.style.display = 'block';
               } 
               else if (selectedType === 'fillInTheBlank') {
                  Question_Point.style.display = 'block';
                  questionContainer.style.display = 'block';
                  submitExam.style.display = 'inline';
                  addQuestionButton.style.display = 'inline';
                  choicesContainer.style.display = 'none';
                  answerContainer.style.display = 'block';
               } 
               else {
                  submitExam.style.display = 'inline';
                  addQuestionButton.style.display = 'inline';
                  Question_Point.style.display = 'block';
                  questionContainer.style.display = 'block';
                  choicesContainer.style.display = 'none';
                  answerContainer.style.display = 'none';
               }
            });

            // addChoiceButton.addEventListener('click', function() {
            //    var choicesWrapper = document.getElementById('choicesWrapper');
            //    var choiceInput = document.createElement('div');
            //    choiceInput.classList.add('choice-input');
            //    choiceInput.innerHTML = `
            //       <div class="input-group">
            //          <input type="text" class="form-control choice" placeholder="Enter a choice">
            //          <div class="input-group-append">
            //             <button type="button" class="btn btn-danger remove-choice">Remove</button>
            //          </div>
            //       </div><br>
            //    `;
            //    choicesWrapper.appendChild(choiceInput);
            // });

            // choicesContainer.addEventListener('click', function(event) {
            //    if (event.target.classList.contains('remove-choice')) {
            //       var choiceInput = event.target.closest('.choice-input');
            //       choiceInput.parentNode.removeChild(choiceInput);
            //    }
            // });

            var x=0;
            addQuestionButton.addEventListener('click', function(event) {
                     event.preventDefault();

                     var questionType = questionTypeSelect.value;
                     var questionPoints = questionPointsInput.value;
                     var question = document.getElementById('question').value;

                     if (questionType === '') {
                        alert('Please select the type of question');
                        return;
                     }

                     if (questionPoints === '') {
                        alert('Please enter the question points');
                        return;
                     }

                     if (question === '') {
                        alert('Please enter the question');
                        return;
                     }

                     if (questionType === 'multipleChoice') {
                        var choices = Array.from(document.getElementsByClassName('choice')).map(function(choice) {
                           return choice.value;
                        });

                        if (choices.length <= 1) {
                           alert('Please enter at least two choice');
                           return;
                        }

                        if (document.getElementById('answer').value === '') {
                           alert('Please enter the answer');
                           return;
                        }
                     }
                     if (questionType === 'fillInTheBlank') {
                        if (document.getElementById('answer').value === '') {
                           alert('Please enter the answer');
                           return;
                        }
                     }

                     var newQuestionContainer = document.createElement('div');
                     newQuestionContainer.classList.add('question-container');
                     x++;
                     newQuestionContainer.innerHTML = `
                        <label>Question Type: ${questionType }</label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                        <label>Question Points: ${questionPoints}</label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<button id="editBtn${x}" class="btn btn-primary" style="width: 7%; " >Edit</button>
                        <p>Question: ${question}</p>
                     `;

                     if (questionType === 'multipleChoice') {
                        var choicesHtml = choices.map(function(choice) {
                           return `<li type="A">${choice}</li>`;
                        }).join('');

                        newQuestionContainer.innerHTML += `
                           <ul>Choices: ${choicesHtml}</ul>
                           <label>Answer: ${document.getElementById('answer').value}</label><br>
                        `;
                     }
                     if (questionType === 'fillInTheBlank') {
                        newQuestionContainer.innerHTML += `
                           <label>Answer: ${document.getElementById('answer').value}</label><br>
                        `;
                     }

                     overflowTestContainer.appendChild(newQuestionContainer);

                     // Reset form fields
                     document.getElementById('question').value = '';
                     document.getElementById('choice1').value = '';
                     document.getElementById('choice2').value = '';
                     document.getElementById('choice3').value = '';
                     document.getElementById('choice4').value = '';
                     document.getElementById('answer').value = '';
                  


                     var editBtn = document.getElementById(`editBtn${x}`);
                     editBtn.addEventListener('click', function(event) {
                        event.preventDefault();

                        // Retrieve question information
                        var selectedQuestionType = newQuestionContainer.querySelector('label:nth-child(1)').innerText.split(':')[1].trim();
                        var questionPoints = newQuestionContainer.querySelector('label:nth-child(2)').innerText.split(':')[1].trim();
                        var question = newQuestionContainer.querySelector('p').innerText;

                        // Display question information in the input fields
                        questionTypeSelect.value = selectedQuestionType;
                        questionPointsInput.value = questionPoints;
                        document.getElementById('question').value = question;

                        // Reset the display of all question type fields
                        choicesContainer.style.display = selectedQuestionType === 'multipleChoice' ? 'block' : 'none';
                        answerContainer.style.display = selectedQuestionType !== 'Eassy' ? 'block' : 'none';

                        // Display the relevant question fields based on the question type
                        // Display the relevant question fields based on the question type
                        if (selectedQuestionType === 'multipleChoice') {
                           choicesContainer.style.display = 'block';
                           answerContainer.style.display = 'block';

                           var choicesList = newQuestionContainer.querySelector('ul');
                           var answer = newQuestionContainer.querySelector('label:nth-child(5)').innerText.split(':')[1].trim();

                           var choices = Array.from(choicesList.getElementsByTagName('li')).map(function(choice) {
                              return choice.innerText;
                           });

                           // Set choices and answer in the input fields
                           document.getElementById('choice1').value = choices[0];
                           document.getElementById('choice2').value = choices[1];
                           document.getElementById('choice3').value = choices[2];
                           document.getElementById('choice4').value = choices[3];
                           document.getElementById('answer').value = answer;
                        } else if (selectedQuestionType === 'fillInTheBlank') {
                           choicesContainer.style.display = 'none';
                           answerContainer.style.display = 'block';

                           var answer = newQuestionContainer.querySelector('label:nth-child(4)').innerText.split(':')[1].trim();

                           // Set answer in the input field
                           document.getElementById('answer').value = answer;
                        } else {
                           choicesContainer.style.display = 'none';
                           answerContainer.style.display = 'none';
                        }


                     });
           



           });

         </script>
      </div>
   </div>
</body>
</html>



