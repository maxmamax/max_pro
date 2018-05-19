<meta charset="utf-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<?php include("../connect.php"); session_start(); date_default_timezone_set("Asia/Bangkok"); ?>
<?php
$sql = mysql_query("SELECT (position_name) FROM tb_position WHERE position_key = '".$_GET['id']."' ");
$fet = mysql_fetch_array($sql);
$s = mysql_query("SELECT (job_status) FROM  tb_register_job WHERE student_keyf = '".$_SESSION['session_key']."' AND position_keyf = '".$_GET['id']."' ");
$f = mysql_fetch_array($s);
?>
<div align="center" style="margin-top:25px;"><img src="../KRU.gif" width="110px" height="150px"></div>

<div class="" align="center">
  <h3>ผลการสัมภาษณ์/การฝึกปฏิบัติงาน  ตำแหน่งงาน ( <?php echo $fet['position_name']; ?> )</h3>
</div>

<table class="table table-bordered">
  <tr>
    <td width="180px">ผลการสัมภาษณ์</td>
    <td>
      <?php
       if($f['job_status'] == '0'){echo "การตรวจสอบ";
      }else if($f['job_status'] == '1'){ echo "นัดสัมภาษณ์งาน";
      }else if($f['job_status'] == '2'){ echo "ไม่ผ่านการสัมภาษณ์งาน";
      }else if($f['job_status'] == '3'){ echo "่ผ่านการสัมภาษณ์งาน";
      }?>
    </td>
    </tr>
      <?php
      $sql2 = mysql_query("SELECT * FROM tb_interview  WHERE student_keyf = '".$_SESSION['session_key']."' AND position_keyf = '".$_GET['id']."'  ");
      $fet2 = mysql_fetch_array($sql2);
      ?>
      <tr >
        <td >การนัดสัมภาษณ์</td>
        <td ></td>

      </tr>
      <tr >
        <td >ยืนยันวันที่</td>
        <td><?php echo $fet2['iter_datecon']; ?></td>
      </tr>
        <tr >
          <td>สถานที่สัมภาษณ์</td>
          <td><?php echo $fet2['inter_place']; ?></td>
        </tr>
        <tr >
          <td>วันที่สัมภาษณ์</td>
          <td><?php echo $fet2['inter_date']; ?></td>
        </tr>
        <tr >
          <td>เวลาที่สัมภาษณ์</td>
          <td><?php echo $fet2['inter_time']; ?></td>
        </tr>
        <tr >
        <td>สิ่งที่ต้องเตรียมมาสัมภาษณ์</td>
        <td><?php echo $fet2['inter_note']; ?></td>
      </tr>
    </table>

    <table class="table table-bordered">
      <tr>
        <td width="180px">ผลการสัมภาษณ์</td>
        <td>
          <?php
          if($f['job_status'] == '1'){echo "อยู่ในระหว่างรอการสัมภาษณ์";
          }else if($f['job_status'] == '2'){ echo "ไม่ผ่านการสัมภาษณ์";
          }else if($f['job_status'] == '3'){ echo "ผ่านการสัมภาษณ์";
          }?>
        </td>
      </tr>
      <?php
      $sql3 = mysql_query("SELECT * FROM tb_practice  WHERE student_keyf = '".$_SESSION['session_key']."' AND position_keyf = '".$_GET['position']."'  ");
      $fet3 = mysql_fetch_array($sql3);
      ?>
      <tr>
        <td>ยืนยันวันที่</td>
        <td><?php echo $fet3['prac_datecon']; ?></td>
      </tr>
      <tr>
        <td>วันที่ฝึกปฏิบัติงาน</td>
        <td><?php echo $fet3['prac_date']; ?></td>
      </tr>
      <tr>
        <td>เวลา</td>
        <td><?php echo $fet3['prac_time']; ?></td>
      </tr>
      <tr>
        <td>รายละเอียด</td>
        <td><?php echo $fet3['prac_note']; ?></td>
      </tr>
    </table>
