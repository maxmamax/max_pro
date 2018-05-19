<?php include("connect.php"); ?>
<br><br>
<p style="font-size:15px;">
<b>คุณกำลังยุที่ :</b>  ดาวน์โหลด
</p>


<div class="alert alert-success alert-dismissible" style="margin-top:20px;font-size:20px;">
  <p style="color:#26519e;"><strong>ดาวโหลด !</strong> แบบฟอร์มและเอกสาร</p>
</div>

<div>
  <table width="650" border="0" class="table" style="font-size:20px;">
                <tbody>
<?php
$sql = mysql_query("SELECT * FROM  tb_dowload WHERE dowload_status = '1' ORDER BY dowload_que ASC ");
$i = 1 ;
while($fet = mysql_fetch_array($sql) ) {
?>
                  <tr>
                  <td width="7%"><?php echo $i.'.'; ?></td>
                  <td width="72%"><?php echo $fet['dowload_topic']; ?></td>
                  <td width="21%">[ <a href="<?php echo 'admin/'.$fet['dowload_part']; ?>">Download</a> ]</td>
                  </tr>
<?php
$i++ ; }
?>
              </tbody></table>
              <br><br>
          <div style="font-size:20px;">
          แหล่งที่มา : <a href="http://www.mua.go.th/users/bphe/cooperative/" target="new">โครงการสหกิจศึกษา</a>
          ( <a href="http://www.mua.go.th/users/bphe/bs/" target="new">สำนักประสานและส่งเสริมกิจการอุดมศึกษา</a>)
        </div>
</div>
