<div class="row-fluid">
		<div class="span11 pull-right">
				<?php echo form_open('uye-ol');?>
						<br>
						<fieldset>
								<legend>Yeni bir hesap oluşturun</legend>

		            <label for="username">Kullanıcı adı</label>
								<input id="reg_username" type="text" name="username" value="<?php echo set_value('username');?>" placeholder="bir kullanıcı adı seçin"/>&nbsp;&nbsp;<span id="chk_msg"></span><br />
								<div style="color:red;"><?php echo form_error('username');?></div>

								<label for="email">E-posta</label>
								<input type="text" name="email" value="<?php echo set_value('email');?>" placeholder="e-posta adresinizi girin"/><br />
		            <!--<span class="help-block">We will not take the initiative to send you mail.</span>-->
								<div style="color:red;"><?php echo form_error('email');?></div>

								<label for="password">Şifre</label>
								<input type="password" name="password" value="<?php echo set_value('password');?>" placeholder="bir şifre belirleyin"/><br />
								<div style="color:red;"><?php echo form_error('password');?></div>

		            <label for="passconf">Şifrenizi doğrulayın</label>
								<input type="password" name="passconf" value="<?php echo set_value('passconf');?>" placeholder="belirlediğiniz şifreyi tekrar girin"/><br />
								<div style="color:red;"><?php echo form_error('passconf');?></div>

		            <img src="<?php echo base_url('user/captcha');?>" />
		            <label for="captcha">Doğrulama kodu</label>
		            <input type="text" name="captcha" placeholder="yukarıdaki dört karakteri buraya girin"/>
		            <div style="color:red;"><?php if(!empty($error)){echo $error;}?><?php echo form_error('captcha');?></div>

		            <label class="checkbox">
										<input type="checkbox" name="remember"/> beni hatırla
		            </label>

								<button class="btn btn-primary btn-blue" type="submit" name="submit">Gönder</button>
								<!--Error message<span id="msg"></span>-->

						</fieldset>
				</form>
		</div>
</div>
