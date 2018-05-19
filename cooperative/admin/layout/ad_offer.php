<?php include("../process/connect.php"); session_start(); date_default_timezone_set("Asia/Bangkok"); ?>

<?php

if($_POST['chk'] != ""){
  if($_POST['status'] == "add"){
    foreach ($_POST['chk'] as $key => $value) {
      $sql = mysql_query("SELECT * FROM tb_offer WHERE offer_id = '".$value."' ");
      $fet = mysql_fetch_array($sql);

      $sql = mysql_query("INSERT INTO  tb_type_ope VALUES ('','".$fet['offer_name']."')"); ?>
      <script type="text/javascript">
        alert("เพิ่มประเภทงานเรียบร้อย");
      </script>
<?php
header( "refresh: 1; url=../index.php?page=data_type&chk=2" );
    }
  }else if($_POST['status'] == "delete"){
  foreach ($_POST['chk'] as $key => $value) {
    $sql = mysql_query("DELETE FROM tb_offer WHERE offer_id = '".$value."' ");
  } ?>
  <script type="text/javascript">
      alert("ลบข้อมูลการแจ้งเพิ่มประเภทงานเรียบร้อย");
  </script>
<?php
 header( "refresh: 1; url=../index.php?page=data_type&chk=2" );
  }
}else{
  header( "refresh: 1; url=../index.php?page=data_type&chk=2" );

}
?>
