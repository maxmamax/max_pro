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
$sql = mysql_query("SELECT * FROM  tb_evaluation a , tb_position b , tb_student c , tb_faculty d , tb_course e  WHERE a.student_keyf = '".$_POST['key_student']."' AND a.position_keyf = '".$_POST['key_position']."' AND b.position_key = '".$_POST['key_position']."' AND c.student_key = '".$_POST['key_student']."' AND c.faculty_keyf = d.faculty_key AND c.course_key = e.course_key ");
$fet = mysql_fetch_array($sql);
?>
<table>
  <tr>
    <td><img src="../KRU.png" width="50px" heigth="50px"></td>
    <td width="500px;">&nbsp;&nbsp; มหาวิทยาลัยราชภัฏกาญจนบุรี</td>
    <td style="text-align:center">KRU-15<br>สำหรับสถานประกอบการ</td>
  </tr>
</table>
<br>

  <div style="text-align:center;">แบบประเมินผลนักศึกษาสหกิจศึกษา</div>

  <table >
  <tr >
    <td><u>คำชี้แจง</u></td>
  </tr>
  <tr>
    <td style="text-align:right;">1.</td>
    <td><br>ผู้ให้ข้อมูลในแบบประเมินนี้ต้องเป็นพนักงานที่ปรึกษา (Job supervisor) ของนักศึกษาสหกิจศึกษาหรือบุคคลที่ได้รับมอบหมายให้ทำหน้าที่แทน</td>
  </tr>
  <tr>
    <td style="text-align:right;">2.</td>
    <td>แบบประเมินผลนี้มีทั้งหมด 18 ข้อ โปรดให้ข้อมูลครบทุกข้อเพื่อความสมบูรณ์ของการประเมินผล</td>
  </tr>
  <tr>
    <td style="text-align:right;">3.</td>
    <td><br>โปรดให้คะแนนในช่อง    ในแต่ละหัวข้อการประเมิน หากไม่มีข้อมูลให้ใส่เครื่องหมาย - และโปรดให้ความคิดเห็นเพิ่มเติม (ถ้ามี)</td>
  </tr>
  <tr>
    <td style="text-align:right;">4.</td>
    <td><br>เมื่อประเมินผลเรียบร้อยแล้วโปรดนำเอกสารนี้ใส่ซองประทับตรา“ลับ”และให้นักศึกษานำส่งงานสหกิจมหาวิทยาลัยราชภัฎกาญจนบุรีทันทีที่นักศึกษากลับมหาวิทยาลัย</td>
  </tr>
  </table>

<br>
<div class="">ข้อมูลทั่วไป / Work Term Information</div>
<br>
<table>
  <tr>
    <td>ชื่อ – นามสกุลนักศึกษา</td>
    <td><u><?php echo $fet['student_name']." ".$fet['student_last']; ?></u></td>
    <td>รหัสประจำตัว</td>
    <td><u><?php echo $fet['student_code']; ?></u></td>
  </tr>
</table>
<table>
  <tr>
    <td>สาขาวิชา</td>
    <td><u><?php echo $fet['course_name']; ?></u></td>
    <td>คณะ</td>
    <td><u><?php echo $fet['faculty_name']; ?></u></td>
  </tr>
</table>
<table>
  <tr>
    <td>ชื่อสถานประกอบการ</td>
    <td><u><?php echo $_SESSION['session_name']; ?></u></td>
  </tr>
</table>
<table>
  <tr>
    <td>ชื่อ – นามสกุลผู้ประเมิน</td>
    <td><u><?php echo $fet['evaluation_assessor']; ?></u></td>
    <td>แผนก</td>
    <td><u><?php echo $fet['evaluation_depart']; ?></u></td>
  </tr>
</table>

<br>
<div class="">ผลสำเร็จของงาน / Work Achievement</div>
<table style="border:#000 solid 1px;">
  <tr>
    <td colspan="2" style="text-align:center; border:#000 solid 1px;width:100%">หัวข้อประเมิน / Items</td>
  </tr>
  <tr>
    <td style="width:100%;">1. ปริมาณงาน (Quantity of work)  </td>
    <td style="text-align:center; border:#000 solid 1px;width:100%">20 คะแนน</td>
  </tr>
  <tr >
    <td style="width:100%;">ปริมาณงานที่ปฏิบัติสำเร็จตามหน้าที่หรือตามที่ได้รับมอบหมายภายในระยะเวลา</td>
    <td style="text-align:center; border:#000 solid 1px;width:100%"><?php echo $fet['evaluation_topic1']; ?></td>
  </tr>
  <tr>
    <td style="width:100%;">2. คุณภาพงาน (Quality of work)</td>
    <td style="text-align:center; border:#000 solid 1px;width:100%">20 คะแนน</td>
  </tr>
  <tr >
    <td style="width:100%;">ทำงานได้ถูกต้องครบถ้วนสมบูรณ์ มีความประณีตเรียบร้อย มีความรอบคอบ</td>
    <td style="text-align:center; border:#000 solid 1px;width:100%"><?php echo $fet['evaluation_topic2']; ?></td>
  </tr>
  <tr >
    <td style="width:100%;">ไม่เกิดปัญหาติดตามมา งานไม่ค้างคา ทำงานเสร็จทันเวลาหรือก่อนเวลาที่กำหนด</td>
    <td></td>
  </tr>
</table>

<br>
<div class="">ความรู้ความสามารถ / Knowledge and Ability</div>
<table style="border:#000 solid 1px;">
  <tr>
    <td colspan="2" style="text-align:center; border:#000 solid 1px;width:100%">หัวข้อประเมิน / Items</td>
  </tr>
  <tr >
    <td > 3. ความรู้ความสามารถทางวิชาการ (Academic ability) </td>
    <td width="60px" style="text-align:center; border:#000 solid 1px;">10 คะแนน</td>
  </tr>
  <tr >
    <td style="width:100%;">นักศึกษามีความรู้ทางวิชาการเพียงพอ ที่จะทำงานตามที่ได้รับมอบหมาย</td>
    <td style="text-align:center; border:#000 solid 1px;width:100%"><?php echo $fet['evaluation_topic3']; ?></td>
  </tr>
  <tr>
    <td style="width:100%;">(ในระดับที่นักศึกษาฯปฏิบัติได้)</td>
    <td></td>
  </tr>
  <tr>
    <td style="width:100%;">4. ความสามารถในการเรียนรู้และประยุกต์วิชาการ (Ability to learn and apply knowledge) </td>
    <td style="text-align:center; border:#000 solid 1px;width:100%">10 คะแนน</td>
  </tr>
  <tr >
    <td style="width:100%;">ความรวดเร็วในการเรียนรู้ เข้าใจข้อมูล ข่าวสาร และวิธีการทำงาน </td>
    <td style="text-align:center; border:#000 solid 1px;width:100%"><?php echo $fet['evaluation_topic4']; ?></td>
  </tr>
  <tr>
    <td style="width:100%;">ตลอดจนการนำความรู้ไปประยุกต์ใช้งานที่นักศึกษาปฏิบัติ</td>
    <td></td>
  </tr>
  <tr>
    <td style="width:100%;">5. ความรู้ความชำนาญด้านปฏิบัติการ (Practical ability) </td>
    <td style="text-align:center; border:#000 solid 1px;width:100%">10 คะแนน</td>
  </tr>
  <tr>
    <td style="width:100%;">เช่น การปฏิบัติงานในภาคสนาม/ในห้องปฏิบัติการ</td>
    <td style="text-align:center; border:#000 solid 1px;width:100%"><?php echo $fet['evaluation_topic5']; ?></td>
  </tr>
  <tr>
    <td style="width:100%;">6. วิจารณญาณและตัดสินใจ (Judgement and dicision making) </td>
    <td style="text-align:center; border:#000 solid 1px;width:100%">10 คะแนน</td>
  </tr>
  <tr >
    <td style="width:100%;">ตัดสินใจได้ดี ถูกต้อง รวดเร็ว มีการวิเคราะห์ ข้อมูลและปัญหาต่าง ๆ อย่างรอบคอบ </td>
    <td style="text-align:center; border:#000 solid 1px;width:100%"><?php echo $fet['evaluation_topic6']; ?></td>
  </tr>
  <tr>
    <td style="width:100%;">ก่อนการตัดสินใจ สามารถแก้ไขปัญหาเฉพาะหน้าสามารถไว้วางใจให้ตัดสินใจได้ด้วยตนเอง</td>
    <td></td>
  </tr>
  <tr>
    <td style="width:100%;">7. การจัดการและวางแผน (Organization and planning)</td>
    <td style="text-align:center; border:#000 solid 1px;width:100%">10 คะแนน</td>
  </tr>
  <tr >
    <td style="width:100%;">สามารถควบคุมและจัดการทำงานให้สำเร็จตามแบบแผน ปรับปรุงและพัฒนา </td>
    <td style="text-align:center; border:#000 solid 1px;width:100%"><?php echo $fet['evaluation_topic7']; ?></td>
  </tr>
  <tr>
    <td style="width:100%;">ปรับเปลี่ยนแผนงานให้สอดคล้องกับสถานการณ์ได้ดีและเหมาะสม</td>
    <td></td>
  </tr>
  <tr>
    <td style="width:100%;">8. ทักษะการสื่อสาร (Communication skills) ความสามารถในการติดต่อสื่อสาร </td>
    <td style="text-align:center; border:#000 solid 1px;width:100%">10 คะแนน</td>
  </tr>
  <tr >
    <td style="width:100%;">การพูด การเขียน และการนำเสนอ (Presentation) สามารถสื่อให้เข้าใจได้ง่าย </td>
    <td style="text-align:center; border:#000 solid 1px;width:100%"><?php echo $fet['evaluation_topic8']; ?></td>
  </tr>
  <tr>
    <td style="width:100%;">เรียบร้อยชัดเจน ถูกต้อง รัดกุม มีลำดับขั้นที่ดีไม่ก่อให้เกิดความสับสนต่อการทำงาน รู้จักสอบถาม รู้จักชี้แจงผล</td>
    <td></td>
  </tr>
  <tr>
    <td style="width:100%;">การปฏิบัติงานและข้อขัดข้องให้ทราบ</td>
    <td></td>
  </tr>
  <tr>
    <td style="width:100%;">9. การพัฒนาด้านภาษาและวัฒนธรรมต่างประเทศ ( Foreign language and cultural development)  </td>
    <td style="text-align:center; border:#000 solid 1px;width:100%">10 คะแนน</td>
  </tr>
  <tr >
    <td style="width:100%;">เช่น ภาษาอังกฤษ การทำงานกับชาวต่างชาติ (ถ้าองค์กรผู้ใช้บัณฑิตไม่มีงานในข้อนี้ก็ไม่ต้องประเมินฯ) </td>
    <td style="text-align:center; border:#000 solid 1px;width:100%"><?php echo $fet['evaluation_topic9']; ?></td>
  </tr>
  <tr>
    <td style="width:100%;">10. ความเหมาะสมต่อตำแหน่งที่ได้รับมอบหมาย (Suitability for Job position) </td>
    <td style="text-align:center; border:#000 solid 1px;width:100%">10 คะแนน</td>
  </tr>
  <tr >
    <td style="width:100%;">สามารถพัฒนาตนเองให้ปฏิบัติงานตาม Job position และ Job description </td>
    <td style="text-align:center; border:#000 solid 1px;width:100%"><?php echo $fet['evaluation_topic10']; ?></td>
  </tr>
  <tr>
    <td style="width:100%;">ที่มอบหมายได้อย่างเหมาะสมหรือตำแหน่งนี้เหมาะสมกับนักศึกษาคนหรือไม่เพียงใด</td>
    <td></td>
  </tr>
</table>



<br>
<div class="">ความรับผิดชอบต่อหน้าที่ / Responsibility</div>
<table style="border:#000 solid 1px;">
  <tr>
    <td colspan="2" style="text-align:center; border:#000 solid 1px;width:100%">หัวข้อประเมิน / Items</td>
  </tr>
  <tr>
    <td >11. ความรับผิดชอบและเป็นผู้ที่ไว้วางใจได้ (Responsibility and dependability)</td>
    <td width="70px" style="text-align:center; border:#000 solid 1px;">10 คะแนน</td>
  </tr>
  <tr >
    <td style="width:100%;">ดำเนินงานให้สำเร็จลุล่วงโดยคำนึงถึงเป้าหมาย และความสำเร็จของงานเป็น</td>
    <td style="text-align:center; border:#000 solid 1px;width:100%"><?php echo $fet['evaluation_topic11']; ?></td>
  </tr>
  <tr>
    <td style="width:100%;">ยอมรับผลที่เกิดจากการทำงานอย่างมีเหตุผล สามารถปล่อยให้ทำงาน  (กรณีงานประจำ)ได้โดยไม่ต้องควบคุม</td>
    <td></td>
  </tr>
  <tr>
    <td style="width:100%;">มากจนเกินไปความจำเป็นในการตรวจสอบขั้นตอนและผลงานตลอดเวลาสามารถไว้วางใจให้รับผิดชอบงานที่</td>
    <td></td>
  </tr>
  <tr>
    <td style="width:100%;">มากกว่าเวลาประจำ สามารถไว้วางใจได้แทบทุกสถานการณ์หรือในสถานการณ์ปกติเท่านั้น</td>
    <td></td>
  </tr>
  <tr>
    <td >12. ความสนใจ อุตสาหะในการทำงาน (Interest in work)</td>
    <td style="width:100%;" style="text-align:center; border:#000 solid 1px;">10 คะแนน</td>
  </tr>
  <tr >
    <td style="width:100%;">ความสนใจและความกระตือรือร้นในการทำงานมีความอุตสาหะ มีความพยายาม</td>
    <td style="text-align:center; border:#000 solid 1px;width:100%"><?php echo $fet['evaluation_topic12']; ?></td>
  </tr>
  <tr>
    <td style="width:100%;">มีความตั้งใจที่จะทำงานได้สำเร็จ มีความมานะบากบั่น ไม่ย่อท้อต่ออุปสรรคและปัญหา</td>
    <td></td>
  </tr>
  <tr>
    <td >13. ความสามารถเริ่มต้นทำงานได้ด้วยตนเอง (Initiative or self starter)</td>
    <td style="width:100%;" style="text-align:center; border:#000 solid 1px;">10 คะแนน</td>
  </tr>
  <tr >
    <td style="width:100%;"> เมื่อได้รับคำชี้แนะ สามารถเริ่มทำงานได้เอง โดยไม่ต้องรอคำสั่ง  (กรณีงานประจำ) เสนอตัวเข้า</td>
    <td style="text-align:center; border:#000 solid 1px;width:100%"><?php echo $fet['evaluation_topic13']; ?></td>
  </tr>
  <tr>
    <td style="width:100%;">ช่วยงานแทบทุกอย่าง มาขอรับงานใหม่ ๆไปปฏิบัติ และไม่ปล่อยเวลาว่างให้ล่วงเลยไปโดยเปล่าประโยชน์</td>
    <td></td>
  </tr>
  <tr>
    <td >14. การตอบสนองต่อการสั่งการ (Response to supervision)</td>
    <td style="width:100%;" style="text-align:center; border:#000 solid 1px;">10 คะแนน</td>
  </tr>
  <tr >
    <td style="width:100%;">ยินดีรับคำสั่ง คำแนะนำ คำวิจารณ์ ไม่แสดงความอึดอัดใจ เมื่อได้รับคำติเตือน </td>
    <td style="text-align:center; border:#000 solid 1px;width:100%"><?php echo $fet['evaluation_topic14']; ?></td>
  </tr>
  <tr>
    <td style="width:100%;">ชและวิจารณ์มีความรวดเร็วในการปฏิบัติตามคำสั่ง การปรับตัวปฏิบัติตามคำแนะนำข้อเสนอแนะ และวิจารณ์์</td>
    <td></td>
  </tr>
</table>

<br>
<div class="">ลักษณะส่วนบุคคล /Personality</div>
<table style="border:#000 solid 1px;">
  <tr>
    <td colspan="2" style="text-align:center; border:#000 solid 1px;width:100%">หัวข้อประเมิน / Items</td>
  </tr>
  <tr>
    <td width="350px" >15. บุคลิกภาพและการวางตัว (Personality)</td>
    <td  style="text-align:center; border:#000 solid 1px;">10 คะแนน</td>
  </tr>
  <tr >
    <td style="width:100%;">มีบุคลิกภาพและวางตัวได้เหมาะสม เช่น ทัศนคติ วุฒิภาวะ ความอ่อนน้อม  </td>
    <td style="text-align:center; border:#000 solid 1px;width:100%"><?php echo $fet['evaluation_topic15']; ?></td>
  </tr>
  <tr>
    <td style="width:100%;">การแต่งกาย กริยาวาจา การตรงต่อเวลา และอื่น ๆ</td>
    <td></td>
  </tr>
  <tr>
    <td >16. มนุษย์สัมพันธ์ (Interpersonal skills)</td>
    <td style="text-align:center; border:#000 solid 1px;">10 คะแนน</td>
  </tr>
  <tr >
    <td style="width:100%;">สามารถร่วมงานกับผู้อื่น การทำงานเป็นทีม สร้างมนุษย์สัมพันธ์ได้ดี  </td>
    <td style="text-align:center; border:#000 solid 1px;width:100%"><?php echo $fet['evaluation_topic16']; ?></td>
  </tr>
  <tr>
    <td style="width:100%;">ใคร่ ชอบพอของผู้ร่วมงาน เป็นผู้ที่ช่วยก่อให้เกิดความร่วมมือประสานงาน</td>
    <td></td>
  </tr>
  <tr>
    <td >17. ความมีระเบียบวินัย ปฏิบัติตามวัฒนธรรมขององค์กร</td>
    <td style="width:100%;" style="text-align:center; border:#000 solid 1px;">10 คะแนน</td>
  </tr>
  <tr >
    <td style="width:100%;">(Discipline and adaptability to formal organization)</td>
    <td style="text-align:center; border:#000 solid 1px;width:100%"><?php echo $fet['evaluation_topic17']; ?></td>
  </tr>
  <tr>
    <td style="width:100%;">ความสนใจเรียนรู้ศึกษากฎระเบียบ นโยบาย ต่างๆ และปฏิบัติตามโดยเต็มใจ</td>
    <td></td>
  </tr>
  <tr>
    <td style="width:100%;">การปฏิบัติตามระเบียบบริหารงานบุคคล (การเข้างาน ลางาน) ปฏิบัติตามกฎ/ระเบียบ  การรักษาความ</td>
    <td></td>
  </tr><tr>
    <td style="width:100%;">ปลอดภัย การควบคุมคุณภาพ 5 ส. และอื่นๆ เป็นต้น</td>
    <td></td>
  </tr>
  <tr>
    <td >18. คุณธรรมและจริยธรรม (Ethics and morality)</td>
    <td style="width:100%;" style="text-align:center; border:#000 solid 1px;">10 คะแนน</td>
  </tr>
  <tr >
    <td style="width:100%;">มีความซื่อสัตย์ สุจริต มีจิตใจสะอาด รู้จักเสียสละ ไม่เห็นแก่ตัว เอื้อเฟื้อเผื่อแผ่ </td>
    <td style="text-align:center; border:#000 solid 1px;width:100%"><?php echo $fet['evaluation_topic18']; ?></td>
  </tr>
  <tr>
    <td style="width:100%;">ผู้อื่น</td>
    <td></td>
  </tr>
</table>

<br>
<div class="">โปรดให้ข้อคิดที่เป็นประโยชน์แก่นักศึกษา  (Please give comment on the student)</div>
<table>
  <tr>
    <td width="100%" style="text-align:center; border:#000 solid 1px;">จุดเด่นของนักศึกษา (Strength)</td>
    <td width="100%" style="text-align:center; border:#000 solid 1px;">ข้อควรปรับปรุงของนักศึกษา (Improvement)</td>
  </tr>
  <tr>
    <td style=" border:#000 solid 1px;">wef</td>
    <td style=" border:#000 solid 1px;">ขwef</td>
  </tr>
</table>

<br>
<div>หากนักศึกษาผู้นี้สำเร็จการศึกษาแล้ว ท่านจะรับเข้าทำงานในสถานประกอบการแห่งนี้หรือไม่ (หากมีโอกาส )
 Once this student graduates, will you be interested to offer him/her a job?</div>
 <table>
   <tr>
     <td><?php if($fet['evaluation_work'] == "1"){ echo "<img src='chk_y.jpg'>"; }else{ echo "<img src='chk_n.jpg'>"; } ?> รับ (Yes)</td>
     <td><?php if($fet['evaluation_work'] == "2"){ echo "<img src='chk_y.jpg'>"; }else{ echo "<img src='chk_n.jpg'>"; } ?>ไม่แน่ใจ (Not sure)</td>
     <td><?php if($fet['evaluation_work'] == "3"){ echo "<img src='chk_y.jpg'>"; }else{ echo "<img src='chk_n.jpg'>"; } ?>ไม่รับ (No)</td>
   </tr>
 </table>

<br>
<div>ข้อคิดเห็นเพิ่มเติม (Other comments)</div>
<u><?php echo $fet['evaluation_other']; ?></u>
<br>
<br><br>
<table >
  <tr >
    <td style="text-align:center;width:400px;">
      ลงชื่อ .............................................. ผู้ประเมิน<br><br>
           (....................................................)<br><br>
           ตำแหน่ง.....................................................<br><br>
           วันที่ ..........................................................
    </td >
    <?php
$sum12 = $fet['evaluation_topic1'] + $fet['evaluation_topic2'];
$sum310 = $fet['evaluation_topic3'] + $fet['evaluation_topic4'] + $fet['evaluation_topic5'] + $fet['evaluation_topic6'] + $fet['evaluation_topic7'] + $fet['evaluation_topic8'] + $fet['evaluation_topic9'] + $fet['evaluation_topic10'];
$sum1114 = $fet['evaluation_topic11'] + $fet['evaluation_topic12'] + $fet['evaluation_topic13'] + $fet['evaluation_topic14'];
$sum1518 = $fet['evaluation_topic15'] + $fet['evaluation_topic16'] + $fet['evaluation_topic17'] + $fet['evaluation_topic18'];
$sum_avg =  ($sum12/1) + ($sum310/4) + ($sum1114/2) + ($sum1518/2);
    ?>
    <td style="text-align:center;border:#000 solid 1px;width:100%"><br><br>
      สำหรับเจ้าหน้าที่สหกิจศึกษา/Co-op staff only <br><br>
      คะแนนรวม ข้อ   1-2   =  <?php echo $sum12; ?> ÷1  <?php echo $sum12/1; ?>  คะแนน <br><br>
      คะแนนรวม ข้อ   3-10 = <?php echo $sum310; ?>   ÷4  <?php echo $sum310/4; ?> คะแนน <br><br>
      คะแนนรวม ข้อ 11-14 = <?php echo $sum1114; ?>       ÷2 <?php echo $sum1114/2; ?>       คะแนน <br><br>
      คะแนนรวม ข้อ 15-18 = <?php echo $sum1518; ?>       ÷2  <?php echo $sum1518/2; ?>     คะแนน <br><br>
      	         รวม=   <?php echo $sum_avg; ?>              คะแนน <br><br>
      100  คะแนน

    </td>
  </tr>
</table>
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
