<?php include("../connect.php"); session_start();  date_default_timezone_set("Asia/Bangkok");?>
<?php
if($_SESSION['session_status_menu'] == 'cooperative' && $_POST['status_job'] != ''){
if($_POST['status_job'] == '3'){
$sql = mysqL_query("SELECT count(inter_id) as num FROM  tb_interview WHERE student_keyf = '".$_POST['student_key']."' AND position_keyf = '".$_POST['position_key']."' ");
$fet = mysql_fetch_array($sql);
if($fet['num'] == '0'){
  $sql = mysql_query("INSERT INTO  tb_interview VALUES ('','".$_POST['student_key']."','".$_POST['position_key']."','".$_POST['inter_date']."','".$_POST['inter_time']."','".$_POST['inter_note']."') ");
}
}
  $sql = mysql_query("UPDATE tb_register_job SET
  job_status = '".$_POST['status_job']."' WHERE student_keyf = '".$_POST['student_key']."' AND position_keyf = '".$_POST['position_key']."' ");
}
 $re = " ../../index.php?page=job_student&student=$_POST[student_key]&position=$_POST[position_key] ";
 header("location: $re ");
?>
