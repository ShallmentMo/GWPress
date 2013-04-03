<?php
	if($_POST['action']=='page_save')
	{
		//echo $_POST['page_id'].' '.$_POST['page_title'].' '.$_POST['page_content'].' '.$_POST['page_template'];
		//save to database
		$log->debug($_POST['page_id'].' '.$_POST['page_title'].' '.$_POST['page_content'].' '.$_POST['page_template']);
		//$log->debug($db->prepare('update pages set page_title= "%1$s",page_content="%2$s",page_template="%3$s" where page_id = %4$d',$_POST['page_title'],$_POST['page_content'],$_POST['page_template'],$_POST['page_id']));
		if(isset($_POST['page_id']))
		{
			$log->debug($db->prepare('update pages set page_title= "%1$s",page_content="%2$s",page_template="%3$s" where page_id = %4$d',$_POST['page_title'],$_POST['page_content'],$_POST['page_template'],$_POST['page_id']));
			$db->query($db->prepare('update pages set page_title= "%1$s",page_content="%2$s",page_template="%3$s" where page_id = %4$d',$_POST['page_title'],$_POST['page_content'],$_POST['page_template'],$_POST['page_id']));
		}else{
			//$log->debug($db->prepare('insert into pages (page_title,page_content,page_template) values ("%1$s","%2$s","%3$s")',$_POST['page_title'],$_POST['page_content'],$_POST['page_template']));
			$db->query($db->prepare('insert into pages (page_title,page_content,page_template) values ("%1$s","%2$s","%3$s")',mysql_real_escape_string($_POST['page_title']),mysql_real_escape_string($_POST['page_content']),mysql_real_escape_string($_POST['page_template'])));
		}
	}
	if($_POST['action'] == 'page_del')
	{
		//$log->debug($db->prepare('delete from pages where page_id = %1$d;',$_POST['page_id']));
		$db->query($db->prepare('delete from pages where page_id = %1$d;',$_POST['page_id']));
	}
	
	if($_POST['action']=='page_edit')
	{
		?>
		<script type="text/javascript" src="./js/tinymce/tiny_mce.js"></script>
		<script type="text/javascript">
		tinyMCE.init({
        mode : "textareas",
		 editor_selector : "mceEditor",
        editor_deselector : "mceNoEditor"
		});
		</script>
		<form id="page_edit" method="post" action="index.php#pages">
		<input type='hidden' name='page_id' value=<?php echo $_POST['page_id'];?> ></input>
		<div id="table_head"></div>
        <table>
				<tbody>
				<tr><td>page_title</td><td><input type='text' name='page_title' value='<?php echo get_page_title($_POST['page_id']);?>'/></td></tr>
				<tr><td>page_content</td><td>
                <textarea class="mceEditor" name="page_content" cols="50" rows="15"><?php echo get_page_content($_POST['page_id']);?></textarea></td></tr>
				<tr><td>page_template</td><td>
				<select class="span3" tabindex="1" name="page_template" id="fileslist">
							<?php 
								$tmp=get_page_template($_POST['page_id']);
								foreach(get_template_files($theme)  as $f)
								{
									$f=substr($f,0,-4);
									if(!in_array($f,array('header','footer')))
									if($f != $tmp)
									echo "<option value='$f' >$f</option>";
									else
									echo "<option value='$f' selected='selected'>$f</option>";
								}
							?>
				</select>
				</td></tr>
                <tr><td></td><td><button class='btn btn-large btn-block' type='submit' formmethod='post' name='action' value='page_save' >save</button></td>
				</tbody>
        </table>
		<div id="table_foot"></div>
		</form>
	<?php
	}else if($_POST['action']=='page_new'){
	?>
		<script type="text/javascript" src="./js/tinymce/tiny_mce.js"></script>
		<script type="text/javascript">
		tinyMCE.init({
        mode : "textareas",
		 editor_selector : "mceEditor",
        editor_deselector : "mceNoEditor"
		});
		</script>
		<form id="page_edit" method="post" action="index.php#pages">
		<div id="table_head"></div>
        <table>
				<tbody>
				<tr><td>page_title</td><td><input type='text' name='page_title' value=''/></td></tr>
				<tr><td>page_content</td><td>
                <textarea class="mceEditor" name="page_content" cols="50" rows="15"></textarea></td></tr>
				<tr><td>page_template</td><td>
				<select class="span3" tabindex="1" name="page_template" id="fileslist">
							<?php
								foreach(get_template_files($theme)  as $f)
								{
									$f=substr($f,0,-4);
									if(!in_array($f,array('header','footer')))
									if($f != 'index')
									echo "<option value='$f' >$f</option>";
									else
									echo "<option value='$f' selected='selected'>$f</option>";
								}
							?>
				</select>
				</td></tr>
                <tr><td></td><td><button class='btn btn-large btn-block' type='submit' formmethod='post' name='action' value='page_save' >create</button></td>
				</tbody>
        </table>
		<div id="table_foot"></div>
		</form>
	<?php
	}else{
	?>
		<div>
				<div id="table_head"></div>
				<table>
					<thead>
						<tr>
							<th>page_id</th>
							<th>page_title</th>
							<th>edit</th>
							<th>delete</th>
						</tr>
					</thead>
					<tbody>
						<?php
							foreach(get_all_pages() as $p)
							{
								echo '<tr><form method="post" action="index.php#pages">';
								echo '<input type="hidden" name="action" value="page_edit">';
								echo "<td>".$p['page_id']."</td><td>".$p['page_title']."
								</td><td><button class='btn btn-large btn-block' type='submit' formmethod='post' name='page_id' value=".$p['page_id'].">edit</button></td>
								</form><form method='post' action='index.php#pages'><td><input type='hidden' name='action' value='page_del'><button class='btn btn-large btn-block' type='submit' formmethod='post' name='page_id' value=".$p['page_id'].">delete</button>";								
								echo '</td></form><tr>';
							}
						?>
						<tr><td></td><td></td><form method="post" action="index.php#pages"><td><button class='btn btn-large btn-block' type='submit' formmethod='post' name='action' value="page_new">New Page</button></td></form><td></td></tr>
					</tbody>
				</table>
				<div id="table_foot"></div>
			
		</div>
<?php	
	}
?>