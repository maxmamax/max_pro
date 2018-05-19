<?php include("../connect.php"); session_start(); ?>
<div class="panel panel-default">
  <div class="panel-heading"><h1><font>ข้อมูลสถานประกอบการสนใจนักศึกษา</font><button class="btn btn-danger" id="turn">ย้อนกลับ</button></h1></div>
  <div class="panel-body">
    <table class="table">
      <tr>
        <td>ลำดับ</td>
        <td>สถานประกอบการ</td>
        <td>ดูข้อมูล</td>
      </tr>
<?php
$sql = mysql_query("SELECT * FROM   tb_cooperative   WHERE coop_key  = '".$_POST['id']."' ");
while($fet = mysql_fetch_array($sql)){ ?>
  <tr>
    <td><?php echo $i+1; ?></td>
    <td><?php echo $fet['coop_Tname']; ?></td>
    <td><button id="detail" class="btn btn-success" value="<?php echo $fet['coop_key']; ?>">ดูข้อมูล</button></a></td>
  </tr>

<?php
$i++;
}
?>

  </table>
  </div></div>

  <script type="text/javascript">
    $("[id^=detail]").click(function(){
      var id = $(this).val();
      $.get('include/staff/job_detailreply.php',{
      cooperative : id
      },function(data){
        $("#show_data").hide();
        $("#show_detail").html(data);

      });
    });

           $("#turn").click(function(){
             $("#show_data").load("include/staff/data_jobconsultantr.php");
           });
  </script>
