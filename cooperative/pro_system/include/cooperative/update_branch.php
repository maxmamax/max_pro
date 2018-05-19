<?php include("../connect.php"); session_start();  date_default_timezone_set("Asia/Bangkok");?>
<?php
if($_POST['id_branch'] != ""){
  $sql = mysql_query("UPDATE tb_branch SET
branch_name = '".$_POST['branch_name']."',
branch_address = '".$_POST['branch_address']."',
branch_sdistrict = '".$_POST['branch_sdistrict']."',
branch_district = '".$_POST['branch_district']."',
branch_province = '".$_POST['branch_province']."',
branch_code = '".$_POST['branch_code']."',
branch_phone = '".$_POST['branch_phone']."',
branch_email = '".$_POST['branch_email']."',
branch_web = '".$_POST['branch_web']."' WHERE branch_key = '".$_POST['id_branch']."' AND coop_keyf = '".$_SESSION['session_key']."' ");
  if($sql){
 header("location: ../../index.php?page=branch_cooperative");
  }
}
?>
