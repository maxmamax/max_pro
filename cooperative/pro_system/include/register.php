<?php include("connect.php"); ?>
<style media="screen">
  .f{
    font-size: 20px;
  }
  .f1{
    font-size: 20px;

  }
</style>
<div align="center">
<div class="panel panel-default " style="width:90%;text-align:left;" >
<div class="panel-heading"><font style="font-size:25px">ลงทะเบียนเข้าใช้งาน <span class="glyphicon glyphicon-user"></font></div>
<div class="panel-body">
  <div class="form-group">
      <label class="control-label col-sm-3 col-md-3" for="pwd" align="right"><font class="f">กรุณเลือกประเภทผู้ใช้งาน : </font></label>
      <div class="col-md-2 col-sm-2">
        <form action="index.php" method="get" id="target">
        <input type="hidden" name="page" value="register">
        <select class="form-control" name="select" id="select" >
          <option value="">-- ประเภทผู้ใช้งาน --</option>
          <option value="form_student" <?php if($_GET['select'] == "form_student"){ ?> selected <?php } ?> >นักศึกษา</option>
          <option value="form_teacher" <?php if($_GET['select'] == "form_teacher"){ ?> selected <?php } ?>>อาจารย์</option>
          <option value="form_staff" <?php if($_GET['select'] == "form_staff"){ ?> selected <?php } ?>>พนักงาน</option>
          <option value="form_cooperative"<?php if($_GET['select'] == "form_cooperative"){ ?> selected <?php } ?>>สถานประกอบการ</option>
        </select>
      </div>
    </div>
  </form>
</div>
<div style="">
<?php
if($_GET['select'] != ""){
include($_GET['select'].".php");
}
?>
</div>
    </div>
  </div>
</div>
</div>
</div>
<script type="text/javascript">
  $("#select").change(function(){
$( "#target" ).submit();
  });
</script>
