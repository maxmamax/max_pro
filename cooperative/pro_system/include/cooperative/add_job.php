<?php include("../connect.php"); session_start();  date_default_timezone_set("Asia/Bangkok");?>
<?php
if($_SESSION['session_status_menu'] == 'cooperative' && $_POST['position_name']){
$age = $_POST['position_age1']."-".$_POST['position_age2'];
$sql = mysql_query("INSERT INTO tb_position VALUES ('','".$_SESSION['session_key']."','".$_POST['position_name']."','".$_POST['position_typef']."','".$_POST['position_dateS']."','".$_POST['position_dateL']."','".$_POST['position_sex']."','$age','".$_POST['position_edu']."','".$_POST['position_eduorter']."','".$_POST['message_add']."','".$_POST['position_bonus']."','".$_POST['position_acco']."','".$_POST['position_uniform']."','".$_POST['position_diligence']."','".$_POST['position_medical']."','".$_POST['message_add1']."','".$_POST['position_register']."','0','".$_POST['branch_keyf']."','0') ");
echo $_POST['position_bonus'];
}
if($sql){
 //header("location: ../../index.php?page=job_cooperative");
}else{
  //header("location: ../../index.php ");
}
?>
