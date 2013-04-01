<?php

function get_option( $option )
{
	global $db;
	$db->query($db->prepare('select %1$s from options where option_name = "%2$s";','option_value',$option));
	$r=$db->get_rows();
	return $r[0]['option_value'];
}

function add_option( $option, $value )
{
	global $db;
	$db->query(DB::prepare('insert into options (option_name,option_value) values ("%1$s","%2$s");',$option,$value));
}

function update_option( $option, $value )
{
	global $db;
	//$db->prepare('update options set option_value ="%2$s" where option_name = "%1$s" ;',$option,addslashes($value));
	$result=$db->query("update options set option_value ='$value' where option_name = '$option'");
	return $result;
}

function delete_option( $option )
{
	global $db;
	$db->query(DB::prepare('delete from options where option_name = "%1$s" ;',$option));
}

function get_all_options()
{
	global $db;
	$db->query($db->prepare('select * from options;'));
	$r=$db->get_rows();
	return $r;
}
?>