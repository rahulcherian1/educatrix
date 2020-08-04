<?php include_once('header.php');
$uid = $_SESSION['uid'];
?>
<?php if(!$uid) { ?>
<script>
    var uri = window.location.href.split('/');
    delete uri[uri.length -1];
    window.location.href = uri.join('/');
</script>
<?php
exit();
} ?>

<?php include_once('banner.php');

$st = $table_prefix . 'student_teacher';
$te = $table_prefix . 'teacher';
$teq = "SELECT * FROM `student_teacher` WHERE `student_id` = '$uid'";
$tedata = $NW_controller->execute_query($teq);
$requestCount = count($tedata);
$msg = ['request is under processing', 'request approved', 'request rejected'];
function getTeacher($id, $ins) {
    $s = $ins->execute_query("SELECT  `name` FROM `teacher` WHERE `id` = '$id'");
    return '<a href="#'.$id.'">'.$s[0]['name'].'</a>';
}
?>
<section class="content">
         <div class="content-holder student-bg">
         <h1 class="page-heading">Dashboard</h1>
         <div class="false-background">
             <img src="images/edu-bg.png" alt="education background" />
         </div>

         <!-- list all teacher requests -->

         <div class="tution-requests">
             <h1>Tution Requests</h1>
             <div class="cont-hld">
             <?php if($requestCount == 0) {  ?>
                <p>No Requests!</p>
            <?php } else {
                foreach($tedata as $t){
                ?>
                <p> You have requested for <?php echo getTeacher($t['teacher_id'],$NW_controller); ?>,
                <?php echo $msg[$t['approve']]; ?> </p>
            <?php } } ?>
            </div>
         </div>

         <div class="time-table">
             <h1>Time Table</h1>
            <div class="cont-hld">
            <p>Not available!</p>
            </div>

         </div>
         </div>
</section>
<?php include_once('footer.php'); ?>