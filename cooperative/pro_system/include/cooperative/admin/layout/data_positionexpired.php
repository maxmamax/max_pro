<?php include("process/connect.php"); session_start(); date_default_timezone_set("Asia/Bangkok"); ?>
<style media="screen">
tr{
  font-family: 'Mitr', sans-serif;
}
td{
  font-family: 'Mitr', sans-serif;
}
table{
  font-family: 'Mitr', sans-serif;
}
h1{
  font-family: 'Mitr', sans-serif;
}
h3{
  font-family: 'Mitr', sans-serif;
}
input{
  font-family: 'Mitr', sans-serif;
}
font{
  font-family: 'Mitr', sans-serif;
}
.f{
  font-size:18px;
}
.f1{
  font-size:25px;
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
<?php
 if($_POST['chk'] != "" && $a == 0){

   foreach ($_POST['chk'] as $key => $value) {

   echo $value;
   }
 }
?>
<?php if($_SESSION['session_key'] == '1' && $_GET['coop'] == '' && $_GET['position'] == '' ){ ?>

<div class="panel panel-default">
  <div class="panel-heading"><h1>การลบข้อมูลตำแหน่งงาน</h1></div>
  <div class="panel-body">
    <form action="" method="post">
      <input type="hidden" name="page" value="data_positionexpired">
      <div class="form-group row">
        <div class="col-md-3">
          <label for="" class="f1">ข้อมูลปิดรับสมัคร</label>
          <select class="form-control" name="r">
            <option value="">ข้อมูลทั้งหมด</optin>
            <option value="30">30 วัน</optin>
            <option value="90">90 วัน</optin>
            <option value="180">180 วัน</optin>
          </select>
        </div>
        <div class="col-md-1">
          <label for="" class="f1">ค้นหา</label>
          <input type="submit" name="" value="ค้นหา" class="btn btn-success form-control">
        </div>
      </div>
    </form>
    <div class="table-responsive">
<form class="" action="" method="post" name="form1">
<table class="table table-bordered f">
  <tr>
    <td><input type="checkbox" value="1" id="chk" name="chk"></td>
    <td>ลำดับ</td>
    <td>สถานประกอบการ</td>
    <td>ตำแหน่งงาน</td>
    <td>วันที่เปิดรับสมัคร</td>
    <td>วันที่ปิดรับสมัคร</td>
    <td>จำนวนที่สมัคร</td>
  </tr>

<?php
if($_POST['r'] == ""){
  $_POST['r'] = '1';
}
$i=1;
$sql = "SELECT * FROM tb_position as a INNER JOIN tb_cooperative as b ON (a.coop_keyf = b.coop_key)  WHERE DATEDIFF(NOW(),position_dateL) >= '".$_POST['r']."'   $qu ";
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
  <tr>
    <td><input type="checkbox" value="<?php echo $fet['position_key']; ?>" name="chk[]" id="chk1"></td>
    <td><?php echo  (($Page-1)*10)+$i ; ?></td>
    <td><a href="index.php?page=data_positionexpired&coop=<?php echo $fet['coop_key']; ?>"><?php echo $fet['coop_Tname']; ?></a></td>
    <td><a href="index.php?page=data_positionexpired&position=<?php echo $fet['position_key']; ?>"><?php echo $fet['position_name']; ?></a></td>
    <td><?php echo thaidate($fet['position_dateF']); ?></td>
    <td><?php echo thaidate($fet['position_dateL']); ?></td>
    <td><?php echo $fet['position_rate']."/".$fet['position_register']; ?></td>
  </tr>
<?php $i++;
}
?>
</table>
<input type="submit" name="" value="กด">
</form>
</div>
Total <?php $Num_Rows;?> Record : <?=$Num_Pages;?> Page :
<?php
if($Prev_Page)
{
echo " <a href='$_SERVER[SCRIPT_NAME]?page=data_positionexpired&Page_data=$Prev_Page&s_coop=$_GET[s_coop]&s_position=$_GET[s_position]&s_type=$_GET[s_type]&s_s=$_GET[s_ss]'><< Back</a> ";
}
for($i=1; $i<=$Num_Pages; $i++){
if($i != $Page)
{
echo " <a href='$_SERVER[SCRIPT_NAME]?page=data_positionexpired&Page_data=$i&s_coop=$_GET[s_coop]&s_position=$_GET[s_position]&s_type=$_GET[s_type]&s_s=$_GET[s_ss]'><button class='btn btn-detail'>$i</button></a> ";
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
echo " <a href ='$_SERVER[SCRIPT_NAME]?page=data_positionexpired&Page_data=$Next_Page&s_coop=$_GET[s_coop]&s_position=$_GET[s_position]&s_type=$_GET[s_type]&s_s=$_GET[s_ss]'>Next>></a> ";
} ?>
<?php

?>
    </div>
    </div>
<?php }else if($_SESSION['session_key'] == '1' && $_GET['coop'] != '' && $_GET['position'] == '' ){
$sql = mysql_query("SELECT * FROM  tb_cooperative WHERE coop_key = '".$_GET['coop']."' ");
$fet = mysql_fetch_array($sql);
?>
<div class="panel panel-default">
  <div class="panel-heading"><h1>ตำแหน่งานสถานประกอบการ <?php echo " ( ".$fet['coop_Tname']." ) "; ?></h1></div>
  <div class="panel-body">
<table class="table table-borderedf">
  <tr >
    <td>ลำดับ</td>
    <td>ตำแหน่งงาน</td>
    <td>วันที่ปิดรับสมัคร</td>
    <td>จำนวนที่สมัคร</td>
  </tr>

<?php
$i=1;
$sql = mysql_query("SELECT * FROM tb_position as a INNER JOIN tb_cooperative as b ON (a.coop_keyf = b.coop_key) WHERE DATEDIFF(NOW(),position_dateL) <= 0 AND b.coop_key = '".$_GET['coop']."' ");
while($fet = mysql_fetch_array($sql)){ ?>
  <tr class="f">
    <td><?php echo $i; ?></td>
    <td><a href="index.php?page=data_positionexpired&position=<?php echo $fet['position_key']; ?>"><?php echo $fet['position_name']; ?></a></td>
    <td><?php echo thaidate($fet['position_dateL']); ?></td>
    <td><?php echo $fet['position_rate']."/".$fet['position_register']; ?></td>
  </tr>
<?php $i++;
}
?>
</table>
    </div>
    </div>
<?php }else if($_SESSION['session_key'] == '1' && $_GET['coop'] == '' && $_GET['position'] != '' ){
  $sql = mysql_query("SELECT * FROM tb_position as a INNER JOIN tb_cooperative as b ON (a.coop_keyf = b.coop_key) INNER JOIN tb_type_ope e ON (a.position_typef = e.type_key)  WHERE position_key = '".$_GET['position']."'  ");
  $fet = mysql_fetch_array($sql);
  if($fet){
  ?>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title f">ข้อมูลตำแหน่งงาน <?php echo "( ".$fet['position_name']." ) "; ?></h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-12 col-lg-12 " align="center"></div>
                <div class=" col-md-9 col-lg-12 ">
                  <table class="table table-user-information">
                    <tbody>
        <!-- ข้อมูลตำแหน่งงาน -->
                      <tr class="f">
                        <td colspan="2">ข้อมูลตำแหน่งงาน</td>
                        <td></td>
                      </tr>
                      <tr >
                        <td>ตำแหน่งงาน</td>
                        <td><?php echo $fet['position_name']; ?></td>
                      </tr>
                      <tr>
                        <td>แผนก</td>
                        <td><?php echo $fet['position_depart']; ?></td>
                          </tr>
                      <tr>
                        <td>วันที่รับสมัคร</td>
                        <td><?php echo thaidate($fet['position_dateF']); ?></td>
                      </tr>
                         <tr>
                             <tr>
                        <td>วันที่ปิดรับสมัคร</td>
                        <td><?php echo thaidate($fet['position_dateL']); ?></td>
                      </tr>
                        <tr>
                        <td>คุณสมบัติ</td>
                        <td><?php echo $fet['position_property']; ?></td>
                      </tr>
                      <tr>
                      <td>สวัสดีการ/ค่าตอบแทน</td>
                      <td><?php echo $fet['position_money']; ?></td>
                      </tr>
                      <td>จำนวนที่รับสมัคร</td>
                      <td><?php echo $fet['position_register']; ?></td>
                      </tr>

        <!-- ข้อมูลสถานประกอบการ -->
                      <tr>
                        <td></td>
                        <td></td>
                      </tr>
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
<?php
  $key_branch = $fet['branch_keyf'];
if($key_branch != "0" ){
  $sql1 = mysql_query("SELECT * FROM tb_branch WHERE branch_key = '$key_branch'  ");
  $fet1 = mysql_fetch_array($sql1);
   ?>
                    <tr>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr class="f">
                      <td>ข้อมูลสาขาย่อย</td>
                      <td></td>
                    </tr>
                    <tr>
                      <td>ชื่อสาขาย่อย</td>
                      <td><?php echo $fet1['branch_name']; ?></td>
                        </tr>
                      <tr>
                      <td>ที่อยู่</td>
                      <td><?php echo $fet1['branch_address']." ตำบล ".$fet['branch_sdistrict']." อำเภอ ".$fet['branch_district']." จังหวัด ".$fet['branch_province']." รหัสไปรษณีย์ ".$fet['branch_code']; ?></td>
                    </tr>
                    <tr>
                    <td>เบอร์โทรศัพท์</td>
                    <td><?php echo $fet1['branch_phone']; ?></td>
                    </tr>
                  <tr>
                    <td>อีเมล</td>
                    <td><?php echo $fet1['branch_email']; ?></td>
                    </tr>
                    <tr>
                      <td>เว็บไซด์</td>
                      <td><?php echo $fet1['branch_web']; ?></td>
                      </tr>
<?php
}
?>
        </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div><?php }
    }?>

<script type="text/javascript">
  $("#add").click(function(){
    var r = confirm("ยืนยันการบันทึกข้อมูล");
    if (r == true) {
        $('#form_addjob').submit();
    }
  });
  var a=0
  $("#chk").click(function(){
    var data = $(this).val();
          if(a == 0){
            $(':checkbox').each(function() {
                this.checked = true;
                a = 1;
            });
          }else{
            $(':checkbox').each(function() {
                this.checked = false;
                a = 0;
            });
          }
  });

</script>
