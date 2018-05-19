<?php include("../connect.php"); session_start(); date_default_timezone_set("Asia/Bangkok"); ?>
<?php
$sql = mysql_query("UPDATE tb_record SET
record_date = '".$_POST['record_date']."',
record_work = '".$_POST['record_work']."',
record_problems = '".$_POST['record_problems']."' WHERE record_id = '".$_POST['id']."' AND student_keyf = '".$_SESSION['session_key']."'
");
?>
