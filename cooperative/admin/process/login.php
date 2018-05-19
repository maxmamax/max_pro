<?php session_start(); ob_start(); ?>
<meta name="twitter:" content="" charset="utf-8">
<?php
mysql_connect("localhost","root","max123456");
mysql_select_db('tbl_cooperativenews');
$sql = "SELECT * FROM tb_login WHERE tb_user = '".$_POST['user']."' AND tb_pass = '".$_POST['pass']."' ";
$query = mysql_query($sql);
$fet = mysql_fetch_array($query);
if($fet){
  $_SESSION['session_key'] = '1';
 header("location: ../index.php");
}else{
 //header("location: ../index.php");
}
 ?>
