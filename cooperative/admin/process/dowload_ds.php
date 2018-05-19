<?php include("connect.php"); ?>
<?php
$sql = mysql_query("SELECT (dowload_status) FROM   tb_dowload  WHERE dowload_key = '".$_POST['key']."' ");
$fet = mysql_fetch_array($sql);
echo "ค่า".$fet['newtwo_status'];
if($_POST['status'] == 's'){
if($fet['dowload_status'] == '1'){
  $sql = mysql_query("UPDATE tb_dowload SET dowload_status = '0'  WHERE dowload_key = '".$_POST['key']."' ");
}else if($fet['dowload_status'] == '0') {
  echo "มา0";
  $sql = mysql_query("UPDATE tb_dowload SET dowload_status = '1'  WHERE dowload_key = '".$_POST['key']."'  ");
}
}else if($_POST['status'] == 'd'){
 $sql = mysql_query("DELETE FROM  tb_dowload WHERE dowload_key = '".$_POST['key']."' ");
}


 ?>
