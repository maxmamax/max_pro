<?php include("include/connect.php"); session_start(); date_default_timezone_set("Asia/Bangkok"); ?>
<div class="panel panel-default">
  <div class="panel-heading"><h1><span class="glyphicon glyphicon-list" aria-hidden="true"></span> พิมพ์ใบรายงานการฝึกปฏิบัติงาน</h1></div>
    <div class="panel-body">
<?php
$sql = mysql_query("SELECT  count(register_key) as num FROM  tb_register_job WHERE student_keyf = '".$_SESSION['session_key']."' AND  job_status = '4' ");
$fet = mysql_fetch_array($sql);
if($fet['num'] == '1'){
$sql = mysql_query("SELECT * FROM  tb_register_job WHERE student_keyf = '".$_SESSION['session_key']."' AND  job_status = '4' ")  ;
$fet = mysql_fetch_array($sql);
?>
<table class="table table-bordered table-hover">
  <thead>
  <tr class="f1">
    <td width="250px;">รายการ</td>
    <td>ข้อมูลรายงาน</td>
  </tr>
</thead>

  <tr>
    <td>แบบประเมินผลการฝึกงาน</td>
    <td><?php
    $sql1 = mysql_query("SELECT count(evaluation_key) FROM tb_evaluation WHERE student_keyf = '".$_SESSION['session_key']."' AND position_keyf = '".$fet['position_keyf']."' ");
    $fet1 = mysql_fetch_array($sql1);
    if($fet1){ ?>
      <form class="" action="include\report6\report_student.php" method="post" target="_blank">
        <input type="hidden" name="key_position" value="<?php echo $fet['position_keyf']; ?>">
        <input type="hidden" name="key_student" value="<?php echo $_SESSION['session_key']; ?>">
        <button class="btn btn-danger" type="submit">รายงาน</button>
      </form>
    <?php
    }else {
      echo "ไม่พบข้อมูลบันทึกการฝึกงานประจำวันของนักศึกษา";
    }
    ?></td>
  </tr>

</table>
<?php }else{
echo "ไม่พบข้อมูลตำแหน่งงานที่ฝึกปฏิบัติงาน";
} ?>
    </div></div>
