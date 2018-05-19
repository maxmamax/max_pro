<?php include("include/connect.php"); session_start(); ?>
<?php
if($_SESSION['session_status_menu'] == 'student' ){
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
?>
<div class="panel panel-default">
  <div class="panel-heading"><h1><span class="glyphicon glyphicon-list" aria-hidden="true"></span> ข้อมูลสถานประกอบการสนใจ</h1></div>
  <div class="panel-body">
<?php
if($_GET['coop'] == ''){
?>
<table class="table table-bordered table-hover">
  <thead>
  <tr class="f1">
    <td>ลำดับ</td>
    <td>สถานประกอบการ</td>
    <td>รายละเอียด</td>
  </tr>
</thead>
<?php
$i=1;
$sql = "SELECT * FROM tb_reply_s as a INNER JOIN tb_cooperative as b ON (a.coop_keyf = b.coop_key)  WHERE student_keyf = '".$_SESSION['session_key']."' ";
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
    <td><a href="index.php?page=job_reply&coop=<?php echo $fet['coop_key']; ?>"><?php echo $fet['coop_Tname']; ?></a></td>
    <td><?php echo $fet['reply_detail']; ?></td>

  </tr>
<?php $i++;
}
?>
</table>
จำนวนข้อมูลทั้งหมด <?php echo $Num_Rows;?> ข้อมูล  จำนวนหน้าทั้งหมด <?php echo $Num_Pages; ?> หน้า :
<?php
if($Prev_Page)
{
echo " <a href='$_SERVER[SCRIPT_NAME]?page=job_reply&Page_data=$Prev_Page'><< ย้อนกลับ</a> ";
}
for($i=1; $i<=$Num_Pages; $i++){
if($i != $Page)
{
echo " <a href='$_SERVER[SCRIPT_NAME]?page=job_reply&Page_data=$i'><button class='btn btn-detail'>$i</button></a> ";
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
echo " <a href ='$_SERVER[SCRIPT_NAME]?page=job_reply&Page_data=$Next_Page'>ถัดไป>></a> ";
} ?>
    </div>
    </div>
<?php }else if($_GET['coop'] != ''){
$sql = mysql_query("SELECT * FROM tb_cooperative a  WHERE coop_key = '".$_GET['coop']."' ");
$fet = mysql_fetch_array($sql);
?>

<div class="panel panel-default">
  <div class="panel-heading f">สถานประกอบการ <?php echo "( ".$fet['coop_Tname']." ) "; ?></div>
  <div class="panel-body">
    <table class="table table-bordered f2">
      <tbody>
<!-- ข้อมูลสถานประกอบการ -->
        <tr>
          <td>ชื่อสถานประกอบการภาษาไทย</td>
          <td><?php echo $fet['coop_Tname']; ?></td>
            </tr>
        <tr>
          <td>ชื่อสถานประกอบการภาษาอังกฤษ</td>
          <td><?php echo $fet['coop_Ename']; ?></td>
        </tr>
           <tr>
          <tr>
          <td>ที่อยู่</td>
          <td><?php echo $fet['coop_address']." ตำบล ".$fet['coop_sdistrict']." อำเภอ ".$fet['coop_district']." จังหวัด ".$fet['coop_province']." รหัสไปรษณีย์ ".$fet['coop_code']; ?></td>
        </tr>
        <tr>
        <td>เบอร์โทรศัพท์</td>
        <td><span class="glyphicon glyphicon-phone" aria-hidden="true"></span> <?php echo $fet['coop_phone']; ?></td>
        </tr>
      <tr>
        <td>อีเมล</td>
        <td><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> <?php echo $fet['coop_email']; ?></td>
        </tr>
        <tr>
          <td>เว็บไซด์</td>
          <td><span class="glyphicon glyphicon-globe" aria-hidden="true"></span> <?php echo $fet['coop_web']; ?></td>
          </tr>
</tbody>
    </table>
  </div>
</div>

<?php } }  ?>
