<!DOCTYPE HTML>
<html>
<head>
  <title><?php echo get_option('site_name');?></title>
  <meta name="description" content="<?php echo get_option('site_description');?>" />
  <meta http-equiv="content-type" content="<?php echo get_option('html_type').';charset='.get_option('site_charset');?>" />
  <link rel="stylesheet" type="text/css" href="<?php echo get_theme_url();?>css/style.css" />
  <link href='http://fonts.googleapis.com/css?family=Patrick+Hand+SC' rel='stylesheet' type='text/css'>
</head>

<body>
	<div class="transparent">
		<?php include('header.php');?>
		<?php foreach(get_all_posts() as $p)
		{
			echo "
			<article>
			<h1><a href='".get_page_url(get_post_title($p))."'>".get_post_title($p)."</a></h1>
			<section>
				<p>
					".get_post_content($p)."
				</p>
			</section>
			</article>";
		}
		?>
		<?php include('footer.php');if(DEBUG) $log->console_javascript();?>
	</div>
</body>
</html>
