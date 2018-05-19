<?php include("connect.php");  ob_start(); ?>
<?php
$name1 = $_FILES['file1']['name'];
$name = iconv("utf-8", "tis-620", $name1 );
$sql = mysql_query("SELECT max(dowload_key) as max FROM tb_dowload");
$fet = mysql_fetch_array($sql);
$max = $fet['max']+1;
$str = end( explode( '.' , $_FILES['file1']['name'] ) ) ;
copy($_FILES['file1']['tmp_name'],'../uploaddowload/'.$name);
$part  = "uploaddowload/".$name1;
$sql  = mysql_query("INSERT INTO  tb_dowload VALUES ('','".$_POST['topic1']."','$part','$max','1') ");
if($sql){
header("location: ../index.php?select=4");
}
?>
