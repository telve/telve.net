<div class="row-fluid">
	<div class="span11 pull-right">
		<?php echo form_open('giris');?>

		<br>
		<fieldset>
			<legend>Giriş yapın</legend>

			<label for="username">Kullanıcı adı</label>
			<input type="text" name="username" placeholder="kullanıcı adı"/><br />
			<div style="color:red;"><?php echo form_error('username');?></div>

			<label for="password">Şifre</label>
			<input type="password" name="password" placeholder="şifre"/><br />
			<div style="color:red;"><?php echo form_error('password');?></div>

			<label class="checkbox">
				<input type="checkbox" name="remember"/> beni hatırla
			</label>
			<a class="checkbox" href="<?php echo base_url('sifremi-unuttum');?>">şifremi unuttum?</a>
			<br/>
			<!--Error message-->
			<span style="color:red;"><?php echo $login_error;?></span><br>
			<button class="btn btn-primary btn-blue" type="submit" name="submit" >Giriş yap</button>
		</fieldset>
	</form>
	</div>
</div>
