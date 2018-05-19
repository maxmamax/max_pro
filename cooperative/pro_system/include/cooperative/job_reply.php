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
?>
<?php if($_SESSION['session_status_menu'] == 'cooperative' && $_GET['position'] == '' ){ ?>

<div class="panel panel-default">
  <div class="panel-heading"><h1><span class="glyphicon glyphicon-list" aria-hidden="true"></span> การคัดเลือกนักศึกษาฝึกปฏิบัติงาน</h1></div>
  <div class="panel-body">
<?php if($_SESSION['session_status_menu'] == 'cooperative' && $_GET['key'] == ""){ ?>
  <form action="" method="post">
  <div class="form-group row">
    <div class="col-md-2">
      <label for="">คณะ</label>
      <select class="form-control" name="select_faculty" id="select_faculty">
        <option value="">-- เลือกคณะ --</option>
        <?php $sql = mysql_query("SELECT * FROM tb_faculty ");
        while($fet = mysql_fetch_array($sql)){ ?>
        <option <?php if($fet['faculty_key'] == $_POST['select_faculty'] ){ echo "selected"; } ?> value="<?php echo $fet['faculty_key']; ?>"><?php echo $fet['faculty_name']; ?></option>
        <?php } ?>
      </select>
    </div>
    <div class="col-md-2">
      <label for="">สาขา</label>
      <select class="form-control" name="select_course" id="select_course">
        <option value="">-- เลือกสาขา --</option>
        <?php
        $sql = mysql_query("SELECT * FROM tb_course ");
        while($fet = mysql_fetch_array($sql)){ ?>
          <option <?php if($fet['course_key'] == $_POST['select_course'] ){ echo "selected"; } ?>  value="<?php echo $fet['course_key']; ?>"><?php echo $fet['course_name']; ?></option>
        <?php
      } ?>
      </select>
    </div>
    <div class="col-md-2">
      <label for="">เพศ</label>
      <select class="form-control" name="select_sex" id="select_Year">
        <option <?php if($_POST['select_sex'] == ''){ echo "selected"; } ?> value="">-- เลือกเพศ --</option>
        <option <?php if($_POST['select_sex'] == '1'){ echo "selected"; } ?> value="1">ชาย</option>
        <option <?php if($_POST['select_sex'] == '2'){ echo "selected"; } ?> value="2">หญิง</option>
        <option <?php if($_POST['select_sex'] == '3'){ echo "selected"; } ?> value="3">ชายและหญิง</option>
      </select>
    </div>
    <div class="col-md-2">
      <label for="">เกรดเฉลี่ย</label>
      <table>
        <tr>
          <td><input type="text" name="grade_s" value="<?php echo $_POST['grade_s']; ?>" class="form-control"></td>
          <td width="30px" style="text-align:center;"> - </td>
          <td><input type="text" name="grade_l" value="<?php echo $_POST['grade_l']; ?>" class="form-control"></td>
        </tr>
      </table>
    </div>
    <div class="col-md-2">
      <label for="">ค้นหา</label> <br>
      <input type="submit" name="" value="ค้นหา" class="btn btn-success">
    </div>
  </div>
</form>
<?php
if($_POST['select_faculty'] != ""){
  $q .= " AND b.faculty_keyf = '".$_POST['select_faculty']."' ";
}
if($_POST['select_course'] != ""){
  $q .= " AND b.course_key = '".$_POST['select_course']."' ";
}
if($_POST['select_sex'] != ""){
  if($_POST['select_sex'] != '3'){
  $q .= " AND c.f_sex = '".$_POST['select_sex']."' ";
  }
}
if($_POST['grade_s'] != "" && $_POST['grade_l'] != ""){
  $q .= " AND c.f_grade BETWEEN '".$_POST['grade_s']."' AND '".$_POST['grade_l']."' ";
}
?>
  <div class="table-responsive">
  <?php if($_POST['select_faculty'] != "" || $_POST['select_course'] != "" || $_POST['select_sex'] != "" ||  ($_POST['grade_s'] != "" && $_POST['grade_l'] != "")){ ?>
  <table class="table table-bordered table-hover">
  <thead>
  <tr class="f1">
    <td>ลำดับ</td>
    <td>รูปภาพ</td>
    <td>รหัสนักศึกษา</td>
    <td>ชื่อ</td>
    <td>เกรดเฉลี่ย</td>
    <td >ข้อมูล</td>
  </tr>
</thead>
<?php
$sql = "SELECT * FROM tb_student  b ,  tb_regiter_s c  WHERE b.student_key = c.student_keyf  $q " ;
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
while($fet = mysql_fetch_array($objQuery)){
?>
  <tr class="f2">
    <td><?php echo  (($Page-1)*10)+$i ; ?></td>
    <td ><img width="100" height="100" src="include/image_student/<?php echo $fet['student_part']; ?>"></td>
    <td><?php echo $fet['student_code']; ?></td>
    <td ><?php echo $fet['student_name']." ".$fet['student_last']; ?></td>
    <td><?php echo $fet['f_grade']; ?></td>
    <td ><a href="index.php?page=student_practice&key=<?php echo $fet['student_key']; ?>"><button class="btn btn-success">ดูข้อมูล</button></a></td>
  </tr>
<?php $i++; } ?>
</table>
  </div>
  จำนวนข้อมูลทั้งหมด <?php echo $Num_Rows;?> ข้อมูล  จำนวนหน้าทั้งหมด <?php echo $Num_Pages; ?> หน้า :
<?php
if($Prev_Page)
{
echo " <a href='$_SERVER[SCRIPT_NAME]?page=job_reply&Page_data=$Prev_Page'><< ย้อนกลับ</a> ";
}
for($i=1; $i<=$Num_Pages; $i++){
if($i != $Page)
{
echo " <a href='$_SERVER[SCRIPT_NAME]?page=job_reply&Page_data=$i'><button class='btn btn-detail'>$i</button></a> ";
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
echo " <a href ='$_SERVER[SCRIPT_NAME]?page=job_reply&Page_data=$Next_Page'>ถัดไป>></a> ";
} ?>

<?php } ?>
    </div>
    </div>
<?php } } ?>
<script type="text/javascript">

var id = $("#select_faculty").val();
$.post("include/cooperative/select_course.php",{
id : id
},function(data){
$("#select_course").html(data);
});

$("#select_faculty").change(function(){
var id = $(this).val();
$.post("include/cooperative/select_course.php",{
id : id
},function(data){
$("#select_course").html(data);
});
});

$("#add_reply").click(function(){
  var r = confirm("ยืนยันการแก้ไขข้อมูล");
  if (r == true) {
      $('#form_reply').submit();
  }
});

  CKEDITOR.replace( 'message' );
</script>
