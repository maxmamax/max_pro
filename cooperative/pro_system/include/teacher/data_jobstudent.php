<?php include("include/connect.php"); session_start(); ?>

<?php

function changeDate($date){
$get_date = explode("-",$date);
  $month = array("01"=>"ม.ค.","02"=>"ก.พ","03"=>"มี.ค.","04"=>"เม.ย.","05"=>"พ.ค.","06"=>"มิ.ย.","07"=>"ก.ค.","08"=>"ส.ค.","09"=>"ก.ย.","10"=>"ต.ค.","11"=>"พ.ย.","12"=>"ธ.ค.");
$get_month = $get_date["1"];
$year = $get_date["0"]+543;
return $get_date["2"]." ".$month[$get_month]." ".$year;
}

if($_POST['status'] == 'f'){ ?>
  <div class="panel panel-default">
    <div class="panel-heading"><h1><font><span class="glyphicon glyphicon-list"></span> ข้อมูลการจองตำแหน่งงานของนักศึกษา</font></h1></div>
    <div class="panel-body">
    <form action="" method="post">
  <div class="form-group row">
    <div class="col-md-2 ">
      <?php
      if($_POST['s'] != ""){
        $s = " AND a.student_name LIKE '%".$_POST['s']."%'  ";
      }
      ?>
      <label for="">ค้นหานักศึกษา</label>
      <input type="hidden" name="id" value="<?php echo $_POST['id']; ?>">
      <input type="hidden" name="status" value="<?php echo $_POST['status']; ?>">
      <input type="text" name="s" value="<?php echo $_POST['s']; ?>" class="form-control" placeholder="ชื่อนักศึกษา">
    </div>
    <div class="col-md-2 ">
      <label for="">ค้นหานักศึกษา</label><br>
      <input type="submit" value="ค้นหา" class="btn btn-success" >
    </div>
  </div>
</form>
<div class="table-responsive">

<table class="table table-bordered table-hover">
  <thead>
  <tr class="f1">
    <td>ลำดับ</td>
    <td>รหัสนักศึกษา</td>
    <td>ชื่อนักศึกษา</td>
    <td>คณะ</td>
    <td>จำนวนการจองตำแหน่งงงาน</td>
    <td>ข้อมูล</td>
  </tr>
</thead>
<?php
$sql = "SELECT * FROM tb_student a ,  tb_faculty b WHERE a.faculty_keyf = '".$_POST['id']."' AND b.faculty_key = '".$_POST['id']."' AND a.student_status = '2'   $s ";
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
$sql1 = mysql_query("SELECT count(register_key) as num FROM  tb_register_job WHERE student_keyf =  '".$fet['student_key']."' ");
$fet1 = mysql_fetch_array($sql1);
?>
  <tr class="f2">
    <td><?php echo  (($Page-1)*10)+$i ; ?></td>
    <td><?php echo $fet['student_code']; ?></td>
    <td><?php echo $fet['student_name']." ".$fet['student_last']; ?></td>
    <td><?php echo $fet['faculty_name']; ?></td>
    <td><?php echo $fet1['num']; ?></td>
    <td>
      <button class="btn btn-success" data-toggle="collapse" data-target="#demo<?php echo $i; ?>" >ดูข้อมูล</button></td>
  </tr>
  <tr>
    <td colspan="6">
      <div id="demo<?php echo $i; ?>" class="collapse">
      <?php
      $sql2 = mysql_query("SELECT * FROM tb_register_job a , tb_position b , tb_type_ope c , tb_cooperative e  WHERE a.student_keyf = '".$fet['student_key']."' AND a.position_keyf = b.position_key AND b.position_typef = c.type_key AND b.coop_keyf = e.coop_key ");
      while ($fet2 = mysql_fetch_array($sql2)) {
      if($fet2){
      ?>
      <div class="panel panel-default">
        <div class="panel-heading">
          ตำหน่งงาน <?php echo $fet2['position_name']; ?>
          <form style="margin-top:5px;" class="" action="include/report3/report_student.php" method="post" target="_blank">
            <input type="hidden" name="key_student" value="<?php echo $fet['student_key']; ?>">
            <input type="hidden" name="key_position" value="<?php echo $fet2['position_key']; ?>">
            <button class="btn btn-danger" type="submit"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> พิมพ์ใบสมัครงานนักศึกษา</button></h1>
          </form>
        </div>
        <div class="panel-body">
          <table class="table table-bordered">
            <tr>
              <td width="150px;">ตำแหน่งงาน : </td>
              <td><?php echo $fet2['position_name']; ?></td>
            </tr>
            <tr>
              <td >วันที่เปิดรับสมัคร : </td>
              <td><?php echo changeDate($fet2['position_dateF']); ?></td>
            </tr>
            <tr>
              <td >วันที่ปิดรับสมัคร : </td>
              <td><?php echo changeDate($fet2['position_dateL']); ?></td>
            </tr>
            <tr>
              <td >จำนวนที่รับสมัคร : </td>
              <td><?php echo $fet2['position_register']; ?></td>
            </tr>
            <tr>
                <td >จำนวนที่สมัคร : </td>
                <td><?php echo $fet2['position_rate']; ?></td>
              </tr>
          </table>
          <table class="table table-bordered">
            <tr>
              <td>คุณสมบัติ</td>
            </tr>
            <tr>
              <td width="150px">เพศ :</td>
              <td><?php
              if($fet2['position_sex'] == '1'){
                echo "ชาย";
              }else if($fet2['position_sex'] == '2'){
                  echo "หญิง";
              }else if($fet2['position_sex'] == '3'){
                  echo "ชายและหญิง";
              }
              ?></td>
            </tr>
            <tr>
              <td>อายุ :</td>
              <td><?php echo $fet2['position_old']." ปี "; ?></td>
            </tr>
            <tr>
              <td>วุฒิการศึกษา	 :</td>
              <td>
                <?php
                if($fet2['position_edu'] == '1' ){
                  echo "ระดับมัธยมศึกษาปีที่6";
                }else if($fet2['position_edu'] == '2' ){
                  echo "ระดับปวช/ระดับปวส";
                }else if($fet2['position_edu'] == '3' ){
                  echo "ระดับปริญญาตรี";
                }else if($fet2['position_edu'] == '4' ){
                  echo "ระดับปริญญาโท";
                }else if($fet2['position_edu'] == '5' ){
                  echo $fet2['position_eduorter'];
                }
                ?>
              </td>
            </tr>
            <tr>
              <td>ข้อมูลคุณสมบัติอื่นๆ</td>
              <td><?php echo $fet2['message_add']; ?></td>
            </tr>
          </table>
          <table class="table table-bordered">
            <tr>
              <td width="200px">สวัสดีการ</td>
            </tr>
            <tr>
              <td></td>
              <td>
                <?php if($fet2['position_bonus'] == "1"){ ?>
                  <img src="img/chk_y.jpg">
                <?php }else{ ?>
                  <img src="img/chk_n.jpg">
                <?php  } ?>   โบนัส
              </td>
              <td>
                <?php if($fet2['position_acco'] == "1"){ ?>
                  <img src="img/chk_y.jpg">
                <?php }else{ ?>
                  <img src="img/chk_n.jpg">
                <?php  } ?>   ที่พัก
              </td>
              <td>
                <?php if($fet2['position_uniform'] == "1"){ ?>
                  <img src="img/chk_y.jpg">
                <?php }else{ ?>
                  <img src="img/chk_n.jpg">
                <?php  } ?>   ชุดฟอร์มพนักงาน
              </td>
              <td>
                <?php if($fet2['position_diligence'] == "1"){ ?>
                  <img src="img/chk_y.jpg">
                <?php }else{ ?>
                  <img src="img/chk_n.jpg">
                <?php  } ?>   เบี้ยขยัน
              </td>
              <td>
                <?php if($fet2['position_medical'] == "1"){ ?>
                  <img src="img/chk_y.jpg">
                <?php }else{ ?>
                  <img src="img/chk_n.jpg">
                <?php  } ?>   ค่ารักษาพยาบาล
              </td>
            </tr>
            <tr>
              <td>ข้อมูลคุณสวัสดีการอื่นๆ</td>
              <td><?php echo $fet2['message_add1']; ?></td>
            </tr>
          </table>


            <table class="table table-bordered">
              <tr>
                <td width="180px;">สถานะ</td>
                <td>
                  <?php if($fet2['job_status'] == '0'){echo "การตรวจสอบ";
                  }else if($fet2['job_status'] == '1'){ echo "นัดสัมภาษณ์งาน";
                  }else if($fet2['job_status'] == '2'){ echo "ไม่ผ่านการสัมภาษณ์งาน";
                  }else if($fet2['job_status'] == '3'){ echo "่ผ่านการสัมภาษณ์งาน";
                  }?>                  </td>                </tr>
                  <?php
                  $sql3 = mysql_query("SELECT * FROM tb_interview  WHERE student_keyf = '".$fet2['student_keyf']."' AND position_keyf = '".$fet2['position_keyf']."'  ");
                  $fet3 = mysql_fetch_array($sql3);
                  ?>
                  <tr  width="100px;">
                    <td>การนัดสัมภาษณ์</td>
                  </tr>
                  <tr  width="100px;">
                    <td>ยืนยันวันที่</td>
                    <td><?php echo changeDate($fet3['iter_datecon']); ?></td>
                  </tr>
                    <tr  width="100px;">
                      <td>สถานที่สัมภาษณ์</td>
                      <td><?php echo $fet3['inter_place']; ?></td>
                    </tr>
                    <tr  width="100px;">
                      <td>วันที่สัมภาษณ์</td>
                      <td><?php echo changeDate($fet3['inter_date']); ?></td>
                    </tr>
                    <tr  width="100px;">
                      <td>เวลาที่สัมภาษณ์</td>
                      <td><?php echo changeDate($fet3['inter_time']); ?></td>
                    </tr>
                    <tr  width="100px;">
                    <td>สิ่งที่ต้องเตรียมมาสัมภาษณ์</td>
                    <td><?php echo $fet3['inter_note']; ?></td>
                  </tr>
                </table>
                <table class="table table-bordered">
                  <tr>
                    <td width="180px;">ผลการสัมภาษณ์</td>
                    <td>
                      <?php
                      if($fet2['job_status'] == '1'){echo "อยู่ในระหว่างรอการสัมภาษณ์";
                      }else if($fet2['job_status'] == '2'){ echo "ไม่ผ่านการสัมภาษณ์";
                      }else if($fet2['job_status'] == '3'){ echo "ผ่านการสัมภาษณ์";
                      }?>
                    </td>
                  </tr>
                  <?php
                  $sql3 = mysql_query("SELECT * FROM tb_practice  WHERE student_keyf = '".$fet2['student_keyf']."' AND position_keyf = '".$fet2['position_keyf']."'  ");
                  $fet3 = mysql_fetch_array($sql3);
                  ?>
                  <tr>
                    <td>ยืนยันวันที่</td>
                    <td><?php echo changeDate($fet3['prac_datecon']); ?></td>
                  </tr>
                  <tr>
                    <td>วันที่ฝึกปฏิบัติงาน</td>
                    <td><?php echo changeDate($fet3['prac_date']); ?></td>
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
        </div>
      </div>
    <?php }
          } ?>
      </div>
    </td>

  </tr>
<?php $i++; } ?>

</table>
</div>
จำนวนข้อมูลทั้งหมด <?php echo $Num_Rows;?> ข้อมูล  จำนวนหน้าทั้งหมด <?php echo $Num_Pages; ?> หน้า :
<?php
if($Prev_Page)
{
echo " <a href='$_SERVER[SCRIPT_NAME]?page=job_student&Page_data=$Prev_Page&s_coop=$_GET[s_coop]&s_position=$_GET[s_position]&s_type=$_GET[s_type]&s_s=$_GET[s_ss]'><< ย้อนกลับ</a> ";
}
for($i=1; $i<=$Num_Pages; $i++){
if($i != $Page)
{
echo " <a href='$_SERVER[SCRIPT_NAME]?page=job_student&Page_data=$i&s_coop=$_GET[s_coop]&s_position=$_GET[s_position]&s_type=$_GET[s_type]&s_s=$_GET[s_ss]'><button class='btn btn-detail'>$i</button></a> ";
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
echo " <a href ='$_SERVER[SCRIPT_NAME]?page=job_student&Page_data=$Next_Page&s_coop=$_GET[s_coop]&s_position=$_GET[s_position]&s_type=$_GET[s_type]&s_s=$_GET[s_ss]'>ถัดไป>></a> ";
} ?>

    </div></div>

<?php
}else if($_POST['status'] == 'c'){ ?>

  <div class="panel panel-default">
    <div class="panel-heading"><h1><span class="glyphicon glyphicon-list"></span> ข้อมูลการจองตำแหน่งงานของนักศึกษา</h1></div>
    <div class="panel-body">

  <table class="table table-bordered table-hover">
    <thead>
  <tr class="f1">
    <td>ลำดับ</td>
    <td>รหัสนักศึกษา</td>
    <td>ชื่อนักศึกษา</td>
    <td>สาขา</td>
    <td>จำนวนการจองตำแหน่งงงาน</td>
    <td>ข้อมูล</td>
  </tr>
</thead>
  <?php
  $sql = "SELECT * FROM tb_student a ,  tb_course b WHERE a.course_key = '".$_POST['id']."' AND b.course_key = '".$_POST['id']."' AND a.student_status = '2'  ";
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

  while($fet = mysql_Fetch_array($objQuery)){
  $sql = mysql_query("SELECT count(register_key) as num FROM  tb_register_job WHERE student_keyf =  '".$fet['student_key']."'  ");
  $fet1 = mysql_fetch_array($sql);

  ?>
  <tr class="f2">
    <td><?php echo (($Page-1)*10)+$i ; ?></td>
    <td><?php echo $fet['student_code']; ?></td>
    <td><?php echo $fet['student_name']." ".$fet['student_last']; ?></td>
    <td><?php echo $fet['course_name']; ?></td>
    <td><?php echo $fet1['num']; ?></td>
    <td><button class="btn btn-success"  data-toggle="collapse" data-target="#demo<?php echo $i; ?>"  >ดูข้อมูล</button></td>
  </tr>
  <tr>
    <td colspan="6">
      <div id="demo<?php echo $i; ?>" class="collapse">
      <?php
      $sql2 = mysql_query("SELECT * FROM tb_register_job a , tb_position b , tb_type_ope c , tb_cooperative e  WHERE a.student_keyf = '".$fet['student_key']."' AND a.position_keyf = b.position_key AND b.position_typef = c.type_key AND b.coop_keyf = e.coop_key ");
      while ($fet2 = mysql_fetch_array($sql2)) {
      if($fet2){
      ?>
      <div class="panel panel-default">
        <div class="panel-heading">
          ตำหน่งงาน <?php echo $fet2['position_name']; ?>
          <form style="margin-top:5px;" class="" action="include/report3/report_student.php" method="post" target="_blank">
            <input type="hidden" name="key_student" value="<?php echo $fet['student_key']; ?>">
            <input type="hidden" name="key_position" value="<?php echo $fet2['position_key']; ?>">
            <button class="btn btn-danger" type="submit"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> พิมพ์ใบสมัครงานนักศึกษา</button></h1>
          </form>

        </div>
        <div class="panel-body">
          <table class="table table-bordered">
            <tr>
              <td width="150px;">ตำแหน่งงาน : </td>
              <td><?php echo $fet2['position_name']; ?></td>
            </tr>
            <tr>
              <td >วันที่เปิดรับสมัคร : </td>
              <td><?php echo changeDate($fet2['position_dateF']); ?></td>
            </tr>
            <tr>
              <td >วันที่ปิดรับสมัคร : </td>
              <td><?php echo changeDate($fet2['position_dateL']); ?></td>
            </tr>
            <tr>
              <td >จำนวนที่รับสมัคร : </td>
              <td><?php echo $fet2['position_register']; ?></td>
            </tr>
            <tr>
                <td >จำนวนที่สมัคร : </td>
                <td><?php echo $fet2['position_rate']; ?></td>
              </tr>
          </table>
          <table class="table table-bordered">
            <tr>
              <td>คุณสมบัติ</td>
            </tr>
            <tr>
              <td width="150px">เพศ :</td>
              <td><?php
              if($fet2['position_sex'] == '1'){
                echo "ชาย";
              }else if($fet2['position_sex'] == '2'){
                  echo "หญิง";
              }else if($fet2['position_sex'] == '3'){
                  echo "ชายและหญิง";
              }
              ?></td>
            </tr>
            <tr>
              <td>อายุ :</td>
              <td><?php echo $fet2['position_old']." ปี "; ?></td>
            </tr>
            <tr>
              <td>วุฒิการศึกษา	 :</td>
              <td>
                <?php
                if($fet2['position_edu'] == '1' ){
                  echo "ระดับมัธยมศึกษาปีที่6";
                }else if($fet2['position_edu'] == '2' ){
                  echo "ระดับปวช/ระดับปวส";
                }else if($fet2['position_edu'] == '3' ){
                  echo "ระดับปริญญาตรี";
                }else if($fet2['position_edu'] == '4' ){
                  echo "ระดับปริญญาโท";
                }else if($fet2['position_edu'] == '5' ){
                  echo $fet2['position_eduorter'];
                }
                ?>
              </td>
            </tr>
            <tr>
              <td>ข้อมูลคุณสมบัติอื่นๆ</td>
              <td><?php echo $fet2['message_add']; ?></td>
            </tr>
          </table>
          <table class="table table-bordered">
            <tr>
              <td width="150px">สวัสดีการ</td>
            </tr>
            <tr>
              <td></td>
              <td>
                <?php if($fet2['position_bonus'] == "1"){ ?>
                  <img src="img/chk_y.jpg">
                <?php }else{ ?>
                  <img src="img/chk_n.jpg">
                <?php  } ?>   โบนัส
              </td>
              <td>
                <?php if($fet2['position_acco'] == "1"){ ?>
                  <img src="img/chk_y.jpg">
                <?php }else{ ?>
                  <img src="img/chk_n.jpg">
                <?php  } ?>   ที่พัก
              </td>
              <td>
                <?php if($fet2['position_uniform'] == "1"){ ?>
                  <img src="img/chk_y.jpg">
                <?php }else{ ?>
                  <img src="img/chk_n.jpg">
                <?php  } ?>   ชุดฟอร์มพนักงาน
              </td>
              <td>
                <?php if($fet2['position_diligence'] == "1"){ ?>
                  <img src="img/chk_y.jpg">
                <?php }else{ ?>
                  <img src="img/chk_n.jpg">
                <?php  } ?>   เบี้ยขยัน
              </td>
              <td>
                <?php if($fet2['position_medical'] == "1"){ ?>
                  <img src="img/chk_y.jpg">
                <?php }else{ ?>
                  <img src="img/chk_n.jpg">
                <?php  } ?>   ค่ารักษาพยาบาล
              </td>
            </tr>
            <tr>
              <td>ข้อมูลคุณสมบัติอื่นๆ</td>
              <td><?php echo $fet2['message_add1']; ?></td>
            </tr>
          </table>
            <table class="table table-bordered">
              <tr>
                <td width="180px;">สถานะ</td>
                <td>
                  <?php if($fet2['job_status'] == '0'){echo "การตรวจสอบ";
                  }else if($fet2['job_status'] == '1'){ echo "นัดสัมภาษณ์งาน";
                  }else if($fet2['job_status'] == '2'){ echo "ไม่ผ่านการสัมภาษณ์งาน";
                  }else if($fet2['job_status'] == '3'){ echo "่ผ่านการสัมภาษณ์งาน";
                  }?>                  </td>                </tr>
                  <?php
                  $sql3 = mysql_query("SELECT * FROM tb_interview  WHERE student_keyf = '".$fet2['student_keyf']."' AND position_keyf = '".$fet2['position_keyf']."'  ");
                  $fet3 = mysql_fetch_array($sql3);
                  ?>
                  <tr  width="100px;">
                    <td>การนัดสัมภาษณ์</td>
                  </tr>
                  <tr  width="100px;">
                    <td>ยืนยันวันที่</td>
                    <td><?php echo changeDate($fet3['iter_datecon']); ?></td>
                  </tr>
                    <tr  width="100px;">
                      <td>สถานที่สัมภาษณ์</td>
                      <td><?php echo $fet3['inter_place']; ?></td>
                    </tr>
                    <tr  width="100px;">
                      <td>วันที่สัมภาษณ์</td>
                      <td><?php echo changeDate($fet3['inter_date']); ?></td>
                    </tr>
                    <tr  width="100px;">
                      <td>เวลาที่สัมภาษณ์</td>
                      <td><?php echo $fet3['inter_time']; ?></td>
                    </tr>
                    <tr  width="100px;">
                    <td>สิ่งที่ต้องเตรียมมาสัมภาษณ์</td>
                    <td><?php echo $fet3['inter_note']; ?></td>
                  </tr>
                </table>
                <table class="table table-bordered">
                  <tr>
                    <td width="180px;">ผลการสัมภาษณ์</td>
                    <td>
                      <?php
                      if($fet2['job_status'] == '1'){echo "อยู่ในระหว่างรอการสัมภาษณ์";
                      }else if($fet2['job_status'] == '2'){ echo "ไม่ผ่านการสัมภาษณ์";
                      }else if($fet2['job_status'] == '3'){ echo "ผ่านการสัมภาษณ์";
                      }?>
                    </td>
                  </tr>
                  <?php
                  $sql3 = mysql_query("SELECT * FROM tb_practice  WHERE student_keyf = '".$fet2['student_keyf']."' AND position_keyf = '".$fet2['position_keyf']."'  ");
                  $fet3 = mysql_fetch_array($sql3);
                  ?>
                  <tr>
                    <td>ยืนยันวันที่</td>
                    <td><?php echo changeDate($fet3['prac_datecon']); ?></td>
                  </tr>
                  <tr>
                    <td>วันที่ฝึกปฏิบัติงาน</td>
                    <td><?php echo changeDate($fet3['prac_date']); ?></td>
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
        </div>
      </div>
    <?php }
          } ?>
      </div>
    </td>

  </tr>
  <?php $i++; } ?>
  </table>
    </div>
    จำนวนข้อมูลทั้งหมด <?php echo $Num_Rows;?> ข้อมูล  จำนวนหน้าทั้งหมด <?php echo $Num_Pages; ?> หน้า :
    <?php
    if($Prev_Page)
    {
    echo " <a href='$_SERVER[SCRIPT_NAME]?page=job_student&Page_data=$Prev_Page&s_coop=$_GET[s_coop]&s_position=$_GET[s_position]&s_type=$_GET[s_type]&s_s=$_GET[s_ss]'><< ย้อนกลับ</a> ";
    }
    for($i=1; $i<=$Num_Pages; $i++){
    if($i != $Page)
    {
    echo " <a href='$_SERVER[SCRIPT_NAME]?page=job_student&Page_data=$i&s_coop=$_GET[s_coop]&s_position=$_GET[s_position]&s_type=$_GET[s_type]&s_s=$_GET[s_ss]'><button class='btn btn-detail'>$i</button></a> ";
  }}} ?>
  </div>
