<?php
/**
 * get the template by page_id
 */
function get_template()
{
	global $db,$page_id;
	$db->query($db->prepare('select page_template from pages where page_id = %1$s;',$page_id));
	$r=$db->get_rows();
	return $r[0]['page_template'];
}

/**
 * get all themes' name
 *
 * @return array
 */
function get_themes()
{
	$names=array();
	$dir=dir(THEMESDIR);
	while($entry=$dir->read())
	{
		if(is_dir(THEMESDIR.$entry) && $entry != '.' && $entry !='..')
		{
			array_push($names,$entry);
		}
	}
	$dir->close();
	return $names;
}

/**
 * get template files base on theme name
 *
 * @return array
 */
function get_template_files($theme)
{
	$names=array();
	$dir=dir(THEMESDIR.$theme);
	while($entry = $dir->read())
	{
		if(is_file(THEMESDIR.$theme.'/'.$entry))
		{
			array_push($names,$entry);
		}
	}
	$dir->close();
	return $names;
}

/**
 * get template file content base on theme and file
 *
 * @return string
 */
function get_template_file_content($theme,$file)
{
	return file_get_contents(THEMESDIR.$theme.'/'.$file);
}

/**
 * save file content to specified file
 *
 */
function save_template_file_content($theme,$file,$content)
{
	$fp=fopen(THEMESDIR.$theme.'/'.$file,'w');
	fwrite($fp,stripslashes($content));
	return fclose($fp);
}
?>