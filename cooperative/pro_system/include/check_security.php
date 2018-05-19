<?php session_start(); include("connect.php"); ?>
<?php if($_SESSION['session_status'] == '1' &&   $_SESSION['session_status_menu'] == 'student'){
$sql = mysql_query("SELECT * FROM tb_security_student WHERE security_student = '".$_POST['security']."' ");
if($fet = mysql_query($sql1)){
  $sql1 = mysql_query("UPDATE  tb_student SET student_status = '2' WHERE student_key = '".$_SESSION['session_key']."' ");
}else{ ?>
<script type="text/javascript">
  alert("รหัสยืนยันของคุณไม่ถูกต้อง");
  timedCount(5);
</script>
<?php
 header("location: ../index.php ");
  }
}else if($_SESSION['session_status'] == '1' &&   $_SESSION['session_status_menu'] == 'teacher'){
$sql = mysql_query("SELECT * FROM tb_security_teacher WHERE security_teacher = '".$_POST['security']."' ");
if($fet = mysql_query($sql1)){
  $sql1 = mysql_query("UPDATE tb_teacher SET teacher_status = '2' WHERE teacher_key = '".$_SESSION['session_key']."' ");
}else{ ?>
<script type="text/javascript">
  alert("รหัสยืนยันของคุณไม่ถูกต้อง");
  timedCount(5);
</script>
<?php
// header("location: ../index.php ");
  }
}else{
//  header("location: ../index.php ");
} ?>
