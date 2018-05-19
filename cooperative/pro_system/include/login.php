<?php session_start(); include("connect.php"); ob_start(); ?>
<style media="screen">

  <?php  include('dist/css/login.css'); ?>

</style>

<!-- นักศึกษา -->
<?php if($_SESSION['session_status'] == '1' &&   $_SESSION['session_status_menu'] == 'student' && $_POST['security'] != '' ){
$sql = mysql_query("SELECT * FROM tb_security_student WHERE security_key = '".$_POST['security']."' AND security_student = '".$_SESSION['session_key']."' ");
$fet = mysql_fetch_array($sql);
if($fet){
  $sql1 = mysql_query("UPDATE tb_student SET student_status = '2' WHERE student_key = '".$_SESSION['session_key']."' ");
  $_SESSION['session_status'] = '2';
?>
  <script type="text/javascript">
    alert("ยืนยันการเข้าสู่ระบบเรียบร้อย");
setTimeout("location.href = 'index.php';",1500);
  </script>
<?php
}else{ ?>
<script type="text/javascript">
  alert("รหัสยืนยันของคุณไม่ถูกต้อง");
</script>

<?php }  }?>


<!-- สถานประกอบการ -->
<?php if($_SESSION['session_status'] == '1' &&   $_SESSION['session_status_menu'] == 'cooperative' && $_POST['security'] != '' ){
$sql = mysql_query("SELECT * FROM tb_security_cooperative WHERE security_key = '".$_POST['security']."' AND security_cooperative = '".$_SESSION['session_key']."' ");
$fet = mysql_fetch_array($sql);
if($fet){
  $sql1 = mysql_query("UPDATE  tb_cooperative SET coop_status = '2' WHERE coop_key = '".$_SESSION['session_key']."' ");
  $_SESSION['session_status'] = '2';
?>
  <script type="text/javascript">
    alert("ยืนยันการเข้าสู่ระบบเรียบร้อย");
  </script>
<?php
}else{ ?>
<script type="text/javascript">
  alert("รหัสยืนยันของคุณไม่ถูกต้อง");
</script>

<?php }
} ?>

<!-- อาจารย์ -->
<?php
 if($_SESSION['session_status'] == '1' &&   $_SESSION['session_status_menu'] == 'teacher' && $_POST['security'] != '' ){
$sql = mysql_query("SELECT * FROM tb_security_teacher WHERE security_key = '".$_POST['security']."' AND security_teacher = '".$_SESSION['session_key']."' ");
$fet = mysql_fetch_array($sql);
if($fet){
  $sql1 = mysql_query("UPDATE  tb_teacher SET teacher_status = '2' WHERE teacher_key = '".$_SESSION['session_key']."' ");
  $_SESSION['session_status'] = '2';
?>
  <script type="text/javascript">
    alert("ยืนยันการเข้าสู่ระบบเรียบร้อย");
  </script>
<?php
}else{ ?>
<script type="text/javascript">
  alert("รหัสยืนยันของคุณไม่ถูกต้อง");
</script>

<?php }
} ?>



<!-- พนักงาน -->
<?php
 if($_SESSION['session_status'] == '1' &&   $_SESSION['session_status_menu'] == 'staff' && $_POST['security'] != '' ){
$sql = mysql_query("SELECT * FROM tb_security_staff WHERE security_key = '".$_POST['security']."' AND security_staff = '".$_SESSION['session_key']."' ");
$fet = mysql_fetch_array($sql);
if($fet){
  $sql1 = mysql_query("UPDATE  tb_staff SET staff_status = '2' WHERE staff_key = '".$_SESSION['session_key']."' ");
  $_SESSION['session_status'] = '2';
?>
  <script type="text/javascript">
    alert("ยืนยันการเข้าสู่ระบบเรียบร้อย");
  </script>
<?php
}else{ ?>
<script type="text/javascript">
  alert("รหัสยืนยันของคุณไม่ถูกต้อง");
</script>

<?php }
}


if($_SESSION['session_status'] != '2') {?>
			<div class="loginmodal-container" >
        <div align="center"><font style="font-size:50px;" ><span class="glyphicon glyphicon-user"></span></font></div>

        <font><h1>ยินต้อนรับ เข้าสู่ระบบเพื่อใช้งาน</h1></font><br>
<?php if($_SESSION['session_status'] == ''){ ?>
          <form action="include/check_login.php" method="post">
					<input type="text" name="user" placeholder="ชื่อผู้ใช้" >
					<input type="password" name="pass" placeholder="รหัสผ่าน">
					<input type="submit" name="login" class="login loginmodal-submit" value="เข้าสู่ระบบ">
          <font style="font-size:20px"><a href="?page=register">ลงทะเบียนเข้าใช้งานระบบ <span class="glyphicon glyphicon-hand-left"></span></a></font>
        </form>
<?php }else if($_SESSION['session_status'] == '1'){ ?>
  <form action="index.php?page=login" method="post">
  <font ><h4 style="">ป้อนรหัสยืนยันเข้าสู่ระบบเพื่อใช้งาน</h4></font>
  <input type="text" name="security" placeholder="รหัสยืนยันการเข้าใช้งานระบบ" >
  <input type="submit" name="login" class="login loginmodal-submit" value="ยืนยันการเข้าสู่ระบบ">
  <a href="include/logout.php"><h1>ออกจากระบบ</h1></a>
</form>
<br>
</div>
<?php }else if($_SESSION['session_status'] == '0'){
header("location: include/logout.php");
}

}?>
