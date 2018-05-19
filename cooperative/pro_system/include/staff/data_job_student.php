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
<?php if($_SESSION['session_status_menu'] == 'staff' && $_GET['faculty'] == '' && $_GET['course'] == '' ){
?>
<div class="panel panel-default">
  <div class="panel-heading"><h1><span class="glyphicon glyphicon-list"></span> ข้อมูลการจองตำแหน่งงานของนักศึกษา</h1></div>
  <div class="panel-body">
  <div class="table-responsive">
<table class="table table-bordered table-hover">
<thead>
  <tr class="f1">
    <td>ลำดับ</td>
    <td>คณะ/สาขา</td>
    <td>ข้อมูล</td>
  </tr>
</thead>
<?php
$sql = mysql_query("SELECT * FROM   tb_consultants_p  WHERE con_keyP = '".$_SESSION['session_key']."' ");
while($fet = mysql_fetch_array($sql) ){
if($fet['con_status'] == '1'){
$sql1 = mysql_query("SELECT * FROM tb_faculty WHERE faculty_key = '".$fet['con_keyFB']."' ");
$fet1 = mysql_fetch_array($sql1);
$fb = $fet1['faculty_name'];
$sql2 = mysql_query("SELECT COUNT(student_key) as num  FROM  tb_student WHERE faculty_keyf = '".$fet['con_keyFB']."' ");
$fet2 = mysql_fetch_array($sql2);
$num = $fet2['num'];
}else{
$sql1 = mysql_query("SELECT * FROM  tb_course WHERE course_key = '".$fet['con_keyFB']."' ");
$fet1 = mysql_fetch_array($sql1);
$fb = $fet1['course_name'];
$sql2 = mysql_query("SELECT COUNT(student_key) as num  FROM  tb_student WHERE course_key = '".$fet['con_keyFB']."' ");
$fet2 = mysql_fetch_array($sql2);
$num = $fet2['num'];
//echo $p = "course=$fet1['course_key']";
}
 ?>
 <tr class="f2">
   <td><?php echo $i+1; ?></td>
<?php   if($fet['con_status'] == '1'){ ?>
   <td>
     <?php echo $fb; ?>
   </td>
<?php }else{ ?>
   <td>
     <?php echo $fb; ?>
   </td>
<?php }?>
<?php if($fet['con_status'] == '1'){ ?>
   <td>
  <form action="index.php?page=data_jobstudent" method="post">
  <input type="hidden" name="status" value="f">
  <button id="id_faculty" class="btn btn-success" type="submit" name="id" value="<?php echo $fet1['faculty_key']; ?>">ดูข้อมูล</button>
  </form>
   </td>
<?php }else{ ?>
   <td>
  <form action="index.php?page=data_jobstudent" method="post">
  <input type="hidden" name="status" value="c">
  <button id="id_course"  class="btn btn-success"   type="submit" name="id" value="<?php echo $fet1['course_key']; ?>">ดูข้อมูล</button>
</FORM>
  </td>
<?php }?>
 </tr>
<?php $i++;
} ?>
</table>

<?php
 } ?>
 </div>
</div>
</div>
<script type="text/javascript">
  $("[id^=id_faculty]").click(function(){
    var id = $(this).val();
    $.post('include/staff/data_jobstudent.php',{
      id : id,
      status : 'f'
    },function(data){
      $("#show_data").html(data);
    });
  });

  $("[id^=id_course]").click(function(){
    var id = $(this).val();
    $.post('include/staff/data_jobstudent.php',{
      id : id,
      status : 'c'
    },function(data){
      $("#show_data").html(data);
    });
  });


</script>
