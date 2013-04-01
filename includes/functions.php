<?
/**
 * get currrent time
 * 
 * @param string $type Either 'mysql' or 'timestamp'.
 * @param int|bool $gmt Optional. Whether to use GMT timezone. Default is false.
 * @return int|string String if $type is 'gmt', int if $type is 'timestamp'.
 */
function current_time( $type, $gmt = 0 )
{
	switch ( $type ) {
		case 'mysql':
			return ( $gmt ) ? gmdate( 'Y-m-d H:i:s' ) : gmdate( 'Y-m-d H:i:s', ( time() + ( get_option( 'gmt_offset' ) * 3600 ) ) );
			break;
		case 'timestamp':
			return ( $gmt ) ? time() : time() + (get_option( 'gmt_offset' ) * 3600 );
			break;
	}
}

/**
 * merge $args to $defaults
 *
 * @param user defined arguments
 * @param default arguments
 * @return array merged
 */
function parse_args( $args, $defaults = '' ) {
	if ( is_object( $args ) )
		$r = get_object_vars( $args );
	elseif ( is_array( $args ) )
		$r =& $args;

	if ( is_array( $defaults ) )
		return array_merge( $defaults, $r );
	return $r;
}

/**
 * get the thems url
 *
 * @return string represent a url
 */
function get_theme_url()
{
	global $theme;
	$site=get_option('siteurl');
	return $site."/contents/themes/$theme/";
}

/**
 * get css url
 *
 * @return string stand for css url
 */
function get_css_url($file)
{
	$theme_url=get_theme_url();
	return $theme_url.'css/'.$file;
}

/**
 * get js url
 *
 * @return string stand for js url
 */
function get_js_url($file)
{
	$theme_url=get_theme_url();
	return $theme_url.'js/'.$file;
}

/**
 * get images url
 *
 * @return string stand for js url
 */
function get_images_url($file)
{
	$theme_url=get_theme_url();
	return $theme_url.'images/'.$file;
}

/**
 * get page url base on page_title
 * 
 * @return page url
 */
function get_page_url($page_title)
{
	$site=get_option('siteurl').'/'.sanitize_title_with_dashes($page_title);
	return $site;
}

/**
 * get page url by page_id
 * 
 * @return string stand for page url
 */
function get_page_url_by_page_id($page_id)
{
	global $db;
	//if(DEBUG) global $log;
	$db->query($db->prepare('select page_title from pages where page_id=%1$d',$page_id));
	$rs=$db->get_rows();
	//$log->debug($rs[0][0],$db->prepare('select page_title from pages where page_id=%1$d',$page_id));
	return get_page_url($rs[0][0]);
}

/**
 * get page title
 * 
 * @return page_title
 */
function get_page_title($p=null)
{
	global $page_id,$db;
	if(!isset($p)) $p=$page_id;
	$db->query($db->prepare('select page_title from pages where page_id = "%1$d";',$p));
	$r=$db->get_rows();
	return $r[0]['page_title'];
}

/**
 * get page content
 *
 * @return page_content
 */
function get_page_content($p=null)
{
	global $page_id,$db;
	if(!isset($p)) $p=$page_id;
	$db->query($db->prepare('select page_content from pages where page_id = "%1$d";',$p));
	$r=$db->get_rows();
	return $r[0]['page_content'];
}

/**
 * get page template
 *
 * @return page_template
 */
function get_page_template($p=null)
{
	global $page_id,$db;
	if(!isset($p)) $p=$page_id;
	$db->query($db->prepare('select page_template from pages where page_id = "%1$d";',$p));
	$r=$db->get_rows();
	return $r[0]['page_template'];
}

/**
 * get page info
 *
 */
function get_all_pages()
{
	global $db;
	$db->query($db->prepare('select * from pages;'));
	$r=$db->get_rows();
	return $r;
}

/**
 * get page_id by menu_name
 *
 * @return int stand for page_id
 */
function get_page_id_by_menu_name($menu_name)
{
	global $db;
	$db->query($db->prepare('select page_id from page_metas where page_meta_name="menu" and page_meta_value="%1$s"',$menu_name));
	$rs=$db->get_rows();
	return $rs[0][0];
}
/**
 * get all menus
 */
function get_all_menus()
{
	global $db;
	$db->query($db->prepare('select page_meta_id,page_id,page_meta_value from page_metas where page_meta_name ="menu"'));
	$rs=$db->get_rows();
	return $rs;
}

/**
 * get all menus by option menu_nav
 *
 * @return array
 */
function get_menu_nav()
{
	global $db;
	$db->query($db->prepare('select option_value from options where option_name="menu_nav"'));
	$rs=$db->get_rows();
	$rs=unserialize($rs[0][0]);
	return $rs;
}

/**
 * get menu name based on page_id
 *
 * @string menu name
 */
function get_menu_name($page_id=1)
{
	global $db;
	$db->query($db->prepare('select page_meta_value from page_metas where page_meta_name ="menu" and page_id=%1$d;',$page_id));
	$rs=$db->get_rows();
	return $rs[0]['page_meta_value'];
}

/**
 * get menu order
 *
 * @string show menu order
 */
function get_menu_order()
{
	$rs=get_menu_nav();
	$s="";
	foreach($rs as $r)
	{
		$s.=$r.',';
	}
	return $s;
}

/**
 * save menu order
 *
 */
function save_menu_order($order_string='')
{
	if($order_string=='') return;
	$menu=explode(",",$order_string);
	array_pop($menu);
	//global $log;
	//$log->debug(serialize($menu));
	update_option("menu_nav",serialize($menu));
}

/**
 * to change user password
 *
 */
function change_user_password($user,$password)
{
	global $db;
	$password=md5($password);
	$result=$db->query("update users set user_pass ='$password' where user_login = '$user'");
	return $result;
}

/**
 * get login name
 */
function get_login_name()
{
	global $auth;
	return $auth->get_login_name();
}
/**
 * GWPress die
 *
 */
function gwpress_die()
{
	$args = func_get_args();
	call_user_func_array('printf', $args);
	die();
}

?>