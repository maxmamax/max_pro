<?php include("../connect.php"); session_start(); ?>
<div class="panel panel-default">
  <div class="panel-heading"><h1>ข้อมูลสถานประกอบการสนใจนักศึกษา</h1></div>
  <div class="panel-body">
    <table class="table">
      <tr>
        <td>ลำดับ</td>
        <td>ตำแหน่งงาน</td>
        <td>ดูข้อมูล</td>
      </tr>
<?php
$sql = mysql_query("SELECT * FROM  tb_register_job  a , tb_position  b  WHERE a.student_keyf = '".$_POST['id']."' ");
while($fet = mysql_fetch_array($sql)){ ?>
  <tr>
    <td><?php echo $i+1; ?></td>
    <td><?php echo $fet['position_name']; ?></td>
    <td><button id="detail" class="btn btn-success" value="<?php echo $fet['position_key']; ?>">ดูข้อมูล</button></a></td>
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
      alert(id);
      $.get('include/teacher/job_studentb.php',{
      position : id
      },function(data){
        $("#show_data").hide();
        $("#show_detail").html(data);

      });
    });
  </script>
