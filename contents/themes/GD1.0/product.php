<!doctype html>
<html lang="en">
<head>
 <meta charset="utf-8">
 <title>公司网站</title>
 
 <!-- CSS -->
 <link rel="stylesheet" href="<?php echo get_css_url('normalize.css');?>">
 <link rel="stylesheet" href="<?php echo get_css_url('style.css');?>"> 
 <link rel="stylesheet" href="<?php echo get_css_url('nivo-slider.css');?>"> 
 <link rel="stylesheet" href="<?php echo get_css_url('validation.css');?>">   
 <!-- Jquery magic -->
 <script src="<?php echo get_js_url('jquery-1.6.4.min.js');?>"></script>
 
 <script src="<?php echo get_js_url('jquery.easing.1.3.js');?>"></script>
 <script src="<?php echo get_js_url('jquery.nivo.slider.pack.js');?>"></script> 
 <script src="<?php echo get_js_url('jquery.scrollTo-min.js');?>"></script> 
 <script src="<?php echo get_js_url('zoombox.js');?>"></script> 
 <script src="<?php echo get_js_url('validation.js');?>"></script>
 
 <script src='<?php echo get_js_url('main.js');?>'></script>
</head>

<body>
  <!-- Show loading gif image while page loads -->
  <!--<div class="loading"></div>-->
  
  <!-- Header section -->
<?php include('header.php');?>

 <!-- Features Section -->
 <section>
   <!-- Change slider images here -->
   <div id="section-one">
  <a href="#"><img src="<?php echo get_images_url('banner.png');?>"  alt="bannerImg1" title="<p>Grean and Peace Banner!</p> <span>Easy to modify and customize</span>" /></a>
  </div> 
  <div id="section-two"> 
   <div class="section-two-one">
    <h2>研发的产品 Our Product</h2>
   </div> 
   <div class="section-two-two">
          <ul class="portHolder">
          <li class="port"> <a title="Portfolio Item" href="<?php echo get_theme_url()."portfolio/images/p1_full.jpg"?>" class="zoomboxP"> <img src="<?php echo get_images_url('p1.jpg');?>" alt="item1" />
            <div class="zoomHomeP"> <img src="<?php echo get_images_url('zoomHomeP.png');?>" alt="zoom icon" /> </div>
          </a> </li>
          <li class="port"> <a title="Link to video" href="<?php echo get_theme_url()."portfolio/p2.html"?>" class="zoomboxP"> <img src="<?php echo get_images_url('p2.jpg');?>" alt="item2" />
            <div class="zoomHomeP"> <img src="<?php echo get_images_url('zoomHomeP.png');?>" alt="zoom icon" /> </div>
          </a> </li>
          <li class="port"> <a title="Portfolio Item" href="<?php echo get_theme_url()."/portfolio/p3.html"?>" class="zoomboxP"> <img src="<?php echo get_images_url('p3.jpg');?>" alt="item3" />
            <div class="zoomHomeP"> <img src="<?php echo get_images_url('zoomHomeP.png');?>" alt="zoom icon" /> </div>
          </a> </li>
          <li class="port"> <a title="Portfolio Item" href="<?php echo get_theme_url()."portfolio/images/p4_full.jpg"?>" class="zoomboxP"> <img src="<?php echo get_images_url('p4.jpg');?>" alt="item4" />
            <div class="zoomHomeP"> <img src="<?php echo get_images_url('zoomHomeP.png');?>" alt="zoom icon" /> </div>
          </a> </li>
          <li class="port"> <a title="Portfolio Item" href="<?php echo get_theme_url()."portfolio/images/p5_full.jpg"?>" class="zoomboxP"> <img src="<?php echo get_images_url('p5.jpg');?>" alt="item5" />
            <div class="zoomHomeP"> <img src="<?php echo get_images_url('zoomHomeP.png');?>" alt="zoom icon" /> </div>
          </a> </li>
          <li class="port"> <a title="Portfolio Item" href="<?php echo get_theme_url()."portfolio/images/p6_full.jpg"?>" class="zoomboxP"> <img src="<?php echo get_images_url('p6.jpg');?>" alt="item6" />
            <div class="zoomHomeP"> <img src="<?php echo get_images_url('zoomHomeP.png');?>" alt="zoom icon" /> </div>
          </a> </li>
          <li class="port"> <a title="Portfolio Item" href="<?php echo get_theme_url()."portfolio/images/p7_full.jpg"?>" class="zoomboxP"> <img src="<?php echo get_images_url('p7.jpg');?>" alt="item7" />
            <div class="zoomHomeP"> <img src="<?php echo get_images_url('zoomHomeP.png');?>" alt="zoom icon" /> </div>
          </a> </li>
          <li class="port"> <a title="Portfolio Item" href="<?php echo get_theme_url()."portfolio/images/p8_full.jpg"?>" class="zoomboxP"> <img src="<?php echo get_images_url('p8.jpg');?>" alt="item8" />
            <div class="zoomHomeP"> <img src="<?php echo get_images_url('zoomHomeP.png');?>" alt="zoom icon" /> </div>
          </a> </li>
          <li class="port"> <a title="Portfolio Item" href="<?php echo get_theme_url()."portfolio/images/p9_full.jpg"?>" class="zoomboxP"> <img src="<?php echo get_images_url('p9.jpg');?>" alt="item9" />
            <div class="zoomHomeP"> <img src="<?php echo get_images_url('zoomHomeP.png');?>" alt="zoom icon" /> </div>
          </a> </li>
          <li class="port"> <a title="Portfolio Item" href="<?php echo get_theme_url()."portfolio/images/p10_full.jpg"?>" class="zoomboxP"> <img src="<?php echo get_images_url('p10.jpg');?>" alt="item10" />
            <div class="zoomHomeP"> <img src="<?php echo get_images_url('zoomHomeP.png');?>" alt="zoom icon" /> </div>
          </a> </li>
          <li class="port"> <a title="Portfolio Item" href="<?php echo get_theme_url()."portfolio/images/p11_full.jpg"?>" class="zoomboxP"> <img src="<?php echo get_images_url('p11.jpg');?>" alt="item11" />
            <div class="zoomHomeP"> <img src="<?php echo get_images_url('zoomHomeP.png');?>" alt="zoom icon" /> </div>
          </a> </li>
          <li class="port"> <a title="Portfolio Item" href="<?php echo get_theme_url()."portfolio/images/p12_full.jpg"?>" class="zoomboxP"> <img src="<?php echo get_images_url('p12.jpg');?>" alt="item12" />
            <div class="zoomHomeP"> <img src="<?php echo get_images_url('zoomHomeP.png');?>" alt="zoom icon" /> </div>
          </a> </li>
        </ul>
   </div>
  </div>
   <?php echo get_page_content();?>
   
  </section>
 
<?php include('footer.php');if(DEBUG) $log->console_javascript();?>
</body>
</html>
