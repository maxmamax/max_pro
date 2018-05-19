<?php session_start(); ob_start(); ?>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">

<?php
require_once('mpdf/mpdf.php'); //ที่อยู่ของไฟล์ mpdf.php ในเครื่องเรานะครับ
function changeDate($date){
$get_date = explode("-",$date);
  $month = array("01"=>"ม.ค.","02"=>"ก.พ","03"=>"มี.ค.","04"=>"เม.ย.","05"=>"พ.ค.","06"=>"มิ.ย.","07"=>"ก.ค.","08"=>"ส.ค.","09"=>"ก.ย.","10"=>"ต.ค.","11"=>"พ.ย.","12"=>"ธ.ค.");
$get_month = $get_date["1"];
$year = $get_date["0"]+543;
return $get_date["2"]." ".$month[$get_month]." ".$year;
}
?>

<?php
$key_student = $_POST['key_student'];
$key_position = $_POST['key_position'];
mysql_connect("localhost","root","max123456");
mysql_select_db("tb_cooperative");
mysql_query("SET NAMES UTF8");
$sql = mysql_query("SELECT * FROM tb_student a , tb_position b , tb_faculty c , tb_course d , tb_regiter_s f , tb_cooperative g  WHERE a.student_key = '".$key_student."' AND b.position_key = '".$key_position."' AND b.coop_keyf = g.coop_key  ");
$fet = mysql_fetch_array($sql);
if($fet){
?>
<div align="center"><font style="font-size:20px">ใบสมัครงานสหกิจศึกษา<br>COOPERATIVE KRU</font></div>
<table>
  <tr>
    <td><img src="kru.png" width="65px" height="80px"></td>
    <td width="480px">
    <div ><font style="background-color:#f5f5f5;">ชื่อสถานประกอบการ :</font> <u><?php echo $fet['coop_Tname']; ?></u></div>
    <div ><font style="background-color:#f5f5f5;">สมัครตำแหน่งาน</font>  <u> <?php echo $fet['position_name']; ?></u></div>
    <div ><font style="background-color:#f5f5f5;">ระยะเวลาปฏิบัติงานตั้งแต่วันที่</font> <u> <?php echo changeDate($fet['position_dateF'])."-".changeDate($fet['position_dateF']); ?></u></div>
    </td>
    <td><img style="padding:4px;border:4px solid #333" width="100px" height="130px" src="<?php echo "../image_student/".$fet['student_part']; ?>"></td>
  </tr>
</table>


<div  style="display:block; border:#000 solid 1px;">
<div style="margin-left:10px;margin-right:10px;margin-top:25px;">
 ข้อมูลส่วนตัวของนักศึกษา Personal Date:
 <table>
   <tr>
     <td><font style="background-color:#f5f5f5;">ชื่อ : </font> <u><?php echo $fet['student_name']; ?></u></td>
     <td><font style="background-color:#f5f5f5;">นามสกุล : </font>  <u><?php echo $fet['student_last']; ?></u></td>
     <td><font style="background-color:#f5f5f5;">รหัสประจำปี : </font> <u> <?php  echo $fet['student_code'];  ?></u></td>
     <td><font style="background-color:#f5f5f5;">ชั้นปีที่ : </font>  <u> <?php echo $fet['f_syear']; ?> </u></td>
   </tr>
   <tr>
     <td><font style="background-color:#f5f5f5;">Name : </font> <u><?php echo $fet['f_ename']; ?></u></td>
     <td><font style="background-color:#f5f5f5;">Surname : </font>  <u><?php echo $fet['f_elast']; ?></u></td>
     <td><font style="background-color:#f5f5f5;">สาขาวิชา : </font> <u> <?php  echo $fet['course_name'];  ?></u></td>
     <td><font style="background-color:#f5f5f5;">สำนักวิชา : </font>  <u> <?php echo $fet['f_officeob']; ?> </u></td>
   </tr>
   <tr>
     <td><font style="background-color:#f5f5f5;">เกรดเฉลี่ย : </font> <u><?php echo $fet['f_grade']; ?></u></td>
     <td><font style="background-color:#f5f5f5;">เกรดเฉลี่ยสะสม : </font>  <u><?php echo $fet['f_gradesum']; ?></u></td>
   </tr>

 </table>

 <table>
   <tr>
     <td><font style="background-color:#f5f5f5;">เพศ : </font> <u><?php if($fet['f_sex'] == '1'){ echo "ชาย"; }else if($fet['f_sex'] == '2'){ echo "หญฺิง"; } ?></u></td>
     <td><font style="background-color:#f5f5f5;">สถานที่เกิด : </font>  <u><?php echo $fet['f_pbirth']; ?></u></td>
     <td><font style="background-color:#f5f5f5;">วันเกิด : </font> <u><?php echo changeDate($fet['f_brith']); ?></u></td>
     <td><font style="background-color:#f5f5f5;">ส่วนสูง/cm : </font> <u><?php echo $fet['f_height']; ?></u></td>
     <td><font style="background-color:#f5f5f5;">น้ำหนัก/kg : </font>  <u><?php echo $fet['f_weight']; ?></u></td>
   </tr>
 </table>
 <table>
   <tr>
     <td><font style="background-color:#f5f5f5;">เลขที่บัตรประชาชน : </font> <u><?php echo $fet['f_idcards']; ?></u></td>
     <td><font style="background-color:#f5f5f5;">วันที่ออกบัตร : </font> <u><?php echo changeDate($fet['f_cards']); ?></u></td>
     <td><font style="background-color:#f5f5f5;">วันที่หมดอายุ: </font> <u><?php echo changeDate($fet['f_cardl']); ?></u></td>
   </tr>
 </table>
 <table>
   <tr>
     <td><font style="background-color:#f5f5f5;">สถานที่ออกบัตร : </font> <u><?php echo $fet['f_placecard']; ?></u></td>
     <td><font style="background-color:#f5f5f5;">ศาสนา : </font> <u><?php echo $fet['f_religion']; ?></u></td>
     <td><font style="background-color:#f5f5f5;">สัญชาติ: </font> <u><?php echo $fet['f_nation']; ?></u></td>
   </tr>
 </table>
 <table>
   <tr>
     <td><font style="background-color:#f5f5f5;">ใบอนุญญาติขับขี่รถยนตร์เลขที่ : </font> <u><?php echo $fet['f_licencar']; ?></u></td>
     <td><font style="background-color:#f5f5f5;">วันหมดอายุ : </font> <u><?php echo changeDate($fet['f_licencarl']); ?></u></td>
   </tr>
 </table>
  <table>
    <tr>
      <td><font style="background-color:#f5f5f5;">การเกณฑ์ทหาร (สำหรับผู้ชายในการให้ข้อมูล)</font> <u><?php
      if($fet['f_draft'] == "1"){ echo "ผ่านการเกณฑ์แล้ว"; }
      else if($fet['f_draft'] == "2"){ echo "ยังไม่ได้เกณฑ์/อยู่ในระหว่างผ่อนผัน"; }
      else if($fet['f_draft'] == "3"){ echo "ได้รับการยกเว้น"; }
       ?></u></td>
    </tr>
  </table>
ข้อมูลเกี่ยวกับครอบครัว Family Date:
<table>
  <tr>
    <td><font style="background-color:#f5f5f5;">ชื่อบิดา</font> <u><?php echo $fet['f_namef']; ?></u></td>
    <td>

      <?php if( $fet['f_flife'] == '1'){  ?>
      <img src="chk_y.jpg" alt="">มีชึวิต
    <?   }else{ ?>
    <img src="chk_n.jpg" alt="">มีชึวิต
    <?php  } ?>
    <?php if($fet['f_flife'] == '2'){  ?>
    <img src="chk_y.jpg" alt=""> ถึงแก่กรรม
    <?   }else{ ?>
      <img src="chk_n.jpg" alt="">ถึงแก่กรรม
    <?php  } ?>
    </td>
  </tr>
  <td><font style="background-color:#f5f5f5;">อาชีพ</font> <u><?php echo $fet['f_fcarreer']; ?></u></td>
</table>
<table>
  <tr>
    <td><font style="background-color:#f5f5f5;">สถานที่ทำงาน : </font> <u><?php echo $fet['f_fwork']; ?></u></td>
    <td><font style="background-color:#f5f5f5;">โทรศัพท์ : </font> <u><?php echo changeDate($fet['f_fphone']); ?></u></td>
  </tr>
</table>
<table>
  <tr>
    <td><font style="background-color:#f5f5f5;">ชื่อมารดา</font> <u><?php echo $fet['f_namem']; ?></u></td>
    <td>
      <?php if($fet['f_flifem'] == '1'){ ?>
      <img src="chk_y.jpg" alt="">มีชึวิต
    <?   }else{   ?>
    <img src="chk_n.jpg" alt="">มีชึวิต
    <?php  } ?>
    <?php if($fet['f_flifem'] == '2'){  ?>
    <img src="chk_y.jpg" alt=""> ถึงแก่กรรม
    <?   }else{ ?>
      <img src="chk_n.jpg" alt="">ถึงแก่กรรม
    <?php  } ?>
    </td>
  </tr>
  <td><font style="background-color:#f5f5f5;">อาชีพ</font> <u><?php echo $fet['f_mcarreer']; ?></u></td>
</table>
<table>
  <tr>
    <td><font style="background-color:#f5f5f5;">สถานที่ทำงาน : </font> <u><?php echo $fet['f_mwork']; ?></u></td>
    <td><font style="background-color:#f5f5f5;">โทรศัพท์ : </font> <u><?php echo changeDate($fet['r_mphone']); ?></u></td>
  </tr>
</table>
<table>
  <tr>
    <td><font style="background-color:#f5f5f5;">ที่อยู่บิดา/มารดา : </font> <u><?php echo $fet['f_addreefm']; ?></u></td>
  </tr>
</table>
เป็นบุตร/ธิดาคนที่ <?php echo $fet['f_numcril']; ?> ของครอบครัว จำนวนพี่น้อง <?php echo $fet['f_numsum']; ?> คน ประกอบด้วย
<table>
  <tr style="text-align:center">
    <td style="background-color:#f5f5f5;text-align:center;">ชื่อ-นามสกุล</td>
    <td style="background-color:#f5f5f5;text-align:center;">อายุ</td>
    <td style="background-color:#f5f5f5;text-align:center;" width="250px;">ที่ทำงาน/ที่อยู่</td>
    <td style="background-color:#f5f5f5;text-align:center;">เบอร์โทรศัพ์</td>
  </tr>
  <tr style="text-align:center">
    <td style="display:block; border:#000 solid 1px;" width="150px"><?php echo $fet['f_namec1']; ?></td>
    <td style="display:block; border:#000 solid 1px;" width="150px"><?php echo $fet['f_oldc1']; ?></td>
    <td style="display:block; border:#000 solid 1px;" width="150px"><?php echo $fet['f_officeaddress1']; ?></td>
    <td style="display:block; border:#000 solid 1px;" width="150px"><?php echo $fet['f_phone1']; ?> </td>
  </tr>
  <tr style="text-align:center">
    <td style="display:block; border:#000 solid 1px;" width="150px"><?php echo $fet['f_namec2']; ?> </td>
    <td style="display:block; border:#000 solid 1px;" width="150px"><?php echo $fet['f_oldc2']; ?></td>
    <td style="display:block; border:#000 solid 1px;" width="150px"><?php echo $fet['f_officeaddress2']; ?></td>
    <td style="display:block; border:#000 solid 1px;" width="150px"><?php echo $fet['f_phone2']; ?> </td>
  </tr>
  <tr style="text-align:center">
    <td style="display:block; border:#000 solid 1px;" width="150px"><?php echo $fet['f_namec3']; ?> </td>
    <td style="display:block; border:#000 solid 1px;" width="150px"><?php echo $fet['f_oldc3']; ?></td>
    <td style="display:block; border:#000 solid 1px;" width="150px"><?php echo $fet['f_officeaddress3']; ?></td>
    <td style="display:block; border:#000 solid 1px;" width="150px"><?php echo $fet['f_phone3']; ?> </td>
  </tr>
  <tr style="text-align:center">
    <td style="display:block; border:#000 solid 1px;" width="150px"><?php echo $fet['f_namec4']; ?> </td>
    <td style="display:block; border:#000 solid 1px;" width="150px"><?php echo $fet['f_oldc4']; ?> </td>
    <td style="display:block; border:#000 solid 1px;" width="150px"><?php echo $fet['f_officeaddress4']; ?></td>
    <td style="display:block; border:#000 solid 1px;" width="150px"><?php echo $fet['f_phone4']; ?> </td>
  </tr>
  <tr style="text-align:center">
    <td style="display:block; border:#000 solid 1px;" width="150px"><?php echo $fet['f_namec5']; ?> </td>
    <td style="display:block; border:#000 solid 1px;" width="150px"><?php echo $fet['f_oldc5']; ?> </td>
    <td style="display:block; border:#000 solid 1px;" width="150px"><?php echo $fet['f_officeaddress5']; ?></td>
    <td style="display:block; border:#000 solid 1px;" width="150px"><?php echo $fet['f_phone5']; ?> </td>
  </tr>
</table>
ที่อยู่อาศัย Address:
<table>
  <tr>
    <td><font style="background-color:#f5f5f5;">ที่อยู่อาศัยที่ติดต่อได้ : </font> <u><?php echo $fet['f_address']; ?></u></td>
    <td><font style="background-color:#f5f5f5;">โทรศัพท์/โทรสาร : </font>  <u><?php echo $fet['f_phone']; ?></u></td>
    <td><font style="background-color:#f5f5f5;">โทรศัพท์มือถือ : </font> <u><?php echo $fet['f_phonemobie']; ?></u></td>
  </tr>
</table>
<table>
  <tr>
  <td><font style="background-color:#f5f5f5;">ที่อยู่ตามทะเบียนบ้าน : </font> <u><?php echo $fet['f_nameaddress']; ?></u></td>
  <td><font style="background-color:#f5f5f5;">โทรศัพท์ : </font> <u><?php echo $fet['f_homephone']; ?></u></td>

</tr>
</table>
บุคคลที่ติดต่อได้เวลาฉุกเฉิน In Case of Emergency Please Contact:
<table>
  <tr>
    <td><font style="background-color:#f5f5f5;">ชื่อ - นามสกุล : </font> <u><?php echo $fet['f_emername']; ?></u></td>
    <td><font style="background-color:#f5f5f5;">ความสัมพันธ์กับผู้สมัคร : </font>  <u><?php echo $fet['f_emerrela']; ?></u></td>
  </tr>
</table>
<table>
  <tr>
    <td><font style="background-color:#f5f5f5;">ที่ทำงาน/ที่อยู่ : </font> <u><?php echo $fet['f_emeroffice']; ?></u></td>
    <td><font style="background-color:#f5f5f5;">โทรศัพท์/โทรสาร  : </font>  <u><?php echo $fet['f_emerphone']; ?></u></td>
    <td><font style="background-color:#f5f5f5;">E-mail Address  : </font>  <u><?php echo $fet['f_emeremail']; ?></u></td>
  </tr>
</table>
<br><br>
<font style="font-size:10px">เอกสารประกอบการสมัครเพื่อปฏิบัติงานสหกิจศึกษา ศูนย์สหกิจศึประวัติการศึกษาและพัฒนาอาชีพ มหาวิทยาลัยราชภัฎกาญจนบุรี</font>
</div>
</div>

<div  style="display:block; border:#000 solid 1px;margin-top:130px;" >
<div style="margin-left:10px;margin-right:10px;margin-top:10px;">
<div >ประวัติการศึประวัติการศึกษาและการฝึกอบรม Educational and Training Backgrounds:</div>
<table>
  <tr style="text-align:center;">
    <td style="background-color:#f5f5f5;" width="100%">การศึกษา</td>
    <td style="background-color:#f5f5f5;" width="100%">ชื่อสถานศึกษา</td>
    <td style="background-color:#f5f5f5;" width="100%">สาขาวิชา</td>
    <td style="background-color:#f5f5f5;" width="100%">วุฒิที่ได้รับ</td>
    <td style="background-color:#f5f5f5;" width="100%">ช่วงเวลาที่ศึกษา</td>
    <td style="background-color:#f5f5f5;"width="100%">เกรดเฉลี่ย</td>
  </tr>
  <tr style="text-align:center;">
    <td style="background-color:#f5f5f5;" width="100%">ประถมศึกษา</td>
    <td style="display:block; border:#000 solid 1px;" width="100%"><u><?php echo $fet['f_schoolpriname']; ?></u></td>
    <td style="display:block; border:#000 solid 1px;" width="100%">-</td>
    <td style="display:block; border:#000 solid 1px;" width="100%"><u><?php echo $fet['f_schoolpriquq']; ?></u></td>
    <td style="display:block; border:#000 solid 1px;" width="100%"><u><?php echo $fet['f_schoolpritime']; ?></u></td>
    <td style="display:block; border:#000 solid 1px;" width="100%"><u><?php echo $fet['f_schoolprigrade']; ?></u></td>
  </tr>
  <tr style="text-align:center;">
    <td style="background-color:#f5f5f5;">มัธยมศึกษา</td>
    <td style="display:block; border:#000 solid 1px;"><u><?php echo $fet['f_schoolhightname']; ?></u></td>
    <td style="display:block; border:#000 solid 1px;">-</td>
    <td style="display:block; border:#000 solid 1px;"><u><?php echo $fet['f_schoolhightquq']; ?></u></td>
    <td style="display:block; border:#000 solid 1px;"><u><?php echo $fet['f_schoolhighttime']; ?></u></td>
    <td style="display:block; border:#000 solid 1px;"><u><?php echo $fet['f_schoolhightgrade']; ?></u></td>
  </tr>
  <tr style="text-align:center;">
    <td style="background-color:#f5f5f5;display:block; border:#000 solid 1px;">ปริญญาตรี</td>
    <td style="display:block; border:#000 solid 1px;">หาวิทยาลัยราชภัฎกาญจนบุรี</td>
    <td style="display:block; border:#000 solid 1px;"><u><?php echo $fet['f_schoolbrandbach']; ?></u></td>
    <td style="display:block; border:#000 solid 1px;">กำลังศึกษา</td>
    <td style="display:block; border:#000 solid 1px;"><u><?php echo $fet['f_schoolbachtime']; ?></u></td>
    <td style="display:block; border:#000 solid 1px;"><u><?php echo $fet['f_schoolbachgrade']; ?></u></td>
  </tr>
</table>
<table>
  <tr>
    <td style="background-color:#f5f5f5; display:block; border:#000 solid 1px;"  width="100%"><font >การฝึกอบรม</font></td>
    <td style="background-color:#f5f5f5; display:block; border:#000 solid 1px;"  width="100%"><font >หัวข้อการฝึกอบรม</font></td>
    <td style="background-color:#f5f5f5; display:block; border:#000 solid 1px;"  width="100%"><font >หน่วยงานที่ให้การฝึกอบรม</font></td>
    <td style="background-color:#f5f5f5; display:block; border:#000 solid 1px;"  width="80%"><font >ช่วงเวลาที่ฝึกอบรม (เดือน / พ.ศ.)</font></td>
  </tr>
  <tr>
    <td style="display:block; border:#000 solid 1px;"><u><?php echo $fet['f_train1']; ?></u></td>
    <td style="display:block; border:#000 solid 1px;"><u><?php echo $fet['f_topictrain1']; ?></u></td>
    <td style="display:block; border:#000 solid 1px;"><u><?php echo $fet['f_departtrain1']; ?></u></td>
    <td style="display:block; border:#000 solid 1px;"><u><?php echo $fet['f_traintime1']; ?></u></td>
  </tr>
  <tr>
    <td style="display:block; border:#000 solid 1px;"><u><?php echo $fet['f_train2']; ?></u></td>
    <td style="display:block; border:#000 solid 1px;"><u><?php echo $fet['f_topictrain2']; ?></u></td>
    <td style="display:block; border:#000 solid 1px;"><u><?php echo $fet['f_departtrain2']; ?></u></td>
    <td style="display:block; border:#000 solid 1px;"><u><?php echo $fet['f_traintime2']; ?></u></td>
  </tr>
  <tr>
    <td style="display:block; border:#000 solid 1px;"><u><?php echo $fet['f_train3']; ?></u></td>
    <td style="display:block; border:#000 solid 1px;"><u><?php echo $fet['f_topictrain3']; ?></u></td>
    <td style="display:block; border:#000 solid 1px;"><u><?php echo $fet['f_departtrain3']; ?></u></td>
    <td style="display:block; border:#000 solid 1px;"><u><?php echo $fet['f_traintime3']; ?></u></td>
  </tr>
  <tr>
    <td style="display:block; border:#000 solid 1px;"><u><?php echo $fet['f_train4']; ?></u></td>
    <td style="display:block; border:#000 solid 1px;"><u><?php echo $fet['f_topictrain4']; ?></u></td>
    <td style="display:block; border:#000 solid 1px;"><u><?php echo $fet['f_departtrain4']; ?></u></td>
    <td style="display:block; border:#000 solid 1px;"><u><?php echo $fet['f_traintime4']; ?></u></td>
  </tr>
  <tr>
    <td style="display:block; border:#000 solid 1px;"><u><?php echo $fet['f_train5']; ?></u></td>
    <td style="display:block; border:#000 solid 1px;"><u><?php echo $fet['f_topictrain5']; ?></u></td>
    <td style="display:block; border:#000 solid 1px;"><u><?php echo $fet['f_departtrain5']; ?></u></td>
    <td style="display:block; border:#000 solid 1px;"><u><?php echo $fet['f_traintime5']; ?></u></td>
  </tr>
</table>
ความสามารถพิเศษ Skills:
<table>
  <tr>
    <td  style="background-color:#f5f5f5;display:block; border:#000 solid 1px;"><font style="background-color:#f5f5f5;">คอมพิวเตอร์</font></td>
    <td  style="display:block; border:#000 solid 1px;" width="100%">Excellent</td>
    <td  style="display:block; border:#000 solid 1px;"  width="100%">Good</td>
    <td  style="display:block; border:#000 solid 1px;"  width="100%">Fair</td>
    <td  style="display:block; border:#000 solid 1px;"  width="100%">Poor</td>
    <td  style=";display:block; border:#000 solid 1px;"  width="100%"><font style="background-color:#f5f5f5;">ภาษาต่างประเทศ์</font></td>
    <td  style="display:block; border:#000 solid 1px;"  width="100%">Excellent</td>
    <td  style="display:block; border:#000 solid 1px;"  width="100%">Good</td>
    <td  style="display:block; border:#000 solid 1px;"  width="100%">Fair</td>
    <td  style="display:block; border:#000 solid 1px;"  width="100%">Poor</td>
  </tr>
  <tr  style="border:#000 solid 1px;">
    <td  style="border:#000 solid 1px;">World</td>
    <td  style="display:block; border:#000 solid 1px;">
      <?php if($fet['f_skillwords'] == '1'){  ?>
      <img src="chk_n.jpg" alt="">
    <?   }else{ ?>
      <img src="chk_y.jpg" alt="">
    <?php  } ?>
    </td>
    <td  style="display:block; border:#000 solid 1px;">
      <?php if($fet['f_skillwords'] == '2'){  ?>
      <img src="chk_n.jpg" alt="">
    <?   }else{ ?>
      <img src="chk_y.jpg" alt="">
    <?php  } ?>
    </td>
    <td   style="display:block; border:#000 solid 1px;">
      <?php if($fet['f_skillwords'] == '3'){  ?>
      <img src="chk_n.jpg" alt="">
    <?   }else{ ?>
      <img src="chk_y.jpg" alt="">
    <?php  } ?>
    </td>
    <td  style="display:block; border:#000 solid 1px;">
      <?php if($fet['f_skillwords'] == '4'){  ?>
      <img src="chk_n.jpg" alt="">
    <?   }else{ ?>
      <img src="chk_y.jpg" alt="">
    <?php  } ?>
    </td>
    <td  style=" border:#000 solid 1px;">English</td>
    <td  style="display:block; border:#000 solid 1px;">
      <?php if($fet['f_skilleng'] == '1'){  ?>
      <img src="chk_n.jpg" alt="">
    <?   }else{ ?>
      <img src="chk_y.jpg" alt="">
    <?php  } ?>
    </td>
    <td  style="display:block; border:#000 solid 1px;">
      <?php if($fet['f_skilleng'] == '2'){  ?>
      <img src="chk_n.jpg" alt="">
    <?   }else{ ?>
      <img src="chk_y.jpg" alt="">
    <?php  } ?>
    </td>
    <td   style="display:block; border:#000 solid 1px;">
      <?php if($fet['f_skilleng'] == '3'){  ?>
      <img src="chk_n.jpg" alt="">
    <?   }else{ ?>
      <img src="chk_y.jpg" alt="">
    <?php  } ?>
    </td>
    <td  style="display:block; border:#000 solid 1px;">
      <?php if($fet['f_skilleng'] == '4'){  ?>
      <img src="chk_n.jpg" alt="">
    <?   }else{ ?>
      <img src="chk_y.jpg" alt="">
    <?php  } ?>
    </td>
  </tr>
  <tr >
    <td  style=" border:#000 solid 1px;">Excel</td>
    <td  style="display:block; border:#000 solid 1px;">
      <?php if($fet['f_skillexcell'] == '1'){  ?>
      <img src="chk_n.jpg" alt="">
    <?   }else{ ?>
      <img src="chk_y.jpg" alt="">
    <?php  } ?>
    </td>
    <td  style="display:block; border:#000 solid 1px;">
      <?php if($fet['f_skillexcell'] == '2'){  ?>
      <img src="chk_n.jpg" alt="">
    <?   }else{ ?>
      <img src="chk_y.jpg" alt="">
    <?php  } ?>
    </td>
    <td   style="display:block; border:#000 solid 1px;">
      <?php if($fet['f_skillexcell'] == '3'){  ?>
      <img src="chk_n.jpg" alt="">
    <?   }else{ ?>
      <img src="chk_y.jpg" alt="">
    <?php  } ?>
    </td>
    <td  style="display:block; border:#000 solid 1px;">
      <?php if($fet['f_skillexcell'] == '4'){  ?>
      <img src="chk_n.jpg" alt="">
    <?   }else{ ?>
      <img src="chk_y.jpg" alt="">
    <?php  } ?>
    </td>
    <td  style="border:#000 solid 1px;">Japanese</td>
    <td  style="display:block; border:#000 solid 1px;">
      <?php if($fet['f_skilljapan'] == '1'){  ?>
      <img src="chk_n.jpg" alt="">
    <?   }else{ ?>
      <img src="chk_y.jpg" alt="">
    <?php  } ?>
    </td>
    <td  style="display:block; border:#000 solid 1px;">
      <?php if($fet['f_skilljapan'] == '2'){  ?>
      <img src="chk_n.jpg" alt="">
    <?   }else{ ?>
      <img src="chk_y.jpg" alt="">
    <?php  } ?>
    </td>
    <td   style="display:block; border:#000 solid 1px;">
      <?php if($fet['f_skilljapan'] == '3'){  ?>
      <img src="chk_n.jpg" alt="">
    <?   }else{ ?>
      <img src="chk_y.jpg" alt="">
    <?php  } ?>
    </td>
    <td  style="display:block; border:#000 solid 1px;">
      <?php if($fet['f_skilljapan'] == '4'){  ?>
      <img src="chk_n.jpg" alt="">
    <?   }else{ ?>
      <img src="chk_y.jpg" alt="">
    <?php  } ?>
    </td>

  </tr>
  <tr>
      <td  style="display:block; border:#000 solid 1px;">Internet</td>
      <td  style="display:block; border:#000 solid 1px;">
        <?php if($fet['f_skillinternet'] == '1'){  ?>
        <img src="chk_n.jpg" alt="">
      <?   }else{ ?>
        <img src="chk_y.jpg" alt="">
      <?php  } ?>
      </td>
      <td  style="display:block; border:#000 solid 1px;">
        <?php if($fet['f_skillinternet'] == '2'){  ?>
        <img src="chk_n.jpg" alt="">
      <?   }else{ ?>
        <img src="chk_y.jpg" alt="">
      <?php  } ?>
      </td>
      <td   style="display:block; border:#000 solid 1px;">
        <?php if($fet['f_skillinternet'] == '3'){  ?>
        <img src="chk_n.jpg" alt="">
      <?   }else{ ?>
        <img src="chk_y.jpg" alt="">
      <?php  } ?>
      </td>
      <td  style="display:block; border:#000 solid 1px;">
        <?php if($fet['f_skillinternet'] == '4'){  ?>
        <img src="chk_n.jpg" alt="">
      <?   }else{ ?>
        <img src="chk_y.jpg" alt="">
      <?php  } ?>
      </td>

      <td  style="display:block; border:#000 solid 1px;">Chinese</td>
      <td  style="display:block; border:#000 solid 1px;">
        <?php if($fet['f_skillchine'] == '1'){  ?>
        <img src="chk_n.jpg" alt="">
      <?   }else{ ?>
        <img src="chk_y.jpg" alt="">
      <?php  } ?>
      </td>
      <td  style="display:block; border:#000 solid 1px;">
        <?php if($fet['f_skillchine'] == '2'){  ?>
        <img src="chk_n.jpg" alt="">
      <?   }else{ ?>
        <img src="chk_y.jpg" alt="">
      <?php  } ?>
      </td>
      <td   style="display:block; border:#000 solid 1px;">
        <?php if($fet['f_skillchine'] == '3'){  ?>
        <img src="chk_n.jpg" alt="">
      <?   }else{ ?>
        <img src="chk_y.jpg" alt="">
      <?php  } ?>
      </td>
      <td  style="display:block; border:#000 solid 1px;">
        <?php if($fet['f_skillchine'] == '4'){  ?>
        <img src="chk_n.jpg" alt="">
      <?   }else{ ?>
        <img src="chk_y.jpg" alt="">
      <?php  } ?>
      </td>

    </tr>
</table>
<table>
  <tr>
    <td  style="background-color:#f5f5f5;display:block; border:#000 solid 1px;"  width="100%"><font style="background-color:#f5f5f5;">กีฬา/ดนตร</font></td>
    <td  style="display:block; border:#000 solid 1px;"  width="100%">Excellent</td>
    <td  style="display:block; border:#000 solid 1px;"  width="100%">Good</td>
    <td  style="display:block; border:#000 solid 1px;"  width="100%">Fair</td>
    <td  style="display:block; border:#000 solid 1px;"  width="100%">Poor</td>
    <td  style=";display:block; border:#000 solid 1px;"  width="100%"><font style="background-color:#f5f5f5;">อื่นๆ</font></td>
    <td  style="display:block; border:#000 solid 1px;"  width="100%">Excellent</td>
    <td  style="display:block; border:#000 solid 1px;"  width="100%">Good</td>
    <td  style="display:block; border:#000 solid 1px;"  width="100%">Fair</td>
    <td  style="display:block; border:#000 solid 1px;"  width="100%">Poor</td>
  </tr>
  <tr  style="border:#000 solid 1px;">
    <td  style="border:#000 solid 1px;"><u><?php echo $fet['f_sportname1']; ?></u></td>
    <td  style="display:block; border:#000 solid 1px;">
      <?php if($fet['f_sportchk1'] == '1'){  ?>
      <img src="chk_n.jpg" alt="">
    <?   }else{ ?>
      <img src="chk_y.jpg" alt="">
    <?php  } ?>
    </td>
    <td  style="display:block; border:#000 solid 1px;">
      <?php if($fet['f_sportchk1'] == '2'){  ?>
      <img src="chk_n.jpg" alt="">
    <?   }else{ ?>
      <img src="chk_y.jpg" alt="">
    <?php  } ?>
    </td>
    <td   style="display:block; border:#000 solid 1px;">
      <?php if($fet['f_sportchk1'] == '3'){  ?>
      <img src="chk_n.jpg" alt="">
    <?   }else{ ?>
      <img src="chk_y.jpg" alt="">
    <?php  } ?>
    </td>
    <td  style="display:block; border:#000 solid 1px;">
      <?php if($fet['f_sportchk1'] == '4'){  ?>
      <img src="chk_n.jpg" alt="">
    <?   }else{ ?>
      <img src="chk_y.jpg" alt="">
    <?php  } ?>
    </td>
    <td  style=" border:#000 solid 1px;"><u><?php echo $fet['f_sportother1']; ?></u></td>
    <td  style="display:block; border:#000 solid 1px;">
      <?php if($fet['f_sportotherchk1'] == '1'){  ?>
      <img src="chk_n.jpg" alt="">
    <?   }else{ ?>
      <img src="chk_y.jpg" alt="">
    <?php  } ?>
    </td>
    <td  style="display:block; border:#000 solid 1px;">
      <?php if($fet['f_sportotherchk1'] == '2'){  ?>
      <img src="chk_n.jpg" alt="">
    <?   }else{ ?>
      <img src="chk_y.jpg" alt="">
    <?php  } ?>
    </td>
    <td   style="display:block; border:#000 solid 1px;">
      <?php if($fet['f_sportotherchk1'] == '3'){  ?>
      <img src="chk_n.jpg" alt="">
    <?   }else{ ?>
      <img src="chk_y.jpg" alt="">
    <?php  } ?>
    </td>
    <td  style="display:block; border:#000 solid 1px;">
      <?php if($fet['f_sportotherchk1'] == '4'){  ?>
      <img src="chk_n.jpg" alt="">
    <?   }else{ ?>
      <img src="chk_y.jpg" alt="">
    <?php  } ?>
    </td>
  </tr>
  <tr >
    <td  style=" border:#000 solid 1px;"><u><?php echo $fet['f_sportname2']; ?></u></td>
    <td  style="display:block; border:#000 solid 1px;">
      <?php if($fet['f_sportchk2'] == '1'){  ?>
      <img src="chk_n.jpg" alt="">
    <?   }else{ ?>
      <img src="chk_y.jpg" alt="">
    <?php  } ?>
    </td>
    <td  style="display:block; border:#000 solid 1px;">
      <?php if($fet['f_sportchk2'] == '2'){  ?>
      <img src="chk_n.jpg" alt="">
    <?   }else{ ?>
      <img src="chk_y.jpg" alt="">
    <?php  } ?>
    </td>
    <td   style="display:block; border:#000 solid 1px;">
      <?php if($fet['f_sportchk2'] == '3'){  ?>
      <img src="chk_n.jpg" alt="">
    <?   }else{ ?>
      <img src="chk_y.jpg" alt="">
    <?php  } ?>
    </td>
    <td  style="display:block; border:#000 solid 1px;">
      <?php if($fet['f_sportchk2'] == '4'){  ?>
      <img src="chk_n.jpg" alt="">
    <?   }else{ ?>
      <img src="chk_y.jpg" alt="">
    <?php  } ?>
    </td>
    <td  style="border:#000 solid 1px;"><u><?php echo $fet['f_sportother2']; ?></u></td>
    <td  style="display:block; border:#000 solid 1px;">
      <?php if($fet['f_sportotherchk2'] == '1'){  ?>
      <img src="chk_n.jpg" alt="">
    <?   }else{ ?>
      <img src="chk_y.jpg" alt="">
    <?php  } ?>
    </td>
    <td  style="display:block; border:#000 solid 1px;">
      <?php if($fet['f_sportotherchk2'] == '2'){  ?>
      <img src="chk_n.jpg" alt="">
    <?   }else{ ?>
      <img src="chk_y.jpg" alt="">
    <?php  } ?>
    </td>
    <td   style="display:block; border:#000 solid 1px;">
      <?php if($fet['f_sportotherchk2'] == '3'){  ?>
      <img src="chk_n.jpg" alt="">
    <?   }else{ ?>
      <img src="chk_y.jpg" alt="">
    <?php  } ?>
    </td>
    <td  style="display:block; border:#000 solid 1px;">
      <?php if($fet['f_sportotherchk2'] == '4'){  ?>
      <img src="chk_n.jpg" alt="">
    <?   }else{ ?>
      <img src="chk_y.jpg" alt="">
    <?php  } ?>
    </td>

  </tr>

</table>
ประสบการณ์การปฏิบัติงานและกิจกรรมนักศึกษา Work Experience & Student Activities:
<table>
  <tr>
    <td  style="background-color:#f5f5f5;display:block; border:#000 solid 1px;"  width="100%">ช่วงเวลา - ปี</td>
    <td  style="background-color:#f5f5f5;display:block; border:#000 solid 1px;"  width="100%">องค์กร/กิจกรรม</td>
    <td  style="background-color:#f5f5f5;display:block; border:#000 solid 1px;"  width="100%">ความรับผิดชอบ</td>
    <td  style="background-color:#f5f5f5;display:block; border:#000 solid 1px;"  width="100%">หมายเหตุ</td>
  </tr>
  <tr>
    <td style="display:block; border:#000 solid 1px;"><u><?php echo $fet['f_worktime1']; ?></u></td>
    <td style="display:block; border:#000 solid 1px;"><u><?php echo $fet['f_workaction1']; ?></u></td>
    <td style="display:block; border:#000 solid 1px;"><u><?php echo $fet['f_workres1']; ?></u></td>
    <td style="display:block; border:#000 solid 1px;"><u><?php echo $fet['f_worknote1']; ?></u></td>
  </tr>
  <tr>
    <td style="display:block; border:#000 solid 1px;"><u><?php echo $fet['f_worktime2']; ?></u></td>
    <td style="display:block; border:#000 solid 1px;"><u><?php echo $fet['f_workaction2']; ?></u></td>
    <td style="display:block; border:#000 solid 1px;"><u><?php echo $fet['f_workres2']; ?></u></td>
    <td style="display:block; border:#000 solid 1px;"><u><?php echo $fet['f_worknote2']; ?></u></td>
  </tr>
  <tr>
    <td style="display:block; border:#000 solid 1px;"><u><?php echo $fet['f_worktime3']; ?></u></td>
    <td style="display:block; border:#000 solid 1px;"><u><?php echo $fet['f_workaction3']; ?></u></td>
    <td style="display:block; border:#000 solid 1px;"><u><?php echo $fet['f_workres3']; ?></u></td>
    <td style="display:block; border:#000 solid 1px;"><u><?php echo $fet['f_worknote3']; ?></u></td>
  </tr>
  <tr>
    <td style="display:block; border:#000 solid 1px;"><u><?php echo $fet['f_worktime4']; ?></u></td>
    <td style="display:block; border:#000 solid 1px;"><u><?php echo $fet['f_workaction4']; ?></u></td>
    <td style="display:block; border:#000 solid 1px;"><u><?php echo $fet['f_workres4']; ?></u></td>
    <td style="display:block; border:#000 solid 1px;"><u><?php echo $fet['f_worknote4']; ?></u></td>
  </tr>
  <tr>
    <td style="display:block; border:#000 solid 1px;"><u><?php echo $fet['f_worktime5']; ?></u></td>
    <td style="display:block; border:#000 solid 1px;"><u><?php echo $fet['f_workaction5']; ?></u></td>
    <td style="display:block; border:#000 solid 1px;"><u><?php echo $fet['f_workres5']; ?></u></td>
    <td style="display:block; border:#000 solid 1px;"><u><?php echo $fet['f_worknote5']; ?></u></td>
  </tr>
</table>
รางวัลที่ได้รับ Awards:
<table>
  <tr>
    <td  style="background-color:#f5f5f5;display:block; border:#000 solid 1px;"  width="100%">ชื่อรางวัล</td>
    <td  style="background-color:#f5f5f5;display:block; border:#000 solid 1px;"  width="100%">หน่วยงานที่มอบให้</td>
    <td  style="background-color:#f5f5f5;display:block; border:#000 solid 1px;"  width="100%">วันเดือนปีที่รับ</td>
  </tr>
  <tr>
    <td style="display:block; border:#000 solid 1px;"><u><?php echo $fet['f_awardname1']; ?></u></td>
    <td style="display:block; border:#000 solid 1px;"><u><?php echo $fet['f_awarddepart1']; ?></u></td>
    <td style="display:block; border:#000 solid 1px;"><u><?php echo changeDate($fet['f_awardtime1']); ?></u></td>
  </tr>
<tr>
  <td style="display:block; border:#000 solid 1px;"><u><?php echo $fet['f_awardname2']; ?></u></td>
  <td style="display:block; border:#000 solid 1px;"><u><?php echo $fet['f_awarddepart2']; ?></u></td>
  <td style="display:block; border:#000 solid 1px;"><u><?php echo changeDate($fet['f_awardtime2']); ?></u></td>
</tr>
<tr>
  <td style="display:block; border:#000 solid 1px;"><u><?php echo $fet['f_awardname3']; ?></u></td>
  <td style="display:block; border:#000 solid 1px;"><u><?php echo $fet['f_awarddepart3']; ?></u></td>
  <td style="display:block; border:#000 solid 1px;"><u><?php echo changeDate($fet['f_awardtime3']); ?></u></td>
</tr>
</table>

<div class="" style="margin-top:30px;margin-left:300px;">
  <div >
    ลงนามผู้สมัคร .............................<br>
            <div style="margin-left:80px;">  (.............................) </div>
            <div  style="margin-left:80px;">  วันที่ _/__/__ </div>

  </div>
</div>
  <div class="" style="margin-top:30;">ร่วมสร้างคุณภาพบัณฑิต ร่วมเสริมคุณค่าชีวิต ด้วยประสบการณ์ทำงาน</div>
</div></div>
<?php }
$html = ob_get_contents();        //เก็บค่า html ไว้ใน $html
ob_end_clean();
$pdf = new mPDF('th', 'A4', '0', '');   //การตั้งค่ากระดาษถ้าต้องการแนวตั้ง ก็ A4 เฉยๆครับ ถ้าต้องการแนวนอนเท่ากับ A4-L
$pdf->SetAutoFont();
$pdf->SetDisplayMode('fullpage');
$pdf->WriteHTML($html, 2);
$pdf->Output(iconv('UTF-8', 'TIS-620','mpdf/ทดสอบการ.pdf'));         // เก็บไฟล์ html ที่แปลงแล้วไว้ใน MyPDF/MyPDF.pdf ถ้าต้องการให้แสด
header("location:mpdf/ทดสอบการ.pdf");
?>
<!--ดาวโหลดรายงานในรูปแบบ PDF <a href="mpdf/ทดสอบการ.pdf" >คลิกที่นี้</a> -->
