<meta charset="utf-8">
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
<link href="../dist/css/bootstrap.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Taviraj" rel="stylesheet">
<style media="screen">
  body {
    font-family: 'Taviraj', serif;
    font-weight:bold;
  }
  .f1{
    font-size:20px;
  }
  .f2{
    font-size:15px;
  }
</style>
<body>
<?php include("../include/connect.php"); session_start(); date_default_timezone_set("Asia/Bangkok"); ?>
<?php
function changeDate($date){
$get_date = explode("-",$date);
$month = array("01"=>"ม.ค.","02"=>"ก.พ","03"=>"มี.ค.","04"=>"เม.ย.","05"=>"พ.ค.","06"=>"มิ.ย.","07"=>"ก.ค.","08"=>"ส.ค.","09"=>"ก.ย.","10"=>"ต.ค.","11"=>"พ.ย.","12"=>"ธ.ค.");
$get_month = $get_date["1"];
$year = $get_date["0"]+543;
return $get_date["2"]." ".$month[$get_month]." ".$year;
}
$sql = mysql_query("SELECT * FROM tb_position as a INNER JOIN tb_cooperative as b ON (a.coop_keyf = b.coop_key) INNER JOIN tb_type_ope e ON (a.position_typef = e.type_key)  WHERE DATEDIFF(NOW(),a.position_dateL) <= 0 AND a.position_key = '".$_GET['id']."'  ");
$fet = mysql_fetch_array($sql);
?>
<div align="center" style="margin-top:25px;"><img src="KRU.gif" width="110px" height="150px"></div>
<div class="panel-body">
  <div class="panel panel-default">
    <div class="panel-heading f1"><font><span class="glyphicon glyphicon-list" aria-hidden="true"></span> ข้อมูลตำแหน่งงาน</font></div>
    <div class="panel-body">
      <table class="table table-bordered">
        <tr>
          <td width="150px;">ตำแหน่งงาน : </td>
          <td><?php echo $fet['position_name']; ?></td>
        </tr>
        <tr>
          <td >วันที่เปิดรับสมัคร : </td>
          <td><?php echo changeDate($fet['position_dateF']); ?></td>
        </tr>
        <tr>
          <td >วันที่ปิดรับสมัคร : </td>
          <td><?php echo changeDate($fet['position_dateL']); ?></td>
        </tr>
        <tr>
          <td >จำนวนที่รับสมัคร : </td>
          <td><?php echo $fet['position_register']; ?></td>
        </tr>
        <tr>
            <td >จำนวนที่สมัคร : </td>
            <td><?php echo $fet['position_rate']; ?></td>
          </tr>
      </table>

      <table class="table table-bordered">
        <tr>
          <td>คุณสมบัติ</td>
        </tr>
        <tr>
          <td width="150px">เพศ :</td>
          <td><?php
          if($fet['position_sex'] == '1'){
            echo "ชาย";
          }else if($fet['position_sex'] == '2'){
              echo "หญิง";
          }else if($fet['position_sex'] == '3'){
              echo "ชายและหญิง";
          }
          ?></td>
        </tr>
        <tr>
          <td>อายุ :</td>
          <td><?php echo $fet['position_old']." ปี "; ?></td>
        </tr>
        <tr>
          <td>วุฒิการศึกษา	 :</td>
          <td>
            <?php
            if($fet['position_edu'] == '1' ){
              echo "ระดับมัธยมศึกษาปีที่6";
            }else if($fet['position_edu'] == '2' ){
              echo "ระดับปวช/ระดับปวส";
            }else if($fet['position_edu'] == '3' ){
              echo "ระดับปริญญาตรี";
            }else if($fet['position_edu'] == '4' ){
              echo "ระดับปริญญาโท";
            }else if($fet['position_edu'] == '5' ){
              echo $fet['position_eduorter'];
            }else{
              echo "ไม่ระบุ";
            }
            ?>
          </td>
        </tr>
        <tr>
          <td>ข้อมูลคุณสมบัติอื่นๆ</td>
          <td><?php echo $fet['message_add']; ?></td>
        </tr>
      </table>
      <table class="table table-bordered">
        <tr>
          <td width="150px">สวัสดีการ</td>
        </tr>
        <tr>
          <td></td>
          <td>
            <?php if($fet['position_bonus'] == "1"){ ?>
              <img src="../img/chk_y.jpg">
            <?php }else{ ?>
              <img src="../img/chk_n.jpg">
            <?php  } ?>   โบนัส
          </td>
          <td>
            <?php if($fet['position_acco'] == "1"){ ?>
              <img src="../img/chk_y.jpg">
            <?php }else{ ?>
              <img src="../img/chk_n.jpg">
            <?php  } ?>   ที่พัก
          </td>
          <td>
            <?php if($fet['position_uniform'] == "1"){ ?>
              <img src="../img/chk_y.jpg">
            <?php }else{ ?>
              <img src="../img/chk_n.jpg">
            <?php  } ?>   ชุดฟอร์มพนักงาน
          </td>
          <td>
            <?php if($fet['position_diligence'] == "1"){ ?>
              <img src="../img/chk_y.jpg">
            <?php }else{ ?>
              <img src="../img/chk_n.jpg">
            <?php  } ?>   เบี้ยขยัน
          </td>
          <td>
            <?php if($fet['position_medical'] == "1"){ ?>
              <img src="../img/chk_y.jpg">
            <?php }else{ ?>
              <img src="../img/chk_n.jpg">
            <?php  } ?>   ค่ารักษาพยาบาล
          </td>
        </tr>
        <tr>
          <td>ข้อมูลคุณสมบัติอื่นๆ</td>
          <td><?php echo $fet['message_add1']; ?></td>
        </tr>
      </table>
    </div>


  </div>
  <div class="panel panel-default">
    <div class="panel-heading f1"><font><span class="glyphicon glyphicon-list" aria-hidden="true"></span> ข้อมูลสถานประกอบการ</font></div>
    <div class="panel-body">
      <table class="table table-bordered">
        <tr>
          <td width="250px;">ชื่อสถานประกอบการภาษาไทย : </td>
          <td><?php echo $fet['coop_Tname']; ?></td>
        </tr>
        <tr>
          <td >ชื่อสถานประกอบการภาษาอังกฤษ : </td>
          <td><?php echo $fet['coop_Ename']; ?></td>
        </tr>
        <tr>
          <td >ที่อยู่ : </td>
          <td><?php echo $fet['coop_address']." ตำบล ".$fet['coop_sdistrict']." อำเภอ ".$fet['coop_district']." จังหวัด ".$fet['coop_province']." รหัสไปรษณีย์ ".$fet['coop_code']; ?></td>
        </tr>
        <tr>
          <td >เบอร์โทรศัพท์ : </td>
          <td><?php echo $fet['coop_phone']; ?></td>
        </tr>
        <tr>
          <td >อีเมลล์ : </td>
          <td><?php echo $fet['coop_email']; ?></td>
        </tr>
        <tr>
          <td>เว็บไซด์ : </td>
          <td><?php echo $fet['coop_web']; ?></td>
        </tr>
      </table>
    </div>
  </div>
  <?php
    $key_branch = $fet['branch_keyf'];
  if($key_branch != "0" ){
    $sql1 = mysql_query("SELECT * FROM tb_branch WHERE branch_key = '$key_branch'  ");
    $fet1 = mysql_fetch_array($sql1);
     ?>
  <div class="panel panel-default">
    <div class="panel-heading"><font>ข้อมูลสาขาย่อย</font></div>
    <div class="panel-body">
      <table class="table table-bordered">
        <tr>
          <td width="150px">ชื่อสาขาย่อย</td>
          <td><?php echo $fet1['branch_name']; ?></td>
        </tr>
        <tr>
          <td>ที่อยู่</td>
          <td><?php echo $fet1['branch_address']." ตำบล ".$fet['branch_sdistrict']." อำเภอ ".$fet['branch_district']." จังหวัด ".$fet['branch_province']." รหัสไปรษณีย์ ".$fet['branch_code']; ?></td>
        </tr>
        <tr>
          <td >เบอร์โทรศัพท์</td>
          <td><?php echo $fet1['branch_phone']; ?></td>
        </tr>
        <tr>
          <td >อีเมลล์</td>
          <td><?php echo $fet1['branch_email']; ?></td>
        </tr>
        <tr>
          <td >เว็บไซด์</td>
          <td><?php echo $fet1['branch_web']; ?></td>
        </tr>
        <tr>
      </table>
    </div></div>
  <?php } ?>
</div>
</body>
