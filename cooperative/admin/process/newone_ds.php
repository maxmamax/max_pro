<?php include("connect.php"); ?>
<?php
$sql = mysql_query("SELECT (newsone_status) FROM  tb_newsone  WHERE newsone_key = '".$_POST['key']."' ");
$fet = mysql_fetch_array($sql);
if($_POST['status'] == 's'){
if($fet['newsone_status'] == '1'){
  $sql = mysql_query("UPDATE tb_newsone SET newsone_status = '0'  WHERE newsone_key = '".$_POST['key']."' ");
}else if($fet['newsone_status'] == '0') {
  $sql = mysql_query("UPDATE tb_newsone SET newsone_status = '1'  WHERE newsone_key = '".$_POST['key']."'  ");
}
}else if($_POST['status'] == 'd'){
 $sql = mysql_query("DELETE FROM  tb_newsone WHERE newsone_key = '".$_POST['key']."' ");
}


 ?>
