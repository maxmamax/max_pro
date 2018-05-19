<?php include("include/connect.php"); session_start(); ?>
<style media="screen">

</style>
<?php
if($_SESSION['session_status_menu'] == 'student' ){
$sql = mysql_query("SELECT * FROM tb_regiter_s a , tb_student b , tb_course c WHERE a.student_keyf = '".$_SESSION['session_key']."' AND b.student_key  = '".$_SESSION['session_key']."' AND b.course_key = c.course_key ");
$fet = mysql_fetch_array($sql);
?>
<form class="" action="include/student/add_application.php" method="post" id="form_application">
<div class="panel panel-default">
  <div class="panel-heading">
    <h1>ข้อมูลใบสมัครงาน</h1>
  </div>
  <div class="panel-body">

    <!--  1 -->
<?php
$sql1 = mysql_query("SELECT * FROM tb_student a ,  tb_course b , tb_faculty c WHERE a.student_key = '".$_SESSION['session_key']."' AND a.course_key = b.course_key AND a.faculty_keyf = c.faculty_key ");
$fet1 = mysql_fetch_array($sql1);
?>
<div class="panel panel-default">
  <div class="panel-heading"><font class="f">ข้อมูลส่วนตัวของนักศึกษา Personal Data:</font> </div>
  <div class="" align="center" style="margin-top:30px">
    <img src="include/image_student/<?php echo $fet1['student_part']; ?>" alt="รูปโปรไฟล์" width="150px" height="150px" >
  </div>
  <div class="panel-body" style="margin-top:30px;">

<div class="form-group row">
  <div class=" col-md-2">
    <label for="ex1"><font class="f1">ชื่อ</font></label>
    <input readonly type="text" name="" value="<?php echo $fet1['student_name']; ?>" class="form-control">
  </div>
  <div class=" col-md-2">
    <label for="ex1"><font class="f1">นามสกุล</font></label>
    <input readonly type="text" name="" value="<?php echo $fet1['student_last']; ?>" class="form-control">
  </div>
  <div class=" col-md-2">
    <label for="ex1"><font class="f1">รหัสประจำตัว</font></label>
    <input readonly type="text" name="" value="<?php echo $fet1['student_code']; ?>" class="form-control">
  </div>
  <div class=" col-md-2">
    <label for="ex1"><font class="f1">ชั้นปี</font></label>
    <select class="form-control" name="f_syear">
      <option value="<?php echo $fet['f_licencarl']; ?>">-- ชั้นปี --</option>
      <option value="1" <?php if($fet['f_syear'] == '1'){ echo "selected"; } ?>>ปีที่ 1</option>
      <option value="2" <?php if($fet['f_syear'] == '2'){ echo "selected"; } ?>>ปีที่ 2</option>
      <option value="3" <?php if($fet['f_syear'] == '3'){ echo "selected"; } ?>>ปีที่ 3</option>
      <option value="4" <?php if($fet['f_syear'] == '4'){ echo "selected"; } ?>>ปีที่ 4</option>
      <option value="5" <?php if($fet['f_syear'] == '5'){ echo "selected"; } ?>>ปีที่ 5</option>
      <option value="6" <?php if($fet['f_syear'] == '6'){ echo "selected"; } ?>>ปีที่ 6</option>
      <option value="7" <?php if($fet['f_syear'] == '7'){ echo "selected"; } ?>>ปีที่ 7</option>
      <option value="8" <?php if($fet['f_syear'] == '8'){ echo "selected"; } ?>>ปีที่ 8</option>
    </select>
  </div>
</div>

<div class="form-group row">
  <div class=" col-md-2">
    <label for="ex1"><font class="f1">Name</font></label>
    <input type="text" name="f_ename" value="<?php echo $fet['f_ename']; ?>" class="form-control">
  </div>
  <div class=" col-md-2">
    <label for="ex1"><font class="f1">Surname</font></label>
    <input type="text" name="f_elast" value="<?php echo $fet['f_elast']; ?>" class="form-control">
  </div>
  <div class=" col-md-3">
    <label for="ex1"><font class="f1">คณะ</font></label>
    <input readonly type="text" name="" value="<?php echo $fet1['faculty_name']; ?>" class="form-control">
  </div>
  <div class=" col-md-3">
    <label for="ex1"><font class="f1">สาขาวิชา</font></label>
    <input readonly type="text" name="" value="<?php echo $fet1['course_name']; ?>" class="form-control">
  </div>
  <div class=" col-md-2">
    <label for="ex1"><font class="f1">เกรดเฉลี่ย</font></label>
    <input type="text" name="f_grade" value="<?php echo $fet['f_grade']; ?>" class="form-control">
  </div>
  <div class=" col-md-2">
    <label for="ex1"><font class="f1">เพศ</font></label>
    <select class="form-control" name="f_sex">
      <option value="">-- เลือกเพศ --</option>
      <option value="1" <?php if($fet['f_sex'] == '1'){ echo "selected"; }?> >-- ชาย --</option>
      <option value="2" <?php if($fet['f_sex'] == '2'){ echo "selected"; }?>>-- หญิง --</option>
    </select>
  </div>
  <div class=" col-md-2">
    <label for="ex1"><font class="f1">สถานที่เกิด</font></label>
    <input type="text" name="f_pbirth" value="<?php echo $fet['f_pbirth']; ?>" class="form-control">
  </div>
  <div class=" col-md-2">
    <label for="ex1"><font class="f1">วันเกิด</font></label>
    <input type="date" name="f_brith" value="<?php echo $fet['f_brith']; ?>" class="form-control">
  </div>
  <div class=" col-md-2">
    <label for="ex1"><font class="f1">ส่วนสูง/cm</font></label>
    <input type="text" name="f_height" value="<?php echo $fet['f_height']; ?>" class="form-control">
  </div>
   <div class=" col-md-2">
      <label for="ex1"><font class="f1">น้ำหนัก/kg</font></label>
      <input type="text" name="f_weight" value="<?php echo $fet['f_weight']; ?>" class="form-control">
    </div>
</div>


<div class="form-group row">

</div>

<div class="form-group row">
  <div class=" col-md-2">
    <label for="ex1"><font class="f1">เลขบัตรประชาชน</font></label>
    <input type="text" name="f_idcards" value="<?php echo $fet['f_idcards']; ?>" class="form-control">
  </div>
  <div class=" col-md-2">
    <label for="ex1"><font class="f1">วันที่ออกบัตร</font></label>
    <input type="date" name="f_cards" value="<?php echo $fet['f_cards']; ?>" class="form-control">
  </div>
  <div class=" col-md-2">
    <label for="ex1"><font class="f1">วันหมดอายุ</font></label>
    <input type="date" name="f_cardl" value="<?php echo $fet['f_cardl']; ?>" class="form-control">
  </div>
</div>

<div class="form-group row">
  <div class=" col-md-2">
    <label for="ex1"><font class="f1">สถานที่ออกบัตร</font></label>
    <input type="text" name="f_placecard" value="<?php echo $fet['f_placecard']; ?>" class="form-control">
  </div>
  <div class=" col-md-2">
    <label for="ex1"><font class="f1">ศาสนา</font></label>
    <input type="text" name="f_religion" value="<?php echo $fet['f_religion']; ?>" class="form-control">
  </div>
  <div class=" col-md-2">
    <label for="ex1"><font class="f1">สัญชาติ</font></label>
    <input type="text" name="f_nation" value="<?php echo $fet['f_nation']; ?>" class="form-control">
  </div>
</div>


<div class="form-group row">
  <div class=" col-md-4">
    <label for="ex1"><font class="f1">ใบอณุญาติขับขี่รถจักรยานยตร์เลขที่</font></label>
    <input type="text" name="f_licencarmoter" value="<?php echo $fet['f_licencarmoter']; ?>" class="form-control">
  </div>
  <div class=" col-md-2">
    <label for="ex1"><font class="f1">วันหมดอายุ</font></label>
    <input type="date" name="f_licencarmotorl" value="<?php echo $fet['f_licencarmotorl']; ?>" class="form-control">
  </div>
</div>

<div class="form-group row">
  <div class=" col-md-3">
    <label for="ex1"><font class="f1">ใบอณุญาติขับขี่รถยนตร์เลขที่</font></label>
    <input type="text" name="f_licencar" value="<?php echo $fet['f_licencar']; ?>" class="form-control">
  </div>
  <div class=" col-md-2">
    <label for="ex1"><font class="f1">วันหมดอายุ</font></label>
    <input type="date" name="f_licencarl" value="<?php echo $fet['f_licencarl']; ?>" class="form-control">
  </div>
</div>


<div class="form-group row">
  <div class=" col-md-10">
    <label for="ex1"><font class="f1">การเกณฑ์ทหาร (สำหรับผู้ชายในการให้ข้อมูล)</font></label>
  <br>  <input type="radio" name="f_draft" value="1" class="" <?php if($fet['f_draft'] == '1'){ echo "checked"; }?> > <font class="f1">ผ่านการเกณฑ์แล้ว</font>
   <input type="radio" name="f_draft" value="2" class="" <?php if($fet['f_draft'] == '2'){ echo "checked"; }?>> <font class="f1">ยังไม่ได้เกณฑ์ / อยู่ในระหว่างการขอผ่อนผัน</font>
   <input type="radio" name="f_draft" value="3" class="" <?php if($fet['f_draft'] == '3'){ echo "checked"; }?>> <font class="f1">ได้รับการยกเว้น</font>

  </div>

</div>

  </div> </div>


<!--  2 -->
  <div class="panel panel-default">
    <div class="panel-heading"><font class="f">ช้อมูลเกี่ยวกับครอบครัว Family Data:</font> </div>
    <div class="" align="center">
    </div>
    <div class="panel-body">

  <div class="form-group row">
    <div class=" col-md-2">
      <label for="ex1"><font class="f1">ชื่อบิดา</font></label>
      <input type="text" name="f_namef" value="<?php echo $fet['f_namef']; ?>" class="form-control">
    </div>
    <div class=" col-md-3">
      <br> <br> <input type="radio" name="f_flife" value="1" class="" <?php if($fet['f_flife'] == '1'){ echo "checked" ; } ?> > <font class="f1">มีชีวิต</font>
       <input type="radio" name="f_flife" value="2" class="" <?php if($fet['f_flife'] == '2'){ echo "checked" ; } ?> > <font class="f1">ถึงแก่กรรม</font>
    </div>
    <div class=" col-md-2">
      <label for="ex1"><font class="f1">อาชีพ</font></label>
      <input type="text" name="f_fcarreer" value="<?php echo $fet['f_fcarreer']; ?>" class="form-control">
    </div>
    <div class=" col-md-2">
      <label for="ex1"><font class="f1">สถานที่ทำงาน</font></label>
      <input type="text" name="f_fwork" value="<?php echo $fet['f_fwork']; ?>" class="form-control">
    </div>
    <div class=" col-md-2">
      <label for="ex1"><font class="f1">โทรศัพท์</font></label>
      <input type="text" name="f_fphone" value="<?php echo $fet['f_fphone']; ?>" class="form-control">
    </div>
  </div>

  <div class="form-group row">
    <div class=" col-md-2">
      <label for="ex1"><font class="f1">ชื่อมารดา</font></label>
      <input type="text" name="f_namem" value="<?php echo $fet['f_namem']; ?>" class="form-control">
    </div>
    <div class=" col-md-3">
      <br> <br> <input type="radio" name="f_flifem" value="1" class="" <?php if($fet['f_flifem'] == '1'){ echo "checked" ; } ?> > <font class="f1">มีชีวิต</font>
       <input type="radio" name="f_flifem" value="2" class="" <?php if($fet['f_flifem'] == '2'){ echo "checked" ; } ?>> <font class="f1">ถึงแก่กรรม</font>
    </div>
    <div class=" col-md-2">
      <label for="ex1"><font class="f1">อาชีพ</font></label>
      <input type="text" name="f_mcarreer" value="<?php echo $fet['f_mcarreer']; ?>" class="form-control">
    </div>
    <div class=" col-md-2">
      <label for="ex1"><font class="f1">สถานที่ทำงาน</font></label>
      <input type="text" name="f_mwork" value="<?php echo $fet['f_mwork']; ?>" class="form-control">
    </div>
    <div class=" col-md-2">
      <label for="ex1"><font class="f1">โทรศัพท์</font></label>
      <input type="text" name="f_mphone" value="<?php echo $fet['f_mphone']; ?>" class="form-control">
    </div>
  </div>


    <div class="form-group row">
      <div class=" col-md-4">
        <label for="ex1"><font class="f1">สถานะภาพ</font></label>
        <input type="radio" name="f_statusfm" value="1" class="" <?php if($fet['f_statusfm'] == '1'){ echo "checked" ; } ?>> <font class="f1">อยู่ด้วยกัน</font>
        <input type="radio" name="f_statusfm" value="2" class="" <?php if($fet['f_statusfm'] == '2'){ echo "checked" ; } ?>> <font class="f1">หย่าร้าง</font>
      </div>
    </div>


  <div class="form-group row">
    <div class=" col-md-4">
      <label for="ex1"><font class="f1">ที่อยู่บิดา / มารดา</font></label>
      <input type="text" name="f_addreefm" value="<?php echo $fet['f_licencarl']; ?>" class="form-control">
    </div>
  </div>

  <div class="form-group row">
    <div class=" col-md-2">
      <label for="ex1"><font class="f1">จำนวนพี่น้อง</font></label>
      <input type="text" name="f_numsum" value="<?php echo $fet['f_numsum']; ?>" class="form-control">
    </div>
    <div class=" col-md-2">
      <label for="ex1"><font class="f1">เป็นบุตร/ธิดาคนที่</font></label>
      <input type="text" name="f_numcril" value="<?php echo $fet['f_numcril']; ?>" class="form-control">
    </div>
  </div>

  <div class="form-group row">
    <div class=" col-md-2">
      <label for="ex1"><font class="f1">ประกอบด้วย</font></label>
    </div>
  </div>
<div class="table-responsive">
<table class="table">

  <tr class="f1">
    <td>ชื่อ - นามสกุล</td>
    <td width="100px">อายุ</td>
    <td>ที่ทำงาน/ที่อยู่</td>
    <td>เบอร์โทรศัพท์</td>
  </tr>

  <tr>
    <td><input type="text" class="form-control" name="f_namec1" value="<?php echo $fet['f_namec1']; ?>"></td>
    <td><input type="text" class="form-control" name="f_oldc1" value="<?php echo $fet['f_oldc1']; ?>"></td>
    <td><input type="text" class="form-control" name="f_officeaddress1" value="<?php echo $fet['f_officeaddress1']; ?>"></td>
    <td><input type="text" class="form-control" name="f_phone1" value="<?php echo $fet['f_phone1']; ?>"></td>
  </tr>

  <tr>
    <td><input type="text" class="form-control" name="f_namec2" value="<?php echo $fet['f_namec2']; ?>"></td>
    <td><input type="text" class="form-control" name="f_oldc2" value="<?php echo $fet['f_oldc2']; ?>"></td>
    <td><input type="text" class="form-control" name="f_officeaddress2" value="<?php echo $fet['f_officeaddress2']; ?>"></td>
    <td><input type="text" class="form-control" name="f_phone2" value="<?php echo $fet['f_phone2']; ?>"></td>
  </tr>

  <tr>
    <td><input type="text" class="form-control" name="f_namec3" value="<?php echo $fet['f_namec3']; ?>"></td>
    <td><input type="text" class="form-control" name="f_oldc3" value="<?php echo $fet['f_oldc3']; ?>"></td>
    <td><input type="text" class="form-control" name="f_officeaddress3" value="<?php echo $fet['f_officeaddress3']; ?>"></td>
    <td><input type="text" class="form-control" name="f_phone3" value="<?php echo $fet['f_phone3']; ?>"></td>
  </tr>

  <tr>
    <td><input type="text" class="form-control" name="f_namec4" value="<?php echo $fet['f_namec4']; ?>"></td>
    <td><input type="text" class="form-control" name="f_oldc4" value="<?php echo $fet['f_oldc4']; ?>"></td>
    <td><input type="text" class="form-control" name="f_officeaddress4" value="<?php echo $fet['f_officeaddress4']; ?>"></td>
    <td><input type="text" class="form-control" name="f_phone4" value="<?php echo $fet['f_phone4']; ?>"></td>
  </tr>

  <tr>
    <td><input type="text" class="form-control" name="f_namec5" value="<?php echo $fet['f_namec5']; ?>"></td>
    <td><input type="text" class="form-control" name="f_oldc5" value="<?php echo $fet['f_oldc5']; ?>"></td>
    <td><input type="text" class="form-control" name="f_officeaddress5" value="<?php echo $fet['f_officeaddress5']; ?>"></td>
    <td><input type="text" class="form-control" name="f_phone5" value="<?php echo $fet['f_phone5']; ?>"></td>
  </tr>

</table>
</div>
    </div> </div>

    <!--  3 -->

<div class="panel panel-default">
  <div class="panel-heading"><font class="f">ที่อยู่อาศัย Address:</font> </div>
  <div class="" align="center">
  </div>
  <div class="panel-body">

<div class="form-group row">
  <div class=" col-md-4">
    <label for="ex1"><font class="f1">ที่อยู่ที่ติดต่อได้</font></label>
    <input type="text" name="f_address" value="<?php echo $fet['f_address']; ?>" class="form-control">
  </div>
  <div class=" col-md-2">
    <label for="ex1"><font class="f1">โทรศัพท์/โทรสาร</font></label>
    <input type="text" name="f_phone" value="<?php echo $fet['f_phone']; ?>" class="form-control">
  </div>
  <div class=" col-md-2">
    <label for="ex1"><font class="f1">โทรศัพท์มือถือ</font></label>
    <input type="text" name="f_phonemobie" value="<?php echo $fet['f_phonemobie']; ?>" class="form-control">
  </div>

</div>

<div class="form-group row">
  <div class=" col-md-4">
    <label for="ex1"><font class="f1">ที่อยู่ตามทะเบียนบ้าน</font></label>
    <input type="text" name="f_nameaddress" value="<?php echo $fet['f_nameaddress']; ?>" class="form-control">
  </div>
  <div class=" col-md-2">
    <label for="ex1"><font class="f1">โทรศัพท์</font></label>
    <input type="text" name="f_homephone" value="<?php echo $fet['f_homephone']; ?>" class="form-control">
  </div>
</div>
<font class="f">บุคคลที่ติดต่อได้เวลาฉุกเฉิน in Case of Emergency Please Contact:</font>
ิ<br><br>
<div class="form-group row">
  <div class=" col-md-3">
    <label for="ex1"><font class="f1">ชื่อ - นาสกุล</font></label>
    <input type="text" name="f_emername" value="<?php echo $fet['f_emername']; ?>" class="form-control">
  </div>
  <div class=" col-md-3">
    <label for="ex1"><font class="f1">ความสัมพันธ์กับผู้สมัครเป็น</font></label>
    <input type="text" name="f_emerrela" value="<?php echo $fet['f_emerrela']; ?>" class="form-control">
  </div>
</div>

<div class="form-group row">
  <div class=" col-md-4">
    <label for="ex1"><font class="f1">ที่ทำงาน/ที่อยู่</font></label>
    <input type="text" name="f_emeroffice" value="<?php echo $fet['f_emeroffice']; ?>" class="form-control">
  </div>
  <div class=" col-md-2">
    <label for="ex1"><font class="f1">โทรศัพท์/โทรสาร</font></label>
    <input type="text" name="f_emerphone" value="<?php echo $fet['f_emerphone']; ?>" class="form-control">
  </div>
  <div class=" col-md-2">
    <label for="ex1"><font class="f1">E-mail Address</font></label>
    <input type="text" name="f_emeremail" value="<?php echo $fet['f_emeremail']; ?>" class="form-control">
  </div>
</div>
</div>

  </div> </div>

<!-- 4 -->
  <div class="panel panel-default" style="margin-left:15px;margin-right:15px;">
    <div class="panel-heading"><font class="f">ประวัติการศึกษาและการฝึกอบรม Education and Training Backgrounds:</font> </div>
    <br>&nbsp;&nbsp;
    <font>เลือกข้อมูลการศึกษา :</font>
    <input type="radio" name="r_education" value="1" id="r_education_1" <?php if($fet['f_statutschool'] == '1'){ echo "checked"; }?> >  <font class="f1">กำลังศึกษา  </font>
    <input type="radio" name="r_education" value="2" id="r_education_2" <?php if($fet['f_statutschool'] == '2'){ echo "checked"; }?>><font  class="f1">ศิษย์เก่า  </font>
    <div class="panel-body">
<!-- กำลังศึกษา -->
<div id="education_1">
  <div class="form-group row">
    <div class="table-responsive">
    <table class="table table-bordered" style="text-align:center;">
      <thead>
      <tr class="f1">
        <td>การศึกษา</td>
        <td>ชื่อสถานศึกษา</td>
        <td>สาขาวิชา</td>
        <td>วุฒิที่ได้รับ</td>
        <td>ช่วงเวลาที่ศึกษา</td>
        <td>เกรดเฉลี่ย</td>
      </tr>
    </thead>
      <tr class="f2">
        <td>มัธยมศึกษา/ปวช/ปวส</td>
        <td><input type="text" class="form-control" name="f_schoolhightname" value="<?php echo $fet['f_schoolhightname']; ?>"></td>
        <td>-</td>
        <td><input type="text" class="form-control" name="f_schoolhightquq" value="<?php echo $fet['f_schoolhightquq']; ?>"></td>
        <td><input type="text" class="form-control" name="f_schoolhighttime" value="<?php echo $fet['f_schoolhighttime']; ?>"></td>
        <td><input type="text" class="form-control" name="f_schoolhightgrade" value="<?php echo $fet['f_schoolhightgrade']; ?>"></td>
      </tr>

      <tr class="f2">
        <td>ปริญญาตรี</td>
        <td>มหาวิทยาลัยราชภัฏกาญจนบุรี</td>
        <td><?php echo $fet1['course_name']; ?></td>
        <td>กำลังศึกษา</td>
        <td><input type="text" class="form-control" name="f_schoolbachtime" value="<?php echo $fet['f_schoolbachtime']; ?>"></td>
        <td><input type="text" class="form-control" name="f_schoolbachgrade" value="<?php echo $fet['f_schoolbachgrade']; ?>"></td>
      </tr>
    </table>
  </div>
  </div>
</div>

  <!-- ศิษย์เก่า -->
  <div id="education_2">
    <div class="form-group row">
      <div class="table-responsive">
      <table class="table table-bordered" style="text-align:center;">
        <thead>
        <tr class="f1">
          <td>การศึกษา</td>
          <td>ชื่อสถานศึกษา</td>
          <td>สาขาวิชา</td>
          <td>วุฒิที่ได้รับ</td>
          <td>ช่วงเวลาที่ศึกษา</td>
          <td>เกรดเฉลี่ย</td>
        </tr>
      </thead>
        <tr class="f2">
          <td>มัธยมศึกษา/ปวช/ปวส</td>
          <td><input type="text" class="form-control" name="f_schoolhightnamealu" value="<?php echo $fet['f_schoolhightname']; ?>"></td>
          <td>-</td>
          <td><input type="text" class="form-control" name="f_schoolhightquqalu" value="<?php echo $fet['f_schoolhightquq']; ?>"></td>
          <td><input type="text" class="form-control" name="f_schoolhighttimealu" value="<?php echo $fet['f_schoolhighttime']; ?>"></td>
          <td><input type="text" class="form-control" name="f_schoolhightgradealu" value="<?php echo $fet['f_schoolhightgrade']; ?>"></td>
        </tr>
        <tr class="f2">
          <td>ปริญญาตรี</td>
          <td>มหาวิทยาลัยราชภัฏกาญจนบุรี</td>
          <td><?php echo $fet1['course_name']; ?></td>
          <td>ปริญญาตรี</td>
          <td><input type="text" class="form-control" name="f_schoolbachtimealu" value="<?php echo $fet['f_schoolbachtime']; ?>"></td>
          <td><input type="text" class="form-control" name="f_schoolbachgradealu" value="<?php echo $fet['f_schoolbachgrade']; ?>"></td>
        </tr>
        <tr class="f1">
          <td>ปริญญาโท</td>
          <td><input type="text" class="form-control" name="f_schoolmasternamealu" value="<?php echo $fet['f_schoolmastername']; ?>"></td>
          <td><input type="text" class="form-control" name="f_schoolmasterbrandalu" value="<?php echo $fet['f_schoolmasterbrand']; ?>"></td>
          <td>
            <select class="form-control" name="f_schoolmasterquq">
              <option value="1" <?php if($fet['f_schoolmasterquq'] == '1'){ echo "selected"; }?> >กำลังศึกษา</option>
              <option value="2" <?php if($fet['f_schoolmasterquq'] == '2'){ echo "selected"; }?> >ปริญญาโท</option>
            </select>
          </td>
          <td><input type="text" class="form-control" name="f_schoolmastertimealu" value="<?php echo $fet['f_schoolmastertime']; ?>"></td>
          <td><input type="text" class="form-control" name="f_schoolmastergradealu" value="<?php echo $fet['f_schoolmastergrade']; ?>"></td>
        </tr>
      </table>
    </div>
    </div>
</div>


<div class="table-responsive">
<table class="table table-bordered">
  <thead>
  <tr class="f1">
    <td>การฝึกอบรม</td>
    <td>หัวข้อฝึกอบรม</td>
    <td>หน่วยงานที่ให้การฝึกอบรม</td>
    <td>ฃ่วงเวลาที่ฝึกอบรม (เดือน/พ.ศ.)</td>
  </tr>
</thead>
  <tr>
    <td><input type="text" class="form-control" name="f_train1" value="<?php echo $fet['f_train1']; ?>"></td>
    <td><input type="text" class="form-control" name="f_topictrain1" value="<?php echo $fet['f_topictrain1']; ?>"></td>
    <td><input type="text" class="form-control" name="f_departtrain1" value="<?php echo $fet['f_departtrain1']; ?>"></td>
    <td><input type="text" class="form-control" name="f_traintime1" value="<?php echo $fet['f_traintime1']; ?>"></td>
  </tr>

  <tr>
    <td><input type="text" class="form-control" name="f_train2" value="<?php echo $fet['f_train2']; ?>"></td>
    <td><input type="text" class="form-control" name="f_topictrain2" value="<?php echo $fet['f_topictrain2']; ?>"></td>
    <td><input type="text" class="form-control" name="f_departtrain2" value="<?php echo $fet['f_departtrain2']; ?>"></td>
    <td><input type="text" class="form-control" name="f_traintime2" value="<?php echo $fet['f_traintime2']; ?>"></td>
  </tr>

  <tr>
    <td><input type="text" class="form-control" name="f_train3" value="<?php echo $fet['f_train3']; ?>"></td>
    <td><input type="text" class="form-control" name="f_topictrain3" value="<?php echo $fet['f_topictrain3']; ?>"></td>
    <td><input type="text" class="form-control" name="f_departtrain3" value="<?php echo $fet['f_departtrain3']; ?>"></td>
    <td><input type="text" class="form-control" name="f_traintime3" value="<?php echo $fet['f_traintime3']; ?>"></td>
  </tr>

  <tr>
    <td><input type="text" class="form-control" name="f_train4" value="<?php echo $fet['f_train4']; ?>"></td>
    <td><input type="text" class="form-control" name="f_topictrain4" value="<?php echo $fet['f_departtrain4']; ?>"></td>
    <td><input type="text" class="form-control" name="f_departtrain4" value="<?php echo $fet['f_departtrain4']; ?>"></td>
    <td><input type="text" class="form-control" name="f_traintime4" value="<?php echo $fet['f_traintime4']; ?>"></td>
  </tr>

  <tr>
    <td><input type="text" class="form-control" name="f_train5" value="<?php echo $fet['f_train5']; ?>"></td>
    <td><input type="text" class="form-control" name="f_topictrain5" value="<?php echo $fet['f_topictrain5']; ?>"></td>
    <td><input type="text" class="form-control" name="f_departtrain5" value="<?php echo $fet['f_departtrain5']; ?>"></td>
    <td><input type="text" class="form-control" name="f_traintime5" value="<?php echo $fet['f_traintime5']; ?>"></td>
  </tr>
</table>
</div>
<font class="f">ความสามารถพิเศษ Skills:</font>
  <div class="form-group row" >
<div class="table-responsive">
    <table class="table " style="text-align:center;">
      <thead>
      <tr class="f1">
        <td bgcolor="#f5f5f5">คอมพิวเตอร์</td>
        <td>Excellent</td>
        <td>Good</td>
        <td>Fair</td>
        <td>Poor</td>
        <td bgcolor="#f5f5f5">ภาษาต่างประเทศ</td>
        <td>Excellent</td>
        <td>Good</td>
        <td>Fair</td>
        <td>Poor</td>
      </tr>
    </thead>
      <tr>
        <td>Words</td>
        <td><input type="radio" name="f_skillwords" value="1" <?php if($fet['f_skillwords'] == '1'){ echo "checked"; }?>></td>
        <td><input type="radio" name="f_skillwords" value="2" <?php if($fet['f_skillwords'] == '2'){ echo "checked"; }?>></td>
        <td><input type="radio" name="f_skillwords" value="3" <?php if($fet['f_skillwords'] == '3'){ echo "checked"; }?>></td>
        <td><input type="radio" name="f_skillwords" value="4" <?php if($fet['f_skillwords'] == '4'){ echo "checked"; }?>></td>
        <td>English</td>
        <td><input type="radio" name="f_skilleng" value="1" <?php if($fet['f_skilleng'] == '1'){ echo "checked"; }?>></td>
        <td><input type="radio" name="f_skilleng" value="2" <?php if($fet['f_skilleng'] == '2'){ echo "checked"; }?>></td>
        <td><input type="radio" name="f_skilleng" value="3" <?php if($fet['f_skilleng'] == '3'){ echo "checked"; }?>></td>
        <td><input type="radio" name="f_skilleng" value="4" <?php if($fet['f_skilleng'] == '4'){ echo "checked"; }?>></td>
      </tr>


      <tr>
        <td>Excel</td>
        <td><input type="radio" name="f_skillexcell" value="1" <?php if($fet['f_skillexcell'] == '1'){ echo "checked"; }?>></td>
        <td><input type="radio" name="f_skillexcell" value="2" <?php if($fet['f_skillexcell'] == '2'){ echo "checked"; }?>></td>
        <td><input type="radio" name="f_skillexcell" value="3" <?php if($fet['f_skillexcell'] == '3'){ echo "checked"; }?>></td>
        <td><input type="radio" name="f_skillexcell" value="4" <?php if($fet['f_skillexcell'] == '4'){ echo "checked"; }?>></td>
        <td>Japanese</td>
        <td><input type="radio" name="f_skilljapan" value="1" <?php if($fet['f_skilljapan'] == '1'){ echo "checked"; }?>></td>
        <td><input type="radio" name="f_skilljapan" value="2" <?php if($fet['f_skilljapan'] == '2'){ echo "checked"; }?>></td>
        <td><input type="radio" name="f_skilljapan" value="3" <?php if($fet['f_skilljapan'] == '3'){ echo "checked"; }?>></td>
        <td><input type="radio" name="f_skilljapan" value="4" <?php if($fet['f_skilljapan'] == '4'){ echo "checked"; }?>></td>
      </tr>
      <tr>
        <td>lnternet</td>
        <td><input type="radio" name="f_skillinternet" value="1" <?php if($fet['f_skillinternet'] == '1'){ echo "checked"; }?>></td>
        <td><input type="radio" name="f_skillinternet" value="2" <?php if($fet['f_skillinternet'] == '2'){ echo "checked"; }?>></td>
        <td><input type="radio" name="f_skillinternet" value="3" <?php if($fet['f_skillinternet'] == '3'){ echo "checked"; }?>></td>
        <td><input type="radio" name="f_skillinternet" value="4" <?php if($fet['f_skillinternet'] == '4'){ echo "checked"; }?>></td>
        <td>Chinese</td>
        <td><input type="radio" name="f_skillchine" value="1" <?php if($fet['f_skillchine'] == '1'){ echo "checked"; }?>></td>
        <td><input type="radio" name="f_skillchine" value="2" <?php if($fet['f_skillchine'] == '2'){ echo "checked"; }?>></td>
        <td><input type="radio" name="f_skillchine" value="3" <?php if($fet['f_skillchine'] == '3'){ echo "checked"; }?>></td>
        <td><input type="radio" name="f_skillchine" value="4" <?php if($fet['f_skillchine'] == '4'){ echo "checked"; }?>></td>
      </tr>


    </table>
</div>
<div class="table-responsive">
    <table class="table " style="text-align:center;">
      <thead>
      <tr class="f1">
        <td bgcolor="#f5f5f5">กีฬา/ดนตรี</td>
        <td>Excellent</td>
        <td>Good</td>
        <td>Fair</td>
        <td>Poor</td>
        <td bgcolor="#f5f5f5">อื่นๆ</td>
        <td>Excellent</td>
        <td>Good</td>
        <td>Fair</td>
        <td>Poor</td>
      </tr>
    </thead>
      <tr>
        <td><input type="text" class="form-control" name="f_sportname1" value="<?php echo $fet['f_sportname1']; ?>"></td>
        <td><input type="radio" name="f_sportchk1" value="1" <?php if($fet['f_sportchk1'] == '1'){ echo "checked"; }?>></td>
        <td><input type="radio" name="f_sportchk1" value="2" <?php if($fet['f_sportchk1'] == '2'){ echo "checked"; }?>></td>
        <td><input type="radio" name="f_sportchk1" value="3" <?php if($fet['f_sportchk1'] == '3'){ echo "checked"; }?>></td>
        <td><input type="radio" name="f_sportchk1" value="4" <?php if($fet['f_sportchk1'] == '4'){ echo "checked"; }?>></td>
        <td><input type="text" class="form-control" name="f_sportother1" value="<?php echo $fet['f_sportother1']; ?>"></td>
        <td><input type="radio" name="f_sportotherchk1" value="1" <?php if($fet['f_sportotherchk1'] == '1'){ echo "checked"; }?>></td>
        <td><input type="radio" name="f_sportotherchk1" value="2" <?php if($fet['f_sportotherchk1'] == '2'){ echo "checked"; }?>></td>
        <td><input type="radio" name="f_sportotherchk1" value="3" <?php if($fet['f_sportotherchk1'] == '3'){ echo "checked"; }?>></td>
        <td><input type="radio" name="f_sportotherchk1" value="4" <?php if($fet['f_sportotherchk1'] == '4'){ echo "checked"; }?>></td>
      </tr>


      <tr>
        <td><input type="text" class="form-control" name="f_sportname2" value="<?php echo $fet['f_sportname2']; ?>"></td>
        <td><input type="radio" name="f_sportchk2" value="1" <?php if($fet['f_sportchk2'] == '1'){ echo "checked"; }?>></td>
        <td><input type="radio" name="f_sportchk2" value="2" <?php if($fet['f_sportchk2'] == '2'){ echo "checked"; }?>></td>
        <td><input type="radio" name="f_sportchk2" value="3" <?php if($fet['f_sportchk2'] == '3'){ echo "checked"; }?>></td>
        <td><input type="radio" name="f_sportchk2" value="4" <?php if($fet['f_sportchk2'] == '4'){ echo "checked"; }?>></td>
        <td><input type="text" class="form-control" name="f_sportother2" value="<?php echo $fet['f_sportother2']; ?>"></td>
        <td><input type="radio" name="f_sportotherchk2" value="1" <?php if($fet['f_sportotherchk2'] == '1'){ echo "checked"; }?>></td>
        <td><input type="radio" name="f_sportotherchk2" value="2" <?php if($fet['f_sportotherchk2'] == '2'){ echo "checked"; }?>></td>
        <td><input type="radio" name="f_sportotherchk2" value="3" <?php if($fet['f_sportotherchk2'] == '3'){ echo "checked"; }?>></td>
        <td><input type="radio" name="f_sportotherchk2" value="4" <?php if($fet['f_sportotherchk2'] == '4'){ echo "checked"; }?>></td>
      </tr>


    </table>

  </div>
  <font class="f" style="margin-left:15px;margin-rigth:15px;" >ประสบการณ์การปฏิบัติงานและกิจกรรมนักศึกษา Work Experience & Student Activities:</font>
  <br><br>
  <div  style="margin-left:15px;margin-rigth:15px;">
  <div class="table-responsive">
  <table class="table table-bordered">
    <thead>
    <tr class="f1">
      <td>ช่วงเวลา - ปี</td>
      <td>องค์กร/กิจกรรม</td>
      <td>ความรับผิดชอบ</td>
      <td>หมายเหตุ</td>
    </tr>
  </thead>
    <tr class="f2">
      <td><input type="text" name="f_worktime1" value="<?php echo $fet['f_worktime1']; ?>" class="form-control"></td>
      <td><input type="text" name="f_workaction1" value="<?php echo $fet['f_workaction1']; ?>" class="form-control"></td>
      <td><input type="text" name="f_workres1" value="<?php echo $fet['f_workres1']; ?>" class="form-control"></td>
      <td><input type="text" name="f_worknote1" value="<?php echo $fet['f_worknote1']; ?>" class="form-control"></td>
    </tr>

    <tr class="f1">
      <td><input type="text" name="f_worktime2" value="<?php echo $fet['f_worktime2']; ?>" class="form-control"></td>
      <td><input type="text" name="f_workaction2" value="<?php echo $fet['f_workaction2']; ?>" class="form-control"></td>
      <td><input type="text" name="f_workres2" value="<?php echo $fet['f_workres2']; ?>" class="form-control"></td>
      <td><input type="text" name="f_worknote2" value="<?php echo $fet['f_worknote2']; ?>" class="form-control"></td>
    </tr>

    <tr class="f1">
      <td><input type="text" name="f_worktime3" value="<?php echo $fet['f_worktime3']; ?>" class="form-control"></td>
      <td><input type="text" name="f_workaction3" value="<?php echo $fet['f_workaction3']; ?>" class="form-control"></td>
      <td><input type="text" name="f_workres3" value="<?php echo $fet['f_workres3']; ?>" class="form-control"></td>
      <td><input type="text" name="f_worknote3" value="<?php echo $fet['f_worknote3']; ?>" class="form-control"></td>
    </tr>

    <tr class="f1">
      <td><input type="text" name="f_worktime4" value="<?php echo $fet['f_worktime4']; ?>" class="form-control"></td>
      <td><input type="text" name="f_workaction4" value="<?php echo $fet['f_workaction4']; ?>" class="form-control"></td>
      <td><input type="text" name="f_workres4" value="<?php echo $fet['f_workres4']; ?>" class="form-control"></td>
      <td><input type="text" name="f_worknote4" value="<?php echo $fet['f_worknote4']; ?>" class="form-control"></td>
    </tr>

    <tr class="f1">
      <td><input type="text" name="f_worktime5" value="<?php echo $fet['f_worktime5']; ?>" class="form-control"></td>
      <td><input type="text" name="f_workaction5" value="<?php echo $fet['f_workaction5']; ?>" class="form-control"></td>
      <td><input type="text" name="f_workres5" value="<?php echo $fet['f_workres5']; ?>" class="form-control"></td>
      <td><input type="text" name="f_worknote5" value="<?php echo $fet['f_worknote5']; ?>" class="form-control"></td>
    </tr>

  </table>
</div>
  </div>

  <font class="f" style="margin-left:15px;margin-rigth:15px;">รางวัลที่ได้รับ Awarde:</font>
  <br><br>
  <div  style="margin-left:15px;margin-rigth:15px;">
  <div class="table-responsive">
  <table class="table table-bordered" >
    <thead>
    <tr class="f1">
      <td>ชื่อรางวัล</td>
      <td>หน่วยงานที่มอบให้</td>
      <td width="100px;">วันเดือนปีที่ได้รับ</td>
    </tr>
  </thead>
    <tr class="f1">
      <td><input type="text" name="f_awardname1" value="<?php echo $fet['f_awardname1']; ?>" class="form-control"></td>
      <td><input type="text" name="f_awarddepart1" value="<?php echo $fet['f_awarddepart1']; ?>" class="form-control"></td>
      <td><input type="date" name="f_awardtime1" value="<?php echo $fet['f_awardtime1']; ?>" class="form-control"></td>
    </tr>
    <tr class="f1">
      <td><input type="text" name="f_awardname2" value="<?php echo $fet['f_awardname2']; ?>" class="form-control"></td>
      <td><input type="text" name="f_awarddepart2" value="<?php echo $fet['f_awarddepart2']; ?>" class="form-control"></td>
      <td><input type="date" name="f_awardtime2" value="<?php echo $fet['f_awardtime2']; ?>" class="form-control"></td>
    </tr>

    <tr class="f1">
      <td><input type="text" name="f_awardname3" value="<?php echo $fet['f_awardname3']; ?>" class="form-control"></td>
      <td><input type="text" name="f_awarddepart3" value="<?php echo $fet['f_awarddepart3']; ?>" class="form-control"></td>
      <td><input type="date" name="f_awardtime3" value="<?php echo $fet['f_awardtime3']; ?>" class="form-control"></td>
    </tr>
  </table>
  <button class="btn btn-success" id="add_application" type="button"><font class="f">อัพเดตข้อมูลใบสมัคร</font></button>
  
</div>
  </div>

  </div>

</div> </div>

</form>
<?php } ?>
<script type="text/javascript">

$("#r_education_1").click(function(){
    $("#education_1").show();
    $("#education_2").hide();
});

$("#r_education_2").click(function(){
    $("#education_1").hide();
    $("#education_2").show();
});

if ($('#r_education_1').attr('checked'))
{
  $("#education_1").show();
  $("#education_2").hide();
}

if ($('#r_education_2').attr('checked'))
{
  $("#education_1").hide();
  $("#education_2").show();
}

if ($('#r_education_1').attr('checked') || $('#r_education_2').attr('checked') )
{
}else{
  $("#education_1").hide();
  $("#education_2").hide();
}




$("#add_application").click(function(){
  var r = confirm("ยืนยันการบันทึกข้อมูล");
  if (r == true) {
      $('#form_application').submit();
  }
});


    CKEDITOR.replace( 'message1' );
    CKEDITOR.replace( 'message2' );
    CKEDITOR.replace( 'message3' );

</script>
