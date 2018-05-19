<?php include("connect.php"); include("email/email.php");?>
<style media="screen">
span{
  font-family: 'Mitr', sans-serif;

}
</style>
<!--  student -->
<?php
if($_POST['username'] != "" &&  $_POST['password'] != "" ){
$sql = mysql_query("SELECT count(coop_user) as a FROM  tb_cooperative WHERE coop_user = '".'C_'.$_POST['username']."' ");
$fet = mysql_fetch_array($sql);
if($fet['a'] == '0'){
$sql = mysql_query("INSERT INTO  tb_cooperative VALUES  ('','".'C_'.$_POST['username']."','".$_POST['password']."','".$_POST['Tname']."','".$_POST['Ename']."','".$_POST['address']."','".$_POST['sdistrict']."','".$_POST['district']."','".$_POST['province']."','".$_POST['code']."','".$_POST['phone']."','".$_POST['email']."','".$_POST['web']."','".$_POST['sear']."','1') ");
$sql = mysql_query("SELECT * FROM tb_cooperative WHERE coop_user = '".'C_'.$_POST['username']."' ");
$fet = mysql_fetch_array($sql);
$rand = 'C_'.substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ23456789'),0,5);
$sql2 = mysql_query("INSERT INTO tb_security_cooperative VALUES ('".$fet['coop_key']."','$rand') ") ;
$i = sentEmail('C_'.$_POST['username'],$_POST['password'],$rand,$_POST['email']);
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

<form action="" method="post" style="margin-top:-50px" id="form_coop" enctype="multipart/form-data">
    <div id="student" style="margin-top:50px;margin-left:20px;">
  <div class="form-group row">
    <div class="col-md-3">
      <label for="ex1"><font class="f1">ชื่อผู้ใช้</font><font style="color:red;font-size:25px;"> * </font> <span  class="glyphicon glyphicon-question-sign btn btn-warning" aria-hidden="true" data-toggle="tooltip" title="ชื่อผู้ใช้จะต้องมีความยาวอย่างน้อย 8 - 16 ตัวอักษร"></span> </label>
      <input class="form-control" id="username" type="text" placeholder="ชื่อผู้ใช้" name="username">
      <span id="username_a"></span>
    </div>
    <div class=" col-md-3">
      <label for="ex1"><font class="f1">รหัสผ่าน<font style="color:red;font-size:25px;"> * </font> <span  class="glyphicon glyphicon-question-sign btn btn-warning" aria-hidden="true" data-toggle="tooltip" title="รหัสผ่านจะต้องมีความยาวอย่างน้อย 8 - 16 ตัวอักษร"></span></font></label>
      <input class="form-control" id="password" type="text" placeholder="รหัสผ่าน" name="password">
      <span id="password_a"></span>
    </div>
    <div class=" col-md-3">
      <label for="ex1"><font class="f1">ยืนยันรหัสผ่าน <font style="color:red;font-size:25px;"> * </font></font> <span  class="glyphicon glyphicon-question-sign btn btn-warning" aria-hidden="true" data-toggle="tooltip" title="กรอกข้อมูลรหัสผ่านอีกครั้ง"></span></label>
      <input class="form-control" id="passwordcon" type="text" placeholder="ยืนยันรหัสผ่าน">
      <span id="passwordcon_a"></span>
    </div>
  </div>
<div class="form-group row">
  <div class=" col-md-3">
    <label for="ex1"><font class="f1">ชื่อภาษาไทย <font style="color:red;font-size:25px;"> * </font></font><label>
    <input class="form-control" id="Tname" type="text" placeholder="ชื่อภาษาไทย" name="Tname"  >
    <span id="Tname_a"></span>
  </div>
<div class=" col-md-3">
  <label for="ex1"><font class="f1">ชื่อภาษาอังกฤษ <font style="color:red;font-size:25px;"> * </font></font></label>
  <input class="form-control" id="Ename" type="text" placeholder="ชื่อภาษาอังกฤษ" name="Ename">
  <span id="Ename_a"></span>
</div>

</div>

  <div class="form-group row">
    <div class="col-md-3">
      <label for="ex1"><font class="f1">ที่อยู <font style="color:red;font-size:25px;"> * </font></font></label>
      <input class="form-control" id="address" type="text" placeholder="ที่อยู่" name="address">
      <span id="address_a"></span>
    </div>
    <div class=" col-md-2">
      <label for="ex1"><font class="f1">ตำบล <font style="color:red;font-size:25px;"> * </font></font></label>
      <input class="form-control" id="sdistrict" type="text" placeholder="ตำบล" name="sdistrict">
      <span id="sdistrict_a"></span>
    </div>
    <div class=" col-md-2">
      <label for="ex1"><font class="f1">อำเภอ <font style="color:red;font-size:25px;"> * </font></font></label>
      <input class="form-control" id="district" type="text" placeholder="อำเภอ" name="district">
      <span id="district_a"></span>
    </div>
    <div class=" col-md-2">
      <label for="ex1"><font class="f1">จังหวัด <font style="color:red;font-size:25px;"> * </font></font></span></label>
      <input class="form-control" id="province" type="text" placeholder="จังหวัด"  name="province">
      <span id="province_a"></span>
    </div>
    <div class=" col-md-2">
      <label for="ex1"><font class="f1">รหัสไปรษณีย์ <font style="color:red;font-size:25px;"> * </font></font></span></label>
      <input class="form-control" id="code" type="number" placeholder="รหัสไปรษณีย์" name="code">
      <span id="code_a"></span>
    </div>
  </div>
  <div class="form-group row">
    <div class=" col-md-2">
      <label for="ex1"><font class="f1">เบอร์โทรศัพท์ <font style="color:red;font-size:25px;"> * </font></span></font></label>
      <input class="form-control" id="phone" type="text" placeholder="เบอร์โทรศัพท์" name="phone">
      <span id="phone_a"></span>
    </div>
    <div class=" col-md-2">
      <label for="ex1"><font class="f1">อีเมล <font style="color:red;font-size:25px;"> * </font></font><span  class="glyphicon glyphicon-question-sign btn btn-warning" aria-hidden="true" data-toggle="tooltip" title="*หมายเหตุ! กรอกข้อมูลอีเมล @hotmail , @gmail เท่านั้น"></span></label>
      <input class="form-control" id="email" type="text" placeholder="อีเมล @hotmail,@gmail" name="email">
      <span id="email_a" style="font-size:15px;"></span>
    </div>
    <div class=" col-md-2">
      <label for="ex1"><font class="f1">เว็บไซด์ <font style="color:red;font-size:25px;"> * </font></font></span></label>
      <input class="form-control" id="web" type="text" placeholder="เว็บไซด์" name="web">
      <span id="web_a"></span>
    </div>
    <div class=" col-md-2">
      <label for="ex1"><font class="f1">คำค้นหา <font style="color:red;font-size:25px;"> * </font></font></span></label>
      <input class="form-control" id="sear" type="text" placeholder="คำค้นหา" name="sear">
      <span id="sear_a"></span>
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
  </div>
</form>

<script type="text/javascript">
var vuser = 0;
var vpassword = 0;
var vemail = 0;
var vcon = 0;
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});

$("#save").click(function(){
  var a = $("#g-recaptcha-response").val();
  var username = $("#username").val();
  var password = $("#password").val();
  var passwordcon = $("#passwordcon").val();
  var Tname = $("#Tname").val();
  var Ename = $("#Ename").val();
  var address = $("#address").val();
  var sdistrict = $("#sdistrict").val();
  var district = $("#district").val();
  var province = $("#province").val();
  var code = $("#code").val();
  var phone = $("#phone").val();
  var web = $("#web").val();
  var sear = $("#sear").val();
  var email = $("#email").val();

    if(username != "" ){
      $.post("include/validate.php",{
        text : username ,
        s : 'c',
        status : 'len'
      },function(data){
        if(data == '1'){
        $("#username_a").html("<font style='color:red'><img src='img/validate.gif' width='20' heigth='20'>กรุณากรอกข้อความอย่างน้อย 8-16 ตัวอักษร</font>");
        vuser = 0;
        }else if(data == '2'){
        $("#username_a").html("<font style='color:red'><img src='img/validate.gif' width='20' heigth='20'>มีชื่อผุ้ใช้นี้ในระบบแล้ว กรุณาใช้ชื่อผู้ใช้อื่น</font>");
        vser = 0;
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
        vpassword = 0;
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
  vcon = 0;
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

if(email != "" ){
  $.post("include/validate.php",{
    text : email ,
    status : 'emailcoop'
  },function(data){
$("#email_a").html(data);
if(data == ''){
 vemail = 1;
}
  });
}else{
$("#email_a").html("<font style='color:red'><img src='img/validate.gif' width='20' heigth='20'>กรุณากรอกอีเมล</font>");
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

if( a != "" && vuser == 1 && vpassword == 1 && vemail == 1 && vcon == 1  && Tname != '' && Ename != ''  && address   != '' && sdistrict   != '' && district != '' && province != ''&& code != '' && phone != ''  &&  web != ''  &&  sear  != ''  &&  email  != ''){
       var txt;
       var r = confirm("ยืนยันการลงทะเบียน");
       if (r == true) {

           $('#form_coop').submit();
       }

}
});

</script>
