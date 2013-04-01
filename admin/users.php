	<?php
		if($_POST['action']=='user_pass_change')
		{
			//$log->debug($_POST['user_login'].' '.$_POST['new_password']);
			change_user_password($_POST['user_login'],$_POST['new_password']);
		}
		
		if($_POST['action']=='user_pass_to_change')
		{
	?>
				<div>
				<div id="table_head"></div>
				<table>
					<tbody>
						<tr><form method='post' action='index.php#users'><td><input type='hidden' name='user_login' value="<?php echo $_POST['user_login']?>"/><input type='password' name='new_password' placeholder='New Password'/></td>
								<td><button class='btn btn-large btn-block' type='submit' formmethod='post' name='action' value='user_pass_change' >cheange_password</button></td>
						</form></tr>
					</tbody>
				</table>
				<div id="table_foot"></div>
		</div>
	<?php
		}else{
	?>
		<div>
				<div id="table_head"></div>
				<table>
					<thead>
						<tr>
							<th>user_name</th>
							<th>change_password</th>
						</tr>
					</thead>
					<tbody>
						<?php
							
							foreach(get_all_users() as $u)
							{
								echo "<tr><form method='post' action='index.php#users'><td><input type='hidden' name='user_login' value='$u'/>$u</td>
								<td><button class='btn btn-large btn-block' type='submit' formmethod='post' name='action' value='user_pass_to_change' >cheange_password</button></td>
								</form></tr>";
							}
						?>
					</tbody>
				</table>
				<div id="table_foot"></div>
		</div>
	<?php
		}
	?>