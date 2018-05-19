<?php session_start(); ob_start();  ?>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
<?php
function changeDate($date){
$get_date = explode("-",$date);
$month = array("01"=>"ม.ค.","02"=>"ก.พ","03"=>"มี.ค.","04"=>"เม.ย.","05"=>"พ.ค.","06"=>"มิ.ย.","07"=>"ก.ค.","08"=>"ส.ค.","09"=>"ก.ย.","10"=>"ต.ค.","11"=>"พ.ย.","12"=>"ธ.ค.");
$get_month = $get_date["1"];
$year = $get_date["0"]+543;
return $get_date["2"]." ".$month[$get_month]." ".$year;
}
?>
<?php
require_once('mpdf/mpdf.php'); //ที่อยู่ของไฟล์ mpdf.php ในเครื่องเรานะครับ
$number_page = 1;
$ii = 1;
mysql_connect("localhost","root","max123456");
mysql_select_db("tb_cooperative");
mysql_query("SET NAMES UTF8");
$sql = mysql_query("SELECT position_name FROM tb_position WHERE position_key = '".$_POST['key_position']."' ");
$fet = mysql_fetch_array($sql);
$sql1 = mysql_query("SELECT student_name,student_last FROM tb_student WHERE student_key = '".$_POST['key_student']."' ");
$fet1 = mysql_fetch_array($sql1);
?>
<div  style='text-align:center'>
  <h1>บันทึกของอาจารย์นิเทศ</h1> ( <?php echo $fet1['student_name']." ".$fet1['student_last']; ?>)
  <h3>( <?php echo $fet['position_name']; ?> )</h1>
</div>
<div class="" >
<?php
$sql = mysql_query("SELECT * FROM tb_supervision WHERE position_keyf = '".$_POST['key_position']."' AND student_keyf = '".$_POST['key_student']."' ");
?>
  <table class="table" >
    <tr>
      <td style="background-color:#f5f5f5;text-align:center;display:block; border:#000 solid 1px;width:100%">ลำดับ</td>
      <td style="background-color:#f5f5f5;text-align:center;display:block; border:#000 solid 1px;width:100%">วัน/เดือน/ปี</td>
      <td style="background-color:#f5f5f5;text-align:center;display:block; border:#000 solid 1px;width:100%">รายการนิเทศ</td>
      <td style="background-color:#f5f5f5;text-align:center;display:block; border:#000 solid 1px;width:100%">ลายเซ็น</td>
    </tr>
<?php
while($fet = mysql_fetch_array($sql)){ ?>
  <tr>
    <td style="border:#000 solid 1px;width:100%"><?php echo $i+1; ?></td>
    <td style="border:#000 solid 1px;width:100%"><?php echo changeDate($fet['supervision_date']); ?></td>
    <td style="border:#000 solid 1px;width:100%"><?php echo $fet['supervision_list']; ?></td>
    <td style="border:#000 solid 1px;width:100%"></td>
  </tr>
<?php
$i++;
}
?>
  </table>

</div>
<?php
$header = "<div  style='text-align:right;'>
หน้าที่  {PAGENO}/{nb}
</div>
";
$html = ob_get_contents();        //เก็บค่า html ไว้ใน $html
ob_end_clean();
$pdf = new mPDF('th', 'A4', '0', '');   //การตั้งค่ากระดาษถ้าต้องการแนวตั้ง ก็ A4 เฉยๆครับ ถ้าต้องการแนวนอนเท่ากับ A4-L
$pdf->SetHTMLHeader($header, null, true);
$pdf->setFooter('{PAGENO}/{nb}', null, true);
$pdf->SetAutoFont();
$pdf->SetDisplayMode('fullpage');
$pdf->WriteHTML($html, 2);
$pdf->Output(iconv('UTF-8', 'TIS-620','mpdf/ทดสอบการ.pdf'));         // เก็บไฟล์ html ที่แปลงแล้วไว้ใน MyPDF/MyPDF.pdf ถ้าต้องการให้แสด
header("location:mpdf/ทดสอบการ.pdf");
?>
<!--ดาวโหลดรายงานในรูปแบบ PDF <a href="mpdf/ทดสอบการ.pdf" >คลิกที่นี้</a> -->

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
