<?
//define dir constants
define('GWDIR', dirname(__FILE__).'/');
define('INCDIR', GWDIR.'includes/');
define('THEMESDIR', GWDIR.'contents/themes/');
define('PLUGINSDIR',GWDIR.'contents/plugins/');

//if 'install.php' exists then do the installing
if(file_exists('install.php'))
require_once('install.php');
 
//require the config file,you should edit config.php at first
require_once('config.php');
 
//require the include files
require_once(INCDIR.'constants.php');
require_once(INCDIR.'functions.php');
require_once(INCDIR.'formatting.php');
require_once(INCDIR.'db.php');
if(DEBUG) require_once(INCDIR.'log.php');
require_once(INCDIR.'option.php');
require_once(INCDIR.'query.php');
require_once(INCDIR.'plugin.php');
require_once(INCDIR.'theme.php');
require_once(INCDIR.'vars.php');

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

//see if plugin have something to do about the page id
do_action('query_page_id');

//get the menu nav
$menu_nav=unserialize(get_option('menu_nav'));

//get the template file name
$template=get_template();

//get the theme
$themes=get_option('applied_theme');
//print_r($GLOBALS);
require_once(THEMESDIR."$theme/$template.php");
?>
