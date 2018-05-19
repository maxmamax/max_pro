<?php include("connect.php");  ob_start(); ?>
<?php
$sql = mysql_query("SELECT max(newsone_key) as max FROM tb_newsone");
echo $fet = mysql_fetch_array($sql);
echo $max = $fet['max']+1;
echo $str = end( explode( '.' , $_FILES['file1']['name'] ) ) ;
copy($_FILES['file1']['tmp_name'],'../uploadnewone/'.$max.".".$str);
$part  = "uploadnewone/"."$max".".$str";
$sql  = mysql_query("INSERT INTO  tb_newsone VALUES ('','".$_POST['topic1']."','".$_POST['sup1']."','".$_POST['link1']."','$part','$max','1') ");
if($sql){
  header("location: ../index.php?page=newsone");
}
?>
