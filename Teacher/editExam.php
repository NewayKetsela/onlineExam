<?php 
session_start(); 
if($_SESSION['login']==='none'){
	
	echo "<script>window.open('../index.php?not_loggined=Please login!','_self')</script>";
}
else {
	?>

<html lang="en">
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
               <!-- Main content -->
            <div class="container">
            <section class="content">  
                        <br<br>

                 <h4 align="center"> Edit the question </h4><br>
                    <?php
                    $q_id=$_GET['QUESTION_ID'];
                    $question_type=$_GET['QUESTION_TYPE'];
                    require("../DBconnection.php");
                    $db = Database::getInstance();
                    $con = $db->getConnection();
                    $username = $_SESSION['login'];
                    $T_ID = substr($username, -4);
                    // Fetch all the questions from the database
                    $query = "select * from question where QUESTION_ID='".$q_id."'";
                    $result = mysqli_query($con, $query);
                    // Loop through each records 
                    while($row = mysqli_fetch_array($result))
                    {
                    $q_type=$row['QUESTION_TYPE'];
                    $question=$row['QUESTION'];
                    $choice1=$row['CHOICE1'];
                    $choice2=$row['CHOICE2'];
                    $choice3=$row['CHOICE3'];
                    $choice4=$row['CHOICE4'];
                    $q_point=$row['QUESTION_POINT'];
                    $answer=$row['ANSWER'];
                            
                    }
                  ?>
                <form method="post" >
                    
                    <div id="questionContainer" class="form-group">
                    <div class="row">
                        <div class="col-md-2">
                        <label for="question" class="choice-label">QUESTION:</label>
                        </div>
                        <div class="col-md-10">
                        <textarea class="form-control" name="question" id="question" rows="2"><?php echo $question; ?></textarea>
                        </div>
                    </div>
                    </div>

                    <div id="choicesWrapper" style="display: none;">
                    <div class="choice-input" id="ch12">
                        <div class="row">
                        <div class="col-md-2">
                            <label for="choice" class="choice-label">CHOICE 1:</label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" id="choice1" name="choice1" class="form-control choice" value="<?php echo $choice1; ?>" placeholder="Enter first choice">
                        </div>
                        </div>
                        <br>
                        <div class="row">
                        <div class="col-md-2">
                            <label for="choice" class="choice-label">CHOICE 2:</label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" id="choice2" name="choice2" class="form-control choice" value="<?php echo $choice2; ?>" placeholder="Enter second choice">
                        </div>
                        </div>
                        <br>
                        <div class="row">
                        <div class="col-md-2">
                            <label for="choice" class="choice-label">CHOICE 3:</label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" id="choice3" name="choice3" class="form-control choice" value="<?php echo $choice3; ?>" placeholder="Enter third choice">
                        </div>
                        </div>
                        <br>
                        <div class="row">
                        <div class="col-md-2">
                            <label for="choice" class="choice-label">CHOICE 4:</label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" id="choice4" name="choice4" class="form-control choice" value="<?php echo $choice4; ?>" placeholder="Enter fourth choice">
                        </div>
                        </div>
                        <br>
                    </div>
                    </div>

                    <div id="answerContainer" style="display: none;">
                        <div class="row">
                            <div class="col-md-2">
                            <label for="answer" class="choice-label">ANSWER:</label>
                            </div>
                            <div class="col-md-10">
                            <input type="text" class="form-control" id="answer" name="answer" value="<?php echo $answer; ?>" placeholder="Enter the answer">
                            </div>
                        </div>
                        <!-- <div id="checkAnswer" style="color: red"></div> -->
                    </div>
                    <br>
                    <div class="form-group" id="Question_Point">
                        <div class="row">
                            <div class="col-md-2">
                            <label for="questionPoints" class="choice-label">QUESTION POINT:</label>
                            </div>
                            <div class="col-md-10">
                            <input class="form-control" id="questionPoints" name="questionPoints" min="1" value="<?php echo $q_point; ?>" placeholder="Enter the point">
                            </div>
                        </div>
                    </div>  <br>
                    <div class="text-center">
                         <button type="submit" id="addQuestionButton" name="submit" class="btn btn-success" style="width: 55%;">Update Question</button>
                    </div>
                   
                </form>
            </section> 
          </div>      
        <script src="../asset/jquery/jquery.min.js"></script>
        <script src="../asset/js/adminlte.js"></script>
        <script>
            var choicesWrapper = document.getElementById('choicesWrapper');
            var answerContainer = document.getElementById('answerContainer');
            var checkType ='<?php echo $question_type; ?>' ;
            if(checkType === 'multipleChoice'){ 
                choicesWrapper.style.display = 'inline';
                answerContainer.style.display = 'inline';
            }
            else if( checkType === 'fillInTheBlank'){
                answerContainer.style.display = 'inline';
                choicesWrapper.style.display = 'none';
            }
            else if( checkType === 'Essay' ){
                choicesWrapper.style.display = 'none';
                answerContainer.style.display = 'none';
            }
      </script>
    </div>
    </div>
      
   </body>
</html>
<?php 
 } 
 if(isset($_POST['submit'])){
    $questionP = $_POST['questionPoints'];
    $ques = $_POST['question'];
    $ch1 = $_POST['choice1'];
    $ch2 = $_POST['choice2'];
    $ch3 = $_POST['choice3'];
    $ch4 = $_POST['choice4'];
    $ans = $_POST['answer'];
    if( $q_type==='multipleChoice'){
        $sqll = "Update question set QUESTION='$ques',CHOICE1='$ch1',CHOICE2='$ch2',CHOICE3='$ch3',CHOICE4='$ch4', QUESTION_POINT='$questionP',ANSWER='$ans' where QUESTION_ID='$q_id' ";
    }
    else if($q_type==='fillInTheBlank'){
        $sqll = "Update question set QUESTION='$ques', QUESTION_POINT='$questionP',ANSWER='$ans' where QUESTION_ID='$q_id' ";
    }
    else if($q_type==='Essay'){
        $sqll = "Update question set QUESTION='$ques', QUESTION_POINT='$questionP' where QUESTION_ID='$q_id' ";
    }
   // Execute query
   if (mysqli_query($con, $sqll)) {
        echo '<script>alert("Question Updated Succesfully");
        window.location=\'manage_exam.php\'; </script>';
    } else {
        echo "Error updating question: " . mysqli_error($con);
    }
    
 }

?>
