<?php session_start(); ob_start(); ?>

<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
้<head>
  <style type="text/css">
  .dotshed { border-bottom: 1px dotted;  }
  </style>
</head>
<?php
require_once('mpdf/mpdf.php'); //ที่อยู่ของไฟล์ mpdf.php ในเครื่องเรานะครับ
ob_start(); // ทำการเก็บค่า html นะครับ
?>

<?php
mysql_connect("localhost","root","max123456");
mysql_select_db("tb_cooperative");
mysql_query("SET NAMES UTF8");
$sql = mysql_query("SELECT * FROM  tb_cooperative a , tb_position b WHERE a.coop_key = '".$_SESSION['session_key']."' AND b.position_key = '".$_POST['key_position']."' ");
$fet = mysql_fetch_array($sql);
if($fet){
?>

<table >

  <tr>
    <td  width="550px;">
    <div >
      <font>ศูนย์สหกิจศึกษาและพัฒนาอาชีพ มหาวิทยาลัยราชภัฎกาญจนบุรี</font> <br>
      <font>THE CENTER FOR COOPERATIVE EDUCATION</font> <br> <br>
      <font style="font-size:20px;;">แบบแจ้งรายชื่อนักศึกษาที่ผ่านการคัดเลือก</font> <br><br>
      ชื่อสถานประกอบการ : <u> <?php echo $fet['coop_Tname']; ?></u> <br>
      ตำแหน่งงาน : <u> <?php echo $fet['position_name']; ?></u> <br>
      ที่อยู่: <u> <?php echo $fet['coop_address']." "." ตำบล ".$fet['coop_sdistrict']." อำเภอ ".$fet['coop_district']." จังหวัด ".$fet['coop_province']." รหัสไปรษณีย์ ".$fet['coop_code']; ?></u> <br>
      โทรศัพท์ : <u> <?php echo $fet['coop_phone']; ?></u> <br>
    </div>
    </td>
    <td valign="top"><img src="KRU.gif" width="100px" heigth="100px"></td>
  </tr>
</table>

<div class="" style="text-align:center;margin-top:20px;">
<font style="font-size:25px;"><u>นักศึกษาที่ผ่านการคัดเลือก</u></font>
</div>


<div  style="display:block; border:#000 solid 1px;margin-top:20px;">

<table>
  <tr style="display:block; border:#000 solid 1px;text-align:center;">
    <td style="display:block; border:#000 solid 1px;text-align:center;background-color:#f5f5f5;font-size:20px;" width="100px;">ลำดับที่</td>
    <td style="display:block; border:#000 solid 1px;text-align:center;background-color:#f5f5f5;font-size:20px;" width="100px;">วัน เดือน ปี</td>
    <td style="display:block; border:#000 solid 1px;text-align:center;background-color:#f5f5f5;font-size:20px;" width="100px;">เวลา</td>
    <td style="display:block; border:#000 solid 1px;text-align:center;background-color:#f5f5f5;font-size:20px;"  width="200px;">ชื่อ - นามสกุลนักศึกษา</td>
    <td style="display:block; border:#000 solid 1px;text-align:center;background-color:#f5f5f5;font-size:20px;" width="100px;">สาขาวิชา</td>
    <td style="display:block; border:#000 solid 1px;text-align:center;background-color:#f5f5f5;font-size:20px;" width="100px;">รายละเอียด</td>
  </tr>
  <?php
  $sql = mysql_query("SELECT * FROM tb_practice WHERE position_keyf = '".$_POST['key_position']."' ");
  while($fet = mysql_fetch_array($sql)){
  $sql1 = mysql_query("SELECT * FROM tb_register_job a , tb_student b , tb_course c WHERE a.job_status = '3' AND b.student_key = '".$fet['student_keyf']."' AND b.course_key = c.course_key AND b.student_key = a.student_keyf   ");
  while($fet1 = mysql_fetch_array($sql1)){
    ?>

  <tr style="display:block; border:#000 solid 1px;text-align:center;">
    <td style="display:block; border:#000 solid 1px;text-align:center;" width="100px;"><?php echo $i+1;?></td>
    <td style="display:block; border:#000 solid 1px;text-align:center;" width="100px;"><?php echo $fet['prac_date'];?></td>
    <td style="display:block; border:#000 solid 1px;text-align:center;" width="100px;"><?php echo $fet['prac_time'];?></td>
    <td style="display:block; border:#000 solid 1px;text-align:center;"  width="250px;"><?php echo $fet1['student_name'].$fet1['student_last']; ?></td>
    <td style="display:block; border:#000 solid 1px;text-align:center;" width="150px;"><?php echo $fet1['course_name']; ?></td>
    <td style="display:block; border:#000 solid 1px;text-align:center;" width="150px;"><?php echo $fet['prac_note']; ?></td>

  </tr>

<?php $i++; } } ?>
</table>
</div>


<div class="" style="margin-top:50px;margin-left:300px;">
  <div >
    ลงนามผู้สมัคร ..............................................<br>
            <div style="margin-left:80px;">  (________________________) </div>
            <div  style="margin-left:80px;">  วันที่ ...........................................</div>

  </div>

</div>
</div>
<div style="height:50px;
	position:fixed;
	left:0px;
	bottom:0px;
	width:100%;
	z-index: 99;
	">

<div class="" style="width:100%;height:1px;background-color:black">

</div>
<div class="">ศูนย์สหกิจศึกษาและพัฒนาอาชีพ มหาวิทยาลัยราชภัฏกาญจนบุรี</div>
<div>โทรศัพท์ 0 3463 3227 โทรสาร   E-mail: <u>cooperative.kru@gmail.com</u> www.cooperative.kru.ac.th</div>
</div>
</div>
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
<!--ดาวโหลดรายงานในรูปแบบ PDF <a href="mpdf/ทดสอบการ.pdf" >คลิกที่นี้</a>
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
