<?php include("connect.php"); ?>
<?php
if($_POST['status'] == 'len'){
$data = strlen($_POST['text']);
if($data < 8 || $data > 16 ){
  echo "1";
}else if($_POST['s'] != ''){
  $s = "S_".$_POST['text'];
  $t = "T_".$_POST['text'];
  $p = "P_".$_POST['text'];
  $c = "C_".$_POST['text'];
 if($_POST['s'] == 's'){
   $sql = mysql_query("SELECT * FROM tb_student  WHERE student_user = '$s' ");
 }else if($_POST['s'] == 't'){
   $sql = mysql_query("SELECT * FROM tb_teacher  WHERE teacher_user = '$t' ");
 }else if($_POST['s'] == 'c'){
   $sql = mysql_query("SELECT * FROM tb_cooperative  WHERE coop_user = '$c' ");
 }else if($_POST['s'] == 'p'){
   $sql = mysql_query("SELECT * FROM tb_staff  WHERE staff_user = '$p' ");
 }
  $fet = mysql_fetch_array($sql);
  if($fet){
    echo '2';
  }
}
}

if($_POST['status'] == 'up'){
$a = strrchr($_POST['text'],".");
if($a == '.png' || $a == '.jpg' || $a == '.PNG' || $a == '.JPG' ){
}else{
  echo "<font style='color:red'><img src='img/validate.gif' width='20' heigth='20'>กรุณาเลืกไฟล์  jpg , png </font>";

}
}

if($_POST['status'] == 'email'){

$a = strrchr($_POST['text'],"@");
if($a == '@kru.ac.th' && strlen($_POST['text']) > 10  ){
  $sql = mysql_query("SELECT * FROM tb_student a , tb_teacher b , tb_staff c  WHERE a.student_email = '".$_POST['text']."' OR b.teacher_email = '".$_POST['text']."' OR c.staff_email = '".$_POST['text']."' ");
  $fet = mysql_fetch_array($sql);
  if($fet){
    echo "เข้า";
  echo "<font style='color:red'><img src='img/validate.gif' width='20' heigth='20'>อีเมลนี้มีอยู่ในระบบแล้ว</font>";
}
}else{
  echo "<font style='color:red'><img src='img/validate.gif' width='20' heigth='20'>กรุณาใช้อีเมล @kru.ac.th</font>";
}
}

if($_POST['status'] == 'emailcoop'){
$a = strrchr($_POST['text'],"@");
if($a == '@hotmail.com'){
  $num = '12';
}else if($a == '@gmail.com'){
  $num = '10';
}
if( ($a == '@hotmail.com' || $a == '@gmail.com') &&  strlen($_POST['text']) > $num  ){
  $sql = mysql_query("SELECT * FROM tb_cooperative  WHERE coop_email = '".$_POST['text']."' ");
  $fet = mysql_fetch_array($sql);
  if($fet){
  echo "<font style='color:red'><img src='img/validate.gif' width='20' heigth='20'>อีเมลนี้มีอยู่ในระบบแล้ว</font>";
  }
}else{

  echo "<font style='color:red'><img src='img/validate.gif' width='20' heigth='20'>กรุณาใช้อีเมล @hotmail , @gmail </font>";
}
}
?>
