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
<?php include('header.php');?>

 <section>
   <!-- Change slider images here -->
   <div id="section-one">
  <a href="#"><img src="<?php echo get_images_url('banner.png');?>"  alt="bannerImg1" title="<p>Grean and Peace Banner!</p> <span>Easy to modify and customize</span>" /></a>
  </div> 
  
  <?php echo get_page_content();?>
   
  </section>
 
<?php include('footer.php');if(DEBUG) $log->console_javascript();?>
</body>
</html>
