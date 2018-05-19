<?php ob_start(); ?>

<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
<?php
require_once('mpdf/mpdf.php'); //ที่อยู่ของไฟล์ mpdf.php ในเครื่องเรานะครับ
ob_start(); // ทำการเก็บค่า html นะครับ
?>
<div >
<div align="center" >
  <img src="KRU.gif" align="center" width="120px" height="150px">
  <hr>
  มหาวิทยาลัยราชภัฏกาญจนบุรี
  <br>
  <hr>
</div>
<div align="center">
  รายงานการปฏิบัติงานสถานประกอบการ  TEST
  <table class="table" border="1px" style="margin-top:25px;">
    <tr  style="background-color:black;">
      <td wisth="50px"  bgcolor="#D5D5D5">ลำดับ</td>
      <td wisth="50px"  bgcolor="#D5D5D5">สถานประกอบการ</td>
      <td width="150px" bgcolor="#D5D5D5">ที่อยู่</td>
      <td width="150px" bgcolor="#D5D5D5">ตำบล</td>
      <td width="150px" bgcolor="#D5D5D5">อำเภอ</td>
      <td width="150px" bgcolor="#D5D5D5">จังหวัด</td>
      <td width="150px" bgcolor="#D5D5D5">รหัสไปรษณีย์</td>
      <td  width="150px" bgcolor="#D5D5D5">ตำแหน่งงาน</td>
    </tr>
<?php
mysql_connect("localhost","root","max123456");
mysql_select_db("tb_cooperative");
mysql_query("SET NAMES UTF8");
$sql = mysql_query("SELECT * FROM tb_register_job a , tb_student b , tb_cooperative c , tb_position e WHERE a.student_keyf = b.student_key AND a.coop_keyf = c.coop_key AND a.position_keyf = e.position_key");
while($fet = mysql_fetch_array($sql)){
?>
    <tr>
      <td><?php echo $i+1;?></td>
      <td><?php echo $fet['coop_Tname']; ?></td>
      <td><?php echo $fet['coop_address']; ?></td>
      <td><?php echo $fet['coop_sdistrict']; ?></td>
      <td><?php echo $fet['coop_district']; ?></td>
      <td><?php echo $fet['coop_province']; ?></td>
      <td><?php echo $fet['coop_code']; ?></td>
      <td><?php echo $fet['coop_province']; ?></td>
    </tr>
    <tr>
      <td><?php echo $i+1;?></td>
      <td><?php echo $fet['coop_Tname']; ?></td>
      <td><?php echo $fet['coop_address']; ?></td>
      <td><?php echo $fet['coop_sdistrict']; ?></td>
      <td><?php echo $fet['coop_district']; ?></td>
      <td><?php echo $fet['coop_province']; ?></td>
      <td><?php echo $fet['coop_code']; ?></td>
      <td><?php echo $fet['coop_province']; ?></td>
    </tr>
    <tr>
        <td><?php echo $i+1;?></td>
        <td><?php echo $fet['coop_Tname']; ?></td>
        <td><?php echo $fet['coop_address']; ?></td>
        <td><?php echo $fet['coop_sdistrict']; ?></td>
        <td><?php echo $fet['coop_district']; ?></td>
        <td><?php echo $fet['coop_province']; ?></td>
        <td><?php echo $fet['coop_code']; ?></td>
        <td><?php echo $fet['coop_province']; ?></td>
      </tr>
       <tr>
          <td><?php echo $i+1;?></td>
          <td><?php echo $fet['coop_Tname']; ?></td>
          <td><?php echo $fet['coop_address']; ?></td>
          <td><?php echo $fet['coop_sdistrict']; ?></td>
          <td><?php echo $fet['coop_district']; ?></td>
          <td><?php echo $fet['coop_province']; ?></td>
          <td><?php echo $fet['coop_code']; ?></td>
          <td><?php echo $fet['coop_province']; ?></td>
        </tr>
         <tr>
            <td><?php echo $i+1;?></td>
            <td><?php echo $fet['coop_Tname']; ?></td>
            <td><?php echo $fet['coop_address']; ?></td>
            <td><?php echo $fet['coop_sdistrict']; ?></td>
            <td><?php echo $fet['coop_district']; ?></td>
            <td><?php echo $fet['coop_province']; ?></td>
            <td><?php echo $fet['coop_code']; ?></td>
            <td><?php echo $fet['coop_province']; ?></td>
          </tr>
          <tr>
              <td><?php echo $i+1;?></td>
              <td><?php echo $fet['coop_Tname']; ?></td>
              <td><?php echo $fet['coop_address']; ?></td>
              <td><?php echo $fet['coop_sdistrict']; ?></td>
              <td><?php echo $fet['coop_district']; ?></td>
              <td><?php echo $fet['coop_province']; ?></td>
              <td><?php echo $fet['coop_code']; ?></td>
              <td><?php echo $fet['coop_province']; ?></td>
            </tr>
            <tr>
                <td><?php echo $i+1;?></td>
                <td><?php echo $fet['coop_Tname']; ?></td>
                <td><?php echo $fet['coop_address']; ?></td>
                <td><?php echo $fet['coop_sdistrict']; ?></td>
                <td><?php echo $fet['coop_district']; ?></td>
                <td><?php echo $fet['coop_province']; ?></td>
                <td><?php echo $fet['coop_code']; ?></td>
                <td><?php echo $fet['coop_province']; ?></td>
              </tr>
              <tr>
                  <td><?php echo $i+1;?></td>
                  <td><?php echo $fet['coop_Tname']; ?></td>
                  <td><?php echo $fet['coop_address']; ?></td>
                  <td><?php echo $fet['coop_sdistrict']; ?></td>
                  <td><?php echo $fet['coop_district']; ?></td>
                  <td><?php echo $fet['coop_province']; ?></td>
                  <td><?php echo $fet['coop_code']; ?></td>
                  <td><?php echo $fet['coop_province']; ?></td>
                </tr>


<?php $i++; } ?>
  </table>
</div>
</div>
<?php
$html = ob_get_contents();        //เก็บค่า html ไว้ใน $html
ob_end_clean();
$pdf = new mPDF('th', 'A4   ', '0', '');   //การตั้งค่ากระดาษถ้าต้องการแนวตั้ง ก็ A4 เฉยๆครับ ถ้าต้องการแนวนอนเท่ากับ A4-L
$pdf->SetAutoFont();
$pdf->SetDisplayMode('fullpage');
$pdf->WriteHTML($html, 2);
$pdf->Output(iconv('UTF-8', 'TIS-620','mpdf/ทดสอบการ.pdf'));         // เก็บไฟล์ html ที่แปลงแล้วไว้ใน MyPDF/MyPDF.pdf ถ้าต้องการให้แสด
//header("location:mpdf/ทดสอบการ.pdf");
?>
<!--ดาวโหลดรายงานในรูปแบบ PDF <a href="mpdf/ทดสอบการ.pdf" >คลิกที่นี้</a>
