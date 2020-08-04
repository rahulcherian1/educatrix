<?php include_once('header.php'); ?>
<?php include_once('banner.php');
$factable = $table_prefix . 'teacher';



$fac_query = "SELECT `id`,`name`,`qualification`,`avail_from`,`avail_to`,`subject`  FROM $factable WHERE `status` = '1' AND `admin_verified` = '1'";

if($subject) {
    $fac_query .= " AND ".$subject." IN (`subject`)";
}
if($syllabus) {
    $fac_query .= " AND ".$syllabus." IN (`syllabus`)";
}

if($class) {
    $fac_query .= " AND ".$class." IN (`class`)";
}
$teachers = $NW_controller->execute_query($fac_query);
$count_fac = count($teachers);

function getSubjects($id,$ins) {
    $subtable = $table_prefix . 'subjects';
    if (id) {
    $res = "s";
    $query  = "SELECT `subject` FROM $subtable WHERE `id` IN ($id)";
    $data = $ins->execute_query($query);
    $out = array_map(function($d){
        return  $d['subject'];
    },$data);
    return implode($out,", ");
    }
}
?>
<section class="content">
         <div class="content-holder facult-bg">
         <h1 class="page-heading">Faculties</h1>
         <!--
         <div class="false-background">
             <img src="images/about-bg-2.png" alt="education background" />
         </div>
         -->
         <div>

         <?php if($count_fac > 0) {
             foreach($teachers as $index=>$fac) {
        ?>
         <div class="ribbon">
            <div class="sec1"><i class="fas fa-user"></i></div>
            <div class="sec2">
                <h2><?php echo $fac['name']; ?></h2>
                <h3><?php echo getSubjects($fac['subject'],$NW_controller); ?></h3>
                <h4><?php echo $fac['qualification']; ?></h4>
                <h4>Available from <?php echo date("H:i A", strtotime($fac['avail_from'])); ?> to
                <?php echo date("h:i A", strtotime($fac['avail_to'])); ?>  </h4>
            </div>
            <div class="sec3">
                <button class="profile">View Profile</button>
                <p class="spacefx">&nbsp;</p>
                <?php if($_SESSION['uid'] && $_SESSION['type'] == 'STUDENT') { ?>
                <button data-id="<?php echo $fac['id']; ?>" class="addtutor">Add as my tutor</button>
                <?php } ?>
         </div>
         </div>
         <?php } }  else {?>
            <p>Sorry no match found!</p>
         <?php } ?>
         </div>
         </div>
</section>
<?php include_once('footer.php'); ?>