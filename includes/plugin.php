<?php
/**
 * add action to $actions
 */
function add_action($tag,$function)
{
	global $actions;
	if(is_array($actions[$tag]))
	{
		array_push($actions[$tag],$function);
	}else{
		$actions[$tag]=array($function);
	}
}

/**
 * do the action depend on action name
 */
function do_action($tag)
{
	global $actions;
	$args=func_get_args();
	array_shift($args);
	if(is_array($actions[$tag]))
	{
		foreach($actions[$tag] as $k => $v)
		{
			//echo $v;
			call_user_func_array($v,$args);
		}
	}
}

/**
 * remove an action
 */
function remove_action($tag)
{
	global $actions;
	unset($actions[$tag]);
}

/**
 * remove all actions
 */
function remove_all_action()
{
	global $actions;
	unset($actions);
	$actions=array();
}

/**
 * get active plugins
 *
 * @return array
 */
function get_active_plugins()
{
	$plugins=get_option('active_plugins');
	return unserialize($plugins);
}

/**
 * get all plugins
 *
 * @return array
 */
function get_all_plugins()
{
	$dp=opendir(PLUGINSDIR);
	$array=array();
	while($entry=readdir($dp))
	{
		if(is_dir(PLUGINSDIR.$entry))
		{
			array_push($array,$entry);
		}
	}
	closedir($dp);
	array_shift($array);
	array_shift($array);
	return $array;
}


?>