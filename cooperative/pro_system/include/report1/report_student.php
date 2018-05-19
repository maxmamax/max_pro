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
    <td width="550px;">
    <div>
      <font>
        ศูนย์สหกิจศึกษาและพัฒนาอาชีพ มหาวิทยาลัยราชภัฎกาญจนบุรี <br>
        THE CENTER FOR COOPERATIVE EDUCATIO <br>
        แบบแจ้งสอบสัมภาษณ์จากสถานประกอบการ <br><br>
        ชื่อสถานประกอบการ : <u> <?php echo $fet['coop_Tname']; ?></u>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ตำแหน่ง : <u> <?php echo $fet['position_name']; ?></u> <br>
        โทรศัพท์ : <u> <?php echo $fet['coop_phone']; ?></u>
      </font> </div>
    </td>
    <td><div style="margin-left:500px"><img src="KRU.gif" width="100px" heigth="100px"></div></td>
  </tr>
</table>

<div  style="display:block; border:#000 solid 1px;margin-top:30px;">
<div class="" style="text-align:center;background-color:#f5f5f5;width:100%;height:30px;font-size:20px">กำหนดการสัมภาษณ์</div>
<table>
  <tr style="display:block; border:#000 solid 1px;text-align:center;;">
    <td style="display:block; border:#000 solid 1px;text-align:center;font-size:20px" width="100px;">ที่</td>
    <td style="display:block; border:#000 solid 1px;text-align:center;font-size:20px" width="100px;">วัน เดือน ปี</td>
    <td style="display:block; border:#000 solid 1px;text-align:center;font-size:20px" width="100px;">เวลา</td>
    <td style="display:block; border:#000 solid 1px;text-align:center;font-size:20px"  width="200px;">ชื่อ - นามสกุลนักศึกษา</td>
    <td style="display:block; border:#000 solid 1px;text-align:center;font-size:20px"  width="200px;">สถานที่สัมภาษณ์</td>
    <td style="display:block; border:#000 solid 1px;text-align:center;font-size:20px" width="100px;">สิ่งที่จะต้องเเตรียม</td>
  </tr>
<?php
$sql = mysql_query("SELECT * FROM tb_interview WHERE position_keyf = '".$_POST['key_position']."' ");
while($fet = mysql_fetch_array($sql)){
$sql1 = mysql_query("SELECT * FROM tb_interview a  , tb_student b WHERE a.inter_id = '".$fet['inter_id']."' AND b.student_key = '".$fet['student_keyf']."' ");
while($fet1 = mysql_fetch_array($sql1)){
?>
  <tr style="display:block; border:#000 solid 1px;text-align:center;">
    <td style="display:block; border:#000 solid 1px;text-align:center;" width="100px;"><?php echo $i+1; ?></td>
    <td style="display:block; border:#000 solid 1px;text-align:center;" width="100px;"><?php echo $fet1['inter_date']; ?></td>
    <td style="display:block; border:#000 solid 1px;text-align:center;" width="100px;"><?php echo $fet1['inter_time']."น."; ?></td>
    <td style="display:block; border:#000 solid 1px;text-align:center;"  width="200px;"><?php echo $fet1['student_name']." ".$fet1['student_last']; ?></td>
    <td style="display:block; border:#000 solid 1px;text-align:center;" width="100px;"><?php echo $fet1['inter_place']; ?></td>
    <td style="display:block; border:#000 solid 1px;text-align:center;" width="100px;"><?php echo $fet1['inter_note']; ?></td>
  </tr>
<?php $i++; } } ?>
</table>
</div>


<div class="" style="margin-top:50px;margin-left:300px;">
  <div>
            <div style="margin-left:35px;"> (ลงนาม)..........................................................</div><br>
            <div style="margin-left:80px;">  ( ________________________ ) </div>
            <div  style="margin-left:60px;margin-top:25px;">  วันที่ ........................................................ </div>

  </div>
</div>
</div>
<div class="" style="height:50px;
	position:fixed;
	left:0px;
	bottom:0px;
	width:100%;
	z-index: 99;
	">
<div class="" style="width:100%;height:1px;background-color:black">

</div>
ศูนย์สหกิจศึกษาและพัฒนาอาชีพ มหาวิทยาลัยราชภัฏกาญจนบุรี
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
$pdf->Output(iconv('UTF-8', 'TIS-620','mpdf/ใบรายชื่อผู้สัมภาษณ์งาน.pdf'));         // เก็บไฟล์ html ที่แปลงแล้วไว้ใน MyPDF/MyPDF.pdf ถ้าต้องการให้แสด
header("location:mpdf/ใบรายชื่อผู้สัมภาษณ์งาน.pdf");
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
