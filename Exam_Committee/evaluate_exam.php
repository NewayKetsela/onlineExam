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
        $COM_ID = substr($username, -4);
	?>

<html lang="en"> 
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Evaluate Exam</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../bootstrap-4.6.1-dist/asset/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../bootstrap-4.6.1-dist/asset/css/adminlte.min.css">
    <link rel="stylesheet" href="../bootstrap-4.6.1-dist/asset/css/style.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
         <?php
           require("cm_navbar.php");
         ?>
        <div class="content-wrapper"> 
        <br><br><br>
        <!-- Main content -->
        <div class="container">
        <h1 >Exam evaluation</h1>
        <p>Important note for committe and instructor's</p>
               <ul>
                  <li>Exam must include at least three types multiple choice,true or false,short answer,essay type of item exam</li>
                  <li>Test must cover various topics in proportion in the emphasis you have even in class</li>
               </ul>
               <ol>
                  
                       <!-- data such(course, exam tipe) should retrieve from database of the teacher -->
                           <label for="data" id="courseName" style="display: none;">Course Name:</label>&nbsp&nbsp
                           <?php
                                $cou_commite="select * from  exam_committee where COMMITTEE_ID='$COM_ID' ";
                                $r_cou=mysqli_query($con,$cou_commite);
                                if($row=mysqli_fetch_assoc($r_cou))
                                {
                                $co_id=$row["ASSIGN_COURSE_ID"];
                                }
                                
                                $cou_exam_bank="select * from exam_bank where COURSE_ID='$co_id' and REQUEST_EVALUATION='asked' ";
                                $cou_result=mysqli_query($con,$cou_exam_bank);
                                $cou_exist=mysqli_num_rows($cou_result);
                                if($cou_exist>0)
                                {
                                    if($row=mysqli_fetch_assoc($cou_result))
                                    {
                                    $c_name=$row["COURSE_NAME"];
                                    $exam_type=$row["EXAM_TYPE"];
                                    $exam_time=$row["EXAM_TIME"];
                                    echo $c_name;  
                                    }
                                }
                                else{
                                    echo '<strong>THERE IS NO REQUEST TO EVALUATE. </strong>';
                                }
                            ?>
                            <span id="examType" style="display: none;"> <label for="data">Exam Type:</label>&nbsp&nbsp <?php echo $exam_type; ?>  </span>
                          
                           <br>
                            <span id="viewExam" style="display: none;"> <label for="data">View Exam :</label>&nbsp&nbsp&nbsp
                              <a href=" exam_detail.php?EXAM_TIME=<?php echo $exam_time;?>   ">  <button name="view_exam_submit" id="retrieveButton" class="btn btn-primary"  >Exam detail</button> </a>
                            </span>
                            
                    
                            <div id="dataContainer">
                            <!-- placeholder to display data-->
                            </div>
                  
                  <br>
                        <!-- each checkbox value and other comment should calculated by percentage and
                        if persent is greater than 50% the exam should summite to main exam bank 
                        which means ready for student   -->
            <form method="post">
                  <li >check list for general parameter and test format</li>
                     <table style="width:100%" border="1">
                  
                        <tr>
                           <th rowspan="2">S.No</th>
                           <th align="center" rowspan="2" >Content</th>
                           <th colspan="2" align="center">Observation</th>
                         
                        </tr>
                        <tr>
                           <td>Yes</td>
                           <td>No</td>
                        </tr>
                        <tr><td colspan="4" align="center"><strong>General Parameter</strong></td></tr>
                        <tr>
                           <td>1.</td>
                           <td>Does the exam item match the course objective?</td>
                           <td>
                           <input type="radio" id="html" name="0" value="yes">
                           </td>
                           <td><input type="radio" id="html" name="0" value="no"></td>
                        
                        </tr>
                        <tr>
                           <td>2.</td>
                           <td>Are the items appropriate for the objective?</td>
                           <td>
                           <input type="radio" id="html" name="1" value="yes">
                           <label for="html"></label>
                           </td>
                           <td><input type="radio" id="html" name="1" value="no"></td>
                           
                        </tr>
                        <tr>
                           <td>3.</td>
                           <td>Does the test items measure impotant concepts such as understanding of basic principles and practical applications?</td>
                           <td>
                           <input type="radio" id="html" name="2" value="yes">
                           <label for="html"></label>
                           </td>
                           <td><input type="radio" id="html" name="2" value="no"></td>
                           
                        </tr>
                        <tr><td colspan="5" align="center"><strong>Test Format</strong></td></tr>
                        <td>1.</td>
                           <td>Are items arranged in order of difficulty from easy to hard?</td>
                           <td>
                           <input type="radio" id="html" name="3" value="yes">
                           <label for="html"></label>
                           </td>
                           <td><input type="radio" id="html" name="3" value="no"></td>
                           
                        </tr>
                        <tr>
                           <td>2.</td>
                           <td>Are items properly spaced for easy reading and ansewring?</td>
                           <td>
                           <input type="radio" id="html" name="4" value="yes">
                           <label for="html"></label>
                           </td>
                           <td><input type="radio" id="html" name="4" value="no"></td>
                           
                        </tr>
                        <tr>
                           <td>3.</td>
                           <td>Are Complete test items on the same page? Codes on the same page with its items?</td>
                           <td>
                           <input type="radio" id="html" name="5" value="yes">
                           <label for="html"></label>
                           </td>
                           <td><input type="radio" id="html" name="5" value="no"> </td>
                        </tr>

                        <tr>
                           <td>4.</td>
                           <td>Is there sufficient time for students to complete the test?</td>
                           <td>
                           <input type="radio" id="html" name="6" value="yes">
                           <label for="html"></label>
                           </td>
                           <td><input type="radio" id="html" name="6" value="no"> </td>
                           
                        </tr>
                        <tr>
                           <td>5.</td>
                           <td>is provide a point value/weight for answering each item?</td>
                           <td>
                           <input type="radio" id="html" name="7" value="yes">
                           <label for="html"></label>
                           </td>
                           <td> <input type="radio" id="html" name="7" value="no"> </td>
                        </tr>
                    </table>
                    <br>
                  <li >check list for diffrent item type</li>
                    <table style="width:100%" border="1">
                        
                        <tr>
                            <th rowspan="2">S.No</th>
                            <th rowspan="2" align="center">Content</th>
                            <th colspan="2" align="center">Observation</th>
                            
                        </tr>
                        <tr>
                            <td>Yes</td>
                            <td>No</td>
                        </tr>
                        <tr><td colspan="4" align="center">True or False Questions</td></tr>
                        <tr>
                            <td>1.</td>
                            <td>Are statements brief & it uses simple language?</td>
                            <td>
                            <input type="radio" id="html" name="8" value="yes">
                            <label for="html"></label>
                            </td>
                            <td><input type="radio" id="html" name="8" value="no"> </td>
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td>Use nagative statements sparingly. Eliminate double negatives.</td>
                            <td>
                            <input type="radio" id="html" name="9" value="yes">
                            <label for="html"></label>
                            </td>
                            <td><input type="radio" id="html" name="9" value="no"> </td>
                        </tr>
                        <tr>
                            <td>3.</td>
                            <td>Avoid specific determiners(E.g always, sometimes,may...)</td>
                            <td>
                            <input type="radio" id="html" name="10" value="yes">
                            <label for="html"></label>
                            </td>
                            <td>
                                <input type="radio" id="html" name="10" value="no">
                                <label for="html"></label>
                            </td>
                        </tr>

                        <tr><td colspan="5" align="center">Multiple Choice Question</td></tr>
                        <td>1.</td>
                            <td>Are problems stated clearly; at appropriate language level?</td>
                            <td>
                            <input type="radio" id="html" name="11" value="yes">
                            <label for="html"></label>
                            </td>
                            <td><input type="radio" id="html" name="11" value="no"></td>
                            
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td>is the item stated in the positive form(does not use "not" or "never")</td>
                            <td>
                            <input type="radio" id="html" name="12" value="yes">
                            <label for="html"></label>
                            </td>
                            <td><input type="radio" id="html" name="12" value="no"></td>          
                        </tr>
                        <tr>
                            <td>3.</td>
                            <td>Are there at least there alternative answers? </td>
                            <td>
                            <input type="radio" id="html" name="13" value="yes">
                            <label for="html"></label>
                            </td>
                            <td><input type="radio" id="html" name="13" value="no"></td>   
                        </tr>
                        <td>4.</td>
                            <td>Is each alternative listed in a separate line?</td>
                            <td>
                            <input type="radio" id="html" name="14" value="yes">
                            <label for="html"></label>
                            </td>
                            <td><input type="radio" id="html" name="14" value="no"></td>  
                        </tr>
                        <tr>
                            <td>5.</td>
                            <td>The alternative are similar (same length, same type of content, same grammatical construction)?</td>
                            <td>
                            <input type="radio" id="html" name="15" value="yes">
                            <label for="html"></label>
                            </td>
                            <td><input type="radio" id="html" name="15" value="no"></td>  
                        </tr>
                        <tr>
                            <td>6.</td>
                            <td>The alternatives are free from hints as to which response is correct. </td>
                            <td>
                            <input type="radio" id="html" name="16" value="yes">
                            <label for="html"></label>
                            </td>
                            <td><input type="radio" id="html" name="16" value="no"></td>
                        </tr>
                        <tr>
                            <td>7.</td>
                            <td>The alternatives "All of the above" and "None of the above" are not used. The alternatives are fre from imprecise terms("usually","frequently") </td>
                            <td>
                            <input type="radio" id="html" name="17" value="yes">
                            <label for="html"></label>
                            </td>
                            <td><input type="radio" id="html" name="17" value="no"></td>
                        </tr>
                        <tr>
                            <td>8.</td>
                            <td>There are only one correct or clear best answer (optinal). </td>
                            <td>
                            <input type="radio" id="html" name="18" value="yes">
                            <label for="html"></label>
                            </td>
                            <td><input type="radio" id="html" name="18" value="no"></td>
                        </tr>
                        <tr>
                            <td>9.</td>
                            <td>Capital letters (A,B,C,D) are used as labels for the alternatives. </td>
                            <td>
                            <input type="radio" id="html" name="19" value="yes">
                            <label for="html"></label>
                            </td>
                            <td><input type="radio" id="html" name="19" value="no"></td>
                        </tr>
                                   
                        <tr><td colspan="5" align="center">Short Answer Questions</td></tr>
                        <td>1.</td>
                            <td>Direct Questions when possible?</td>
                            <td>
                            <input type="radio" id="html" name="20" value="yes">
                            <label for="html"></label>
                            </td>
                            <td><input type="radio" id="html" name="20" value="no"></td> 
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td>Fill-in-the-blank?
                                <ul>
                                    <li> Place the blank near the end of the sentence.</li>
                                    <li> Avoid providing grammatical hints to the correct answer by using "a","an"...etc</li>
                                    <li> Make the blank lines of equal length for each item.</li>
                                </ul>
                            </td>
                            <td>
                            <input type="radio" id="html" name="21" value="yes">
                            <label for="html"></label>
                            </td>
                            <td><input type="radio" id="html" name="21" value="no"></td>     
                        </tr>
                        <tr><td colspan="5" align="center">Essay Type Questions</td></tr>
                        <td>1.</td>
                            <td>Phrase each item in appropriate language lavel, so that question is clear.</td>
                            <td>
                            <input type="radio" id="html" name="22" value="yes">
                            <label for="html"></label>
                            </td>
                            <td><input type="radio" id="html" name="22" value="no"></td>   
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td>Are the questions short or specfic clearly? </td>
                            <td>
                            <input type="radio" id="html" name="23" value="yes">
                            <label for="html"></label>
                            </td>
                            <td><input type="radio" id="html" name="23" value="no"></td>    
                        </tr>
                       
                    </table>
              </ol>
               <div id="sub_evaluate" style="display: none;">
              <!-- <form id="examForm">
                    <div class="criteria">
                        <label for="correctness">Correctness:</label>&nbsp&nbsp
                        <select id="correctness" name="correctness">
                        <option value="excellent">Excellent</option>
                        <option value="good">Good</option>
                        <option value="fair">Fair</option>
                        <option value="poor">Poor</option>
                        </select>
                    </div><br>
                    
                    <div class="criteria">
                        <label for="completeness">Completeness:</label>&nbsp&nbsp
                        <select id="completeness" name="completeness">
                        <option value="excellent">Excellent</option>
                        <option value="good">Good</option>
                        <option value="fair">Fair</option>
                        <option value="poor">Poor</option>
                        </select>
                    </div><br> -->
                    
                    <!-- Add more criteria fields based on your evaluation criteria -->
                    
                    <label for="comments">Comments:</label><br>
                    <textarea id="comments" name="comment" rows="4" cols="100"></textarea><br>
                    <br>
                    <button name="submit_evaluation" class="btn btn-success" style="width: 17%; " >Submit Evaluation</button>
                    <br><br><br><br>
                </div>
          </form>
             

            <script>
                var examType = document.getElementById('examType');
                var courseName = document.getElementById('courseName');
                var viewExam = document.getElementById('viewExam');
                var sub_evaluate = document.getElementById('sub_evaluate');
            </script>
            <?php   
                if($cou_exist>0)
                {
                    echo "<script>
                    courseName.style.display = 'inline';  
                    examType.style.display = 'block'; 
                    viewExam.style.display = 'block'; 
                    sub_evaluate.style.display = 'block'; 
                    </script>"; 
                }       
            ?>
        
        </div>      
        </div>
    </div>
<script src="../bootstrap-4.6.1-dist/asset/jquery/jquery.min.js"></script>
<script src="../bootstrap-4.6.1-dist/asset/js/adminlte.js"></script>
</body>
</html>


<?php
if(isset($_POST['submit_evaluation'])){
    $comment=$_POST['comment'];
    $Total_yes=0;
    $i=0;
    
   while($i<24){
        if (isset($_POST[$i])) {
            $selectedOption = $_POST[$i];
            if ($selectedOption === 'yes') {
                $Total_yes=$Total_yes+1;
            }    
        }
      $i=$i+1;
    }
    $total_yes_inPercent= (100 * $Total_yes) / 24;
    
    if($total_yes_inPercent>50){
        $result_evaluation='accepted';
        $sqll = "Update exam_bank set REQUEST_EVALUATION='$result_evaluation', COMMENT='$comment' where COURSE_ID='$co_id' and REQUEST_EVALUATION='asked' ";
        mysqli_query($con,$sqll);
        echo "<script>
            courseName.style.display = 'none';  
            examType.style.display = 'none'; 
            viewExam.style.display = 'none'; 
            sub_evaluate.style.display = 'none'; 
            </script>"; 
        echo "<script>alert('The Exam is Accepted and submitted Succefullly')</script>";
    }
    else {
        $result_evaluat='rejected';
        $sql2 = "Update exam_bank set REQUEST_EVALUATION='$result_evaluat', COMMENT='$comment' where COURSE_ID='$co_id' and REQUEST_EVALUATION='asked' ";
        mysqli_query($con,$sql2);
        echo "<script>
            courseName.style.display = 'none';  
            examType.style.display = 'none'; 
            viewExam.style.display = 'none'; 
            sub_evaluate.style.display = 'none'; 
            </script>"; 
        echo "<script>alert('The Exam is Rejected and submitted')</script>";
    }

}




}

?>