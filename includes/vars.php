<?php
if(DEBUG) $log=new Log();
$actions=array();
$menu_nav=array();
$query_string=get_query_string();
//$log->debug($query_string);
$page_id=get_page_id($query_string);
//$log->debug($page_id);
$template=get_page_template($p=null);
$theme=get_option('applied_theme');
?>