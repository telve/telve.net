<div class="row-fluid">
	<div class="span11 pull-right">
		<?php echo form_open('user/login');?>

		<br>
		<fieldset>
			<legend>Log in</legend>

			<label for="username">Username</label>
			<input type="text" name="username" placeholder="username"/><br />
			<div style="color:red;"><?php echo form_error('username');?></div>

			<label for="password">Password</label>
			<input type="password" name="password" placeholder="password"/><br />
			<div style="color:red;"><?php echo form_error('password');?></div>

			<label class="checkbox">
				<input type="checkbox" name="remember"/> remember me
			</label>
			<!--Error message-->
			<span style="color:red;"><?php echo $login_error;?></span><br>
			<button class="btn btn-primary" type="submit" name="submit" >Log in</button>
		</fieldset>
	</form>
	</div>
</div>
