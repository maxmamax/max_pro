<?php include("include/connect.php"); session_start(); date_default_timezone_set("Asia/Bangkok"); ?>
<div class="col-md-12">
  <div class="col-md-7">
<?php
if($_GET['page'] == "show_interview"){
  include("show_interview.php");
}else if($_GET['page'] == "show_practice"){
  include("show_practice.php");
}else{
include("detail_position.php");
}
?>
</div>
  <div class="col-md-5 " >
      <div class="panel panel-default">
  <div class="panel-body">
  <ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#menu1" ><h5 class="f2"><span class="glyphicon glyphicon-list" aria-hidden="true"></span>  ประกาศการนัดสัมภาษณ์งาน</h5></a></li>
  <li><a data-toggle="tab" href="#menu2"><h5 class="f2"><span class="glyphicon glyphicon-list" aria-hidden="true"></span>  ประกาศการผ่านสัมภาษณ์งาน</h5></a></li>
  </ul>
  <div class="tab-content" style="margin-top:25px;">
    <div id="home" class="tab-pane fade in active">
      <div class="col-md-12" >
        <?php
         include("detail_interview.php");
         ?>
      </div>
    </div>
    <div id="menu1" class="tab-pane fade">
        <?php include("detail_interview.php"); ?>
    </div>
    <div id="menu2" class="tab-pane fade">
    <?php include("detail_practice.php"); ?>
    </div>
  </div>
  </div>
</div>
  </div>
</div>
