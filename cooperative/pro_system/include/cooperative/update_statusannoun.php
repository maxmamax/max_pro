<?php include("../../include/connect.php"); session_start();  date_default_timezone_set("Asia/Bangkok");?>
<?php
if($_POST['id'] != ""){
$sql = mysql_query("UPDATE tb_position SET position_status = '1' WHERE position_key = '".$_POST['id']."' ");
if($sql){
location.reload();
}

}
 ?>
