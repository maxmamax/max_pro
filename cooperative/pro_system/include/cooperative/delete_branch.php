<?php include("../connect.php"); session_start();  date_default_timezone_set("Asia/Bangkok");?>
<?php
if($_POST['id'] != ""){
  $sql = mysql_query("DELETE FROM tb_branch WHERE branch_key = '".$_POST['id']."' AND coop_keyf = '".$_SESSION['session_key']."' ");
  if($sql){
     header("location: ../../index.php?page=branch_cooperative");
  }
}
?>
