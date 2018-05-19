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
    <div class="panel-heading"><h1><font><h1><span class="glyphicon glyphicon-list"></span> ข้อมูลประเมินการฝึกงานนักศึกษา</font></h1></div>
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
      <td>ข้อมูล</td>
    </tr>
  </thead>
<?php
$sql = "SELECT * FROM tb_student a , tb_position b , tb_register_job c WHERE a.faculty_keyf = '".$_POST['id']."' AND b.position_key = c.position_keyf AND c.job_status = '4' AND a.student_key = c.student_keyf $s ";
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
      <td><?php echo  (($Page-1)*10)+$i ; ?></td>
      <td><?php echo $fet['student_code']; ?></td>
      <td><?php echo $fet['student_name']." ".$fet['student_last']; ?></td>
      <td>
        <form class="" action="include/report6/report_student.php" method="post" target="_blank" style="margin-top:10px;" >
        <input type="hidden" name="key_student" value="<?php echo $fet['student_key']; ?>">
        <input type="hidden" name="key_position" value="<?php echo $fet['position_key']; ?>">
        <button type="submit" name="button" class="btn btn-success">ดูข้อมูล</button>
      </form>
      </td>
    </tr>
<?php } ?>
</table>
จำนวนข้อมูลทั้งหมด <?php echo $Num_Rows;?> ข้อมูล  จำนวนหน้าทั้งหมด <?php echo $Num_Pages; ?> หน้า :
<?php
if($Prev_Page)
{
echo " <a href='$_SERVER[SCRIPT_NAME]?page=job_select&Page_data=$Prev_Page'><< ย้อนกลับ</a> ";
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
echo " <a href ='$_SERVER[SCRIPT_NAME]?page=job_select&Page_data=$Next_Page'>ถัดไป>></a> ";
} ?>
</div>


    </div></div>

<?php
}else if($_POST['status'] == 'c'){ ?>
  <div class="panel panel-default">
    <div class="panel-heading"><h1><font>ข้อมูลประเมินการฝึกงานนักศึกษา</font></h1></div>
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
      <td>ข้อมูล</td>
    </tr>
  </thead>
<?php
$sql = "SELECT * FROM tb_student a , tb_position b , tb_register_job c WHERE a.course_key = '".$_POST['id']."' AND b.position_key = c.position_keyf AND c.job_status = '4' AND a.student_key = c.student_keyf $s";
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
      <td><?php echo  (($Page-1)*10)+$i ; ?></td>
      <td><?php echo $fet['student_code']; ?></td>
      <td><?php echo $fet['student_name']." ".$fet['student_last']; ?></td>
      <td>
        <form class="" action="include/report6/report_student.php" method="post" target="_blank" style="margin-top:10px;" >
        <input type="hidden" name="key_student" value="<?php echo $fet['student_key']; ?>">
        <input type="hidden" name="key_position" value="<?php echo $fet['position_key']; ?>">
        <button type="submit" name="button" class="btn btn-success">ดูข้อมูล</button>
      </form>
      </td>
    </tr>
<?php } ?>
</table>
จำนวนข้อมูลทั้งหมด <?php echo $Num_Rows;?> ข้อมูล  จำนวนหน้าทั้งหมด <?php echo $Num_Pages; ?> หน้า :
<?php
if($Prev_Page)
{
echo " <a href='$_SERVER[SCRIPT_NAME]?page=job_select&Page_data=$Prev_Page'><< ย้อนกลับ</a> ";
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
echo " <a href ='$_SERVER[SCRIPT_NAME]?page=job_select&Page_data=$Next_Page'>ถัดไป>></a> ";
} ?>
</div>


    </div></div>
<?php
  } ?>
  </div>
