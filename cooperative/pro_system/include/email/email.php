<?php
	date_default_timezone_set("Asia/Bangkok");
?>
<?PHP
function sentEmail($username,$password,$security,$email){
require("PHPMailer_v5.0.2/class.phpmailer.php");
$mail = new PHPMailer();
//$username = 'maxmamax';
//$password = 'maxmamax123';
//$security = 'HUWEFIWU';
$body = "<center><img src='https://upload.wikimedia.org/wikipedia/th/thumb/6/6d/Kru.png/493px-Kru.png' width='50px' height='50px'></center><br><hr><br>ข้อมูลการสมัครสมาชิกการเข้าสู่ระบบงานสหกิจศึกษา มหาวิทยาลัยราชภัฏกาญจนบุรี<br>ชื่อผู้ใช้ : $username <br>รหัสผ่าน : $password <br>รหัสยืนยันการเข้าใช้งาน : $security";

$mail->CharSet = "utf-8";
$mail->IsSMTP();
$mail->SMTPDebug = 0;
$mail->SMTPAuth = true;
$mail->Host = "ssl://smtp.gmail.com"; // SMTP server
$mail->Port = 465; // พอร์ท
$mail->Username = "cooperative.kru@gmail.com"; // account SMTP
$mail->Password = "cooperativekru_1234"; // รหัสผ่าน SMTP

$mail->SetFrom("cooperative.kru@gmail.com", "ผู้ส่ง");
//$mail->AddReplyTo("pesentvido@gmail.com", "ผู้รับ");
$mail->Subject = "PHPMailer.";

$mail->MsgHTML($body);

$mail->AddAddress($email, "ผู้รับ"); // ผู้รับคนที่หนึ่ง
///$mail->AddAddress("recipient2@somedomain.com", "recipient2"); // ผู้รับคนที่สอง

if(!$mail->Send()) {
  $i = "Mailer Error: " . $mail->ErrorInfo;
} else {
  $i =  "Message sent!";
}
return $i;
}

//$i = sentEmail("ทดสอบการส่ง","รหัสผ่าน","รหัสยืนยันที่2","max_thanakon@hotmail.com");

//echo $i;
?>
