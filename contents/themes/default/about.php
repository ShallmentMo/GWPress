<!DOCTYPE HTML>
<html>
<head>
  <title><?php echo get_option('site_name').":about me";?></title>
  <meta name="description" content="<?php echo get_option('site_description');?>" />
  <meta http-equiv="content-type" content="<?php echo get_option('html_type').';charset='.get_option('site_charset');?>" />
  <link rel="stylesheet" type="text/css" href="<?php echo get_theme_url();?>css/style.css" />
  <link href='http://fonts.googleapis.com/css?family=Patrick+Hand+SC' rel='stylesheet' type='text/css'>
</head>

<body>
	<div class="transparent">
		<?php include('header.php');?>
		<article>
			<h1><?php echo get_page_title();?></h1>
			<section>
				<p>
					<?php echo get_page_content();?>
				</p>
			</section>
		</article>
		<?php include('footer.php');if(DEBUG) $log->console_javascript();?>
	</div>
</body>
</html>
