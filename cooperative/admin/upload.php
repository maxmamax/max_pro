<?php
$file=$_FILES['pix'];
$place2place="fileupload"; //ระบุตำแหน่งที่เก็บไฟล์
$a = $_FILES['pix']['tmp_name'];
echo "ชื่อของไฟล์ คือ ".$_FILES['pix']['name']."<br>";
echo "ขนาดของไฟล์ คือ ".$_FILES['pix']['size']."<br>";
echo "เนื้อหาของไฟล์ คือ ".$_FILES['pix']['tmp_name']."<br>";
echo "ชนิดของไฟล์ คือ ".$_FILES['pix']['type']."<br><br>";


copy('C:\\fakepath\\Untitled.mpg.sfl55','666.jpg');
?>
