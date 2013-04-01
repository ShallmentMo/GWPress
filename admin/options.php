<?php
	if($_POST['action']=='option_save')
	{
		//save to database
		//$log->debug($_POST['option_name'].' '.$_POST['option_value']);
		//$log->debug($db->prepare('update options set option_value="%1$s" where option_name="%2$s";',$_POST['option_value'],$_POST['option_name']));
		$db->query($db->prepare('update options set option_value="%1$s" where option_name="%2$s";',$_POST['option_value'],$_POST['option_name']));
	}
?>
		<div>
			
				
				<div id="table_head"></div>
				<table>
					<thead>
						<tr>
							<th>option_name</th>
							<th>option_value</th>
							<th>save</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$option_donot_display=array('active_plugins','menu_nav','applied_theme');
							foreach(get_all_options() as $o)
							{
								
								if(!in_array($o['option_name'],$option_donot_display))
								{
								echo '<form  method="post" action="index.php#options"><input type="hidden" name="action" value="option_save">';
								echo "<tr><td>".$o['option_name']."</td><td><input type='text' name='option_value' value='".$o['option_value']."'/>
								</td><td><button class='btn btn-large btn-block' type='submit' formmethod='post' name='option_name' value=".$o['option_name'].">save</button></td></tr>";
								echo '</form>';
								}
							}
							
						?>
						<form method="post" action="index.php#options">
						<input type="hidden" name="action" value="option_save">
						<tr>
							<td>applied_theme</td>
							<td>
							<select class="span3" tabindex="1" id="applied_themes" name="option_value">
							<?php 
								foreach(get_themes() as $t)
								{
									if($t != get_option('applied_theme'))
									echo "<option value='$t'>$t</option>";
									else
									echo "<option value='$t' selected='$t' >$t</option>";
								}
							?>
							</select>
							</td>
							<td><button class='btn btn-large btn-block' type='submit' formmethod='post' name='option_name' value='applied_theme'>save</button></td>
						</tr>
						</form>
					</tbody>
				</table>
				<div id="table_foot"></div>
		</div>