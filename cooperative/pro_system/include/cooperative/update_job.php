<?php include("../connect.php"); session_start();  date_default_timezone_set("Asia/Bangkok");?>
<?php
if($_POST['id_position'] != ""){
$sql = mysql_query("UPDATE tb_position SET
position_name = '".$_POST['position_name']."',
position_depart = '".$_POST['position_depart']."',
position_dateF = '".$_POST['position_dateS']."',
position_dateL = '".$_POST['position_dateL']."',
position_property = '".$_POST['message_add']."',
position_money = '".$_POST['message_add1']."',
position_register = '".$_POST['position_register']."',
branch_keyf = '".$_POST['branch_keyf']."' WHERE position_key = '".$_POST['id_position']."' AND coop_keyf = '".$_SESSION['session_key']."' ");
if($sql){
header("location: ../../index.php?page=job_cooperative");
}
}
?>
