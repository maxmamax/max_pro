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
<?php if($_SESSION['session_status_menu'] == 'cooperative' && $_GET['position'] == '' ){
  $sql = mysql_query("SELECT * FROM  tb_register_job a ,  tb_student b , tb_position c  WHERE a.student_keyf = b.student_key AND a.position_keyf = c.position_key AND a.coop_keyf = '".$_SESSION['session_key']."' AND a.position_keyf = '".$_GET['key']."' AND a.job_status = '3' ");
  $fet = mysql_fetch_array($sql);
?>


<div class="panel panel-default">
  <div class="panel-heading"><h1>ข้อมูลนักศึกษาผ่านคัดเลือกฝึกปฏิบัติงาน (<?php echo $fet['position_name']; ?>)
    <form class="" action="include/report2/report_student.php" method="post" target="_blank" style="margin-top:10px;">
      <input type="hidden" name="key_position" value="<?php echo $fet['position_key']; ?>">
      <button class="btn btn-danger" type="submit"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> พิมพ์ใบรายงานการผ่านคัดเลือกฝึกปฏิบัติงาน</button></h1>
    </form>
  </div>
  <div class="panel-body">
    <div class="table-responsive">

<table class="table table-bordered ">
  <thead>
  <tr class="f1">
    <td>ลำดับ</td>
    <td>รูปภาพ</td>
    <td>ชื่อนักศึกษา</td>
    <td>ตำแหน่งงาน</td>
    <td>สถานะ</td>
  </tr>
</thead>
<?php
$i=1;
$sql = "SELECT * FROM  tb_register_job a ,  tb_student b , tb_position c   WHERE a.student_keyf = b.student_key AND a.position_keyf = c.position_key AND a.coop_keyf = '".$_SESSION['session_key']."' AND a.position_keyf = '".$_GET['key']."' AND a.job_status = '3' ";
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
while($fet = mysql_fetch_array($objQuery)){ ?>
  <tr class="f2">
    <td><?php echo $i; ?></td>
    <td><img width="150" height="150px" src="include/image_student/<?php echo $fet['student_part']; ?>"></td>
    <td><a href="index.php?page=job_student&student=<?php echo $fet['student_key']; ?>&position=<?php echo $fet['position_key']; ?> "><?php echo $fet['student_name']." ".$fet['student_last']; ?></a></td>
    <td><?php echo $fet['position_name']; ?></td>
    <td>
      <?php
    if($fet['job_status'] == '0'){
    echo "รอการตรวจสอบ";
    }else if($fet['job_status'] == '1'){
    echo "รอการตรวจสอบ";
    }else if($fet['job_status'] == '2'){
    echo "ไม่อนุมัติการสมัครงาน";
    }else if($fet['job_status'] == '3'){
    echo "ผ่านเข้าสัมภาษณ์งาน";
    }else if($fet['job_status'] == '4'){
    echo "ไม่ผ่านการสอบสัมภาษณ์งาน";
    }else if($fet['job_status'] == '5'){
    echo "ผ่านการคัดเลือกการฝึกปฏิบัติงาน";
    }else if($fet['job_status'] == '6'){
    echo "ไม่ผ่านการคัดเลือกการฝึกปฏิบัติงาน";
    }
    $sql1 = mysql_query("SELECT * FROM tb_interview WHERE student_keyf = '".$fet['student_key']."'  AND position_keyf = '".$_GET['key']."' ");
    $fet1 = mysql_fetch_array($sql1);
       ?>
    </td>
  </tr>
<?php $i++;
}
?>
</table>
    </div>
    Total <?php $Num_Rows;?> Record : <?=$Num_Pages;?> Page :
    <?php
    if($Prev_Page)
    {
    echo " <a href='$_SERVER[SCRIPT_NAME]?page=job_select&Page_data=$Prev_Page'><< Back</a> ";
    }
    for($i=1; $i<=$Num_Pages; $i++){
    if($i != $Page)
    {
    echo " <a href='$_SERVER[SCRIPT_NAME]?page=job_select&Page_data=$i'><button class='btn btn-detail'>$i</button></a> ";
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
    echo " <a href ='$_SERVER[SCRIPT_NAME]?page=job_select&Page_data=$Next_Page'>Next>></a> ";
    } ?>
    </div>
    </div>
<?php }else if($_SESSION['session_status_menu'] == 'cooperative' && $_GET['student'] != '' ){
  $sql = mysql_query("SELECT * FROM tb_student a , tb_position b , tb_faculty c , tb_course d , tb_register_job e , tb_regiter_s f WHERE a.student_key = '".$_GET['student']."' AND b.position_key = '".$_GET['position']."' AND b.coop_keyf = '".$_SESSION['session_key']."' AND a.faculty_keyf = c.faculty_key AND c.faculty_key = d.faculty_keyf AND e.student_keyf = '".$_GET['student']."' AND e.position_keyf = '".$_GET['position']."' AND f.student_keyf = '".$_GET['student']."' ");
  $fet = mysql_fetch_array($sql);
  if($fet){
  ?>

  <div class="panel panel-default">
    <div class="panel-heading"><font class="f">ข้อมูลตำแหน่งงานที่นักศึกษาจอง <?php echo "( ".$fet['position_name']." ) "; ?></font></div>
    <div class="panel-body">

        <div class="panel panel-default">
          <div class="panel-heading"><font class="f">ข้อมูลส่วนตัวนักศึกษา Personal Date:</font></div>
          <div class="panel-body" >
              <div class="table-responsive">
              <div class="col-md-12 col-lg-12 " align="center" style="margin-top:30px;"><img width="150" height="200" src="include/image_student/<?php echo $fet['student_part']; ?>"></div>

<table class="table table-bordered">
  <tr class="f1" >
    <td><font>ชื่อ : <?php echo $fet['student_name']; ?></font></td>
    <td><font>นามสกุล : <?php echo $fet['student_last']; ?></font></td>
    <td><font>รหัสประจำตัว : <?php echo $fet['student_code']; ?></font></td>
    <td><font>ชั้นปีที่ : <?php echo $fet['f_syear']; ?></font></td>
  </tr>
  <tr class="f1">
    <td><font>Name : <?php echo $fet['f_ename']; ?></font></td>
    <td><font>Surname : <?php echo $fet['f_elast']; ?></font></td>
    <td><font>สาขาวิชา : <?php echo $fet['course_name']; ?></font></td>
    <td><font>สำนักวิชา : <?php echo $fet['f_officeob']; ?></font></td>
  </tr>
  <tr class="f1">
    <td><font>เกรดเฉลี่ย : <?php echo $fet['f_grade']; ?></font></td>
    <td><font>เกรดสะสม : <?php echo $fet['f_gradesum']; ?></font></td>
  </tr>
  <tr class="f1">
    <td><font>เพศ : <?php if($fet['f_sex'] == '1'){ echo "ชาย"; }else if($fet['f_sex'] == '2'){ echo "หญฺิง"; } ?></font></td>
    <td><font>สถานที่เกิด : <?php echo $fet['f_pbirth']; ?></font></td>
    <td><font>วันที่เกิด : <?php
    echo $date1 =  changeDate($fet['f_brith']);
    ?></font></td>
    <td><font>ส่วนสูง/cm : <?php echo $fet['f_height']; ?></font></td>
    <td><font>น้ำหนัก/kg : <?php echo $fet['f_weight']; ?></font></td>
  </tr>
  <tr class="f1">
    <td><font>เลขที่บัตรประชาชน : <?php echo $fet['f_idcards']; ?></font></td>
    <td><font>วันที่ออกบัตร : <?php echo thaidate($fet['f_cards']); ?></font></td>
    <td><font>วันหมดอายุ : <?php echo thaidate($fet['f_cardl']); ?></font></td>
  </tr>
  <tr class="f1">
    <td><font>สถานที่ออกบัตร : <?php echo $fet['f_placecard']; ?></font></td>
    <td><font>ศาสนา : <?php echo $fet['f_religion']; ?></font></td>
    <td><font>สัญชาติ : <?php echo $fet['f_nation']; ?></font></td>
  </tr>
  <tr class="f1">
    <td><font>ใบอนุญาติขับขี่รถยนตร์เลขที่ : <?php echo $fet['f_licencar']; ?></font></td>
    <td><font>วันหมดอายุ : <?php echo thaidate($fet['f_licencarl']); ?></font></td>
  </tr>
  <tr class="f1">
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
          <tr class="f1">
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
          <tr class="f1">
            <td><font>สถานที่ทำงาน : <?php echo $fet['f_fwork']; ?></font></td>
            <td><font>โทรศัพท์ : <?php echo $fet['f_fphone']; ?></font></td>
          </tr>
          <tr class="f1">
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
          <tr class="f1">
            <td><font>สถานที่ทำงาน : <?php echo $fet['f_mwork']; ?></font></td>
            <td><font>โทรศัพท์ : <?php echo $fet['r_mphone']; ?></font></td>
          </tr>
          <tr class="f1">
            <td><font>ที่อยู่บิดา/มารดา : <?php echo $fet['f_addreefm']; ?></font></td
          </tr>
          <tr class="f1">
            <td><font>เป็นบุตรธิดาคนที่ <?php echo $fet['f_numcril']; ?> จำนวนพี่น้อง <?php echo $fet['f_numsum']; ?> คน ประกอบด้วย</font></td>
          </tr>
        </table>
        <table class="table table-bordered">

          <tr class="f1">
            <td>ชื่อ - นามสกุล</td>
            <td width="100px">อายุ</td>
            <td>ที่ทำงาน/ที่อยู่</td>
            <td>เบอร์โทรศัพท์</td>
          </tr>

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
                            <tr class="f1">
                              <td><font>ที่อยู่ติดต่อได้ <?php echo $fet['f_address'];?></font></td>
                            </tr>
                            <tr class="f1">
                              <td><font>โทรศัพท์/โทรสาร : <?php echo $fet['f_phone'];?></font></td>
                              <td><font>โทรศัพท์มือถือ <?php echo $fet['f_phonemobie'];?></font></td>
                              <td><font>E-mail Address <?php echo $fet['student_email'];?></font></td>
                            </tr>
                            <tr class="f1">
                              <td><font>ที่อยู่ตามทะเบียนบ้าน :<?php echo $fet['f_nameaddress'];?></font></td>
                              <td><font>โทรศัพท์ <?php echo $fet['f_homephone'];?></font></td>
                            </tr>
                          </table>
  <font class="f">บุคคลที่ติดต่อได้เวลาฉุกเฉิน In Case of Emergency Please Contact:</font><br><br>
                        <table class="table table-bordered">
                          <tr class="f1">
                            <td><font>ชื่อ - นามสกุล <?php echo $fet['f_emername'];?></font></td>
                            <td><font>ความสัมพันธ์ของผู้สมัคร <?php echo $fet['f_emerrela'];?></font></td>

                          </tr>
                          <tr class="f1">
                            <td><font>ที่ทำงาน/ที่อยู่ : <?php echo $fet['f_emeroffice'];?></font></td>
                          </tr>
                          <tr class="f1">
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
                                 <tr class="f">
                                   <td>การศึกษา</td>
                                   <td>ชื่อสถานศึกษา</td>
                                   <td>สาขาวิชา</td>
                                   <td>วุฒิที่ได้รับ</td>
                                   <td>ช่วงเวลาที่ศึกษา</td>
                                   <td>เกรดเฉลี่ย</td>
                                 </tr>

                                 <tr class="f1">
                                   <td>ประถมศึกษา</td>
                                   <td><font><?php echo $fet['f_schoolpriname'];?></font></td>
                                   <td>-</td>
                                   <td><font><?php echo $fet['f_schoolpriquq'];?></font></td>
                                   <td><font><?php echo $fet['f_schoolpritime'];?></font></td>
                                   <td><font><?php echo $fet['f_schoolprigrade'];?></font></td>
                                 </tr>

                                 <tr class="f1">
                                   <td>มัธยมศึกษา</td>
                                   <td><font><?php echo $fet['f_schoolhightname'];?></font></td>
                                   <td>-</td>
                                   <td><font><?php echo $fet['f_schoolhightquq'];?></font></td>
                                   <td><font><?php echo $fet['f_schoolhighttime'];?></font></td>
                                   <td><font><?php echo $fet['f_schoolhightgrade'];?></font></td>
                                 </tr>


                                 <tr class="f1">
                                   <td>ปริญญาตรี</td>
                                   <td>มหาวิทยาลัยราชภัฏกาญจนบุรี</td>
                                   <td><font><?php echo $fet['f_schoolbrandbach'];?></font></td>
                                   <td>กำลังศึกษา</td>
                                   <td><font><?php echo $fet['f_schoolbachtime'];?></font></td>
                                   <td><font><?php echo $fet['f_schoolbachgrade'];?></font></td>
                                 </tr>
                               </table>

                               <table class="table table-bordered">
                                 <tr class="f">
                                   <td bgcolor="#f5f5f5">การฝึกอบรม</td>
                                   <td bgcolor="#f5f5f5">หัวข้อฝึกอบรม</td>
                                   <td bgcolor="#f5f5f5">หน่วยงานที่ให้การฝึกอบรม</td>
                                   <td bgcolor="#f5f5f5">ฃ่วงเวลาที่ฝึกอบรม (เดือน/พ.ศ.)</td>
                                 </tr>

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
                                  <tr>
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
                                  </tr>


                                </table>
                                <table class="table table-bordered" style="text-align:center;">
                                  <tr>
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
                                      <?php if($fet['f_sportother2'] == '1'){  ?>
                                      <span class="glyphicon glyphicon-check" aria-hidden="true"></span>
                                    <?   }else{ ?>
                                      <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span>
                                    <?php  } ?>
                                    </td>
                                    <td>
                                      <?php if($fet['f_sportother2'] == '2'){  ?>
                                      <span class="glyphicon glyphicon-check" aria-hidden="true"></span>
                                    <?   }else{ ?>
                                      <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span>
                                    <?php  } ?>
                                    </td>
                                    <td>
                                      <?php if($fet['f_sportother2'] == '3'){  ?>
                                      <span class="glyphicon glyphicon-check" aria-hidden="true"></span>
                                    <?   }else{ ?>
                                      <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span>
                                    <?php  } ?>
                                    </td>
                                    <td>
                                      <?php if($fet['f_sportother2'] == '4'){  ?>
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
                            <tr class="f">
                              <td>ช่วงเวลา - ปี</td>
                              <td>องค์กร/กิจกรรม</td>
                              <td>ความรับผิดชอบ</td>
                              <td>หมายเหตุ</td>
                            </tr>

                            <tr class="f1">
                              <td><font><?php echo $fet['f_worktime1'];?></font></td>
                              <td><font><?php echo $fet['f_workaction1'];?></font></td>
                              <td><font><?php echo $fet['f_workres1'];?></font></td>
                              <td><font><?php echo $fet['f_worknote1'];?></font></td>
                            </tr>

                            <tr class="f1">
                              <td><font><?php echo $fet['f_worktime2'];?></font></td>
                              <td><font><?php echo $fet['f_workaction2'];?></font></td>
                              <td><font><?php echo $fet['f_workres2'];?></font></td>
                              <td><font><?php echo $fet['f_worknote2'];?></font></td>
                            </tr>

                            <tr class="f1">
                              <td><font><?php echo $fet['f_worktime3'];?></font></td>
                              <td><font><?php echo $fet['f_workaction3'];?></font></td>
                              <td><font><?php echo $fet['f_workres3'];?></font></td>
                              <td><font><?php echo $fet['f_worknote3'];?></font></td>
                            </tr>

                            <tr class="f1">
                              <td><font><?php echo $fet['f_worktime4'];?></font></td>
                              <td><font><?php echo $fet['f_workaction4'];?></font></td>
                              <td><font><?php echo $fet['f_workres4'];?></font></td>
                              <td><font><?php echo $fet['f_worknote4'];?></font></td>
                            </tr>

                            <tr class="f1">
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
  <table class="table table-bordered">
    <tr class="f">
      <td>ชื่อรางวัล</td>
      <td >หน่วยงานที่มอบให้</td>
      <td >วันเดือนปีที่ได้รับ</td>
    </tr>

    <tr class="f1">
      <td><font><?php echo $fet['f_awardname1'];?></td>
      <td><font><?php echo $fet['f_awarddepart1'];?></td>
      <td><font><?php echo $fet['f_awardtime1'];?></td>
    </tr>
    <tr class="f1">
      <td><font><?php echo $fet['f_awardname2'];?></td>
      <td><font><?php echo $fet['f_awarddepart2'];?></td>
      <td><font><?php echo $fet['f_awardtime2'];?></td>
    </tr>

    <tr class="f1">
      <td><font><?php echo thaidate($fet['f_awardname3']);?></td>
      <td><font><?php echo thaidate($fet['f_awarddepart3']);?></td>
      <td><font><?php echo thaidate($fet['f_awardtime3']);?></td>
    </tr>



  </table>

  <form  action="include/cooperative/update_status.php" method="post" id="form_update_status">

      <div class="forn-group row">
        <div class="col-md-3">
          <input type="hidden" name="position_key" value="<?php echo $fet['position_key']; ?>">
          <input type="hidden" name="student_key" value="<?php echo $fet['student_key']; ?>">
          <td>
          <font class="f1">สถานะการยืนยันการสมัครงาน
          <select class="form-control " name="status_job" id="status_job">
          <option value="0" <?php if($fet['job_status'] == '0' ){ echo "selected"; }?> >--เลือกข้อมูลสถานะการยืนยันการสมัครงาน --</option>
          <option value="1" <?php if($fet['job_status'] == '1' ){ echo "selected"; }?> >รอการตรวจสอบ</option>
          <option value="2" <?php if($fet['job_status'] == '2' ){ echo "selected"; }?> >ไม่อนุมัติการสมัครงาน</option>
          <option value="3" <?php if($fet['job_status'] == '3' ){ echo "selected"; }?> >ผ่านเข้าสัมภาษณ์งาน</option>
          <option value="4" <?php if($fet['job_status'] == '4' ){ echo "selected"; }?> >ไม่ผ่านการสอบสัมภาษณ์งาน</option>
          <option value="5" <?php if($fet['job_status'] == '5' ){ echo "selected"; }?> >ผ่านการคัดเลือกการฝึกปฏิบัติงาน</option>
          <option value="6" <?php if($fet['job_status'] == '6' ){ echo "selected"; }?> >ไม่ผ่านการคัดเลือกการฝึกปฏิบัติงาน</option>
        </select></font>
          </td>
        </div>


        <div class="" id="hid">
          <div class="form-group row">
            <div class="col-md-2">
              <label for="">วัน/เดือน/ปี</label>
              <input type="date" name="inter_date" value="" class="form-control" id="d">
              <span id="d_a"></span>
            </div>
            <div class="col-md-2">
              <label for="">เวลา</label>
              <input type="time" name="inter_time" value="" class="form-control" id="t">
              <span id="t_a"></span>
            </div>
            <div class="col-md-2">
              <label for="">หมายเหตุ</label>
              <input type="text" name="inter_note" value="" class="form-control" >
            </div>
          </div>
        </div>

        <div class="col-md-1">
          <label for=""><br><input type="button" class="btn btn-success" value="ยืนยัน" id="update_status"></label>
        </div>
      </div>

  </form>
  <br>
                              </div>
                            </div>
                          </div>
                          </div>

    </div>
  </div>


    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title f">ข้อมูลตำแหน่งงานที่นักศึกษาจอง <?php echo "( ".$fet['position_name']." ) "; ?></h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-12 col-lg-12 " align="center"><img width="200" height="250" src="include/image_student/<?php echo $fet['student_part']; ?>"></div>
                <div class=" col-md-9 col-lg-12 ">
                  <table class="table table-user-information">
                    <tbody>
        <!-- ข้อมูลตำแหน่งงาน -->
                      <tr class="f">
                        <td colspan="2">ข้อมูลนักศึกษา</td>
                        <td></td>
                      </tr>
                      <tr >
                        <td>ชื่อ</td>
                        <td><?php echo $fet['student_name']." ". $fet['student_last']; ?></td>
                      </tr>
                      <tr>
                        <td>คณะ</td>
                        <td><?php echo $fet['faculty_name']; ?></td>
                          </tr>
                      <tr>
                        <td>สาขา</td>
                        <td><?php echo $fet['course_name']; ?></td>
                      </tr>
                         <tr>
                             <tr>
                        <td>วันจองตำแหน่งงาน</td>
                        <td><?php echo thaidate($fet['job_date']); ?></td>
                      </tr>
                        <tr>
                        <td>รายละเอียดงานทีสนใจ</td>
                        <td><?php echo $fet['f_brith']; ?></td>
                      </tr>
                      <tr>
                      <td>รายละเอียดการฝึกอบรม/แข่งขัน/ผลการเรียน	</td>
                      <td><?php echo $fet['job_o']; ?></td>
                      </tr>
                      <td>รายละเอียดโครงง/ผลงาน/เกียรติบัตร	</td>
                      <td><?php echo $fet['job_k']; ?></td>
                      </tr>

        <!-- ข้อมูลตำแหน่งงาน -->
                      <tr>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr class="f">
                        <td colspan="2">ข้อมูลตำแหน่งงาน</td>
                        <td></td>
                      </tr>
                      <tr>
                        <td>ตำแหน่งงาน</td>
                        <td><?php echo $fet['position_name']; ?></td>
                          </tr>
                      <tr>
                        <td>แผนก</td>
                        <td><?php echo $fet['position_depart']; ?></td>
                      </tr>
                         <tr>
                             <tr>
                        <td>วันที่ประกาศรับสมัคร</td>
                        <td><?php echo thaidate($fet['position_dateF']); ?>ale</td>
                      </tr>
                        <tr>
                        <td>วันทีปิดประกาศรับสมัคร</td>
                        <td><?php echo $fet['position_dateL']; ?></td>
                      </tr>
                      <tr>
                      <td>ข้อมูลคุณสมบัติต่างๆที่รับสมัคร</td>
                      <td><?php echo $fet['position_property']; ?></td>
                      </tr>
                    <tr>
                      <td>ข้อมูลสวัสดีการและค่าตอบแทน ต่างๆ</td>
                      <td><?php echo $fet['position_money']; ?></td>
                      </tr>
                      <tr>
                        <td>จำนวนที่รับสมัคร</td>
                        <td><?php echo $fet['position_register']; ?></td>
                        </tr>
                        <tr>
                          <td>สถานะ</td>
                          <td><?php
                        if($fet['job_status'] == '0'){
                        echo "รอการตรวจสอบ";
                        }else if($fet['job_status'] == '1'){
                        echo "รอการอนุมัติ";
                        }else if($fet['job_status'] == '2'){
                        echo "อนุมัติ";
                        }else if($fet['job_status'] == '3'){
                        echo "ไม่อนุมัติ";
                        }
                           ?></td>
                          </tr>
<?php
  $key_branch = $fet['branch_keyf'];
if($key_branch != "0" ){
  $sql1 = mysql_query("SELECT * FROM tb_branch WHERE branch_key = '$key_branch'  ");
  $fet1 = mysql_fetch_array($sql1);
   ?>
                    <tr>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr class="f">
                      <td>ข้อมูลสาขาย่อย</td>
                      <td></td>
                    </tr>
                    <tr>
                      <td>ชื่อสาขาย่อย</td>
                      <td><?php echo $fet1['branch_name']; ?></td>
                        </tr>
                      <tr>
                      <td>ที่อยู่</td>
                      <td><?php echo $fet1['branch_address']." ตำบล ".$fet['branch_sdistrict']." อำเภอ ".$fet['branch_district']." จังหวัด ".$fet['branch_province']." รหัสไปรษณีย์ ".$fet['branch_code']; ?></td>
                    </tr>
                    <tr>
                    <td>เบอร์โทรศัพท์</td>
                    <td><?php echo $fet1['branch_phone']; ?></td>
                    </tr>
                  <tr>
                    <td>อีเมล</td>
                    <td><?php echo $fet1['branch_email']; ?></td>
                    </tr>
                    <tr>
                      <td>เว็บไซด์</td>
                      <td><?php echo $fet1['branch_web']; ?></td>
                      </tr>

<?php
}
?>
  </tbody>
<form  action="include/cooperative/update_status.php" method="post" id="form_update_status">
        <tr>
          <td>จัดการสถานะ</td>
          <input type="hidden" name="position_key" value="<?php echo $fet['position_key']; ?>">
          <input type="hidden" name="student_key" value="<?php echo $fet['student_key']; ?>">
          <td>
          <select class="form-control" name="status_job" >
          <option value="0" <?php if($fet['job_status'] == '0' ){ echo "selected"; }?> >รอการตรวจสอบ</option>
          <option value="1" <?php if($fet['job_status'] == '1' ){ echo "selected"; }?> >รอกาอนุมัติ</option>
          <option value="2" <?php if($fet['job_status'] == '2' ){ echo "selected"; }?> >อนุมัติ</option>
          <option value="3" <?php if($fet['job_status'] == '3' ){ echo "selected"; }?> >ไม่อนุมัติ</option>
          </select>
          </td>
          <td><input type="button" class="btn btn-success" value="ยืนยัน" id="update_status"></td>
        </tr>
</form>
</table>
<?php
 }
    } ?>
<script type="text/javascript">
var id = 0;
$("#hid").hide();
  $("#add").click(function(){
    var r = confirm("ยืนยันการบันทึกข้อมูล");
    if (r == true) {
        $('#form_addjob').submit();
    }
  });

  $("#update_status").click(function(){
    var d = $('#d').val();
    var t = $('#t').val();

    if(id == '3'){
      if(d == ""){
        $("#d_a").html("<span class=require><font style='color:red'><img src='img/validate.gif' width='20' heigth='20'>จำเป็นต้องกรอก</font><br></span>");
      }else {
       $("#d_a").html('');
      }
      if(t == ""){
        $("#t_a").html("<span class=require><font style='color:red'><img src='img/validate.gif' width='20' heigth='20'>จำเป็นต้องกรอก</font><br></span>");
      }else {
       $("#t_a").html('');
      }
    }else{
      var r = confirm("ยืนยันการบันทึกข้อมูล");
      if (r == true) {
          $('#form_update_status').submit();
      }
    }

if(id == '3' && d != '' && t != ''){
  var r = confirm("ยืนยันการบันทึกข้อมูล");
  if (r == true) {
      $('#form_update_status').submit();
  }
}
  });

  $("#status_job").change(function(){
   id =   $("#status_job").val();
   if(id == '3'){
     $("#hid").show();
   }else{
     $("#hid").hide();
   }

  });
</script>
