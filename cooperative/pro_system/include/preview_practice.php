<meta charset="utf-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css?family=Taviraj" rel="stylesheet">
<style media="screen">
  body {
    font-family: 'Taviraj', serif;
    font-weight:bold;

  }
  thead{
  background-color:#ffcfa8;
  padding: 3px;
    border-width: 1px;
    border-style: solid;
    border-color: #f79646 #ccc;
  }

</style>
<?php
function changeDate($date){
$get_date = explode("-",$date);
  $month = array("01"=>"ม.ค.","02"=>"ก.พ","03"=>"มี.ค.","04"=>"เม.ย.","05"=>"พ.ค.","06"=>"มิ.ย.","07"=>"ก.ค.","08"=>"ส.ค.","09"=>"ก.ย.","10"=>"ต.ค.","11"=>"พ.ย.","12"=>"ธ.ค.");
$get_month = $get_date["1"];
$year = $get_date["0"]+543;
return $get_date["2"]." ".$month[$get_month]." ".$year;
}
?>
<body>
<?php include("connect.php"); session_start(); date_default_timezone_set("Asia/Bangkok"); ?>
<?php
$sql = mysql_query("SELECT * FROM  tb_register_job a ,  tb_student b , tb_position c , tb_faculty d , tb_course e WHERE a.position_keyf = '".$_GET['id']."' AND a.student_keyf = b.student_key AND a.position_keyf = c.position_key AND b.faculty_keyf = d.faculty_key AND b.course_key = e.course_key  AND a.job_status = 3  ");
$fet = mysql_fetch_array($sql);
 ?>
 <div align="center" style="margin-top:25px;"><img src="KRU.gif" width="110px" height="150px"></div>
<div class="" align="center">
  <div class="">
    <h3>ข้อมูลประกาศการฝึกปฏิบัติงานงาน ตำแหน่งงาน ( <?php echo $fet['position_name']; ?> )</h3><br><br>
  </div>
  <div class="">
    <table class="table table-bordered">
      <thead>
      <tr>
        <td>ลำดับ</td>
        <td>รหัสนักศึกษา</td>
        <td>ชื่อ</td>
        <td>คณะ</td>
        <td>สาขา</td>
      </tr>
    </thead>
      <?php
      $sql1 = mysql_query("SELECT * FROM  tb_register_job a ,  tb_student b , tb_position c , tb_faculty d , tb_course e ,  tb_practice f WHERE b.student_key = f.student_keyf AND c.position_key = f.position_keyf AND a.position_keyf = '".$_GET['id']."' AND a.student_keyf = b.student_key AND a.position_keyf = c.position_key AND b.faculty_keyf = d.faculty_key AND b.course_key = e.course_key  AND a.job_status = 3  ");
      while($fet1 = mysql_fetch_array($sql1)) {?>
        <tr>
          <td><?php echo $i+1?></td>
          <td><?php echo $fet1['student_code']; ?></td>
          <td><?php echo $fet1['student_name']." ".$fet1['student_last']; ?></td>
          <td><?php echo $fet1['faculty_name']; ?></td>
          <td><?php echo $fet1['course_name']; ?></td>
        </tr>
        <tr>
          <td></td>
          <td> วันที่ฝึกปฏิบัติงาน: <?php echo changeDate($fet1['prac_date']); ?></td>
          <td> เวลา : <?php echo $fet1['prac_time']; ?></td>
          <td> รายละเอียด : <?php echo $fet1['prac_note']; ?></td>
        </tr>
      <?php $i++; } ?>
    </table>
  </div>
</div>
</body>
