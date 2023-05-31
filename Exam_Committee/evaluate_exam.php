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
    <link rel="stylesheet" href="../asset/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../asset/css/adminlte.min.css">
    <link rel="stylesheet" href="../asset/css/style.css">
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
                  <li> 
                       <!-- data such(course, exam tipe) should retrieve from database of the teacher -->
                           <label for="data">Course Name:</label>&nbsp&nbsp
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
                                    echo $c_name;  
                                    }
                                }
                                else{
                                    echo 'There is NO REQUEST.';
                                }
                            ?>
                            <span id="examType" style="display: none;"> <label for="data">Exam Type:</label>&nbsp&nbsp <?php echo $exam_type; ?>  </span>
                          
                           <br>
                            <!-- use php to retrieve exam from teacher page or database-->
                            <span id="viewExam" style="display: none;"> <label for="data">View Exam :</label>&nbsp&nbsp&nbsp
                              <a href=" exam_detail.php">  <button name="view_exam_submit" id="retrieveButton" class="btn btn-primary"  >Exam detail</button> </a>
                            </span>
                            
                    
                            <div id="dataContainer">
                            <!-- placeholder to display data-->
                            </div>
                            <!-- <script>
                            document.getElementById("retrieveButton").addEventListener("click", function() {
                            // Perform an AJAX request to retrieve data
                            var xhr = new XMLHttpRequest();
                            xhr.open("GET", "retrieve_data.php", true);
                            xhr.onreadystatechange = function() {
                                if (xhr.readyState === 4 && xhr.status === 200) {
                                    // Update the data container with the retrieved data
                                    document.getElementById("dataContainer").innerHTML = xhr.responseText;
                                }
                            };
                            xhr.send();
                            });
                            </script> -->
                  </li>
                  <br>
                        <!-- each checkbox value and other comment should calculated by percentage and
                        if persent is greater than 50% the exam should summite to main exam bank 
                        which means ready for student   -->
                  <li >check list for general parameter and test format</li>
                     <table style="width:100%" border="1">
                  
                        <tr>
                           <th rowspan="2">S.No</th>
                           <th rowspan="2">Content</th>
                           <th colspan="2">Observation</th>
                         
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
                           <input type="radio" id="html" name="fav_language" value="HTML">
                           <label for="html"></label>
                           </td>
                           <td><input type="radio" id="html" name="fav_language" value="HTML"></td>
                        
                        </tr>
                        <tr>
                           <td>2.</td>
                           <td>Are the items appropriate for the objective?</td>
                           <td>
                           <input type="radio" id="html" name="fav_language1" value="HTML">
                           <label for="html"></label>
                           </td>
                           <td><input type="radio" id="html" name="fav_language1" value="HTML"></td>
                           
                        </tr>
                        <tr>
                           <td>3.</td>
                           <td>Does the test items measure impotant concepts such as understanding of basic principles and practical applications?</td>
                           <td>
                           <input type="radio" id="html" name="fav_language2" value="HTML">
                           <label for="html"></label>
                           </td>
                           <td><input type="radio" id="html" name="fav_language2" value="HTML"></td>
                           
                        </tr>
                        <tr><td colspan="5" align="center"><strong>Test Format</strong></td></tr>
                        <td>1.</td>
                           <td>Are items arranged in order of difficulty from easy to hard?</td>
                           <td>
                           <input type="radio" id="html" name="fav_language3" value="HTML">
                           <label for="html"></label>
                           </td>
                           <td><input type="radio" id="html" name="fav_language3" value="HTML"></td>
                           
                        </tr>
                        <tr>
                           <td>2.</td>
                           <td>Are items properly spaced for easy reading and ansewring?</td>
                           <td>
                           <input type="radio" id="html" name="fav_language4" value="HTML">
                           <label for="html"></label>
                           </td>
                           <td><input type="radio" id="html" name="fav_language4" value="HTML"></td>
                           
                        </tr>
                        <tr>
                           <td>3.</td>
                           <td>Are Complete test items on the same page? Codes on the same page with its items?</td>
                           <td>
                           <input type="radio" id="html" name="fav_language5" value="HTML">
                           <label for="html"></label>
                           </td>
                           <td><input type="radio" id="html" name="fav_language5" value="HTML"> </td>
                        </tr>
                        <!-- </tr>
                        <td>4.</td>
                        <td>Are blank for names ?</td>
                        <td>
                        <input type="radio" id="html" name="fav_language6" value="HTML">
                        <label for="html"></label>
                        </td>
                        <td><input type="radio" id="html" name="fav_language6" value="HTML"> -->
                           
                        <!-- </tr>
                        <tr>
                           <td>4.</td>
                           <td>Are directions clear and complete?</td>
                           <td>
                           <input type="radio" id="html" name="fav_language7" value="HTML">
                           <label for="html"></label>
                           </td>
                           <td><input type="radio" id="html" name="fav_language7" value="HTML">
                           
                        </tr> --> 
                        <tr>
                           <td>4.</td>
                           <td>Is there sufficient time for students to complete the test?</td>
                           <td>
                           <input type="radio" id="html" name="fav_language7" value="HTML">
                           <label for="html"></label>
                           </td>
                           <td><input type="radio" id="html" name="fav_language7" value="HTML"> </td>
                           
                        </tr>
                        <tr>
                           <td>5.</td>
                           <td>is provide a point value/weight for answering each item?</td>
                           <td>
                           <input type="radio" id="html" name="fav_language8" value="HTML">
                           <label for="html"></label>
                           </td>
                           <td> <input type="radio" id="html" name="fav_language8" value="HTML"> </td>
                        </tr>
                    </table>
                    <br>
                  <li >check list for diffrent item type</li>
                    <table style="width:100%" border="1">
                        
                        <tr>
                            <th rowspan="2">S.No</th>
                            <th rowspan="2">Content</th>
                            <th colspan="2">Observation</th>
                            
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
                            <input type="radio" id="html" name="fav_language11" value="HTML">
                            <label for="html"></label>
                            </td>
                            <td><input type="radio" id="html" name="fav_language11" value="HTML"> </td>
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td>Use nagative statements sparingly. Eliminate double negatives.</td>
                            <td>
                            <input type="radio" id="html" name="fav_language22" value="HTML">
                            <label for="html"></label>
                            </td>
                            <td><input type="radio" id="html" name="fav_language22" value="HTML"> </td>
                        </tr>
                        <tr>
                            <td>3.</td>
                            <td>Avoid specific determiners(E.g always, sometimes,may...)</td>
                            <td>
                            <input type="radio" id="html" name="fav_language33" value="HTML">
                            <label for="html"></label>
                            </td>
                            <td>
                                <input type="radio" id="html" name="fav_language33" value="HTML">
                                <label for="html"></label>
                            </td>
                        </tr>

                        <tr><td colspan="5" align="center">Multiple Choice Question</td></tr>
                        <td>1.</td>
                            <td>Are problems stated clearly; at appropriate language level?</td>
                            <td>
                            <input type="radio" id="html" name="fav_language77" value="HTML">
                            <label for="html"></label>
                            </td>
                            <td><input type="radio" id="html" name="fav_language77" value="HTML"></td>
                            
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td>is the item stated in the positive form(does not use "not" or "never")</td>
                            <td>
                            <input type="radio" id="html" name="fav_language88" value="HTML">
                            <label for="html"></label>
                            </td>
                            <td><input type="radio" id="html" name="fav_language88" value="HTML"></td>          
                        </tr>
                        <tr>
                            <td>3.</td>
                            <td>Are there at least there alternative answers? </td>
                            <td>
                            <input type="radio" id="html" name="fav_language99" value="HTML">
                            <label for="html"></label>
                            </td>
                            <td><input type="radio" id="html" name="fav_language99" value="HTML"></td>   
                        </tr>
                        <td>4.</td>
                            <td>Is each alternative listed in a separate line?</td>
                            <td>
                            <input type="radio" id="html" name="fav_language00" value="HTML">
                            <label for="html"></label>
                            </td>
                            <td><input type="radio" id="html" name="fav_language00" value="HTML"></td>  
                        </tr>
                        <tr>
                            <td>5.</td>
                            <td>The alternative are similar (same length, same type of content, same grammatical construction)?</td>
                            <td>
                            <input type="radio" id="html" name="fav_language9" value="HTML">
                            <label for="html"></label>
                            </td>
                            <td><input type="radio" id="html" name="fav_language9" value="HTML"></td>  
                        </tr>
                        <tr>
                            <td>6.</td>
                            <td>The alternatives are free from hints as to which response is correct. </td>
                            <td>
                            <input type="radio" id="html" name="fav_language0" value="HTML">
                            <label for="html"></label>
                            </td>
                            <td><input type="radio" id="html" name="fav_language0" value="HTML"></td>
                        </tr>
                        <tr>
                            <td>7.</td>
                            <td>The alternatives "All of the above" and "None of the above" are not used. The alternatives are fre from imprecise terms("usually","frequently") </td>
                            <td>
                            <input type="radio" id="html" name="fav_language0" value="HTML">
                            <label for="html"></label>
                            </td>
                            <td><input type="radio" id="html" name="fav_language0" value="HTML"></td>
                        </tr>
                        <tr>
                            <td>8.</td>
                            <td>There are only one correct or clear best answer (optinal). </td>
                            <td>
                            <input type="radio" id="html" name="fav_language0" value="HTML">
                            <label for="html"></label>
                            </td>
                            <td><input type="radio" id="html" name="fav_language0" value="HTML"></td>
                        </tr>
                        <tr>
                            <td>9.</td>
                            <td>Capital letters (A,B,C,D) are used as labels for the alternatives. </td>
                            <td>
                            <input type="radio" id="html" name="fav_language0" value="HTML">
                            <label for="html"></label>
                            </td>
                            <td><input type="radio" id="html" name="fav_language0" value="HTML"></td>
                        </tr>
                                   
                        <tr><td colspan="5" align="center">Short Answer Questions</td></tr>
                        <td>1.</td>
                            <td>Direct Questions when possible?</td>
                            <td>
                            <input type="radio" id="html" name="fav_language111" value="HTML">
                            <label for="html"></label>
                            </td>
                            <td><input type="radio" id="html" name="fav_language111" value="HTML"></td> 
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td></td>
                            <td>
                            <input type="radio" id="html" name="fav_language222" value="HTML">
                            <label for="html"></label>
                            </td>
                            <td><input type="radio" id="html" name="fav_language222" value="HTML"></td>     
                        </tr>
                        <tr><td colspan="5" align="center">Essay Type Questions</td></tr>
                        <td>1.</td>
                            <td>Does the exam item match the course objective?</td>
                            <td>
                            <input type="radio" id="html" name="fav_language333" value="HTML">
                            <label for="html"></label>
                            </td>
                            <td><input type="radio" id="html" name="fav_language333" value="HTML"></td>   
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td></td>
                            <td>
                            <input type="radio" id="html" name="fav_language444" value="HTML">
                            <label for="html"></label>
                            </td>
                            <td><input type="radio" id="html" name="fav_language444" value="HTML"></td>    
                        </tr>
                        <tr>
                            <td>3.</td>
                            <td></td>
                            <td>
                            <input type="radio" id="html" name="fav_language555" value="HTML">
                            <label for="html"></label>
                            </td>
                            <td><input type="radio" id="html" name="fav_language555" value="HTML"></td>    
                        </tr>
                    </table>
            </ol>
            <div id="sub_evaluate" style="display: none;">
            <form id="examForm">
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
                    </div><br>
                    
                    <!-- Add more criteria fields based on your evaluation criteria -->
                    
                    <label for="comments">Comments:</label><br>
                    <textarea id="comments" name="comments" rows="4" cols="100"></textarea><br>
                    <br>
                    <button name="submit_evaluation" class="btn btn-success" style="width: 17%; " >Submit Evaluation</button>
                    <br><br><br><br>
            </form>
            </div> 

            <script>
                var examType = document.getElementById('examType');
                var viewExam = document.getElementById('viewExam');
                var sub_evaluate = document.getElementById('sub_evaluate');
            </script>
            <?php   
                if($cou_exist>0)
                {
                    echo "<script> 
                    examType.style.display = 'block'; 
                    viewExam.style.display = 'block'; 
                    sub_evaluate.style.display = 'block'; 
                    </script>"; 
                }       
            ?>
        
        </div>      
        </div>
    </div>
<script src="asset/jquery/jquery.min.js"></script>
<script src="asset/js/adminlte.js"></script>
</body>
</html>


<?php

    }

?>