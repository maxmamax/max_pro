<?php include("../connect.php"); session_start();  date_default_timezone_set("Asia/Bangkok"); ?>
<?php
$sql = mysql_query("SELECT * FROM tb_offer WHERE coop_keyf = '".$_SESSION['session_key']."' AND offer_name = '".$_POST['name']."' ");
$num =  mysql_num_rows($sql);
if($num != '0'){
  echo "2";
}else{
  $sql1 = mysql_query("INSERT INTO  tb_offer VALUES ('','".$_SESSION['session_key']."','".$_POST['name']."') ");
  if($sql1){
  echo "1";
  }
}
?>
