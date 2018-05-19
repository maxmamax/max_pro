<?php
$emailto='content_us@hotmail.com'; //อีเมล์ผู้รับ
$subject='$header'; //หัวข้อ
$header.= "Content-type: text/html; charset=windows-874\n";
$header.="from: ".$name."E-mail :".$mail; //ชื่อและอีเมลผู้ส่ง
$messages.= "<b>$text</br>"; //ข้อความ
$messages.= "จาก $sender<br>";//ข้อความ
mail($emailto,$subject,$messages,$header);
if(!$send_mail)
{
echo"ยังไม่สามารถส่งเมลล์ได้ในขณะนี้";
}
else
{
echo "ส่งเมลล์สำเร็จ";
}
?>
