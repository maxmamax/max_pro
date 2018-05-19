<?php include("connect.php"); ob_start(); ?>
<?php
$key = $_POST['key'];
if($_FILES['file1']['tmp_name'] != ''){
$name1 = $_FILES['file1']['name'];
$name = iconv("utf-8", "tis-620", $name1 );
echo $str = end( explode( '.' , $_FILES['file1']['name'] ) ) ;
copy($_FILES['file1']['tmp_name'],'../uploaddowload/'.$name);
$part  = "uploaddowload/".$name1;
$sql1 = mysql_query("UPDATE  tb_dowload SET dowload_part = '$part' WHERE dowload_key = '$key' ");

}
$sql2 = mysql_query("UPDATE  tb_dowload SET
dowload_topic = '".$_POST['topic1']."',
dowload_que   = '".$_POST['que1']."'
WHERE dowload_key = '$key' ");
header("location: ../index.php?page=dowload");
?>
