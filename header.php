<?php
session_start();
//ini_set('display_errors',0);
//error_reporting(0);
include "admin/db_mk_connect.php";
$img_prfix = $confOps['img_prefix'];
$table_prefix = $confOps['prefix'];
global $img_prfix, $table_prefix, $NW_controller;
$sy = $table_prefix . 'syllabus';
$su = $table_prefix . 'subjects';
$cl = $table_prefix . 'class';
$subdata = $NW_controller->execute_query(" SELECT `id`,`subject`  FROM $su WHERE `status` = '1'");
$sydata = $NW_controller->execute_query(" SELECT `id`,`syllabus`  FROM $sy WHERE `status` = '1'");
$cldata = $NW_controller->execute_query(" SELECT `id`,`class`  FROM $cl WHERE `status` = '1'");

function time_option()
{
    $endTime = "00:00:00";
    $data = '<option value="'.$endTime.'">'.date('h:i:A',strtotime($endTime)).'</option>';
    while (strtotime("23:45:00") != strtotime($endTime)) {
        $endTime = strtotime("+15 minutes", strtotime($endTime));
        $endTime = date('H:i:s', $endTime);
        $data .= '<option value="'.$endTime.'">'.date('h:i:A',strtotime($endTime)).'</option>';
    }
    return $data;
}
function getOption($data) {
      $out = '';
      extract($_GET);
      foreach($data as $d) {
          if($subject == $d[0] && array_key_exists("subject",$d)) {
            $s = "selected";
          } else {
            $s = "";
          }
          if($syllabus == $d[0] && array_key_exists("syllabus",$d)) {
            $y = "selected";
          } else {
            $y = "";
          }
          if($class == $d[0] && array_key_exists("class",$d)) {
            $c = "selected";
          } else {
            $c = "";
          }
          $out .= '<option '.$s.$y.$c.' value="'.$d[0].'">'.$d[1].'</option>';
      }
      return $out;
}

?>
<!doctype html>
<html>
   <head>
      <title>Educatrix</title>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="css/style.css">
      <script
			  src="http://code.jquery.com/jquery-3.3.1.min.js"
			  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
			  crossorigin="anonymous"></script>
      <script type="text/javascript" src="js/main.js" ></script>
   </head>
   <body>
      <div class="dialog-bg">
            <div class="login-register dialog">
            <i class="fas fa-times-circle closeDialog"></i>
                  <div class="tabs">
                        <h2>Login</h2>
                        <span  class="error_message"></span>
                  </div>
                  <hr>
                  <div class="content">
                        <div class="login">
                              <label>Email:</label><input type="text" name="l_email" />
                              <br>
                              <label>Password:</label><input type="password" name="l_password" />
                              <br>
                              <button id="submitlogin" class="yellow-btn wider">Submit</button>
                        </div>
                  </div>
            </div>
            <div class="register-dialog dialog">
                  <i class="fas fa-times-circle closeDialog"></i>
                  <div class="tabs">
                        <h2>Register</h2>
                        <span  class="error_message"></span>
                  </div>
                  <hr>
                  <div class="content">
                        <p>I am a <input type="radio" name="reg_type" checked value="0" /> student <input value="1" type="radio" name="reg_type"/> tutior</p>
                        <div class="student">
                              <label>Name:</label><input type="text" name="stud_username" />
                              <br>
                              <label>Email:</label><input type="text" name="stud_email" />
                              <br>
                              <label>Phone:</label><input type="text" name="stud_phone" />
                              <br>
                              <label>Skype Id:</label><input type="text" name="stud_skype" />
                              <br>
                              <label>Password:</label><input type="password" name="stud_passwd" />
                              <br>
                              <label>Confirm Password:</label><input type="password" name="stud_passwd2" />
                              <br>
                              <label>Available Time</label>
                              <select name="stud_from" style="width:90px;" >
                                    <option value="0">From</option>
                                    <?php echo time_option(); ?>
                              </select>
                              <select name="stud_to" style="width:90px; margin-left:15px;" >
                                    <option value="0">To</option>
                                    <?php echo time_option(); ?>
                              </select>
                              <br>
                              <label>Syllabus:</label>
                              <select name="stud_syllabus" >
                              <option value="0">Select a syllabus</option>
                                     <?php echo getOption($sydata); ?>
                              </select>
                              <br>
                              <label>Class:</label>
                              <select name="stud_class" >
                              <option value="0">Select a class</option>
                                    <?php echo getOption($cldata); ?>
                              </select>
                              <label>Subjects:</label>
                              <select name="stud_subjects"  multiple title="Press ctrl and select multiple">
                                    <?php echo getOption($subdata); ?>
                              </select>
                              <br>
                              <span class="info_span">Hold ctrl key to select multiple subjects</span>
                              <br>
                              <label>Comments:</label>
                              <textarea name="stud_comments"></textarea>
                              <br>
                              <button id="submitStudent" class="yellow-btn wider">Submit</button>
                        </div>
                        <div class="teacher">
                        <label>Name:</label><input type="text" name="t_name" />
                              <br>
                              <label>Email:</label><input type="text" name="t_email" />
                              <br>
                              <label>Phone:</label><input type="text" name="t_phone" />
                              <br>
                              <label>Skype Id:</label><input type="text" name="t_skype" />
                              <br>

                              <label>Highest Qualification:</label><input type="text" name="t_qualification" />
                              <br>
                              <label>Expected wages per hours:</label><input type="text" name="t_wages" />
                              <br>
                              <label>Password:</label><input type="password" name="t_passwd" />
                              <br>
                              <label>Confirm Password:</label><input type="password" name="t_passwd2" />
                              <br>
                              <label>Avaiable Time</label>
                              <select name="t_from" style="width:90px;" >
                                    <option value="0">From</option>
                                    <?php echo time_option(); ?>
                              </select>
                              <select name="t_to" style="width:90px; margin-left:15px;" >
                                    <option value="0">To</option>
                                    <?php echo time_option(); ?>
                              </select>
                              <br>
                              <label>Syllabus:</label>
                              <select name="t_syllabus" multiple title="Press ctrl and select multiple">
                                <?php echo getOption($sydata); ?>
                              </select>
                              <br>
                              <label>Class:</label>
                              <select name="t_class" multiple title="Press ctrl and select multiple">
                                <?php echo getOption($cldata); ?>
                              </select>
                              <br>
                              <label>Subjects:</label>
                              <select name="t_subjects"  multiple title="Press ctrl and select multiple">
                                    <?php echo getOption($subdata); ?>
                              </select>
                              <br>
                              <span class="info_span">Hold ctrl key to select multiple subjects</span>
                              <br>
                              <label>Comments:</label>
                              <textarea name="t_comments"></textarea>
                              <br>
                              <button id="submitTeacher" class="yellow-btn wider">Submit</button>
                        </div>

                  </div>
            </div>
      </div>
      <header>
         <section class="logo-area">
            <div class="page-center">
               <div class="logo-holder">
                  <img src="images/logo.png" alt="logo" class="logo" />
               </div>
               <div class="button-holder">
                  <div class="buttons">
                  <?php if($_SESSION['uid']) { ?>
                  <p class="login-para">Welcome <a title="click here to see <?php echo $_SESSION['name']; ?>'s dashboard" href="<?php if($_SESSION['type'] == 'STUDENT') { ?>student_dashboard.php<?php } else { ?>teacher_dashboard.php<?php } ?>?id=<?php echo $_SESSION['uid']; ?>"><?php echo $_SESSION['name']; ?> </a>| <a  title="Logout" href="logout.php?id=<?php echo $_SESSION['uid']; ?> ">Logout</a></p>
                  <?php } else { ?>
                     <button  id="login" class="yellow-btn wider">Login</button>
                     <button id="register" class="yellow-btn wider">Register</button>
                  <?php } ?>
                  </div>
                  <div class="search">
                     <input type="text" name="search" class="search-input" placeholder="Site Search" />
                  </div>
               </div>
            </div>
         </section>
         <nav class="navmenu">
            <ul>
               <li><a href="index.php">Home</a></li>
               <li><a href="about.php">About</a></li>
               <li><a href="#">Programms</a></li>
               <li><a href="#">Admissions</a></li>
               <li><a href="faculty.php">Faculty</a></li>
               <li><a href="#">Contact us</a></li>
            </ul>
         </nav>
      </header>