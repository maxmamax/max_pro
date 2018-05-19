<?php include("connect.php"); ob_start(); ?>
<?php
$key = $_POST['key'];
if($_FILES['file1']['tmp_name'] != ''){
echo $str = end( explode( '.' , $_FILES['file1']['name'] ) ) ;
copy($_FILES['file1']['tmp_name'],'../uploadnewone/'.$key.".".$str);
echo $part  = "uploadnewone/"."$key".".$str";
$sql1 = mysql_query("UPDATE  tb_newsone SET newone_part = '$part' WHERE newsone_key = '$key' ");

}
$sql2 = mysql_query("UPDATE  tb_newsone SET
newone_topic = '".$_POST['topic1']."',
newone_sup   = '".$_POST['sup1']."',
newone_link   = '".$_POST['link1']."',
newone_que   = '".$_POST['que1']."' WHERE newsone_key = '$key' ");
header("location: ../index.php?page=newsone");
?>
