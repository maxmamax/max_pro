<?php include("include/connect.php"); ?>
<?php if($_SESSION['session_status_menu'] == 'cooperative' ){ ?>
<div class="panel panel-default">
  <div class="panel-heading">
<?php
if($_GET['branch'] == "" && $_GET['edit'] == ""){
?>
    <h1><span class="glyphicon glyphicon-list" aria-hidden="true"></span> สาขาย่อย</h1><a href="index.php?page=branch_cooperative&s=add"><button class="btn btn-success f1" value="add"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> เพิ่มสาขาย่อย</button></a>
<?php } ?>
</div>
  <div class="panel-body">
 <?php
if($_GET['s'] == 'add' ){ ?>
  <form action="include/cooperative/add_branch.php" method="post" style="margin-top:-50px" id="form_branch">
    <div style="margin-top:100px;margin-left:20px;">
    <div class="form-group row">
      <div class="col-md-3">
        <label for="ex1"><font class="f1">ชื่อสาขาย่อย</font> <font class="f1"> <b style="color:red">*</b></font> </label>
        <input class="form-control"  type="text" placeholder="ชื่อสาขาย่อย" name="branch_name" id="branch_name" >
      </div>

    </div>

    <div class="form-group row">
    <div class=" col-md-3">
      <label for="ex1"><font class="f1">ที่อยู่</font> <font class="f1"> <b style="color:red">*</b></font> </label>
      <input class="form-control" type="text" placeholder="ที่อยู่" name="branch_address" id="branch_address">
    </div>
  <div class=" col-md-2">
    <label for="ex1"><font class="f1">ตำบล <font class="f1"> <b style="color:red">*</b></font> </font></label>
    <input class="form-control"  type="text" placeholder="ตำบล" name="branch_sdistrict" id="branch_sdistrict">
  </div>
  <div class=" col-md-2">
    <label for="ex1"><font class="f1">อำเภอ <font class="f1"> <b style="color:red">*</b></font> </font></label>
    <input class="form-control" type="text" placeholder="อำเภอ" name="branch_district" id="branch_district">
  </div>
  <div class=" col-md-2">
    <label for="ex1"><font class="f1">จังหวัด <font class="f1"> <b style="color:red">*</b></font> </font></label>
    <input class="form-control"  type="text" placeholder="จังหวัด" name="branch_province" id="branch_province">
  </div>
  <div class=" col-md-3">
    <label for="ex1"><font class="f1">รหัสไปรษณีย์ <font class="f1"> <b style="color:red">*</b></font>  </font></label>
    <input class="form-control"  type="number" placeholder="รหัสไปรษณีย์" name="branch_code" min="0" id="branch_code">
  </div>
    </div>

    <div class="form-group row">
    <div class=" col-md-3">
      <label for="ex1"><font class="f1">เบอร์โทรศัพท์</font> <font class="f1"> <b style="color:red">*</b></font>  </label>
      <input class="form-control"  type="text" placeholder="เบอร์โทรศัพท์" name="branch_phone" id="branch_phone">
    </div>
  <div class=" col-md-2">
    <label for="ex1"><font class="f1">อีเมล <font class="f1"> <b style="color:red">*</b></font> </font></label>
    <input class="form-control" type="text" placeholder="อีเมล" name="branch_email" id="branch_email">
  </div>
  <div class=" col-md-2">
    <label for="ex1"><font class="f1">เว็บไซด์ <font class="f1"> <b style="color:red">*</b></font>  </font></label>
    <input class="form-control"  type="text" placeholder="เว็บไซด์" name="branch_web" id="branch_web">
  </div>
    </div>
    <div class="form-group row">
    <div class=" col-md-3">
      <div class="g-recaptcha" data-sitekey="6LdsDUwUAAAAAO-WAIc9TwbSb5sE__94Ug-mIRWb"></div>
      <span class='msg'><?php echo $msg; ?></span>
      <span id="chk_a"></span>
    </div>
    </div>
    <button class="btn btn-success f1" type="button" name="" id="add_branch" value="save" > <span class="glyphicon glyphicon-save" aria-hidden="true" ></span> <font>บันทึกข้อมูล</font></button>
  </form>
    <div>
<?php
}else if($_GET['branch'] != "" && $_GET['edit'] == ""){
$sql = mysql_query("SELECT * FROM tb_branch WHERE branch_key = '".$_GET['branch']."' AND coop_keyf = '".$_SESSION['session_key']."' ");
$fet = mysql_fetch_array($sql);
if($fet){
?>
<div class="panel panel-default">
  <div class="panel-heading"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> สาขาย่อย</div>
  <div class="panel-body">
    <table class="table table-bordered">
      <tr>
        <td>ชื่อ</td>
        <td><?php echo "สาขา".$fet['branch_name']; ?></td>
      </tr>
      <tr>
        <td>ที่อยู่</td>
        <td><?php echo $fet['branch_address']." ตำบล ". $fet['branch_sdistrict']." อำเภอ ". $fet['branch_district']." จังหวัด ". $fet['branch_province']." รหัสไปรษณีย์ ". $fet['branch_code']; ?></td>
          </tr>
      <tr>
        <td>เบอร์โทรศัพท์</td>
        <td><?php echo $fet['branch_phone']; ?></td>
      </tr>

         <tr>
             <tr>
        <td>อีเมล</td>
        <td><?php echo $fet['branch_email']; ?>ale</td>
      </tr>
        <tr>
        <td>เว็บไซด์</td>
        <td><?php echo $fet['branch_web']; ?></td>
      </tr>
    </table>
  </div>
</div>
<?php } ?>
    </div>
  </div>
<?
}else if($_GET['edit'] == "" ){ ?>

<div class="table-responsive">

  <table class="table table-bordered table-hover">
    <thead>
    <tr class="f1">
      <td width="20px;">ลำดับ</td>
      <td width="200px;">ชื่อสาขาย่อย</td>
      <td width="200px;">จัดการ</td>
    </tr>
  </thead>
<?php
$sql = "SELECT * FROM tb_branch WHERE coop_keyf = '".$_SESSION['session_key']."' ";
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
    <td ><?php echo  (($Page-1)*10)+$i ; ?></td>
    <td  width="200px;"><?php echo "สาขา".$fet['branch_name']; ?></td>
    <td>
    <a href="index.php?page=branch_cooperative&branch=<?php echo $fet['branch_key']; ?>" aria-hidden="true" data-toggle="tooltip" title="คลิ๊กเพื่อดูข้อมูล"><span class="glyphicon glyphicon-eye-open btn btn-success"></span></a>
    <!-- <a href="index.php?page=branch_cooperative&edit=<?php echo $fet['branch_key']; ?>"><span class="glyphicon glyphicon-edit btn btn-primary"></span><a>
    <button class="btn btn-danger" id="delete_key" value="<?php echo $fet['branch_key']; ?>" ><span class="glyphicon glyphicon-trash" ></span></button> -->
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
  echo " <a href='$_SERVER[SCRIPT_NAME]?page=branch_cooperative&Page_data=$Prev_Page'><< ย้อนกลับ</a> ";
  }
  for($i=1; $i<=$Num_Pages; $i++){
  if($i != $Page)
  {
  echo " <a href='$_SERVER[SCRIPT_NAME]?page=branch_cooperative&Page_data=$i'><button class='btn btn-detail'>$i</button></a> ";
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
  echo " <a href ='$_SERVER[SCRIPT_NAME]?page=branch_cooperative&Page_data=$Next_Page'>ถัดไป>></a> ";
} ?>
<?php
}else if($_GET['edit'] != ''){
$sql = mysql_query("SELECT * FROM  tb_branch WHERE branch_key = '".$_GET['edit']."' AND coop_keyf = '".$_SESSION['session_key']."' ");
$fet = mysql_fetch_array($sql);
if($fet){
?>

  <form action="include/cooperative/update_branch.php" method="post" style="margin-top:-50px" id="form_updatebranch">
    <input type="hidden" name="id_branch" value="<?php echo $fet['branch_key']; ?>">
    <div style="margin-top:100px;margin-left:20px;">
    <div class="form-group row">
      <div class="col-md-3">
        <label for="ex1"><font class="f1">ชื่อสาขาย่อย</font> <span  class="glyphicon glyphicon-question-sign btn btn-warning" aria-hidden="true" data-toggle="tooltip" title="*หมายเหตุ! กรุณากรอกข้อมูลที่เป็นจริง"></span> </label>
        <input class="form-control"  type="text" placeholder="ชื่อสาขาย่อย" name="branch_name" value="<?php echo $fet['branch_name']; ?>">
      </div>

    </div>

    <div class="form-group row">
    <div class=" col-md-3">
      <label for="ex1"><font class="f1">ที่อยู่</font> <span  class="glyphicon glyphicon-question-sign btn btn-warning" aria-hidden="true" data-toggle="tooltip" title="*หมายเหตุ! กรุณากรอกข้อมูลที่เป็นจริง "></span> </label>
      <input class="form-control" type="text" placeholder="ที่อยู่" name="branch_address" value="<?php echo $fet['branch_address']; ?>">
    </div>
  <div class=" col-md-2">
    <label for="ex1"><font class="f1">ตำบล <span  class="glyphicon glyphicon-question-sign btn btn-warning" aria-hidden="true" data-toggle="tooltip" title="*หมายเหตุ! กรุณากรอกข้อมูลที่เป็นจริง "></span> </font></label>
    <input class="form-control"  type="text" placeholder="ตำบล" name="branch_sdistrict" value="<?php echo $fet['branch_sdistrict']; ?>">
  </div>
  <div class=" col-md-2">
    <label for="ex1"><font class="f1">อำเภอ <span  class="glyphicon glyphicon-question-sign btn btn-warning" aria-hidden="true" data-toggle="tooltip" title="*หมายเหตุ! กรุณากรอกข้อมูลที่เป็นจริง "></span> </font></label>
    <input class="form-control" type="text" placeholder="อำเภอ" name="branch_district" value="<?php echo $fet['branch_district']; ?>">
  </div>
  <div class=" col-md-2">
    <label for="ex1"><font class="f1">จังหวัด <span  class="glyphicon glyphicon-question-sign btn btn-warning" aria-hidden="true" data-toggle="tooltip" title="*หมายเหตุ! กรุณากรอกข้อมูลที่เป็นจริง "></span> </font></label>
    <input class="form-control"  type="text" placeholder="จังหวัด" name="branch_province" value="<?php echo $fet['branch_province']; ?>">
  </div>
  <div class=" col-md-2">
    <label for="ex1"><font class="f1">รหัสไปรษณีย์ <span  class="glyphicon glyphicon-question-sign btn btn-warning" aria-hidden="true" data-toggle="tooltip" title="*หมายเหตุ! กรุณากรอกข้อมูลที่เป็นจริง "></span> </font></label>
    <input class="form-control"  type="number" placeholder="รหัสไปรษณีย์" name="branch_code" min="0" value="<?php echo $fet['branch_code']; ?>">
  </div>
    </div>

    <div class="form-group row">
    <div class=" col-md-3">
      <label for="ex1"><font class="f1">เบอร์โทรศัพท์</font> <span  class="glyphicon glyphicon-question-sign btn btn-warning" aria-hidden="true" data-toggle="tooltip" title="*หมายเหตุ! กรุณากรอกข้อมูลที่เป็นจริง "></span> </label>
      <input class="form-control"  type="text" placeholder="เบอร์โทรศัพท์" name="branch_phone" value="<?php echo $fet['branch_phone']; ?>">
    </div>
  <div class=" col-md-2">
    <label for="ex1"><font class="f1">อีเมล <span  class="glyphicon glyphicon-question-sign btn btn-warning" aria-hidden="true" data-toggle="tooltip" title="*หมายเหตุ! กรุณากรอกข้อมูลที่เป็นจริง "></span> </font></label>
    <input class="form-control" type="text" placeholder="อีเมล" name="branch_email" value="<?php echo $fet['branch_email']; ?>">
  </div>
  <div class=" col-md-2">
    <label for="ex1"><font class="f1">เว็บไซด์ <span  class="glyphicon glyphicon-question-sign btn btn-warning" aria-hidden="true" data-toggle="tooltip" title="*หมายเหตุ! กรุณากรอกข้อมูลที่เป็นจริง "></span> </font></label>
    <input class="form-control"  type="text" placeholder="เว็บไซด์" name="branch_web" value="<?php echo $fet['branch_web']; ?>">
  </div>
    </div>
    <input type="button" value="แก้ไขข้อมูล" class="btn btn-success f1" id="update_branch">
  </form>
<?php
} }
 ?>
  </div>
</div>
<?php } ?>

<script type="text/javascript">

$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});

$("#add_branch").click(function(){
  var a = $("#g-recaptcha-response").val();
  var branch_address = $("#branch_address").val();
  var branch_sdistrict = $("#branch_sdistrict").val();
  var branch_district = $("#branch_district").val();
  var branch_province = $("#branch_province").val();
  var branch_code = $("#branch_code").val();
  var branch_phone = $("#branch_phone").val();
  var branch_email = $("#branch_email").val();
  var branch_web = $("#branch_web").val();


    $(":input + span.require").remove();
       $(":input:not(:button)input:not(:hidden)").each(function(){
           $(this).each(function(){
               if($(this).val()==""){
                   $(this).after("<span class=require><font style='color:red'><img src='img/validate.gif' width='20' heigth='20'>จำเป็นต้องกรอก</font><br></span>");
    }
           });
       });

       if(a == ""){
       $("#chk_a").html("<font style='color:red'><img src='img/validate.gif' width='20' heigth='20'>กรุณาคลิ๊กเพื่อยืนยัน</font>");
       }else{
       $("#chk_a").html("");
       }

if(a != "" && branch_name != "" && branch_address != "" && branch_sdistrict != "" && branch_district != "" && branch_province != "" && branch_code != "" && branch_phone != "" && branch_email != "" && branch_web != ""  ){
  var r = confirm("ยืนยันการบันทึกข้อมูล");
  if (r == true) {
      $('#form_branch').submit();
  }
}
});

$("#update_branch").click(function(){


  var r = confirm("ยืนยันการแก้ไขข้อมูล");
  if (r == true) {
      $('#form_updatebranch').submit();
  }
});

$("[id^=delete_key]").click(function(){
  var id = $(this).val();
  var r = confirm("ยืนยันการแก้ไขข้อมูล");
  if (r == true) {
      $.post('include/cooperative/delete_branch.php',{
        id : id
      },function(){
location.reload();
      });
  }
});

</script>
