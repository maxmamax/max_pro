<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
<meta name="twitter:" content="" charset="utf-8">
<link href="https://fonts.googleapis.com/css?family=Mitr" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
<link rel="stylesheet" href="css/sweetalert.css" >
<script src="js/sweetalert.min.js"></script>
<script src="js/sweetalert-dev.js"></script>
<script src="js/jquery.js"></script>

<style media="screen">
body {
    font-family: 'Mitr', sans-serif;
}
select{
    font-family: 'Mitr', sans-serif;
}
button{
    font-family: 'Mitr', sans-serif;
}
input{
    font-family: 'Mitr', sans-serif;
  }
textarea{
    font-family: 'Mitr', sans-serif;
}
</style>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
      <a class="navbar-brand" href="#"><h3>ระบบบริหารการจัดการข้อมูลระบบงานสหกิจศึกษา KRU</h3></a>
<?php if($_SESSION['session_key'] != ""){ ?>

      <a href="process/logout.php"><button type="button" name="button" class="btn btn-danger">ออกจากระบบ</button></a>
<?php } ?>
    </nav>
<?php if($_SESSION['session_key'] != "") { ?>
    <div class="container-fluid" style="margin-top:100px;">
<div class="col-md-12">
  <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>
<a class="navbar-brand" href="#">การจัดการ</a>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
  <ul class="navbar-nav">
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        สิทธิของผู้ใช้
      </a>
      <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
        <a class="dropdown-item" href="index.php?page=status_student">นักศึกษา</a>
        <a class="dropdown-item" href="index.php?page=status_teacher">อาจารย์</a>
        <a class="dropdown-item" href="index.php?page=status_staff">พนักงาน</a>
        <a class="dropdown-item" href="index.php?page=status_cooperative">สถานประกอบการ</a>
        <a class="dropdown-item" href="index.php?page=status_consultants">การเข้าถึงข้อมูลของนักศึกษา</a>

      </div>
    </li>
     <li class="nav-item dropdown">
       <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         ตำแหน่งงาน
       </a>
       <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
         <a class="dropdown-item" href="index.php?page=data_position">ข้อมูลตำแหน่งงาน</a>
         <a class="dropdown-item" href="index.php?page=data_positionexpired">การลบข้อมูลตำแหน่งงาน</a>
         <a class="dropdown-item" href="index.php?page=data_type">ประเภทงาน</a>
       </div>
     </li>
     <li class="nav-item dropdown">
       <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         ข่าวประชาสัมพันธ์
       </a>
       <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
         <a class="dropdown-item" href="index.php?page=newsone">ข่าวประชาสัมพันธ์ </a>
         <a class="dropdown-item" href="index.php?page=newstwo">ข่าวประชาสัมพันธ์ ย่อย</a>
         <a class="dropdown-item" href="index.php?page=dowload">ดาวน์โหลด</a>
       </div>
     </li>
   </ul>
</div>
</nav>
</div>
<div class="col-md-12"> <br>
<?php
if($_GET['page'] != ""){
   include("layout/".$_GET['page'].".php");
}
?>
</div>
<div class="show_data" style="margin-top:20px;" class="row">
</div>
</div>
<?php }else{ ?>
<div align="center">
  <div class="card card-container col-md-3" style="margin-top:130px;">
              <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
              <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png">
              <p id="profile-name" class="profile-name-card"></p>
              <form class="form-signin" action="process/login.php" method="post">
                  <span id="reauth-email" class="reauth-email"></span>
                  <input type="text"  class="form-control" placeholder="ชื่อผู้ใช้" required="" autofocus="" name="user">
                  <input type="password"  class="form-control" placeholder="รหัสผ่าน" required="" name="pass">
                  <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">เข้าสู่ระบบ</button>
              </form>
          </div>
</div>
<?php } ?>
</body>
</html>
