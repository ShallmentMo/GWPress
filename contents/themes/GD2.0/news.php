<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>News</title>
<link href="<?php echo get_css_url('validation.css');?>" rel="stylesheet" media="screen">
<link href="<?php echo get_css_url('style.css');?>" rel="stylesheet" media="screen">
 <link rel="stylesheet" href="<?php echo get_css_url('nivo-slider.css');?>">   
 <!-- Jquery magic -->
 <script src="<?php echo get_js_url('jquery-1.6.4.min.js');?>"></script>
 <script src="<?php echo get_js_url('jquery.nivo.slider.pack.js');?>"></script>
 <script src='<?php echo get_js_url('main.js');?>'></script> 

</head>

<body>
<?php include('header.php');?>
<section>

   <aside id="sidebar">
      <nav><a class="logo" href="#top" id="nav-logo"><span>Company Name</span>Company Logo</a>
       <ul>
		<?php
		foreach(get_menu_nav() as $m)
				{
					
					$p=get_page_id_by_menu_name($m);
					$url=get_page_url_by_page_id($p);
					$log->debug($m.' '.$p.' '.$url);
					echo "<li";
					if ($page_id==$p) echo " class='active'><a href='$url'>$m</a></li>";
					else echo "><a href='$url'>$m</a></li>";
				}
	  ?>
       </ul>
      <div class="bg_bottom"></div>
    </nav>
   </aside>
   <div id="main-content">
  <div id="section-one">
  <a href="#"><img src="<?php echo get_images_url('1.jpg');?>"  alt="bannerImg1" title="<p>Grean and Peace Banner!</p> <span>Easy to modify and customize</span>" /></a>
  </div> 
	<?php echo get_page_content();?>
  </div>  
</section>
<?php include('footer.php');if(DEBUG) $log->console_javascript();?>
</body>


</html>
