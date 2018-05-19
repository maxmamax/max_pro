<div class="panel panel-default" >
<div class="panel-heading f1" style="background-color:#ffcfa8;border-width:1px 10px 20px;border-color:#ff7b3a;"><span class="glyphicon glyphicon-list" aria-hidden="true"></span>  ประกาศการผ่านสัมภาษณ์งาน</div>
<div class="panel-body">
<div class="table-responsive">
<table class="table table-bordered table-hover">
    <thead>
  <tr>
    <td>ตำแหน่งงาน</td>
    <td>จำนวนที่ผ่านเข้าฝึกปฏิบัติงาน</td>
  </tr>
    </thead>
  <?php
  $sql = mysql_query("SELECT * FROM  tb_register_job a , tb_position b WHERE a.job_status = '3' AND a.position_keyf = b.position_key GROUP BY a.position_keyf   LIMIT 10 ");
  while($fet = mysql_fetch_array($sql)){
  $sql1 = mysql_query("SELECT count(register_key) as num FROM  tb_register_job WHERE position_keyf = '".$fet['position_key']."' AND job_status = '3' ");
  $fet1 = mysql_fetch_array($sql1);
    ?>
    <tr>
      <td><?php echo $fet['position_name']; ?></td>
      <td><?php echo $fet1['num']; ?></td>
      <td><button value="<?php echo $fet['position_key']; ?> " id="show_practice" class="btn btn-default"><span class="glyphicon glyphicon-eye-open" aria-hidden="true" style="color:#000000;"></span> ดูข้อมูล</button></td>
    </tr>
<?php } ?>
</table>
</div>
</div>
<div class="" align="right" style="margin-right:25px;">
  <a href="?page=show_practice">>>ข้อมูลทั้งหมด</a>
</div><br>
</div>

<script type="text/javascript">
 $('[id^=show_practice]').click(function(){
   var id = $(this).val();
   window.open("include/preview_practice.php?id="+id, "", "width=1000,height=500");
 });
</script>
