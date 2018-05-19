<?php include("../connect.php"); session_start(); ?>
<option value="">-- เลือกสาขา --</option>
<?php
if($_POST['id'] != ""){
  $q = " WHERE faculty_keyf = '".$_POST['id']."' ";
}
$sql = mysql_query("SELECT * FROM tb_course $q  ");
while($fet = mysql_fetch_array($sql)){ ?>
  <option  <?php if($fet['course_key'] == $_POST['select_course'] ){ echo "selected"; } ?> value="<?php echo $fet['course_key']; ?>"><?php echo $fet['course_name']; ?></option>
<?php
}
?>
