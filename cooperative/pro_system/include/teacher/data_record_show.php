<?php include("include/connect.php"); session_start(); ?>

<?php
if($_POST['status'] == 'f'){ ?>
  <div class="panel panel-default">
    <div class="panel-heading"><h1><font>ข้อมูลบันทึกประจำวันการฝึกปฏิบัติงานของนักศึกษา</font></h1></div>
    <div class="panel-body">
      <form action="" method="post">
      <div class="form-group row">
        <div class="col-md-2 ">
          <?php
          if($_POST['s'] != ""){
            $s = " AND a.student_name LIKE '%".$_POST['s']."%'  ";
          }
          ?>
          <label for="">ค้นหานักศึกษา</label>
          <input type="hidden" name="id" value="<?php echo $_POST['id']; ?>">
          <input type="hidden" name="status" value="<?php echo $_POST['status']; ?>">
          <input type="text" name="s" value="<?php echo $_POST['s']; ?>" class="form-control" placeholder="ชื่อนักศึกษา">
        </div>
        <div class="col-md-2 ">
          <label for="">ค้นหานักศึกษา</label><br>
          <input type="submit" value="ค้นหา" class="btn btn-success" >
        </div>
      </div>
    </form>
  <div class="table-responsive">
<table class="table table-bordered">
  <tr>
    <td>ลำดับ</td>
    <td>รหัสนักศึกษา</td>
    <td>ชื่อนักศึกษา</td>
    <td>ตำแหน่งงาน</td>
    <td>ข้อมูล</td>

  </tr>
<?php
$sql = "SELECT * FROM tb_student a , tb_record b , tb_position c  WHERE a.student_key = b.student_keyf AND b.position_keyf = c.position_key $s GROUP BY b.student_keyf";
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
$i = 1;
while($fet = mysql_fetch_array($objQuery)){
$sql1 = mysql_query("SELECT count(student_keyf) as num FROM  tb_reply_s WHERE student_keyf =  '".$fet['student_key']."' ");
$fet1 = mysql_fetch_array($sql1);
$sql2 = mysql_query("SELECT * FROM  tb_reply_s WHERE student_keyf =  '".$fet['student_key']."'  ");
$fet2 = mysql_fetch_array($sql2);
?>
  <tr>
    <td><?php echo  (($Page-1)*10)+$i ; ?></td>
    <td><?php echo $fet['student_code']; ?></td>
    <td><?php echo $fet['student_name']." ".$fet['student_last']; ?></td>
    <td><?php echo $fet['position_name']; ?></td>
    <td>
      <form class="" action="include/report4/report_student.php" method="post" target="_blank">
        <input type="hidden" name="student_key" value="<?php echo $fet['student_key']; ?>">
        <button class="btn btn-success" type="submit" value="<?php echo $fet['position_key']?> " name="id">ดูข้อมูล</button>
      </form>

    </td>
  </tr>
<?php $i++;  } ?>

</table>
</div>
Total <?php $Num_Rows;?> Record : <?=$Num_Pages;?> Page :
<?php
if($Prev_Page)
{
echo " <a href='$_SERVER[SCRIPT_NAME]?page=job_student&Page_data=$Prev_Page&s_coop=$_GET[s_coop]&s_position=$_GET[s_position]&s_type=$_GET[s_type]&s_s=$_GET[s_ss]'><< Back</a> ";
}
for($i=1; $i<=$Num_Pages; $i++){
if($i != $Page)
{
echo " <a href='$_SERVER[SCRIPT_NAME]?page=job_student&Page_data=$i&s_coop=$_GET[s_coop]&s_position=$_GET[s_position]&s_type=$_GET[s_type]&s_s=$_GET[s_ss]'><button class='btn btn-detail'>$i</button></a> ";
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
echo " <a href ='$_SERVER[SCRIPT_NAME]?page=job_student&Page_data=$Next_Page&s_coop=$_GET[s_coop]&s_position=$_GET[s_position]&s_type=$_GET[s_type]&s_s=$_GET[s_ss]'>Next>></a> ";
} ?>
<?php

?>
    </div></div>

<?php
}else if($_POST['status'] == 'c'){ ?>
  <div class="panel panel-default">
    <div class="panel-heading"><h1>ข้อมูลการจองตำแหน่งงานของนักศึกษา</h1></div>
    <div class="panel-body">
      <form action="" method="post">
      <div class="form-group row">
        <div class="col-md-2 ">
          <?php
          if($_POST['s'] != ""){
            $s = " AND a.student_name LIKE '%".$_POST['s']."%'  ";
          }
          ?>
          <label for="">ค้นหานักศึกษา</label>
          <input type="hidden" name="id" value="<?php echo $_POST['id']; ?>">
          <input type="hidden" name="status" value="<?php echo $_POST['status']; ?>">
          <input type="text" name="s" value="<?php echo $_POST['s']; ?>" class="form-control" placeholder="ชื่อนักศึกษา">
        </div>
        <div class="col-md-2 ">
          <label for="">ค้นหานักศึกษา</label><br>
          <input type="submit" value="ค้นหา" class="btn btn-success" >
        </div>
      </div>
    </form>
  <table class="table">
  <tr>
    <td>ลำดับ</td>
    <td>รหัสนักศึกษา</td>
    <td>ชื่อนักศึกษา</td>
    <td>สาขา</td>
    <td>จำนวนการจองตำแหน่งงงาน</td>
    <td>ข้อมูล</td>

  </tr>
  <?php
  $sql = "SELECT * FROM tb_student a ,  tb_course b WHERE a.course_key = '".$_POST['id']."' AND b.course_key = '".$_POST['id']."' AND a.student_status = '2'  $s";
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
  $i = 1;
  while($fet = mysql_fetch_array($objQuery)){
  $sql1 = mysql_query("SELECT count(student_keyf) as num FROM  tb_reply_s WHERE student_keyf =  '".$fet['student_key']."' ");
  $fet1 = mysql_fetch_array($sql1);
  $sql2 = mysql_query("SELECT * FROM  tb_reply_s WHERE student_keyf =  '".$fet['student_key']."' ");
  $fet2 = mysql_fetch_array($sql2);
  ?>
  <tr>
    <td><?php echo  (($Page-1)*10)+$i ; ?></td>
    <td><?php echo $fet['student_code']; ?></td>
    <td><?php echo $fet['student_name']." ".$fet['student_last']; ?></td>
    <td><?php echo $fet['course_name']; ?></td>
    <td><?php echo $fet1['num']; ?></td>
    <td><button class="btn btn-success" id="id_student" value="<?php echo $fet2['coop_keyf']; ?>">ดูข้อมูล</button></td>

  </tr>
  <?php } ?>

  </table>
  Total <?php $Num_Rows;?> Record : <?=$Num_Pages;?> Page :
  <?php
  if($Prev_Page)
  {
  echo " <a href='$_SERVER[SCRIPT_NAME]?page=job_student&Page_data=$Prev_Page&s_coop=$_GET[s_coop]&s_position=$_GET[s_position]&s_type=$_GET[s_type]&s_s=$_GET[s_ss]'><< Back</a> ";
  }
  for($i=1; $i<=$Num_Pages; $i++){
  if($i != $Page)
  {
  echo " <a href='$_SERVER[SCRIPT_NAME]?page=job_student&Page_data=$i&s_coop=$_GET[s_coop]&s_position=$_GET[s_position]&s_type=$_GET[s_type]&s_s=$_GET[s_ss]'><button class='btn btn-detail'>$i</button></a> ";
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
  echo " <a href ='$_SERVER[SCRIPT_NAME]?page=job_student&Page_data=$Next_Page&s_coop=$_GET[s_coop]&s_position=$_GET[s_position]&s_type=$_GET[s_type]&s_s=$_GET[s_ss]'>Next>></a> ";
  } ?>
  <?php

  ?>
    </div></div>


<?php
}
 ?>

 <script type="text/javascript">
   $("[id^=id_student]").click(function(){
     var id = $(this).val();
     $.post('include/teacher/job_studentreply.php',{
        id : id
     },function(data){
      $("#show_data").html(data);
     });
   });

   $("#turn").click(function(){
     $("#show_data").load('include/teacher/data_jobconsultantr.php');
   });
 </script>
