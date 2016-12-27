<div class="span5">
			<?php echo form_open('user/login');?>

			<fieldset>
			<legend>Log in</legend>

			<label for="username">Username</label>
			<input type="text" name="username" placeholder="username"/><br />
			<?php echo form_error('username');?>

			<label for="password">Password</label>
			<input type="password" name="password" placeholder="password"/><br />
			<?php echo form_error('password');?>

			<label class="checkbox">
                <input type="checkbox" name="remember"/> remember me
            </label>


            <!--错误提示-->

			<button class="btn btn-primary" type="submit" name="submit" >登录</button>

			</fieldset>
			</form>
</div>
