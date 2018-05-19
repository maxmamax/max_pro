<?php ob_start(); ?>
<?php include("../process/connect.php"); ?>
<?php
if($_POST['status'] == 'p'){
  echo 'p';
$sql = mysql_query("DELETE FROM tb_consultants_p WHERE id_key = '".$_POST['id']."' ");
}
if($_POST['status'] == 't'){
  echo 't';

$sql = mysql_query("DELETE FROM tb_consultants_t WHERE id_key = '".$_POST['id']."' ");
}
?>
