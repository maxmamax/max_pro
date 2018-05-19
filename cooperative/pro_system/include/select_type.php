<?php session_start(); include("connect.php"); ob_start(); ?>
<option value="">-- สถานประกอบการ --</option>

<?php
if($_POST['id'] != ''){
$sql = mysql_query("SELECT * FROM tb_position a , tb_type_ope b WHERE a.coop_keyf = '".$_POST['id']."' AND a.position_typef = b.type_key GROUP BY b.type_key  ");
while($fet = mysql_fetch_array($sql)){ ?>
  <option value="<?php echo $fet['type_key']; ?>"><?php echo $fet['type_name']; ?></option>
<?php
} }else{ ?>
  <?php
  $sql = mysql_query("SELECT * FROM  tb_type_ope ");
  while($fet = mysql_fetch_array($sql)){
  ?>
  <option <?php if($_GET['s_type'] == $fet['type_key']){ echo "selected"; } ?> value="<?php echo $fet['type_key']; ?>" <?php if($fet['type_key'] == $_POST['s_type']) { echo "selected"; } ?> ><?php echo $fet['type_name']; ?></option>
<?php } } ?>
