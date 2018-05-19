<div class="panel panel-default">
  <div class="panel-heading f1"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> ข้อมูลประกาศการฝึกปฏิบัติงานงาน</div>
  <div class="panel-body">
    <div class="table-responsive">
    <table class="table table-bordered table-hover">
      <thead>
      <tr>
        <td>ลำดับ</td>
        <td>ตำแหน่งงาน</td>
        <td>จำนวนที่ผ่านเข้าฝึกปฏิบัติงาน</td>
      </tr>
    </thead>
      <?php
      $sql = "SELECT * FROM  tb_register_job a , tb_position b WHERE a.job_status = '3' AND a.position_keyf = b.position_key GROUP BY a.position_keyf  ";
      $sql_qu = mysql_query($sql);
      $Num_Rows = mysql_num_rows($sql_qu);
      $Per_Page = 10;
      $Page = $_GET["Page_data"];
      if(!$_GET["Page_data"])
      {
      $Page=1;
      }
      $Prev_Page = $Page-1;
      $Next_Page = $Page+1;
      $Page_Start = (($Per_Page*$Page)-$Per_Page);
      if($Num_Rows<=$Per_Page)
      {
      $Num_Pages =1;
      }
      else if(($Num_Rows % $Per_Page)==0)
      {
      $Num_Pages =($Num_Rows/$Per_Page) ;
      }
      else
      {
      $Num_Pages =($Num_Rows/$Per_Page)+1;
      $Num_Pages = (int)$Num_Pages;
      }
      $sql .="  LIMIT $Page_Start , $Per_Page";
      $objQuery  = mysql_query($sql);
      while($fet = mysql_fetch_array($objQuery)){
      $sql1 = mysql_query("SELECT count(register_key) as num FROM  tb_register_job WHERE position_keyf = '".$fet['position_key']."' AND job_status = '3' ");
      $fet1 = mysql_fetch_array($sql1);
        ?>
        <tr>
          <td><?php echo $i+1; ?></td>
          <td><?php echo $fet['position_name']; ?></td>
          <td><?php echo $fet1['num']; ?></td>
          <td><button value="<?php echo $fet['position_key']; ?> " id="show_practice" class="btn btn-default"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> ดูข้อมูล</button></td>
        </tr>
    <?php } ?>
    </table>
  </div>
    จำนวนข้อมูลทั้งหมด <?php echo $Num_Rows;?> ข้อมูล  จำนวนหน้าทั้งหมด <?php echo $Num_Pages; ?> หน้า :
    <?php
    if($Prev_Page)
    {
    echo " <a href='$_SERVER[SCRIPT_NAME]?page=job_register&Page_data=$Prev_Page&s_coop=$_GET[s_coop]&s_position=$_GET[s_position]&s_type=$_GET[s_type]&s_s=$GET[s_s]'><< ย้อนกลับ</a> ";
    }
    for($i=1; $i<=$Num_Pages; $i++){
    if($i != $Page)
    {
    echo " <a href='$_SERVER[SCRIPT_NAME]?page=job_register&Page_data=$Prev_Page&s_coop=$_GET[s_coop]&s_position=$_GET[s_position]&s_type=$_GET[s_type]&s_s=$GET[s_s]'><button class='btn btn-detail'>$i</button></a> ";
    ?>
    <?php
    }
    else
    {
    echo "<b> $i </b>";
    }
    }
    if($Page!=$Num_Pages)
    {
    echo " <a href ='$_SERVER[SCRIPT_NAME]?page=job_register&Page_data=$Prev_Page&s_coop=$_GET[s_coop]&s_position=$_GET[s_position]&s_type=$_GET[s_type]&s_s=$GET[s_s]'>ถัดไป>></a> ";
    } ?>
  </div>
</div>

<script type="text/javascript">
 $('[id^=show_practice]').click(function(){
   var id = $(this).val();
   window.open("include/preview_practice.php?id="+id, "", "width=1000,height=500");
 });
</script>
