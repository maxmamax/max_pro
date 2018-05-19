<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/png" href="img/kru.png" />
   <link href="https://fonts.googleapis.com/css?family=Taviraj" rel="stylesheet">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   <script src='https://www.google.com/recaptcha/api.js?hl=th'></script>
   <script type="text/javascript" src="dist/js/bootstrap.min.js"></script>
   <script type="text/javascript" src="ckeditor/ckeditor.js"></script>
   <link href="dist/css/bootstrap.css" rel="stylesheet">



<!--
<script src='https://www.google.com/recaptcha/api.js?hl=th'></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<link href="https://fonts.googleapis.com/css?family=Mitr" rel="stylesheet">
-->

    <title>ระบบงานสหกิจตศึกษา || มหาวิทยาลัยราชภัฏกาญจนบุรี</title>

    <style media="screen">
    body{
      font-family: 'Taviraj', serif;
      font-weight:bold;
    }
    h1{
      font-family: 'Taviraj', serif;
      font-weight:bold;
    }
    h3{
      font-family: 'Taviraj', serif;
      font-weight:bold;
    }
    h4{
      font-family: 'Taviraj', serif;
      font-weight:bold;
    }
    h5{
      font-family: 'Taviraj', serif;
      font-weight:bold;
    }
    a{
      font-family: 'Taviraj', serif;
    }
    font{
        font-family: 'Taviraj', serif;

    }
    thead{
    background-color:#ffcfa8;
    padding: 3px;
      border-width: 1px;
      border-style: solid;
      border-color: #f79646 #ccc;
    }
    tr{
    padding: 3px;
      border-width: 1px;
      border-style: solid;
      border-color: #f79646 #ccc;
    }
    .bg{
      background-color: #ffcfa8;
    }
    .f{
      font-size:25px;
    }
    .f1{
      font-size:20px;
    }
    .f2{
      font-size:15px;
    }

    </style>
  </head>
  <body>
  <?php include("include/navbar.php"); ?>
  <?php if($_GET['page'] == 'login'){
include("include/login.php");
}else if($_GET['page'] == 'register' ){
include("include/register.php");
}else if( $_GET['page'] != '' && $_SESSION['session_status_menu'] == "" ){
include("include/detail.php");
}else{
if($_SESSION['session_status_menu'] == 'student'){
$p = 'student/';
}else if($_SESSION['session_status_menu'] == 'teacher'){
$p = 'teacher/';
}else if($_SESSION['session_status_menu'] == 'staff'){
$p = 'staff/';
}else if($_SESSION['session_status_menu'] == 'cooperative'){
$p = 'cooperative/';
}
  if($_SESSION['session_status_menu'] != ""){ ?>
    <div class="container-fluide" style="margin-top:50px;">
      <div class="container">
<?php
    include('include/'.$p.$_GET['page'].".php"); ?>
  </div></div>
  <?php
  }else{
    include("include/detail.php");

  }

  } ?>


  </body>
</div>

</html>
