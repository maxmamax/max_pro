<?php include("../../include/connect.php");  include("../../email/email.php"); session_start();  date_default_timezone_set("Asia/Bangkok");?>
<?php
if($_SESSION['session_status_menu'] == 'cooperative' ) {

  $date = date("Y-m-d");
if($_POST['status_seletc'] == '1'){
  $sql = mysql_query("SELECT * FROM tb_interview WHERE student_keyf = '".$_POST['key_student']."' AND position_keyf = '".$_POST['key_position']."' ");
  $fet = mysql_fetch_array($sql);

  if(!$fet){
  $sql = mysql_query("INSERT INTO tb_interview VALUES ('','".$_POST['key_student']."','".$_POST['key_position']."','$date','".$_POST['inter_date']."','".$_POST['inter_place']."','".$_POST['inter_time']."','".$_POST['message_add']."') ");
  $sql1 = mysql_query("UPDATE  tb_register_job SET job_status = '1' WHERE  student_keyf = '".$_POST['key_student']."' AND  position_keyf = '".$_POST['key_position']."' ");
  }
}else if($_POST['status_seletc'] == '2'){
  $sql = mysql_query("SELECT * FROM tb_practice WHERE student_keyf = '".$_POST['key_student']."' AND position_keyf = '".$_POST['key_position']."' ");
  $fet = mysql_fetch_array($sql);
  if(!$fet){

 if($_POST['r'] == '2'){
  $sql1 = mysql_query("UPDATE  tb_register_job SET job_status = '2' WHERE  student_keyf = '".$_POST['key_student']."' AND position_keyf = '".$_POST['key_position']."' ");
}else if($_POST['r'] == '1'){
  $sql = mysql_query("INSERT INTO tb_practice VALUES ('','".$_POST['key_student']."','".$_POST['key_position']."','$date','".$_POST['prac_date']."','".$_POST['prac_time']."','".$_POST['message_add1']."') ");
   $sql1 = mysql_query("UPDATE  tb_register_job SET job_status = '3' WHERE  student_keyf = '".$_POST['key_student']."' AND position_keyf = '".$_POST['key_position']."' ");
 }
}
}

$sql = mysql_query("SELECT student_email FROM tb_student WHERE student_key = '".$_POST['key_student']."' ");
$fet = mysql_fetch_array($sql);
$e = $fet['student_email'];
sentEmail_status($e);

//header("location: ../../../index.php?page=job_student&key=$_POST['key_position']");
//$sql = mysql_query("UPDATE tb_position SET position_status = '1' WHERE position_key = '".$_POST['id']."' AND position_status = '0' AND coop_keyf = '".$_SESSION['session_key']."'  ");

}
?>
