<?php
	if($_POST['action']=='menu_save')
	{
		//echo $_POST['page_id'].' '.$_POST['page_title'].' '.$_POST['page_content'].' '.$_POST['page_template'];
		//save to database
		//$log->debug($db->prepare('update page_metas set page_id=%1$d,page_meta_value="%2$s" where page_meta_id=%3$d',$_POST['page_id'],$_POST['menu_name'],$_POST['page_meta_id']));
		$db->query($db->prepare('update page_metas set page_id=%1$d,page_meta_value="%2$s" where page_meta_id=%3$d',$_POST['page_id'],$_POST['menu_name'],$_POST['page_meta_id']));
	}
	
	if($_POST['action']=='menu_create')
	{
		//$log->debug($_POST['menu_name'].' '.$_POST['page_id'].' '.$_POST['menu_order']);
		//$log->debug($db->prepare('insert into page_metas (page_id,page_meta_name,page_meta_value) values (%1$d,"%2$s","%3$s")',$_POST['page_id'],'menu',$_POST['menu_name']));
		$db->query($db->prepare('insert into page_metas (page_id,page_meta_name,page_meta_value) values (%1$d,"%2$s","%3$s")',$_POST['page_id'],'menu',$_POST['menu_name']));
	}
	
	if($_POST['action']=='menu_del')
	{
		//$log->debug('del');
		//$log->debug($db->prepare('delete from page_metas where page_id=%1$d and page_meta_name="menu" and page_meta_value="%2$s";',$_POST['page_id'],$_POST['menu_name']));
		$db->query($db->prepare('delete from page_metas where page_id=%1$d and page_meta_name="menu" and page_meta_value="%2$s";',$_POST['page_id'],$_POST['menu_name']));
	}
	if($_POST['action']=='menu_new')
	{
?>
		<form id="menu_new" method="post" action="index.php#menus">
		<div id="table_head"></div>
        <table>
				<tbody>
				<tr><td>menu_name</td><td><input type='text' name='menu_name' value=''/></td></tr>
				<tr><td>page_id</td><td><input type='text' name='page_id' value=''/></td></tr>
                <tr><td></td><td><button class='btn btn-large btn-block' type='submit' formmethod='post' name='action' value='menu_create' >create</button></td>
				</tbody>
        </table>
		<div id="table_foot"></div>
		</form>

<?php }else{ ?>
		<div>
				<div id="table_head"></div>
				<table>
					<thead>
						<tr>
							<th>menu_name</th>
							<th>page_id</th>
							<th>save</th>
							<th>delete</th>
						</tr>
					</thead>
					<tbody>
						<?php
							
							foreach(get_all_menus() as $m)
							{
								//$log->debug($m);
								echo '<tr><form id="menu_show" method="post" action="index.php#menus"><input type="hidden" name="page_meta_id" value='.$m['page_meta_id'].'/>';
								echo "<td><input type='text' name='menu_name' value='".$m['page_meta_value']."'></input>
								</td><td><input type='text' name='page_id' value=".$m['page_id']."></input>
								<td><button class='btn btn-large btn-block'type='submit' formmethod='post' name='action' value='menu_save'>save</button></td>";
								echo '<td><button class="btn btn-large btn-block" type="submit" formmethod="post" name="action" value="menu_del">delete</button></td></form><tr>';
							}
						?>
						<tr><td></td><td></td><td></td><form id="menu_new" method="post" action="index.php#menus"><td><button class='btn btn-large btn-block'type='submit' formmethod='post' name='action' value='menu_new'>New Menu</button></td></form></tr>
					</tbody>
				</table>
				<div id="table_foot"></div>
		</div>
<?php } 

	if($_POST['action']=='menu_order_save')
	{
		//$log->debug($_POST['menu_order']);
		save_menu_order($_POST['menu_order']);
	}
	?>
		<div>
				<div id="table_head"></div>
				<table>
					<thead>
					<tbody>
					<tr><td>Menu Order</td>
					<form method="post" action="index.php#menus">
					<td><input type="text" name="menu_order" value="<?php echo get_menu_order();?>"/></td>
					<td><button class='btn btn-large btn-block' type='submit' formmethod='post' name='action' value='menu_order_save'>Save</button></td>
					</form></tr>
					</tbody>
				</table>
				<div id="table_foot"></div>
		</div>