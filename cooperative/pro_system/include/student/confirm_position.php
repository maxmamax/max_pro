<?php include("../connect.php"); session_start();  date_default_timezone_set("Asia/Bangkok");?>
<?php
$sql = mysql_query("SELECT count(register_key) as num FROM  tb_register_job WHERE student_keyf = '".$_SESSION['session_key']."' AND job_status = '4' ");
$fet = mysql_fetch_array($sql);
if($fet['num'] == "0"){
$sql = mysql_query("UPDATE tb_register_job SET
job_status = '4' WHERE student_keyf = '".$_SESSION['session_key']."' AND position_keyf = '".$_POST['key_position']."'
");
}
header("location: ../../index.php?page=record_practice");
?>
