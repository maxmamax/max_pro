<?php include("process/connect.php"); ?>
<button type="button" name="button" class="btn btn-success"  class="btn btn-primary" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><img src="img/add.png" alt="" width="30px" height = "30px"><font style="color:black;margin-left:10px;font-size:25px;">เพิ่มข้อมูล</font></button>

<div class="collapse" id="collapseExample" style="margin-top:15px;">
  <div class="card card-block">
    <form action="process/newstwo_upload.php" method="post" enctype="multipart/form-data" id="form_upload">
    <div class="form-group col-md-3">
        <label for="exampleInputPassword1">ชื่อหัวข้อหลัก</label>
        <input type="text" class="form-control" placeholder="หัวข้อหลัก"  name="topic1">
    </div>

    <div class="form-group col-md-3">
          <label for="exampleInputPassword1">รายละเอียด</label>
          <textarea rows="4" cols="50" class="form-control" name="sup1"></textarea>
      </div>

      <div class="form-group col-md-3">
            <label for="exampleInputPassword1">อัพโหลดไฟล์รูป</label>
            <input type="file" class="form-control"  placeholder="Password" name="file1" id="file">
            <br>
        </div>
          <input style="color:black;"type="button" class="btn btn-success" value="บันทึกข้อมูล" onclick="save()">

        </form>
    </div>
</div>
<div class="row">
<div id="edit_newstwo"></div>
<table class="table" style="font-size:25px;margin-top:15px;text-align:center;" id="table">
  <tr style="background-color:#c4c4c4;">
    <td></td>
    <td>ชื่อหัวข้อหลัก</td>
    <td>ลำดับการแสดง</td>
    <td>ซ่อนแสดง</td>
    <td>จัดการ</td>
  </tr>
<?php
$sql = mysql_query("SELECT count(newtwo_topic) AS count1 FROM tb_newstwo ");
$fet = mysql_fetch_array($sql);
$count = $fet['count1'];
$sql1 = mysql_query("SELECT * FROM  tb_newstwo ORDER BY newtwo_que ASC") ;
while ($fet1 = mysql_fetch_array($sql1)) {
?>
  <tr>
    <td><img width="50px" height="50px" src="<?php echo $fet1['newtwo_part']; ?>" alt=""></td>
    <td><font><?php echo $fet1['newtwo_topic'] ?></font></td>
    <td><?php echo $fet1['newtwo_que']; ?></td>
    <td>
      <?php if($fet1['newtwo_status'] == '1') { ?>
      <button type="button" name="button" class="btn btn-success" value="<?php echo $fet1['newstwo_key']; ?>" id="ss">แสดง</button>
    <?php }else{ ?>
      <button type="button" name="button" class="btn btn-danger" value="<?php echo $fet1['newstwo_key']; ?>" id="ss">ซ่อน</button>
    <?php } ?>
    </td>
    <td>
      <button type="button" name="button" class="btn btn-primary" id="edit" value="<?php echo $fet1['newstwo_key']; ?>">แก้ไข</button>
      <button type="button" name="button" class="btn btn-danger" value="<?php echo $fet1['newstwo_key']; ?> " id="delete" >ลบ</button>
    </td>
  </tr>
<?php $i++;  }?>
</table>
    </div>


    <script type="text/javascript">
       var r = 0;
       $("#link").hide();
      $('[id^=r]').click(function(){
        r = $(this).val();
        if(r == 1){
          $("#link").hide();
        }else if(r == 2){
          $("#link").show();
        }
      });

      $("[id^=edit]").click(function(){
        var id = $(this).val();
        $.post("layout/edit_newstwo.php",{
          id : id
        },function(data){
          $("#table").hide();
         $(".show_data").html(data);
        });

      });

    $("[id^=ss]").click(function(){
      var key = $(this).val();
      $.post("process/newtwo_ds.php",{
        key : key ,
        status : 's'
      },function(){
    location.reload();
      });
    });

    $("[id^=delete]").click(function(){
      var key = $(this).val();

      swal({
        title: "ยืนยันการลบข้อมูล",
        text: "กรุณาตรวจสอบ่อนกดปุ่มยืนยัน",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#feac28",
        confirmButtonText: "ยืนยัน",
        cancelButtonText: "ยกเลิก",
        closeOnConfirm: false
      },
      function(){
        $.post("process/newtwo_ds.php",{
          key : key ,
          status : 'd'
        },function(){
         location.reload();
          swal("Deleted!", "Your imaginary file has been deleted.", "success");
        });
      });
    });



    function  save(){
        var data = $("#file").val();
      swal({
        title: "ยืนยันการเพิ่มข้อมูล",
        text: "กรุณาตรวจสอบก่อนกดปุ่มยืนยัน",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#feac28",
        confirmButtonText: "ยืนยัน",
        cancelButtonText: "ยกเลิก",
        closeOnConfirm: false
      },
      function(){
        $.post("process/check.php",{
          data : data
        },function(data){
          if(data == 'ชนิดไฟล์ถูกต้อง'){
        document.getElementById("form_upload").submit();
          }else{
            swal("กรุณาเลือกไฟล์ภาพ JPG หรือ PNG");
             $("#file").val('');
          }
        });
      });
  }

    </script>
