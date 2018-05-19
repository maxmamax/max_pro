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

              <div class="alert alert-success alert-dismissible" style="margin-top:20px;font-size:20px;">
                <p style="color:#26519e;"><strong>แบบฟอร์ม </strong> สำหรับนักศึกษา</p>
              </div>
                <table width="650" border="0" class="table" style="font-size:20px;">
                  <tbody>
                    <tr>
                    <td width="7%">1.</td>
                    <td width="72%">ตัวอย่างรายงานการปฏิบัติงานสหกิจศึกษา</td>
                    <td width="21%">[ <a href="https://drive.google.com/open?id=1hF-fLoGUTxmj6wMWr_fDizOXnxPajwA5" target="_blank">Download</a> ]</td>
                    </tr>
                    <tr>
                    <td width="7%">2.</td>
                    <td width="72%">แบบแจ้งโครงร่างรายงานการปฏิบัติงานสหกิจศึกษา</td>
                    <td width="21%">[ <a href="https://drive.google.com/open?id=1lhxw0lIsPlFhz9UNJfnUb6Zqgjpe7Irn" target="_blank">Download</a> ]</td>
                    </tr>
                    <tr>
                    <td width="7%">3.</td>
                    <td width="72%">แบบแจ้งแผนปฏิบัติงานสหกิจศึกษา</td>
                    <td width="21%">[ <a href="https://drive.google.com/open?id=1v_lbh8LBTLtn2RvjltD-NOKMUL-IrjiE" target="_blank">Download</a> ]</td>
                    </tr>
                    <tr>
                    <td width="7%">4.</td>
                    <td width="72%">แบบแจ้งรายละเอียดการเข้าร่วมโครงการสหกิจศึกษา</td>
                    <td width="21%">[ <a href="https://drive.google.com/open?id=10NYkESNDP-Tw6PwZnrlOpCmck9FjBmDM" target="_blank">Download</a> ]</td>
                    </tr>
                    <tr>
                    <td width="7%">5.</td>
                    <td width="72%">แบบแจ้งรายละเอียดเกี่ยวกับการปฏิบัติงานสหกิจศึกษา</td>
                    <td width="21%">[ <a href="https://drive.google.com/open?id=1PlT8KA5kqGwediiA7m5HWV0ohyT6aLVn" target="_blank">Download</a> ]</td>
                    </tr>
                    <tr>
                    <td width="7%">6.</td>
                    <td width="72%">แบบแจ้งรายละเอียดที่พักระหว่างการปฏิบัติงานสหกิจศึกษา</td>
                    <td width="21%">[ <a href="https://drive.google.com/open?id=11REI8rpGW5tuyCY15J7_LRO5QhHNZoKX" target="_blank">Download</a> ]</td>
                  </tr>
                  <tr>
                  <td width="7%">7.</td>
                  <td width="72%">แบบบันทึกการปฏิบัติงานประจำวัน</td>
                  <td width="21%">[ <a href="https://drive.google.com/open?id=1vdWTfBnxdDv8xEOA4ZNxlsGHK3rfYhPD" target="_blank">Download</a> ]</td>
                </tr>
                <tr>
                <td width="7%">8.</td>
                <td width="72%">แบบยืนยันส่งรายงานการปฏิบัติงาน</td>
                <td width="21%">[ <a href="https://drive.google.com/open?id=1sp5bZcGpApIxmoIBRsxGEgfiLPjHfL41" target="_blank">Download</a> ]</td>
              </tr>
              <tr>
              <td width="7%">9.</td>
              <td width="72%">ใบสมัครงานสหกิจศึกษา</td>
              <td width="21%">[ <a href="https://drive.google.com/open?id=1RDjwzKH3xM1i9aQdBFciDAO4JPYt-w9c" target="_blank">Download</a> ]</td>
            </tr>
            <tr>
            <td width="7%">10.</td>
            <td width="72%">หนังสือสัญญาการเข้ารับการฝึกปฏิบัติงานของนักศึกษา</td>
            <td width="21%">[ <a href="https://drive.google.com/open?id=1Yj255Tu09DQ-B8BkWXyyn2QHoqA28aNW" target="_blank">Download</a> ]</td>
          </tr>
                </tbody>
              </table>



              <div class="alert alert-success alert-dismissible" style="margin-top:20px;font-size:20px;">
                <p style="color:#26519e;"><strong>แบบฟอร์ม </strong> สำหรับอาจารย์</p>
              </div>
                <table width="650" border="0" class="table" style="font-size:20px;">
                  <tbody>
                    <tr>
                    <td width="7%">1.</td>
                    <td width="72%">แบบแจ้งยืนยันการนิเทศงานนักศึกษาสหกิจศึกษา</td>
                    <td width="21%">[ <a href="https://drive.google.com/open?id=1qDl2P_biLv5H0IeOW21-_YZSeNdkSvgu" target="_blank">Download</a> ]</td>
                    </tr>
                    <tr>
                    <td width="7%">2.</td>
                    <td width="72%">แบบบันทึกการนิเทศงานสหกิจศึกษา</td>
                    <td width="21%">[ <a href="https://drive.google.com/open?id=1HkIyDlVG-_Og4KhII5OrRv6fllM_KdYb" target="_blank">Download</a> ]</td>
                    </tr>
                </tbody>
              </table>

              <div class="alert alert-success alert-dismissible" style="margin-top:20px;font-size:20px;">
                <p style="color:#26519e;"><strong>แบบฟอร์ม </strong> สำหรับสถานประกอบการ</p>
              </div>
                <table width="650" border="0" class="table" style="font-size:20px;">
                  <tbody>
                    <tr>
                    <td width="7%">1.</td>
                    <td width="72%">ตัวอย่างแบบขอความอนุเคราะห์สถานประกอบการ</td>
                    <td width="21%">[ <a href="https://drive.google.com/open?id=199Ib2Ll_bFE3tlVtRVjj-W6U1S54nrEA" target="_blank">Download</a> ]</td>
                    </tr>
                    <tr>
                    <td width="7%">2.</td>
                    <td width="72%">แบบคำร้องทั่วไป</td>
                    <td width="21%">[ <a href="https://drive.google.com/open?id=1LNJqFzsEZgGX4g9N4weUm33d37Dc2Mss" target="_blank">Download</a> ]</td>
                    </tr>
                    <td width="7%">2.</td>
                    <td width="72%">แบบแจ้งรายละเอียดงาน ตำแหน่งงาน พนักงานที่ปรึกษา</td>
                    <td width="21%">[ <a href="https://drive.google.com/open?id=1OMwgcgUxwkrZhWDyiyMJ20ABM-bLHASk" target="_blank">Download</a> ]</td>
                    </tr>
                  <tr>
                  <td width="7%">3.</td>
                  <td width="72%">แบบประเมินผลนักศึกษาสหกิจศึกษา</td>
                  <td width="21%">[ <a href="https://drive.google.com/open?id=1DJ9rVy3sOxbvsf736Hsa0KaLOsl79hvm" target="_blank">Download</a> ]</td>
                  </tr>
                  <tr>
                  <td width="7%">4.</td>
                  <td width="72%">แบบประเมินผลรายงานฉบับสมบูรณ์</td>
                  <td width="21%">[ <a href="https://drive.google.com/open?id=1Oa6zOX1iDczoIihseZ3cVOy500GHoMSN" target="_blank">Download</a> ]</td>
                  </tr>
                  <tr>
                  <td width="7%">5.</td>
                  <td width="72%">แบบเสนองาน</td>
                  <td width="21%">[ <a href="https://drive.google.com/open?id=1qanf49wHUvWCN0k4BWzTdShzuyKPIflA" target="_blank">Download</a> ]</td>
                  </tr>
                </tbody>
              </table>
              <br><br>
          <div style="font-size:20px;">
          แหล่งที่มา : <a href="http://www.mua.go.th/users/bphe/cooperative/" target="new">โครงการสหกิจศึกษา</a>
          ( <a href="http://www.mua.go.th/users/bphe/bs/" target="new">สำนักประสานและส่งเสริมกิจการอุดมศึกษา</a>)
        </div>


</div>
