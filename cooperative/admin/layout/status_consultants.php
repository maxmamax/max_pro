<?php ob_start(); ?>
<?php include("process/connect.php"); ?>
<style media="screen">
.f1{
    font-size:25px;
}
</style>
<h1>สิทธิการเข้าถึงข้อมูลของนักศึกษา</h1>
<br>
<form class="" action="" method="get" id="form_con">
  <div class="form-group row">
    <div class="col-md-2">
      <table>
        <input type="hidden" name="page" value="status_consultants">
        <tr class="f1">
          <td>อาจารย์</td>
          <td><input id="r" type="radio" value="teacher" name="r" <?php if($_GET['r'] == 'teacher'){ echo 'checked'; } ?> ></td>
          <td>พนักงาน</td>
          <td><input id="r" type="radio" value="staff"  name="r" <?php if($_GET['r'] == 'staff'){ echo 'checked'; } ?>></td>
        </tr>
      </table>
    </div>
  </div>
</form>

<?php
if($_GET['r'] == 'teacher'){
include("layout\consultants_teacher.php");
}else if($_GET['r'] == 'staff'){
include("layout\consultants_staff.php");
}
?>
<script type="text/javascript">
$("[id^=r]").click(function(){
  $("#form_con").submit();
});
</script>
