<?php
/**
 * get the query string
 *
 * @return string queried
 */
function get_query_string()
{
	$request_uri=strtolower('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
	$pattern=get_option('siteurl');
	$pattern=strtolower(addcslashes($pattern,'/'));
	$query_string=preg_replace("/$pattern\//",'',$request_uri);
	return $query_string;
}

/**
 * get page id based on query string
 *
 * @param string queried
 * @return int page id
 */
function get_page_id($query_string='')
{
	if($query_string=='') 
		return 1;
	else{
		global $db;
		$db->query($db->prepare('select page_id,page_title from pages'));
		$rs=$db->get_rows();
		foreach($rs as $r)
		{
			//global $log;
			//$log->debug($r);
			//$log->debug(sanitize_title_with_dashes($r['page_title']));
			//$log->debug($query_string);
			if(strcasecmp(sanitize_title_with_dashes($r['page_title']) ,$query_string)==0)
				return $r['page_id'];
		}
		return 1;
	}
}
?>