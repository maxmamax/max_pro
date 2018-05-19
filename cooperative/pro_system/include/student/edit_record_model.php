<?php include("../connect.php"); session_start(); date_default_timezone_set("Asia/Bangkok"); ?>

<?php
$sql = mysql_query("SELECT * FROM tb_record WHERE record_id = '".$_POST['id']."' ");
$fet = mysql_fetch_array($sql);
?>
  <input type="hidden" name="id" value="<?php echo $_POST['id']; ?>" id="id">
  <div class="form-group row">
    <div class="col-md-8">
      <label for="">วันที่</label>
      <input type="date" name="record_date" value="<?php echo $fet['record_date']; ?>" class="form-control" id="record_date" >
    </div>
  </div>
  <div class="form-group row">
    <div class="col-md-8">
      <label for="">งานที่ปฏิบัติ</label>
      <input type="text" name="record_work" value="<?php echo $fet['record_work']; ?>" class="form-control"  id="record_work" >
    </div>
  </div>
  <div class="form-group row">
    <div class="col-md-8">
      <label for="">ปัญหาและการแก้ไข</label>
      <input type="text" name="record_problems" value="<?php echo $fet['record_problems']; ?>" class="form-control"  id="record_problems" >
    </div>
  </div>

<input type="button" name="" value="แก้ไข้อมูล" class="btn btn-success" id="update_record">
<script type="text/javascript">
  $('#update_record').click(function(){
    var id = $('#id').val();
    var record_date = $('#record_date').val();
    var record_work = $('#record_work').val();
    var record_problems = $('#record_problems').val();

    var r = confirm("ยืนยันการแก้ไขข้อมูล");
    if (r == true) {
      $.post('include/student/update_record.php',{
        id : id,
        record_date : record_date,
        record_work : record_work,
        record_problems : record_problems
      },function(data){
      location.reload();
      });
    }


  });
</script>
