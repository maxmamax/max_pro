<?php include("../process/connect.php"); session_start(); date_default_timezone_set("Asia/Bangkok"); ?>
<?php
$sql = mysql_query("DELETE FROM  tb_offer WHERE offer_id = '".$_POST['id']."' ");
if($sql){ ?>
  <script type="text/javascript">
      alert("ลบข้อมูลการแจ้งเพิ่มประเภทงานเรียบร้อย");
  </script>
<?php
   header( "refresh: 1; url=../index.php?page=data_type&chk=2" );
}
?>
