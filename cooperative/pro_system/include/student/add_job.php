<?php include("../connect.php"); include("../../email/email.php"); session_start();  date_default_timezone_set("Asia/Bangkok");?>
<?php
if($_SESSION['session_status_menu'] == 'student' && $_POST['coop_keyf'] != ""){
    $date = date('Y-m-d');
 $sql = mysql_query("INSERT INTO tb_register_job VALUES ('','".$_SESSION['session_key']."','".$_POST['coop_keyf']."','".$_POST['position_keyf']."','$date','0') ");
 $sql1 = mysql_query("UPDATE tb_position SET position_rate = position_rate+1 WHERE position_key = '".$_POST['position_keyf']."' ");
if($sql){

$sql1 = mysql_query("SELECT coop_email FROM tb_cooperative WHERE coop_key = '".$_POST['coop_keyf']."' ");
$fet1 = mysql_fetch_array($sql1);
$e =  $fet1['coop_email'];
$sql2 = mysql_query("SELECT count(register_key) as num FROM tb_register_job WHERE position_keyf = '".$_POST['position_keyf']."' ");
$fet2 = mysql_fetch_array($sql2);
if($fet2['num'] == "1"){
  sentEmail_position($e);
}
header("location: ../../index.php?page=job_register");
}
header("location: ../../index.php?page=job_register");
}
?>
