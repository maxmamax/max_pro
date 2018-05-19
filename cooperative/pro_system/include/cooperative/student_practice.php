<?php include("include/connect.php"); session_start(); ?>
<?php
     function thaidate($tDate) //แปลงวันที่เป็นวันที่ไทย
	{
		$y = substr($tDate, 0, 4) + 543;
		$m = substr($tDate, 5, 2);
		$d = substr($tDate, 8, 9);
		if ($tDate == "")
		{
			return "";
		} else
		{
			return $d . "/" . $m . "/" . $y;
		}
	}
  function changeDate($date){
  $get_date = explode("-",$date);
  $month = array("01"=>"ม.ค.","02"=>"ก.พ","03"=>"มี.ค.","04"=>"เม.ย.","05"=>"พ.ค.","06"=>"มิ.ย.","07"=>"ก.ค.","08"=>"ส.ค.","09"=>"ก.ย.","10"=>"ต.ค.","11"=>"พ.ย.","12"=>"ธ.ค.");
  $get_month = $get_date["1"];
  $year = $get_date["0"]+543;
  return $get_date["2"]." ".$month[$get_month]." ".$year;
  }
?>
<?php if($_SESSION['session_status_menu'] == 'cooperative' && $_GET['position'] == '' ){ ?>

<div class="panel panel-default">
  <div class="panel-heading"><h1><span class="glyphicon glyphicon-list" aria-hidden="true"></span> ข้อมูลการจองนักศึกษาฝึกปฏิบัติงาน</h1></div>
  <div class="panel-body">
<?php if($_SESSION['session_status_menu'] == 'cooperative' && $_GET['key'] == ""){ ?>
  <div class="table-responsive">

  <table class="table table-bordered">
  <thead>
  <tr class="f2">
    <td>ลำดับ</td>
    <td >รูปภาพ</td>
    <td >ชื่อ</td>
    <td>รหัสนักศึกษา</td>
    <td>เกรดเฉลี่ย</td>
    <td>รายละเอียด</td>
    <td>ข้อมูล</td>
  </tr>
</thead>
<?php
$sql = "SELECT * FROM  tb_reply_s a , tb_regiter_s b , tb_student c WHERE a.coop_keyf = '".$_SESSION['session_key']."' AND a.student_keyf = b.student_keyf AND b.student_keyf = c.student_key " ;
$sql_qu = mysql_query($sql);
$Num_Rows = mysql_num_rows($sql_qu);
$Per_Page = 10;
$Page = $_GET["Page_data"];
if(!$_GET["Page_data"])
{
$Page=1;
}
$Prev_Page = $Page-1;
$Next_Page = $Page+1;
$Page_Start = (($Per_Page*$Page)-$Per_Page);
if($Num_Rows<=$Per_Page)
{
$Num_Pages =1;
}
else if(($Num_Rows % $Per_Page)==0)
{
$Num_Pages =($Num_Rows/$Per_Page) ;
}
else
{
$Num_Pages =($Num_Rows/$Per_Page)+1;
$Num_Pages = (int)$Num_Pages;
}
$sql .="  LIMIT $Page_Start , $Per_Page";
$objQuery  = mysql_query($sql);
$i = 1;
while($fet = mysql_fetch_array($objQuery)){
?>
  <tr class="f2">
    <td><?php echo  (($Page-1)*10)+$i ; ?></td>
    <td><img width="100" height="100" src="include/image_student/<?php echo $fet['student_part']; ?>"></td>
    <td><?php echo $fet['student_name']." ".$fet['student_last']; ?></td>
    <td><?php echo $fet['student_code']; ?></td>
    <td><?php echo $fet['f_grade']; ?></td>
    <td><?php echo $fet['reply_detail']; ?></td>
    <td><a href="index.php?page=student_practice&key=<?php echo $fet['student_key']; ?>"><button class="btn btn-success">ดูข้อมูล</button></a></td>
  </tr>
<?php $i++; } ?>
</table>
  </div>
  จำนวนข้อมูลทั้งหมด <?php echo $Num_Rows;?> ข้อมูล  จำนวนหน้าทั้งหมด <?php echo $Num_Pages; ?> หน้า :
<?php
if($Prev_Page)
{
echo " <a href='$_SERVER[SCRIPT_NAME]?page=student_practice&Page_data=$Prev_Page'><< ย้อนกลับ</a> ";
}
for($i=1; $i<=$Num_Pages; $i++){
if($i != $Page)
{
echo " <a href='$_SERVER[SCRIPT_NAME]?page=student_practice&Page_data=$i'><button class='btn btn-detail'>$i</button></a> ";
?>
<?php
}
else
{
echo "<b> $i </b>";
}
}
if($Page!=$Num_Pages)
{
echo " <a href ='$_SERVER[SCRIPT_NAME]?page=student_practice&Page_data=$Next_Page'>ถัดไป>></a> ";
} ?>
<?php }else if($_SESSION['session_status_menu'] == 'cooperative' &&  $_GET['key'] != ""){
$sql = mysql_query("SELECT * FROM  tb_student  a , tb_faculty b , tb_course c , tb_regiter_s d WHERE a.student_key = '".$_GET['key']."' AND d.student_keyf = '".$_GET['key']."' AND a.faculty_keyf = b.faculty_key  AND a.course_key = c.course_key ");
$fet = mysql_fetch_array($sql);
if($fet){
?>
      <div class="panel panel-default">
        <div class="panel-heading"><font class="f">ข้อมูลส่วนตัวนักศึกษา Personal Date:</font></div>
        <div class="panel-body" >
            <div class="table-responsive">
            <div class="col-md-12 col-lg-12 " align="center" style="margin-top:30px;"><img width="150" height="200" src="include/image_student/<?php echo $fet['student_part']; ?>"></div>


<table class="table table-bordered">

<tr class="f2" >
  <td><font>ชื่อ : <?php echo $fet['student_name']; ?></font></td>
  <td><font>นามสกุล : <?php echo $fet['student_last']; ?></font></td>
  <td><font>รหัสประจำตัว : <?php echo $fet['student_code']; ?></font></td>
  <td><font>ชั้นปีที่ : <?php echo $fet['f_syear']; ?></font></td>
</tr>
<tr class="f2">
  <td><font>Name : <?php echo $fet['f_ename']; ?></font></td>
  <td><font>Surname : <?php echo $fet['f_elast']; ?></font></td>
  <td><font>สาขาวิชา : <?php echo $fet['course_name']; ?></font></td>
  <td><font>เกรดเฉลี่ย : <?php echo $fet['f_grade']; ?></font></td>
</tr>
<tr class="f2">
  <td><font>เพศ : <?php if($fet['f_sex'] == '1'){ echo "ชาย"; }else if($fet['f_sex'] == '2'){ echo "หญฺิง"; } ?></font></td>
  <td><font>สถานที่เกิด : <?php echo $fet['f_pbirth']; ?></font></td>
  <td><font>วันที่เกิด : <?php
  echo  changeDate($fet['f_brith']);
  ?></font></td>
  <td><font>ส่วนสูง/cm : <?php echo $fet['f_height']; ?></font></td>
  <td><font>น้ำหนัก/kg : <?php echo $fet['f_weight']; ?></font></td>
</tr>
<tr class="f2">
  <td><font>เลขที่บัตรประชาชน : <?php echo $fet['f_idcards']; ?></font></td>
  <td><font>วันที่ออกบัตร : <?php echo changeDate($fet['f_cards']); ?></font></td>
  <td><font>วันหมดอายุ : <?php echo changeDate($fet['f_cardl']); ?></font></td>
</tr>
<tr class="f2">
  <td><font>สถานที่ออกบัตร : <?php echo $fet['f_placecard']; ?></font></td>
  <td><font>ศาสนา : <?php echo $fet['f_religion']; ?></font></td>
  <td><font>สัญชาติ : <?php echo $fet['f_nation']; ?></font></td>
</tr>
<tr class="f2">
  <td><font>ใบอนุญาติขับขี่รถยนตร์เลขที่ : <?php echo $fet['f_licencar']; ?></font></td>
  <td><font>วันหมดอายุ : <?php echo changeDate($fet['f_licencarl']); ?></font></td>
</tr>
<tr class="f2">
  <td><font>การเกณฑ์ทหาร (สำหรับผู้ชาย) :
    <?php
    if($fet['f_draft'] == "1"){ echo "ผ่านการเกณฑ์แล้ว"; }
    else if($fet['f_draft'] == "2"){ echo "ยังไม่ได้เกณฑ์/อยู่ในระหว่างผ่อนผัน"; }
    else if($fet['f_draft'] == "3"){ echo "ได้รับการยกเว้น"; }
     ?>

  </font></td>
</tr>


</table>
</div>
<hr>
        </div>
      </div>

  <div class="panel panel-default">
    <div class="panel-heading"><font class="f">ข้อมูลเกี่ยวกับครอบครัว Family Date:</font></div>
    <div class="panel-body">
      <div class="table-responsive">
      <table class="table table-bordered">
        <tr class="f2">
          <td><font>ชื่อบิดา : <?php echo $fet['f_namef']; ?></font></td>
          <td>
            <?php if($fet['f_flife'] == '1'){  ?>
            <span class="glyphicon glyphicon-check" aria-hidden="true"></span> มีชึวิต
          <?   }else{ ?>
            <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span> มีชึวิต
        <?php  } ?>
        <?php if($fet['f_flife'] == '2'){  ?>
        <span class="glyphicon glyphicon-check" aria-hidden="true"></span> ถึงแก่กรรม
      <?   }else{ ?>
        <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span> ถึงแก่กรรม
    <?php  } ?>
          </td>
          <td><font>อาชีพ : <?php echo $fet['f_fcarreer']; ?></font></td>
        </tr>
        <tr class="f2">
          <td><font>สถานที่ทำงาน : <?php echo $fet['f_fwork']; ?></font></td>
          <td><font>โทรศัพท์ : <?php echo $fet['f_fphone']; ?></font></td>
        </tr>
        <tr class="f2">
          <td><font>ชื่อมารดา : <?php echo $fet['f_namem']; ?></font></td>
          <td>
            <?php if($fet['f_flifem'] == '1'){  ?>
            <span class="glyphicon glyphicon-check" aria-hidden="true"></span> มีชึวิต
          <?   }else{ ?>
            <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span> มีชึวิต
        <?php  } ?>
        <?php if($fet['f_flifem'] == '2'){  ?>
        <span class="glyphicon glyphicon-check" aria-hidden="true"></span> ถึงแก่กรรม
      <?   }else{ ?>
        <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span> ถึงแก่กรรม
    <?php  } ?>
          </td>
          <td><font>อาชีพ : <?php echo $fet['f_mcarreer']; ?></font></td>
        </tr>
        <tr class="f2">
          <td><font>สถานที่ทำงาน : <?php echo $fet['f_mwork']; ?></font></td>
          <td><font>โทรศัพท์ : <?php echo $fet['r_mphone']; ?></font></td>
        </tr>
        <tr class="f2">
          <td><font>ที่อยู่บิดา/มารดา : <?php echo $fet['f_addreefm']; ?></font></td>
        </tr>
        <tr class="f2">
          <td><font>สถานะทางครอบครัว :
            <?php
            if($fet['f_statusfm'] == '1'){
              echo "อยู่ด้วยกัน";
            }else if($fet['f_statusfm'] == '2'){
              echo "หย่าร้าง";
            }
            ?>
          </font>
          </td>
        </tr>
        <tr class="f2">
          <td><font>เป็นบุตรธิดาคนที่ <?php echo $fet['f_numcril']; ?> จำนวนพี่น้อง <?php echo $fet['f_numsum']; ?> คน ประกอบด้วย</font></td>
        </tr>
      </table>
      <table class="table table-bordered">
        <thead>
        <tr class="f2">
          <td>ชื่อ - นามสกุล</td>
          <td width="100px">อายุ</td>
          <td>ที่ทำงาน/ที่อยู่</td>
          <td>เบอร์โทรศัพท์</td>
        </tr>
      </thead>
        <tr>
          <td><font><?php echo $fet['f_namec1'];?></font></td>
          <td><font><?php echo $fet['f_oldc1'];?></font></td>
          <td><font><?php echo $fet['f_officeadress1'];?></font></td>
          <td><font><?php echo $fet['f_phone1'];?></font></td>
        </tr>

        <tr>
          <td><font><?php echo $fet['f_namec2'];?></font></td>
          <td><font><?php echo $fet['f_oldc2'];?></font></td>
          <td><font><?php echo $fet['f_officeaddress2'];?></font></td>
          <td><font><?php echo $fet['f_phone2'];?></font></td>
        </tr>

        <tr>
          <td><font><?php echo $fet['f_namec3'];?></font></td>
          <td><font><?php echo $fet['f_oldc3'];?></font></td>
          <td><font><?php echo $fet['f_officeaddress3'];?></font></td>
          <td><font><?php echo $fet['f_phone3'];?></font></td>
        </tr>
        <tr>
          <td><font><?php echo $fet['f_namec4'];?></font></td>
          <td><font><?php echo $fet['f_oldc4'];?></font></td>
          <td><font><?php echo $fet['f_officeaddress4'];?></font></td>
          <td><font><?php echo $fet['f_phone4'];?></font></td>
        </tr>
        <tr>
          <td><font><?php echo $fet['f_namec5'];?></font></td>
          <td><font><?php echo $fet['f_oldc5'];?></font></td>
          <td><font><?php echo $fet['f_officeaddress5'];?></font></td>
          <td><font><?php echo $fet['f_phone5'];?></font></td>
        </tr>

      </table>
</div>
      <hr>
                </div>
              </div>

                    <div class="panel panel-default">
                      <div class="panel-heading"><font class="f">ที่อยู่อาศัย Address:</font></div>
                        <div class="panel-body">
                        <div class="table-responsive">
                        <table class="table table-bordered">
                          <tr class="f2">
                            <td><font>ที่อยู่ติดต่อได้ <?php echo $fet['f_address'];?></font></td>
                          </tr>
                          <tr class="f2">
                            <td><font>โทรศัพท์/โทรสาร : <?php echo $fet['f_phone'];?></font></td>
                            <td><font>โทรศัพท์มือถือ <?php echo $fet['f_phonemobie'];?></font></td>
                            <td><font>E-mail Address <?php echo $fet['student_email'];?></font></td>
                          </tr>
                          <tr class="f2">
                            <td><font>ที่อยู่ตามทะเบียนบ้าน :<?php echo $fet['f_nameaddress'];?></font></td>
                            <td><font>โทรศัพท์ <?php echo $fet['f_homephone'];?></font></td>
                          </tr>
                        </table>
<font class="f">บุคคลที่ติดต่อได้เวลาฉุกเฉิน In Case of Emergency Please Contact:</font><br><br>
                      <table class="table table-bordered">
                        <tr class="f2">
                          <td><font>ชื่อ - นามสกุล <?php echo $fet['f_emername'];?></font></td>
                          <td><font>ความสัมพันธ์ของผู้สมัคร <?php echo $fet['f_emerrela'];?></font></td>

                        </tr>
                        <tr class="f2">
                          <td><font>ที่ทำงาน/ที่อยู่ : <?php echo $fet['f_emeroffice'];?></font></td>
                        </tr>
                        <tr class="f2">
                          <td><font>โทรศัพท์/โทรสาร <?php echo $fet['f_emerphone'];?></font></td>
                          <td><font>E-mail Address <?php echo $fet['f_emeremail'];?></font></td>
                        </tr>
                      </table>

                        <hr>
                      </div>
                                  </div>
                                </div>

                       <div class="panel panel-default">
                         <div class="panel-heading"><font class="f">ประวัติการศึกษาและฝึกอบรม Educational and Training Backgrounds:</font></div>
                           <div class="panel-body">
                             <div class="table-responsive">
                             <table class="table table-bordered" style="text-align:center;">
                               <thead>
                               <tr class="f1">
                                 <td >การศึกษา</td>
                                 <td >ชื่อสถานศึกษา</td>
                                 <td >สาขาวิชา</td>
                                 <td >วุฒิที่ได้รับ</td>
                                 <td >ช่วงเวลาที่ศึกษา</td>
                                 <td >เกรดเฉลี่ย</td>
                               </tr>
                             </thead>
                               <tr class="f2">
                                 <td>มัธยมศึกษา/ปวช/ปวส</td>
                                 <td><font><?php echo $fet['f_schoolhightname'];?></font></td>
                                 <td>-</td>
                                 <td><font><?php echo $fet['f_schoolhightquq'];?></font></td>
                                 <td><font><?php echo $fet['f_schoolhighttime'];?></font></td>
                                 <td><font><?php echo $fet['f_schoolhightgrade'];?></font></td>
                               </tr>

                               <tr class="f2">
                                 <td>ปริญญาตรี</td>
                                 <td>มหาวิทยาลัยราชภัฏกาญจนบุรี</td>
                                 <td><font><?php echo $fet['course_name'];?></font></td>
                                 <td>กำลังศึกษา</td>
                                 <td><font><?php echo $fet['f_schoolbachtime'];?></font></td>
                                 <td><font><?php echo $fet['f_schoolbachgrade'];?></font></td>
                               </tr>
                             </table>

                             <table class="table table-bordered">
                               <thead>
                               <tr class="f1">
                                 <td>การฝึกอบรม</td>
                                 <td>หัวข้อฝึกอบรม</td>
                                 <td>หน่วยงานที่ให้การฝึกอบรม</td>
                                 <td>ช่วงเวลาที่ฝึกอบรม (เดือน/พ.ศ.)</td>
                               </tr>
                             </thead>
                               <tr>
                                 <td><font><?php echo $fet['f_train1'];?></font></td>
                                 <td><font><?php echo $fet['f_topictrain1'];?></font></td>
                                 <td><font><?php echo $fet['f_departtrain1'];?></font></td>
                                 <td><font><?php echo $fet['f_traintime1'];?></font></td>
                               </tr>

                               <tr>
                                 <td><font><?php echo $fet['f_train2'];?></font></td>
                                 <td><font><?php echo $fet['f_topictrain2'];?></font></td>
                                 <td><font><?php echo $fet['f_departtrain2'];?></font></td>
                                 <td><font><?php echo $fet['f_traintime2'];?></font></td>
                               </tr>

                               <tr>
                                 <td><font><?php echo $fet['f_train3'];?></font></td>
                                 <td><font><?php echo $fet['f_topictrain3'];?></font></td>
                                 <td><font><?php echo $fet['f_departtrain3'];?></font></td>
                                 <td><font><?php echo $fet['f_traintime3'];?></font></td>
                               </tr>

                               <tr>
                                 <td><font><?php echo $fet['f_train4'];?></font></td>
                                 <td><font><?php echo $fet['f_topictrain4'];?></font></td>
                                 <td><font><?php echo $fet['f_departtrain4'];?></font></td>
                                 <td><font><?php echo $fet['f_traintime4'];?></font></td>
                               </tr>

                               <tr>
                                 <td><font><?php echo $fet['f_train5'];?></font></td>
                                 <td><font><?php echo $fet['f_topictrain5'];?></font></td>
                                 <td><font><?php echo $fet['f_departtrain5'];?></font></td>
                                 <td><font><?php echo $fet['f_traintime5'];?></font></td>
                               </tr>
                             </table>
                           </div>

                <font class="f">ความสามารถพิเศษ Skills:</font>

                            <div class="form-group row">
                              <div class="table-responsive">
                              <table class="table table-bordered" style="text-align:center;">
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
                                  <td
                                    <?php if($fet['f_skillwords'] == '1'){  ?>
                                    <span class="glyphicon glyphicon-check" aria-hidden="true"></span>
                                  <?   }else{ ?>
                                    <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span>
                                <?php  } ?>
                                  </td>
                                  <td>
                                    <?php if($fet['f_skillwords'] == '2'){  ?>
                                    <span class="glyphicon glyphicon-check" aria-hidden="true"></span>
                                  <?   }else{ ?>
                                    <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span>
                                <?php  } ?>
                                  </td>
                                  <td>
                                    <?php if($fet['f_skillwords'] == '3'){  ?>
                                    <span class="glyphicon glyphicon-check" aria-hidden="true"></span>
                                  <?   }else{ ?>
                                    <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span>
                                <?php  } ?>
                                  </td>
                                  <td>
                                    <?php if($fet['f_skillwords'] == '4'){  ?>
                                    <span class="glyphicon glyphicon-check" aria-hidden="true"></span>
                                  <?   }else{ ?>
                                    <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span>
                                <?php  } ?>
                                  </td>
                                  <td>English</td>
                                  <td>
                                    <?php if($fet['f_skilleng'] == '1'){  ?>
                                    <span class="glyphicon glyphicon-check" aria-hidden="true"></span>
                                  <?   }else{ ?>
                                    <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span>
                                <?php  } ?>
                                  </td>
                                  <td>
                                    <?php if($fet['f_skilleng'] == '2'){  ?>
                                    <span class="glyphicon glyphicon-check" aria-hidden="true"></span>
                                  <?   }else{ ?>
                                    <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span>
                                  <?php  } ?>
                                  </td>
                                  <td>
                                    <?php if($fet['f_skilleng'] == '3'){  ?>
                                    <span class="glyphicon glyphicon-check" aria-hidden="true"></span>
                                  <?   }else{ ?>
                                    <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span>
                                <?php  } ?>
                                  </td>
                                  <td>
                                    <?php if($fet['f_skilleng'] == '4'){  ?>
                                    <span class="glyphicon glyphicon-check" aria-hidden="true"></span>
                                  <?   }else{ ?>
                                    <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span>
                                <?php  } ?>
                                  </td>
                                </tr>


                                <tr>
                                  <td>Excel</td>
                                  <td>
                                    <?php if($fet['f_skillexcell'] == '1'){  ?>
                                    <span class="glyphicon glyphicon-check" aria-hidden="true"></span>
                                  <?   }else{ ?>
                                    <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span>
                                <?php  } ?>
                                  </td>
                                  <td>
                                    <?php if($fet['f_skillexcell'] == '2'){  ?>
                                    <span class="glyphicon glyphicon-check" aria-hidden="true"></span>
                                  <?   }else{ ?>
                                    <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span>
                                  <?php  } ?>
                                  </td>
                                  <td>
                                    <?php if($fet['f_skillexcell'] == '3'){  ?>
                                    <span class="glyphicon glyphicon-check" aria-hidden="true"></span>
                                  <?   }else{ ?>
                                    <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span>
                                <?php  } ?>
                                  </td>
                                  <td>
                                    <?php if($fet['f_skillexcell'] == '4'){  ?>
                                    <span class="glyphicon glyphicon-check" aria-hidden="true"></span>
                                  <?   }else{ ?>
                                    <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span>
                                <?php  } ?>
                                  </td>
                                  <td>Japanese</td>
                                  <td>
                                    <?php if($fet['f_skilljapan'] == '1'){  ?>
                                    <span class="glyphicon glyphicon-check" aria-hidden="true"></span>
                                  <?   }else{ ?>
                                    <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span>
                                <?php  } ?>
                                  </td>
                                  <td>
                                    <?php if($fet['f_skilljapan'] == '2'){  ?>
                                    <span class="glyphicon glyphicon-check" aria-hidden="true"></span>
                                  <?   }else{ ?>
                                    <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span>
                                  <?php  } ?>
                                  </td>
                                  <td>
                                    <?php if($fet['f_skilljapan'] == '3'){  ?>
                                    <span class="glyphicon glyphicon-check" aria-hidden="true"></span>
                                  <?   }else{ ?>
                                    <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span>
                                <?php  } ?>
                                  </td>
                                  <td>
                                    <?php if($fet['f_skilljapan'] == '4'){  ?>
                                    <span class="glyphicon glyphicon-check" aria-hidden="true"></span>
                                  <?   }else{ ?>
                                    <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span>
                                <?php  } ?>
                                  </td>
                                </tr>


                                <tr>
                                  <td>lnternet</td>
                                  <td>
                                    <?php if($fet['f_skillinternet'] == '1'){  ?>
                                    <span class="glyphicon glyphicon-check" aria-hidden="true"></span>
                                  <?   }else{ ?>
                                    <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span>
                                <?php  } ?>
                                  </td>
                                  <td>
                                    <?php if($fet['f_skillinternet'] == '2'){  ?>
                                    <span class="glyphicon glyphicon-check" aria-hidden="true"></span>
                                  <?   }else{ ?>
                                    <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span>
                                  <?php  } ?>
                                  </td>
                                  <td>
                                    <?php if($fet['f_skillinternet'] == '3'){  ?>
                                    <span class="glyphicon glyphicon-check" aria-hidden="true"></span>
                                  <?   }else{ ?>
                                    <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span>
                                <?php  } ?>
                                  </td>
                                  <td>
                                    <?php if($fet['f_skillinternet'] == '4'){  ?>
                                    <span class="glyphicon glyphicon-check" aria-hidden="true"></span>
                                  <?   }else{ ?>
                                    <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span>
                                <?php  } ?>
                                  </td>
                                  <td>Chinese</td>
                                  <td>
                                    <?php if($fet['f_skillchine'] == '1'){  ?>
                                    <span class="glyphicon glyphicon-check" aria-hidden="true"></span>
                                  <?   }else{ ?>
                                    <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span>
                                <?php  } ?>
                                  </td>
                                  <td>
                                    <?php if($fet['f_skillchine'] == '2'){  ?>
                                    <span class="glyphicon glyphicon-check" aria-hidden="true"></span>
                                  <?   }else{ ?>
                                    <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span>
                                  <?php  } ?>
                                  </td>
                                  <td>
                                    <?php if($fet['f_skillchine'] == '3'){  ?>
                                    <span class="glyphicon glyphicon-check" aria-hidden="true"></span>
                                  <?   }else{ ?>
                                    <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span>
                                <?php  } ?>
                                  </td>
                                  <td>
                                    <?php if($fet['f_skillchine'] == '4'){  ?>
                                    <span class="glyphicon glyphicon-check" aria-hidden="true"></span>
                                  <?   }else{ ?>
                                    <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span>
                                <?php  } ?>
                                  </td>
                                </tr>


                              </table>
                              <table class="table table-bordered" style="text-align:center;">
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
                                  <td><font><?php echo $fet['f_sportname1'];?></font></td>
                                  <td>
                                    <?php if($fet['f_sportchk1'] == '1'){  ?>
                                    <span class="glyphicon glyphicon-check" aria-hidden="true"></span>
                                  <?   }else{ ?>
                                    <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span>
                                <?php  } ?>
                                  </td>
                                  <td>
                                    <?php if($fet['f_sportchk1'] == '2'){  ?>
                                    <span class="glyphicon glyphicon-check" aria-hidden="true"></span>
                                  <?   }else{ ?>
                                    <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span>
                                <?php  } ?>
                                  </td>
                                  <td>
                                    <?php if($fet['f_sportchk1'] == '3'){  ?>
                                    <span class="glyphicon glyphicon-check" aria-hidden="true"></span>
                                  <?   }else{ ?>
                                    <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span>
                                <?php  } ?>
                                  </td>
                                  <td>
                                    <?php if($fet['f_sportchk1'] == '4'){  ?>
                                    <span class="glyphicon glyphicon-check" aria-hidden="true"></span>
                                  <?   }else{ ?>
                                    <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span>
                                <?php  } ?>
                                  </td>
                                  <td><font><?php echo $fet['f_sportother1'];?></font></td>
                                  <td>
                                    <?php if($fet['f_sportotherchk1'] == '1'){  ?>
                                    <span class="glyphicon glyphicon-check" aria-hidden="true"></span>
                                  <?   }else{ ?>
                                    <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span>
                                  <?php  } ?>
                                  </td>
                                  <td>
                                    <?php if($fet['f_sportotherchk1'] == '2'){  ?>
                                    <span class="glyphicon glyphicon-check" aria-hidden="true"></span>
                                  <?   }else{ ?>
                                    <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span>
                                <?php  } ?>
                                  </td>
                                  <td>
                                    <?php if($fet['f_sportotherchk1'] == '3'){  ?>
                                    <span class="glyphicon glyphicon-check" aria-hidden="true"></span>
                                  <?   }else{ ?>
                                    <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span>
                                  <?php  } ?>
                                  </td>
                                  <td>
                                    <?php if($fet['f_sportotherchk1'] == '4'){  ?>
                                    <span class="glyphicon glyphicon-check" aria-hidden="true"></span>
                                  <?   }else{ ?>
                                    <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span>
                                  <?php  } ?>
                                  </td>
                                </tr>


                                <tr>
                                  <td><font><?php echo $fet['f_sportname2'];?></td>
                                  <td>
                                    <?php if($fet['f_sportchk2'] == '1'){  ?>
                                    <span class="glyphicon glyphicon-check" aria-hidden="true"></span>
                                  <?   }else{ ?>
                                    <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span>
                                <?php  } ?>
                                  </td>
                                  <td>
                                    <?php if($fet['f_sportchk2'] == '2'){  ?>
                                    <span class="glyphicon glyphicon-check" aria-hidden="true"></span>
                                  <?   }else{ ?>
                                    <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span>
                                <?php  } ?>
                                  </td>
                                  <td>
                                    <?php if($fet['f_sportchk2'] == '3'){  ?>
                                    <span class="glyphicon glyphicon-check" aria-hidden="true"></span>
                                  <?   }else{ ?>
                                    <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span>
                                <?php  } ?>
                                  </td>
                                  <td>
                                    <?php if($fet['f_sportchk2'] == '4'){  ?>
                                    <span class="glyphicon glyphicon-check" aria-hidden="true"></span>
                                  <?   }else{ ?>
                                    <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span>
                                <?php  } ?>
                                  </td>
                                  <td><font><?php echo $fet['f_sportother2'];?></td>
                                  <td>
                                    <?php if($fet['f_sportotherchk2'] == '1'){  ?>
                                    <span class="glyphicon glyphicon-check" aria-hidden="true"></span>
                                  <?   }else{ ?>
                                    <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span>
                                  <?php  } ?>
                                  </td>
                                  <td>
                                    <?php if($fet['f_sportotherchk2'] == '2'){  ?>
                                    <span class="glyphicon glyphicon-check" aria-hidden="true"></span>
                                  <?   }else{ ?>
                                    <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span>
                                  <?php  } ?>
                                  </td>
                                  <td>
                                    <?php if($fet['f_sportotherchk2'] == '3'){  ?>
                                    <span class="glyphicon glyphicon-check" aria-hidden="true"></span>
                                  <?   }else{ ?>
                                    <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span>
                                  <?php  } ?>
                                  </td>
                                  <td>
                                    <?php if($fet['f_sportotherchk2'] == '4'){  ?>
                                    <span class="glyphicon glyphicon-check" aria-hidden="true"></span>
                                  <?   }else{ ?>
                                    <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span>
                                  <?php  } ?>
                                  </td>
                                </tr>
                              </table>
                            </div>
                              </div>
                        <font class="f">ประสบการณ์การปฏิบัติงานและกิจกรรมนักศึกษา Work Experience & Student Activities:</font>
                        <br><br>
                        <div class="form-group row">
                        <div class="table-responsive">
                        <table class="table table-bordered">
                          <thead>
                          <tr class="f1">
                            <td >ช่วงเวลา - ปี</td>
                            <td >องค์กร/กิจกรรม</td>
                            <td >ความรับผิดชอบ</td>
                            <td >หมายเหตุ</td>
                          </tr>
                        </thead>
                          <tr class="f2">
                            <td><font><?php echo $fet['f_worktime1'];?></font></td>
                            <td><font><?php echo $fet['f_workaction1'];?></font></td>
                            <td><font><?php echo $fet['f_workres1'];?></font></td>
                            <td><font><?php echo $fet['f_worknote1'];?></font></td>
                          </tr>

                          <tr class="f2">
                            <td><font><?php echo $fet['f_worktime2'];?></font></td>
                            <td><font><?php echo $fet['f_workaction2'];?></font></td>
                            <td><font><?php echo $fet['f_workres2'];?></font></td>
                            <td><font><?php echo $fet['f_worknote2'];?></font></td>
                          </tr>

                          <tr class="f2">
                            <td><font><?php echo $fet['f_worktime3'];?></font></td>
                            <td><font><?php echo $fet['f_workaction3'];?></font></td>
                            <td><font><?php echo $fet['f_workres3'];?></font></td>
                            <td><font><?php echo $fet['f_worknote3'];?></font></td>
                          </tr>

                          <tr class="f2">
                            <td><font><?php echo $fet['f_worktime4'];?></font></td>
                            <td><font><?php echo $fet['f_workaction4'];?></font></td>
                            <td><font><?php echo $fet['f_workres4'];?></font></td>
                            <td><font><?php echo $fet['f_worknote4'];?></font></td>
                          </tr>

                          <tr class="f2">
                            <td><font><?php echo $fet['f_worktime5'];?></font></td>
                            <td><font><?php echo $fet['f_workaction5'];?></font></td>
                            <td><font><?php echo $fet['f_workres5'];?></font></td>
                            <td><font><?php echo $fet['f_worknote5'];?></font></td>
                          </tr>

                        </table>
                      </div>
                        </div>
<font class="f">รางวัลที่ได้รับ Awards:</font>
<div class="table-responsive">
<table class="table table-bordered" style="margin-top:25px;">
  <thead>
  <tr class="f1 ">
    <td>ชื่อรางวัล</td>
    <td>หน่วยงานที่มอบให้</td>
    <td>วันเดือนปีที่ได้รับ</td>
  </tr>
</thead>
  <tr class="f2">
    <td><font><?php echo $fet['f_awardname1'];?></td>
    <td><font><?php echo $fet['f_awarddepart1'];?></td>
    <td><font><?php echo changeDate($fet['f_awardtime1']);?></td>
  </tr>
  <tr class="f2">
    <td><font><?php echo $fet['f_awardname2'];?></td>
    <td><font><?php echo $fet['f_awarddepart2'];?></td>
    <td><font><?php echo changeDate($fet['f_awardtime2']);?></td>
  </tr>

  <tr class="f2">
    <td><font><?php echo $fet['f_awardname3'];?></td>
    <td><font><?php echo $fet['f_awarddepart3'];?></td>
    <td><font><?php echo changeDate($fet['f_awardtime3']);?></td>
  </tr>
</table>

<table class="table">
  <tr>
    <td></td>
    <td>
      <?php
      $sql1 = mysql_query("SELECT count(student_keyf) as num FROM tb_reply_s WHERE coop_keyf = '".$_SESSION['session_key']."' AND student_keyf = '".$_GET['key']."' ");
      $fet1 = mysql_fetch_array($sql1);
      if($fet1['num'] == '0' ){
      ?>
      <form class="" action="include/cooperative/add_reply.php" method="post" id="form_reply">
        <input type="hidden" value="<?php echo $_GET['key']; ?> " name="id_student">
        <tr>
        <td>รายละเอียด</td>
        <td>
          <textarea  cols="" id="message_practice" name="message_practice" rows="" ></textarea> <br>
          <span id="message_a"></span>
          <div class="form-group row">
          <div class=" col-md-3">
             <br>
            <div class="g-recaptcha" data-sitekey="6LdsDUwUAAAAAO-WAIc9TwbSb5sE__94Ug-mIRWb"></div>
            <span class='msg'><?php echo $msg; ?></span> <br>
            <span id="chk_a"></span>
          </div>
          </div>
          <input type="button" value="จองนักศึกษา" class="btn btn-success f" id="add_reply">
        </td>
        </tr>

      </form>
      <?php }else{ ?>
                        <tr>
                        <td></td>
                        <td><font class="f" style="color:red">* ทำการจองนักศึกษาแล้ว</font></td>
                        </tr>
      <?php } ?>
    </td>
  </tr>
</table>
<br>
            </div>
                </div>
<?php }  } ?>
    </div>
    </div>
<?php } ?>
<script type="text/javascript">


$("#add_reply").click(function(){
  var mailContents = CKEDITOR.instances.message_practice.getData();
  var mailContents = CKEDITOR.instances['message_practice'].getData(); //alert(mail
  $("#message_practice").val(mailContents);

         var a = $("#g-recaptcha-response").val();
         if(a == ""){
         $("#chk_a").html("<font style='color:red'><img src='img/validate.gif' width='20' heigth='20'>กรุณาคลิ๊กเพื่อยืนยัน</font>");
         }else{
         $("#chk_a").html("");
         }


         if(mailContents == ""){
         $("#message_a").html("<font style='color:red'><img src='img/validate.gif' width='20' heigth='20'>กรุณากรอกข้อมูล</font>");
         }else{
         $("#message_a").html("");
         }



if(mailContents != "" && a != ""){
  var r = confirm("ยืนยันการแก้ไขข้อมูล");
  if (r == true) {
      $('#form_reply').submit();
  }
}
});

  CKEDITOR.replace( 'message_practice' );
</script>
