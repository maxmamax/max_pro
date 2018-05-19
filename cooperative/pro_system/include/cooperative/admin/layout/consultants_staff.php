<?php ob_start(); ?>
<?php include("process/connect.php"); ?>
<?php
if($_POST['select_s'] != '' && $_POST['staff'] != '' && $_POST['select_f'] != '' ){
$sql = mysql_query("SELECT * FROM tb_consultants_p WHERE con_keyP = '".$_POST['staff']."' AND con_keyFB = '".$_POST['select_f']."' AND con_status =  '".$_POST['select_s']."' ");
$fet = mysql_fetch_array($sql);
if($fet){ ?>

<script type="text/javascript">
  alert("ข้อมูลนี้ถูกกำหนดสิทธิแล้ว");
</script>

<?php
}else{
  $sql1 = mysql_query("INSERT INTO tb_consultants_p VALUES ('','".$_POST['staff']."','".$_POST['select_f']."','".$_POST['select_s']."') ");
}
} ?>


<form action="" method="post" id='form_consultant'>

<table class="table">
  <tr>
    <td>คณะสาขา</td>
    <td>ที่ปรึกษา</td>
    <td>คณะ/สาขาที่ดูแล</td>
  </tr>

  <tr>
    <td width="200px">
    <select class="form-control" name="select_s" id="select_s">
      <option value="">-- คณะ/สาขา --</option>
      <option value="1">คณะ</option>
      <option value="2">สาขา</option>

    </select>
    </td>
    <td width="250px;">
      <select class="form-control" name="staff" >
        <option value="">-- พนักงาน --</option>
<?php
$sql = mysql_query("SELECT * FROM tb_staff WHERE staff_status = '2' ");
while($fet = mysql_fetch_array($sql)) { ?>
<option value="<?php echo $fet['staff_key']; ?>"><?php echo $fet['staff_name']." ".$fet['staff_last']; ?></option>

<?php } ?>
      </select>
    </td>
    <td width="250px;">
<select class="form-control" name="select_f" id="select_f">
</select>
    </td>
  </tr>
</table>
<input type="button" id="add_consultants" value="บันทึกข้อมูล" class="btn btn-success">
</form>



<br>
<table class="table">
  <tr>
    <td>ลำดับ</td>
    <td>ที่ปรึกษา</td>
    <td>คณะ/สาขาที่ปรึกษา</td>
    <td>จัดการ</td>
  </tr>

<?php
$sql = mysql_query("SELECT * FROM tb_consultants_p as a INNER JOIN tb_staff b ON (a.con_keyP = b.staff_key)  ");
while($fet = mysql_fetch_array($sql)){
if($fet['con_status'] == '1'){
  $sql1 = mysql_query("SELECT * FROM tb_faculty WHERE faculty_key = '".$fet['con_keyFB']."' ");
}else if ($fet['con_status'] == '2') {
  $sql1 = mysql_query("SELECT * FROM  tb_course WHERE course_key = '".$fet['con_keyFB']."' ");
}
$fet1 = mysql_fetch_array($sql1);
  ?>
  <tr>
    <td><?php echo $i+1; ?></td>
    <td><?php echo $fet['staff_name']." ".$fet['staff_last']; ?></td>
    <td><?php if($fet['con_status'] == '1'){
      echo $fet1['faculty_name'];
    }else if ($fet['con_status'] == '2') {
      echo $fet1['course_name'];
    } ?></td>
   <td><button class="btn btn-danger" id="delete_staff" value="<?php echo  $fet['id_key']; ?>">ลบ</button></td>
  </tr>
<?
$i++;
}
?>
</table>


<script type="text/javascript">
  $('#select_s').change(function(){
    var key = $("#select_s").val();
    $.post('layout/select_data.php',{
      key : key
    },function(data){
$('#select_f').html(data);
    })
  });

  $("#add_consultants").click(function(){
    var r = confirm("ยืนยันการบันทึกข้อมูล");
    if (r == true) {
        $('#form_consultant').submit();
    }
  });


  $("[id^=delete_staff]").click(function(){
    var r = confirm("ยืนยันการลบข้อมูล");
    if (r == true) {
      var id = $(this).val();
      $.post('layout/delete_consultants.php',{
        id : id,
        status : 'p'
      },function(){
       location.reload();
      });
    }
  });

</script>
