<?php include("include/connect.php"); session_start(); ?>

<?php
if($_POST['date_supervision'] != "" && $_POST['list_supervision'] != "" && $_POST['key_student'] != "" && $_POST['key_position'] != "" ){
$sql = mysql_query("SELECT count(supervision_key) as num FROM tb_supervision WHERE student_keyf  = '".$_POST['key_student']."' AND position_key = '".$_POST['key_position']."'  AND teacher_keyf = '".$_SESSION['session_key']."' ");
$fet = mysql_fetch_array($sql);
if($fet['num'] == '0'){
$sql = mysql_query("INSERT INTO tb_supervision VALUES ('','".$_POST['key_student']."','".$_SESSION['session_key']."','".$_POST['key_position']."','".$_POST['date_supervision']."','".$_POST['list_supervision']."' ) " );
}else{
$sql = mysql_query("UPDATE tb_supervision SET
supervision_date = '".$_POST['date_supervision']."',
supervision_list = '".$_POST['list_supervision']."' WHERE student_keyf  = '".$_POST['key_student']."' AND position_key = '".$_POST['key_position']."'  AND teacher_keyf = '".$_SESSION['session_key']."'
");
}

}


if($_POST['status'] == 'f'){   ?>
  <div class="panel panel-default">
    <div class="panel-heading"><h1><font>บันทึกข้อมูลการนิเทศนักศึกษา</font></h1></div>
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
<?php if($_POST['key_student'] != "" && $_POST['key_position'] !=""){
$sql = mysql_query("SELECT student_name,student_last,position_name FROM tb_student a,tb_position b WHERE a.student_key = '".$_POST['key_student']."' AND b.position_key = '".$_POST['key_position']."'  ");
$fet = mysql_fetch_array($sql);
$sql1 = mysql_query("SELECT supervision_date,supervision_list FROM tb_supervision WHERE student_keyf  = '".$_POST['key_student']."' AND position_keyf = '".$_POST['key_position']."'  AND teacher_keyf = '".$_SESSION['session_key']."' ");
$fet1 = mysql_fetch_array($sql1);
?>
    <table class="table table-bordered">
      <tr>
        <td >ชื่อนักศึกษา</td>
        <td >
          <div class="col-md-3">
            <input readonly type="text"  class="form-control"  value="<?php echo $fet['student_name']." ".$fet['student_last']; ?>">
          </div>
        </td>
      </tr>
      <tr>
        <td>ตำแหน่งงาน</td>
        <td>
          <div class="col-md-3">
            <input readonly type="text"  class="form-control" value="<?php echo $fet['position_name']; ?>">
          </div>
        </td>
      </tr>
      <tr>
        <td>รายละเอียดการนิเทศ</td>
        <td>
          <div class="form-group row">
            <form  action="" method="post" id="form_supervision">
            <div class="col-md-3">
              <label for="">วันที่</label>
              <input type="date"  class="form-control" name="date_supervision" value="<?php echo $fet1['supervision_date']; ?>">
            </div>
            <div class="col-md-3">
              <label for="">รายการนิเทศ</label>
              <input type="text"  class="form-control" name="list_supervision"  value="<?php echo $fet1['supervision_list']; ?>">
            </div> <br>
            <input type="hidden" name="id" value="<?php echo $_POST['id']?>">
            <input type="hidden" name="status" value="<?php echo $_POST['status']?>">
            <input type="hidden" name="key_student" value="<?php echo $_POST['key_student']?>">
            <input type="hidden" name="key_position" value="<?php echo $_POST['key_position']?>">
            <button type="button" name="button" class="btn btn-success" id="save_supervision">บันทึก</button>
          </form>
          </div>

        </td>
      </tr>
    </table>
<?php

} ?>

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
$sql = "SELECT * FROM tb_student a , tb_record b , tb_position c  WHERE a.student_key = b.student_keyf AND b.position_keyf = c.position_key  AND a.faculty_keyf = '".$_POST['id']."' $s GROUP BY b.student_keyf";
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

      <form action="" method="post">
        <input type="hidden" name="id" value="<?php echo $_POST['id']; ?>">
        <input type="hidden" name="status" value="<?php echo $_POST['status']; ?>">
        <input type="hidden" name="key_student" value="<?php echo $fet['student_key']; ?>">
        <input type="hidden" name="key_position" value="<?php echo $fet['position_key']; ?>">
        <button type="submit" name="button" class="btn btn-success">บันทึกข้อมูลการนิเทศ</button>
      </form>

<?php
$sql3 = mysql_query("SELECT count(supervision_key) as num FROM tb_supervision WHERE student_keyf = '".$fet['student_key']."' AND position_keyf = '".$fet['position_key']."' ");
$fet3 = mysql_fetch_array($sql3);
if($fet3['num'] > '0'){ ?>
    <form class="" action="include/report5/report_student.php" method="post" target="_blank">
    <input type="hidden" name="id" value="<?php echo $_POST['id']; ?>">
    <input type="hidden" name="status" value="<?php echo $_POST['status']; ?>">
    <input type="hidden" name="key_student" value="<?php echo $fet['student_key']; ?>">
    <input type="hidden" name="key_position" value="<?php echo $fet['position_key']; ?>">
    <button type="submit" name="button" class="btn btn-danger">พิมพ์ใบรายงานการนิเทศ</button>
  </form>
<?php
}
?>
    </td>
  </tr>
<?php $i++;  }  ?>

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

    </div></div>

<?php
}else if($_POST['status'] == 'c'){ ?>
  <div class="panel panel-default">
    <div class="panel-heading"><h1><font>บันทึกข้อมูลการนิเทศนักศึกษา</font></h1></div>
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
  <?php if($_POST['key_student'] != "" && $_POST['key_position'] !=""){
  $sql = mysql_query("SELECT student_name,student_last,position_name FROM tb_student a,tb_position b WHERE a.student_key = '".$_POST['key_student']."' AND b.position_key = '".$_POST['key_position']."' a.course_key = '".$_POST['id']."' ");
  $fet = mysql_fetch_array($sql);
  $sql1 = mysql_query("SELECT supervision_date,supervision_list FROM tb_supervision WHERE student_keyf  = '".$_POST['key_student']."' AND position_key = '".$_POST['key_position']."'  AND teacher_keyf = '".$_SESSION['session_key']."' ");
  $fet1 = mysql_fetch_array($sql1);
  ?>
    <table class="table table-bordered">
      <tr>
        <td >ชื่อนักศึกษา</td>
        <td >
          <div class="col-md-3">
            <input readonly type="text"  class="form-control"  value="<?php echo $fet['student_name']." ".$fet['student_last']; ?>">
          </div>
        </td>
      </tr>
      <tr>
        <td>ตำแหน่งงาน</td>
        <td>
          <div class="col-md-3">
            <input readonly type="text"  class="form-control" value="<?php echo $fet['position_name']; ?>">
          </div>
        </td>
      </tr>
      <tr>
        <td>รายละเอียดการนิเทศ</td>
        <td>
          <div class="form-group row">
            <form  action="" method="post" id="form_supervision">
            <div class="col-md-3">
              <label for="">วันที่</label>
              <input type="date"  class="form-control" name="date_supervision" value="<?php echo $fet1['supervision_date']; ?>">
            </div>
            <div class="col-md-3">
              <label for="">รายการนิเทศ</label>
              <input type="text"  class="form-control" name="list_supervision"  value="<?php echo $fet1['supervision_list']; ?>">
            </div> <br>
            <input type="hidden" name="id" value="<?php echo $_POST['id']?>">
            <input type="hidden" name="status" value="<?php echo $_POST['status']?>">
            <input type="hidden" name="key_student" value="<?php echo $_POST['key_student']?>">
            <input type="hidden" name="key_position" value="<?php echo $_POST['key_position']?>">
            <button type="button" name="button" class="btn btn-success" id="save_supervision">บันทึก</button>
          </form>
          </div>

        </td>
      </tr>
    </table>
  <?php

  } ?>

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
  $sql = "SELECT * FROM tb_student a , tb_record b , tb_position c  WHERE a.student_key = b.student_keyf AND b.position_keyf = c.position_key AND a.course_key = '".$_POST['id']."' $s GROUP BY b.student_keyf";
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

      <form action="" method="post">
        <input type="hidden" name="id" value="<?php echo $_POST['id']; ?>">
        <input type="hidden" name="status" value="<?php echo $_POST['status']; ?>">
        <input type="hidden" name="key_student" value="<?php echo $fet['student_key']; ?>">
        <input type="hidden" name="key_position" value="<?php echo $fet['position_key']; ?>">
        <button type="submit" name="button" class="btn btn-success">บันทึกข้อมูลการนิเทศ</button>
      </form>

  <?php
  $sql3 = mysql_query("SELECT count(supervision_key) as num FROM tb_supervision WHERE student_keyf = '".$fet['student_key']."' AND position_keyf = '".$fet['position_key']."' ");
  $fet3 = mysql_fetch_array($sql3);
  if($fet3['num'] > '0'){ ?>
    <form class="" action="include/report5/report_student.php" method="post" target="_blank">
    <input type="hidden" name="id" value="<?php echo $_POST['id']; ?>">
    <input type="hidden" name="status" value="<?php echo $_POST['status']; ?>">
    <input type="hidden" name="key_student" value="<?php echo $fet['student_key']; ?>">
    <input type="hidden" name="key_position" value="<?php echo $fet['position_key']; ?>">
    <button type="submit" name="button" class="btn btn-danger">พิมพ์ใบรายงานการนิเทศ</button>
  </form>
  <?php
  }
  ?>
    </td>
  </tr>
  <?php $i++;  }  ?>

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
}
 ?>
 <script type="text/javascript">
  $("#save_supervision").click(function(){
    var r = confirm("ยืนยันการบันทึกข้อมูลการนิเทศ");
    if (r == true) {
      $('#form_supervision').submit();
    }
  });


 </script>
