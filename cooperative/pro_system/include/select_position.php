<?php session_start(); include("connect.php"); ob_start(); ?>
<?php
if($_POST['s_type'] != ""){ ?>
  <select class="form-control" name="s_position">
<?php
$sql = mysql_query("SELECT * FROM tb_position WHERE position_typef = '".$_POST['s_type']."' AND position_status = 1 AND DATEDIFF(NOW(),position_dateL) <= 0  ");
while ($fet = mysql_fetch_array($sql)) { ?>
<option value="<?php echo $fet['position_name']; ?>"><?php echo $fet['position_name']; ?></option>
<?php
}
?>
  </select>
<?php
}else{ ?>
      <input class="form-control"  type="text" placeholder="ตำแหน่งงาน" name="s_position" value="<?php echo $_GET['s_position']; ?>">
<?php
}
?>
