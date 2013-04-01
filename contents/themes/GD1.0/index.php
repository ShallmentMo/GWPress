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
  
  <!--  Div section -->

  <section>
   <!-- Change slider images here -->
   <div id="section-one">
    <div id="slider" class="nivoSlider">
	<a href="#"><img src="<?php echo get_images_url('slide1.jpg');?>" alt="sliderImg1" title="<p>Flexible and functional</p> <span>Easy to modify and customize</span>" /></a>
	<a href="#"><img src="<?php echo get_images_url('slide2.jpg');?>" alt="sliderImg2" title="<p>Modern minimalist portfolio</p> <span>Packed with HTML5 and CSS3 goodness</span>" /></a>
	<a href="#"><img src="<?php echo get_images_url('slide3.jpg');?>" alt="sliderImg3" title="<p>Grid 960 System</p> <span>Suoer easy layout customization</span>" /></a>
	<a href="#"><img src="<?php echo get_images_url('slide4.jpg');?>" alt="sliderImg4" title="<p>Okay you get the hang of it</p> <span>Another caption here</span>" /></a>
   </div>
   <div id="shadow"></div>
  </div> 
  
   <?php echo get_page_content();?>
   
  </section>
 
  <!-- Footer section -->
<?php include('footer.php');if(DEBUG) $log->console_javascript();?>
</body>
</html>