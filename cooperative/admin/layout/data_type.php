<?php include("process/connect.php"); session_start(); date_default_timezone_set("Asia/Bangkok"); ?>

<form class="" action="" method="GET">
  <input type="hidden" name="page" value="data_type">
  <div class="form-group row">
    <div class="col-md-3">
      <label for="">ข้อมูล</label>
      <select class="form-control" name="chk">
        <option value="">-- ข้อมูล --</option>
        <option value="1" <?php if($_GET['chk'] == '1'){ echo "selected"; } ?> >ประเภทงาน</option>
        <option value="2" <?php if($_GET['chk'] == '2'){ echo "selected"; } ?>>การแจ้งเพิ่มประเภทงาน</option>
      </select>
    </div>
    <div class="col-md-2">
      <label for="">จัดการข้อมูล</label>
      <button type="submit"  class="btn btn-success">จัดการข้อมูล</button>
  </div>
  </div>
</form>
<?php
if($_GET['chk'] == '1'){ ?>
<form class="" action="layout\add_type.php" method="post" id="form_addtype">
  <div class="form-group row">
    <div class="col-md-3">
      <label for="">เพิ่่มข้อมูลประเภทงาน</label>
      <input type="text" name="name_type" value="" class="form-control" id="name_type">

    </div>
    <div class="col-md-3">
      <label for="">เพิ่่มข้อมูลประเภทงาน</label><br>
      <button type="button" name="button" class="btn btn-success" id="add_type">เพิ่มข้อมูล</button>
    </div>
  </div>
</form>


  <table class="table table-bordered">
    <tr>
      <td>ลำดับ</td>
      <td>ประเภทงาน</td>
      <td>จัดการข้อมูล</td>
    </tr>
<?php $sql = mysql_query("SELECT * FROM tb_type_ope  ");
while($fet = mysql_fetch_array($sql)){ ?>
  <tr>
    <td><?php echo $i+1; ?></td>
    <td><?php echo $fet['type_name']; ?></td>
    <td>
        <button type="button"  value="<?php echo $fet['type_key']?>" id="key_type">ลบข้อมูล</button>
    </td>
  </tr>
<?php $i++;
}
?>
  </table>
<?php
}else if($_GET['chk'] == '2'){ ?>
  <form action="layout\ad_offer.php" method="post" id="form_offer">
  <table class="table table-bordered">
    <tr>
      <td><input type="checkbox" value="1" id="chk" name="chk"></td>
      <td>ลำดับ</td>
      <td>ชื่อสถานประกอบการ</td>
      <td>การแจ้งข้อมูลประเภทงาน</td>
    </tr>
<?php
$sql = mysql_query("SELECT * FROM tb_offer a , tb_cooperative b WHERE a.coop_keyf = b.coop_key ");
while($fet = mysql_fetch_array($sql)){ ?>
  <tr>
    <td><input type="checkbox" value="<?php echo $fet['offer_id']; ?>" name="chk[]" id="chk1"></td>
    <td><?php echo $i+1; ?></td>
    <td><?php echo $fet['coop_Tname']; ?></td>
    <td><?php echo $fet['offer_name']; ?></td>
    <td>

    </td>
  </tr>
<?php $i++;
}
?>
  </table>

  <div class="form-group row">
    <div class="col-md-3">
      <select class="form-control" name="status">
        <option value="">-- เลือกการจัดการ --</option>
        <option value="add">เพิ่มประเภทงาน</option>
        <option value="delete">ลบประเภทงาน</option>
      </select>
    </div>
    <button type="button"  value="<?php echo $fet['offer_id']?>" id="ad_offer" class="btn btn-danger">จัดการข้อมูล</button>
  </div>
</form>
<?php
}
?>



<script type="text/javascript">

  $("#ad_offer").click(function(){
    var r = confirm("ยืนยันการจัดการข้อมูล");
    if (r == true) {
        $('#form_offer').submit();
    }
  });

  $("#add_type").click(function(){
    var name = $("#name_type").val();
    if(name != ""){
      var r = confirm("ยืนยันการบันทึกข้อมูลประเภทงาน");
      if (r == true) {
          $('#form_addtype').submit();
      }
    }else{
      alert("กรุณากรอกข้อมูลประเภทงาน");
    }

  });

  $("[id^=key_type]").click(function(){
    var key_type = $(this).val();
    var r = confirm("ยืนยันการลบข้อมูลประเภทงาน");
    if (r == true) {
      $.post('layout/delete_type.php',{
        id : key_type
      },function(data){
        alert("ลบข้อมูลประเภทงานเรียบร้อย");
        location.reload();
      });
    }

  });

  $("[id^=key_offer]").click(function(){
    var key_offer = $(this).val();
    var r = confirm("ยืนยันการลบข้อมูลประเภทงาน");
    if (r == true) {
      $.post('layout/delete_offer.php',{
        id : key_offer
      },function(data){
        alert("ลบข้อมูลประเภทงานเรียบร้อย");
        location.reload();
      });
    }

  });
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
