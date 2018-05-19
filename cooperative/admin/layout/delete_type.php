<?php include("../process/connect.php"); session_start(); date_default_timezone_set("Asia/Bangkok"); ?>
<?php
$sql = mysql_query("DELETE FROM tb_type_ope WHERE type_key = '".$_POST['id']."' ");
if($sql){ ?>
  <script type="text/javascript">
      alert("ลบข้อมูลประเภทงานเรียบร้อย");
  </script>
<?php
   header( "refresh: 1; url=../index.php?page=data_type&chk=1" );
}
?>
