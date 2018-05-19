<?php include("connect.php"); include("email/email.php"); ?>
<style media="screen">
span{
  font-family: 'Mitr', sans-serif;

}
.f1{
  font-size: 25px;
}
</style>
<?php
if($_POST['username'] != "" &&  $_POST['password'] != "" ){
$sql = mysql_query("SELECT count(student_user) as a FROM tb_student WHERE student_user = '".'S_'.$_POST['username']."' ");
$fet = mysql_fetch_array($sql);
if($fet['a'] == '0'){
 $a = strrchr($_FILES['file']['name'],".");
$part = "S_".$_POST['username'].$a;
$sql = mysql_query("INSERT INTO tb_student VALUES  ('','".'S_'.$_POST['username']."','".$_POST['password']."','".$_POST['name']."','".$_POST['lname']."','".$_POST['code']."','".$_POST['email']."','$part','".$_POST['select_faculty']."','".$_POST['select_course']."','1') ");
$part = iconv("UTF-8", "TIS-620", "S_".$_POST['username']);
copy($_FILES['file']['tmp_name'],'include/image_student/'.$part.$a);
$sql = mysql_query("SELECT * FROM tb_student WHERE student_user = '".'S_'.$_POST['username']."' ");
$fet = mysql_fetch_array($sql);
$rand = 'S_'.substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ23456789'),0,5);
$sql2 = mysql_query("INSERT INTO tb_security_student VALUES ('".$fet['student_key']."','$rand') ") ;
$i = sentEmail('S_'.$_POST['username'],$_POST['password'],$rand,$_POST['email']);
if($i == 'Message sent!'){ ?>
  <div class="bg-success">
  <div  style="margin-left:20px">
  <font class="f">
  <br>
    <font class="f1">การสมัครสมาชิกสำเร็จ !</font><br>
   * กรุณาตรวจสอบ ที่อยู่อีเมล <font style="color:red;"><?php echo $_POST['email']; ?></font> ที่กล่องจดหมายหรือที่อยู่อีเมลขยะเพื่อรับ ชื่อผู้ใช้ รหัสผ่าน รหัสผ่านยืนยัน เพื่อเข้าใช้งานระบบ<br><br>

  </font>
  </div>
  </div>
<?php
}else{ ?>

  <div class="bg-danger">
  <div  style="margin-left:20px">
  <font class="f">
  <br>
    <font class="f1">การสมัครสมาชิกไม่สำเร็จ !</font><br>
   * กรุณาตรวจสอบ ที่อยู่อีเมล <font style="color:red;"><?php echo $_POST['email']; ?></font> อีกครั้ง ว่ามีอยู่จริงหรือไม่และทำการสมัครสมาชิกใหม่อีกครั้ง<br><br>

  </font>
  </div>
  </div>
<?php
}
}
}
?>

<!--  student -->
<form action="" method="post" style="margin-top:-50px" id="form_student" enctype="multipart/form-data">
    <div id="student" style="margin-top:50px;margin-left:20px;">
  <div class="form-group row">
    <div class="col-md-3">
      <label for="ex1"><font class="f1">ชื่อผู้ใช้ <font style="color:red;font-size:25px;"> * </font>  </font> <span  class="glyphicon glyphicon-question-sign btn btn-warning" aria-hidden="true" data-toggle="tooltip" title="ชื่อผู้ใช้จะต้องมีความยาวอย่างน้อย 8 - 16 ตัวอักษร"></span> </label>
      <input class="form-control" id="username" type="text" placeholder="ชื่อผู้ใช้" name="username">
      <span id="username_a"></span>
    </div>
    <div class=" col-md-3">
      <label for="ex1"><font class="f1">รหัสผ่าน <font style="color:red;font-size:25px;"> * </font> <span  class="glyphicon glyphicon-question-sign btn btn-warning" aria-hidden="true" data-toggle="tooltip" title="รหัสผ่านจะต้องมีความยาวอย่างน้อย 8 - 16 ตัวอักษร"></span></font></label>
      <input class="form-control" id="password" type="text" placeholder="รหัสผ่าน" name="password">
      <span id="password_a"></span>
    </div>
    <div class=" col-md-3">
      <label for="ex1"><font class="f1">ยืนยันรหัสผ่าน <font style="color:red;font-size:25px;"> * </font> </font> <span  class="glyphicon glyphicon-question-sign btn btn-warning" aria-hidden="true" data-toggle="tooltip" title="กรอกข้อมูลรหัสผ่านอีกครั้ง"></span></label>
      <input class="form-control" id="passwordcon" type="text" placeholder="ยืนยันรหัสผ่าน">
      <span id="passwordcon_a"></span>
    </div>
  </div>

  <div class="form-group row">
  <div class=" col-md-3">
    <label for="ex1"><font class="f1">ชื่อ <font style="color:red;font-size:25px;"> * </font> </font> </label>
    <input class="form-control" id="name" type="text" placeholder="ชื่อ" name="name">
    <span id="name_a"></span>
  </div>
<div class=" col-md-3">
  <label for="ex1"><font class="f1">นามสกุล<font style="color:red;font-size:25px;"> * </font> </font></label>
  <input class="form-control" id="lname" type="text" placeholder="นามสกุล" name="lname">
  <span id="lname_a"></span>

</div>
  </div>

  <div class="form-group row">
  <div class=" col-md-3">
    <label for="ex1"><font class="f1">รหัสนักศึกษา<font style="color:red;font-size:25px;"> * </font></font></label>
    <input class="form-control" id="code" type="number" placeholder="รหัสนักศึกษา" name="code">
    <span id="code_a"></span>
  </div>
  <div class=" col-md-3">
    <label for="ex1"><font class="f1">อีเมล <font style="color:red;font-size:25px;"> * </font> </font><span  class="glyphicon glyphicon-question-sign btn btn-warning" aria-hidden="true" data-toggle="tooltip" title="*หมายเหตุ! ใช้อีเมล @kru.ac.th เท่านั้น "></span></label>
    <input class="form-control" id="email" type="text" placeholder="อีเมล @kru.ac.th " name="email">
    <span id="email_a"></span>
  </div>
  </div>
  <div class="form-group row">
  <div class=" col-md-3">
    <label for="ex1"><font class="f1">คณะ <font style="color:red;font-size:25px;"> * </font> </font> </label>
    <select class="form-control" id="select_faculty" name="select_faculty">
      <option value="">-- คณะ --</option>
<?php $sql = mysql_query("SELECT * FROM tb_faculty ");
      while($fet = mysql_fetch_array($sql)) {
?>
      <option value="<?php echo $fet['faculty_key']; ?>"><?php echo $fet['faculty_name']; ?></option>
<?php } ?>
    </select>
    <span id="select_faculty_a"></span>

  </div>
<div class=" col-md-3">
  <label for="ex1"><font class="f1">สาขา <font style="color:red;font-size:25px;"> * </font> </font> </label>
  <select class="form-control" id="select_course" name="select_course">
    <span id='select_faculty_a'></span>
  </select>
  <span id="select_course_a"></span>
</div>
</div>

  <div class="form-group row">
  <div class=" col-md-3">
    <label for="ex1"><font class="f1">อัพโหลดไฟล์รูป <font style="color:red;font-size:25px;"> * </font> </font> <span  class="glyphicon glyphicon-question-sign btn btn-warning" aria-hidden="true" data-toggle="tooltip" title="อัปโหลดรูปภาพประจำตัวนามสกุลไฟล์ jpg,png เท่านั้น"></span></label>
    <input class="form-control" id="upload" type="file" name="file">
    <span id="upload_a"></span>
  </div>
  </div>

    <div class="form-group row">
    <div class=" col-md-3">
      <div class="g-recaptcha" data-sitekey="6LdsDUwUAAAAAO-WAIc9TwbSb5sE__94Ug-mIRWb"></div>
      <span class='msg'><?php echo $msg; ?></span>
      <span id="chk_a"></span>
    </div>
    </div>

  <div class="form-group row">
  <div class=" col-md-3">
      <input type="button" name="" value="ลงทะเบียน"  class="btn btn-success" id="save">
      <input type="reset" name="" value="รีเซต" class="btn btn-danger">
  </div>
  </div>
</form>

<script type="text/javascript">
var vuser = 0;
var vpassword = 0;
var vemail = 0;
var vuploade = 0;
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
  var a = $("#g-recaptcha-response").val();
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

if(username != "" ){
  $.post("include/validate.php",{
    text : username ,
    s : 's',
    status : 'len'
  },function(data){
if(data == '1'){
$("#username_a").html("<font style='color:red'><img src='img/validate.gif' width='20' heigth='20'>กรุณากรอกข้อความอย่างน้อย 8-16 ตัวอักษร</font>");
vuser = 0;
}else if(data == '2'){
$("#username_a").html("<font style='color:red'><img src='img/validate.gif' width='20' heigth='20'>มีชื่อผุ้ใช้นี้ในระบบแล้ว กรุณาใช้ชื่อผู้ใช้อื่น</font>");
vuser = 0;
}else if(data == ''){
$("#username_a").html("");
vuser = 1;
  }
  });
}else{
$("#username_a").html("<font style='color:red'><img src='img/validate.gif' width='20' heigth='20'>กรุณากรอกข้อความอย่างน้อย 8-16 ตัวอักษร</font>");
vuser = 0;
}

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
        vpassword = 0;
  }else{
    $("#password_a").html("");
    $("#passwordcon_a").html("");
    vpassword = 1;
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
$("#upload_a").html("<font style='color:red'><img src='img/validate.gif' width='20' heigth='20'>กรุณาเลือกไฟล์</font>");
  vuploade = 0;
}

if(email != "" ){
  $.post("include/validate.php",{
    text : email ,
    status : 'email'
  },function(data){
$("#email_a").html(data);
if(data == ''){
  vemail = 1;
}
  });
}else{
  vemail = 0;
}

if(a == ""){
$("#chk_a").html("<font style='color:red'><img src='img/validate.gif' width='20' heigth='20'>กรุณาคลิ๊กเพื่อยืนยัน</font>");
}else{
$("#chk_a").html("");
}

$(":input + span.require").remove();
   $(":input:not(:hidden)").each(function(){
       $(this).each(function(){
           if($(this).val()==""){
               $(this).after("<span class=require><font style='color:red'><img src='img/validate.gif' width='20' heigth='20'>จำเป็นต้องกรอก</font><br></span>");
}
       });
   });

if( a != "" && vuser == 1 && vpassword == 1 && vemail == 1 && vuploade == 1 && name != ""  && lname  != "" && code  != "" && email != "" && select_faculty != "" && select_course != "" && upload != "" ){
  var txt;
  var r = confirm("ยืนยันการลงทะเบียน");
  if (r == true) {
      $('#form_student').submit();
  }
}
});
</script>
