<?php include("../connect.php"); session_start();?>
<?php
if($_SESSION['session_status_menu'] == 'cooperative'  && $_POST['branch_name'] != ''){
$sql = mysql_query("INSERT INTO tb_branch VALUES ('','".$_SESSION['session_key']."','".$_POST['branch_name']."','".$_POST['branch_address']."','".$_POST['branch_sdistrict']."','".$_POST['branch_district']."','".$_POST['branch_province']."','".$_POST['branch_code']."','".$_POST['branch_phone']."','".$_POST['branch_email']."','".$_POST['branch_web']."') ");
if($sql){
 header("location: ../../index.php?page=branch_cooperative ");
}
}else{
  header("location: ../../index.php ");
}
?>
