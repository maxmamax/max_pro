
<?php include("include/connect.php"); session_start(); date_default_timezone_set("Asia/Bangkok"); ?>
<?php
function DateDiff($strDate1,$strDate2)
{
     return (strtotime($strDate2) - strtotime($strDate1))/  ( 60 * 60 * 24 );  // 1 day = 60*60*24
}
function changeDate($date){
$get_date = explode("-",$date);
$month = array("01"=>"ม.ค.","02"=>"ก.พ","03"=>"มี.ค.","04"=>"เม.ย.","05"=>"พ.ค.","06"=>"มิ.ย.","07"=>"ก.ค.","08"=>"ส.ค.","09"=>"ก.ย.","10"=>"ต.ค.","11"=>"พ.ย.","12"=>"ธ.ค.");
$get_month = $get_date["1"];
$year = $get_date["0"]+543;
return $get_date["2"]." ".$month[$get_month]." ".$year;
}
$sql = mysql_query("SELECT position_name,position_key FROM tb_position WHERE position_key = '".$_POST['key_position']."' ");
$fet = mysql_fetch_array($sql);
?>
<div class="panel panel-default">
  <div class="panel-heading">
    <h1>บันทึกข้อมูลฝึกปฏิบัติงานประจำวัน <?php if($fet){ echo "(".$fet['position_name'].")"; }?></h1>
 <?php if($fet){ ?>
   <form class="" action="include/report4/report_student.php" method="post" target="_blank">
      <input type="hidden" name="id" value="<?php echo $fet['position_key']; ?>">
      <button class="btn btn-danger" type="submit"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> พิมพ์ใบรายงานสัมภาษณ์งาน</button></h1>
    </form>
<?php } ?>
  </div>
  <div class="panel-body">
  <?php if($_POST['key_position'] == ""){ ?>
    <table class="table table-bordered f">
      <tr>
        <td>ลำดับ</td>
        <td>สถานประกอบการ</td>
        <td>ตำแหน่งงาน</td>
        <td>วันที่จอง</td>
        <td>สถานะ</td>
      </tr>

    <?php
    $i=1;
    $sql = "SELECT * FROM tb_register_job as a
    INNER JOIN tb_cooperative as b ON (a.coop_keyf = b.coop_key)
    INNER JOIN  tb_position as c ON (a.position_keyf = c.position_key) WHERE a.student_keyf = '".$_SESSION['session_key']."' AND a.position_keyf = c.position_key AND a.job_status = '4' ";
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
      <tr class="f">
        <td><?php echo $i; ?></td>
        <td><?php echo $fet['coop_Tname']; ?></td>
        <td>
          <a href="index.php?page=job_student&position=<?php echo $fet['position_key']; ?>"><?php echo $fet['position_name']; ?></a>
        <?php
        $dateS = date("Y-m-d");
        $dateL = $fet['position_dateL'];
        $d =  DateDiff("$dateS","$dateL");
        if($d<0){
          echo "<br><span><font style='color:red'>*ตำแหน่งงานนี้ปิดรับสมัครแล้ว</font></span>";
        }
        ?>
        </td>
        <td><?php echo changeDate($fet['job_date']); ?></td>
        <td>
        <?php
    if($fet['job_status'] == '0'){
      echo "รอตรวจสอบ";
    ?>
    <form class="" action="index.php?page=job_register" method="post">
    <button id="delete" type="button" name="button"  value="<?php echo $fet['register_key']; ?>" class="btn btn-danger" aria-hidden="true" data-toggle="tooltip" title="คลิ๊กเพื่อยกเลิกข้อมูลตำแหน่งงาน"><span class="glyphicon glyphicon-remove"></span> ยกเลิก</button>
    </form>
    <?php
    }else if($fet['job_status'] == '1'){
      echo "นัดสอบสอบสัมภาษณ์";
    }else if($fet['job_status'] == '2'){
      echo "ไม่ผ่านการสัมภาษณ์งาน";
    }else if($fet['job_status'] == '3'){
      echo "ผ่านการคัดเลือกฝึกปฏิบัติงาน";
    }
         ?>
   <div>
     <form class="" action="index.php?page=record_practice" method="post">
       <button type="submit" value="<?php echo $fet['position_key']; ?>"  name="key_position">บันทึกข้อมูลฝึกปฏิบัติงาน</button>
     </form>
  </div>

        </td>

      </tr>
    <?php $i++;
    }
    ?>
    </table>
<?php }else if($_POST['key_position'] != ""){
if($_POST['record_date'] != "" && $_POST['record_work'] != "" && $_POST['record_problems'] != "" ){
  $sql = mysql_query("INSERT INTO tb_record VALUES ('','".$_SESSION['session_key']."','".$_POST['key_position']."','".$_POST['record_date']."','".$_POST['record_work']."','".$_POST['record_problems']."')");
}
?>
<form action="index.php?page=record_practice" method="post" id="form_record">
  <input type="hidden" name="key_position" value="<?php echo $_POST['key_position']; ?>">
<div class="form-group row">
  <div class="col-md-2">
    <label for="">วันที่</label>
    <input type="date" name="record_date" value="" class="form-control" >
  </div>
  <div class="col-md-2">
    <label for="">งานที่ปฏิบัติ</label>
    <input type="text" name="record_work" value="" class="form-control" >
  </div>
  <div class="col-md-2">
    <label for="">ปัญหาและการแก้ไข</label>
    <input type="text" name="record_problems" value="" class="form-control">
  </div> <br>
  <div class="col-md-2">
    <input type="button"  value="บันทึกข้อมูล" class="btn btn-success" id="save_record">
  </div>
</div>
<?php } if($_POST['key_position'] != "" ){ ?>

<table class="table table-bordered ">
  <tr>
    <td>ลำดับ</td>
    <td>วันที่</td>
    <td>งานที่ปฏิบัติ</td>
    <td>ปัญหาและการแก้ไข</td>
    <td>จัดการข้อมูล</td>
  </tr>
<?php
$sql = mysql_query("SELECT * FROM  tb_record WHERE student_keyf = '".$_SESSION['session_key']."' AND position_keyf = '".$_POST['key_position']."' ");
while($fet = mysql_fetch_array($sql)){ ?>
  <tr>
    <td><?php echo $i+1; ?></td>
    <td><?php echo changeDate($fet['record_date']); ?></td>
    <td><?php echo $fet['record_work']; ?></td>
    <td><?php echo $fet['record_problems']; ?></td>
    <td><button class="btn btn-primary" id="model_edit" type="button" value="<?php echo $fet['record_id'];  ?>">แก้ไขข้อมูล</button></td>
  </tr>
<?php $i++;
} }
?>
</table>
  </div>

<script type="text/javascript">
$("#save_record").click(function(){
  var r = confirm("ยืนยันการบันทึกข้อมูล");
  if (r == true) {
      $('#form_record').submit();
  }
});

$("[id^=model_edit]").click(function(){
  var id = $(this).val();
  $.post('include/student/edit_record_model.php',{
    id : id
  },function(data){
    $('#show_data_model').html(data);
  });
  $("#myModal").modal('show');
});
</script>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">แก้ไขข้อมูลการฝึกปฏิบัติงานประจำวัน</h4>
      </div>
      <div class="modal-body" id= "show_data_model">

      </div>
      <div >
        <button type="button" class="btn btn-default" data-dismiss="modal">X ปิด</button>
      </div>
    </div>
  </div></div>
