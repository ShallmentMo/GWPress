<?php
add_action('add_admin_menu','post_add_admin_menu');
add_action('add_admin_section','post_add_admin_section');
add_action('last_admin_javascript','post_add_admin_javascript');
function post_add_admin_menu()
{
	echo '<a href="#posts" class="btn btn-large btn-block"><li >Posts</li></a>';
}

function post_add_admin_section()
{
			global $log;
			echo '<div id="posts">
			<section class="name">
				<div class="title"><p>Posts</p></div>
				<div class="img"><img src="./images/stretch1.png"/></div>
			</section>
			<div class="stretch">';
			require_once("post_admin.php");
			echo '</div></div>';
}

function post_add_admin_javascript()
{
	echo <<<HTML
		<script type="text/javascript">
	$(document).ready(function(){
	$("#posts .stretch").hide();
	$("#posts section .img").toggle(function()
	{
	$("#posts section .img img").attr("src","./images/stretch2.png");
	$("#posts .stretch").animate({height: 'toggle', opacity: 'toggle'}, "slow");
	},function()
	{
	$("#posts section .img img").attr("src","./images/stretch1.png");
	$("#posts .stretch").animate({height: 'toggle', opacity: 'toggle'}, "slow");});
	});
</script>
HTML;
}
function get_all_posts()
{
	global $db;
	$db->query($db->prepare('select page_id from page_metas where page_meta_name="page_type" and page_meta_value="post"'));
	$rs=$db->get_rows();
	$result=array();
	foreach($rs as $r)
	{
		array_push($result,$r[0]);
	}
	return $result;
}

function new_post($post_title,$post_content,$post_author,$post_datetime,$post_tags)
{
	global $db;
	$db->query($db->prepare('insert into pages (page_title,page_content,page_template) values ("%1$s","%2$s","%3$s");',$post_title,$post_content,'post'));
	$db->query($db->prepare('select page_id from pages where page_title="%1$s" and page_content="%2$s";',$post_title,$post_content));
	$rs=$db->get_rows();
	$page_id=$rs[0][0];
	$db->query($db->prepare('insert into page_metas (page_id,page_meta_name,page_meta_value) values (%1$d,"page_type","%2$s");',$page_id,"post"));
	$db->query($db->prepare('insert into page_metas (page_id,page_meta_name,page_meta_value) values (%1$d,"post_author","%2$s");',$page_id,$post_author));
	$db->query($db->prepare('insert into page_metas (page_id,page_meta_name,page_meta_value) values (%1$d,"post_datetime","%2$s");',$page_id,$post_datetime));
	$db->query($db->prepare('insert into page_metas (page_id,page_meta_name,page_meta_value) values (%1$d,"post_tags","%2$s");',$page_id,$post_tags));
}

function save_post($post_id,$post_title,$post_content,$post_author,$post_datetime,$post_tags)
{
	global $db;
	$db->query($db->prepare('update pages set page_title="%1$s",page_content="%2$s" where page_id=%3$d;',$post_title,$post_content,$post_id));
	$db->query($db->prepare('update page_metas set page_meta_value="%1$s" where page_id=%2$d and page_meta_name="%3$s',$post_author,$post_id,"post_author"));
	$db->query($db->prepare('update page_metas set page_meta_value="%1$s" where page_id=%2$d and page_meta_name="%3$s',$post_datetime,$post_id,"post_datetime"));	
	$db->query($db->prepare('update page_metas set page_meta_value="%1$s" where page_id=%2$d and page_meta_name="%3$s',$post_tags,$post_id,"post_tags"));
}

function del_post($post_id)
{
	global $db;
	$db->query($db->prepare('delete from pages where page_id=%1$d',$post_id));
	$db->query($db->prepare('delete from page_metas where page_id=%1$d',$post_id));
}

function get_post_title($post_id)
{
	return get_page_title($post_id);
}

function get_post_content($post_id)
{
	return get_page_content($post_id);
}

function get_post_author($post_id)
{
	global $db;
	$db->query($db->prepare('select page_meta_value from page_metas where page_id=%1$d and page_meta_name="%2$s"',$post_id,"post_author"));
	$rs=$db->get_rows();
	return $rs[0][0];
}

function get_post_datetime($post_id)
{
	global $db;
	$db->query($db->prepare('select page_meta_value from page_metas where page_id=%1$d and page_meta_name="%2$s"',$post_id,"post_datetime"));
	$rs=$db->get_rows();
	return $rs[0][0];
}

function get_post_tags($post_id)
{
	global $db;
	$db->query($db->prepare('select page_meta_value from page_metas where page_id=%1$d and page_meta_name="%2$s"',$post_id,"post_tags"));
	$rs=$db->get_rows();
	return $rs[0][0];
}
?>