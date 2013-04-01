<?php ob_start();?>
<html>
<head>
	<title>安装GWPress</title>
	<link href="styles.css" media="screen" rel="stylesheet" type="text/css">
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
</head>
<body>
<header>
	安装GWPress:步骤
	<?php
		if(!isset($_POST['step'])) $_POST['step']='1';
		echo $_POST['step'];
	?>
</header>
<article>
<?php
	if($_POST['step']=='1')
	{
?>
	<form method="post" action="index.php">
		<section>	
			在安装GWPress之前,你需要检查一下的条件是否
			<ul>
				<li>Apache的mod_rewrite模块需要开启</li>
				<li>相关文件夹的AllowOverride需要开启</li>
				<li>MySQL的版本需要高于或等于5.0</li>
				<li>PHP的版本需要高于或等于5.0</li>
				<li>你需要先修改根文件夹的config.php文件,设置好里面的属性,并创建对应的数据库</li>
			</ul>
		</section>
		<section>
			<input type="checkbox" name="requirement" required="required">我确定我已经满足安装要求</input>
			<input type="checkbox" name="author_right" required="required">我同意作者拥有源代码的所有权利</input>
			<input type="hidden" name="step" value='2'/>
			<button type='submit' formmethod='post' name='ste' value='2'>下一步</button>
		</section>
	</form>
<?php
	}else if($_POST['step']=='2')
	{
?> 
	<form method="post" action="index.php">
		<section>
			<ul>
			<?php
				$flag=true;
				if(in_array('mod_rewrite',apache_get_modules()))
					echo "<li class='check_right'>Apache的mod_rewrite模块已经开启</li>";
				else
					{echo "<li class='check_wrong'>Apache的mod_rewrite模块没有被开启</li>";$flag=false;}
				if(version_compare(PHP_VERSION, '5.0.0') >= 0)
					echo "<li class='check_right'>PHP的版本高于或等于5.0</li>";
				else
					{echo "<li class='check_wrong'>PHP的版本低于5.0";$flag=false;}
				require_once('../config.php');
				$link=@mysql_connect( DB_HOST, DB_USER,DB_PASSWORD, true);
				if(!@mysql_select_db( DB_NAME, $link ))
					{echo "<li class='check_wrong'>无法连接数据库,请检查是否设置正确config.php</li>";$flag=false;}
				else echo "<li class='check_right'>数据库设置正确</li>";
				if(!$flag)
					echo "<input type='hidden' name='step' value='1'/><button type='submit' formmethod='post' name='ste' value='1' >返回</button>";
				
			?>
			</ul>
		</section>
		<?php
		if($flag)
		echo <<<HTML
		<section>
			<table>
				<tbody>
					<tr>
						<td>SiteURL</td><td><input type="url" name="site_url" placeholder="网站的URL,需http://开头" required="required"></input></td>
					</tr>
					<tr>
						<td>SiteName</td><td><input type="text" name="site_name" placeholder="网站的名称" required="required"></input></td>
					</tr>
					<tr>
						<td>Site简介</td><td><input type="text" name="site_decs" placeholder="网站的简要描述" required="required"></input></td>
					</tr>
					<tr>
						<td>用户名</td><td><input type="text" name="username" placeholder="管理员用户名" required="required"></input></td>
					</tr>
					<tr>
						<td>密码</td><td><input type="password" name="password" placeholder="管理员密码" required="required"></input></td>
					</tr>
					<tr>
						<td><input type="hidden" name="step" value='3'/><button type="submit" name="ste" value="3">提交</button></td>
					</tr>
				</tbody>
			</table>
		<section>
HTML
	?>
	</form>
<?php
	}else if($_POST['step']=='3')
	{
		define('GWDIR', dirname(__FILE__).'/../');
		define('INCDIR', GWDIR.'includes/');
		define('THEMESDIR', GWDIR.'contents/themes/');
		define('PLUGINSDIR',GWDIR.'contents/plugins/');
		require_once(GWDIR.'config.php');
		require_once(INCDIR.'functions.php');
		require_once(INCDIR.'formatting.php');
		require_once(INCDIR.'db.php');
		$site_url=rtrim($_POST['site_url'],'\\/');
		$site_name=$_POST['site_name'];
		$site_decs=$_POST['site_decs'];
		$username=$_POST['username'];
		$password=md5($_POST['password']);
		require_once('schema.php');
		$base=preg_replace('/^http:\/\/[^\/]*\//i','',$site_url,1);
		echo $base;
		$fp=fopen('../.htaccess','w');
		fwrite($fp,<<<HTML
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteBase /$base/
RewriteRule ^index\.php$ - [L]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . /$base/index.php [L]
</IfModule>
HTML
);
		header("Location:$site_url/admin");
	}
?>
</article>
<footer>
</footer>
</body>
</html>
<?php ob_flush();?>
