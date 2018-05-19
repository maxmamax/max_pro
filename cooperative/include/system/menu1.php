<?php
include ("connect.php");
mysql_query("SET NAMES UTF8");
$sql = mysql_query("SELECT * FROM tb_newsone  WHERE newsone_status	 = 1  ORDER BY newone_que  ASC ")
 ?>
<div class="panel panel-default outer" style="width:95%">
  <div class="panel-heading headerbar" >
    <h3 class="text-center"><h4><span>ข่าวประชาสัมพันธ์ <strong style="color:black;">News</strong></span></h4></h3>
  </div>
<section class="banner-sec">
        <div class="container">

    <div class="row">
            <div class="col-md-12 top-slider">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner" role="listbox">
                  <div class="bd-example" data-example-id="">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner" role="listbox">
    <?php while($fet = mysql_fetch_array($sql)) { ?>

            <div class="carousel-item">

              <img class="d-block img-fluid" data-src="holder.js/800x400?auto=yes&amp;bg=777&amp;fg=555&amp;text=First slide" alt="First slide [800x400]" src="<?php echo 'admin/'.$fet['newone_part']; ?>"     data-holder-rendered="true">
              <?php if($fet['newone_link'] != " ") { ?> </a>  <?php } ?>
              <div class="carousel-caption d-none d-md-block">
              <a target="_blank" href="<?php echo $fet['newone_link']; ?>">
   <h3><?php echo $fet['newone_topic']; ?></h3>
   <p><?php echo $fet['newone_sup']; ?></p>
              </a>
 </div>
    </div>

<?php } ?>


            <div class="carousel-item active">
              <img class="d-block img-fluid" alt="Second slide [800x400]" src="admin/2.png" data-holder-rendered="true">
              <div class="carousel-caption d-none d-md-block">
   <h3>ทดสอบ1</h3>
   <p>ลอง1</p>
 </div>
            </div>

          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
        </div>
          </div>
              </div>
      </div>
          </div>
  </div>
      </section>
</div>
<div class="row">
<?php
$sql = mysql_query("SELECT * FROM tb_newstwo WHERE newtwo_status = '1' ORDER BY newtwo_que ASC ");
while($fet = mysql_fetch_array($sql) ){
$str = iconv_substr($fet['newtwo_sup'],0,150, "UTF-8")."...";
?>
		<div class="col-lg-4 col-md-4 col-sm-6">
    		<article class="card">
				<header class="title-header">

				</header>
				<div class="card-block" align="center">
					<div class="img-card">
						<img width="200" heigth="250" src="<?php echo "admin/".$fet['newtwo_part']; ?>" >
					</div>
					<p class="tagline card-text text-xs-center"><?php echo $str.'...'; ?></p>
					<button  class="btn btn-primary btn-block" id="show_detail" value="<?php echo $fet['newstwo_key']; ?>"><i class="fa fa-eye"></i>รายละเอียดเพิ่มเติม</button>
				</div>
			</article>
		</div>
<?php } ?>

	</div>


<script type="text/javascript">

  $("[id^=show_detail]").click(function(){
  var key = $(this).val();
  $.post("include/system/menu1_1.php",{
    key : key
  },function(data){
$("#show_left").html(data)
  });
});
</script>
