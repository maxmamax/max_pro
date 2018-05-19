<?php include("connect.php");  ob_start(); ?>
<?php
$sql = mysql_query("SELECT max(newstwo_key) as max FROM tb_newstwo");
echo $fet = mysql_fetch_array($sql);
echo $max = $fet['max']+1;
echo $str = end( explode( '.' , $_FILES['file1']['name'] ) ) ;
copy($_FILES['file1']['tmp_name'],'../uploadnewtwo/'.$max.".".$str);
$part  = "uploadnewtwo/"."$max".".$str";
$sql  = mysql_query("INSERT INTO  tb_newstwo VALUES ('','".$_POST['topic1']."','".$_POST['sup1']."','$part','$max','1') ");
if($sql){
header("location: ../index.php?page=newstwo");
}
?>
