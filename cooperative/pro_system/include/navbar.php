<?php session_start(); ?>
<style media="screen">
.navbar-brand{
  font-size: 25px;
}
.b1{
  font-color: black;
}
li { font-size: 20px;}
</style>
<nav class="navbar navbar-default" style="border-width:0px 0px 10px;border-color:#ff7b3a;">
  <div class="container-fluid" >
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header" >
      <button value="44" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php"><img src="header.png" width="330px;" height="80px;" style="margin-top:-15px;"></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" >
<?php if($_SESSION['session_status'] == '2' ){ ?>
<!-- เมนูย่อย 1 -->
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
          <?php if($_SESSION['session_status_menu'] == "cooperative"){
            echo "ข้อมูลสถานประกอบการ";
          }else if($_SESSION['session_status_menu'] == "student" || $_SESSION['session_status_menu'] == "teacher" || $_SESSION['session_status_menu'] == "staff" ){
            echo "ตำแหน่งงาน";
          }  ?>
            <span class="caret"></span></a>
          <ul class="dropdown-menu">
<!-- นักศึกษา -->
<?php if($_SESSION['session_status_menu'] == 'student' ){ ?>
            <li><a href="index.php?page=job_student">ตำแหนงงาน</a></li>
            <li><a href="index.php?page=job_register">ข้อมูลตำแหน่งงานที่จอง</a></li>
            <li><a href="index.php?page=job_reply">ข้อมูลสถานประกอบการสนใจ</a></li>
            <li><a href="index.php?page=report_apprentice">พิมพ์ใบรายงานการฝึกปฏิบัติงาน</a></li>
<?php } ?>

<!-- อาจารย์ -->
<?php if($_SESSION['session_status_menu'] == 'teacher' ){ ?>
            <li><a href="index.php?page=job_student">ตำแหนงงาน</a></li>
            <li><a href="index.php?page=data_job_student">ข้อมูลการจองตำแหน่งงานนักศึกษา</a></li>
            <li><a href="index.php?page=job_reply">ข้อมูลสถานประกอบการสนใจนักศึกษาเข้าร่วมฝึกปฏิบัติงาน</a></li>
            <li><a href="index.php?page=data_evaluation">ข้อมูลการประเมินการฝึกงานนักศึกษา</a></li>

<?php } ?>

<!-- พนักงาน -->
<?php if($_SESSION['session_status_menu'] == 'staff' ){ ?>
            <li><a href="index.php?page=job_student">ตำแหนงงาน</a></li>
            <li><a href="index.php?page=data_job_student">ข้อมูลการจองตำแหน่งงานนักศึกษา</a></li>
            <li><a href="index.php?page=job_reply">ข้อมูลสถานประกอบการสนใจนักศึกษาเข้าร่วมฝึกปฏิบัติงาน</a></li>
<?php } ?>


<!-- สถานประกอบการ -->
<?php if($_SESSION['session_status_menu'] == 'cooperative' ){ ?>
            <li><a href="index.php?page=job_cooperative">ตำแหน่งงาน</a></li>
            <li><a href="index.php?page=branch_cooperative">สาขาย่อย (ถ้ามี)</a></li>
            <!-- <li role="separator" class="divider"></li> -->
<?php } ?>
          </ul>
        </li>
      </ul>

<!-- เมนูย่อย 2 -->
      <ul class="nav navbar-nav">
        <li class="dropdown">
  <?php if($_SESSION['session_status_menu'] == 'cooperative' ){ ?>
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">การรับสมัคร<span class="caret"></span></a>
<?php } ?>

          <ul class="dropdown-menu">

  <!-- อาจารย์ -->
  <?php if($_SESSION['session_status_menu'] == 'teacher' ){ ?>
            <li><a href="index.php?page=job_student">ตำแหนงงาน</a></li>
            <li><a href="index.php?page=data_job_student">ข้อมูลการจองตำแหน่งงานนักศึกษา</a></li>
            <li><a href="index.php?page=job_reply">ข้อมูลสถานประกอบการสนใจนักศึกษา</a></li>
            <li><a href="index.php?page=data_record">ข้อมูลบันทึกประจำวันการฝึกปฏิบัติงานของนักศึกษา</a></li>
            <li><a href="index.php?page=data_record">บันทึกข้อมูลการนิเทศนักศึกษา</a></li>
            <li><a href="#">Separated link</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">One more separated link</a></li>
  <?php } ?>

  <!-- พนักงาน -->
  <?php if($_SESSION['session_status_menu'] == 'staff' ){ ?>
            <li><a href="index.php?page=job_student">ตำแหนงงาน</a></li>
            <li><a href="index.php?page=data_job_student">ข้อมูลการจองตำแหน่งงานนักศึกษา</a></li>
            <li><a href="index.php?page=job_reply">ข้อมูลสถานประกอบการสนใจนักศึกษา</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">One more separated link</a></li>
  <?php } ?>


  <!-- สถานประกอบการ -->
  <?php if($_SESSION['session_status_menu'] == 'cooperative' ){ ?>
            <li><a href="index.php?page=job_select">ตำแหน่งงานที่มีการสมัคร</a></li>
            <li><a href="index.php?page=student_interview">ข้อมูลกำหนดการสัมภาษณ์นักศึกษา</a></li>
            <li><a href="index.php?page=student_selection">ข้อมูลนักศึกษาผ่านการคัดเลือก</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="index.php?page=job_reply">การคัดเลือกนักศึกษาฝึกปฏิบัติงาน</a></li>
            <li><a href="index.php?page=student_practice">ข้อมูลการคัดเลือกนักศึกษาฝึกปฏิบัติงาน</a></li>
            <li><a href="index.php?page=evaluation">บันทึกข้อมูลแบบประเมินผลการฝึกงาน</a></li>
            <li role="separator" class="divider"></li>
  <?php } ?>
          </ul>
        </li>
      </ul>

<?php } ?>
      <form class="navbar-form navbar-left">

      </form>
      <ul class="nav navbar-nav navbar-right">

<?php
if($_SESSION['session_status_menu'] == 'student'){
?>
      <li><a href="คู่มือนักศึกษา" target="_blank"><span class="glyphicon glyphicon-book"></span>
      คู่มือการใช้งาน</a></li>
<?php }else if($_SESSION['session_status_menu'] == 'teacher'){
?>

      <li><a href="คู่มืออาจารย์" target="_blank"><span class="glyphicon glyphicon-book"></span>
      คู่มือการใช้งาน</a></li>
<?php }else if($_SESSION['session_status_menu'] == 'staff'){
?>
      <li><a href="คู่มือพนักงาน" target="_blank"><span class="glyphicon glyphicon-book"></span>
      คู่มือการใช้งาน</a></li>
<?php }else if($_SESSION['session_status_menu'] == 'cooperative'){
?>
      <li><a href="คู่มือสถานประกอบการ" target="_blank"><span class="glyphicon glyphicon-book"></span>
      คู่มือการใช้งาน</a></li>
<?php }else if($_SESSION['session_status_menu'] == ''){
?>
<li><a href="?page=register">ลงทะเบียนเข้าใช้งานระบบ <span class="glyphicon glyphicon-hand-left"></span></a></li>
      <li><a href="?page=login"><span class="glyphicon glyphicon-user"></span>
      เข้าสู่ระบบ</a></li>
<?php } ?>

<!--  นักศึกษา -->
<?php if($_SESSION['session_status_menu'] == 'student'){ ?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['session_name']." ".$_SESSION['session_lname']; ?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
<?php if($_SESSION['session_status'] == '2' ){ ?>
          <li><a href="index.php?page=job_application">แก้ไขข้อมูลใบสมัครงาน</a></li>
          <li><a href="index.php?page=form_edit">แก้ไขข้อมูลส่วนตัว</a></li>
<?php } ?>
            <li role="separator" class="divider"></li>
<?php if($_SESSION['session_status'] != '' ){ ?>
            <li><a href="include/logout.php">ออกจากระบบ</a></li>
<?php } ?>
          </ul>
        </li>
<?php } ?>


<!--  นักศึกษา -->
<?php if($_SESSION['session_status_menu'] == 'teacher'){ ?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['session_name']." ".$_SESSION['session_lname']; ?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
<?php if($_SESSION['session_status'] == '2' ){ ?>
          <li><a href="index.php?page=form_edit">แก้ไขข้อมูลส่วนตัว</a></li>
<?php } ?>
            <li role="separator" class="divider"></li>
<?php if($_SESSION['session_status'] != '' ){ ?>
            <li><a href="include/logout.php">ออกจากระบบ</a></li>
<?php } ?>
          </ul>
        </li>
<?php } ?>



<!--  พนักงาน -->
<?php if($_SESSION['session_status_menu'] == 'staff'){ ?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['session_name']." ".$_SESSION['session_lname']; ?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
<?php if($_SESSION['session_status'] == '2' ){ ?>
          <li><a href="index.php?page=form_edit">แก้ไขข้อมูลส่วนตัว</a></li>
<?php } ?>
            <li role="separator" class="divider"></li>
<?php if($_SESSION['session_status'] != '' ){ ?>
            <li><a href="include/logout.php">ออกจากระบบ</a></li>
<?php } ?>
          </ul>
        </li>
<?php } ?>


<!--  สถานประกอบการ -->
<?php if($_SESSION['session_status_menu'] == 'cooperative'){ ?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['session_name']." ".$_SESSION['session_lname']; ?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
<?php if($_SESSION['session_status'] == '2' ){ ?>
            <li><a href="index.php?page=form_edit">แก้ไขข้อมูลส่วนตัว</a></li>
<?php } ?>
            <li role="separator" class="divider"></li>
<?php if($_SESSION['session_status'] != '' ){ ?>
            <li><a href="include/logout.php">ออกจากระบบ</a></li>
<?php } ?>
          </ul>
        </li>
<?php } ?>

      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->

</nav>
