<?php include("connect.php"); ?>
<?php
$sql = mysql_query("SELECT * FROM tb_course WHERE faculty_keyf = '".$_POST['id']."' ");
while($fet = mysql_fetch_array($sql)){
?>
  <option value="<?php echo $fet['course_key']; ?>"><?php echo $fet['course_name']; ?></option>
<?php } ?>
