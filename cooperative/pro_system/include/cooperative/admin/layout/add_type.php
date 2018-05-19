<?php include("../process/connect.php"); session_start(); date_default_timezone_set("Asia/Bangkok"); ob_start(); ?>

<?php
if($_POST['name_type'] != ''){
  $_GET['chk'] = '1';
  $sql = mysql_query("SELECT * FROM  tb_type_ope WHERE type_name = '".$_POST['name_type']."' ");
  $fet = mysql_fetch_array($sql);
  if($fet){ ?>
    <script type="text/javascript">
    alert("มีข้อมูลประเภทงานนี้แล้ว");
    </script>

<?php
header("Refresh:1; url=../index.php?page=data_type&chk=1");
  }else{
  $sql = mysql_query("INSERT INTO tb_type_ope VALUES ('','".$_POST['name_type']."') ");
  ?>
  <script type="text/javascript">
  alert("เพิ่มข้อมูลประเภทงานเรียบร้อย");
  </script>
<?php
header("Refresh:1; url=../index.php?page=data_type&chk=1");
  }
}
?>
