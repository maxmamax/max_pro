<?php include("connect.php"); session_start(); ?>
<?php
$sub = substr($_POST['user'] , 0, 2);
if($sub == "S_" || $sub == "s_"  ){
  $sql = mysql_query("SELECT * FROM tb_student WHERE student_user = '".$_POST['user']."' AND student_pass = '".$_POST['pass']."' ");
  $fet = mysql_fetch_array($sql);
  if($fet){
    $_SESSION['session_key'] = $fet['student_key'];
    $_SESSION['session_name'] = $fet['student_name'];
    $_SESSION['session_lname'] = $fet['student_last'];
    $_SESSION['session_status_menu'] = 'student';
    $_SESSION['session_status'] = $fet['student_status'];
  }
}else if($sub == "T_"  || $sub == "t_"  ){
  $sql = mysql_query("SELECT * FROM tb_teacher WHERE teacher_user = '".$_POST['user']."' AND teacher_pass = '".$_POST['pass']."' ");
  $fet = mysql_fetch_array($sql);
  if($fet){
    $_SESSION['session_key'] = $fet['teacher_key'];
    $_SESSION['session_name'] = $fet['teacher_name'];
    $_SESSION['session_lname'] = $fet['teacher_last'];
    $_SESSION['session_status_menu'] = 'teacher';
    $_SESSION['session_status'] = $fet['teacher_status'];
  }
}else if($sub == "P_"  || $sub == "p_"  ){
  $sql = mysql_query("SELECT * FROM tb_staff WHERE staff_user = '".$_POST['user']."' AND staff_pass = '".$_POST['pass']."' ");
  $fet = mysql_fetch_array($sql);
  if($fet){
    $_SESSION['session_key'] = $fet['staff_key'];
    $_SESSION['session_name'] = $fet['staff_name'];
    $_SESSION['session_lname'] = $fet['staff_last'];
    $_SESSION['session_status_menu'] = 'staff';
    $_SESSION['session_status'] = $fet['staff_status'];
  }

}else if($sub == "C_"  || $sub == "c_"  ){
  $sql = mysql_query("SELECT * FROM tb_cooperative WHERE coop_user = '".$_POST['user']."' AND coop_pass = '".$_POST['pass']."' ");
  $fet = mysql_fetch_array($sql);
  if($fet){
    $_SESSION['session_key'] = $fet['coop_key'];
    $_SESSION['session_name'] = $fet['coop_Tname'];
    $_SESSION['session_status_menu'] = 'cooperative';
    $_SESSION['session_status'] = $fet['coop_status'];
  }
}

header("location: ../index.php?page=login");
 ?>
