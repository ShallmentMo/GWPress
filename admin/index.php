<?php
//define dir constants
define('GWDIR', dirname(__FILE__).'/../');
define('INCDIR', GWDIR.'includes/');
define('THEMESDIR', GWDIR.'contents/themes/');
define('PLUGINSDIR',GWDIR.'contents/plugins/');
 
//require the config file,you should edit config.php at first
require_once(GWDIR.'config.php');
 
//require the include files
require_once(INCDIR.'constants.php');
require_once(INCDIR.'functions.php');
require_once(INCDIR.'formatting.php');
require_once(INCDIR.'user.php');
require_once(INCDIR.'db.php');
if(DEBUG) require_once(INCDIR.'log.php');
require_once(INCDIR.'option.php');
require_once(INCDIR.'query.php');
require_once(INCDIR.'plugin.php');
require_once(INCDIR.'theme.php');
require_once(INCDIR.'auth.php');
require_once(INCDIR.'vars.php');
$auth = new Auth('login.php', 'secret');
if(isset($_GET['log_out']))  $auth->logout();

//load active plugin
if(get_option('active_plugins')!='')
{
	$plugins=unserialize(get_option('active_plugins'));
	foreach($plugins as $plugin)
	{
		if(file_exists(PLUGINSDIR."/$plugin/index.php"))
		require_once(PLUGINSDIR."/$plugin/index.php");
	}
}
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>GWPress Admin</title>
	<link href="css/styles.css" media="screen" rel="stylesheet" type="text/css">
	 <meta http-equiv="content-type" content="<?php echo get_option('html_type').';charset='.get_option('site_charset');?>" />
	<!-- Loading Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <!-- Loading Flat UI -->
    <link href="css/flat-ui.css" rel="stylesheet">
</head>

<body>
	<header>
		<h1 class="logo">GWPress</h1>
		<nav>
			<ul>
				<a href="#pages" class="btn btn-large btn-block" ><li>Pages</li></a>
				<a href="#options" class="btn btn-large btn-block"><li >Options</li></a>
				<a href="#menus" class="btn btn-large btn-block"><li >Menus</li></a>
				<a href="#users" class="btn btn-large btn-block"><li >Users</li></a>
				<a href="#plugins" class="btn btn-large btn-block"><li >Plugins</li></a>
				<a href="#editor" class="btn btn-large btn-block"><li>Editor</li></a>
				<?php do_action('add_admin_menu');?>
			</ul>
		</nav>
	</header>
	<div id="container">
		<div id="content">
			<div id="head">
			<section class="name">
				<span ><?php echo current_time('mysql',false);?></span>
				<span><a href="index.php?log_out=true">Log out</a></span>
				<span><a href="<?php echo get_option('siteurl');?>">主页</a></span>
			</section>
			</div>
			<div id="pages">
			<section class="name">
				<div class="title"><p>Pages</p></div>
				<div class="img"><img src="./images/stretch1.png"/></div>
			</section>
			<div class="stretch">
			<?php require_once('pages.php');?>
			</div>
			</div>
			<div id="options">
			<section class="name">
				<div class="title"><p>Options</p></div>
				<div class="img"><img src="./images/stretch1.png"/></div>
			</section>
			<div class="stretch">
			<?php require_once('options.php');?>
			</div>
			</div>
			<div id="menus">
			<section class="name">
				<div class="title"><p>Menus</p></div>
				<div class="img"><img src="./images/stretch1.png"/></div>
			</section>
			<div class="stretch">
			<?php require_once('menus.php');?>
			</div>
			</div>
			<div id="users">
			<section class="name">
				<div class="title"><p>Users</p></div>
				<div class="img"><img src="./images/stretch1.png"/></div>
			</section>
			<div class="stretch">
			<?php require_once('users.php');?>
			</div>
			</div>
			<div id="plugins">
			<section class="name">
				<div class="title"><p>Plugins</p></div>
				<div class="img"><img src="./images/stretch1.png"/></div>
			</section>
			<div class="stretch">
			<?php require_once('plugins.php');?>
			</div>
			</div>
			<div id="editor">
			<section class="name">
				<div class="title"><p>Editors</p></div>
				<div class="img"><img src="./images/stretch1.png"/></div>
			</section>
			<div class="stretch">
			<?php require_once('editor.php');?>
			</div>
			</div>
			<?php do_action('add_admin_section');?>
		</div>
	</div>
	<footer>
	</footer>
	
	
	 <!-- Load JS here for greater good =============================-->
	 <?php if(DEBUG) $log->console_javascript();?>
    <script src="js/jquery-1.8.2.min.js"></script>
    <script src="js/jquery-ui-1.10.0.custom.min.js"></script>
    <script src="js/jquery.dropkick-1.0.0.js"></script>
    <script src="js/custom_checkbox_and_radio.js"></script>
    <script src="js/custom_radio.js"></script>
    <script src="js/jquery.tagsinput.js"></script>
    <script src="js/bootstrap-tooltip.js"></script>
    <script src="js/jquery.placeholder.js"></script>
    <script src="http://vjs.zencdn.net/c/video.js"></script>
    <script src="js/application.js"></script>
    <!--[if lt IE 8]>
      <script src="js/icon-font-ie7.js"></script>
      <script src="js/icon-font-ie7-24.js"></script>
    <![endif]-->
    <!--<script type="text/javascript">
      var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
      document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
    </script>
    <script type="text/javascript">
      try{
        var pageTracker = _gat._getTracker("UA-19972760-2");
        pageTracker._trackPageview();
        } catch(err) {}
    </script>-->
	<script type="text/javascript">
	   $("#applied_themes").dropkick();
	   $("#themeslist").dropkick({change: function(value, label) {change_theme(value,label);}});
	   $("#fileslist").dropkick({change: function(value, label) {change_file(value,label);}});
	</script>
	<script type="text/javascript">
	$(document).ready(function(){
	$("#pages .stretch").hide();
	$("#pages section .img").toggle(function()
	{
	$("#pages section .img img").attr("src","./images/stretch2.png");
	$("#pages .stretch").animate({height: 'toggle', opacity: 'toggle'}, "slow");
	},function()
	{
	$("#pages section .img img").attr("src","./images/stretch1.png");
	$("#pages .stretch").animate({height: 'toggle', opacity: 'toggle'}, "slow");});
	});
	
	$(document).ready(function(){
	$("#options .stretch").hide();
	$("#options section .img").toggle(function()
	{
	$("#options section .img img").attr("src","./images/stretch2.png");
	$("#options .stretch").animate({height: 'toggle', opacity: 'toggle'}, "slow");
	},function()
	{
	$("#options section .img img").attr("src","./images/stretch1.png");
	$("#options .stretch").animate({height: 'toggle', opacity: 'toggle'}, "slow");});
	});
	
	$(document).ready(function(){
	$("#menus .stretch").hide();
	$("#menus section .img").toggle(function()
	{
	$("#menus section .img img").attr("src","./images/stretch2.png");
	$("#menus .stretch").animate({height: 'toggle', opacity: 'toggle'}, "slow");
	},function()
	{
	$("#menus section .img img").attr("src","./images/stretch1.png");
	$("#menus .stretch").animate({height: 'toggle', opacity: 'toggle'}, "slow");});
	});
	
	$(document).ready(function(){
	$("#users .stretch").hide();
	$("#users section .img").toggle(function()
	{
	$("#users section .img img").attr("src","./images/stretch2.png");
	$("#users .stretch").animate({height: 'toggle', opacity: 'toggle'}, "slow");
	},function()
	{
	$("#users section .img img").attr("src","./images/stretch1.png");
	$("#users .stretch").animate({height: 'toggle', opacity: 'toggle'}, "slow");});
	});
	
	$(document).ready(function(){
	$("#plugins .stretch").hide();
	$("#plugins section .img").toggle(function()
	{
	$("#plugins section .img img").attr("src","./images/stretch2.png");
	$("#plugins .stretch").animate({height: 'toggle', opacity: 'toggle'}, "slow");
	},function()
	{
	$("#plugins section .img img").attr("src","./images/stretch1.png");
	$("#plugins .stretch").animate({height: 'toggle', opacity: 'toggle'}, "slow");});
	});
	
	$(document).ready(function(){
	$("#editor .stretch").hide();
	$("#editor section .img").toggle(function()
	{
	$("#editor section .img img").attr("src","./images/stretch2.png");
	$("#editor .stretch").animate({height: 'toggle', opacity: 'toggle'}, "slow");
	},function()
	{
	$("#editor section .img img").attr("src","./images/stretch1.png");
	$("#editor .stretch").animate({height: 'toggle', opacity: 'toggle'}, "slow");
	}
	);
	});
	
	$(document).ready(function(){
	if(location.hash!='')
	$(location.hash+" section .img").click();
	});
</script>
	<?php do_action('last_admin_javascript');?>
</body>
</html>
