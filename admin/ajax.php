<?php
define('GWDIR', dirname(__FILE__).'/../');
define('INCDIR', GWDIR.'includes/');
define('THEMESDIR', GWDIR.'contents/themes/');
require_once(INCDIR.'theme.php');
	if($_POST['action']=='change_theme')
	{
		//echo $_POST['theme'];
		//$files=array('index.php','post.php');
		$theme=$_POST['theme'];
		$files=get_template_files($theme);
		$files=json_encode($files);
		echo $files;
	}
	else if($_POST['action']=='change_file')
	{
		$theme=$_POST['theme'];
		$file=$_POST['file'];
		$content=get_template_file_content($theme,$file);
		//$content=json_encode($content);
		echo $content;
	}
	else if($_POST['action']=='save_file')
	{
		//$content=$_POST['theme']+$_POST['file']+$_POST['content'];
		$theme=$_POST['theme'];
		$file=$_POST['file'];
		$content=$_POST['content'];
		//echo json_encode('abagadfadfdafadfadfadfadfadfsagfgfeawr jjkajoiarejfkdfkgkaa;kl" d"c');
		echo save_template_file_content($theme,$file,$content);
	}
?>