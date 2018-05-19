<?php include("include/connect.php"); session_start(); ?>
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

  function changeDate($date){
  $get_date = explode("-",$date);
    $month = array("01"=>"ม.ค.","02"=>"ก.พ","03"=>"มี.ค.","04"=>"เม.ย.","05"=>"พ.ค.","06"=>"มิ.ย.","07"=>"ก.ค.","08"=>"ส.ค.","09"=>"ก.ย.","10"=>"ต.ค.","11"=>"พ.ย.","12"=>"ธ.ค.");
  $get_month = $get_date["1"];
  $year = $get_date["0"]+543;
  return $get_date["2"]." ".$month[$get_month]." ".$year;
  }
?>
<?php if( $_GET['coop'] == '' && $_GET['position'] == '' ){ ?>

<div class="panel panel-default ">
  <div class="panel-heading"><h1><span class="glyphicon glyphicon-list" aria-hidden="true"></span> ตำแหน่งงาน</h1></div>
  <div class="panel-body" >
    <form action="" method="get">
      <div class="form-group row">
        <div class="col-md-4">
          <label for="ex1"><font class="f1">สถานประกอบการ</font></label>
          <select class="form-control" name="s_coop" id="s_coop">
            <option value="">-- สถานประกอบการ --</option>
<?php
$sql = mysql_query("SELECT * FROM  tb_cooperative WHERE coop_status = '2' ");
while($fet = mysql_fetch_array($sql)){
?>
<option <?php if($_GET['s_coop'] == $fet['coop_key']){ echo "selected"; } ?> value="<?php echo $fet['coop_key']; ?>" <?php if($fet['coop_key'] == $_POST['s_coop']) { echo "selected"; } ?> ><?php echo $fet['coop_Tname']; ?></option>
<?php }?>
          </select>
        </div>
        <div class=" col-md-4" id="type">
          <label for="ex1"><font class="f1">ประเภทงาน</font></label>
          <select class="form-control" name="s_type" id="s_type">
            <option value="">-- ประเภทงาน  --</option>
<?php
$sql = mysql_query("SELECT * FROM  tb_type_ope ");
while($fet = mysql_fetch_array($sql)){
?>
<option <?php if($_GET['s_type'] == $fet['type_key']){ echo "selected"; } ?> value="<?php echo $fet['type_key']; ?>" <?php if($fet['type_key'] == $_POST['s_type']) { echo "selected"; } ?> ><?php echo $fet['type_name']; ?></option>
<?php }?>
          </select>
        </div>
        <div class=" col-md-3">
          <label for="ex1"><font class="f1">ตำแหน่งงาน</font></label>
          <div class="" id="select_position">
            <input class="form-control"  type="text" placeholder="ตำแหน่งงาน" name="s_position" value="<?php echo $_GET['s_position']; ?>">
          </div>
        </div>
        <div class=" col-md-3">
          <label for="ex1"><font class="f1">ค้นหาตามจังหวัด</font></label>
          <input class="form-control" type="text" placeholder="จังหวัด" name="s_province" value="<?php echo $_GET['s_province']; ?>">
        </div>
        <div class=" col-md-2">
          <label for="ex1"><font class="f1">คำค้นหา</font></label>
          <input class="form-control" type="text" placeholder="คำค้นหา" name="s_s" value="<?php echo $_GET['s_s']; ?>">
        </div>
        <div class=" col-md-2" >
          <label for="ex1"><font class="f1">ค้นหา</font></label>
          <button class="btn btn-success" name="button" type="submit"><font class="ff"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> ค้นหา</font></button>
        </div>
      </div>

    </form>
  <div class="table-responsive">
<table class="table table-bordered ">
  <thead>
 <tr class="f1">
    <th>ลำดับ</th>
    <th>สถานประกอบการ</th>
    <th>จำนวนตำแหน่งงาน</th>
    <th>ข้อมูล</th>
 </tr>
</thead>
<?php
if($_GET['s_coop'] != ""){
  $txt = $_GET['s_coop'];
  $qu .= " AND b.coop_key LIKE '$txt' ";
}
if($_GET['s_position'] != ""){
  $txt = $_GET['s_position'];
  $qu .= " AND a.position_name LIKE '%$txt%' ";
}
if($_GET['s_type'] != ""){
  $txt = $_GET['s_type'];
  $qu .= " AND a.position_typef LIKE '$txt' ";
}
if($_GET['s_s'] != ""){
  $txt = $_GET['s_s'];
  $qu .= " AND b.coop_s LIKE '%$txt%' ";
}

?>
<?php
$i=1;
if($_GET['s_coop'] != ""){
  $q = " AND coop_key = '".$_GET['s_coop']."'";
}
if($_GET['s_province'] != ""){
  $txt = $_GET['s_province'];
  $q .= " AND coop_province LIKE '%$txt%' ";
}
$sql = "SELECT * FROM tb_cooperative  WHERE coop_status = 2  $q  AND coop_s LIKE '%".$_GET['s_s']."%' $qu3  ";
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
if($_GET['s_type'] != ""){
  $q1 = " AND a.position_typef = '".$_GET['s_type']."' ";
}
if($_GET['s_position'] != ""){
  $q2 = " AND a.position_name LIKE '%".$_GET['s_position']."%' ";
}
while($fet = mysql_fetch_array($sql_qu)){
  ?>
  <tr class="f2">
    <td><?php echo  (($Page-1)*10)+$i ; ?></td>
    <td><a href="index.php?coop=<?php echo $fet['coop_key']; ?>"><?php echo $fet['coop_Tname']; ?></a></td>
<?php
$sql1 = mysql_query("SELECT count(position_key) as num FROM tb_position a WHERE a.position_status = '1' AND a.coop_keyf = '".$fet['coop_key']."' AND DATEDIFF(NOW(),a.position_dateL) <= 0 $q1 $q2 ");
$fet1 = mysql_fetch_array($sql1); ?>
  <td><?php echo $fet1['num']+0; ?></td>
  <td><button class="btn btn-default" data-toggle="collapse" data-target="#demo<?php echo $i; ?>"><font> <span class="glyphicon glyphicon-eye-open" aria-hidden="true" style="color:#000000;"></span> ดูข้อมูล</font></button></td>

</tr>
  <tr >
  <td colspan="4">
      <div id="demo<?php echo $i; ?>" class="collapse">
      <?php
      $sql1 = mysql_query("SELECT * FROM tb_position a , tb_type_ope b WHERE  a.coop_keyf = '".$fet['coop_key']."' AND DATEDIFF(NOW(),a.position_dateL) <= 0 AND a.position_status = '1' AND a.position_status = 1 AND a.position_typef = b.type_key $q1 $q2");
      while($fet1 = mysql_fetch_array($sql1)){ ?>
        <div class="panel panel-default">
    <div class="panel-heading"><font class="f1"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> ตำแหน่งงาน ( <?php echo $fet1['position_name']; ?> )</font></div>
    <div class="panel-body">
      <table class="table table-bordered">
        <tr>
          <td width="150px">ตำแหน่งงาน</td>
          <td><?php echo $fet1['position_name']; ?></td>
        </tr>
        <tr>
          <td>ประเภทงาน</td>
          <td><?php echo $fet1['type_name']; ?></td>
        </tr>
        <tr>
          <td>เปิดรับสมัครวันที่</td>
          <td><?php echo changeDate($fet1['position_dateF']); ?></td>
        </tr>
        <tr>
          <td>ปิดรับสมัครวันที่</td>
          <td><?php echo changeDate($fet1['position_dateL']); ?></td>
        </tr>
        <tr>
          <td>จำนวนที่รับ</td>
          <td><?php echo $fet1['position_register']." คน"; ?></td>
        </tr>
        <tr>
          <td>จำนวนที่สมัคร</td>
          <td><?php echo $fet1['position_rate']." คน"; ?></td>
        </tr>
        <tr>
          <td>รายละเอียดเพิ่มเติม</td>
          <td><button id="show_position" value="<?php echo $fet1['position_key']; ?>" class="btn btn-default"><span class="glyphicon glyphicon-eye-open" aria-hidden="true" style="color:#000000;"></span> ดูข้อมูล</button></td>
        </tr>
      </table>
    </div>
  </div>

<?php  } ?>
      </div>
  </td>
  </tr>
<?php
$i++;
}
?>
</table>
</div>
จำนวนข้อมูลทั้งหมด <?php echo $Num_Rows;?> ข้อมูล  จำนวนหน้าทั้งหมด <?php echo $Num_Pages; ?> หน้า :
<?php
if($Prev_Page)
{
echo " <a href='$_SERVER[SCRIPT_NAME]?page=job_register&Page_data=$Prev_Page&s_coop=$_GET[s_coop]&s_position=$_GET[s_position]&s_type=$_GET[s_type]&s_s=$GET[s_s]'><< ย้อนกลับ</a> ";
}
for($i=1; $i<=$Num_Pages; $i++){
if($i != $Page)
{
echo " <a href='$_SERVER[SCRIPT_NAME]?page=job_register&Page_data=$Prev_Page&s_coop=$_GET[s_coop]&s_position=$_GET[s_position]&s_type=$_GET[s_type]&s_s=$GET[s_s]'><button class='btn btn-detail'>$i</button></a> ";
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
echo " <a href ='$_SERVER[SCRIPT_NAME]?page=job_register&Page_data=$Prev_Page&s_coop=$_GET[s_coop]&s_position=$_GET[s_position]&s_type=$_GET[s_type]&s_s=$GET[s_s]'>ถัดไป>></a> ";
} ?>
    </div>
    </div>
<?php }else if( $_GET['coop'] != '' && $_GET['position'] == '' ){
$sql = mysql_query("SELECT * FROM  tb_cooperative WHERE coop_key = '".$_GET['coop']."' ");
$fet = mysql_fetch_array($sql);
?>
<div class="panel panel-default">
  <div class="panel-heading"><h1><span class="glyphicon glyphicon-list" aria-hidden="true"></span>  ตำแหน่งานสถานประกอบการ <?php echo " ( ".$fet['coop_Tname']." ) "; ?></h1></div>
  <div class="panel-body">
<div class="table-responsive">
<table class="table table-bordered">
  <tr class="f" >
    <td >ลำดับ</td>
    <td >ตำแหน่งงาน</td>
    <td >วันที่ปิดรับสมัคร</td>
    <td >จำนวนที่สมัคร</td>
  </tr>

<?php
$i=1;
$sql = mysql_query("SELECT * FROM tb_position as a INNER JOIN tb_cooperative as b ON (a.coop_keyf = b.coop_key) WHERE DATEDIFF(NOW(),position_dateL) <= 0 AND b.coop_key = '".$_GET['coop']."' ");
while($fet = mysql_fetch_array($sql)){ ?>
  <tr class="f1">
    <td><?php echo $i; ?></td>
    <td><a href="index.php?position=<?php echo $fet['position_key']; ?>"><?php echo $fet['position_name']; ?></a></td>
    <td><?php echo changeDate($fet['position_dateL']); ?></td>
    <td><?php echo $fet['position_rate']."/".$fet['position_register']; ?></td>
  </tr>
<?php $i++;
}
?>
</table>
</div>
Total <?php $Num_Rows;?> Record : <?=$Num_Pages;?> Page :
<?php
if($Prev_Page)
{
echo " <a href='$_SERVER[SCRIPT_NAME]?&Page_data=$Prev_Page'><< Back</a> ";
}
for($i=1; $i<=$Num_Pages; $i++){
if($i != $Page)
{
echo " <a href='$_SERVER[SCRIPT_NAME]?&Page_data=$i'><button class='btn btn-detail'>$i</button></a> ";
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
echo " <a href ='$_SERVER[SCRIPT_NAME]?&Page_data=$Next_Page'>Next>></a> ";
} ?>
    </div>
    </div>
<?php }else if( $_GET['coop'] == '' && $_GET['position'] != '' ){
  $sql = mysql_query("SELECT * FROM tb_position as a INNER JOIN tb_cooperative as b ON (a.coop_keyf = b.coop_key) INNER JOIN tb_type_ope e ON (a.position_typef = e.type_key)  WHERE DATEDIFF(NOW(),a.position_dateL) <= 0 AND a.position_key = '".$_GET['position']."'  ");
  $fet = mysql_fetch_array($sql);
  if($fet){
  ?>
  <div class="panel panel-default  ">
    <div class="panel-heading"><font class="f"><span class="glyphicon glyphicon-search" aria-hidden="true" style="backgrou"></span> ข้อมูลตำแหน่งงาน  <?php echo "( ".$fet['position_name']." ) "; ?></font>
    </div>
<!--  ข้อมูลตำแหน่งงาน --->
    <div class="panel-body">
      <div class="panel panel-default">
        <div class="panel-heading f1"><font> <span class="glyphicon glyphicon-list" aria-hidden="true"></span> ข้อมูลตำแหน่งงาน</font></div>
        <div class="panel-body">
        <div class="table-responsive">
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
          </div>
          <div class="table-responsive">
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
                }
                ?>
              </td>
            </tr>
            <tr>
              <td>ข้อมูลคุณสมบัติอื่นๆ</td>
              <td><?php echo $fet['message_add']; ?></td>
            </tr>
          </table>
        </div>
          <div class="table-responsive">
          <table class="table table-bordered">
            <tr>
              <td width="150px">สวัสดีการ</td>
            </tr>
            <tr>
              <td></td>
              <td>
                <?php if($fet['position_bonus'] == "1"){ ?>
                  <img src="img/chk_y.jpg">
                <?php }else{ ?>
                  <img src="img/chk_n.jpg">
                <?php  } ?>   โบนัส
              </td>
              <td>
                <?php if($fet['position_acco'] == "1"){ ?>
                  <img src="img/chk_y.jpg">
                <?php }else{ ?>
                  <img src="img/chk_n.jpg">
                <?php  } ?>   ที่พัก
              </td>
              <td>
                <?php if($fet['position_uniform'] == "1"){ ?>
                  <img src="img/chk_y.jpg">
                <?php }else{ ?>
                  <img src="img/chk_n.jpg">
                <?php  } ?>   ชุดฟอร์มพนักงาน
              </td>
              <td>
                <?php if($fet['position_diligence'] == "1"){ ?>
                  <img src="img/chk_y.jpg">
                <?php }else{ ?>
                  <img src="img/chk_n.jpg">
                <?php  } ?>   เบี้ยขยัน
              </td>
              <td>
                <?php if($fet['position_medical'] == "1"){ ?>
                  <img src="img/chk_y.jpg">
                <?php }else{ ?>
                  <img src="img/chk_n.jpg">
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


      </div>
      <div class="panel panel-default">
        <div class="panel-heading f1"><font><span class="glyphicon glyphicon-list" aria-hidden="true"></span>  ข้อมูลสถานประกอบการ</font></div>
        <div class="panel-body">
          <div class="table-responsive">
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
              <td><span class="glyphicon glyphicon-phone" aria-hidden="true"></span> <?php echo $fet['coop_phone']; ?></td>
            </tr>
            <tr>
              <td >อีเมลล์ : </td>
              <td><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> <?php echo $fet['coop_email']; ?></td>
            </tr>
            <tr>
              <td>เว็บไซด์ : </td>
              <td><span class="glyphicon glyphicon-globe" aria-hidden="true"></span> <?php echo $fet['coop_web']; ?></td>
            </tr>
          </table>
        </div>
        </div>
      </div>
      <?php
        $key_branch = $fet['branch_keyf'];
      if($key_branch != "0" ){
        $sql1 = mysql_query("SELECT * FROM tb_branch WHERE branch_key = '$key_branch'  ");
        $fet1 = mysql_fetch_array($sql1);
         ?>
      <div class="panel panel-default">
        <div class="panel-heading f1"><font><span class="glyphicon glyphicon-list" aria-hidden="true"></span>  ข้อมูลสาขาย่อย</font></div>
        <div class="panel-body">
          <div class="table-responsive">
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
              <td><span class="glyphicon glyphicon-phone" aria-hidden="true"></span> เบอร์<?php echo $fet1['branch_phone']; ?></td>
            </tr>
            <tr>
              <td >อีเมลล์</td>
              <td><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> <?php echo $fet1['branch_email']; ?></td>
            </tr>
            <tr>
              <td >เว็บไซด์</td>
              <td><span class="glyphicon glyphicon-globe" aria-hidden="true"></span> <?php echo $fet1['branch_web']; ?></td>
            </tr>
          </table>
        </div>
        </div></div>
      <?php } ?>
    </div>
  </div>

  <?php } } ?>

<script type="text/javascript">
  $("#s_type").change(function(){
    var s_coop = $("#s_coop").val();
    var s_type = $("#s_type").val();
    $.post('include/select_position.php',{
    s_coop : s_coop,
    s_type : s_type
    },function(data){
      $("#select_position").html(data);
    });
  });

  $("#s_coop").change(function(){
var id = $("#s_coop").val();
$.post('include/select_type.php',{
id : id
},function(data){
  $("#s_type").html(data);
});
  });

  $('[id^=show_position]').click(function(){
    var id = $(this).val();
    window.open("include/preview_position.php?id="+id, "", "width=1000,height=500");
  });

</script>
