<?php include ("include/connect.php"); session_start(); ?>
<style media="screen">
</style>


<?php
if($_POST['username'] != "" &&  $_POST['password'] != "" ){

$sql = mysql_query("UPDATE tb_cooperative SET
coop_pass = '".$_POST['password']."',
coop_Tname = '".$_POST['Tname']."',
coop_Ename	 = '".$_POST['Ename']."',
coop_address	 = '".$_POST['address']."',
coop_sdistrict	 = '".$_POST['sdistrict']."',
coop_district	 = '".$_POST['district']."',
coop_province	 = '".$_POST['province']."',
coop_code	 = '".$_POST['code']."',
coop_phone	 = '".$_POST['phone']."',
coop_email	 = '".$_POST['email']."',
coop_web	 = '".$_POST['web']."',
coop_s	 = '".$_POST['sear']."'
 WHERE coop_key = '".$_SESSION['session_key']."'
");

}
?>


<?php
$sql = mysql_query("SELECT * FROM  tb_cooperative a   WHERE a.coop_key = '".$_SESSION['session_key']."' ");
$fet = mysql_fetch_array($sql);
?>
<div class="panel panel-default">
  <div class="panel-heading" style="background-color:#ffcfa8;border-width:1px 10px 20px;border-color:#ff7b3a;"><h1><font>แก้ไขข้อมูล</font></h1></div>
  <div class="panel-body">
    <div class="form-group row">

      <form action="" method="post" style="margin-top:-50px" id="form_coop" enctype="multipart/form-data">
          <div id="student" style="margin-top:100px;margin-left:20px;">
        <div class="form-group row">
          <div class="col-md-3">
            <label for="ex1"><font class="f1">ชื่อผู้ใช้</font><font style="color:red;font-size:25px;"> * </font> <span  class="glyphicon glyphicon-question-sign btn btn-warning" aria-hidden="true" data-toggle="tooltip" title="*หมายเหตุ! มีความยาวอย่างน้อย 8 - 16 ตัวอักษร (ชื่อผู้ใช้จะนำไปใช้ในการเข้าสู่ระบบ)"></span> </label>
            <input readonly class="form-control" id="username" type="text" placeholder="ชื่อผู้ใช้" name="username" value="<?php echo $fet['coop_user']; ?>">
            <span id="username_a"></span>
          </div>
          <div class=" col-md-3">
            <label for="ex1"><font class="f1">รหัสผ่าน<font style="color:red;font-size:25px;"> * </font> <span  class="glyphicon glyphicon-question-sign btn btn-warning" aria-hidden="true" data-toggle="tooltip" title="*หมายเหตุ! มีความยาวอย่างน้อย 8 - 16 ตัวอักษร (รหัสผ่านจะนำไปใช้ในการเข้าสู่ระบบ)"></span></font></label>
            <input class="form-control" id="password" type="text" placeholder="รหัสผ่าน" name="password" value="<?php echo $fet['coop_pass']; ?>">
            <span id="password_a"></span>
          </div>
          <div class=" col-md-3">
            <label for="ex1"><font class="f1">ยืนยันรหัสผ่าน <font style="color:red;font-size:25px;"> * </font></font> <span  class="glyphicon glyphicon-question-sign btn btn-warning" aria-hidden="true" data-toggle="tooltip" title="*หมายเหตุ! กรอกข้อมูลรหัสผ่านอีกครั้ง "></span></label>
            <input class="form-control" id="passwordcon" type="text" placeholder="ยืนยันรหัสผ่าน">
            <span id="passwordcon_a"></span>
          </div>
        </div>
      <div class="form-group row">
        <div class=" col-md-3">
          <label for="ex1"><font class="f1">ชื่อภาษาไทย <font style="color:red;font-size:25px;"> * </font></font></label>
          <input class="form-control" id="Tname" type="text" placeholder="ชื่อภาษาไทย" name="Tname" value="<?php echo $fet['coop_Tname']; ?>">
          <span id="Tname_a"></span>
        </div>
      <div class=" col-md-3">
        <label for="ex1"><font class="f1">ชื่อภาษาอังกฤษ <font style="color:red;font-size:25px;"> * </font></font></label>
        <input class="form-control" id="Ename" type="text" placeholder="ชื่อภาษาอังกฤษ" name="Ename" value="<?php echo $fet['coop_Ename']; ?>">
        <span id="Ename_a"></span>
      </div>

      </div>




        <div class="form-group row">
          <div class="col-md-3">
            <label for="ex1"><font class="f1">ที่อยู <font style="color:red;font-size:25px;"> * </font></font></label>
            <input class="form-control" id="address" type="text" placeholder="ที่อยู่" name="address" value="<?php echo $fet['coop_address']; ?>">
            <span id="address_a"></span>
          </div>
          <div class=" col-md-2">
            <label for="ex1"><font class="f1">ตำบล <font style="color:red;font-size:25px;"> * </font></font></label>
            <input class="form-control" id="sdistrict" type="text" placeholder="ตำบล" name="sdistrict" value="<?php echo $fet['coop_sdistrict']; ?>">
            <span id="sdistrict_a"></span>
          </div>
          <div class=" col-md-2">
            <label for="ex1"><font class="f1">อำเภอ <font style="color:red;font-size:25px;"> * </font></font></label>
            <input class="form-control" id="district" type="text" placeholder="อำเภอ" name="district" value="<?php echo $fet['coop_district']; ?>">
            <span id="district_a"></span>
          </div>
          <div class=" col-md-2">
            <label for="ex1"><font class="f1">จังหวัด <font style="color:red;font-size:25px;"> * </font></font></span></label>
            <input class="form-control" id="province" type="text" placeholder="จังหวัด"  name="province" value="<?php echo $fet['coop_province']; ?>">
            <span id="province_a"></span>
          </div>
          <div class=" col-md-2">
            <label for="ex1"><font class="f1">รหัสไปรษณีย์ <font style="color:red;font-size:25px;"> * </font></font></span></label>
            <input class="form-control" id="code" type="number" placeholder="รหัสไปรษณีย์" name="code" value="<?php echo $fet['coop_code']; ?>">
            <span id="code_a"></span>
          </div>
        </div>
        <div class="form-group row">
          <div class=" col-md-2">
            <label for="ex1"><font class="f1">เบอร์โทรศัพท์ <font style="color:red;font-size:25px;"> * </font></span></font></label>
            <input class="form-control" id="phone" type="text" placeholder="เบอร์โทรศัพท์" name="phone" value="<?php echo $fet['coop_phone']; ?>">
            <span id="phone_a"></span>
          </div>
          <div class=" col-md-2">
            <label for="ex1"><font class="f1">อีเมล <font style="color:red;font-size:25px;"> * </font></font><span  class="glyphicon glyphicon-question-sign btn btn-warning" aria-hidden="true" data-toggle="tooltip" title="*หมายเหตุ! กรอกข้อมูลอีเมล hotmail , gmail (ห้ามปล่อยว่าง)"></span></label>
            <input  readonly class="form-control" id="email" type="text" placeholder="อีเมลล์" name="email" value="<?php echo $fet['coop_email']; ?>">
            <span id="email_a" style="font-size:15px;"></span>
          </div>
          <div class=" col-md-2">
            <label for="ex1"><font class="f1">เว็บไซด์ <font style="color:red;font-size:25px;"> * </font></font></span></label>
            <input class="form-control" id="web" type="text" placeholder="เว็บไซด์" name="web" value="<?php echo $fet['coop_web']; ?>">
            <span id="web_a"></span>
          </div>
          <div class=" col-md-2">
            <label for="ex1"><font class="f1">คำค้นหา <font style="color:red;font-size:25px;"> * </font></font></span></label>
            <input class="form-control" id="sear" type="text" placeholder="คำค้นหา" name="sear" value="<?php echo $fet['coop_s']; ?>">
            <span id="sear_a"></span>
          </div>
        </div>


        <div class="form-group row">
        <div class=" col-md-3">
            <input type="button" name="" value="แก้ไขข้อมูล"  class="btn btn-success" id="save">
            <input type="reset" name="" value="รีเซต" class="btn btn-danger">
        </div>
        </div>
        </div>
      </form>

</div>
</div>
</div>


<script type="text/javascript">
var vpassword = 0;
var vcon = 0 ;
var vuploade = 0;  var vpassword = 0;
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
  var Tname  = $("#Tname").val();
  var Ename = $("#Ename").val();
  var address = $("#address").val();
  var sdistrict = $("#sdistrict").val();
  var district = $("#district").val();
  var provinc = $("#provinc").val();
  var code = $("#code").val();
  var phone = $("#phone").val();
  var email = $("#email").val();
  var web = $("#web").val();
  var sear = $("#sear").val();
  var s;

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




$(":input + span.require").remove();
   $(":input").each(function(){
       $(this).each(function(){
           if($(this).val()==""){
               $(this).after("<span class=require><font style='color:red'><img src='img/validate.gif' width='20' heigth='20'>จำเป็นต้องกรอก</font><br></span>");
}
       });
   });


if(vpassword == 1 && vcon == 1 && Tname != ""  && Ename  != "" && address  != "" && sdistrict  != "" && province != "" && code != "" && phone != "" && email != "" && web != "" && sear != "" ){
  var txt;
  var r = confirm("ยืนยันการลงทะเบียน");
  if (r == true) {
      $('#form_coop').submit();
  }
}
});
</script>
