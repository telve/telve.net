<!--Login or register the pop-up dialog-->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Close">&times;</button>
        <h4 id="myModalLabel">Birşeyler gönderebilmek için üye olman gerek.</h4>
    </div>

    <div class="modal-body" style="margin-left:20px;">
        <div class="row-fluid">
            <div class="span4">
                <?php echo form_open('uye-ol');?>

                <fieldset>
                    <br/>
                    <strong><div style="font-size:18px">Yeni bir hesap oluşturun</div></strong>
                    <br/>

                    <label for="username">Kullanıcı adı</label>
        			<input id="reg_username" type="text" name="username" value="<?php echo set_value('username');?>" placeholder="bir kullanıcı adı seçin"/><br />
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
        			<br/>
        			<button class="btn btn-primary btn-blue" type="submit" name="submit" >Gönder</button>

                    <!--Error message<span id="msg"></span>-->

                </fieldset>
            </form>
        </div>




		<div class="span3">
			<div class="row-fluid">
				<div class="span11">
					<br />
					<br />
					<h5>Gizlilik Politikası</h5>
					<ul>
						<li>Sizinle ve siteyi kullanımızla ilgili (oylama, favori vb. hariç) asla veri toplanmayacaktır.</li>
						<li>Kişisel bilgileriniz gizli tutulacaktır.</li>
						<li>Gizli bilgileriniz kesinlikle açığa vurulmayacaktır.</li>
						<li>Kanuni durumlar dışında, gizli bilgileriniz asla kimseyle paylaşılmayacaktır.</li>
					</ul>
					<p>Daha fazla bilgi edinmek için <a href="#">Gizlilik Politikası</a> sayfamızı ziyaret ediniz.</p>
				</div>
				<div class="span1"><!--Draw a vertical dividing line-->
					<table style="border-right:2px solid #ddd; height:530px; margin-left:20px;">
						<tr><td >&nbsp;</td></tr>
					</table>
				</div>
			</div>
		</div>

		<div class="span5">
			<?php echo form_open('giris');?>
            <br/>
			<fieldset style="margin-left:20px;">
                <strong><div style="font-size:18px">Giriş yapın</div></strong>
                <small>Hâlihazırda bir hesabınız var ve giriş mi yapmak istiyorsunuz?</small>
                <br/><br/>

    			<label for="username">Kullanıcı adı</label>
    			<input type="text" name="username" placeholder="kullanıcı adı"/><br />
    			<?php echo form_error('username');?>

    			<label for="password">Şifre</label>
    			<input type="password" name="password" placeholder="şifre"/><br />
    			<?php echo form_error('password');?>

                <label class="checkbox">
                    <input type="checkbox" name="remember"/> beni hatırla
                </label>

                <a class="checkbox" href="<?php echo base_url('sifremi-unuttum');?>">şifremi unuttum?</a>
                <br/><br/>
    			<button class="btn btn-primary btn-blue" type="submit" name="submit" >Giriş yap</button>

			</fieldset>
        </form>
    </div>
</div>
</div>
</div>

<br><br><br><br>
<div class="container">
<div class="row-fluid">
		<div class="span12" style="margin-left: 15%;">
			<div class="span2" style="width: 15%; height: 142px; padding-left:1.5em;">
				<ul class="unstyled">
					<li style="font-size:16px;">hakkında<li>
					<li><a href="#">blog</a></li>
					<li><a href="#">hakkında</a></li>
					<li><a href="#">kaynak kod</a></li>
					<li><a href="#">reklam ver</a></li>
					<li><a href="#">kariyer</a></li>
				</ul>
			</div>
			<div class="span2" style="width: 15%; height: 142px; padding-left:1.5em; border-left:solid 1px rgba(0, 0, 0, .2);">
				<ul class="unstyled">
					<li style="font-size:16px;">yardım<li>
					<li><a href="#">site kuralları</a></li>
					<li><a href="#">SSS</a></li>
					<li><a href="#">viki</a></li>
					<li><a href="#">şeffaflık</a></li>
                    <li><a href="#">bize ulaşın</a></li>
				</ul>
			</div>
			<div class="span2" style="width: 15%; height: 142px; padding-left:1.5em; border-left:solid 1px rgba(0, 0, 0, .2);">
				<ul class="unstyled">
					<li style="font-size:16px;">mobil<li>
					<li><a href="#">iPhone için Telve</a></li>
					<li><a href="#">Android için Telve</a></li>
					<li><a href="#">mobil site</a></li>
					<li><a href="#">butonlar</a></li>
				</ul>
			</div>
			<div class="span2" style="width: 15%; height: 142px; padding-left:1.5em; border-left:solid 1px rgba(0, 0, 0, .2);">
				<ul class="unstyled">
					<li style="font-size:16px;"><3<li>
					<li><a href="#" style="color:#9A7D2E;">telvealtın</a></li>
					<li><a href="#">telvehediyeler</a></li>
				</ul>
			</div>
		</div>
	</div>
	<hr>
	<div class="row-fluid">
		<div class="span12">
			<div class="span6">
				<a href="#">Kullanıcı Sözleşmesi</a>
                 ve
				<a href="#" style="color:green;">Gizlilik Politikası (güncellendi)</a>
			</div>
			<div class="span6">
				<p class="muted pull-right">Telif hakkı &copy; 2017&nbsp;&nbsp;<a href="http://dragon.computer/">dragon.computer</a>&nbsp;&nbsp;Tüm Hakları Saklıdır.</p>
			</div>
		</div>
	</div>
</div>

<script src="<?php echo base_url("assets/js/telve.js");?>"></script>

</body>
</html>
