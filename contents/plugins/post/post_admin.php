<?php
	if($_POST['action']=='post_create')
	{
		//$log->debug($_POST['post_datetime'].' '.$_POST['post_tags']);
		new_post($_POST['post_title'],$_POST['post_content'],$_POST['post_author'],$_POST['post_datetime'],$_POST['post_tags']);
	}
	if($_POST['action']=='post_save')
	{
		//$log->debug($_POST['post_id']);
		save_post($_POST['post_id'],$_POST['post_title'],$_POST['post_content'],$_POST['post_author'],$_POST['post_datetime'],$_POST['post_tags']);
	}
	if($_POST['action']=='post_del')
	{
		//$log->debug($_POST['post_id']);
		del_post($_POSt['post_id']);
	}
	if($_POST['action']=='post_edit')
	{
		$post_id=$_POST['post_id'];
		$post_title=get_post_title($post_id);
		$post_content=get_post_content($post_id);
		$post_author=get_post_author($post_id);
		$post_datetime=get_post_datetime($post_id);
		$post_tags=get_post_tags($post_id);
		echo<<<HTML
		<script type="text/javascript" src="./js/tinymce/tiny_mce.js"></script>
		<script type="text/javascript">
		tinyMCE.init({
        mode : "textareas",
		 editor_selector : "mceEditor",
        editor_deselector : "mceNoEditor"
		});
		</script>
			<div>
				<div id="table_head"></div>
				<table>
					<tbody>
						<form method='post' action='index.php#posts'>
						<input type='hidden' name='post_id' value=$post_id/>
						<tr>
							<td>post_title</td>
							<td><input type='text' name='post_title' value='$post_title'></input></td>
						</tr>
						<tr>
							<td>post_content</td>
							<td><textarea class="mceEditor" name="post_content" cols="50" rows="15" value='$post_content'></textarea></td>
						</tr>
						<tr>
							<td>post_author</td>
							<td><input type='text' name='post_author' value='$post_author'></input></td>
						</tr>
						<tr>
							<td>post_time</td>
							<td><input type='datetime' name='post_datetime' value='$post_datetime'></input></td>
						</tr>
						<tr>
							<td>post_tag</td>
							<td>
							<div class="span3">
								<input name="post_tags" id="tagsinput" class="tagsinput" value="$post_tags" placeholder='tages'/>
							</div></td>
						</tr>
						<tr>
							<td></td>
							<td><button class='btn btn-large btn-block' type='submit' formmethod='post' name='action' value='post_save'>Create Post</button></td>
						</tr>
						</form>
HTML;
	}
	else if($_POST['action']=='post_new')
	{
		//$log->debug($_POST['action']);
		$user=get_login_name();
		$datetime=current_time('mysql');
		echo<<<HTML
		<script type="text/javascript" src="./js/tinymce/tiny_mce.js"></script>
		<script type="text/javascript">
		tinyMCE.init({
        mode : "textareas",
		editor_selector : "mceEditor",
        editor_deselector : "mceNoEditor"
		});
		</script>
			<div>
				<div id="table_head"></div>
				<table>
					<tbody>
						<form method='post' action='index.php#posts'>
						<tr>
							<td>post_title</td>
							<td><input type='text' name='post_title'></input></td>
						</tr>
						<tr>
							<td>post_content</td>
							<td><textarea class="mceEditor" name="post_content" cols="50" rows="15"></textarea></td>
						</tr>
						<tr>
							<td>post_author</td>
							<td><input type='text' name='post_author' value='$user'></input></td>
						</tr>
						<tr>
							<td>post_time</td>
							<td><input type='datetime' name='post_datetime' value='$datetime'></input></td>
						</tr>
						<tr>
							<td>post_tag</td>
							<td>
							<div class="span3">
								<input name="post_tags" id="tagsinput" class="tagsinput" value="" placeholder='tages'/>
							</div></td>
						</tr>
						<tr>
							<td></td>
							<td><button class='btn btn-large btn-block' type='submit' formmethod='post' name='action' value='post_create'>Create Post</button></td>
						</tr>
						</form>
HTML;
	}else{
		echo <<<HTML
			<div>
				<div id="table_head"></div>
				<table>
					<thead>
						<tr>
							<th>post_title</th>
							<th>edit</th>
							<th>delete</th>
						</tr>
					</thead>
					<tbody>
HTML;
						foreach(get_all_posts() as $p)
						{
							global $db;
							$db->query($db->prepare('select page_title from pages where page_id=%1$d',$p));
							$r=$db->get_rows();$r=$r[0][0];
							echo "<form  method='post' action='index.php#posts'><input type='hidden' name='post_id' value=$p></input><tr><td>$r</td>";
							echo "<td><button class='btn btn-large btn-block' type=submit formmethod='post' name='action' value='post_edit'>edit</button></td>
							<td><button class='btn btn-large btn-block' type='submit' formmethod='post' name='action' value='post_del'>delete</button></td></tr>";
							echo '</form>';
						}
		echo '<tr><td></td><form method="post" action="index.php#posts"><td><button class="btn btn-large btn-block" type="submit" formmethod="post" name="action" value="post_new">New Post</button></td></form><td></td></tr>';
		echo <<<HTML
					</tbody>
				</table>
				<div id="table_foot"></div>
			</div>
HTML;
}
?>