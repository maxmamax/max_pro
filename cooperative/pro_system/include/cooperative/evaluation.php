<?php include("include/connect.php"); session_start(); ?>
<?php
if($_POST['key_student'] != ""  && $_POST['key_position'] != "" && $_POST['name'] != ""){
 $sql = mysql_query("SELECT count(evaluation_key) as num FROM  tb_evaluation WHERE student_keyf = '".$_POST['key_student']."' && position_keyf = '".$_POST['key_position']."' ");
 $fet = mysql_fetch_array($sql);
if($fet['num'] == "0"){
$sql = mysql_query("INSERT INTO tb_evaluation VALUES ('','".$_POST['key_student']."','".$_POST['key_position']."','".$_POST['evaluation_assessor']."','".$_POST['evaluation_depart']."','".$_POST['evaluation_position']."','".$_POST['evaluation_topic1']."','".$_POST['evaluation_topic2']."','".$_POST['evaluation_topic3']."','".$_POST['evaluation_topic4']."','".$_POST['evaluation_topic5']."','".$_POST['evaluation_topic6']."','".$_POST['evaluation_topic7']."','".$_POST['evaluation_topic8']."','".$_POST['evaluation_topic9']."','".$_POST['evaluation_topic10']."','".$_POST['evaluation_topic11']."','".$_POST['evaluation_topic12']."','".$_POST['evaluation_topic13']."','".$_POST['evaluation_topic14']."','".$_POST['evaluation_topic15']."','".$_POST['evaluation_topic16']."','".$_POST['evaluation_topic17']."','".$_POST['evaluation_topic18']."','".$_POST['evaluation_strength']."','".$_POST['evaluation_improvement']."','".$_POST['evaluation_work']."','".$_POST['evaluation_other']."') ");
}else{
$sql = mysql_query("UPDATE tb_evaluation SET
evaluation_assessor = '".$_POST['evaluation_assessor']."',
evaluation_depart = '".$_POST['evaluation_depart']."',
evaluation_position = '".$_POST['evaluation_position']."',
evaluation_topic1 = '".$_POST['evaluation_topic1']."',
evaluation_topic2 = '".$_POST['evaluation_topic2']."',
evaluation_topic3 = '".$_POST['evaluation_topic3']."',
evaluation_topic4 = '".$_POST['evaluation_topic4']."',
evaluation_topic5 = '".$_POST['evaluation_topic5']."',
evaluation_topic6 = '".$_POST['evaluation_topic6']."',
evaluation_topic7 = '".$_POST['evaluation_topic7']."',
evaluation_topic8 = '".$_POST['evaluation_topic8']."',
evaluation_topic9 = '".$_POST['evaluation_topic9']."',
evaluation_topic10 = '".$_POST['evaluation_topic10']."',
evaluation_topic11 = '".$_POST['evaluation_topic11']."',
evaluation_topic12 = '".$_POST['evaluation_topic12']."',
evaluation_topic13 = '".$_POST['evaluation_topic13']."',
evaluation_topic14 = '".$_POST['evaluation_topic14']."',
evaluation_topic15 = '".$_POST['evaluation_topic15']."',
evaluation_topic16 = '".$_POST['evaluation_topic16']."',
evaluation_topic17 = '".$_POST['evaluation_topic17']."',
evaluation_topic18 = '".$_POST['evaluation_topic18']."',
evaluation_strength = '".$_POST['evaluation_strength']."',
evaluation_improvement = '".$_POST['evaluation_improvement']."',
evaluation_work = '".$_POST['evaluation_work']."',
evaluation_other = '".$_POST['evaluation_other']."' WHERE student_keyf = '".$_POST['key_student']."' AND position_keyf = '".$_POST['key_position']."'
");
}
}
?>
<div class="panel panel-default">
  <div class="panel-heading"><h1><span class="glyphicon glyphicon-list" aria-hidden="true"></span> บันทึกข้อมูลแบบประเมินผลการฝึกงาน</h1></div>
  <div class="panel-body">
<?php if($_POST['key_student'] != "" && $_POST['key_position'] != ""){ ?>
  <?php
$sql = mysql_query("SELECT * FROM  tb_evaluation a , tb_position b , tb_student c , tb_faculty d , tb_course e  WHERE a.student_keyf = '".$_POST['key_student']."' AND a.position_keyf = '".$_POST['key_position']."' AND b.position_key = '".$_POST['key_position']."' AND c.student_key = '".$_POST['key_student']."' AND c.faculty_keyf = d.faculty_key AND c.course_key = e.course_key ");
$fet = mysql_fetch_array($sql);

  ?>
  <table class="table table-bordered f2">
  <tr class="bg ">
    <td><u>คำชี้แจง</u></td>
  </tr>
  <tr>
    <td>1.</td>
    <td>ผู้ให้ข้อมูลในแบบประเมินนี้ต้องเป็นพนักงานที่ปรึกษา (Job supervisor) ของนักศึกษาสหกิจศึกษาหรือบุคคลที่ได้รับมอบหมายให้ทำหน้าที่แทน</td>
  </tr>
  <tr>
    <td>2.</td>
    <td>แบบประเมินผลนี้มีทั้งหมด 18 ข้อ โปรดให้ข้อมูลครบทุกข้อเพื่อความสมบูรณ์ของการประเมินผล</td>
  </tr>
  <tr>
    <td>3.</td>
    <td>โปรดให้คะแนนในช่อง    ในแต่ละหัวข้อการประเมิน หากไม่มีข้อมูลให้ใส่เครื่องหมาย - และโปรดให้ความคิดเห็นเพิ่มเติม (ถ้ามี)</td>
  </tr>
  <tr>
    <td>4.</td>
    <td>เมื่อประเมินผลเรียบร้อยแล้วโปรดนำเอกสารนี้ใส่ซองประทับตรา“ลับ”และให้นักศึกษานำส่งงานสหกิจมหาวิทยาลัยราชภัฎกาญจนบุรีทันทีที่นักศึกษากลับมหาวิทยาลัย</td>
  </tr>
  </table>

  <h3>ข้อมูลทั่วไป / Work Term Information</h3>
  <hr>
  <form action="" method="post" id="form_evaluation">
  <input type="hidden" name="key_student" value="<?php echo $_POST['key_student']; ?>">
  <input type="hidden" name="key_position" value="<?php echo $_POST['key_position']; ?>">

  <div class="form-group row f2">
    <div class="col-md-3">
      <label for="">ชื่อ - นามสกุล นักศึกษา</label>
      <input readonly type="text" name="name" value="<?php echo $fet['student_name']." ".$fet['student_last']; ?>" class="form-control">
    </div>

    <div class="col-md-3">
      <label for="">รหัสประจำตัว</label>
      <input readonly type="text" name="" value="<?php echo $fet['student_code']; ?>" class="form-control">
    </div>
    <div class="col-md-3">
      <label for="">สาขาวิชา</label>
      <input readonly type="text" name="" value="<?php echo $fet['course_name']; ?>" class="form-control">
    </div>
    <div class="col-md-3">
      <label for="">คณะ</label>
      <input readonly type="text" name="" value="<?php echo $fet['faculty_name']; ?>"class="form-control">
    </div>
    </div>
  <div class="form-group row f2">
    <div class="col-md-3">
      <label for="">ชื่อสถานประกอบการ</label>
      <input readonly type="text" name="" value="<?php echo $_SESSION['session_name']; ?>" class="form-control">
    </div>
    <div class="col-md-3">
      <label for="">ชื่อ – นามสกุลผู้ประเมิน</label>
      <input type="text" name="evaluation_assessor" value="<?php echo $fet['evaluation_assessor']; ?>" class="form-control">
    </div>
  </div>
  <div class="form-group row f2">
    <div class="col-md-3">
      <label for="">ตำแหน่ง</label>
      <input  type="text" name="evaluation_position" value="<?php echo $fet['evaluation_position']; ?>" class="form-control">
    </div>
    <div class="col-md-3">
      <label for="">แผนก</label>
      <input  type="text" name="evaluation_depart" value="<?php echo $fet['evaluation_depart']; ?>" class="form-control">
    </div>
  </div>
  <h3>ผลสำเร็จของงาน / Work Achievement</h3>
  <hr>

  <table class="table table-bordered f2">
    <tr class="bg">
      <td style="text-align:center" colspan="2"  class="f1">หัวข้อประเมิน / Items</td>
    </tr>
    <tr>
      <td width="80%">1. ปริมาณงาน (Quantity of work) <br>
  ปริมาณงานที่ปฏิบัติสำเร็จตามหน้าที่หรือตามที่ได้รับมอบหมายภายในระยะเวลา <br> ที่กำหนด (ในระดับที่นักศึกษาจะปฏิบัติได้) และเทียบกับนักศึกษาทั่วๆไป
  </td>
      <td style="text-align:center">20 คะแนน <br> <input name="evaluation_topic1" type="text" class="form-control" id="num_1" value="<?php echo $fet['evaluation_topic1']+0; ?>"></td>
    </tr>
    <tr>
      <td width="80%">2. คุณภาพงาน (Quality of work) <br>
  ทำงานได้ถูกต้องครบถ้วนสมบูรณ์ มีความประณีตเรียบร้อย มีความรอบคอบ <br> ไม่เกิดปัญหาติดตามมา งานไม่ค้างคา ทำงานเสร็จทันเวลาหรือก่อนเวลาที่กำหนด
  </td>
      <td style="text-align:center">20 คะแนน <br> <input name="evaluation_topic2" type="text" class="form-control" id="num_2" value="<?php echo $fet['evaluation_topic2']+0; ?>"></td>
    </tr>
  </table>

  <h3>ความรู้ความสามารถ / Knowledge and Ability</h3>
  <hr>

  <table class="table table-bordered f2">
    <tr class="bg">
      <td style="text-align:center " colspan="2" class="f1">หัวข้อประเมิน / Items</td>
    </tr>
    <tr>
      <td width="80%">3. ความรู้ความสามารถทางวิชาการ (Academic ability) <br>
  นักศึกษามีความรู้ทางวิชาการเพียงพอ ที่จะทำงานตามที่ได้รับมอบหมาย <br> ที(ในระดับที่นักศึกษาฯปฏิบัติได้)
  </td>
      <td style="text-align:center">10 คะแนน <br> <input name="evaluation_topic3" type="text" class="form-control" id="num_3" value="<?php echo $fet['evaluation_topic3']+0; ?>"></td>
    </tr>
    <tr>
      <td width="80%">4. ความสามารถในการเรียนรู้และประยุกต์วิชาการ (Ability to learn and applyknowledge) <br>
  ทความรวดเร็วในการเรียนรู้ เข้าใจข้อมูล ข่าวสาร และวิธีการทำงาน  <br> ตลอดจนการนำความรู้ไปประยุกต์ใช้งานที่นักศึกษาปฏิบัติ
  </td>
      <td style="text-align:center">10 คะแนน <br> <input name="evaluation_topic4" type="text" class="form-control" id="num_4" value="<?php echo $fet['evaluation_topic4']+0; ?>"></td>
    </tr>
    <tr>
      <td width="80%">5. ความรู้ความชำนาญด้านปฏิบัติการ (Practical ability) <br>
  เช่น การปฏิบัติงานในภาคสนาม/ในห้องปฏิบัติการ
  </td>
      <td style="text-align:center">10 คะแนน <br> <input name="evaluation_topic5" type="text" class="form-control" id="num_5" value="<?php echo $fet['evaluation_topic5']+0; ?>"></td>
    </tr>
    <tr>
      <td width="80%">6. วิจารณญาณและตัดสินใจ (Judgement and dicision making) <br>
  ตัดสินใจได้ดี ถูกต้อง รวดเร็ว มีการวิเคราะห์ ข้อมูลและปัญหาต่าง ๆ อย่างรอบคอบ  <br> ก่อนการตัดสินใจ สามารถแก้ไขปัญหาเฉพาะหน้าสามารถไว้วางใจให้ตัดสินใจได้ด้วยตนเองิ
  </td>
      <td style="text-align:center">10 คะแนน <br> <input name="evaluation_topic6" type="text" class="form-control" id="num_6" value="<?php echo $fet['evaluation_topic6']+0; ?>"></td>
    </tr>
    <tr>
      <td width="80%">7. การจัดการและวางแผน (Organization and planning) <br>
  สามารถควบคุมและจัดการทำงานให้สำเร็จตามแบบแผน ปรับปรุงและพัฒนา <br> ปรับเปลี่ยนแผนงานให้สอดคล้องกับสถานการณ์ได้ดีและเหมาะสม
  </td>
      <td style="text-align:center">10 คะแนน <br> <input name="evaluation_topic7" type="text" class="form-control" id="num_7" value="<?php echo $fet['evaluation_topic7']+0; ?>"></td>
    </tr>
    <tr>
      <td width="80%">8. ทักษะการสื่อสาร (Communication skills) ความสามารถในการติดต่อสื่อสาร  <br>
  การพูด การเขียน และการนำเสนอ (Presentation) สามารถสื่อให้เข้าใจได้ง่าย
  <br>เรียบร้อยชัดเจน ถูกต้อง รัดกุม มีลำดับขั้นที่ดีไม่ก่อให้เกิดความสับสนต่อการทำงาน รู้จักสอบถาม รู้จักชี้แจงผล <br> การปฏิบัติงานและข้อขัดข้องให้ทราบ
  </td>
      <td style="text-align:center">10 คะแนน <br> <input name="evaluation_topic8" type="text" class="form-control" id="num_8" value="<?php echo $fet['evaluation_topic8']+0; ?>"></td>
    </tr>
    <tr>
      <td width="80%">9. การพัฒนาด้านภาษาและวัฒนธรรมต่างประเทศ ( Foreign language and cultural development)  <br>
  เช่น ภาษาอังกฤษ การทำงานกับชาวต่างชาติ (ถ้าองค์กรผู้ใช้บัณฑิตไม่มีงานในข้อนี้ก็ไม่ต้องประเมินฯ)
  </td>
      <td style="text-align:center">10 คะแนน <br> <input name="evaluation_topic9" type="text" class="form-control" id="num_9" value="<?php echo $fet['evaluation_topic9']+0; ?>"</td>
    </tr>
    <tr>
      <td width="80%">10. ความเหมาะสมต่อตำแหน่งที่ได้รับมอบหมาย (Suitability for Job position)  <br>
  สามารถพัฒนาตนเองให้ปฏิบัติงานตาม Job position และ Job description  <br> ที่มอบหมายได้อย่างเหมาะสมหรือตำแหน่งนี้เหมาะสมกับนักศึกษาคนหรือไม่เพียงใด
  </td>
      <td style="text-align:center">10 คะแนน <br> <input name="evaluation_topic10" type="text" class="form-control" id="num_10" value="<?php echo $fet['evaluation_topic10']+0; ?>"></td>
    </tr>
  </table>

  <h3>ความรับผิดชอบต่อหน้าที่ / Responsibility</h3>
  <hr>

  <table class="table table-bordered ">
    <tr class="bg">
      <td style="text-align:center" colspan="2"  class="f1">หัวข้อประเมิน / Items</td>
    </tr>
    <tr>
      <td width="80%">11. ความรับผิดชอบและเป็นผู้ที่ไว้วางใจได้ (Responsibility and dependability)
  <br>ดำเนินงานให้สำเร็จลุล่วงโดยคำนึงถึงเป้าหมาย และความสำเร็จของงานเป็น
  <br>ยอมรับผลที่เกิดจากการทำงานอย่างมีเหตุผล สามารถปล่อยให้ทำงาน  (กรณีงานประจำ)ได้โดยไม่ต้องควบคุม
  <br>มากจนเกินไปความจำเป็นในการตรวจสอบขั้นตอนและผลงานตลอดเวลาสามารถไว้วางใจให้รับผิดชอบงานที่
  <br>มากกว่าเวลาประจำ สามารถไว้วางใจได้แทบทุกสถานการณ์หรือในสถานการณ์ปกติเท่านั้น
  </td>
      <td style="text-align:center">10 คะแนน <br> <input name="evaluation_topic11" type="text" class="form-control" id="num_11" value="<?php echo $fet['evaluation_topic11']+0; ?>"></td>
    </tr>
    <tr>
      <td width="80%">12. ความสนใจ อุตสาหะในการทำงาน (Interest in work)
  <br>ความสนใจและความกระตือรือร้นในการทำงานมีความอุตสาหะ มีความพยายาม
  <br>มีความตั้งใจที่จะทำงานได้สำเร็จ มีความมานะบากบั่น ไม่ย่อท้อต่ออุปสรรคและปัญหา
  </td>
      <td style="text-align:center">10 คะแนน <br> <input name="evaluation_topic12" type="text" class="form-control" id="num_12" value="<?php echo $fet['evaluation_topic12']+0; ?>"></td>
    </tr>
    <tr>
      <td width="80%">13. ความสามารถเริ่มต้นทำงานได้ด้วยตนเอง (Initiative or self starter)
  <br>เมื่อได้รับคำชี้แนะ สามารถเริ่มทำงานได้เอง โดยไม่ต้องรอคำสั่ง  (กรณีงานประจำ) เสนอตัวเข้า
  <br>ช่วยงานแทบทุกอย่าง มาขอรับงานใหม่ ๆไปปฏิบัติ และไม่ปล่อยเวลาว่างให้ล่วงเลยไปโดยเปล่าประโยชน์
  </td>
      <td style="text-align:center">10 คะแนน <br> <input name="evaluation_topic13" type="text" class="form-control" id="num_13" value="<?php echo $fet['evaluation_topic13']+0; ?>"></td>
    </tr>
    <tr>
      <td width="80%">14. การตอบสนองต่อการสั่งการ (Response to supervision)
  <br>ยินดีรับคำสั่ง คำแนะนำ คำวิจารณ์ ไม่แสดงความอึดอัดใจ เมื่อได้รับคำติเตือน
  <br>และวิจารณ์มีความรวดเร็วในการปฏิบัติตามคำสั่ง การปรับตัวปฏิบัติตามคำแนะนำข้อเสนอแนะ และวิจารณ์
  </td>
      <td style="text-align:center">10 คะแนน <br> <input name="evaluation_topic14" type="text" class="form-control" id="num_14" value="<?php echo $fet['evaluation_topic14']+0; ?>"></td>
    </tr>
  </table>

  <h3>ลักษณะส่วนบุคคล /Personality</h3>
  <hr>

  <table class="table table-bordered">
    <tr class="bg">
      <td style="text-align:center" colspan="2"  class="f1">หัวข้อประเมิน / Items</td>
    </tr>
    <tr>
      <td width="80%">15. บุคลิกภาพและการวางตัว (Personality)
  <br>มีบุคลิกภาพและวางตัวได้เหมาะสม เช่น ทัศนคติ วุฒิภาวะ ความอ่อนน้อม
  <br>การแต่งกาย กริยาวาจา การตรงต่อเวลา และอื่น ๆ
  </td>
      <td style="text-align:center">10 คะแนน <br> <input name="evaluation_topic15" type="text" class="form-control" id="num_15" value="<?php echo $fet['evaluation_topic15']+0; ?>"></td>
    </tr>
    <tr>
      <td width="80%">16. มนุษย์สัมพันธ์ (Interpersonal skills)
  <br>สามารถร่วมงานกับผู้อื่น การทำงานเป็นทีม สร้างมนุษย์สัมพันธ์ได้
  <br>ใคร่ ชอบพอของผู้ร่วมงาน เป็นผู้ที่ช่วยก่อให้เกิดความร่วมมือประสานงาน
  </td>
      <td style="text-align:center">10 คะแนน <br> <input name="evaluation_topic16" type="text" class="form-control" id="num_16" value="<?php echo $fet['evaluation_topic16']+0; ?>"></td>
    </tr>
    <tr>
      <td width="80%">17. ความมีระเบียบวินัย ปฏิบัติตามวัฒนธรรมขององค์กร
  <br>(Discipline and adaptability to formal organization)
  <br>ความสนใจเรียนรู้ศึกษากฎระเบียบ นโยบาย ต่างๆ และปฏิบัติตามโดยเต็มใจ
  <br>การปฏิบัติตามระเบียบบริหารงานบุคคล (การเข้างาน ลางาน) ปฏิบัติตามกฎ/ระเบียบ  การรักษาความ
  <br>ปลอดภัย การควบคุมคุณภาพ 5 ส. และอื่นๆ เป็นต้น
  </td>
      <td style="text-align:center">10 คะแนน <br> <input name="evaluation_topic17" type="text" class="form-control" id="num_17" value="<?php echo $fet['evaluation_topic17']+0; ?>"></td>
    </tr>
    <tr>
      <td width="80%">18. คุณธรรมและจริยธรรม (Ethics and morality)
  <br>มีความซื่อสัตย์ สุจริต มีจิตใจสะอาด รู้จักเสียสละ ไม่เห็นแก่ตัว เอื้อเฟื้อเผื่อแผผู้อื่น่
  </td>
      <td style="text-align:center">10 คะแนน <br> <input name="evaluation_topic18" type="text" class="form-control" id="num_18" value="<?php echo $fet['evaluation_topic18']+0; ?>"></td>
    </tr>
  </table>

  โปรดให้ข้อคิดที่เป็นประโยชน์แก่นักศึกษา  (Please give comment on the student)
  <hr>

  <div class="table-responsive">

  <table class="table table-bordered ">
    <thead>
    <tr style="text-align:center">
      <td>จุดเด่นของนักศึกษา (Strength)</td>
      <td>ข้อควรปรับปรุงของนักศึกษา (Improvement)</td>
    </tr>
  </thead>
    <tr>
      <td><textarea name="evaluation_strength" rows="8" cols="50" style=" resize: none;" ><?php echo $fet['evaluation_strength']; ?></textarea></td>
      <td><textarea name="evaluation_improvement" rows="8" cols="50" style=" resize: none;" ><?php echo $fet['evaluation_improvement']; ?></textarea></td>
    </tr>
  </table>
  </div>
  หากนักศึกษาผู้นี้สำเร็จการศึกษาแล้ว ท่านจะรับเข้าทำงานในสถานประกอบการแห่งนี้หรือไม่ (หากมีโอกาส )
   Once this student graduates, will you be interested to offer him/her a job? <br>
  <input type="radio" name="evaluation_work" value="1" <?php if($fet['evaluation_work'] == '1'){ echo "checked"; } ?> > รับ (Yes)
  <input type="radio" name="evaluation_work" value="2"  <?php if($fet['evaluation_work'] == '2'){ echo "checked"; } ?> > ไม่แน่ใจ (Not sure)
  <input type="radio" name="evaluation_work" value="3"  <?php if($fet['evaluation_work'] == ''){ echo "checked"; } ?> > ไม่รับ (No)

  <br>
  <br>
  ข้อคิดเห็นเพิ่มเติม (Other comments)
  <hr>
  <div class="table-responsive">

  <td><textarea name="evaluation_other" rows="8" cols="50" style=" resize: none;"><?php echo $fet['evaluation_other']; ?></textarea></td>
  </div>

  </form>
  <div class="table-responsive">
  <table class="table table-bordered" style="margin-top:25px;" >
    <tr>
      <td style="text-align:center" colspan="5">ตารางคะแนน</td>
    </tr>
    <tr style="text-align:center">
      <td>คะแนนรวม ข้อ   1-2   </td>
      <td width="100px"><input readonly type="text" class="form-control" id="sum_12"></td>
      <td>%1</td>
      <td width="100px"><input readonly type="text" class="form-control" id="avg_12"></td>
      <td>คะแนน</td>
    </tr>
    <tr style="text-align:center">
      <td>คะแนนรวม ข้อ   3-10   </td>
      <td width="100px"><input readonly type="text" class="form-control" id="sum_310"></td>
      <td>%4</td>
      <td width="100px"><input readonly type="text" class="form-control" id="avg_310"></td>
      <td>คะแนน</td>
    </tr>
    <tr style="text-align:center">
      <td>คะแนนรวม ข้อ  11-14    </td>
      <td width="100px"><input readonly type="text" class="form-control" id="sum_1114"></td>
      <td>%2</td>
      <td width="100px"><input readonly type="text" class="form-control" id="avg_1114"></td>
      <td>คะแนน</td>
    </tr>
    <tr style="text-align:center">
      <td>คะแนนรวม ข้อ   15-18  </td>
      <td width="100px" ><input readonly type="text" class="form-control" id="sum_1518"></td>
      <td>%2</td>
      <td width="100px"><input readonly type="text" class="form-control" id="avg_1518"> </td>
      <td>คะแนน</td>
    </tr>
    <tr style="text-align:center">
      <td colspan="2"></td>
      <td>รวม</td>
      <td width="100px"><input  readonly type="text" class="form-control" id="sum_avg"></td>
      <td>คะแนน</td>
    </tr>
    <tr style="text-align:center">
      <td colspan="2"></td>
      <td>รวม</td>
      <td width="100px">100</td>
      <td>คะแนน</td>
    </tr>
  </table>
  <input type="button" name=""  id="save_evaluation"  value="บันทึกข้อมูล" class="btn btn-success">

  </div>
  <br>

<?php } ?>
<table class="table table-bordered table-hover" style="margin-top:25px;">
<thead>
<tr class="f1">
  <td>ลำดับ</td>
  <td>รหัสนักศึกษา</td>
  <td>ชื่อนักศึกษา</td>
  <td>ตำแหน่งงาน</td>
  <td>ข้อมูล</td>
</tr>
</thead>
<?php
$sql = "SELECT * FROM tb_register_job a , tb_position b , tb_student c  WHERE a.coop_keyf = '".$_SESSION['session_key']."' AND job_status = '4' AND b.position_key = a.position_keyf AND c.student_key  = a.student_keyf ";
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
    <td>ลำดับ</td>
    <td><?php echo $fet['student_code']; ?></td>
    <td><?php echo $fet['student_name']." ".$fet['student_last']; ?></td>
    <td><?php echo $fet['position_name']; ?></td>
    <td>
      <form action="" method="post" style="margin-top:10px;">
      <input type="hidden" name="key_student" value="<?php echo $fet['student_key']; ?>">
      <input type="hidden" name="key_position" value="<?php echo $fet['position_key']; ?>">
      <button class="btn btn-success" type="submit">บันทึกข้อมูลผลการฝึกงาน</button>
    </form>
      <?php
      $sql2 = mysql_query("SELECT count(evaluation_key) as num FROM  tb_evaluation WHERE student_keyf = '".$fet['student_key']."' && position_keyf = '".$fet['position_key']."' ");
      $fet2 = mysql_fetch_array($sql2);
      if($fet2['num'] > '0' ){ ?>
        <form class="" action="include/report6/report_student.php" method="post" target="_blank" style="margin-top:10px;" >
        <input type="hidden" name="key_student" value="<?php echo $fet['student_key']; ?>">
        <input type="hidden" name="key_position" value="<?php echo $fet['position_key']; ?>">
        <button type="submit" name="button" class="btn btn-danger">พิมพ์ใบรายงานประเมินผลการฝึกงาน</button>
      </form>
<?php
}
?>

    </td>
  </tr>
<?php
}
?>
</table>
จำนวนข้อมูลทั้งหมด <?php echo $Num_Rows;?> ข้อมูล  จำนวนหน้าทั้งหมด <?php echo $Num_Pages; ?> หน้า :
<?php
if($Prev_Page)
{
echo " <a href='$_SERVER[SCRIPT_NAME]?page=job_cooperative&Page_data=$Prev_Page'><< ย้อนกลับ</a> ";
}
for($i=1; $i<=$Num_Pages; $i++){
if($i != $Page)
{
echo " <a href='$_SERVER[SCRIPT_NAME]?page=job_cooperative&Page_data=$i'><button class='btn btn-detail'>$i</button></a> ";
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
echo " <a href ='$_SERVER[SCRIPT_NAME]?page=job_cooperative&Page_data=$Next_Page'>ถัดไป>></a> ";
} ?>
  </div></div>


    <script type="text/javascript">
    show_date();

      $("#save_evaluation").click(function(){

        var r = confirm("ยืนยันการบันทึกข้อมูลการประเมินผลการฝึกงาน");
        if (r == true) {
          $('#form_evaluation').submit();
        }
      });

  $(this).keyup(function(e){
    var id = e.target.id;
    var val = $("#"+id).val();
    if(id == "num_1" || id == "num_2"){
      if(val < 0 || val > 20){
        alert("กรุณากรอกข้อมูลระหว่าง 0 - 20");
        $("#"+id).val('0');
      }
    }else{
      if(val < 0 || val > 10){
        alert("กรุณากรอกข้อมูลระหว่าง 0 - 10");
        $("#"+id).val('0');
      }
    }

  if(val != ""){
    var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
    var str = $("#"+id).val();
    if(!numberRegex.test(str)) {
    			alert('กรุณากรอกตัวเลขเท่านั้น');
        $("#"+id).val('0');
    			return false;
    }
  }

    show_date();
  });
      function show_date(){

        var num_1,num_2,num_3,num_4,num_5,num_6,num_7,num_8,num_9,num_10,num_11,num_12,num_13,num_14,num_15,num_16,num_17,num_18;
        var num12,num310,num1114,num1518;
        var avg_12,avg310,avg1114,avg1518;
        num_1 = parseInt($("#num_1").val());num_2 = parseInt($("#num_2").val());
        num_3 = parseInt($("#num_3").val());num_4 = parseInt($("#num_4").val());
        num_5 = parseInt($("#num_5").val());num_6 = parseInt($("#num_6").val());
        num_7 = parseInt($("#num_7").val());num_8 = parseInt($("#num_8").val());
        num_9 = parseInt($("#num_9").val());num_10 = parseInt($("#num_10").val());
        num_11 = parseInt($("#num_11").val());num_12 = parseInt($("#num_12").val());
        num_13 = parseInt($("#num_13").val());num_14 = parseInt($("#num_14").val());
        num_15 = parseInt($("#num_15").val());num_16 = parseInt($("#num_16").val());
        num_17 = parseInt($("#num_17").val());num_18 = parseInt($("#num_18").val());
        num12 = num_1 + num_2;
        num310 = num_3 + num_4 + num_5 + num_6 + num_7 + num_8 + num_9 + num_10;
        num1114 = num_11 + num_12 + num_13 + num_14;
        num1518 = num_15 + num_16 + num_17 + num_18;

        $("#sum_12").val(num12);
        $("#sum_310").val(num310);
        $("#sum_1114").val(num1114);
        $("#sum_1518").val(num1518);

        $("#avg_12").val(num12 / 1);
        $("#avg_310").val(num310 / 4);
        $("#avg_1114").val(num1114 / 2);
        $("#avg_1518").val(num1518 / 2);

        avg_12 = parseInt($("#avg_12").val());
        avg_310 = parseInt($("#avg_310").val());
        avg_1114 = parseInt($("#avg_1114").val());
        avg_1518 = parseInt($("#avg_1518").val());


        $("#sum_avg").val(avg_12+avg_310+avg_1114+avg_1518);


      }
    </script>
