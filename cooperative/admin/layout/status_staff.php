<?php ob_start(); ?>
<?php include("process/connect.php"); ?>
<h1>จัดการสถานะผู้ใช้พนักงาน</h1>
<?php  if($_POST['chk'] != "" && $a == 0){
$a = 1 ;
foreach ($_POST['chk'] as $key => $value) {
$sql = mysql_query("SELECT * FROM tb_staff WHERE staff_key = '$value'  ");
$fet = mysql_fetch_array($sql);
if($fet['staff_status'] == '0'){
$sql1 = mysql_query("UPDATE  tb_staff SET staff_status = '2' WHERE staff_key = '$value' ") ;
//$rand = 'P_'.substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ23456789'),0,5);
//$sql2 = mysql_query("INSERT INTO tb_security_staff VALUES ('$value','$rand') ") ;
}
}
}

if($_GET['s'] == 's'){
  $r = $_POST['r'];
  $data = $_POST['data'];
  if($_POST['data'] != ''){
    $sq = " WHERE  a.staff_code LIKE '%$data%' OR  a.staff_name LIKE '%$data%' OR  a.staff_email LIKE '%$data%' OR  b.faculty_name LIKE '%$data%'";
  }
}
?>

<form class="" action="index.php?page=status_staff&s=s" method="post">
<div class="form-group row">
  <div class="col-md-3">
    <label for="ex1"><font class="f1">รหัส/ชื่อพนักงาน/อีเมล/คณะ/สาขา</font></label>
    <input class="form-control" id="username" type="text" placeholder="กรอก รหัส/ชื่อพนักงาน/อีเมล/คณะ" name="data" value="<?php echo $_POST['data']; ?>">
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

<form class="" action="index.php?page=status_staff" method="post" name="form1">
<div class="table-responsive">
<table class="table table-bordered">
  <tr>
    <td><input type="checkbox" value="1" id="chk" name="chk"></td>
    <td>ชื่อผู้ใช้</td>
    <td>รหัสผ่าน</td>
    <td>ชื่อจริง</td>
    <td>นามสกุล</td>
    <td>รหัสนอาจารย์</td>
    <td>คณะ</td>
    <td>อีเมล</td>
    <td>รูปภาพ</td>
  </tr>
<?php

$sql = mysql_query("SELECT * FROM
tb_staff as a INNER JOIN  tb_faculty as b ON (a.faculty_keyf = b.faculty_key) $sq ");
while($fet = mysql_fetch_array($sql)) {
  if ($fet['staff_status'] == $r || $r == '') {

?>
<tr>
  <td><input type="checkbox" value="<?php echo $fet['staff_key']; ?>" name="chk[]" id="chk1"></td>
  <td><?php echo $fet['staff_user']; ?></td>
  <td><?php echo $fet['staff_pass']; ?></td>
  <td><?php echo $fet['staff_name']; ?></td>
  <td><?php echo $fet['staff_last']; ?></td>
  <td><?php echo $fet['staff_code']; ?></td>
  <td><?php echo $fet['faculty_name']; ?></td>
  <td><?php echo $fet['staff_email']; ?></td>
  <td><img src="../pro_system/include/image_staff/<?php echo $fet['staff_part']; ?>" width="50px" heoght="50px"></td>

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
