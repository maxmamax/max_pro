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
//ใช้ Function explode ในการแยกไฟล์ ออกเป็น  Array
$get_date = explode("-",$date);
//กำหนดชื่อเดือนใส่ตัวแปร $month
	$month = array("01"=>"ม.ค.","02"=>"ก.พ","03"=>"มี.ค.","04"=>"เม.ย.","05"=>"พ.ค.","06"=>"มิ.ย.","07"=>"ก.ค.","08"=>"ส.ค.","09"=>"ก.ย.","10"=>"ต.ค.","11"=>"พ.ย.","12"=>"ธ.ค.");
//month
$get_month = $get_date["1"];

//year
$year = $get_date["0"]+543;

return $get_date["2"]." ".$month[$get_month]." ".$year;

}
?>
<?php if($_SESSION['session_status_menu'] == 'cooperative' && $_GET['position'] == '' ){
?>


<div class="panel panel-default">
  <div class="panel-heading"><h1><span class="glyphicon glyphicon-list" aria-hidden="true"></span> การจองตำแหน่งงานนักศึกษา</h1></div>
  <div class="panel-body">

    <form class="" action="" method="post">

<div class="form-group row">
 <div class="col-md-3">
     <label for=""><font class="f">สถานะ</font></label>
     <select class="form-control" name="status">
       <option value="" <?php if($_POST['status'] == '' ){ echo "selected"; }?> >-- ข้อมูลทั้งหมด --</option>
        <option value="0" <?php if($_POST['status'] == '0' ){ echo "selected"; }?> >รอการตรวจสอบ</option>
        <option value="1" <?php if($_POST['status'] == '1' ){ echo "selected"; }?> >นัดสอบสัมภาษณ์งาน</option>
        <option value="2" <?php if($_POST['status'] == '2' ){ echo "selected"; }?> >ไม่ผ่านการสัมภาษณ์งาน</option>
        <option value="3" <?php if($_POST['status'] == '3' ){ echo "selected"; }?> >ผ่านกสัมภาษณ์งาน</option>

     </select>
     </div>
     <div class="col-md-3" style="margin-top:35px;">
       <button type="submit" name="button" class="btn btn-success" ><span class="glyphicon glyphicon-search" aria-hidden="true"></span> <font>ค้นหา</font></button>
     </div>
 </div>
     </form>
<?php if($_POST['key_student'] != "" && $_POST['key_position'] != ""){
$sql = mysql_query("SELECT * FROM tb_student a , tb_position b , tb_register_job c WHERE a.student_key = '".$_POST['key_student']."' AND b.position_key = '".$_POST['key_position']."' AND c.position_keyf = '".$_POST['key_position']."' AND c.student_keyf = '".$_POST['key_student']."' ");
$fet = mysql_fetch_array($sql);
if($fet['job_status'] == '0'){
  $s = "รอการตรวจสอบ";
}else if($fet['job_status'] == '1'){
  $s = "นัดสัมภาษณ์";
}else if($fet['job_status'] == '2'){
  $s = "ไม่ผ่านการสัมภาษณ์งาน";
}else if($fet['job_status'] == '3'){
  $s = "ผ่านการสัมภาษณ์งาน";
}
  ?>

  <table class="table table-bordered">
    <tr>
      <td >ชื่อนักศึกษา</td>
      <td>
        <div class="col-md-3">
          <input readonly class="form-control" type="text" name="" value="<?php echo $fet['student_name']." ".$fet['student_last']; ?> ">
        </div>
      </td>
    </tr>
    <tr>
      <td>ตำแหน่งงาน</td>
      <td>
        <div class="col-md-3">
          <input readonly class="form-control" type="text" name="" value="<?php echo $fet['position_name']; ?> ">
        </div>
      </td>
    </tr>
    <tr>
      <td>สถานะปัจจุบัน</td>
      <td>
        <div class="col-md-3">
          <input readonly class="form-control" type="text" name="" value="<?php echo $s; ?> ">
        </div>
      </td>
    </tr>
    <tr>
      <td>สถานะ</td>
      <td>
        <form action="include\cooperative\update_statusposition.php" method="post" style="margin-left:15px;" id="form_update">
        <div class="form-group row">
        <div class="col-md-3">
          <label for="">สถานะ</label>
        <select class="form-control" name="status_seletc" id="status_seletc">
          <option value="">-- เลือกสถานะ -- </option>
          <?php if($fet['job_status'] == '0'){ ?>
          <option value="1">นัดสัมภาษณ์</option>

      <?php }else if($fet['job_status'] == '1'){ ?>
          <option value="2">ผลการสัมภาษณ์</option>
      <?php }else{

      } ?>
        </select>
      </div>
      <div class="" id="status1">
        <div class="">
          <div class="form-group row">
          <input type="hidden" name="key_student" value="<?php echo $_POST['key_student']; ?>">
          <input type="hidden" name="key_position" value="<?php echo $_POST['key_position']; ?>">
          <div class="col-md-3">
            <label for="">วันที่นัดสัมภาษณ์</label>
            <input type="date" name="inter_date" value="" class="form-control">
          </div>
          <div class="col-md-2">
            <label for="">เวลา</label>
            <input type="time" name="inter_time" value="" class="form-control">
          </div>
          <div class="col-md-3">
            <label for="">สถานที่นัดสัมภาษณ์</label>
            <input type="text" name="inter_place" value="" class="form-control">
          </div>
                </div>
          <div class="col-md-5">
            <label for="">สิ่งที่ต้องเตรียมมาสัมภาษณ์</label>
            <textarea rows="8" cols="80" class="form-control" id="message_add" name="message_add"></textarea>
          </div>
      </div>      </div>
      <div class="" id="status2">
        <div class="">
          <div class="form-gorup row">
            <div class="col-md-3">
              <label for="">ผลการสัมภาษณ์</label>
              <br>
              <input type="radio" name="r" value="1" id="r"> ผ่าน
              <input type="radio" name="r" value="2" id="r"> ไม่ผ่าน

            </div>
          </div>
          <div class="" id="show_status2" style="margin-top:25px;">
          <div class="form-group row">
          <input type="hidden" name="key_student" value="<?php echo $_POST['key_student']; ?>">
          <input type="hidden" name="key_position" value="<?php echo $_POST['key_position']; ?>">
          <div class="col-md-3">
            <label for="">วันที่ฝึกปฏิบัติงาน</label>
            <input type="date" name="prac_date" value="" class="form-control">
          </div>
          <div class="col-md-2">
            <label for="">เวลา</label>
            <input type="time" name="prac_time" value="" class="form-control">
          </div>
          </div>
          <div class="col-md-5">
            <label for="">รายละเอียด</label>
            <textarea rows="8" cols="80" class="form-control" id="message_add1" name="message_add1"></textarea>

          </div>
        </div>
      </div>
      </div>

      </td>
    </tr>
    <tr>
      <td></td>
      <td>
            <div class="form-group row">
            <div class=" col-md-3">
              <div class="g-recaptcha" data-sitekey="6LdsDUwUAAAAAO-WAIc9TwbSb5sE__94Ug-mIRWb"></div>
              <span class='msg'><?php echo $msg; ?></span>
              <span id="chk_a"></span>
            </div>
            </div>
        <button class="btn btn-success" style="margin-top:25px;" type="button" id="update_status">ยืนยัน</button>
      </td>

    </tr>
       </form>
  </table>
</div>

<?php } ?>
<div class="table-responsive">
<table class="table table-bordered table-hover">
  <thead>
  <tr class="f2">
    <td>ลำดับ</td>
    <td>รูปภาพ</td>
    <td>ชือนักศึกษา</td>
    <td>ตำแหน่งงาน</td>
    <td>สถานะ</td>
    <td>จัดการข้อมูล</td>
  </tr>
</thead>
<?php
$i=1;
$sql = "SELECT * FROM  tb_register_job as a INNER JOIN tb_student as b ON (a.student_keyf = b.student_key) INNER JOIN tb_position as c ON (a.position_keyf = c.position_key ) WHERE a.coop_keyf = '".$_SESSION['session_key']."'   AND a.position_keyf = '".$_GET['key']."' AND a.job_status  LIKE '%".$_POST['status']."%'  ";
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
  <tr class="f2" >
    <td><?php echo $i; ?></td>
    <td><img width="100" height="100px" src="include/image_student/<?php echo $fet['student_part']; ?>"></td>
    <td><?php echo $fet['student_name']." ".$fet['student_last']; ?></td>
    <td><?php echo $fet['position_name']; ?></td>
    <td>

      <?php
    if($fet['job_status'] == '0'){
    echo "รอการตรวจสอบ";
    }else if($fet['job_status'] == '1'){
    echo "นัดสัมภาษณ์";
    }else if($fet['job_status'] == '2'){
    echo "ไม่ผ่านการสัมภาษณ์";
    }else if($fet['job_status'] == '3'){
    echo "ผ่านการสัมภาษณ์งาน";
    }
       ?>
    </td>
    <td>
      <a href="index.php?page=job_student&student=<?php echo $fet['student_key']; ?>&position=<?php echo $fet['position_key']; ?> "><span class="glyphicon glyphicon-eye-open btn btn-success"><font> ดูข้อมูล</font></span></a>
      <div style="margin-top:5px;"><button type="button" name="button" class="btn btn-primary" class="btn" data-toggle="collapse" data-target="#demo<?php echo $i; ?>"><span class="glyphicon glyphicon-eye-open"></span> รายละเอียดสถานะ</button></div>
      <form action="" style="margin-top:5px;" method="post">
       <input type="hidden" name="key_student" value="<?php echo $fet['student_key']; ?>">
       <input type="hidden" name="key_position" value="<?php echo $fet['position_key']; ?>">
      <button type="submit" name="button" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span> แก้ไขข้อมูลสถานะ</button>
    </form>
    <form style="margin-top:5px;" class="" action="include/report3/report_student.php" method="post" target="_blank">
      <input type="hidden" name="key_student" value="<?php echo $fet['student_key']; ?>">
      <input type="hidden" name="key_position" value="<?php echo $fet['position_key']; ?>">
      <button class="btn btn-danger" type="submit"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> พิมพ์ใบสมัครงานนักศึกษา</button></h1>
    </form>
    </td>
  </tr>
  <tr>
      <td colspan="6">
        <div id="demo<?php echo $i; ?>" class="collapse">
          <?php
          $sql1 = mysql_query("SELECT * FROM tb_register_job WHERE student_keyf = '".$fet['student_key']."' AND position_keyf = '".$fet['position_key']."'  ");
          $fet1 = mysql_fetch_array($sql1);
          ?>
          <div class="panel panel-default">
            <div class="panel-heading"><b>การนัดสัมภาษณ์งาน</b></div>
            <div class="panel-body">

                        <table class="table table-bordered">
                          <tr width="100px;">
                            <td>สถานะ</td>
                            <td>
                              <?php if($fet1['job_status'] == '0'){echo "รอการตรวจสอบ";
                              }else if($fet1['job_status'] == '1'){ echo "นัดสัมภาษณ์งาน";
                              }else if($fet1['job_status'] == '2'){ echo "ไม่ผ่านการสัมภาษณ์งาน";
                              }else if($fet1['job_status'] == '3'){ echo "่ผ่านการสัมภาษณ์งาน";
                              }?>
                            </td>
                          </tr>
                          <?php
                          $sql2 = mysql_query("SELECT * FROM tb_interview  WHERE student_keyf = '".$fet1['student_keyf']."' AND position_keyf = '".$fet1['position_keyf']."'  ");
                          $fet2 = mysql_fetch_array($sql2);
                          ?>
                          <tr  width="100px;">
                            <td>การนัดสัมภาษณ์</td>
                          </tr>
                          <tr  width="100px;">
                            <td>ยืนยันวันที่</td>
                            <td><?php  if($fet2['iter_datecon'] != ""){ echo changeDate($fet2['iter_datecon']); }  ?></td>
                          </tr>
                          <tr  width="100px;">
                            <td>สถานที่สัมภาษณ์</td>
                            <td><?php echo $fet2['inter_place']; ?></td>
                          </tr>
                          <tr  width="100px;">
                            <td>วันที่สัมภาษณ์</td>
                            <td><?php if($fet2['inter_date'] != ""){ echo  changeDate($fet2['inter_date']); } ?></td>
                          </tr>
                          <tr  width="100px;">
                            <td>เวลาที่สัมภาษณ์</td>
                            <td><?php echo $fet2['inter_time']; ?></td>
                          </tr>
                          <tr  width="100px;">
                            <td>สิ่งที่ต้องเตรียมมาสัมภาษณ์</td>
                            <td><?php echo $fet2['inter_note']; ?></td>
                          </tr>
                        </table>

            </div>
          </div>

          <div class="panel panel-default">
            <div class="panel-heading"><b>การฝึกปฏิบัติงาน</b></div>
            <div class="panel-body">
          <table class="table table-bordered">
            <tr width="100px;">
              <td>ผลการสัมภาษณ์</td>
              <td>
                <?php if($fet1['job_status'] == '0'){echo "รอการตรวจสอบ";
                }else if($fet1['job_status'] == '1'){ echo "นัดสัมภาษณ์งาน";
                }else if($fet1['job_status'] == '2'){ echo "ไม่ผ่านการสัมภาษณ์งาน";
                }else if($fet1['job_status'] == '3'){ echo "่ผ่านการสัมภาษณ์งาน";
                }?>
              </td>
            </tr>
            <?php
            $sql3 = mysql_query("SELECT * FROM tb_practice  WHERE student_keyf = '".$fet1['student_keyf']."' AND position_keyf = '".$fet1['position_keyf']."'  ");
            $fet3 = mysql_fetch_array($sql3);
            ?>
            <tr>
              <td>ยืนยันวันที่</td>
              <td><?php  if($fet2['inter_date'] != ""){ echo changeDate($fet3['prac_datecon']); } ?></td>
            </tr>
            <tr>
              <td>วันที่ฝึกปฏิบัติงาน</td>
              <td><?php  if($fet2['inter_date'] != ""){ echo changeDate($fet3['prac_date']); } ?></td>
            </tr>
            <tr>
              <td>เวลา</td>
              <td><?php echo $fet3['prac_time']; ?></td>
            </tr>
            <tr>
              <td>รายละเอียด</td>
              <td><?php echo $fet3['prac_note']; ?></td>
            </tr>
          </table>
        </div></div></div>
      </td>
  </tr>
<?php $i++;
}
?>
</table>
</div>
จำนวนข้อมูลทั้งหมด <?php echo $Num_Rows;?> ข้อมูล  จำนวนหน้าทั้งหมด <?php echo $Num_Pages; ?> หน้า :
<?php
if($Prev_Page)
{
echo " <a href='$_SERVER[SCRIPT_NAME]?page=job_cooperative&Page_data=$Prev_Page'><< ย้อนกลับ</a> ";
}
for($i=1; $i<=$Num_Pages; $i++){
if($i != $Page)
{
echo " <a href='$_SERVER[SCRIPT_NAME]?page=job_cooperative&Page_data=$i'><button class='btn btn-detail'>$i</button></a> ";
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
echo " <a href ='$_SERVER[SCRIPT_NAME]?page=job_cooperative&Page_data=$Next_Page'>ถัดไป>></a> ";
} ?>
    </div>
    </div>
<?php }else if($_SESSION['session_status_menu'] == 'cooperative' && $_GET['student'] != '' ){
  $sql = mysql_query("SELECT * FROM tb_student a , tb_position b , tb_faculty c , tb_course d , tb_register_job e , tb_regiter_s f WHERE a.student_key = '".$_GET['student']."' AND b.position_key = '".$_GET['position']."' AND b.coop_keyf = '".$_SESSION['session_key']."' AND a.faculty_keyf = c.faculty_key AND c.faculty_key = d.faculty_keyf AND e.student_keyf = '".$_GET['student']."' AND e.position_keyf = '".$_GET['position']."' AND f.student_keyf = '".$_GET['student']."' ");
  $fet = mysql_fetch_array($sql);
  if($fet){
  ?>


  <div class="panel panel-default">
    <div class="panel-heading"><font class="f"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> ข้อมูลตำแหน่งงานที่นักศึกษาจอง <?php echo "( ".$fet['position_name']." ) "; ?></font></div>
    <div class="panel-body">

        <div class="panel panel-default">
          <div class="panel-heading"><font class="f1">ข้อมูลส่วนตัวนักศึกษา Personal Date:</font></div>
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
    echo $date1 =  changeDate($fet['f_brith']);
    ?></font></td>
    <td><font>ส่วนสูง/cm : <?php echo $fet['f_height']; ?></font></td>
    <td><font>น้ำหนัก/kg : <?php echo $fet['f_weight']; ?></font></td>
  </tr>
  <tr class="f2">
    <td><font>เลขที่บัตรประชาชน : <?php echo $fet['f_idcards']; ?></font></td>
    <td><font>วันที่ออกบัตร : <?php echo thaidate($fet['f_cards']); ?></font></td>
    <td><font>วันหมดอายุ : <?php echo thaidate($fet['f_cardl']); ?></font></td>
  </tr>
  <tr class="f2">
    <td><font>สถานที่ออกบัตร : <?php echo $fet['f_placecard']; ?></font></td>
    <td><font>ศาสนา : <?php echo $fet['f_religion']; ?></font></td>
    <td><font>สัญชาติ : <?php echo $fet['f_nation']; ?></font></td>
  </tr>
  <tr class="f2">
    <td><font>ใบอนุญาติขับขี่รถยนตร์เลขที่ : <?php echo $fet['f_licencar']; ?></font></td>
    <td><font>วันหมดอายุ : <?php echo thaidate($fet['f_licencarl']); ?></font></td>
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
                           <div class="panel-heading"><font class="f">ประวัติการศึกษาและฝึกอบรม Educational and Training Backgrounds: <font color="red"><?php if($fet['f_statutschool'] == '1') { echo "(กำลังศึกษา)"; } else if($fet['f_statutschool'] == '2') { echo "(ศิษย์เก่า)"; } ?></font></font></div>
                             <div class="panel-body">
                               <div class="table-responsive">
                               <table class="table table-bordered" style="text-align:center;">
                               <thead>
                                 <tr class="f">
                                   <td >การศึกษา</td>
                                   <td  >ชื่อสถานศึกษา</td>
                                   <td  >สาขาวิชา</td>
                                   <td  >วุฒิที่ได้รับ</td>
                                   <td  >ช่วงเวลาที่ศึกษา</td>
                                   <td  >เกรดเฉลี่ย</td>
                                 </tr>

                               </thead>
                                 <tr class="f2">
                                   <td>ประถมศึกษา</td>
                                   <td><font><?php echo $fet['f_schoolpriname'];?></font></td>
                                   <td>-</td>
                                   <td><font><?php echo $fet['f_schoolpriquq'];?></font></td>
                                   <td><font><?php echo $fet['f_schoolpritime'];?></font></td>
                                   <td><font><?php echo $fet['f_schoolprigrade'];?></font></td>
                                 </tr>

                                 <tr class="f2">
                                   <td>มัธยมศึกษา</td>
                                   <td><font><?php echo $fet['f_schoolhightname'];?></font></td>
                                   <td>-</td>
                                   <td><font><?php echo $fet['f_schoolhightquq'];?></font></td>
                                   <td><font><?php echo $fet['f_schoolhighttime'];?></font></td>
                                   <td><font><?php echo $fet['f_schoolhightgrade'];?></font></td>
                                 </tr>

                                 <tr class="f2">
                                   <td>ปริญญาตรี</td>
                                   <td>มหาวิทยาลัยราชภัฏกาญจนบุรี</td>
                                   <td><font><?php echo $fet['f_schoolbrandbach'];?></font></td>
                                   <td>กำลังศึกษา</td>
                                   <td><font><?php echo $fet['f_schoolbachtime'];?></font></td>
                                   <td><font><?php echo $fet['f_schoolbachgrade'];?></font></td>
                                 </tr>

                              <?php if($fet['f_statutschool'] == '2') { ?>
                                <tr class="f2">
                                  <td>ปริญญาโท</td>
                                  <td><font><?php echo $fet['f_schoolmastername'];?></font></td>
                                  <td><font><?php echo $fet['f_schoolmasterbrand'];?></font></td>
                                  <td>
                                  <?php if($fet['f_schoolmasterquq'] == '1'){
                                    echo "กำลังศึกษา";
                                  }else if($fet['f_schoolmasterquq'] == '2'){
                                    echo "ปริญญาโท";
                                  }?>
                                  </td>
                                  <td><font><?php echo $fet['f_schoolmastertime'];?></font></td>
                                  <td><font><?php echo $fet['f_schoolmastergrade'];?></font></td>
                                </tr>

                              <?php } ?>
                               </table>

                               <table class="table table-bordered">

                               <thead>
                                 <tr class="f">
                                   <td>การฝึกอบรม</td>
                                   <td>หัวข้อฝึกอบรม</td>
                                   <td>หน่วยงานที่ให้การฝึกอบรม</td>
                                   <td>ฃ่วงเวลาที่ฝึกอบรม (เดือน/พ.ศ.)</td>
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
                            <tr class="f">
                              <td>ช่วงเวลา - ปี</td>
                              <td>องค์กร/กิจกรรม</td>
                              <td>ความรับผิดชอบ</td>
                              <td>หมายเหตุ</td>
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
  <table class="table table-bordered">
  <thead>
    <tr class="f">
      <td>ชื่อรางวัล</td>
      <td>หน่วยงานที่มอบให้</td>
      <td>วันเดือนปีที่ได้รับ</td>
    </tr>
  </thead>
    <tr class="f2">
      <td><font><?php echo $fet['f_awardname1'];?></td>
      <td><font><?php echo $fet['f_awarddepart1'];?></td>
      <td><font><?php echo $fet['f_awardtime1'];?></td>
    </tr>
    <tr class="f2">
      <td><font><?php echo $fet['f_awardname2'];?></td>
      <td><font><?php echo $fet['f_awarddepart2'];?></td>
      <td><font><?php echo $fet['f_awardtime2'];?></td>
    </tr>

    <tr class="f2">
      <td><font><?php echo $fet['f_awardname3'];?></td>
      <td><font><?php echo $fet['f_awarddepart3'];?></td>
      <td><font><?php echo $fet['f_awardtime3'];?></td>
    </tr>
  </table>
  <br>
                              </div>
                            </div>
                          </div>
                          </div>
    </div>
  </div>
<?php
 }
    } ?>
<script type="text/javascript">

$("[id^=r]").click(function(){
var r = $(this).val();
if(r == '1'){
    $("#show_status2").show();
}else if(r == '2'){
    $("#show_status2").hide();
}

});

var d  = $("#status_seletc").val();
if(d == ""){
  $("#status1").hide();
  $("#status2").hide();
}

$("#status_seletc").change(function(){
  var id = $(this).val();
  if(id == '1'){
    $("#status1").show();
    $("#status2").hide();
  }else   if(id == '2'){
      $("#status1").hide();
      $("#status2").show();
  }else   if(id == ''){
      $("#status1").hide();
      $("#status2").hide();
  }
});
CKEDITOR.replace( 'message_add' );
CKEDITOR.replace( 'message_add1' );
var id = 0;
$("#hid").hide();
  $("#update_status").click(function(){
    var a = $("#g-recaptcha-response").val();
    if(a == ""){
    $("#chk_a").html("<font style='color:red'><img src='img/validate.gif' width='20' heigth='20'>กรุณาคลิ๊กเพื่อยืนยัน</font>");
    }else{
    $("#chk_a").html("");
    }

    if(a != ""){
      var r = confirm("ยืนยันการลงทะเบียน");
      if (r == true) {
          $('#form_update').submit();
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
