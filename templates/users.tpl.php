	<div class="wrapper">
		<div id="content" class="users">
			<?if(strlen($this->error)>0):?><p class="error"><?=$this->error?></p><?endif;?>

			<h2>Change Password</h2>
			<form action="" method="post" id="changepwform">
				<fieldset>
					<label for="oldpw">Current Password:</label>
					<input type="password" name="oldpw" id="oldpw" />
					<label for="newpw">New Password:</label>
					<input type="password" name="newpw" id="newpw" />
					<label for="newpw2">New Password (again):</label>
					<input type="password" name="newpw2" id="newpw2" />
					<input type="submit" id="changepw" value="Change Password" />
				</fieldset>
			</form>

			<h2>Add User</h2>
			<form action="" method="post" id="newuserform">
				<fieldset>
					<label for="user">Username:</label>
					<input type="text" name="user" id="user" />
					<label for="pass">New Password:</label>
					<input type="password" name="pass" id="pass" />
					<input type="submit" id="newuser" value="Add User" />
				</fieldset>
			</form>

			<h2>All Users</h2>
			<ul>
				<?foreach($this->users as $user):?><li><?=$user['username']?> <?if($user['id'] != $_SESSION['auth']['id']):?>[<a href="?delete=<?=$user['id']?>">delete</a>]<?endif;?></li><?endforeach;?>
			</ul>
		</div>
	</div>
