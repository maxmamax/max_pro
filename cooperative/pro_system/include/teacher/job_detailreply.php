<?php include("../connect.php"); session_start(); ?>
<style media="screen">
.f{
  font-size:25px;
}
.f1{
  font-size:15px;
}
</style>
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
<?php if($_SESSION['session_status_menu'] == 'teacher' && $_GET['cooperative'] != ''  ){ ?>

<div class="panel panel-default">
  <div class="panel-heading"><h1>สถานประกอบการ</h1></div>
  <div class="panel-body">
    <?php if($_SESSION['session_status_menu'] == 'teacher'  && $_GET['cooperative'] != '' ){
  $sql = mysql_query("SELECT * FROM tb_cooperative WHERE coop_key = '".$_GET['cooperative']."' ");
  $fet = mysql_fetch_array($sql);
  if($fet){
  ?>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title f">ข้อมูลสถานประกอบการ <?php echo "( ".$fet['coop_Tname']." ) "; ?></h3>
              <div align="right" ><input type="button" class="btn btn-danger" value="ย้อนหลับ" id="r"></div>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-12 col-lg-12 " align="center"></div>
                <div class=" col-md-9 col-lg-12 ">
                  <table class="table table-user-information">
                    <tbody>
                      <tr class="f">
                        <td colspan="2">ข้อมูลสถานประกอบการ</td>
                        <td></td>
                      </tr>
                      <tr>
                        <td>ชื่อสถานประกอบการภาษาไทย</td>
                        <td><?php echo $fet['coop_Tname']; ?></td>
                          </tr>
                      <tr>
                        <td>ชื่อสถานประกอบการภาษาอังกฤษ</td>
                        <td><?php echo $fet['coop_Ename']; ?></td>
                      </tr>
                         <tr>
                             <tr>
                        <td>ประเภทสถานประกอบการ</td>
                        <td><?php echo $fet['type_name']; ?>ale</td>
                      </tr>
                        <tr>
                        <td>ที่อยู่</td>
                        <td><?php echo $fet['coop_address']." ตำบล ".$fet['coop_sdistrict']." อำเภอ ".$fet['coop_district']." จังหวัด ".$fet['coop_province']." รหัสไปรษณีย์ ".$fet['coop_code']; ?></td>
                      </tr>
                      <tr>
                      <td>เบอร์โทรศัพท์</td>
                      <td><?php echo $fet['coop_phone']; ?></td>
                      </tr>
                    <tr>
                      <td>อีเมล</td>
                      <td><?php echo $fet['coop_email']; ?></td>
                      </tr>
                      <tr>
                        <td>เว็บไซด์</td>
                        <td><?php echo $fet['coop_web']; ?></td>
                        </tr>
        </tbody>
                  </table>
<?php
$sql2 = mysql_query("SELECT count(student_keyf) as c FROM tb_register_job WHERE student_keyf = '".$_SESSION['session_key']."' AND position_keyf = '".$_GET['position']."' ");
$fet2 = mysql_fetch_array($sql2);
if($fet2['c'] == '1'){ ?> <font color="red" class="f">* ตำแหน่งงานนี้ได้จองแล้ว</font> <?php }else {

?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div><?php } }
  } } ?>

<script type="text/javascript">
  $("#r").click(function(){
    $("#show_data").show();
    $("#show_detail").html('');
  });
</script>
