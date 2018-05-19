<?php include("connect.php"); ob_start(); ?>
<?php
$key = $_POST['key'];
if($_FILES['file1']['tmp_name'] != ''){
echo $str = end( explode( '.' , $_FILES['file1']['name'] ) ) ;
copy($_FILES['file1']['tmp_name'],'../uploadnewtwo/'.$key.".".$str);
echo $part  = "uploadnewtwo/"."$key".".$str";
$sql1 = mysql_query("UPDATE  tb_newstwo SET newtwo_part = '$part' WHERE newstwo_key = '$key' ");
}
$sql2 = mysql_query("UPDATE  tb_newstwo SET
newtwo_topic = '".$_POST['topic1']."',
newtwo_sup   = '".$_POST['sup1']."',
newtwo_que   = '".$_POST['que1']."' WHERE newstwo_key = '$key' ");
header("location: ../index.php?page=newstwo");
?>
