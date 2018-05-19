<?php include("../connect.php"); session_start();  date_default_timezone_set("Asia/Bangkok"); ?>
<?php
if($_POST['id_student'] != '' && $_SESSION['session_status_menu'] == 'cooperative'){
  $sql = mysql_query("INSERT INTO tb_reply_s VALUES ('','".$_POST['id_student']."','".$_SESSION['session_key']."','".$_POST['message_practice']."') ");
if($sql){
   header("location: ../../index.php?page=job_reply");
}
}
?>
