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
?>
<?php if($_SESSION['session_status_menu'] == 'cooperative' && $_GET['position'] == '' ){ ?>

<div class="panel panel-default">
  <div class="panel-heading"><h1><span class="glyphicon glyphicon-list" aria-hidden="true"></span> ข้อมูลนักศึกษาผ่านการคัดเลือก</h1></div>
  <div class="panel-body">
    <div class="table-responsive">

<table class="table table-bordered table-hover">
  <thead>
  <tr class="f1">
    <td >ลำดับ</td>
    <td >ตำแหน่งงาน</td>
    <td >จำนวนนักศึกษาที่สอบสัมภาษณ์</td>
  </tr>
</thead>
<?php
$sql = "SELECT * FROM tb_position a ,  tb_register_job b   WHERE  a.position_key = b.position_keyf AND  b.coop_keyf = '".$_SESSION['session_key']."' AND b.job_status = '3' AND a.coop_keyf = '".$_SESSION['session_key']."'  GROUP BY position_keyf ";
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
  $sql1 = mysql_query("SELECT count(prac_id) as num FROM  tb_practice    WHERE position_keyf = '".$fet['position_key']."' ");
$fet1 = mysql_fetch_array($sql1);
?>
  <tr class="f2">
    <td ><?php echo  (($Page-1)*10)+$i ; ?></td>
    <td ><a href="index.php?page=job_studentselectview&key=<?php echo $fet['position_key'];?>"><?php echo $fet['position_name']; ?></a></td>
    <td ><?php echo $fet1['num']; ?></td>
  </tr>
<?php
$i++;
}
?>

</table>
    </div>
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
    </div>
<?php } ?>
<script type="text/javascript">

</script>
