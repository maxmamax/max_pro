<?php include("../connect.php"); session_start();  date_default_timezone_set("Asia/Bangkok");?>
<?php
if($_POST['id'] != ""){
$sql = mysql_query("DELETE FROM tb_register_job WHERE register_key = '".$_POST['id']."' AND student_keyf = '".$_SESSION['session_key']."' ");

}
?>
