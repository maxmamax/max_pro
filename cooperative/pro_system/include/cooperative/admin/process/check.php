<?php
$info = end( explode( '.' , $_POST['data'] ) ) ;
if($_POST['status'] != 1){
if($info == 'jpg' || $info == 'jpeg' || $info == 'JPG' || $info == 'JPEG' || $info == 'png' || $info == 'PNG'){
  echo 'ชนิดไฟล์ถูกต้อง';
}else{
  echo "ชนิดไฟล์ไม่ถูกต้อง";
}
}else{
  if($info == 'jpg' || $info == 'jpeg' || $info == 'JPG' || $info == 'JPEG' || $info == 'png' || $info == 'PNG' || $info == 'DOC' || $info == 'doc' || $info == 'PDF' || $info == 'pdf' || $info == 'DOCX' || $info == 'docx'){
    echo 'ชนิดไฟล์ถูกต้อง';
  }else{
    echo "ชนิดไฟล์ไม่ถูกต้อง";
  }
}
 ?>
