<?php  session_start(); session_destroy(); ?>
<?php
$_SESSION['user_session'] = '';
header("location: ../index.php");
 ?>
