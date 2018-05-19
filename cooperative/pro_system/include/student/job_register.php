<?php include("include/connect.php"); session_start(); date_default_timezone_set("Asia/Bangkok"); ?>
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
  function changeDate($date){
$get_date = explode("-",$date);
  $month = array("01"=>"ม.ค.","02"=>"ก.พ","03"=>"มี.ค.","04"=>"เม.ย.","05"=>"พ.ค.","06"=>"มิ.ย.","07"=>"ก.ค.","08"=>"ส.ค.","09"=>"ก.ย.","10"=>"ต.ค.","11"=>"พ.ย.","12"=>"ธ.ค.");
$get_month = $get_date["1"];
$year = $get_date["0"]+543;
return $get_date["2"]." ".$month[$get_month]." ".$year;
}
  function DateDiff($strDate1,$strDate2)
  {
       return (strtotime($strDate2) - strtotime($strDate1))/  ( 60 * 60 * 24 );  // 1 day = 60*60*24
  }
?>
<?php
if($_POST['delete'] != ""){
  //$sql = mysql_query("DELETE FROM tb_register_job WHERE register_key = '".$_POST['delete']."' ");
  echo $_POST['delete'];
}
?>
<div class="panel panel-default">
  <div class="panel-heading"><h1><span class="glyphicon glyphicon-list" aria-hidden="true"></span> ตำแหน่งงานที่จอง</h1></div>
  <div class="panel-body">
<div class="table-responsive">
<table class="table table-bordered table-hover f1">
  <thead>
  <tr>
    <td>ลำดับ</td>
    <td>สถานประกอบการ</td>
    <td>ตำแหน่งงาน</td>
    <td>วันที่จอง</td>
    <td>สถานะ</td>
  </tr>
</thead>
<?php
$i=1;
$sql = "SELECT * FROM tb_register_job as a
INNER JOIN tb_cooperative as b ON (a.coop_keyf = b.coop_key)
INNER JOIN  tb_position as c ON (a.position_keyf = c.position_key) WHERE a.student_keyf = '".$_SESSION['session_key']."' AND a.position_keyf = c.position_key ";
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
    <td><?php echo $fet['coop_Tname']; ?></td>
    <td>
      <a href="index.php?page=job_student&position=<?php echo $fet['position_key']; ?>"><?php echo $fet['position_name']; ?></a>
    <?php
    $dateS = date("Y-m-d");
    $dateL = $fet['position_dateL'];
    $d =  DateDiff("$dateS","$dateL");
    if($d<0){
      echo "<br><span><font style='color:red'>*ตำแหน่งงานนี้ปิดรับสมัครแล้ว</font></span>";
    }
    ?>
    </td>
    <td><?php echo changeDate($fet['job_date']); ?></td>
    <td>
<div>
    <?php
echo "สถานะ : ";
if($fet['job_status'] == '0'){
echo "รอการตรวจสอบ";
?>
<form class="" action="index.php?page=job_register" method="post" style="margin-top:10px;">
<button id="delete" type="button" name="button"  value="<?php echo $fet['register_key']; ?>" class="btn btn-danger" aria-hidden="true" data-toggle="tooltip" title="คลิ๊กเพื่อยกเลิกข้อมูลตำแหน่งงาน"><span class="glyphicon glyphicon-remove"></span> ยกเลิกตำแหน่งงาน</button>
</form>
<?php
}else if($fet['job_status'] == '1'){
  echo "นัดสอบสอบสัมภาษณ์";
}else if($fet['job_status'] == '2'){
  echo "ไม่ผ่านการสัมภาษณ์งาน";
}else if($fet['job_status'] == '3'){
  echo "ผ่านการคัดเลือกฝึกปฏิบัติงาน";
}else if($fet['job_status'] == '4'){
  echo "การฝึกปฏิบัติงาน";
}
     ?>
     <div style="margin-top:10px;">
       <button type="button" value="<?php echo $fet['position_key']; ?>" id="preview_status" class="btn btn-default"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> ดูข้อมูลสถานะ</button>
<?php if($fet['job_status'] == '3'){ ?>
  <br>
       <form action="include\student\confirm_position.php" method="post" id="form_confirm" style="margin-top:10px;">
        <input type="hidden" name="key_position" value="<?php echo $fet['position_key']; ?>" >
       <button class="btn btn-success" id="confirm_position" type="button">ยืนยันการฝึกปฏิบัติงาน</button>
     </form>
<?php } ?>
     </div>
     </div>
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
echo " <a href='$_SERVER[SCRIPT_NAME]?page=job_register&Page_data=$Prev_Page'><< ย้อนกลับ</a> ";
}
for($i=1; $i<=$Num_Pages; $i++){
if($i != $Page)
{
echo " <a href='$_SERVER[SCRIPT_NAME]?page=job_register&Page_data=$i'><button class='btn btn-detail'>$i</button></a> ";
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
echo " <a href ='$_SERVER[SCRIPT_NAME]?page=job_register&Page_data=$Next_Page'>ถัดไป>></a> ";
} ?>
    </div>
    </div>
<?php } ?>


<script type="text/javascript">

$("#confirm_position").click(function(){
  var r = confirm("ยืนยันการฝึกปฏิบัติงานตำแหน่งงานนี้หรือไม่ \n *หมายเหตุที่มีการยืนยันแล้วจะไม่สามารถแก้ไขข้อมูลได้");
  if (r == true) {
$('#form_confirm').submit();
  }
});
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
$("[id^=delete]").click(function(){
  var r = confirm("ยืนยันการลบข้อมูลตำแหน่งงานหรือไม่");
  if (r == true) {
    var id = $(this).val();
    $.post('include/cooperative/delete_position.php',{
      id : id
    },function(){
location.reload();
    });
  }
});

$('[id^=preview_status]').click(function(){
  var id = $(this).val();
  window.open("include/student/preview_status.php?id="+id, "", "width=1000,height=500");
});
</script>
