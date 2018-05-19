<?php include("../process/connect.php"); ?>
<?php
$sql = mysql_query("SELECT * FROM tb_newstwo WHERE newstwo_key = '".$_POST['id']."' ");
$fet = mysql_fetch_array($sql);
 ?>
<br>
<div class="card card-block" style="background-color:#f1f1f1;">
  <h1>แก้ไขข้อมูล</h1>
  <form action="process/newstwo_edit.php" method="post" enctype="multipart/form-data" id="form_edit">
    <input type="hidden" name="key" value="<?php echo $fet['newstwo_key']; ?>" id="key">
  <div class="form-group col-md-3">
      <label for="exampleInputPassword1">ชื่อหัวข้อหลัก</label>
      <input type="text" class="form-control" placeholder="หัวข้อหลัก" id="topic" name="topic1" value="<?php echo $fet['newtwo_topic']; ?>">
  </div>

  <div class="form-group col-md-3">
        <label for="exampleInputPassword1">รายละเอียดย่อย</label>
        <textarea rows="4" cols="50" class="form-control" id="sup" name="sup1" ><?php echo $fet['newtwo_sup']; ?></textarea>
    </div>

    <div class="form-group col-md-1">
        <label for="exampleInputPassword1">ลำดับการแสดง</label>
        <input type="text" class="form-control" placeholder="หัวข้อหลัก"  name="que1" value="<?php echo $fet['newtwo_que']; ?>">
    </div>

    <div class="form-group col-md-3">
          <label for="exampleInputPassword1">อัพโหลดไฟล์รูป</label>
          <input type="file" class="form-control" id="file" placeholder="Password" name="file1">
          <br>
      </div>

        <input style="color:black;"type="button" class="btn btn-success" value="แก้ไขข้อมูล" id="update">

      </form>
  </div>

<script type="text/javascript">

var r = 0;
$("#update").click(function(){
  var topic = $("#topic").val();
  var sup = $("#sup").val();
  var data = $("#file").val();
  var link1 = $("#link1").val();
  if(topic == ''){
  swal("กรุณากรอกข้อมูลหัวข้อหลัก");
  }else if(sup == ''){
  swal("กรุณากรอกข้อมูลรายละเอียดย่อย");
  }else{
    if(data  != ''){
    $.post("process/check.php",{
      data : data,
      sup : sup
    },function(data){
      if(data == 'ชนิดไฟล์ถูกต้อง'){
    document.getElementById("form_edit").submit();
      }else{
        swal("กรุณาเลือกไฟล์ภาพ JPG หรือ PNG");
         $("#file").val('');
      }
    }); }else{
      document.getElementById("form_edit").submit();
    };

}
      });
</script>

<?php
if($fet['newtwo_link'] != ""){ ?>
<script type="text/javascript">
  $("#link").show();
</script>
<?php
}
?>
