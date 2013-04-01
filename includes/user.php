<?php
/**
 * get all users
 * @return array
 */
function get_all_users()
{
	global $db;
	$db->query($db->prepare('select user_login from users'));
	$rs=$db->get_rows();
	$result=array();
	foreach($rs as $r)
	{
		array_push($result,$r[0]);
	}
	return $result;
}

class User
{

}
?>