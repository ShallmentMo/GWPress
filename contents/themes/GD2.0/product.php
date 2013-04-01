<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Product</title>
<link href="<?php echo get_css_url('validation.css');?>" rel="stylesheet" media="screen">
<link href="<?php echo get_css_url('style.css');?>" rel="stylesheet" media="screen">
 <link rel="stylesheet" href="<?php echo get_css_url('nivo-slider.css');?>">   
 <link rel="stylesheet" href="<?php echo get_js_url('fancybox/jquery.fancybox-1.3.4.css');?>" /> 
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
  <a href="#"><img src="<?php echo get_images_url('2.jpg');?>"  alt="bannerImg1" title="<p>Grean and Peace Banner!</p> <span>Easy to modify and customize</span>" /></a>
  </div> 
  <div id="section-two"> 
   <div class="section-two-one">
    <h2>研发的产品 Our Product</h2>
   </div> 
   <div class="section-two-two">
        <ul class="projects list">
      	<li><figure><a href="<?php echo get_images_url('pricing_table_3.jpg');?>" rel="work"><img src="<?php echo get_images_url('work_img.jpg');?>" alt="Image" /></a>
        <figcaption><a href="#">Visit Livesite<span>&nbsp;&rarr;</span></a></figcaption>
        </figure>
        
        </li>
        <li><figure><a href="<?php echo get_images_url('pricing_table_3.jpg');?>" rel="work"><img src="<?php echo get_images_url('work_img.jpg');?>" alt="Image" /></a>
        <figcaption><a href="#">Visit Livesite<span>&nbsp;&rarr;</span></a></figcaption>
        </figure></li>
        <li class="last"><figure><a href="<?php echo get_images_url('pricing_table_3.jpg');?>" rel="work"><img src="<?php echo get_images_url('work_img.jpg');?>" alt="Image" /></a>
        <figcaption><a href="#">Visit Livesite<span>&nbsp;&rarr;</span></a></figcaption>
        </figure></li><!-- three columns-->
        
        <li><figure><a href="<?php echo get_images_url('pricing_table_3.jpg');?>" rel="work"><img src="<?php echo get_images_url('work_img.jpg');?>" alt="Image" /></a>
        <figcaption><a href="#">Visit Livesite<span>&nbsp;&rarr;</span></a></figcaption>
        </figure></li>
        <li><figure><a href="<?php echo get_images_url('pricing_table_3.jpg');?>" rel="work"><img src="<?php echo get_images_url('work_img.jpg');?>" alt="Image" /></a>
        <figcaption><a href="#">Visit Livesite<span>&nbsp;&rarr;</span></a></figcaption>
        </figure></li>
        <li class="last"><figure><a href="<?php echo get_images_url('pricing_table_3.jpg');?>" rel="work"><img src="<?php echo get_images_url('work_img.jpg');?>" alt="Image" /></a>
        <figcaption><a href="#">Visit Livesite<span>&nbsp;&rarr;</span></a></figcaption>
        </figure></li>
        <li><figure><a href="<?php echo get_images_url('pricing_table_3.jpg');?>" rel="work"><img src="<?php echo get_images_url('work_img.jpg');?>" alt="Image" /></a>
        <figcaption><a href="#">Visit Livesite<span>&nbsp;&rarr;</span></a></figcaption>
        </figure></li>
        <li><figure><a href="<?php echo get_images_url('pricing_table_3.jpg');?>" rel="work"><img src="<?php echo get_images_url('work_img.jpg');?>" alt="Image" /></a>
        <figcaption><a href="#">Visit Livesite<span>&nbsp;&rarr;</span></a></figcaption>
        </figure></li>
        <li class="last"><figure><a href="<?php echo get_images_url('pricing_table_3.jpg');?>" rel="work"><img src="<?php echo get_images_url('work_img.jpg');?>" alt="Image" /></a>
        <figcaption><a href="#">Visit Livesite<span>&nbsp;&rarr;</span></a></figcaption>
        </figure></li>
      </ul>
   </div>
  </div>
  <div id="section-three" class="intro-section margin clear">
     <div class="padding">
      <h1><span>Wonderful web designs</span> by GWpress</h1>	 
      </div>
    </div>	
  </div>  
</section>
<?php include('footer.php');if(DEBUG) $log->console_javascript();?>
<script type="text/javascript" src="<?php echo get_js_url('jquery-1.4.3.min.js');?>"></script> 
<script type="text/javascript" src="<?php echo get_js_url('fancybox/jquery.mousewheel-3.0.4.pack.js');?>"></script>
<script type="text/javascript" src="<?php echo get_js_url('fancybox/jquery.fancybox-1.3.4.pack.js');?>"></script>
<script type="text/javascript">

		$(document).ready(function() {
			
			
			$('.projects li figure a img').animate({'opacity' : 1}).hover(function() {
				$(this).animate({'opacity' : .5});
			}, function() {
				$(this).animate({'opacity' : 1});
			});
			$('.zoom img').animate({'opacity' : 1}).hover(function() {
				$(this).animate({'opacity' : .5});
			}, function() {
				$(this).animate({'opacity' : 1});
			});

			$("a[rel=work]").fancybox({
				'transitionIn'		: 'elastic',
				'transitionOut'		: 'elastic',
				'titlePosition' 	: 'over',
				'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
					return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
				}
			});
			$("a[rel=recent_work]").fancybox({
				'transitionIn'		: 'elastic',
				'transitionOut'		: 'elastic',
				'titlePosition' 	: 'over',
				'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
					return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
				}
			});

			
		});
	</script>
</body>
</html>
