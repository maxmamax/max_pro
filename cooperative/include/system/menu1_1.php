<?php include("connect.php"); ?>
<?php
$sql = mysql_query("SELECT * FROM  tb_newstwo WHERE newstwo_key = '".$_POST['key']."' ");
$fet = mysql_fetch_array($sql);
 ?>


<div class="panel panel-default outer" style="width:95%">
  <div class="panel-heading headerbar" >
    <h3 class="text-center"><h4><span>รายละเอียด <strong style="color:black;">News  <?php echo "(".$fet['newtwo_topic']. ")"; ?></strong></span></h4></h3>
  </div>
<section class="banner-sec">
        <div class="container">

    <div class="row">
            <div class="col-md-12 top-slider">
              <div class="" align="center">
                <img width="500px" heigth="500px" src="admin\<?php echo $fet['newtwo_part']; ?>" alt="">
                <br><br>
              </div>
<?php echo $fet['newtwo_sup']; ?>
      </div>
          </div>
  </div>
      </section>
</div>
