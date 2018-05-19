<?php include("connect.php"); ?>
<?php
$sql = mysql_query("SELECT (newtwo_status) FROM  tb_newstwo  WHERE newstwo_key = '".$_POST['key']."' ");
$fet = mysql_fetch_array($sql);
echo "ค่า".$fet['newtwo_status'];
if($_POST['status'] == 's'){
if($fet['newtwo_status'] == '1'){
  $sql = mysql_query("UPDATE tb_newstwo SET newtwo_status = '0'  WHERE newstwo_key = '".$_POST['key']."' ");
}else if($fet['newtwo_status'] == '0') {
  echo "มา0";
  $sql = mysql_query("UPDATE tb_newstwo SET newtwo_status = '1'  WHERE newstwo_key = '".$_POST['key']."'  ");
}
}else if($_POST['status'] == 'd'){
 $sql = mysql_query("DELETE FROM  tb_newstwo WHERE newstwo_key = '".$_POST['key']."' ");
}


 ?>
