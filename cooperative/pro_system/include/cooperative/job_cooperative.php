<?php include("include/connect.php"); session_start();  date_default_timezone_set("Asia/Bangkok");?>
<link href="font.css" rel="stylesheet">
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
  function DateDiff($strDate1,$strDate2)
  {
       return (strtotime($strDate2) - strtotime($strDate1))/  ( 60 * 60 * 24 );  // 1 day = 60*60*24
  }
?>
<?php

if($_SESSION['session_status_menu'] == 'cooperative' ){ ?>
<div class="panel panel-default">
  <div class="panel-heading">
<?php
if($_GET['add'] == "" && $_GET['position'] == "" && $_POST['edit'] == ""){
?>
  <h1><span class="glyphicon glyphicon-list" aria-hidden="true"></span> ตำแหน่งงาน</h1><a href="index.php?page=job_cooperative&s=add"><button class="btn btn-success f1" value="add"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> เพิ่มตำแหน่งงาน</button></a>
<?php } ?>
</div>
  <div class="panel-body">
 <?php
if($_GET['s'] == 'add' ){ ?>
  <form action="include/cooperative/add_job.php" method="post" style="margin-top:-50px" id="form_position">
    <div style="margin-top:100px;margin-left:20px;">
  <div class="panel panel-default">
  <div class="panel-heading"><font class="f">ข้อมูลตำแหน่งงาน</font></div>
  <div class="panel-body">
    <div class="form-group row">
      <div class=" col-md-3">
        <label for="ex1"><font class="f1">สาขาย่อย</font> <span  class="glyphicon glyphicon-question-sign btn btn-warning" aria-hidden="true" data-toggle="tooltip" title="*หมายเหตุ! กรุณากรอกข้อมูลที่เป็นจริง "></span> </label>
        <select class="form-control" name="branch_keyf" id="branch_keyf">
          <option value="unknown">-- ไม่ระบุ --</option>
  <?php
  $sql = mysql_query("SELECT * FROM tb_branch WHERE coop_keyf = '".$_SESSION['session_key']."' ");
  while($fet = mysql_fetch_array($sql)){
  ?>
        <option value="<?php echo $fet['branch_key']; ?>"><?php echo $fet['branch_name']; ?></option>
  <?php } ?>
        </select>
        <span id="branch_keyf_a"></span>
      </div>
    </div>
    <div class="form-group row">
      <div class="col-md-3">
        <label for="ex1"><font class="f1">ชื่อตำแหน่งงาน <b style="color:red">*</b></font></label>
        <input class="form-control"  type="text" placeholder="ชื่อตำแหน่งงาน" name="position_name" id="position_name">
      </div>
      <div class=" col-md-3">
        <label for="ex1"><font class="f1">จำนวนที่รับสมัคร <b style="color:red">*</b></font></label>
        <input class="form-control" type="number"  name="position_register" min="0" max="100" placeholder="จำนวนที่รับสมัคร" id="position_register">
      </div>
        <div class="col-md-3">
          <label for="ex1"><font class="f1">ประะเภทงาน <b style="color:red">*</b></font></label>
          <select class="form-control" name="position_typef">
            <option value="">-- เลือกประเภทงาน --</option>
<?php
$sql = mysql_query("SELECT * FROM  tb_type_ope ");
while($fet = mysql_fetch_array($sql)){ ?>
  <option value="<?php echo $fet['type_key']; ?>"><?php echo $fet['type_name']; ?></option>

<?php } ?>
          </select>
      <font style="color:red" >* หากไม่มีประเภทงานตรงตามงานของท่านกรุณาแจ้งผู้ดูแลระบบ <a href="#" id="offer">แจ้งประเภทงาน</a></font>
        </div>
    </div>
    <div class="form-group row">
      <div class=" col-md-3">
        <label for="ex1"><font class="f1">วันที่เปิดรับสมัคร <b style="color:red">*</b></font></label>
        <input class="form-control" type="date"  name="position_dateS" id="position_dateS">
      </div>
    <div class=" col-md-3">
      <label for="ex1"><font class="f1">วันที่ปิดรับสมัคร <b style="color:red">*</b></font> </label>
      <input class="form-control" type="date"  name="position_dateL" id="position_dateL">
    </div>
    </div>
    </div></div>

    <!-- คุณสมบัติ-->
    <div class="panel panel-default">
    <div class="panel-heading"><font class="f">ข้อมูลคุณสมบัติ</font></div>
    <div class="panel-body">

    <div class="form-group row">
      <div class=" col-md-3">
        <label for="ex1"><font class="f1">เพศ</font> <span  class="glyphicon glyphicon-question-sign btn btn-warning" aria-hidden="true" data-toggle="tooltip" title="*หมายเหตุ! กรุณากรอกข้อมูลที่เป็นจริง "></span> </label>
        <select class="form-control" name="position_sex" id="position_sex">
          <option value="">-- เลือกเพศ ---</option>
          <option value="1">เพศชาย</option>
          <option value="2">เพศหญิง</option>
          <option value="3">เพศชายและหญิง</option>
        </select>
      </div>
  <div class="form-group row">

  </div>
      <div class=" col-md-3">
        <label for="ex1"><font class="f1">ช่วงอายุ/ปี</font> <span  class="glyphicon glyphicon-question-sign btn btn-warning" aria-hidden="true" data-toggle="tooltip" title="*หมายเหตุ! กรุณากรอกข้อมูลที่เป็นจริง "></span> </label>
      <table>
        <tr>
          <td><input type="text" class="form-control" id="position_age1" name="position_age1"></td>
          <td> &nbsp;&nbsp;-&nbsp;&nbsp; </td>
          <td><input type="text" class="form-control" id="position_age2" name="position_age2"> </td>

        </tr>
      </table>
      </div>
    <div class=" col-md-3">
        <label for="ex1"><font class="f1">ระดับการศึกษา</font> <span  class="glyphicon glyphicon-question-sign btn btn-warning" aria-hidden="true" data-toggle="tooltip" title="*หมายเหตุ! กรุณากรอกข้อมูลที่เป็นจริง "></span> </label>
    <select class="form-control" id="position_edu" name="position_edu">
      <option value="">-- เลือกระดับการศึกษา --</option>
      <option value="1">ระดับมัธยมศึกษาปีที่6</option>
      <option value="2">ระดับปวช/ระดับปวส</option>
      <option value="3">ระดับปริญญษตรี</option>
      <option value="4">ระดับปริญญษโท</option>
      <option value="5">อื่นๆ</option>
    </select>
    </div>
    <div class="col-md-3" id="hid_edu">
      <label for=""><font class="f1">ระบุข้อมูลการศึกษาอื่นๆ</font></label>
      <input type="text" name="position_eduorter" value="" class="form-control">
    </div>
    </div>
    <div class="form-group row">
    <div class=" col-md-5">
    <label for="ex1"><font class="f1">ข้อมูลคุณสมบัติอื่นๆ</font> <span  class="glyphicon glyphicon-question-sign btn btn-warning" aria-hidden="true" data-toggle="tooltip" title="*หมายเหตุ! กรุณากรอกข้อมูลที่เป็นจริง "></span> </label>
<textarea  cols="" id="message_add" name="message_add" rows="" value=""></textarea>

  </div>
    </div>

  </form>
    <div>
      </div>

     </div>
   </div>

   <div class="panel panel-default">
   <div class="panel-heading"><font class="f">ข้อมูลสวัสดีการ</font></div>
   <div class="panel-body">

   <div class="form-group row">
    <div class="col-md-2">
    <input type="checkbox" name="position_bonus" value="1"> <font class="f1">โบนัส</font>
    </div>
    <div class="col-md-2">
    <input type="checkbox" name="position_acco" value="1"> <font class="f1">ที่พัก</font>
    </div>
    <div class="col-md-3">
    <input type="checkbox" name="position_uniform" value="1"> <font class="f1">ชุดฟอร์มพนักงาน</font>
    </div>
    <div class="col-md-2">
      <input type="checkbox" name="position_diligence" value="1"> <font class="f1">เบี้ยขยัน</font>
    </div>
    <div class="col-md-3">
    <input type="checkbox" name="position_medical" value="1"> <font class="f1">ค่ารักษาพยาบาล</font>
    </div>
    </div>

   <div class="form-group row">
   <div class=" col-md-5">
   <label for="ex1"><font class="f1">ข้อมูลสวัสดีการอื่นๆ</font> <span  class="glyphicon glyphicon-question-sign btn btn-warning" aria-hidden="true" data-toggle="tooltip" title="*หมายเหตุ! กรุณากรอกข้อมูลที่เป็นจริง "></span> </label>
<textarea  cols="" id="message_add1" name="message_add1" rows="" value=""></textarea>

 </div>
   </div>
   <div class="form-group row">
   <div class=" col-md-3">
     <div class="g-recaptcha" data-sitekey="6LdsDUwUAAAAAO-WAIc9TwbSb5sE__94Ug-mIRWb"></div>
     <span class='msg'><?php echo $msg; ?></span>
     <span id="chk_a"></span>
   </div>
   </div>

   <button class="btn btn-success f1" type="button" name="" id="add_position"> <span class="glyphicon glyphicon-save" aria-hidden="true" value="save"></span> <font>บันทึกข้อมูล</font></button>
 </form>
   <div>
     </div>

    </div>
  </div>
<?php
}else if($_GET['position'] != ""){
$sql = mysql_query("SELECT * FROM  tb_position WHERE position_key = '".$_GET['position']."' AND coop_keyf = '".$_SESSION['session_key']."' ");
$fet = mysql_fetch_array($sql);
?>

<div class="panel panel-default">
  <div class="panel-heading"><b class="f"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> ข้อมูลตำแหน่งงาน <?php echo $fet['position_name']; ?></b></div>
  <div class="panel-body">
    <table class="table table-bordered f2">
      <tr>
        <td width="200px;">ตำแหน่งงาน : </td>
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
<?php
}else if($_POST['edit'] != "" && $_GET['position'] == ''){  ?>
<font class="f1">แก้ไขข้อมูล</font>
<?php
$sql = mysql_query("SELECT * FROM tb_position WHERE position_key = '".$_POST['edit']."' AND coop_keyf = '".$_SESSION['session_key']."' ");
$fet = mysql_fetch_array($sql);
if($fet){
?>
  <form action="include/cooperative/update_job.php" method="post" style="margin-top:-50px" id="form_updateposition">
    <input  <?php if($fet['position_status'] == '1') { echo "readonly"; } ?> type="hidden" name="id_position" value="<?php echo $fet['position_key']; ?> ">
    <div style="margin-top:100px;margin-left:20px;">
    <div class="form-group row">
      <div class=" col-md-3">
        <label for="ex1"><font class="f1">สาขาย่อย</font> <span  class="glyphicon glyphicon-question-sign btn btn-warning" aria-hidden="true" data-toggle="tooltip" title="*หมายเหตุ! กรุณากรอกข้อมูลที่เป็นจริง "></span> </label>
        <select <?php if($fet['position_status'] == '1') { echo "readonly"; } ?> class="form-control" name="branch_keyf" id="branch_keyf">
          <option value="">-- ไม่ระบุ --</option>
    <?php
    $sql1 = mysql_query("SELECT * FROM tb_branch WHERE coop_keyf = '".$_SESSION['session_key']."' ");
    while($fet1 = mysql_fetch_array($sql1)){
    ?>
        <option value="<?php echo $fet1['branch_key']; ?>" <?php if($fet['branch_key'] == $fet1['branch_key'] ) ?> ><?php echo $fet['branch_name']; ?></option>
    <?php } ?>
        </select>
      </div>
    </div>
    <div class="form-group row">
      <div class="col-md-3">
        <label for="ex1"><font class="f1">ชื่อตำแหน่งงาน</font> <span  class="glyphicon glyphicon-question-sign btn btn-warning" aria-hidden="true" data-toggle="tooltip" title="*หมายเหตุ! กรุณากรอกข้อมูลที่เป็นจริง"></span> </label>
        <input <?php if($fet['position_status'] == '1') { echo "readonly"; } ?> class="form-control"  type="text" placeholder="ชื่อตำแหน่งงาน" name="position_name" value="<?php echo $fet['position_name']; ?>" id="position_name">
      </div>
      <div class=" col-md-3">
        <label for="ex1"><font class="f1">จำนวนที่รับสมัคร</font> <span  class="glyphicon glyphicon-question-sign btn btn-warning" aria-hidden="true" data-toggle="tooltip" title="*หมายเหตุ! กรุณากรอกข้อมูลที่เป็นจริง "></span> </label>
        <input   <?php if($fet['position_status'] == '1') { echo "readonly"; } ?> class="form-control" type="number"  name="position_register" min="0" max="100" placeholder="จำนวนที่รับสมัคร" value="<?php echo $fet['position_register']; ?>" id="position_register">
      </div>
    </div>
    <div class="form-group row">
      <div class=" col-md-3">
        <label for="ex1"><font class="f1">วันที่เปิดรับสมัคร</font> <span  class="glyphicon glyphicon-question-sign btn btn-warning" aria-hidden="true" data-toggle="tooltip" title="*หมายเหตุ! กรุณากรอกข้อมูลที่เป็นจริง "></span> </label>
        <input <?php if($fet['position_status'] == '1') { echo "readonly"; } ?> class="form-control" type="date"  name="position_dateS" value="<?php echo $fet['position_dateF']; ?>" id="position_dateF">
      </div>
    <div class=" col-md-3">
      <label for="ex1"><font class="f1">วันที่ปิดรับสมัคร</font> <span  class="glyphicon glyphicon-question-sign btn btn-warning" aria-hidden="true" data-toggle="tooltip" title="*หมายเหตุ! กรุณากรอกข้อมูลที่เป็นจริง "></span> </label>
      <input  class="form-control" type="date"  name="position_dateL" value="<?php echo $fet['position_dateL']; ?>" id="position_dateL">
    </div>

    </div>
    <div class="form-group row">
    <div class=" col-md-5">
      <label for="ex1"><font class="f1">ข้อมูลคุณสมบัติ</font> <span  class="glyphicon glyphicon-question-sign btn btn-warning" aria-hidden="true" data-toggle="tooltip" title="*หมายเหตุ! กรุณากรอกข้อมูลที่เป็นจริง "></span> </label>
<textarea   cols=""  name="message_add" rows="" ><?php echo $fet['position_property']; ?></textarea>
  </div>
  <div class=" col-md-5">
    <label for="ex1"><font class="f1">ข้อมูลสวัสดีการ</font> <span  class="glyphicon glyphicon-question-sign btn btn-warning" aria-hidden="true" data-toggle="tooltip" title="*หมายเหตุ! กรุณากรอกข้อมูลที่เป็นจริง "></span> </label>
  <textarea   cols="" name="message_add1" rows="" ><?php echo $fet['position_money']; ?></textarea>
  </div>
    </div>
    <div class="form-group row">
    <div class=" col-md-3">
      <div class="g-recaptcha" data-sitekey="6LcL4kAUAAAAAOAB5EeHjhf3YR8ADDKfVamY6Ser"></div>
      <span class='msg'><?php echo $msg; ?></span>
      <span id="chk_a"></span>
    </div>
    </div>
    <input type="button" value="แก้ไขข้อมูล" class="btn btn-success f1" id="update_position">
  </form>
<?php }
}else{ ?>
<form class="" action="index.php?page=job_cooperative" method="post">
<div class="form group row">
  <div class="col-md-3">
    <label for=""><font class="f1">ค้นหาตำแหน่งงาน</font></label>
    <select class="form-control" name="status">
      <option value="" <?php if($_POST['status'] == ''){ echo "selected"; }?>>-- งานทั้งหมด --</option>
      <option value="1"<?php if($_POST['status'] == '1'){ echo "selected"; }?>>-- งานที่เปิดรับสมัคร --</option>
      <option value="2"<?php if($_POST['status'] == '2'){ echo "selected"; }?>>-- งานที่ปิดสมัคร --</option>
    </select>
  </div>
  <div class="col-md-3">
  <label for=""><font class="f1">ค้นหา</font></label> <br>
  <button  type="submit" name="" class="btn btn-success"><font><span class="glyphicon glyphicon-search" aria-hidden="true"></span> ค้นหา</font></button>
  </div>
</div>

</form>
<div class="table-responsive">
  <table class="table table-bordered table-hover" style="margin-top:20px;">
    <thead>
    <tr class="f1">
      <td >ลำดับ</td>
      <td >ชื่อตำแหน่งงาน</td>
      <td>วันที่ปิดรับสมัคร</td>
      <td >จัดการ</td>
      <td width="100">สถานะ</td>
    </tr>
  </thead>
<?php
if($_POST['status'] == ""){
  $sql = "SELECT * FROM tb_position WHERE coop_keyf = '".$_SESSION['session_key']."' ";
}else if($_POST['status'] == "1"){
  $sql = "SELECT * FROM tb_position WHERE coop_keyf = '".$_SESSION['session_key']."' AND  DATEDIFF(NOW(),position_dateL) <= 0";
}else if($_POST['status'] == "2"){
  $sql = "SELECT * FROM tb_position WHERE coop_keyf = '".$_SESSION['session_key']."' AND DATEDIFF(NOW(),position_dateL) >= 1";
}
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
    <td><?php echo  (($Page-1)*10)+$i ; ?></td>
    <td><?php echo "ตำแหน่งงาน".$fet['position_name']; ?></td>
    <td><?php echo changeDate($fet['position_dateL']); ?></td>
    <td>
    <div class="form-group row" style="margin-top:15px;">
      <div class="col-md-3">
        <a href="index.php?page=job_cooperative&position=<?php echo $fet['position_key']; ?>" aria-hidden="true" data-toggle="tooltip" title="คลิ๊กเพื่อดูข้อมูล"><span class="glyphicon glyphicon-eye-open btn btn-success"><font> ดูข้อมูล</font></span></a>

      </div> &nbsp;
      <div class="col-md-1" style="">

        <?php
         $date = date("Y-m-d");
         $time = $fet['position_dateL'];
         $ex =  DateDiff($date,$time);
        if($ex < '0' ){
        if($fet['position_status'] == '1'){
        ?>
        <form class="" action="index.php?page=job_cooperative" method="post" style="margin-top:1px;">
          <input type="hidden" name="edit" value="<?php echo $fet['position_key']; ?>">
          <button  class="btn btn-warning" type="submit" name="button"  aria-hidden="true" data-toggle="tooltip" title="คลิ๊กเพื่อเลื่อนระยะเวลา"><span class="glyphicon glyphicon-edit"><font> เลื่อนระยะเวลา</font></span></button>
        </form>

      <?php } }if($fet['position_status'] == '0'){ ?>
        <form class="" action="index.php?page=job_cooperative" method="post" style="margin-top:1px; ">
          <input type="hidden" name="edit" value="<?php echo $fet['position_key']; ?>">
          <button  class="btn btn-primary" type="submit" name="button"  aria-hidden="true" data-toggle="tooltip" title="คลิ๊กเพื่อแก้ไขข้อมูล"><span class="glyphicon glyphicon-edit"><font > แก้ไขข้อมูล</font></span></button>
        </form>


  <?php   } ?>
      </div>
    </div>

    <!-- <button class="btn btn-danger" id="delete_key" value="<?php echo $fet['position_key']; ?>"><span class="glyphicon glyphicon-trash"></span></button> -->
    </td>
    <td>
      <div class="form-group row">
        <div class="col-md-3" style="margin-top:15px;">
<?php if($fet['position_status'] == '0'){ ?>
<button id="status_showpostion" value="<?php echo $fet['position_key']; ?> " class="btn btn-danger" type="button" name="button"  aria-hidden="true" data-toggle="tooltip" title="คลิ๊กเพื่อประกาศรับสมัคร">ยังไม่เปิดรับสมัคร</button>
<?php }else if($fet['position_status'] == '1'){ ?>
<button  disabled class="btn btn-default" type="button" name="button"  aria-hidden="true" data-toggle="tooltip" title="คลิ๊กเพื่อประกาศรับสมัคร">ประกาศรับสมัคร</button>
<?php } ?>
        </div>

      </div>
    </td>
  </tr>
<?php $i++;
}
?>
  </table>
  </div>
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
<?php
}
 ?>
  </div>
</div>


<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">การแจ้งเพิ่มประเภทงาน</h4>
        </div>
        <div class="modal-body">
              <div class="form-group row">
                <div class="col-md-5">
                <label for="">ตำแหน่งงานที่ต้องการเพิ่ม</label>
                <input type="text" class="form-control" id="name_offer" placeholder="ตำหแหน่งงาน">
              </div></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" id="add_offer" >บันทึก</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    $("#hid_edu").hide();
$("[id^=status_showpostion]").click(function(){
var id = $(this).val();

var r = confirm("ยืนยันการบันทึกข้อมูลการประกาศงานหรือไม่");
if (r == true) {
  $.post("include/cooperative/update_statusannoun.php",{
    id : id
  },function(){
    location.reload();
  });
}
});

$("#position_edu").change(function(){
  var data = $("#position_edu").val();
  if(data == '5'){
    $("#hid_edu").show();
  }else{
    $("#hid_edu").hide();
  }
});

$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
CKEDITOR.replace( 'message_add' );
CKEDITOR.replace( 'message_add1' );
CKEDITOR.config.font_defaultLabel = 'Mitr';
CKEDITOR.config.fontSize_defaultLabel = '120px';
$("#add_position").click(function(){
var a = $("#g-recaptcha-response").val();
 var branch_keyf = $("#branch_keyf").val();
 var position_name =  $("#branch_keyf").val();
 var position_register = $("#position_register").val();
 var position_depart = $("#position_depart").val();
 var position_dateS = $("#position_dateS").val();
 var position_dateL = $("#position_dateL").val();
 //var message_add = $("#message").val();
 //var message_add1 = $("#message1").val();
 // mailContents = CKEDITOR.instances.mailContents.getData();

 var mailContents = CKEDITOR.instances.message_add.getData();
 var mailContents = CKEDITOR.instances['message_add'].getData(); //alert(mailContents);

 var mailContents1 = CKEDITOR.instances.message_add1.getData();
 var mailContents1 = CKEDITOR.instances['message_add1'].getData(); //alert(mailContents1);

 $("#message_add").val(mailContents);
 $("#message_add1").val(mailContents1);

 if(a == ""){
 $("#chk_a").html("<font style='color:red'><img src='img/validate.gif' width='20' heigth='20'>กรุณาคลิ๊กเพื่อยืนยัน</font>");
 }else{
 $("#chk_a").html("");
 }


if(a != "" && position_name != "" && position_register != "" && position_depart != "" && position_dateS != "" && position_dateL != "" && mailContents != "" && mailContents1 != ""  ){
  var r = confirm("ยืนยันการบันทึกข้อมูล");
  if (r == true) {
      $('#form_position').submit();
  }

}
});

$("#update_position").click(function(){
  var a = $("#g-recaptcha-response").val();
  if(a == ""){
  $("#chk_a").html("<font style='color:red'><img src='img/validate.gif' width='20' heigth='20'>กรุณาคลิ๊กเพื่อยืนยัน</font>");
  }else{
  $("#chk_a").html("");
}

  if(a != ""){
  var r = confirm("ยืนยันการแก้ไขข้อมูล");
  if (r == true) {
      $('#form_updateposition').submit();
  } }
});


$("#status_postion").click(function(){
  var id = $(this).val();
  var r = confirm("ยืนยันการแก้ไขข้อมูล");
  if (r == true) {
      $.post('include/cooperative/delete_position.php',{
        id : id
      },function(){
location.reload();
      });
  }
});



$("#offer").click(function(){
  $("#myModal").modal('show');
});

$("#add_offer").click(function(){
  var name = $("#name_offer").val();
  if(name == ""){
    alert("กรุณากรอกข้อมูลตำแหน่งงาน");
  }else{
    var r = confirm("ยืนยันการแก้ไขข้อมูล");
    if (r == true) {
      $.post('include/cooperative/add_offer.php',{
        name : name
      },function(data){
     if(data == '1'){
       alert("การแจ้งประเภทงานเรียบร้อย");
       $("#name_offer").val('');
     }else if(data == '2'){
       alert("ท่านได้ทำงานแจ้งประเภทงานนี้แล้ว");
     }
      });
    }
  }
});
</script>
<?php } ?>
