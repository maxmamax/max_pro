<?php include("../process/connect.php"); ?>
<?php
if($_POST['key'] == '1'){
$a = 'tb_faculty';
}else if($_POST['key'] == '2'){
$a = 'tb_course';
}
echo $sql = mysql_query("SELECT * FROM $a ");
while($fet = mysql_fetch_array($sql)){
  if($_POST['key'] == '1'){ ?>
<option value="<?php echo $fet['faculty_key']; ?>"><?php echo $fet['faculty_name']." ".$fet['teacher_last']; ?></option>
  <?php
}else if($_POST['key'] == '2'){ ?>
  <option value="<?php echo $fet['course_key']; ?>"><?php echo $fet['course_name']." ".$fet['teacher_last']; ?></option>
<?php
  }
}
 ?>
