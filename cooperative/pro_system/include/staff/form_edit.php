<?php include ("include/connect.php"); session_start(); ?>
<style media="screen">
span{
  font-family: 'Mitr', sans-serif;

}
</style>


<?php
if($_POST['username'] != "" &&  $_POST['password'] != "" ){
 $a = strrchr($_FILES['file']['name'],".");
$part = "P_".$_POST['username'].$a;
if($a == '.png' || $a == '.jpg' || $a == '.PNG' || $a == '.JPG' ){
   $up = " , staff_part = '$part' ";
}
$sql = mysql_query("UPDATE tb_staff SET
staff_pass = '".$_POST['password']."',
staff_name = '".$_POST['name']."',
staff_last	 = '".$_POST['lname']."'
$up  WHERE staff_key = '".$_SESSION['session_key']."'
");
if($a == '.png' || $a == '.jpg' || $a == '.PNG' || $a == '.JPG' ){
  $part = iconv("UTF-8", "TIS-620", "P_".$_POST['username']);
  copy($_FILES['file']['tmp_name'],'include/image_staff/'.$part.$a);
}

}
?>


<?php
$sql = mysql_query("SELECT * FROM  tb_staff a , tb_faculty b  WHERE staff_key = '".$_SESSION['session_key']."' AND a.faculty_keyf = b.faculty_key ");
$fet = mysql_fetch_array($sql);
?>
<div class="panel panel-default">
  <div class="panel-heading"><h1><font>แก้ไขข้อมูล</font></h1></div>
  <div class="panel-body">
    <div class="form-group row">

      <form action="" method="post" style="margin-top:-50px" id="form_staff" enctype="multipart/form-data">
          <div id="student" style="margin-top:100px;margin-left:20px;">
        <div class="form-group row">
          <div class="col-md-3">
            <label for="ex1"><font class="f1">ชื่อผู้ใช้ <font style="color:red;font-size:25px;"> * </font> </font> <span  class="glyphicon glyphicon-question-sign btn btn-warning" aria-hidden="true" data-toggle="tooltip" title="*หมายเหตุ! มีความยาวอย่างน้อย 8 - 16 ตัวอักษร (ห้ามปล่อยว่าง)"></span> </label>
            <input readonly class="form-control" id="username" type="text" placeholder="ชื่อผู้ใช้" name="username" value="<?php echo $fet['staff_user']; ?>">
            <span id="username_a"></span>
          </div>
          <div class=" col-md-3">
            <label for="ex1"><font class="f1">รหัสผ่าน <font style="color:red;font-size:25px;"> * </font> <span  class="glyphicon glyphicon-question-sign btn btn-warning" aria-hidden="true" data-toggle="tooltip" title="*หมายเหตุ! มีความยาวอย่างน้อย 8 - 16 ตัวอักษร (ห้ามปล่อยว่าง)"></span></font></label>
            <input class="form-control" id="password" type="text" placeholder="รหัสผ่าน" name="password" value="<?php echo $fet['staff_pass']; ?>">
            <span id="password_a"></span>
          </div>
          <div class=" col-md-3">
            <label for="ex1"><font class="f1">ยืนยันรหัสผ่าน <font style="color:red;font-size:25px;"> * </font> </font> <span  class="glyphicon glyphicon-question-sign btn btn-warning" aria-hidden="true" data-toggle="tooltip" title="*หมายเหตุ! กรอกข้อมูลรหัสผ่านอีกครั้ง (ห้ามปล่อยว่าง)"></span></label>
            <input class="form-control" id="passwordcon" type="text" placeholder="ยืนยันรหัสผ่าน">
            <span id="passwordcon_a"></span>
          </div>
        </div>

        <div class="form-group row">
        <div class=" col-md-3">
          <label for="ex1"><font class="f1">ชื่อ <font style="color:red;font-size:25px;"> * </font> </font> <span  class="glyphicon glyphicon-question-sign btn btn-warning" aria-hidden="true" data-toggle="tooltip" title="*หมายเหตุ! ควรกรอกข้อมูลที่เป็นจริง (ห้ามปล่อยว่าง)"></span> </label>
          <input class="form-control" id="name" type="text" placeholder="ชื่อ" name="name" value="<?php echo $fet['staff_name']; ?>">
          <span id="name_a"></span>
        </div>
      <div class=" col-md-3">
        <label for="ex1"><font class="f1">นามสกุล <font style="color:red;font-size:25px;"> * </font> <span  class="glyphicon glyphicon-question-sign btn btn-warning" aria-hidden="true" data-toggle="tooltip" title="*หมายเหตุ! กรอกข้อมูลที่เป็นจริง (ห้ามปล่อยว่าง)"></span> </font></label>
        <input class="form-control" id="lname" type="text" placeholder="นามสกุล" name="lname" value="<?php echo $fet['staff_last']; ?>">
        <span id="lname_a"></span>

      </div>
        </div>

        <div class="form-group row">
        <div class=" col-md-3">
          <label for="ex1"><font class="f1">รหัสพนักงาน <font style="color:red;font-size:25px;"> * </font> <span  class="glyphicon glyphicon-question-sign btn btn-warning" aria-hidden="true" data-toggle="tooltip" title="*หมายเหตุ! กรอกข้อมูลที่เป็นจริง (ห้ามปล่อยว่าง)"></span></font></label>
          <input readonly class="form-control" id="code" type="number" placeholder="รหัสพนักงาน" name="code" value="<?php echo $fet['staff_code']; ?>">
          <span id="code_a"></span>
        </div>
        </div>

        <div class="form-group row">
        <div class=" col-md-3">
          <label for="ex1"><font class="f1">อีเมล <font style="color:red;font-size:25px;"> * </font> </font><span  class="glyphicon glyphicon-question-sign btn btn-warning" aria-hidden="true" data-toggle="tooltip" title="*หมายเหตุ! ใช้อีเมล @kru.ac.th เท่านั้น (ห้ามปล่อยว่าง)"></span></label>
          <input readonly class="form-control" id="email" type="text" placeholder="อีเมล @kru.ac.th (ห้ามปล่อยว่าง)" name="email" value="<?php echo $fet['staff_email']; ?>">
          <span id="email_a"></span>
        </div>
        </div>
        <div class="form-group row">
        <div class=" col-md-3">
          <label for="ex1"><font class="f1">คณะ <font style="color:red;font-size:25px;"> * </font> </font> <span  class="glyphicon glyphicon-question-sign btn btn-warning" aria-hidden="true" data-toggle="tooltip" title="*หมายเหตุ! เลือกคณะ (ห้ามปล่อยว่าง)"></span></label>
          <input readonly type="text" name=""  class="form-control" value="<?php echo $fet['faculty_name']; ?>">
          <span id="select_faculty_a"></span>

      </div>
        <div class="form-group row">
        <div class=" col-md-3">
          <label for="ex1"><font class="f1">อัพโหลดไฟล์รูป <font style="color:red;font-size:25px;"> * </font> </font> <span  class="glyphicon glyphicon-question-sign btn btn-warning" aria-hidden="true" data-toggle="tooltip" title="*หมายเหตุ! อัปโหลดรูปภาพประจำตัวนามสกุล jpg,png (ห้ามปล่อยว่าง)"></span></label>
          <input class="form-control" id="upload" type="file" name="file"  >
          <span id="upload_a"></span>
        </div>
        </div>

        <div class="form-group row">
        <div class=" col-md-3">
            <input type="button" name="" value="แก้ไขข้อมูล"  class="btn btn-success" id="save">
            <input type="reset" name="" value="รีเซต" class="btn btn-danger">
        </div>
        </div>
      </form>

</div>
</div>
</div>


<script type="text/javascript">
var vpassword = 0;
var vuploade = 0;
var vcon = 0;
  $('#select_faculty').change(function(){
  var id = $(this).val();
    $.post("include/select_course.php",{
      id : id
    },function(data){
    $("#select_course").html(data);
    });
  });

$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});

$("#save").click(function(){

  var username = $("#username").val();
  var password = $("#password").val();
  var passwordcon = $("#passwordcon").val();
  var name = $("#name").val();
  var lname = $("#lname").val();
  var code = $("#code").val();
  var email = $("#email").val();
  var select_faculty = $("#select_faculty").val();
  var select_course = $("#select_course").val();
  var upload = $("#upload").val();
  var s;

if(password != "" ){
  $.post("include/validate.php",{
    text : password ,
    status : 'len'

  },function(data){
$("#password_a").html("<font style='color:red'><img src='img/validate.gif' width='20' heigth='20'>กรุณากรอกข้อความอย่างน้อย 8-16 ตัวอักษร</font>");
if(data == ''){
  vpassword = 1;
$("#password_a").html("");
}
  });
}else{
$("#password_a").html("<font style='color:red'><img src='img/validate.gif' width='20' heigth='20'>กรุณากรอกข้อความอย่างน้อย 8-16 ตัวอักษร</font>");
vpassword = 0;
}

if(password == ""){
  $("#passwordcon_a").html("<font style='color:red'><img src='img/validate.gif' width='20' heigth='20'>กรุณากรอกรหัสอีกครั้ง</font>");
}else{
  if(password != passwordcon){
    $("#password_a").html("<font style='color:red'><img src='img/validate.gif' width='20' heigth='20'>รหัสผ่านไม่ตรงกัน</font>");
    $("#passwordcon_a").html("<font style='color:red'><img src='img/validate.gif' width='20' heigth='20'>รหัสผ่านไม่ตรงกัน</font>");
    vcon = 0;
  }else{
    $("#password_a").html("");
    $("#passwordcon_a").html("");
    vcon = 1;
  }
}

if(upload != "" ){
  $.post("include/validate.php",{
    text : upload ,
    status : 'up'
  },function(data){
    vuploade = 0;
$("#upload_a").html(data);
if(data == ''){
  vuploade = 1;
}
  });
}else{
$("#upload_a").html("<font style='color:red'><img src='img/validate.gif' width='20' heigth='20'>กรุณาเลือกไฟล์ (ถ้าไม่แก้ไขรูปภาพกรุณาปล่อยว่าง)</font>");
  vuploade = 0;
}



$(":input + span.require").remove();
   $(":input").each(function(){
       $(this).each(function(){
           if($(this).val()==""){
               $(this).after("<span class=require><font style='color:red'><img src='img/validate.gif' width='20' heigth='20'>จำเป็นต้องกรอก</font><br></span>");
}
       });
   });


if(vpassword == 1 && vcon == 1 && name != ""  && lname  != "" && code  != "" && email != "" && select_faculty != "" && select_course != "" ){
  var txt;
  var r = confirm("ยืนยันการลงทะเบียน");
  if (r == true) {
      $('#form_staff').submit();
  }
}
});
</script>
