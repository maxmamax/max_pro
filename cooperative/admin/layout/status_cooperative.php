<?php ob_start(); ?>
<?php include("process/connect.php"); ?>
<h1>จัดการสถานะผู้ใช้สถานประกอบการ</h1>
<?php  if($_POST['chk'] != "" && $a == 0){
$a = 1 ;
foreach ($_POST['chk'] as $key => $value) {
$sql = mysql_query("SELECT * FROM  tb_cooperative WHERE coop_key = '$value'  ");
$fet = mysql_fetch_array($sql);
if($fet['coop_status'] == '0'){
$sql1 = mysql_query("UPDATE  tb_cooperative SET coop_status = '2' WHERE coop_key = '$value' ") ;
//$rand = 'C_'.substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ23456789'),0,5);
//$sql2 = mysql_query("INSERT INTO tb_security_cooperative VALUES ('$value','$rand') ") ;
}
}
}

if($_GET['s'] == 's'){
  $r = $_POST['r'];
  $data = $_POST['data'];
  if($_POST['data'] != ''){
    $sq = " WHERE  a.coop_Tname LIKE '%$data%'  ";
  }
}
?>

<form class="" action="index.php?page=status_cooperative&s=s" method="post">
<div class="form-group row">
  <div class="col-md-3">
    <label for="ex1"><font class="f1">ชื่อสถานประกอบการ/</font></label>
    <input class="form-control" id="username" type="text" placeholder="กรอก รหัส/ชื่อนักศึกษา/อีเมล/คณะ/สาขา" name="data" value="<?php echo $_POST['data']; ?>">
  </div>
  <div class="col-md-2">
    <label for="ex1"><font class="f1">ข้อมูล</font></label>
    <select name="r" class="form-control">
      <option value="" <?php if($_POST['r'] == ""){echo "selected"; } ?>>ข้อมูลทั้งหมด</option>
      <option value="2" <?php if($_POST['r'] == "2"){echo "selected"; } ?>>ยืนยันแล้ว</option>
      <option value="0" <?php if($_POST['r'] == "0"){echo "selected"; } ?>>ยังไม่ได้ยืนยัน</option>
    </select>
  </div>
  <div class="col-md-2">
    <label for="ex1"><font class="f1">ค้นหา</font></label>
    <input class="btn btn-success form-control" type="submit" value="ค้นหา" >
  </div>
</div>
</form>

<form class="" action="index.php?page=status_cooperative" method="post" name="form1">
<div class="table-responsive">
<table class="table table-bordered">
  <tr>
    <td><input type="checkbox" value="1" id="chk" name="chk"></td>
    <td>ชื่อผู้ใช้</td>
    <td>รหัสผ่าน</td>
    <td>ชื่อสถานประกอบการ</td>
    <td>ข้อมูล</td>
  </tr>
<?php

$sql = mysql_query("SELECT * FROM
tb_cooperative $sq ");
while($fet = mysql_fetch_array($sql)) {
  if ($fet['coop_status'] == $r || $r == '') {

?>
<tr>
  <td><input type="checkbox" value="<?php echo $fet['coop_key']; ?>" name="chk[]" id="chk1"></td>
  <td><?php echo $fet['coop_user']; ?></td>
  <td><?php echo $fet['coop_pass']; ?></td>
  <td><?php echo $fet['coop_Tname']; ?></td>
  <td><button class="btn btn-success">ดูข้อมูล</button></td>


</tr>
<?php    } } ?>
</table>
</div>
<input type="submit" name="action" value="ยืนยันข้อมูลที่เลือก" class="btn btn-success">
<input type="submit" name="action" value="ยกเลิกการยืนยันข้อมูลที่เลือก" class="btn btn-warning">
<input type="submit" name="action" value="ลบข้อมูลที่เลือก" class="btn btn-danger">
</form>
<script type="text/javascript">
var a=0
$("#chk").click(function(){
  var data = $(this).val();
        if(a == 0){
          $(':checkbox').each(function() {
              this.checked = true;
              a = 1;
          });
        }else{
          $(':checkbox').each(function() {
              this.checked = false;
              a = 0;
          });
        }
});
</script>
